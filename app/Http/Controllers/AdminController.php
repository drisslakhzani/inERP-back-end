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
            'whatsappNumber' => 'required|string',
            'email' => 'required|email',
            'facebook' => 'nullable|string',
            'instagram' => 'nullable|string',
            'linkedIn' => 'nullable|string',
            'twitter' => 'nullable|string',
            'locationAddress' => 'required|string',
            // Add validation rules for other fields as needed
        ]);

        // Update all fields
        $admin->adminName = $request->adminName;
        $admin->login = $request->login;
        $admin->phoneNumber = $request->phoneNumber;
        $admin->whatsappNumber = $request->whatsappNumber;
        $admin->email = $request->email;
        $admin->facebook = $request->facebook;
        $admin->instagram = $request->instagram;
        $admin->linkedIn = $request->linkedIn;
        $admin->twitter = $request->twitter;
        $admin->locationAddress = $request->locationAddress;

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

    public function getAdminData()
    {
        // Find the admin record
        $admin = Admin::first();

        // Exclude login and password fields from the response
        $adminData = [
            'adminName' => $admin->adminName,
            'phoneNumber' => $admin->phoneNumber,
            'whatsappNumber' => $admin->whatsappNumber,
            'email' => $admin->email,
            'facebook' => $admin->facebook,
            'instagram' => $admin->instagram,
            'linkedIn' => $admin->linkedIn,
            'twitter' => $admin->twitter,
            'locationAddress' => $admin->locationAddress,
            'created_at' => $admin->created_at,
            'updated_at' => $admin->updated_at,
        ];

        return response()->json($adminData);
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
