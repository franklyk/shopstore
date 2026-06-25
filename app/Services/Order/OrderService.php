<?php

namespace App\Services\Order;

use App\Enums\OrderStatus;
use App\Models\Order;
use App\Models\Product;
use App\Services\Stock\StockReservationService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class OrderService
{
    public function __construct(
        private StockReservationService $reservationService
    ) {}

    /*
    |--------------------------------------------------------------------------
    | CREATE ORDER + RESERVE STOCK
    |--------------------------------------------------------------------------
    */
    public function create(array $data, int $userId): Order
    {
        return DB::transaction(function () use ($data, $userId) {

            if (empty($data['items'])) {
                throw ValidationException::withMessages([
                    'items' => 'Order must have at least one item.',
                ]);
            }

            $order = Order::create([
                'uuid' => (string) Str::ulid(),
                'user_id' => $userId,
                'warehouse_id' => $data['warehouse_id'],

                'status' => OrderStatus::PENDING->value,
                'payment_status' => 'pending',

                'subtotal' => 0,
                'shipping' => $data['shipping'] ?? 0,
                'discount' => $data['discount'] ?? 0,
                'total' => 0,

                'customer_name' => $data['customer_name'],

                'zipcode' => $data['zipcode'],
                'street' => $data['street'],
                'number' => $data['number'],
                'complement' => $data['complement'] ?? null,
                'district' => $data['district'],
                'city' => $data['city'],
                'state' => $data['state'],

                'notes' => $data['notes'] ?? null,
            ]);

            $subtotal = 0;

            foreach ($data['items'] as $item) {

                $product = Product::findOrFail($item['product_id']);

                $quantity = (int) $item['quantity'];
                $price = (float) $product->price;

                // 1. RESERVA ESTOQUE (ANTI OVERSELLING)
                $this->reservationService->reserve(
                    productId: $product->id,
                    warehouseId: $data['warehouse_id'],
                    quantity: $quantity,
                    reference: [
                        'type' => 'order',
                        'id' => $order->id,
                    ],
                    userId: $userId
                );

                // 2. CRIA ITEM DO PEDIDO
                $order->items()->create([
                    'product_id' => $product->id,
                    'name' => $product->name,
                    'sku' => $product->sku,

                    'price' => $price,
                    'quantity' => $quantity,
                    'subtotal' => $price * $quantity,
                ]);

                $subtotal += $price * $quantity;
            }

            $order->update([
                'subtotal' => $subtotal,
                'total' => $subtotal + $order->shipping - $order->discount,
                'status' => OrderStatus::RESERVED->value,
            ]);

            return $order->load('items');
        });
    }

    /*
    |--------------------------------------------------------------------------
    | CONFIRM ORDER (FINALIZA COMPRA)
    |--------------------------------------------------------------------------
    */
    public function confirm(Order $order): Order
    {
        return DB::transaction(function () use ($order) {

            if ($order->status !== OrderStatus::RESERVED->value) {
                throw ValidationException::withMessages([
                    'order' => 'Order must be reserved before confirmation.',
                ]);
            }

            // aqui você NÃO mexe direto no stock
            // a reserva já garante o bloqueio

            $order->update([
                'status' => OrderStatus::CONFIRMED->value,
                'payment_status' => 'paid',
                'paid_at' => now(),
            ]);

            return $order;
        });
    }

    /*
    |--------------------------------------------------------------------------
    | CANCEL ORDER (LIBERA RESERVA)
    |--------------------------------------------------------------------------
    */
    public function cancel(Order $order): Order
    {
        return DB::transaction(function () use ($order) {

            if ($order->status === OrderStatus::CONFIRMED->value) {
                throw ValidationException::withMessages([
                    'order' => 'Confirmed orders cannot be cancelled.',
                ]);
            }

            // libera reservas automaticamente
            foreach ($order->stockReservations as $reservation) {
                $this->reservationService->cancel($reservation);
            }

            $order->update([
                'status' => OrderStatus::CANCELLED->value,
            ]);

            return $order;
        });
    }
}
