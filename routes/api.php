<?php

namespace App\Http\Controllers\Api\V1;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::prefix('v1')->group(function () {
    Route::middleware('auth:sanctum')->group(function () {
        Route::apiResource('/clients', ClientController::class);
        Route::apiResource('client_requests', ClientRequestController::class);
        Route::patch('/client_requests/{client_request}/status', ClientRequestStatusController::class);
        Route::get('/client/{id}', [ClientController::class, 'getClientDataAndRequests']);
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::put('/clients/{id}', [ClientController::class, 'update']);
        Route::get('/client_requests/{clientId}/requests', [ClientRequestController::class, 'getClientRequests']);
        Route::put('/update-selected-solutions/{clientId}', [SelectedSolutionsController::class, 'updateSelectedSolutions']);
    });
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/create-client-and-request', [createClientAndRequestController::class, 'store']);
    Route::post('/posts', [PostController::class, 'store']);
    Route::get('/posts', [PostController::class, 'index']);
    Route::get('/posts/{id}', [PostController::class, 'show']);
    Route::get('/admin/data', [AdminController::class, 'getAdminData']);
});
Route::get('/admin', [AdminController::class, 'show']);
