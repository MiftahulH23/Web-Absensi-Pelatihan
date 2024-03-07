<?php

namespace App\Http\Controllers;

use App\Models\absenPeserta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class absenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'norek' => 'required|string|max:255',
            'nik' => 'required|string|max:255',
            'levelJabatan' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'unitKantor' => 'required|string|max:255',
            'foto' => 'required|string|max:255',
            'ttd' => 'required|string|max:255',
        ]); 
        
        $absenPeserta = absenPeserta::create([
            'nama' => $request->input('nama'),
            'norek' => $request->input('norek'),
            'nik' => $request->input('nik'),
            'levelJabatan' => $request->input('levelJabatan'),
            'jabatan' => $request->input('jabatan'),
            'unitKantor' => $request->input('unitKantor'),
            'foto' => $request->input('foto'),
            'ttd' => $request->input('ttd'),
        ]);

        // Redirect atau berikan respons sesuai kebutuhan
        return redirect()->route('absen.index')->with('success', 'Data berhasil disimpan');
    
    }

    /**
     * Display the specified resource.
     */
    public function show(absenPeserta $absenPeserta)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(absenPeserta $absenPeserta)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, absenPeserta $absenPeserta)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(absenPeserta $absenPeserta)
    {
        //
    }
}
