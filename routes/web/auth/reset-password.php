<?php

use App\Http\Controllers\Auth\PasswordResetController;
use Illuminate\Support\Facades\Route;

// ================================//
// Password Reset
// ================================//

Route::middleware('guest')
    ->name('password.')
    ->group(function () {

        Route::get('/forgot-password', [PasswordResetController::class, 'forgotPassword'])
            ->name('request');

        Route::post('/forgot-password', [PasswordResetController::class, 'sendResetLink'])
            ->name('email');

        Route::get('/reset-password/{token}', [PasswordResetController::class, 'resetPassword'])
            ->name('reset');

        Route::post('/reset-password', [PasswordResetController::class, 'updatePassword'])
            ->name('update');
    });
