<?php


use App\Http\Controllers\AdminController;
use App\Http\Controllers\Api\V1\ClientController;
use App\Http\Controllers\Api\V1\ClientRequestController;
use App\Http\Controllers\ClientRequestWebController;
use App\Models\Client;
use App\Models\ClientRequest as ModelsRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
// routes/web.php

use App\Http\Controllers\LoginController;

Route::middleware(['auth'])->group(function () {

});
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.perform');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/client/samirbaha/driss/123', [ClientRequestWebController::class, 'getClientRequests'])->name('getClientRequests');
Route::get('/client/{clientId}', [ClientRequestWebController::class, 'getClientDetails'])->name('client.details');
 Route::get('/client', [ClientRequestWebController::class, 'getClientRequests'])->name('getClientRequests');
Route::put('/client-request/{requestId}/toggle-status', [ClientRequestWebController::class, 'toggleStatus']);
Route::delete('/client-request/{requestId}/delete-solution/{solutionIndex}', [ClientRequestWebController::class, 'deleteSolution'])->name('client-request.delete-solution');
Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
Route::get('/admin/edit', [AdminController::class, 'edit'])->name('admin.edit');
Route::put('/admin/update', [AdminController::class, 'update'])->name('admin.update');









//Route::get('/admin/dashboard/clients', function () {
//
//    $new_clients = Client::whereHas('clientRequests', function ($query) {
//        $query->where('status', false);
//    })->get();
//    $all_clients = Client::whereHas('clientRequests', function ($query) {
//        $query->where('status', true);
//    })->get();
//
//    return view('admin.index', ['new_clients' => $new_clients , 'all_clients' =>$all_clients]);
//})->name('clients.all');
//
//
//Route::get('/admin/dashboard/clients/{client}', function ($clientId) {
//    $client = Client::findOrFail($clientId);
//    $requests = ModelsRequest::where('clients_id', $clientId)->get();
//    return view('admin.client', ['client' => $client, 'requests' => $requests]);
//})->name('clients.individual');
//
//Route::post('/admin/dashboard/clients/{clientId}/requests/{requestId}/toggle-status', [AdminController::class, 'toggleRequestStatus'])->name('requests.toggle-status');
//
//// for adding the files in the database
//Route::get('/admin/download/{fileName}', [AdminController::class, 'downloadFileByName'])->name('admin.download.file');
//
//// Route for storing a new client
//Route::post('/api/clients', [ClientController::class, 'store']);
//
//// Route for storing a new client request
//Route::post('/api/client_requests', [ClientRequestController::class, 'store']);
