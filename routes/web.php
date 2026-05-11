<?php

use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Auth\SessionController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RegisterController;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

// ================================//
//  Página home                   //
// ================================//
Route::get('/', [HomeController::class, 'index'])->name('home');

// ================================//
//  Carrinho de compras           //
// ================================//
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');

Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');

Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');

Route::post('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');

// ================================//
//  Bloco de cadastro de usuarios //
// ================================//
Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisterController::class, 'create'])->name('register');
    Route::post('/register', [RegisterController::class, 'store']);
});

// ================================//
//  Bloco de login de usuarios    //
// ================================//
Route::middleware('guest')->group(function () {
    Route::get('/login', [SessionController::class, 'create'])->name('login');
    Route::post('/login', [SessionController::class, 'store']);
});

Route::post('/logout', [SessionController::class, 'destroy'])->name('logout');

// ================================//
//  Bloco de verificacao de email //
// ================================//
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

// ================================//
//  Bloco de redefinicao de senha //
// ================================//
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

// ================================//
//  Bloco Administrativo          //
// ================================//
// Route::prefix('admin')
// ->middleware(['auth', 'role:admin'])->group(function () {

//     Route::get('/admin', [DashboardController::class, 'index'])
//         ->middleware(['auth', 'verified'])
//         ->name('admin.dashboard');
//     // todas as rotas aqui viram /admin/...
//     Route::resource('products', AdminProductController::class);

//     Route::resource('users', AdminUserController::class);

//     Route::resource('categories', AdminCategoryController::class);
// });
Route::prefix('admin')->middleware(['auth', 'verified'])->group(function () {

    Route::get('/admin', [DashboardController::class, 'index'])
        ->middleware('permission:view dashboard')
        ->name('admin.dashboard');

    // ================================//
    // Products                       //
    // ================================//

    Route::get('/products', [AdminProductController::class, 'index'])
        ->middleware('permission:view products')
        ->name('products.index');

    Route::get('/products/create', [AdminProductController::class, 'create'])
        ->middleware('permission:create products')
        ->name('products.create');

    Route::post('/products', [AdminProductController::class, 'store'])
        ->middleware('permission:create products')
        ->name('products.store');

    Route::get('/products/{product}', [AdminProductController::class, 'show'])
        ->middleware('permission:view products')
        ->name('products.show');

    Route::get('/products/{product}/edit', [AdminProductController::class, 'edit'])
        ->middleware('permission:edit products')
        ->name('products.edit');

    Route::put('/products/{product}', [AdminProductController::class, 'update'])
        ->middleware('permission:edit products')
        ->name('products.update');

    Route::delete('/products/{product}', [AdminProductController::class, 'destroy'])
        ->middleware('permission:delete products')
        ->name('products.destroy');

    // ================================//
    // Categories                     //
    // ================================//

    Route::get('/categories', [AdminCategoryController::class, 'index'])
        ->middleware('permission:view categories')
        ->name('categories.index');

    Route::get('/categories/create', [AdminCategoryController::class, 'create'])
        ->middleware('permission:create categories')
        ->name('categories.create');

    Route::post('/categories', [AdminCategoryController::class, 'store'])
        ->middleware('permission:create categories')
        ->name('categories.store');

    Route::get('/categories/{category}', [AdminCategoryController::class, 'show'])
        ->middleware('permission:view categories')
        ->name('categories.show');

    Route::get('/categories/{category}/edit', [AdminCategoryController::class, 'edit'])
        ->middleware('permission:edit categories')
        ->name('categories.edit');

    Route::put('/categories/{category}', [AdminCategoryController::class, 'update'])
        ->middleware('permission:edit categories')
        ->name('categories.update');

    Route::delete('/categories/{category}', [AdminCategoryController::class, 'destroy'])
        ->middleware('permission:delete categories')
        ->name('categories.destroy');

    // ================================//
    // Users                          //
    // ================================//

    Route::get('/users', [AdminUserController::class, 'index'])
        ->middleware('permission:view users')
        ->name('users.index');

    Route::get('/users/create', [AdminUserController::class, 'create'])
        ->middleware('permission:create users')
        ->name('users.create');

    Route::post('/users', [AdminUserController::class, 'store'])
        ->middleware('permission:create users')
        ->name('users.store');

    Route::get('/users/{user}', [AdminUserController::class, 'show'])
        ->middleware('permission:view users')
        ->name('users.show');

    Route::get('/users/{user}/edit', [AdminUserController::class, 'edit'])
        ->middleware('permission:edit users')
        ->name('users.edit');

    Route::put('/users/{user}', [AdminUserController::class, 'update'])
        ->middleware('permission:edit users')
        ->name('users.update');

    Route::delete('/users/{user}', [AdminUserController::class, 'destroy'])
        ->middleware('permission:delete users')
        ->name('users.destroy');

});
