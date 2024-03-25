<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function loginForm()
    {
        return view('masuk');
    }

    public function login(Request $request)
    {
         // Validation
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    // Attempt to authenticate user
    if (Auth::attempt($request->only('email', 'password'))) {
        // Authentication successful
        return redirect()->route('home.index');
    } else {
        // Authentication failed, redirect back with error message
        return redirect()->back()->with('error', 'Email atau password tidak valid.');
    }
    }

    public function logout(Request $request)
    {
        Auth::logout(); // Proses logout
        $request->session()->invalidate(); // Invalidate session
        $request->session()->regenerateToken(); // Regenerate token

        return redirect()->route('login'); // Redirect ke halaman login setelah logout
    }
}
