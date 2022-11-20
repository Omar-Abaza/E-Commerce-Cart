<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Products\ProductController;
use App\Http\Controllers\Categories\CategoryController;

Route::resource('categories', CategoryController::class);
Route::resource('products', ProductController::class);


Route::group(['prefix'=>'auth'], function(){

    Route::post('register', [RegisterController::class, 'action']);
    Route::post('login', [LoginController::class, 'action']);
});

