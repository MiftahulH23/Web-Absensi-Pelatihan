<?php

namespace App\Http\Controllers;

use App\Models\Absen;
use App\Models\Narasumber;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Models\Acara;
use Carbon\Carbon;

class AbsenController extends Controller
{
    public function index(): View
    {
        $absens = Absen::all();
        return view('detailAbsens', compact('absens'));
    }

    public function create($id)
    {
        $acara = Acara::findOrFail($id);
        return view('form', compact('acara'));
    }
    public function narasumber($id)
    {
        $acara = Acara::findOrFail($id);
        return view('formNarasumber', compact('acara'));
    }
    public function panitia($id)
    {
        $acara = Acara::findOrFail($id);
        return view('formPanitai', compact('acara'));
    }

    public function selesai()
    {
        return view('selesai');
    }
    public function takeFoto()
    {
        return view('dokumentasi');
    }
    public function simpanFoto(Request $request)
    {
        // Validasi request
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Mendapatkan data gambar dari request
        $image = $request->file('image');

        // Menyimpan gambar ke dalam folder public/dokumentasi
        $path = $image->store('public/dokumentasi');

        // Mengembalikan path gambar yang disimpan
        return $path;
    }
    public function store(Request $request, $id): RedirectResponse
{
    // Validasi formulir
    $validatedData = $request->validate([
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
    if ($request->hasFile('foto')) {
        $image = $request->file('foto');
        $image->storeAs('public/absens', $image->hashName());
    }

    // Ambil waktu dari acara yang dipilih
    $acara = Acara::findOrFail($id);
    $waktuAcara = $acara->absen;
    $jamAcara = Carbon::createFromFormat('H:i', $acara->jam);

    // Ambil waktu absen
    $absen = Carbon::now();

    // Tentukan status
    if ($absen->greaterThan($jamAcara)) {
        // Telat
        $status = 'Late';
    } else {
        // Ontime
        $status = 'Ontime';
    }

    // Unggah tanda tangan
    if ($request->has('ttd')) {
        $ttd = $request->ttd;
        $ttd = substr($ttd, strpos($ttd, ',') + 1); // Menghapus data:image/png;base64,
        $ttd = base64_decode($ttd);
        $ttdFileName = uniqid() . '.png'; // Generate nama file unik
        $ttdPath = 'public/ttd/' . $ttdFileName; // Path lengkap ke file
        file_put_contents(storage_path('app/' . $ttdPath), $ttd);
    }

    // Membuat data absen
    $absenData = [
        'nama' => $validatedData['nama'],
        'norek' => $validatedData['norek'],
        'nik' => $validatedData['nik'],
        'levelJabatan' => $validatedData['levelJabatan'],
        'jabatan' => $validatedData['jabatan'],
        'unitKantor' => $validatedData['unitKantor'],
        'foto' => $request->hasFile('foto') ? $image->hashName() : null,
        'ttd' => $request->has('ttd') ? $ttdFileName : null, // Simpan path tanda tangan
        'id_acara' => $id, // Mengambil ID acara dari URL
        'absen' => $waktuAcara, // Simpan waktu absen
        'status' => $status, // Simpan status absen
    ];

    $absen = Absen::create($absenData);

    if ($absen) {
        return redirect()->route('selesai', ['id' => $absen->id_acara])->with(['success' => 'Data Berhasil Disimpan!']);
    }

    return redirect()->route('absen.create')->with(['error' => 'Data gagal Disimpan!']);
}
public function storeNarasumber (Request $request, $id): RedirectResponse
{
    // Validasi formulir
    $validatedData = $request->validate([
        'nama' => 'required|string|max:255',
        'nik' => 'required|string|max:255',
        'jabatan' => 'required|string|max:255',
        'unitKantor' => 'required|string|max:255',
        'jamMengajar' => 'required|string|max:255',
        // 'jamMulai' => 'required|string|max:255',
        // 'jamSelesai' => 'required|string|max:255',
        'materi' => 'required|string|max:255',
        'foto' => 'required|image|mimes:jpeg,jpg,png|max:2048',
        'ttd' => 'required|string', // ubah menjadi string
    ]);

    // Unggah gambar
    if ($request->hasFile('foto')) {
        $image = $request->file('foto');
        $image->storeAs('public/absens', $image->hashName());
    }

    // Ambil waktu absen
    $absen = Carbon::now();

    // Gabungkan jam mulai dan jam selesai menjadi satu string
    // $jamMengajar = $validatedData['jamMulai'] . ' - ' . $validatedData['jamSelesai'];

    // Unggah tanda tangan
    if ($request->has('ttd')) {
        $ttd = $request->ttd;
        $ttd = substr($ttd, strpos($ttd, ',') + 1); // Menghapus data:image/png;base64,
        $ttd = base64_decode($ttd);
        $ttdFileName = uniqid() . '.png'; // Generate nama file unik
        $ttdPath = 'public/ttd/' . $ttdFileName; // Path lengkap ke file
        file_put_contents(storage_path('app/' . $ttdPath), $ttd);
    }

    // Membuat data absen
    $absenData = [
        'nama' => $validatedData['nama'],
        'nik' => $validatedData['nik'],
        'jabatan' => $validatedData['jabatan'],
        'unitKantor' => $validatedData['unitKantor'],
        'jamMengajar' => $validatedData['jamMengajar'], // Menggunakan jam mengajar yang sudah digabung
        'materi' => $validatedData['materi'],
        'foto' => $request->hasFile('foto') ? $image->hashName() : null,
        'ttd' => $request->has('ttd') ? $ttdFileName : null, // Simpan path tanda tangan
        'id_acara' => $id, // Mengambil ID acara dari URL
    ];

    $absen = Narasumber::create($absenData);

    if ($absen) {
        return redirect()->route('selesai', ['id' => $absen->id_acara])->with(['success' => 'Data Berhasil Disimpan!']);
    }

    return redirect()->route('absen.create')->with(['error' => 'Data gagal Disimpan!']);
}
}