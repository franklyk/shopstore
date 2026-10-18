
<?php

use App\Http\Controllers\Auth\EmailVerificationController;
use App\Http\Controllers\Auth\EmailVerificationCodeController;
use Illuminate\Support\Facades\Route;

// ================================
// Email Verification
// ================================

Route::middleware('auth')
    ->prefix('email')
    ->name('verification.')
    ->group(function () {

        // Verificação por link — fluxo existente
        Route::get('/verify/{id}/{hash}', [EmailVerificationController::class, 'verify'])
            ->middleware('signed')
            ->name('verify');

        Route::post('/verification-notification', [EmailVerificationController::class, 'send'])
            ->middleware('throttle:6,1')
            ->name('send');

        // Verificação por código — novo fluxo
        Route::get('/verify', [EmailVerificationCodeController::class, 'create'])
            ->name('notice');

        Route::post('/verify-code', [EmailVerificationCodeController::class, 'store'])
            ->middleware('throttle:6,1')
            ->name('code.store');

        Route::post('/resend-code', [EmailVerificationCodeController::class, 'resend'])
            ->middleware('throttle:3,1')
            ->name('code.resend');
    });
