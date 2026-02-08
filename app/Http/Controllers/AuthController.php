<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash; // Import Hash for password encryption
use Illuminate\Support\Facades\Validator; // Import Validator for request validation
use App\Models\User; // Import User model
use Laravel\Sanctum\HasApiTokens; // For Sanctum token creation

class AuthController extends Controller
{

    public function index()

    {
        // Get the authenticated admin user
        $admin = Auth::user();

        // Ensure that an admin is logged in
        if ($admin) {
            return view('admin.dashboard', compact('admin'));
        } else {
            return redirect()->route('admin_login')->with('error', 'You must be logged in to access the admin dashboard.');
        }
    }
    public function showLoginForm()
    {
        return view('admin.login'); // Assuming your login view is in resources/views/auth/login.blade.php
    }

    // Method to handle login logic
    public function admin_login(Request $request)
    {
        // Validate the input fields
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        // Attempt to log in the admin user
        if (Auth::attempt([
            'email' => $request->email,
            'password' => $request->password,
            'is_admin' => 1, // Ensure this user is an admin
        ])) {
            // If successful, redirect to the admin dashboard
            return redirect()->intended('/admin/dashboard');
        }

        // If authentication fails, redirect back with an error message
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records or you are not an admin.',
        ])->withInput($request->only('email'));
    }
    public function admin_logout(Request $request)
    {
        // Call the Auth facade directly to logout
        Auth::logout();

        // Invalidate the session
        $request->session()->invalidate();

        // Regenerate the CSRF token
        $request->session()->regenerateToken();

        // Redirect to the login page
        return redirect('/login_form');
    }


    }
