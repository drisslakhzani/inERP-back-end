<?php
namespace App\Http\Controllers\Api\V1;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::prefix('v1')->group(function () {
    Route::apiResource('/clients', ClientController::class);
    Route::apiResource('client_requests', ClientRequestController::class);
    Route::patch('/client_requests/{client_request}/status', ClientRequestStatusController::class);
    Route::post('/create-client-and-request', [createClientAndRequestController::class, 'store']);
});

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
