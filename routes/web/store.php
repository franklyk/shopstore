<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Store\Cart\CartController;
use App\Http\Controllers\Store\Category\CategoryController;
use App\Http\Controllers\Store\HomeController;
use App\Http\Controllers\Store\Products\ProductController;

// ================================//
// Home
// ================================//

Route::get('/', [HomeController::class, 'index'])
    ->name('home');

// ================================//
// Products
// ================================//

Route::prefix('products')
    ->name('products.')
    ->group(function () {

        Route::get('/', [ProductController::class, 'index'])
            ->name('index');
    });

Route::get('/produto/{product:slug}', [ProductController::class, 'show'])
    ->name('products.show');

// ================================//
// Categories
// ================================//

Route::prefix('categories')
    ->name('categories.')
    ->group(function () {

        Route::get('/{slug}', [CategoryController::class, 'show'])
            ->name('show');
    });

// ================================//
// Cart
// ================================//

Route::prefix('cart')->name('cart.')->group(function () {

        Route::get('/', [CartController::class, 'index'])
            ->name('index');

        Route::post('/add/{product}', [CartController::class, 'add'])
            ->name('add');

        Route::post('/update/{id}', [CartController::class, 'update'])
            ->name('update');

        Route::delete('/remove/{id}', [CartController::class, 'remove'])
            ->name('remove');
    });