<?php

use App\Http\Controllers\Auth\SessionController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::get('login', [SessionController::class, 'create'])->name('login');
Route::post('login', [SessionController::class, 'store']);
Route::post('logout', [SessionController::class, 'destroy'])->name('logout');

Route::resource('products', ProductController::class);

Route::resource('users', UserController::class);

Route::resource('categories', CategoryController::class);


