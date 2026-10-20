<?php

use App\Http\Controllers\Auth\System\BootstrappingController;
use Illuminate\Support\Facades\Route;

Route::get('/bootstrap', [BootstrappingController::class, 'create'])
    ->name('bootstrap.create');

Route::post('/bootstrap', [BootstrappingController::class, 'store'])
    ->name('bootstrap.store');
