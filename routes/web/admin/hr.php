<?php

use App\Http\Controllers\Admin\HR\DepartmentController;
use App\Http\Controllers\Admin\HR\EmployeeController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified', 'employee'])
    ->prefix('admin/hr')
    ->name('admin.hr.')
    ->group(function () {
        Route::get('/employees', [EmployeeController::class, 'index'])
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

        Route::put('/departments/{department}', [DepartmentController::class, 'update'])
            ->middleware('permission:edit departments')
            ->name('departments.update');

        Route::delete('/departments/{department}', [DepartmentController::class, 'destroy'])
            ->middleware('permission:delete departments')
            ->name('departments.destroy');
    });
