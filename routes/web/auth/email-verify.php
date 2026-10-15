<?php

use App\Http\Controllers\Auth\EmailVerificationController;
use Illuminate\Support\Facades\Route;
// ================================//
// Email Verification
// ================================//

Route::middleware('auth')
    ->prefix('email')
    ->name('verification.')
    ->group(function () {

        Route::get('/verify', [EmailVerificationController::class, 'notice'])
            ->name('notice');

        Route::get('/verify/{id}/{hash}', [EmailVerificationController::class, 'verify'])
            ->middleware('signed')
            ->name('verify');

        Route::post('/verification-notification', [EmailVerificationController::class, 'send'])
            ->middleware('throttle:6,1')
            ->name('send');
    });
