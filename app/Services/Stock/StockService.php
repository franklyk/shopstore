<?php

namespace App\Services\Stock;

use App\Enums\StockMovementType;
use App\Models\Stock\Stock;
use App\Models\Stock\StockMovement;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class StockService
{
    /*
    |--------------------------------------------------------------------------
    | INCREASE (ENTRADA)
    |--------------------------------------------------------------------------
    */
    public function increase(
        int $productId,
        int $warehouseId,
        int $quantity,
        ?string $notes = null,
        ?array $reference = null,
        ?int $userId = null
    ): Stock {
        return DB::transaction(function () use (
            $productId,
            $warehouseId,
            $quantity,
            $notes,
            $reference,
            $userId
        ) {
            $stock = $this->getOrCreateStock($productId, $warehouseId);

            $before = $stock->quantity;
            $after = $before + $quantity;

            $stock->update([
                'quantity' => $after,
            ]);

            $this->createMovement(
                productId: $productId,
                warehouseId: $warehouseId,
                type: StockMovementType::IN,
                quantity: $quantity,
                before: $before,
                after: $after,
                notes: $notes,
                reference: $reference,
                userId: $userId
            );

            return $stock;
        });
    }

    /*
    |--------------------------------------------------------------------------
    | DECREASE (SAÍDA)
    |--------------------------------------------------------------------------
    */
    public function decrease(
        int $productId,
        int $warehouseId,
        int $quantity,
        ?string $notes = null,
        ?array $reference = null,
        ?int $userId = null
    ): Stock {
        return DB::transaction(function () use (
            $productId,
            $warehouseId,
            $quantity,
            $notes,
            $reference,
            $userId
        ) {
            $stock = $this->getStockOrFail($productId, $warehouseId);

            if ($stock->quantity < $quantity) {
                throw ValidationException::withMessages([
                    'quantity' => 'Insufficient stock available.',
                ]);
            }

            $before = $stock->quantity;
            $after = $before - $quantity;

            $stock->update([
                'quantity' => $after,
            ]);

            $this->createMovement(
                productId: $productId,
                warehouseId: $warehouseId,
                type: StockMovementType::OUT,
                quantity: $quantity,
                before: $before,
                after: $after,
                notes: $notes,
                reference: $reference,
                userId: $userId
            );

            return $stock;
        });
    }

    /*
    |--------------------------------------------------------------------------
    | ADJUSTMENT (CORREÇÃO DE INVENTÁRIO)
    |--------------------------------------------------------------------------
    */
    public function adjust(
        int $productId,
        int $warehouseId,
        int $newQuantity,
        ?string $notes = null,
        ?array $reference = null,
        ?int $userId = null
    ): Stock {
        return DB::transaction(function () use (
            $productId,
            $warehouseId,
            $newQuantity,
            $notes,
            $reference,
            $userId
        ) {
            $stock = $this->getOrCreateStock($productId, $warehouseId);

            $before = $stock->quantity;
            $difference = $newQuantity - $before;

            $stock->update([
                'quantity' => $newQuantity,
            ]);

            $this->createMovement(
                productId: $productId,
                warehouseId: $warehouseId,
                type: StockMovementType::ADJUSTMENT,
                quantity: abs($difference),
                before: $before,
                after: $newQuantity,
                notes: $notes,
                reference: $reference,
                userId: $userId
            );

            return $stock;
        });
    }

    /*
    |--------------------------------------------------------------------------
    | TRANSFER (ENTRE WAREHOUSES)
    |--------------------------------------------------------------------------
    */
    public function transfer(
        int $productId,
        int $fromWarehouseId,
        int $toWarehouseId,
        int $quantity,
        ?string $notes = null,
        ?array $reference = null,
        ?int $userId = null
    ): void {
        DB::transaction(function () use (
            $productId,
            $fromWarehouseId,
            $toWarehouseId,
            $quantity,
            $notes,
            $reference,
            $userId
        ) {
            $this->decrease(
                productId: $productId,
                warehouseId: $fromWarehouseId,
                quantity: $quantity,
                notes: $notes,
                reference: $reference,
                userId: $userId
            );

            $this->increase(
                productId: $productId,
                warehouseId: $toWarehouseId,
                quantity: $quantity,
                notes: $notes,
                reference: $reference,
                userId: $userId
            );
        });
    }

    /*
    |--------------------------------------------------------------------------
    | STOCK HELPERS
    |--------------------------------------------------------------------------
    */
    private function getOrCreateStock(int $productId, int $warehouseId): Stock
    {
        return Stock::firstOrCreate([
            'product_id' => $productId,
            'warehouse_id' => $warehouseId,
        ],
            [
                'uuid' => (string) Str::ulid(),
                'quantity' => 0,
            ]);
    }

    private function getStockOrFail(int $productId, int $warehouseId): Stock
    {
        return Stock::where('product_id', $productId)
            ->where('warehouse_id', $warehouseId)
            ->firstOrFail();
    }

    /*
    |--------------------------------------------------------------------------
    | MOVEMENT FACTORY
    |--------------------------------------------------------------------------
    */
    private function createMovement(
        int $productId,
        int $warehouseId,
        StockMovementType $type,
        int $quantity,
        int $before,
        int $after,
        ?string $notes = null,
        ?array $reference = null,
        ?int $userId = null
    ): StockMovement {
        return StockMovement::create([

            'uuid' => (string) Str::ulid(),

            'product_id' => $productId,
            'warehouse_id' => $warehouseId,
            'type' => $type,
            'quantity' => $quantity,
            'quantity_before' => $before,
            'quantity_after' => $after,
            'notes' => $notes,
            'reference_type' => $reference['type'] ?? null,
            'reference_id' => $reference['id'] ?? null,
            'user_id' => $userId,
        ]);
    }

    public function reserve(
        int $productId,
        int $warehouseId,
        int $quantity,
        ?string $notes = null,
        ?array $reference = null,
        ?int $userId = null,
        ?int $ttlMinutes = 30
    ) {
        return DB::transaction(function () use (
            $productId,
            $warehouseId,
            $quantity,
            $reference,
            $userId,
            $ttlMinutes
        ) {
            $stock = $this->getStockOrFail($productId, $warehouseId);

            $available = $stock->quantity - $stock->reserved_quantity;

            if ($available < $quantity) {
                throw ValidationException::withMessages([
                    'quantity' => 'Insufficient available stock.',
                ]);
            }

            $stock->increment('reserved_quantity', $quantity);

            return StockReservation::create([
                'product_id' => $productId,
                'warehouse_id' => $warehouseId,
                'quantity' => $quantity,
                'status' => StockReservationStatus::ACTIVE,
                'expires_at' => now()->addMinutes($ttlMinutes),
                'reference_type' => $reference['type'] ?? null,
                'reference_id' => $reference['id'] ?? null,
                'user_id' => $userId,
            ]);
        });
    }
}
