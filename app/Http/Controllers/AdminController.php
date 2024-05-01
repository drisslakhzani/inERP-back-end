<?php

// app/Http/Controllers/AdminController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
class AdminController extends Controller
{
    public function index()
    {
        $admin = Admin::first();
        return view('admin.index', compact('admin'));
    }

    public function show()
    {
        $admin = Admin::first();
        return response()->json($admin);
    }

    public function edit()
    {
        $admin = Admin::first();
        return view('admin.edit', compact('admin'));
    }

    // AdminController.php

    public function update(Request $request)
    {
        // Find the admin record
        $admin = Admin::first();

        // Validate the request data
        $request->validate([
            'adminName' => 'required|string',
            'login' => 'required|string|unique:admins,login,' . $admin->id,
            'phoneNumber' => 'required|string',
            // Add validation rules for other fields as needed
        ]);

        // Update the adminName, login, and phoneNumber fields
        $admin->adminName = $request->adminName;
        $admin->login = $request->login;
        $admin->phoneNumber = $request->phoneNumber;

        // Check if a new password is provided and not empty
        if ($request->filled('password')) {
            // Hash the new password
            $hashedPassword = Hash::make($request->password);
            // Update the password field with the hashed password
            $admin->password = $hashedPassword;
        }

        // Save the updated admin record
        $admin->save();

        return redirect()->route('admin.edit')->with('success', 'Admin data updated successfully');
    }


    public function register(Request $request)
    {
        // Validate the request data
        $request->validate([
            'adminName' => 'required|string',
            'login' => 'required|string|unique:admins',
            'password' => 'required|string|min:6',
            'phoneNumber' => 'required|string',
            // Add validation rules for other fields as needed
        ]);

        // Hash the password
        $hashedPassword = Hash::make($request->password);

        // Create a new admin record with the hashed password
        $admin = new Admin([
            'adminName' => $request->adminName,
            'login' => $request->login,
            'password' => $hashedPassword,
            'phoneNumber' => $request->phoneNumber,
            // Add other fields here
        ]);

        // Save the admin record
        $admin->save();

        // Redirect or return response as needed
    }


}
