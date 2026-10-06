<?php

use App\Http\Controllers\Admin\Operations\OrderController;
use App\Http\Controllers\Admin\Operations\ShipmentController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified', 'employee'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/orders', [OrderController::class, 'index'])
            ->middleware('permission:view orders')
            ->name('orders.index');

        Route::get('/orders/{order}', [OrderController::class, 'show'])
            ->middleware('permission:view orders')
            ->name('orders.show');

        Route::get('/shipments', [ShipmentController::class, 'index'])
            ->middleware('permission:view orders')
            ->name('shipments.index');

        Route::get('/shipments/{shipment}', [ShipmentController::class, 'show'])
            ->middleware('permission:view orders')
            ->name('shipments.show');

        Route::post('/shipments/{shipment}/pick', [ShipmentController::class, 'pick'])
            ->middleware('permission:view orders')
            ->name('shipments.pick');

        Route::post('/shipments/{shipment}/pack', [ShipmentController::class, 'pack'])
            ->middleware('permission:view orders')
            ->name('shipments.pack');

        Route::post('/shipments/{shipment}/dispatch', [ShipmentController::class, 'dispatch'])
            ->middleware('permission:view orders')
            ->name('shipments.dispatch');

        Route::post('/shipments/{shipment}/ship', [ShipmentController::class, 'ship'])
            ->middleware('permission:view orders')
            ->name('shipments.ship');

        Route::post('/shipments/{shipment}/deliver', [ShipmentController::class, 'deliver'])
            ->middleware('permission:view orders')
            ->name('shipments.deliver');

        Route::post('/shipments/{shipment}/return', [ShipmentController::class, 'markAsReturned'])
            ->middleware('permission:view orders')
            ->name('shipments.return');
    });
