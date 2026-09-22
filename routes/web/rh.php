<?php

use App\Http\Controllers\Admin\Users\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified', 'employee'])
    ->prefix('admin/hr')
    ->name('admin.hr.')
    ->group(function () {

        Route::get('/employees', [UserController::class, 'employees'])
            ->middleware('permission:view users')
            ->name('employees.index');
    });
