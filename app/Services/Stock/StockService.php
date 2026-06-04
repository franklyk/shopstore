<?php

namespace App\Services\Stock;

use App\Enums\StockMovementType;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Stock;
use App\Models\StockMovement;
use App\Models\Warehouse;
use DomainException;
use Illuminate\Support\Facades\DB;

class StockService
{
    public function increase(
        Product $product,
        int $quantity,
        ?object $reference = null,
        ?string $notes = null,
        ?Warehouse $warehouse = null,
    ): void {
        DB::transaction(function () use (
            $product,
            $quantity,
            $reference,
            $notes,
            $warehouse
        ) {

            $warehouse ??= $this->defaultWarehouse();

            $stock = $this->stockRecord(
                $product,
                $warehouse
            );

            $stock->increment(
                'quantity',
                $quantity,
                []
            );

            $this->movement(
                product: $product,
                warehouse: $warehouse,
                type: StockMovementType::IN,
                quantity: $quantity,
                reference: $reference,
                notes: $notes,
            );
        });
    }

    public function decrease(Order $order): void
    {
        DB::transaction(function () use ($order) {

            $warehouse = $this->defaultWarehouse();

            $order->load('items');

            foreach ($order->items as $item) {

                $this->decreaseItem(
                    $item,
                    $warehouse
                );
            }
        });
    }

    public function available(
        Product $product,
        ?Warehouse $warehouse = null,
    ): int {
        $warehouse ??= $this->defaultWarehouse();

        return Stock::query()
            ->where('product_id', $product->id)
            ->where('warehouse_id', $warehouse->id)
            ->value('quantity') ?? 0;
    }

    private function decreaseItem(
        OrderItem $item,
        Warehouse $warehouse,
    ): void {

        $stock = Stock::query()
            ->where('product_id', $item->product_id)
            ->where('warehouse_id', $warehouse->id)
            ->lockForUpdate()
            ->first();

        if (! $stock) {
            throw new DomainException(
                "Stock not found for product {$item->product_id}"
            );
        }

        if ($stock->quantity < $item->quantity) {
            throw new DomainException(
                "Insufficient stock for product {$item->product_id}"
            );
        }

        $stock->decrement(
            'quantity',
            $item->quantity,
            []
        );

        $this->movement(
            product: $item->product,
            warehouse: $warehouse,
            type: StockMovementType::OUT,
            quantity: $item->quantity,
            reference: $item,
            notes: "Order #{$item->order_id}",
        );
    }

    private function stockRecord(
        Product $product,
        Warehouse $warehouse,
    ): Stock {

        /** @var Stock $stock */
        $stock = Stock::firstOrCreate(
            [
                'product_id' => $product->id,
                'warehouse_id' => $warehouse->id,
            ],
            [
                'quantity' => 0,
            ]
        );

        return $stock;
    }

    private function movement(
        Product $product,
        Warehouse $warehouse,
        StockMovementType $type,
        int $quantity,
        ?object $reference = null,
        ?string $notes = null,
    ): StockMovement {

        return StockMovement::create([
            'product_id' => $product->id,
            'warehouse_id' => $warehouse->id,

            'type' => $type,
            'quantity' => $quantity,

            'reference_type' => $reference
                ? $reference::class
                : null,

            'reference_id' => $reference?->id,

            'notes' => $notes,
        ]);
    }

    private function defaultWarehouse(): Warehouse
    {
        return Warehouse::query()
            ->where('code', 'MAIN')
            ->firstOrFail();
    }
}
