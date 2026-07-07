<?php

namespace App\Http\Controllers\Admin\Stock;

use App\Http\Controllers\Controller;
use App\Models\Stock\StockReceipt;
use App\Services\Stock\StockReceiptService;
use Illuminate\Http\Request;

class StockReceiptController extends Controller
{
    public function __construct(
        private StockReceiptService $service
    ) {}

    /*
    |--------------------------------------------------------------------------
    | CREATE DRAFT RECEIPT
    |--------------------------------------------------------------------------
    */
    public function store(Request $request)
    {
        $data = $request->validate([
            'warehouse_id' => ['required', 'integer'],
            'notes' => ['nullable', 'string'],
        ]);

        $receipt = $this->service->create(
            warehouseId: $data['warehouse_id'],
            userId: $request->user()?->id,
            notes: $data['notes'] ?? null
        );

        return response()->json($receipt);
    }

    /*
    |--------------------------------------------------------------------------
    | ADD ITEM
    |--------------------------------------------------------------------------
    */
    public function addItem(Request $request, string $uuid)
    {
        $receipt = StockReceipt::where('uuid', $uuid)->firstOrFail();

        $data = $request->validate([
            'product_id' => ['required', 'integer'],
            'quantity' => ['required', 'integer', 'min:1'],
        ]);

        $item = $this->service->addItem(
            receipt: $receipt,
            productId: $data['product_id'],
            quantity: $data['quantity']
        );

        return response()->json($item);
    }

    /*
    |--------------------------------------------------------------------------
    | CONFIRM RECEIPT (ENTRADA ESTOQUE)
    |--------------------------------------------------------------------------
    */
    public function confirm(string $uuid)
    {
        $receipt = StockReceipt::where('uuid', $uuid)->firstOrFail();

        $this->service->confirm($receipt);

        return response()->json(['status' => 'confirmed']);
    }

    /*
    |--------------------------------------------------------------------------
    | CANCEL RECEIPT
    |--------------------------------------------------------------------------
    */
    public function cancel(string $uuid)
    {
        $receipt = StockReceipt::where('uuid', $uuid)->firstOrFail();

        $this->service->cancel($receipt);

        return response()->json(['status' => 'cancelled']);
    }
}
