<?php

use App\Http\Controllers\Admin\Commercial\BrandController;
use App\Http\Controllers\Admin\Commercial\CategoryController;
use App\Http\Controllers\Admin\Commercial\CollectionController;
use App\Http\Controllers\Admin\Commercial\ProductController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified', 'employee'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/products', [ProductController::class, 'index'])
            ->middleware('permission:view products')
            ->name('products.index');

        Route::post('/products', [ProductController::class, 'store'])
            ->middleware('permission:create products')
            ->name('products.store');

        Route::get('/products/{product}', [ProductController::class, 'show'])
            ->middleware('permission:view products')
            ->name('products.show');

        Route::put('/products/{product}', [ProductController::class, 'update'])
            ->middleware('permission:edit products')
            ->name('products.update');

        Route::delete('/products/{product}', [ProductController::class, 'destroy'])
            ->middleware('permission:delete products')
            ->name('products.destroy');

        ///////////////////////////////////////////////////////////////////////

        ///////////////////////////////////////////////////////////////////////

        Route::get('/categories', [CategoryController::class, 'index'])
            ->middleware('permission:view categories')
            ->name('categories.index');

        Route::get('/categories/create', [CategoryController::class, 'create'])
            ->middleware('permission:create categories')
            ->name('categories.create');

        Route::post('/categories', [CategoryController::class, 'store'])
            ->middleware('permission:create categories')
            ->name('categories.store');

        Route::get('/categories/{category}', [CategoryController::class, 'show'])
            ->middleware('permission:view categories')
            ->name('categories.show');

        Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])
            ->middleware('permission:edit categories')
            ->name('categories.edit');

        Route::put('/categories/{category}', [CategoryController::class, 'update'])
            ->middleware('permission:edit categories')
            ->name('categories.update');

        Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])
            ->middleware('permission:delete categories')
            ->name('categories.destroy');

        ///////////////////////////////////////////////////////////////////////

        ///////////////////////////////////////////////////////////////////////

        Route::get('/collections', [CollectionController::class, 'index'])
            ->middleware('permission:view collections')
            ->name('collections.index');

        Route::get('/collections/create', [CollectionController::class, 'create'])
            ->middleware('permission:create collections')
            ->name('collections.create');

        Route::post('/collections', [CollectionController::class, 'store'])
            ->middleware('permission:create collections')
            ->name('collections.store');

        Route::get('/collections/{collection}', [CollectionController::class, 'show'])
            ->middleware('permission:view collections')
            ->name('collections.show');

        Route::get('/collections/{collection}/edit', [CollectionController::class, 'edit'])
            ->middleware('permission:edit collections')
            ->name('collections.edit');

        Route::put('/collections/{collection}', [CollectionController::class, 'update'])
            ->middleware('permission:edit collections')
            ->name('collections.update');

        Route::delete('/collections/{collection}', [CollectionController::class, 'destroy'])
            ->middleware('permission:delete collections')
            ->name('collections.destroy');


    });
