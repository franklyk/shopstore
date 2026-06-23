<?php

use App\Http\Controllers\Admin\Category\CategoryController;
use App\Http\Controllers\Admin\Dashboard\DashboardController;
use App\Http\Controllers\Admin\Orders\OrderController;
use App\Http\Controllers\Admin\Products\ProductController;
use App\Http\Controllers\Admin\Users\UserController;
use App\Http\Controllers\Collection\CollectionController;
use App\Http\Controllers\Import\ImportBatchController;
use App\Http\Controllers\Supplier\SupplierController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // ================================//
        // Dashboard
        // ================================//

        Route::get('/', [DashboardController::class, 'index'])
            ->middleware('permission:view dashboard')
            ->name('dashboard');

        // ================================//
        // Products
        // ================================//

        Route::prefix('products')
            ->name('products.')
            ->group(function () {

                Route::get('/', [ProductController::class, 'index'])
                    ->middleware('permission:view products')
                    ->name('index');

                Route::get('/create', [ProductController::class, 'create'])
                    ->middleware('permission:create products')
                    ->name('create');

                Route::post('/store', [ProductController::class, 'store'])
                    ->middleware('permission:create products')
                    ->name('store');

                Route::get('/show/{product}', [ProductController::class, 'show'])
                    ->middleware('permission:view products')
                    ->name('show');

                Route::get('/{product}/edit', [ProductController::class, 'edit'])
                    ->middleware('permission:edit products')
                    ->name('edit');

                Route::put('/update/{product}', [ProductController::class, 'update'])
                    ->middleware('permission:edit products')
                    ->name('update');

                Route::delete('/destroy/{product}', [ProductController::class, 'destroy'])
                    ->middleware('permission:delete products')
                    ->name('destroy');
            });

        // ================================//
        // Categories
        // ================================//

        Route::prefix('categories')
            ->name('categories.')
            ->group(function () {

                Route::get('/', [CategoryController::class, 'index'])
                    ->middleware('permission:view categories')
                    ->name('index');

                Route::get('/create', [CategoryController::class, 'create'])
                    ->middleware('permission:create categories')
                    ->name('create');

                Route::post('/store', [CategoryController::class, 'store'])
                    ->middleware('permission:create categories')
                    ->name('store');

                Route::get('/show/{category}', [CategoryController::class, 'show'])
                    ->middleware('permission:view categories')
                    ->name('show');

                Route::get('/{category}/edit', [CategoryController::class, 'edit'])
                    ->middleware('permission:edit categories')
                    ->name('edit');

                Route::put('/update/{category}', [CategoryController::class, 'update'])
                    ->middleware('permission:edit categories')
                    ->name('update');

                Route::delete('/destroy/{category}', [CategoryController::class, 'destroy'])
                    ->middleware('permission:delete categories')
                    ->name('destroy');
            });

        // ================================//
        // Users
        // ================================//

        Route::prefix('users')
            ->name('users.')
            ->group(function () {

                Route::get('/', [UserController::class, 'index'])
                    ->middleware('permission:view users')
                    ->name('index');

                Route::get('/create', [UserController::class, 'create'])
                    ->middleware('permission:create users')
                    ->name('create');

                Route::post('/store', [UserController::class, 'store'])
                    ->middleware('permission:create users')
                    ->name('store');

                Route::get('/show/{user}', [UserController::class, 'show'])
                    ->middleware('permission:view users')
                    ->name('show');

                Route::get('/{user}/edit', [UserController::class, 'edit'])
                    ->middleware('permission:edit users')
                    ->name('edit');

                Route::put('/update/{user}', [UserController::class, 'update'])
                    ->middleware('permission:edit users')
                    ->name('update');

                Route::delete('/destroy/{user}', [UserController::class, 'destroy'])
                    ->middleware('permission:delete users')
                    ->name('destroy');
            });

        // ================================//
        // Orders
        // ================================//

        Route::prefix('orders')
            ->name('orders.')
            ->group(function () {

                Route::get('/', [OrderController::class, 'index'])
                    ->middleware('permission:view orders')
                    ->name('index');

                Route::get('/show/{order}', [OrderController::class, 'show'])
                    ->middleware('permission:view orders')
                    ->name('show');
            });

        // ================================//
        // Suppliers
        // ================================//

        Route::prefix('suppliers')
            ->name('suppliers.')
            ->group(function () {

                Route::get('/', [SupplierController::class, 'index'])
                    ->middleware('permission:view suppliers')
                    ->name('index');

                Route::get('/create', [SupplierController::class, 'create'])
                    ->middleware('permission:create suppliers')
                    ->name('create');

                Route::post('/store', [SupplierController::class, 'store'])
                    ->middleware('permission:create suppliers')
                    ->name('store');

                Route::get('/show/{supplier}', [SupplierController::class, 'show'])
                    ->middleware('permission:view suppliers')
                    ->name('show');

                Route::get('/{supplier}/edit', [SupplierController::class, 'edit'])
                    ->middleware('permission:edit suppliers')
                    ->name('edit');

                Route::put('/update/{supplier}', [SupplierController::class, 'update'])
                    ->middleware('permission:edit suppliers')
                    ->name('update');

                Route::delete('/destroy/{supplier}', [SupplierController::class, 'destroy'])
                    ->middleware('permission:delete suppliers')
                    ->name('destroy');
            });

        // ================================//
        // Collections
        // ================================//

        Route::prefix('collections')
            ->name('collections.')
            ->group(function () {

                Route::get('/', [CollectionController::class, 'index'])
                    ->middleware('permission:view collections')
                    ->name('index');

                Route::get('/create', [CollectionController::class, 'create'])
                    ->middleware('permission:create collections')
                    ->name('create');

                Route::post('/store', [CollectionController::class, 'store'])
                    ->middleware('permission:create collections')
                    ->name('store');

                Route::get('/show/{collection}', [CollectionController::class, 'show'])
                    ->middleware('permission:view collections')
                    ->name('show');

                Route::get('/{collection}/edit', [CollectionController::class, 'edit'])
                    ->middleware('permission:edit collections')
                    ->name('edit');

                Route::put('/update/{collection}', [CollectionController::class, 'update'])
                    ->middleware('permission:edit collections')
                    ->name('update');

                Route::delete('/destroy/{collection}', [CollectionController::class, 'destroy'])
                    ->middleware('permission:delete collections')
                    ->name('destroy');
            });

        Route::prefix('imports')
            ->name('imports.')
            ->group(function () {

                Route::get('/', [ImportBatchController::class, 'index'])
                    ->name('index');

                Route::get('/create', [ImportBatchController::class, 'create'])
                    ->name('create');

                Route::post('/store', [ImportBatchController::class, 'store'])
                    ->name('store');

                Route::get('/{importBatch}', [ImportBatchController::class, 'show'])
                    ->name('show');

                Route::get('/{importBatch}/pdf', [ImportBatchController::class, 'pdf'])
                    ->name('pdf');

                Route::post('/{importBatch}/process', [ImportBatchController::class, 'process'])
                    ->name('process');
            });

    });
