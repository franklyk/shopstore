<?php

namespace App\Services\Stock;

use App\Enums\StockReservationStatus;
use App\Models\Stock;
use App\Models\StockReservation;
use App\Services\StockService;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class StockReservationService
{
    /*
    |--------------------------------------------------------------------------
    | CREATE RESERVATION
    |--------------------------------------------------------------------------
    */
    public function reserve(
        int $productId,
        int $warehouseId,
        int $quantity,
        ?string $notes = null,
        ?array $reference = null,
        ?int $userId = null,
        int $ttlMinutes = 30
    ): StockReservation {
        return DB::transaction(function () use (
            $productId,
            $warehouseId,
            $quantity,
            $reference,
            $userId,
            $ttlMinutes
        ) {
            $stock = Stock::where('product_id', $productId)
                ->where('warehouse_id', $warehouseId)
                ->lockForUpdate()
                ->first();

            if (! $stock) {
                throw ValidationException::withMessages([
                    'stock' => 'Stock not found.',
                ]);
            }

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

    /*
    |--------------------------------------------------------------------------
    | CONFIRM RESERVATION (FINAL SALE)
    |--------------------------------------------------------------------------
    */
    public function confirm(StockReservation $reservation): StockReservation
    {
        return DB::transaction(function () use ($reservation) {

            if ($reservation->status !== StockReservationStatus::ACTIVE) {
                throw ValidationException::withMessages([
                    'reservation' => 'Reservation is not active.',
                ]);
            }

            $stock = Stock::where('product_id', $reservation->product_id)
                ->where('warehouse_id', $reservation->warehouse_id)
                ->lockForUpdate()
                ->firstOrFail();

            $stock->decrement('reserved_quantity', $reservation->quantity);

            app(StockService::class)->decrease(
                productId: $reservation->product_id,
                warehouseId: $reservation->warehouse_id,
                quantity: $reservation->quantity,
                notes: 'Reservation confirmed',
                reference: [
                    'type' => 'stock_reservation',
                    'id' => $reservation->id,
                ],
                userId: $reservation->user_id
            );

            $reservation->update([
                'status' => StockReservationStatus::CONFIRMED,
            ]);

            return $reservation;
        });
    }

    /*
    |--------------------------------------------------------------------------
    | CANCEL RESERVATION
    |--------------------------------------------------------------------------
    */
    public function cancel(StockReservation $reservation): StockReservation
    {
        return DB::transaction(function () use ($reservation) {

            if ($reservation->status !== StockReservationStatus::ACTIVE) {
                throw ValidationException::withMessages([
                    'reservation' => 'Reservation cannot be cancelled.',
                ]);
            }

            $stock = Stock::where('product_id', $reservation->product_id)
                ->where('warehouse_id', $reservation->warehouse_id)
                ->lockForUpdate()
                ->firstOrFail();

            $stock->decrement('reserved_quantity', $reservation->quantity);

            $reservation->update([
                'status' => StockReservationStatus::CANCELLED,
            ]);

            return $reservation;
        });
    }

    /*
    |--------------------------------------------------------------------------
    | EXPIRE RESERVATION (FOR JOB / SCHEDULER)
    |--------------------------------------------------------------------------
    */
    public function expire(StockReservation $reservation): StockReservation
    {
        return DB::transaction(function () use ($reservation) {

            if ($reservation->status !== StockReservationStatus::ACTIVE) {
                return $reservation;
            }

            $stock = Stock::where('product_id', $reservation->product_id)
                ->where('warehouse_id', $reservation->warehouse_id)
                ->lockForUpdate()
                ->first();

            if ($stock) {
                $stock->decrement('reserved_quantity', $reservation->quantity);
            }

            $reservation->update([
                'status' => StockReservationStatus::EXPIRED,
            ]);

            return $reservation;
        });
    }

    /*
    |--------------------------------------------------------------------------
    | AUTO EXPIRE BATCH (OPTIONAL - JOB)
    |--------------------------------------------------------------------------
    */
    public function expireAllDue(): int
    {
        $reservations = StockReservation::query()
            ->where('status', StockReservationStatus::ACTIVE)
            ->whereNotNull('expires_at')
            ->where('expires_at', '<=', now())
            ->get();

        $count = 0;

        foreach ($reservations as $reservation) {
            $this->expire($reservation);
            $count++;
        }

        return $count;
    }
}
