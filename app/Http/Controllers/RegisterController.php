<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('daftar'); 
    }

    public function register(Request $request)
{
    // Validasi data
    $validator = Validator::make($request->all(), [
        'name' => 'required',
        'email' => 'required|email|unique:users',
        'password' => [
            'required',
            'min:8',
            'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]+$/'
        ],
    ], [
        'name.required' => 'Nama harus diisi.',
        'email.required' => 'Email harus diisi.',
        'email.email' => 'Format email tidak valid.',
        'email.unique' => 'Email sudah digunakan.',
        'password.required' => 'Password harus diisi.',
        'password.min' => 'Password minimal harus 8 karakter.',
        'password.regex' => 'Gunakan kombinasi huruf, angka, dan karakter khusus',
    ]);

    // Jika validasi gagal
    if ($validator->fails()) {
        // Ambil pesan kesalahan detail
        $errorMessages = $validator->errors()->all();
        
        // Gabungkan pesan kesalahan menjadi satu pesan
        $errorMessage = implode('', $errorMessages);

        // Set pesan kesalahan dalam session
        return redirect()->route('daftar')->with('error_message', $errorMessage);
    }

    // Jika validasi sukses, lanjutkan dengan membuat pengguna baru
    $user = new User();
    $user->name = $request->name;
    $user->email = $request->email;
    $user->password = Hash::make($request->password);
    $user->save();

    return redirect()->route('login'); 
}
}