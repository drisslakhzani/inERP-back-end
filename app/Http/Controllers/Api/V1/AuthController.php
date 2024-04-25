<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Client;

class AuthController extends Controller
{
    /**
     * Handle an authentication attempt.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        try {
            // Validate incoming request
            $validator = Validator::make($request->all(), [
                'firstName' => 'required|string|max:255',
                'generatedCode' => 'required|string|max:255',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validation error',
                    'errors' => $validator->errors()
                ], 401);
            }

            // Use the Client model explicitly
            $client = Client::where('firstName', $request->firstName)
                ->where('generatedCode', $request->generatedCode)
                ->first();

            if (!$client) {
                return response()->json([
                    'status' => false,
                    'message' => 'Username and code do not match our records',
                ], 401);
            }

            // Generate token
            $token = $client->createToken('API_TOKEN')->plainTextToken;

            return response()->json([
                'status' => true,
                'message' => 'Login successful',
                'clientId' => $client->id,
                'token' => $token,
            ], 200);
        } catch (\Throwable $exception) {
            return response()->json([
                'status' => false,
                'message' => $exception->getMessage(),
            ], 500);
        }
    }

    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        // Revoke the current user's access token using Sanctum
        $request->user()->tokens()->delete();

        // Return success message
        return response()->json(['message' => 'Successfully logged out'], 200);
    }
}
