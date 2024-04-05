<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\ClientRequest;
use Illuminate\Http\Request;

class ClientRequestController extends Controller
{
    public function toggleFlags($clientId, $requestId)
    {
        $clientRequest = ClientRequest::find($requestId);

        // Toggle the flags
        $this->toggleFlagIfEmpty($clientRequest, 'sage', 'sage_flag');
        $this->toggleFlagIfEmpty($clientRequest, 'infrastructure', 'infrastructure_flag');
        $this->toggleFlagIfEmpty($clientRequest, 'microsoft', 'microsoft_flag');
        $this->toggleFlagIfEmpty($clientRequest, 'material', 'material_flag');

        // Save the changes
        $clientRequest->save();

        // Check if all flags are true
        $allFlagsTrue = $this->checkAllFlagsTrue($clientRequest);

        // Redirect back to the previous page
        return redirect()->back();
    }

    public function updateStatus($clientId)
    {
        $clientRequests = ClientRequest::where('client_id', $clientId)->get();

        // Check if all flags are true for any request
        $status = false;
        foreach ($clientRequests as $request) {
            if ($this->checkAllFlagsTrue($request)) {
                $status = true;
                break;
            }
        }

        // Update the status of the client
        $client = Client::find($clientId);
        $client->status = $status;
        $client->save();

        // Redirect back to the previous page
        return redirect()->back();
    }

    private function toggleFlagIfEmpty($clientRequest, $jsonField, $flagField)
    {
        if (empty($clientRequest->$jsonField)) {
            $clientRequest->$flagField = true;
        } else {
            $clientRequest->$flagField = !$clientRequest->$flagField;
        }
    }

    private function checkAllFlagsTrue($clientRequest)
    {
        return $clientRequest->sage_flag && $clientRequest->infrastructure_flag && $clientRequest->microsoft_flag && $clientRequest->material_flag;
    }
}
