<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\client\StoreClientRequest;
use App\Http\Requests\client\UpdateClientRequest;
use App\Http\Requests\client_request\StoreClientRequestsRequest;
use App\Http\Requests\client_request\UpdateClientRequestsRequest;
use App\Http\Resources\ClientRequestResource;
use App\Models\ClientRequest;


class ClientRequestController extends Controller
{
    public function index()
    {
        return ClientRequestResource::collection(ClientRequest::all());
    }

    public function show(ClientRequest $clientRequest)
    {
        return ClientRequestResource::make($clientRequest);
    }
    public function store(StoreClientRequestsRequest $request)
    {
        $requestData = $request->validated();

        // Ensure selectedSolutions is properly encoded as JSON
        $selectedSolutions = $requestData['selectedSolutions'];
        if (is_array($selectedSolutions)) {
            $requestData['selectedSolutions'] = json_encode($selectedSolutions);
        }

        $client = ClientRequest::create($requestData); // Use $requestData here
        return response()->json($client, 201);
    }

    public function getClientRequests($clientId)
    {
        // Retrieve client requests based on the provided client ID
        $clientRequests = ClientRequest::where('clients_id', $clientId)->get();

        // Check if client requests were found
        if ($clientRequests->isEmpty()) {
            return response()->json(['message' => 'No requests found for the specified client ID'], 404);
        }

        // Return the client requests as JSON data
        return response()->json(['requests' => $clientRequests], 200);
    }





    public function update(UpdateClientRequestsRequest $request, ClientRequest $clientRequest){
        $clientRequest->update($request->validated());
        return ClientRequestResource::make($clientRequest);
    }
    public function destroy(ClientRequest $clientRequest){
        $clientRequest->delete();
        return response()->noContent();
    }

}
