<?php

use App\Http\Controllers\Admin\Stock\StockController;
use App\Http\Controllers\Admin\Stock\StockReceiptController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified', 'employee'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::post('/stock/increase', [StockController::class, 'increase'])
            ->middleware('permission:manage stock')
            ->name('stock.increase');

        Route::post('/stock/decrease', [StockController::class, 'decrease'])
            ->middleware('permission:manage stock')
            ->name('stock.decrease');

        Route::post('/stock/transfer', [StockController::class, 'transfer'])
            ->middleware('permission:manage stock')
            ->name('stock.transfer');

        Route::post('/stock/receipt', [StockReceiptController::class, 'store'])
            ->middleware('permission:manage stock')
            ->name('stock.receipt.store');

        Route::post('/stock/receipt/{uuid}/item', [StockReceiptController::class, 'addItem'])
            ->middleware('permission:manage stock')
            ->name('stock.receipt.item');

        Route::post('/stock/receipt/{uuid}/confirm', [StockReceiptController::class, 'confirm'])
            ->middleware('permission:manage stock')
            ->name('stock.receipt.confirm');

        Route::post('/stock/receipt/{uuid}/cancel', [StockReceiptController::class, 'cancel'])
            ->middleware('permission:manage stock')
            ->name('stock.receipt.cancel');
    });
