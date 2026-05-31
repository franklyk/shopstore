<?php

use App\Http\Controllers\Shipment\ShipmentController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])
    ->prefix('admin')
    ->name('admin.shipments.')
    ->group(function () {

        Route::get(
            '/shipments',
            [ShipmentController::class, 'index']
        )->name('index');

        Route::get(
            '/shipments/{shipment}',
            [ShipmentController::class, 'show']
        )->name('show');

        Route::post(
            '/shipments/{shipment}/process',
            [ShipmentController::class, 'process']
        )->name('process');

        Route::post(
            '/shipments/{shipment}/ship',
            [ShipmentController::class, 'ship']
        )->name('ship');

        Route::post(
            '/shipments/{shipment}/deliver',
            [ShipmentController::class, 'deliver']
        )->name('deliver');

        Route::post(
            '/shipments/{shipment}/return',
            [ShipmentController::class, 'markAsReturned']
        )->name('return');
    });