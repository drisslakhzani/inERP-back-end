<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\client\StoreClientRequest;
use App\Http\Requests\client\UpdateClientRequest;
use App\Http\Resources\ClientResource;
use App\Models\Client;

class ClientController extends Controller
{
    public function index()
    {
        return ClientResource::collection(Client::all());
    }

    public function show(Client $client)
    {
        return ClientResource::make($client);
    }
    public function store(StoreClientRequest $request)
    {
        $client = Client::create($request->validated());
        return response()->json($client, 201);
    }

    public function update(UpdateClientRequest $request, Client $client){
        $client->update($request->validated());
        return ClientResource::make($client);
    }
    public function destroy(Client $client){
        $client->delete();
        return response()->noContent();
    }
}
