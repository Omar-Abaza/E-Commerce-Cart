<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\MeController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Cart\CartController;
use App\Http\Controllers\Categories\CategoryController;
use App\Http\Controllers\Products\ProductController;
use Illuminate\Support\Facades\Route;

Route::resource('categories', CategoryController::class);
Route::resource('products', ProductController::class);


Route::group(['prefix' => 'auth'], function () {

    Route::post('register', [RegisterController::class, 'action']);
    Route::post('login', [LoginController::class, 'action']);
    Route::get('me', [MeController::class, 'action']);
});


Route::resource('cart', CartController::class, [
    'parameters' => [
        'cart' => 'productVariation'
    ]
]);
