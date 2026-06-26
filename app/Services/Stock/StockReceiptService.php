<?php

namespace App\Services\Stock;

use App\Enums\StockReceiptStatus;
use App\Models\StockReceipt;
use App\Models\StockReceiptItem;
use App\Services\StockService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class StockReceiptService
{
    /*
    |--------------------------------------------------------------------------
    | CREATE DRAFT
    |--------------------------------------------------------------------------
    */
    public function create(int $warehouseId, ?int $userId = null, ?string $notes = null): StockReceipt
    {
        return StockReceipt::create([
            'uuid' => (string) \Str::ulid(),
            'warehouse_id' => $warehouseId,
            'status' => StockReceiptStatus::DRAFT,
            'notes' => $notes,
            'user_id' => $userId,
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | ADD ITEM
    |--------------------------------------------------------------------------
    */
    public function addItem(StockReceipt $receipt, int $productId, int $quantity): StockReceiptItem
    {
        if ($receipt->status !== StockReceiptStatus::DRAFT) {
            throw ValidationException::withMessages([
                'receipt' => 'Only draft receipts can be modified.',
            ]);
        }

        return $receipt->items()->create([
            'product_id' => $productId,
            'quantity' => $quantity,
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | CONFIRM RECEIPT (INCREASE STOCK)
    |--------------------------------------------------------------------------
    */
    public function confirm(StockReceipt $receipt): void
    {
        DB::transaction(function () use ($receipt) {

            if ($receipt->status !== StockReceiptStatus::DRAFT) {
                throw ValidationException::withMessages([
                    'receipt' => 'Receipt already processed.',
                ]);
            }

            $receipt->load('items');

            foreach ($receipt->items as $item) {
                app(StockService::class)->increase(
                    productId: $item->product_id,
                    warehouseId: $receipt->warehouse_id,
                    quantity: $item->quantity,
                    notes: 'Stock receipt confirmed',
                    reference: [
                        'type' => 'stock_receipt',
                        'id' => $receipt->id,
                    ],
                    userId: $receipt->user_id
                );
            }

            $receipt->update([
                'status' => StockReceiptStatus::CONFIRMED,
            ]);
        });
    }

    /*
    |--------------------------------------------------------------------------
    | CANCEL RECEIPT
    |--------------------------------------------------------------------------
    */
    public function cancel(StockReceipt $receipt): void
    {
        if ($receipt->status !== StockReceiptStatus::DRAFT) {
            throw ValidationException::withMessages([
                'receipt' => 'Only draft receipts can be cancelled.',
            ]);
        }

        $receipt->update([
            'status' => StockReceiptStatus::CANCELLED,
        ]);
    }
}
