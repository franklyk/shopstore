<?php

use App\Http\Controllers\Admin\System\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified', 'employee'])
    ->prefix('admin/system')
    ->name('admin.system.')
    ->group(function () {
        Route::get('/users', [UserController::class, 'index'])
            ->middleware('permission:view users')
            ->name('users.index');

        Route::get('/users/create', [UserController::class, 'create'])
            ->middleware('permission:create users')
            ->name('users.create');

        Route::post('/users/store', [UserController::class, 'store'])
            ->middleware('permission:create users')
            ->name('users.store');

        Route::get('/users/show/{user}', [UserController::class, 'show'])
            ->middleware('permission:view users')
            ->name('users.show');

        Route::get('/users/{user}/edit', [UserController::class, 'edit'])
            ->middleware('permission:edit users')
            ->name('users.edit');

        Route::put('/users/update/{user}', [UserController::class, 'update'])
            ->middleware('permission:edit users')
            ->name('users.update');

        Route::delete('/users/destroy/{user}', [UserController::class, 'destroy'])
            ->middleware('permission:delete users')
            ->name('users.destroy');
    });
