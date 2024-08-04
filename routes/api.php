<?php

use App\Http\Controllers\Api\StatisticsController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;

// Routes publiques pour l'authentification
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->middleware('auth:sanctum');

// Routes protégées par Sanctum

    Route::prefix('statistics')->group(function () {
        Route::get('daily', [StatisticsController::class, 'daily']);
        Route::get('weekly', [StatisticsController::class, 'weekly']);
        Route::get('monthly', [StatisticsController::class, 'monthly']);
});
