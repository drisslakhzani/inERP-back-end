<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;

class  LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // Retrieve the login and password from the request
        $credentials = $request->only('login', 'password');

        // Retrieve the admin record based on the login
        $admin = Admin::where('login', $credentials['login'])->first();

        // Check if admin record exists and if the providepassword matches the hashed password
        if ($admin && Hash::check($credentials['password'], $admin->password)) {
            // Authenticate the admin
            Auth::guard('admin')->login($admin);

            // Redirect to the admin dashboard or intended URL
            return redirect()->route('admin.edit');
        }

        // If authentication fails, redirect back with an error message
        return redirect()->route('login')->with('error', 'Invalid credentials');
    }


    public function logout(Request $request)
    {
        Auth::guard('admin')->logout(); // Logout the admin user using the configured guard
        $request->session()->invalidate(); // Invalidate the session
        $request->session()->regenerateToken(); // Regenerate the CSRF token

        return redirect()->route('login'); // Redirect to the login page
    }


}
