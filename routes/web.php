<?php



use App\Models\Client;
use App\Models\ClientRequest as ModelsRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClientRequestController;

// Route::get('/', function (Request $request) {
//     return view('admin.index');
// });

Route::get('/admin/dashboard/clients', function () {

    $new_clients = Client::whereHas('clientRequests', function ($query) {
        $query->where('status', false);
    })->get();
    $all_clients = Client::whereHas('clientRequests', function ($query) {
        $query->where('status', true); 
    })->get();
    
    return view('admin.index', ['new_clients' => $new_clients , 'all_clients' =>$all_clients]);
})->name('clients.all');


Route::get('/admin/dashboard/clients/{client}', function ($clientId) {
    $client = Client::findOrFail($clientId);
    $requests = ModelsRequest::where('clients_id', $clientId)->get();
    return view('admin.client', ['client' => $client, 'requests' => $requests]);
})->name('clients.individual');

Route::post('/admin/dashboard/clients/{clientId}/requests/{requestId}/toggle-status', [AdminController::class, 'toggleRequestStatus'])->name('requests.toggle-status');

// for adding the files in the database
Route::get('/admin/download/{fileName}', [AdminController::class, 'downloadFileByName'])->name('admin.download.file');

// web.php

Route::post('/toggle-flags/{clientId}/{requestId}', [ClientRequestController::class,'toggleFlags'])->name('toggle.flags');









