<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\ClientRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
class ClientRequestWebController extends Controller
{
    public function getClientDetails($clientId)
    {
        $client = Client::findOrFail($clientId);
        $requests = ClientRequest::where('clients_id', $clientId)->get();

        return view('admin.client', ['client' => $client, 'requests' => $requests]);
    }

    public function getClientRequests()
    {
        $clients = Client::all();
        $clientRequests = [];

        foreach ($clients as $client) {
            $clientRequests[$client->id] = ClientRequest::where('clients_id', $client->id)->get();
        }

        return view('admin.index', ['clientRequests' => $clientRequests]);
    }

    public function toggleStatus(Request $request, $requestId)
    {
        try {
            // Retrieve the client request from the database
            $clientRequest = ClientRequest::findOrFail($requestId);

            // Get the solution index from the request
            $solutionIndex = $request->input('solutionIndex');

            // Get all selected solutions from the database
            $selectedSolutions = $clientRequest->selectedSolutions;

            // Toggle the status of the new solution
            $selectedSolutions[$solutionIndex]['status'] = !$selectedSolutions[$solutionIndex]['status'];

            // Update the selected solutions in the client request
            $clientRequest->selectedSolutions = $selectedSolutions;

            // Check if all task statuses are true
            $allStatusTrue = collect($selectedSolutions)->every(function ($solution) {
                return $solution['status'] === true;
            });

            // Update client request status based on task statuses
            $clientRequest->status = $allStatusTrue;

            // Save the changes
            $clientRequest->save();

            // Return success response
            return response()->json(['message' => 'Status toggled successfully'], 200);
        } catch (\Exception $e) {
            // Handle any errors
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    public function deleteSolution($requestId, $solutionIndex)
    {
        try {
            $clientRequest = ClientRequest::findOrFail($requestId);

            // Remove the selected solution
            $selectedSolutions = $clientRequest->selectedSolutions;
            unset($selectedSolutions[$solutionIndex]);
            $clientRequest->selectedSolutions = array_values($selectedSolutions);
            //needs to change the value when the user adds a new commands ++
            // Save the updated client request
            $clientRequest->save();

            // You might also want to update any other data or perform additional actions here

            return response()->json(['message' => 'Solution deleted successfully'], Response::HTTP_OK);
        } catch (\Exception $e) {
            // Handle any errors
            return response()->json(['error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
