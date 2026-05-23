<?php 

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\EmailVerificationController;
use App\Http\Controllers\Auth\PasswordResetController;
use App\Http\Controllers\Auth\RegisterController as AuthRegisterController;
use App\Http\Controllers\Auth\SessionController;


// ================================//
//  Bloco de cadastro de usuarios //
// ================================//
Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthRegisterController::class, 'create'])->name('register');
    Route::post('/register', [AuthRegisterController::class, 'store']);
});

// ================================//
//  Bloco de login de usuarios     //
// =============================== //
Route::middleware('guest')->group(function () {
    Route::get('/login', [SessionController::class, 'create'])->name('login');
    Route::post('/login', [SessionController::class, 'store']);
});

Route::post('/logout', [SessionController::class, 'destroy'])->name('logout');

// ================================//
//  Bloco de verificacao de email  //
// ================================//

Route::middleware('auth')->group(function () {

    Route::get('/email/verify', [EmailVerificationController::class, 'notice'])
        ->name('verification.notice');

    Route::get('/email/verify/{id}/{hash}', [EmailVerificationController::class, 'verify'])
        ->middleware('signed')
        ->name('verification.verify');

    Route::post('/email/verification-notification', [EmailVerificationController::class, 'send'])
        ->middleware('throttle:6,1')
        ->name('verification.send');

});
// ================================//
//  Bloco de redefinicao de senha  //
// ================================//

Route::middleware('guest')->group(function () {

    Route::get('/forgot-password', [PasswordResetController::class, 'forgotPassword'])
        ->name('password.request');

    Route::post('/forgot-password', [PasswordResetController::class, 'sendResetLink'])
        ->name('password.email');

    Route::get('/reset-password/{token}', [PasswordResetController::class, 'resetPassword'])
        ->name('password.reset');

    Route::post('/reset-password', [PasswordResetController::class, 'updatePassword'])
        ->name('password.update');

});

