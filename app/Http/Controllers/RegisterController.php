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
        return view('daftar'); // Pastikan Anda sudah memiliki view daftar.blade.php
    }
    public function register(Request $request)
    {
        // Validasi data
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
        ]);

        // Jika validasi gagal
        if ($validator->fails()) {
            return redirect()->route('daftar')
                ->withErrors($validator) // Mengirimkan pesan kesalahan ke tampilan
                ->withInput(); // Mengirimkan kembali input yang sudah dimasukkan
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
