<?php

use App\Http\Controllers\Auth\FirstLoginPasswordController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')
    ->prefix('password')
    ->name('password.first-login.')
    ->group(function () {
        Route::get('/first-login', [
            FirstLoginPasswordController::class,
            'edit',
        ])->name('edit');

        Route::put('/first-login', [
            FirstLoginPasswordController::class,
            'update',
        ])->name('update');
    });
