<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Client;
use App\Models\ClientRequest;
use Illuminate\Support\Facades\Mail;
use App\Mail\ClientWelcomeMail;

class createClientAndRequestController extends Controller
{
    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            $clientData = $request->input('clientData');
            $clientData['generatedCode'] = $clientData['generatedCode'];

            $client = Client::create($clientData);

            $requestDetails = $request->input('requestDetails');
            $requestDetails['clients_id'] = $client->id;

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
