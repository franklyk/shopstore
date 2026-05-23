<?php 


use App\Http\Controllers\Admin\Category\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\Products\ProductController as AdminProductController;
use App\Http\Controllers\Admin\Users\UserController as AdminUserController;
use Illuminate\Support\Facades\Route;

// ================================//// ================================//
//                          BLOCO ADMINISTRATIVO                        //
// ================================//// ================================//
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

    // ================================//// ================================//
    //                          BLOCO ADMINISTRATIVO                        //
    // ================================//// ================================//
});
