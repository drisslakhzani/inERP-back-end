<?php

use App\Models\Client;
use App\Models\Request as ModelsRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/', function (Request $request) {
//     return view('admin.index');
// });

Route::get('/admin/dashboard/clients', function (Client $clients, ModelsRequest $request) {
    $clients = Client::all();
    return view('admin.index', ['clients'=> $clients ,'requests'=>$request]);
});


