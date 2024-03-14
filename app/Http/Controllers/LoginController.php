<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

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

        // Check if admin exists
        $user = User::where('email', $request->email)->first();

        if ($user) {
            // Jika pengguna ditemukan, periksa apakah password cocok
            if (password_verify($request->password, $user->password)) {
                // Authentication successful
                return redirect()->route('beranda');
            }
        }

        // Authentication failed, redirect back with error message
        return redirect()->back()->with('error', 'Invalid credentials');
    }
}
