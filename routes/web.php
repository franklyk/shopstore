<?php

use App\Http\Controllers\Auth\SessionController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

/**
 * start pagina home
 */
Route::get('/', function () {
    return view('home');
})->name('home');
/**
 * end pagina home
 */

/*********************************************************************************** */
/*********************************************************************************** */
/**Bloco de cadastro de usuarios */
/*********************************************************************************** */
/*********************************************************************************** */

Route::middleware('guest')->group(function () {

    Route::get('/register', [RegisterController::class, 'create'])->name('register');
    Route::post('/register', [RegisterController::class, 'store']);

});
/*********************************************************************************** */
/**Bloco de verificacao de email */
/*********************************************************************************** */
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect()->route('home');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('success', 'Novo link enviado!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');
/*********************************************************************************** */
/**Bloco de verificacao de email */
/*********************************************************************************** */

/*********************************************************************************** */
/*********************************************************************************** */
/**Bloco de cadastro de usuarios */
/*********************************************************************************** */
/*********************************************************************************** */
Route::middleware('guest')->group(function () {

    Route::get('/login', [SessionController::class, 'create'])->name('login');
    Route::post('/login', [SessionController::class, 'store']);

});

Route::post('/logout', [SessionController::class, 'destroy'])->name('logout');

/*************************************************************************** */
/*************************************************************************** */
/* Bloco de redefinicao de senha */
/*************************************************************************** */
Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
})->middleware('guest')->name('password.request');

Route::post('/forgot-password', function (Request $request) {
    $request->validate(['email' => 'required|email']);

    $status = Password::sendResetLink(
        $request->only('email')
    );

    return $status === Password::ResetLinkSent
        ? back()->with(['status' => __($status)])
        : back()->withErrors(['email' => __($status)]);
})->middleware('guest')->name('password.email');

Route::get('/reset-password/{token}', function (string $token) {
    return view('auth.reset-password', ['token' => $token]);
})->middleware('guest')->name('password.reset');

Route::post('/reset-password', function (Request $request) {
    $request->validate([
        'token' => 'required',
        'email' => 'required|email',
        'password' => 'required|min:8|confirmed',
    ]);

    $status = Password::reset(
        $request->only('email', 'password', 'password_confirmation', 'token'),
        function (User $user, string $password) {
            $user->forceFill([
                'password' => Hash::make($password),
            ])->setRememberToken(Str::random(60));

            $user->save();

            event(new PasswordReset($user));
        }
    );

    return $status === Password::PasswordReset
    ? redirect()
        ->route('login')
        ->with('success', 'Senha redefinida com sucesso!')
    : back()->withErrors(['email' => [__($status)]]);
})->middleware('guest')->name('password.update');
/*************************************************************************** */
/*************************************************************************** */
/* Bloco de redefinicao de senha */
/*************************************************************************** */
/*************************************************************************** */

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified']);

Route::middleware(['auth', 'verified'])->group(function () {
    
    Route::resource('products', ProductController::class);

    Route::resource('users', UserController::class);

    Route::resource('categories', CategoryController::class);

});

/*************************************************************************** */
/*************************************************************************** */
/*************************************************************************** */
