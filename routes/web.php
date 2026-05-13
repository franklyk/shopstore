<?php

use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Auth\EmailVerificationController;
use App\Http\Controllers\Auth\PasswordResetController;
use App\Http\Controllers\Auth\RegisterController as AuthRegisterController;
use App\Http\Controllers\Auth\SessionController;
use App\Http\Controllers\Store\CartController as StoreCartController;
use App\Http\Controllers\Store\HomeController as StoreHomeController;
use Illuminate\Support\Facades\Route;


// Route::get('/debug-modal', function () {
//     return view('modal');
// });

/**
 * start pagina home
 */
Route::get('/', [StoreHomeController::class, 'index'])->name('home');

// ================================//
//  Carrinho de compras           //
// ================================//
Route::get('/cart', [StoreCartController::class, 'index'])->name('cart.index');

Route::post('/cart/add/{product}', [StoreCartController::class, 'add'])->name('cart.add');

Route::delete('/cart/remove/{id}', [StoreCartController::class, 'remove'])->name('cart.remove');

Route::post('/cart/update/{id}', [StoreCartController::class, 'update'])->name('cart.update');

// ================================//
//  Bloco de cadastro de usuarios //
// ================================//
Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthRegisterController::class, 'create'])->name('register');
    Route::post('/register', [AuthRegisterController::class, 'store']);
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
//  Bloco de redefinicao de senha //
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


Route::prefix('admin')->middleware(['auth', 'verified'])->group(function () {

    Route::get('/', [DashboardController::class, 'index'])
        ->name('admin.dashboard');

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
