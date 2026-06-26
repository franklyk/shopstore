<?php

namespace App\Actions\Orders;

use App\Enums\PaymentStatus;
use App\Models\Address;
use App\Models\Cart\Cart;
use App\Models\Order\Order;
use App\Models\User\User;
use Illuminate\Support\Facades\DB;

class CreateOrderAction
{
    public function __construct(
        private Cart $cartModel
    ) {}

    public function run(User $user, array $data): Order
    {
        return DB::transaction(function () use ($user, $data) {

            $cart = $this->cartModel
                ->with('items.product')
                ->firstWhere('user_id', $user->id);

            if (! $cart || $cart->items->isEmpty()) {
                abort(400, 'Carrinho vazio.');
            }

            $address = Address::findOrFail($data['address_id']);

            abort_if(
                $address->user_id !== $user->id,
                403
            );

            $subtotal = $this->calculateSubtotal($cart);

            $order = Order::create([
                'user_id' => $user->id,
                'status' => 'pending',
                'payment_status' => PaymentStatus::PENDING,
                'subtotal' => $subtotal,
                'shipping' => 0,
                'discount' => 0,
                'total' => $subtotal,

                'customer_name' => $user->name,
                'zipcode' => $address->cep,
                'street' => $address->street,
                'number' => $address->number,
                'complement' => $address->complement,
                'district' => $address->district,
                'city' => $address->city,
                'state' => $address->state,
            ]);

            foreach ($cart->items as $item) {
                $product = $item->product;

                $order->items()->create([
                    'product_id' => $product->id,
                    'name' => $product->name,
                    'slug' => $product->slug ?? str($product->name)->slug(),
                    'sku' => $product->sku,
                    'price' => $product->price,
                    'quantity' => $item->quantity,
                    'subtotal' => $item->quantity * $product->price,
                ]);
            }

            $order->payment()->create([
                'status' => PaymentStatus::PENDING,
                'amount' => $order->total,
            ]);

            $cart->items()->delete();

            return $order->load(['items', 'payment']);
        });
    }

    private function calculateSubtotal(Cart $cart): float
    {
        return $cart->items->sum(function ($item) {
            return $item->quantity * $item->product->price;
        });
    }
}
