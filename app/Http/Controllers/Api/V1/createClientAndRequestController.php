<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\ClientRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class createClientAndRequestController extends Controller
{
    /**
     * Store a newly created client and client request in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        // Start a database transaction
        DB::beginTransaction();

        try {
            // Create the client
            $client = Client::create($request->input('clientData'));

            // Attach the client ID to the request details
            $requestDetails = $request->input('requestDetails');
            $requestDetails['clients_id'] = $client->id;

            // Create the client request
            $clientRequest = ClientRequest::create($requestDetails);

            // Commit the transaction if everything is successful
            DB::commit();

            // Return a success response
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            // If any error occurs, rollback the transaction
            DB::rollback();

            // Return an error response with the error message
            return response()->json(['error' => $e->getMessage()], 422);
        }
    }
}
