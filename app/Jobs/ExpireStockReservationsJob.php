<?php

namespace App\Jobs;

use App\Models\StockReservation;
use App\Services\Stock\StockService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ExpireStockReservationsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function handle(StockService $stockService): void
    {
        $reservations = StockReservation::query()
            ->where('status', 'active')
            ->whereNotNull('expires_at')
            ->where('expires_at', '<=', now())
            ->get();

        foreach ($reservations as $reservation) {

            // 1. marca como expirada
            $reservation->update([
                'status' => 'expired',
            ]);

            // 2. libera estoque
            $stockService->increase(
                productId: $reservation->product_id,
                warehouseId: $reservation->warehouse_id,
                quantity: $reservation->quantity,
                notes: 'Reservation expired',
                reference: [
                    'type' => 'reservation_expiry',
                    'id' => $reservation->id,
                ],
                userId: null
            );
        }
    }
}
