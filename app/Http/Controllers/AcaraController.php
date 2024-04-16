<?php

namespace App\Http\Controllers;

use App\Models\Absen;
use Illuminate\Http\Request;
use App\Models\Acara;

class AcaraController extends Controller
{
    // Method untuk menampilkan semua data acara
    public function index()
    {
        $acaras = Acara::all();
        return view('riwayatPelatihan', compact('acaras'));
    }


    // Method untuk menampilkan form untuk membuat acara baru
    public function create($id)
    {
        $acara = Acara::findOrFail($id);
        return view('form', compact('acara'));
    }

    // Method untuk menyimpan data acara baru
    public function store(Request $request)
    {
        // Validasi data dari form
        $request->validate([
            'judul' => 'required|string',
            'tempat' => 'required|string',
            'tanggal' => 'required|date',
            'absen' => 'required|string',
            'jam' => 'required|string',
            'kategori' => 'required|string',
        ]);

        // Simpan data acara baru
        Acara::create([
            'judul' => $request->input('judul'),
            'tempat' => $request->input('tempat'),
            'tanggal' => $request->input('tanggal'),
            'absen' => $request->input('absen'),
            'jam' => $request->input('jam'),
            'kategori' => $request->input('kategori'),
        ]);

        return redirect()->route('acaras.index')->with('success', 'Acara berhasil ditambahkan');
    }

    // Method untuk menampilkan detail acara
    public function show($id)
    {
        $acara = Acara::findOrFail($id);
        $absens = Absen::where('id_acara', $id)->get(); // Ambil semua data absen yang terkait dengan acara tertentu
        return view('detailAbsens', compact('acara', 'absens'));
    }
    public function selesai($id)
    {
        $acara = Acara::findOrFail($id);
        return view('selesai',compact('acara'));
    }

    // Method untuk menampilkan form untuk mengedit acara
    public function edit($id)
    {
        $acara = Acara::findOrFail($id);
        return view('editAcara', compact('acara'));
    }

    // Method untuk menyimpan perubahan pada data acara
    public function update(Request $request, $id)
    {
        // Validasi data dari form
        $request->validate([
            'judul' => 'required|string',
            'tempat' => 'required|string',
            'tanggal' => 'required|date',
            'absen' => 'required|string',
            'jam' => 'required|string',
            'kategori' => 'required|string',
        ]);

        // Temukan acara yang ingin diubah
        $acara = Acara::findOrFail($id);

        // Update data acara
        $acara->update([
            'judul' => $request->input('judul'),
            'tempat' => $request->input('tempat'),
            'tanggal' => $request->input('tanggal'),
            'absen' => $request->input('absen'),
            'jam' => $request->input('jam'),
            'kategori' => $request->input('kategori'),
        ]);

        return redirect()->route('acaras.index')->with('success', 'Acara berhasil diperbarui');
    }

    public function tambahAcara()
    {
        return view('tambahAcara');
    }
}
