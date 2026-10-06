<?php

use App\Http\Controllers\Admin\Purchasing\SupplierController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified', 'employee'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/suppliers', [SupplierController::class, 'index'])
            ->middleware('permission:view suppliers')
            ->name('suppliers.index');

        Route::get('/suppliers/create', [SupplierController::class, 'create'])
            ->middleware('permission:create suppliers')
            ->name('suppliers.create');

        Route::post('/suppliers', [SupplierController::class, 'store'])
            ->middleware('permission:create suppliers')
            ->name('suppliers.store');

        Route::get('/suppliers/{supplier}', [SupplierController::class, 'show'])
            ->middleware('permission:view suppliers')
            ->name('suppliers.show');

        Route::get('/suppliers/{supplier}/edit', [SupplierController::class, 'edit'])
            ->middleware('permission:edit suppliers')
            ->name('suppliers.edit');

        Route::put('/suppliers/{supplier}', [SupplierController::class, 'update'])
            ->middleware('permission:edit suppliers')
            ->name('suppliers.update');

        Route::delete('/suppliers/{supplier}', [SupplierController::class, 'destroy'])
            ->middleware('permission:delete suppliers')
            ->name('suppliers.destroy');
    });
