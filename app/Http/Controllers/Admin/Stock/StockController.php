<?php

namespace App\Http\Controllers\Stock;

use App\Http\Controllers\Controller;
use App\Services\Stock\StockReservationService;
use App\Services\StockService;
use Illuminate\Http\Request;

class StockController extends Controller
{
    public function __construct(
        private StockService $stockService,
        private StockReservationService $reservationService
    ) {}

    /*
    |--------------------------------------------------------------------------
    | INCREASE STOCK (RECEBIMENTO MANUAL / AJUSTE)
    |--------------------------------------------------------------------------
    */
    public function increase(Request $request)
    {
        $data = $request->validate([
            'product_id' => ['required', 'integer'],
            'warehouse_id' => ['required', 'integer'],
            'quantity' => ['required', 'integer', 'min:1'],
            'notes' => ['nullable', 'string'],
        ]);

        $stock = $this->stockService->increase(
            productId: $data['product_id'],
            warehouseId: $data['warehouse_id'],
            quantity: $data['quantity'],
            notes: $data['notes'] ?? null,
            userId: $request->user()?->id
        );

        return response()->json($stock);
    }

    /*
    |--------------------------------------------------------------------------
    | DECREASE STOCK (SAÍDA MANUAL)
    |--------------------------------------------------------------------------
    */
    public function decrease(Request $request)
    {
        $data = $request->validate([
            'product_id' => ['required', 'integer'],
            'warehouse_id' => ['required', 'integer'],
            'quantity' => ['required', 'integer', 'min:1'],
            'notes' => ['nullable', 'string'],
        ]);

        $stock = $this->stockService->decrease(
            productId: $data['product_id'],
            warehouseId: $data['warehouse_id'],
            quantity: $data['quantity'],
            notes: $data['notes'] ?? null,
            userId: $request->user()?->id
        );

        return response()->json($stock);
    }

    /*
    |--------------------------------------------------------------------------
    | TRANSFER ENTRE DEPÓSITOS
    |--------------------------------------------------------------------------
    */
    public function transfer(Request $request)
    {
        $data = $request->validate([
            'product_id' => ['required', 'integer'],
            'from_warehouse_id' => ['required', 'integer'],
            'to_warehouse_id' => ['required', 'integer'],
            'quantity' => ['required', 'integer', 'min:1'],
            'notes' => ['nullable', 'string'],
        ]);

        $this->stockService->transfer(
            productId: $data['product_id'],
            fromWarehouseId: $data['from_warehouse_id'],
            toWarehouseId: $data['to_warehouse_id'],
            quantity: $data['quantity'],
            notes: $data['notes'] ?? null,
            userId: $request->user()?->id
        );

        return response()->json(['status' => 'ok']);
    }

    /*
    |--------------------------------------------------------------------------
    | RESERVAR ESTOQUE (CHECKOUT / CARRINHO)
    |--------------------------------------------------------------------------
    */
    public function reserve(Request $request)
    {
        $data = $request->validate([
            'product_id' => ['required', 'integer'],
            'warehouse_id' => ['required', 'integer'],
            'quantity' => ['required', 'integer', 'min:1'],
            'ttl_minutes' => ['nullable', 'integer'],
            'notes' => ['nullable', 'string'],
        ]);

        $reservation = $this->reservationService->reserve(
            productId: $data['product_id'],
            warehouseId: $data['warehouse_id'],
            quantity: $data['quantity'],
            notes: $data['notes'] ?? null,
            userId: $request->user()?->id,
            ttlMinutes: $data['ttl_minutes'] ?? 30
        );

        return response()->json($reservation);
    }

    /*
    |--------------------------------------------------------------------------
    | CONFIRM RESERVATION (VIRA VENDA)
    |--------------------------------------------------------------------------
    */
    public function confirmReservation(string $uuid)
    {
        $reservation = \App\Models\StockReservation::where('uuid', $uuid)->firstOrFail();

        $result = $this->reservationService->confirm($reservation);

        return response()->json($result);
    }

    /*
    |--------------------------------------------------------------------------
    | CANCEL RESERVATION
    |--------------------------------------------------------------------------
    */
    public function cancelReservation(string $uuid)
    {
        $reservation = \App\Models\StockReservation::where('uuid', $uuid)->firstOrFail();

        $result = $this->reservationService->cancel($reservation);

        return response()->json($result);
    }
}

