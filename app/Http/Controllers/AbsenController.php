<?php

namespace App\Http\Controllers;

use App\Models\Absen;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class AbsenController extends Controller
{
    public function index(): View
    {
        $absens = Absen::all();
        return view('detailAbsens', compact('absens'));
    }

    public function create(): View
    {
        return view('form');
    }

    public function selesai()
    {
        return view('selesai');
    }

    public function store(Request $request): RedirectResponse
    {
        // Validasi formulir
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

        // Unggah gambar
        $image = $request->file('foto');
        $image->storeAs('public/absens', $image->hashName());

        // Unggah tanda tangan
        $ttd = $request->ttd;
        $ttd = substr($ttd, strpos($ttd, ',') + 1); // Menghapus data:image/png;base64,
        $ttd = base64_decode($ttd);
        $ttdPath = ('public/ttd/') . uniqid() . '.png'; // Generate nama file unik
        file_put_contents(storage_path('app/' . $ttdPath), $ttd);


        // Membuat data absen
        $absen = Absen::create([
            'nama' => $request->nama,
            'norek' => $request->norek,
            'nik' => $request->nik,
            'levelJabatan' => $request->levelJabatan,
            'jabatan' => $request->jabatan,
            'unitKantor' => $request->unitKantor,
            'foto' => $image->hashName(),
            'ttd' => $ttdPath, // Simpan path tanda tangan
        ]);

        if ($absen) {
            return redirect()->route('selesai')->with(['success' => 'Data Berhasil Disimpan!']);
        }

        return redirect()->route('absen.create')->with(['success' => 'Data gagal Disimpan!']);
    }
}
