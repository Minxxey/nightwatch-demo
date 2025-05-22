<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CandybarController;

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('candybars', CandybarController::class);
});

Route::post('/login', [AuthController::class, 'login']);
