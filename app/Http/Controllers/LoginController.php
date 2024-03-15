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
            if (Hash::check($request->password, $user->password)) {
                // Authenticated successfully
                return redirect()->route('beranda');
            } else {
                // Password salah, redirect kembali dengan pesan kesalahan
                return redirect()->back()->with('error', 'Password yang Anda masukkan salah');
            }
        } else {
            // Pengguna tidak ditemukan, redirect kembali dengan pesan kesalahan
            return redirect()->back()->with('error', 'Email yang Anda masukkan tidak terdaftar');
        }
    }
}
