<?php

use App\Http\Controllers\Admin\Support\CustomerController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified', 'employee'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/customers', [CustomerController::class, 'index'])
            ->middleware('permission:view customers')
            ->name('customers.index');
    });
