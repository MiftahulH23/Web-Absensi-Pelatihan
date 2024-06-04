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
        'latitude' => 'required|numeric',
        'longitude' => 'required|numeric',
    ]);
 // Kantor pusat Bank Riau Kepri Syariah
 $officeLat = 0.5194026673876408;
 $officeLon = 101.44655290848155;
 $radius = 100; // Radius dalam meter

 // Mendapatkan lokasi pengguna
 $userLat = $request->input('latitude');
 $userLon = $request->input('longitude');

 // Periksa apakah pengguna berada dalam radius yang diizinkan
 if ($this->isWithinRadius($userLat, $userLon, $officeLat, $officeLon, $radius)) {
    // Attempt to authenticate user
    if (Auth::attempt($request->only('email', 'password'))) {
        // Authentication successful
        return redirect()->route('home.index');
    } else {
        // Authentication failed, redirect back with error message
        return redirect()->back()->with('error', 'Email atau password tidak valid.');
    }
} else {
    // Jika Lokasi pengguna tidak diizinkan
    return redirect()->back()->with('error', 'Akses ditolak. Anda berada di luar lokasi yang diizinkan.');
}
}
private function isWithinRadius($lat1, $lon1, $lat2, $lon2, $radius)
    {
        $R = 6371000; // Radius bumi dalam meter
        $dLat = deg2rad($lat2 - $lat1);
        $dLon = deg2rad($lon2 - $lon1);
        $a = sin($dLat / 2) * sin($dLat / 2) +
            cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
            sin($dLon / 2) * sin($dLon / 2);
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
        $distance = $R * $c; // Jarak dalam meter
        return $distance <= $radius;
    }

    public function logout(Request $request)
    {
        Auth::logout(); // Proses logout
        $request->session()->invalidate(); // Invalidate session
        $request->session()->regenerateToken(); // Regenerate token

        return redirect()->route('login'); // Redirect ke halaman login setelah logout
    }
}
