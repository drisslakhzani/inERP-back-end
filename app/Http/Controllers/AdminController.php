<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\ClientRequest;

class AdminController extends Controller
{
    public function toggleRequestStatus($clientId, $requestId)
    {
        $request = ClientRequest::findOrFail($requestId);
        $request->status = !$request->status;
        $request->save();

        return redirect()->back()->with('success', 'Status toggled successfully.');
    }
}

