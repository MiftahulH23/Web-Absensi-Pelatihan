<?php

namespace App\Http\Controllers;

use App\Models\Absen;
use App\Models\Narasumber;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Models\Acara;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

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

        if (Session::has('filename')) {
            // dd(Session::get('filename'));
            $filename = Session::get('filename');
            return view('form', compact('acara', 'filename'));
        } else {
            return view('form', compact('acara'));
        }
    }
    public function narasumber($id)
    {
        $acara = Acara::findOrFail($id);
        if (Session::has('filename')) {
            // dd(Session::get('filename'));
            $filename = Session::get('filename');
            return view('formNarasumber', compact('acara', 'filename'));
        } else {
            return view('formNarasumber', compact('acara'));
        }
    }
    public function panitia($id)
    {
        $acara = Acara::findOrFail($id);
        return view('formPanitai', compact('acara'));
    }
    public function noAkses()
    {
        // Misal, Anda ingin mengambil semua acara atau informasi lainnya
        $acara = Acara::all();
        return view('noAkses', compact('acara'));
    }

    public function selesai()
    {
        return view('selesai');
    }
    public function takeFoto($id)
    {
        return view('dokumentasi')->with('id', $id);
    }
    public function takeFotoNarasumber($id)
    {
        return view('dokumentasiNarasumber')->with('id', $id);
    }
    public function simpanFoto(Request $request, $id)
    {
        // dd($request->all());
        // Validasi request
        $imageData = $request->input('image');
        // Decode the base64 string to get the binary image data
        $imageData = str_replace('data:image/png;base64,', '', $imageData);
        $imageData = str_replace(' ', '+', $imageData);
        $imageBinary = base64_decode($imageData);

        // Generate a unique filename for the image
        $filename = 'image_' . time() . '.png';

        // Save the image data to the storage directory
        Storage::put('public/absens/' . $filename, $imageBinary);
        Session::put('filename', $filename);
        return redirect()->route('acara.absen.create', ['id' => $id])->with('filename', $filename,);
    }
    public function simpanFotoNarasumber(Request $request, $id)
    {
        // dd($request->all());
        // Validasi request
        $imageData = $request->input('image');
        // Decode the base64 string to get the binary image data
        $imageData = str_replace('data:image/png;base64,', '', $imageData);
        $imageData = str_replace(' ', '+', $imageData);
        $imageBinary = base64_decode($imageData);

        // Generate a unique filename for the image
        $filename = 'image_' . time() . '.png';

        // Save the image data to the storage directory
        Storage::put('public/absens/' . $filename, $imageBinary);
        Session::put('filename', $filename);
        return redirect()->route('acara.absen.narasumber', ['id' => $id])->with('filename', $filename,);
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
            'grade' => 'required|string|max:255',
            'foto' => 'required',
            'ttd' => 'required|string',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);


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
            'foto' => $request->foto,
            'ttd' => $request->has('ttd') ? $ttdFileName : null, // Simpan path tanda tangan
            'id_acara' => $id, // Mengambil ID acara dari URL
            'grade' => $validatedData['grade'],
            'absen' => $waktuAcara, // Simpan waktu absen
            'status' => $status, // Simpan status absen
        ];

        $absen = Absen::create($absenData);

        $officeLat = 0.5194777661419975;
        $officeLon = 101.4465743664067;
        $radius = 5; // Radius dalam meter
       
        // Mendapatkan lokasi pengguna
        $userLat = $request->input('latitude');
        $userLon = $request->input('longitude');
       
        // Periksa apakah pengguna berada dalam radius yang diizinkan
        if ($this->isWithinRadius($userLat, $userLon, $officeLat, $officeLon, $radius)) {

        if ($absen) {
            return redirect()->route('selesai', ['id' => $absen->id_acara])->with(['success' => 'Data Berhasil Disimpan!']);
        }

        return redirect()->route('absen.create')->with(['error' => 'Data gagal Disimpan!']);
    }
// Lokasi pengguna tidak diizinkan
    return redirect()->back()->with('error', 'Akses ditolak. Anda berada di luar lokasi yang diizinkan.');
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
    public function storeNarasumber(Request $request, $id): RedirectResponse
    {
        // Validasi formulir
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'nik' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'unitKantor' => 'required|string|max:255',
            'jamMengajar' => 'required|string|max:255',
            'materi' => 'required|string|max:255',
            'foto' => 'required',
            'ttd' => 'required|string',
        ]);

        // Ambil waktu absen
        $absen = Carbon::now();

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
            'foto' => $request->foto,
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
