<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// forbidden response
Route::get('login', fn() => response()->unauthorized())->name('login');

Route::middleware('auth:sanctum')->group(function () {

    // Authentication Routes
    Route::controller(AuthController::class)->prefix('/auth')->group(function () {
        Route::post('/signup', 'signup')->withoutMiddleware('auth:sanctum');
        Route::post('/login', 'login')->withoutMiddleware('auth:sanctum');
        Route::get('/logout', 'logout');
    });

    Route::apiResource('/users', UserController::class);
});