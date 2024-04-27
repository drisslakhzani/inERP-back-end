<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\ClientRequest;
use Illuminate\Http\Request;

class SelectedSolutionsController extends Controller
{
    public function updateSelectedSolutions(Request $request, $clientId)
    {
        $clientRequest = ClientRequest::where('clients_id', $clientId)->first();
        if ($clientRequest) {
            $selectedSolutions = $request->json()->all(); // Extract the array of selected solutions directly
            $currentSelectedSolutions = $clientRequest->selectedSolutions ?? [];

            // Check if $currentSelectedSolutions is an array or initialize as empty array
            if (!is_array($currentSelectedSolutions)) {
                $currentSelectedSolutions = [];
            }

            // Merge only if both $selectedSolutions and $currentSelectedSolutions are arrays
            $clientRequest->selectedSolutions = array_merge($currentSelectedSolutions, $selectedSolutions);
            $clientRequest->save();
            return response()->json(['message' => 'Selected solutions updated successfully'], 200);
        } else {
            return response()->json(['error' => 'Client request not found'], 404);
        }
    }
}
