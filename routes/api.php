<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {

    // Authentication Routes
    Route::controller(AuthController::class)->prefix('/auth')->group(function () {
        Route::post('/signup', 'signup')->name('signup')->withoutMiddleware('auth:sanctum');
        Route::post('/login', 'login')->name('login')->withoutMiddleware('auth:sanctum');
        Route::get('/logout', 'logout')->name('logout');
    });

    Route::apiResource('/users', UserController::class);
});