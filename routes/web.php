<?php


use App\Http\Controllers\AdminController;
use App\Http\Controllers\Api\V1\ClientController;
use App\Http\Controllers\Api\V1\ClientRequestController;
use App\Http\Controllers\ClientRequestWebController;
use App\Models\Client;
use App\Models\ClientRequest as ModelsRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('/test/client', function (Request $request) {
    return view('admin.client');
});

Route::get('/client', [ClientRequestWebController::class, 'getClientRequests'])->name('getClientRequests');

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
