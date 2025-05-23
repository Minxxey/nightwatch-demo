<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CandybarController;

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('candybars', CandybarController::class);
});

Route::post('/login', [AuthController::class, 'login']);

Route::middleware(\App\Http\Middleware\DelayMiddleware::class)->group(function () {
    Route::get('/slow-route', function() {
        return json_encode('slow route');
    });
});
