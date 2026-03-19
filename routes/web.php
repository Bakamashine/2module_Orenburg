<?php

use Illuminate\Support\Facades\Route;

Route::middleware("guest")->group(function () {
    Route::controller(\App\Http\Controllers\AuthController::class)
        ->group(function () {
            Route::get("/login", 'LoginView')->name("login");
            Route::post("/login", 'Login')->name("login.store");
            Route::post("/logout", 'Logout')->name("logout.store")->withoutMiddleware('guest');
        });
});

Route::view("/", 'index')->name('main');

Route::middleware('auth')
    ->group(function () {
        Route::resource('category', \App\Http\Controllers\CategoryController::class);
        Route::controller(\App\Http\Controllers\ProductController::class)
            ->prefix("product")
            ->name('product')
            ->group(function () {
                Route::get('category/{category}', 'index')->name('.index');
                Route::get("{category}/create", 'create')->name('.create');
                Route::post("{category}", 'store')->name('.store');
                Route::get("edit/{product}", 'edit')->name('.edit');
                Route::put('update/{product}', 'update')->name('.update');
                Route::delete('delete/{product}', 'destroy')->name('.destroy');
            });
    });
