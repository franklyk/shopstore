<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\EmailVerificationController;
use App\Http\Controllers\Auth\PasswordResetController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\SessionController;

// ================================//
// Register
// ================================//

Route::middleware('guest')
    ->name('register.')
    ->group(function () {

        Route::get('/register', [RegisterController::class, 'create'])
            ->name('create');

        Route::post('/register', [RegisterController::class, 'store'])
            ->name('store');
    });

// ================================//
// Session / Login
// ================================//

Route::middleware('guest')->name('login.')->group(function () {

        Route::get('/login', [SessionController::class, 'create'])
            ->name('create');

        Route::post('/login', [SessionController::class, 'store'])
            ->name('store');
    });

Route::post('/logout', [SessionController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');

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