<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Products\ProductController;
use App\Http\Controllers\Categories\CategoryController;

Route::resource('categories', CategoryController::class);
Route::resource('products', ProductController::class);
