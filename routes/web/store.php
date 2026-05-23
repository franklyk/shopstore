<?php 


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Store\Cart\CartController as StoreCartController;
use App\Http\Controllers\Store\Category\CategoryController as StoreCategoryController;
use App\Http\Controllers\Store\HomeController as StoreHomeController;
use App\Http\Controllers\Store\Products\ProductController as StoreProductController;

// ================================//
//            Loja                 //
// ================================//
Route::get('/', [StoreHomeController::class, 'index'])->name('home');

Route::get('/products', [StoreProductController::class, 'index'])
    ->name('products.public.index');

Route::get('/produto/{product:slug}', [StoreProductController::class, 'show'])
    ->name('products.public.show');

Route::get('/categories/{slug}', [StoreCategoryController::class, 'show'])
    ->name('categories.public.show');

// ================================//
//   Carrinho de compras           //
// ================================//
Route::get('/cart', [StoreCartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{product}', [StoreCartController::class, 'add'])->name('cart.add');
Route::post('/cart/update/{id}', [StoreCartController::class, 'update'])->name('cart.update');
Route::delete('/cart/remove/{id}', [StoreCartController::class, 'remove'])->name('cart.remove');

// ================================//
//            Loja                 //
// ================================//
