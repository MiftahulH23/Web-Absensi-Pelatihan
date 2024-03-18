<?php

namespace App\Http\Controllers;

use App\Models\Absen;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AbsenController extends Controller
{
    public function index(): View
    {
        //get posts
        $absens = Absen::all();
        //render view with posts
        return view('detailAbsens', compact('absens'));
    }
    
    public function create(): View
    {
        return view('form');
    }

    public function selesai()
    {
        return view('selesai'); // Pastikan Anda sudah memiliki view daftar.blade.php
    }
    
    public function store(Request $request): RedirectResponse
    {
        //validate form
        $this->validate($request, [
            'nama' => 'required|string|max:255',
            'norek' => 'required|string|max:255',
            'nik' => 'required|string|max:255',
            'levelJabatan' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'unitKantor' => 'required|string|max:255',
            'foto' => 'required|image|mimes:jpeg,jpg,png|max:2048',
            'ttd' => 'required|string', // ubah menjadi string
        ]);

        //upload image
        $image = $request->file('foto');
        $image->storeAs('public/absens', $image->hashName());

        //create post
        $absen = Absen::create([
            'nama' => $request->nama,
            'norek' => $request->norek,
            'nik' => $request->nik,
            'levelJabatan' => $request->levelJabatan,
            'jabatan' => $request->jabatan,
            'unitKantor' => $request->unitKantor,
            'foto' => $image->hashName(),
            'ttd' => $request->ttd, // menyimpan tanda tangan yang diterima dari form
        ]);
        
        if ($absen) {
            return redirect()->route('selesai')->with(['success' => 'Data Berhasil Disimpan!']);
        }
        
        return redirect()->route('absen.create')->with(['success' => 'Data gagal Disimpan!']);
    }

    
}
