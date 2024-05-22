<?php

namespace App\Http\Controllers;

use App\Models\Absen;
use App\Models\Narasumber;
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
            'status' => 'on'
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
    public function showNarasumber($id)
    {
        $acara = Acara::findOrFail($id);
        $narasumber = Narasumber::where('id_acara', $id)->get(); // Ambil semua data absen yang terkait dengan acara tertentu
        return view('detailAbsensNarasumber', compact('acara', 'narasumber'));
    }
    public function selesai($id)
    {
        $acara = Acara::findOrFail($id);
        return view('selesai', compact('acara'));
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

    public function search(Request $request)
    {
        $keyword = $request->input('keyword');

        $trainings = Acara::where('judul', 'like', '%' . $keyword . '%')
            ->orWhere('kategori', 'like', '%' . $keyword . '%')
            ->orWhere('tempat', 'like', '%' . $keyword . '%')
            ->orWhere('status', 'like', '%' . $keyword . '%')
            ->get();

        return response()->json($trainings);
    }

    public function searchPeserta(Request $request, $id)
    {
        $keyword = $request->input('keyword');
        $trainings = Absen::where('id_acara', $id)
            ->where(function ($query) use ($keyword) {
                $query->where('nama', 'like', '%' . $keyword . '%')
                    ->orWhere('norek', 'like', '%' . $keyword . '%')
                    ->orWhere('nik', 'like', '%' . $keyword . '%')
                    ->orWhere('levelJabatan', 'like', '%' . $keyword . '%')
                    ->orWhere('jabatan', 'like', '%' . $keyword . '%')
                    ->orWhere('unitKantor', 'like', '%' . $keyword . '%')
                    ->orWhere('absen', 'like', '%' . $keyword . '%')
                    ->orWhere('status', 'like', '%' . $keyword . '%');
            })
            ->get()
            ->map(function ($item) {
                $item->foto = asset('storage/absens/' . $item->foto);
                $item->ttd = asset('storage/ttd/' . $item->ttd);
                return $item;
            });

        return response()->json($trainings);
    }



    public function updateStatus($id)
    {
        $acara = Acara::findOrFail($id);
        $acara->status = $acara->status == 'on' ? 'off' : 'on'; // Toggle status
        $acara->save();

        return response()->json(['message' => 'Status acara berhasil diperbarui']);
    }
}
