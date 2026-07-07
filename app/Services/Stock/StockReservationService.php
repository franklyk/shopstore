<?php

namespace App\Services\Stock;

use App\Enums\StockReservationStatus;
use App\Models\Stock;
use App\Models\StockReservation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use RuntimeException;

class StockReservationService
{
    public function reserve(
        int $productId,
        int $warehouseId,
        int $quantity,
        Model $reference
    ): StockReservation {

        return DB::transaction(function () use (
            $productId,
            $warehouseId,
            $quantity,
            $reference
        ) {

            $stock = Stock::where('product_id', $productId)
                ->where('warehouse_id', $warehouseId)
                ->lockForUpdate()
                ->firstOrFail();

            $available = $stock->quantity - $stock->reserved_quantity;

            if ($quantity > $available) {
                throw new RuntimeException('Estoque insuficiente.');
            }

            $stock->increment('reserved_quantity', $quantity);

            return StockReservation::create([

                'uuid' => (string) Str::ulid(),

                'product_id' => $productId,
                'warehouse_id' => $warehouseId,
                'quantity' => $quantity,
                'reserved_until' => now()->addMinutes(15),
                'status' => StockReservationStatus::ACTIVE,
                'reference_type' => get_class($reference),
                'reference_id' => $reference->id,
            ]);
        });
    }
}
