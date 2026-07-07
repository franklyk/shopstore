<?php

namespace App\Services\Checkout;

use App\Actions\Orders\CreateOrderAction;
use App\Models\Order;
use App\Models\User;
use App\Models\Warehouse;
use App\Services\Stock\StockReservationService;
use Illuminate\Support\Facades\DB;

class CheckoutService
{
    public function __construct(
        private CreateOrderAction $createOrderAction,
        private StockReservationService $stockReservationService
    ) {}

    public function checkout(User $user, array $data): Order
    {
        return DB::transaction(function () use ($user, $data) {

            // 1. Criar pedido + itens
            $order = $this->createOrderAction->run(
                user: $user,
                data: $data
            );

            // 2. Reservar estoque para cada item
            foreach ($order->items as $item) {

                $this->stockReservationService->reserve(
                    productId: $item->product_id,
                    warehouseId: $this->resolveWarehouse($item->product_id),
                    quantity: $item->quantity,
                    reference: $order
                );
            }

            return $order;
        });
    }

    /**
     * Regra simples inicial:
     * usa o primeiro warehouse disponível
     */
    private function resolveWarehouse(int $productId): int
    {
        return Warehouse::query()->value('id');
    }
}
