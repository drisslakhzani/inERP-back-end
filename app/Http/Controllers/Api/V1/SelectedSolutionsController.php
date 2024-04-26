<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\ClientRequest;
use Illuminate\Http\Request;

class SelectedSolutionsController extends Controller
{
    public function updateSelectedSolutions(Request $request)
    {
        // Validate incoming request data if needed

        // Retrieve clientId and selectedSolutions from the request
        $clientId = $request->input('clientId');
        $selectedSolutions = $request->input('selectedSolutions');

        // Update the existing selectedSolutions for the specified clientId
        $clientRequest = ClientRequest::where('clients_id', $clientId)->first();
        if ($clientRequest) {
            $clientRequest->selectedSolutions = $selectedSolutions;
            $clientRequest->save();
            return response()->json(['message' => 'Selected solutions updated successfully'], 200);
        } else {
            return response()->json(['error' => 'Client request not found'], 404);
        }
    }
}
