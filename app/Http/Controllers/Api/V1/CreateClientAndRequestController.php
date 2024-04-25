<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\ClientRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\ClientWelcomeMail;

class CreateClientAndRequestController extends Controller
{
    /**
     * Store a newly created client and client request in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            $clientData = $request->input('clientData');
            $clientData['generatedCode'] = $clientData['generatedCode'];

            $client = Client::create($clientData);

            $requestDetails = $request->input('requestDetails');
            $requestDetails['clients_id'] = $client->id;

            // Convert selectedSolutions to JSON
            $selectedSolutions = json_encode($requestDetails['selectedSolutions']);
            $requestDetails['selectedSolutions'] = $selectedSolutions;

            // Ensure solutionType is treated as a string
            $requestDetails['solutionType'] = strval($requestDetails['solutionType']);

            // Insert into the database
            $clientRequest = ClientRequest::create($requestDetails);

            // Commit the transaction if everything is successful
            DB::commit();

            // Send the email to the client
            $emailData = [
                'firstName' => $clientData['firstName'],
                'service' => $requestDetails['selectedSolutions'][0]['solution'],
                'generatedCode' => $clientData['generatedCode']
            ];

            Mail::to($clientData['email'])->send(new ClientWelcomeMail($emailData));

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['error' => $e->getMessage()], 422);
        }
    }
}
