<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;

class ClientController extends Controller
{
    public function store(Request $request)
    {
        // Validate the incoming request data if needed
        
        // Generate a random code
        $generated_code = Client::RandomizeCode();
        
        // Create a new client instance
        $client = new Client();
        $client->user_name = $request->input('user_name');
        $client->generated_code = $generated_code;
        $client->company_name = $request->input('company_name');
        $client->save();

        // Return a response indicating success
        return response()->json(['message' => 'Client created successfully', 'generated_code' => $generated_code], 201);
    }
}
