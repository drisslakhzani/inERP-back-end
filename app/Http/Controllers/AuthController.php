<?php

// app/Http/Controllers/AuthController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // Check credentials
        if ($request->username === 'admin' && $request->password === 'password') {
            $request->session()->put('authenticated', true);
            return redirect()->route('getClientRequests');
        } else {
            return redirect()->route('login')->with('error', 'Invalid credentials');
        }
    }

    public function logout(Request $request)
    {
        $request->session()->forget('authenticated');
        return redirect()->route('login');
    }
}
