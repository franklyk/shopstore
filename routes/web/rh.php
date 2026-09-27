<?php

use App\Http\Controllers\Admin\Users\UserController;
use App\Http\Controllers\Department\DepartmentController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified', 'employee'])
    ->prefix('admin/hr')
    ->name('admin.hr.')
    ->group(function () {

        Route::get('/employees', [UserController::class, 'employees'])
            ->middleware('permission:view users')
            ->name('employees.index');

        Route::get('/departments', [DepartmentController::class, 'index'])
            ->middleware('permission:view departments')
            ->name('departments.index');

        Route::get('/departments/{department}', [DepartmentController::class, 'show'])
            ->middleware('permission:view departments')
            ->name('departments.show');

        Route::post('/departments', [DepartmentController::class, 'store'])
            ->middleware('permission:create departments')
            ->name('departments.store');
    });
