<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;

use App\Models\ClientRequest;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function toggleRequestStatus($clientId, $requestId)
    {
        $request = ClientRequest::findOrFail($requestId);
        $request->status = !$request->status;
        $request->save();

        return redirect()->back()->with('success', 'Status toggled successfully.');
    }

    public function downloadFileByName($fileName)
    {
        // Find the admin by file name
        $admin = Admin::where('file_name', $fileName)->firstOrFail();

        // Download the file if it exists
        if ($admin->file_name && Storage::exists('path/to/files/' . $admin->file_name)) {
            return response()->download(storage_path('app/path/to/files/' . $admin->file_name));
        }

        // File not found
        return abort(404);
    }
}

