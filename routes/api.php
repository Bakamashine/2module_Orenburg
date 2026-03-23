<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::controller(\App\Http\Controllers\Api\AuthController::class)
    ->group(function () {
        Route::post("/login", 'Login');
        Route::post("/register", 'Register');
    });

Route::controller(\App\Http\Controllers\Api\CategoryController::class)
    ->prefix("categories")
    ->group(function () {
        Route::get("", 'get');
        Route::get("{category}/products", 'getProduct');

    });

Route::controller(\App\Http\Controllers\Api\ProductController::class)
    ->prefix('products')
    ->group(function () {
        Route::get("{product}", 'getById');
        Route::post("{product}/buy", 'buy')
            ->middleware('auth:sanctum');
    });

Route::middleware('auth:sanctum')
    ->group(function () {
        Route::controller(\App\Http\Controllers\Api\OrderController::class)
            ->name('orders')
            ->group(function () {
                Route::get("/orders", 'getUserOrder');
            });
    });
