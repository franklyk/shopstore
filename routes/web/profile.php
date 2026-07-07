<?php

use App\Http\Controllers\User\Address\AddressController;
use App\Http\Controllers\User\Orders\OrderController;
use App\Http\Controllers\User\Profile\ProfileController;
use App\Http\Controllers\Store\Payments\PaymentController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->prefix('profile')->name('profile.')->group(function () {

    Route::get('/', [ProfileController::class, 'show'])
        ->name('show');

    Route::get('/edit', [ProfileController::class, 'edit'])
        ->name('edit');

    Route::put('/', [ProfileController::class, 'update'])
        ->name('update');

    Route::resource('addresses', AddressController::class)
        ->except('show');

    Route::patch('/addresses/{address}/default', [AddressController::class, 'setDefault'])->name('addresses.default');

    Route::get('/orders', [OrderController::class, 'index'])
        ->name('orders.index');

    Route::get('/orders/{order}', [OrderController::class, 'show'])
        ->name('orders.show');

    Route::post('/orders/{order}/pay', [PaymentController::class, 'pay'])
        ->name('orders.pay');

});
