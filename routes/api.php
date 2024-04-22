<?php

use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\ClientController;
use App\Http\Controllers\Api\V1\ClientRequestController;
use App\Http\Controllers\Api\V1\ClientRequestStatusController;
use App\Http\Controllers\Api\V1\CreateClientAndRequestController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::post('/login', [AuthController::class, 'login']);

    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::apiResource('/clients', ClientController::class);
        Route::apiResource('client_requests', ClientRequestController::class);
        Route::patch('/client_requests/{client_request}/status', ClientRequestStatusController::class);
        Route::post('/create-client-and-request', [CreateClientAndRequestController::class, 'store']);
    });
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
