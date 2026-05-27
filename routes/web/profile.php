<?php

use App\Http\Controllers\Profile\AddressController;
use App\Http\Controllers\Profile\ProfileController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->prefix('profile')->name('profile.')->group(function () {

    Route::get('/', [ProfileController::class, 'show'])
        ->name('show');

    Route::get('/edit', [ProfileController::class, 'edit'])
        ->name('edit');

    Route::put('/', [ProfileController::class, 'update'])
        ->name('update');

    Route::resource('addresses', AddressController::class);

    Route::patch('/addresses/{address}/default',[AddressController::class, 'setDefault'])->name('addresses.default');

});
