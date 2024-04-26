<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\ClientRequest;
use Illuminate\Http\Request;

class ClientRequestWebController extends Controller
{
    public function getClientRequests()
    {

        $clients = Client::all();
        $clientRequest = ClientRequest::all();
        $clientRequests = [];

        foreach ($clients as $client) {
            $clientRequests[$client->id] = ClientRequest::where('clients_id', $client->id)->get();
        }

        return view('admin.index', [
            'clientRequests' => $clientRequests,
            'clientRequest' => $clientRequest
        ]);
    }
}
