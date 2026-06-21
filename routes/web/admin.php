<?php

use App\Http\Controllers\Admin\Category\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\Dashboard\DashboardController;
use App\Http\Controllers\Admin\Orders\OrderController;
use App\Http\Controllers\Admin\Products\ProductController;
use App\Http\Controllers\Admin\Users\UserController as AdminUserController;
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

                Route::get('/', [AdminCategoryController::class, 'index'])
                    ->middleware('permission:view categories')
                    ->name('index');

                Route::get('/create', [AdminCategoryController::class, 'create'])
                    ->middleware('permission:create categories')
                    ->name('create');

                Route::post('/', [AdminCategoryController::class, 'store'])
                    ->middleware('permission:create categories')
                    ->name('store');

                Route::get('/{category}', [AdminCategoryController::class, 'show'])
                    ->middleware('permission:view categories')
                    ->name('show');

                Route::get('/{category}/edit', [AdminCategoryController::class, 'edit'])
                    ->middleware('permission:edit categories')
                    ->name('edit');

                Route::put('/{category}', [AdminCategoryController::class, 'update'])
                    ->middleware('permission:edit categories')
                    ->name('update');

                Route::delete('/{category}', [AdminCategoryController::class, 'destroy'])
                    ->middleware('permission:delete categories')
                    ->name('destroy');
            });

        // ================================//
        //              Users              //
        // ================================//

        Route::prefix('users')
            ->name('users.')
            ->group(function () {

                Route::get('/', [AdminUserController::class, 'index'])
                    ->middleware('permission:view users')
                    ->name('index');

                Route::get('/create', [AdminUserController::class, 'create'])
                    ->middleware('permission:create users')
                    ->name('create');

                Route::post('/', [AdminUserController::class, 'store'])
                    ->middleware('permission:create users')
                    ->name('store');

                Route::get('/{user}', [AdminUserController::class, 'show'])
                    ->middleware('permission:view users')
                    ->name('show');

                Route::get('/{user}/edit', [AdminUserController::class, 'edit'])
                    ->middleware('permission:edit users')
                    ->name('edit');

                Route::put('/{user}', [AdminUserController::class, 'update'])
                    ->middleware('permission:edit users')
                    ->name('update');

                Route::delete('/{user}', [AdminUserController::class, 'destroy'])
                    ->middleware('permission:delete users')
                    ->name('destroy');
            });

        // ================================//
        //              Orders             //
        // ================================//
        Route::prefix('orders')
            ->name('orders.')
            ->group(function () {

                Route::get('/', [OrderController::class, 'index'])
                    ->middleware('permission:view orders')
                    ->name('index');

                Route::get('/{order}', [OrderController::class, 'show'])
                    ->middleware('permission:view orders')
                    ->name('show');
            });
    });
