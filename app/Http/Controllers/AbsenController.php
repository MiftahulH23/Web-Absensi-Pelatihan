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
       // Hitung uangMakan, uangHarian, dan total berdasarkan grade dan jabatan
    $grade = (int)$validatedData['grade'];
    $jabatan = $validatedData['jabatan'];
    $unitKantor = $validatedData['unitKantor'];

// Hitung uangMakan, uangHarian, dan total berdasarkan grade dan jabatan
$uangMakan = 0;
$uangHarian = 0;
$uangTaxi = 0; 
$total = 0;

// Daftar unitKantor Pekanbaru
$pekanbaruUnits = [
    'BRKS Kantor Pusat', 'Divisi Audit Internal & Anti Fraud', 'Divisi Manajemen Sumber Daya Insani', 
    'Divisi Sekretariat Perusahaan', 'Divisi Kepatuhan', 'Divisi Manajemen Risiko', 'Divisi Hukum', 
    'Divisi Sistem Prosedur & Service Quality', 'Divisi Operasional & Akuntansi', 'Divisi Teknologi & Sistem Informasi', 
    'Divisi Umum', 'Divisi Dana & Digital Banking', 'Divisi Treasury & International Banking', 
    'Divisi Perencanaan & Keuangan', 'Divisi Komersial', 'Divisi Mikro, Kecil dan Menengah', 'Divisi Konsumer', 
    'Divisi Special Asset Management', 'BRKS Pekanbaru Sudirman', 'BRKS Pekanbaru Tangkerang', 
    'BRKS Pekanbaru Rumbai', 'BRKS Pekanbaru Senapelan', 'BRKS Pekanbaru Panam', 'BRKS Pekanbaru Tuanku Tambusai', 
    'BRKS Pekanbaru Jalan Riau', 'BRKS Pekanbaru Sukaramai Trade Center', 'BRKS Pekanbaru Delima Panam', 
    'BRKS Pekanbaru Cabang Utama'
];


// Logika untuk menentukan nilai uangMakan, uangHarian, dan uangTaxi berdasarkan grade, jabatan, dan unitKantor
if (in_array($unitKantor, $pekanbaruUnits)) {
    // Karyawan bekerja di Pekanbaru
    if (in_array($grade, [16, 17, 18]) && $jabatan == 'Pemimpin Divisi') {
        $uangMakan = 300000;
        $uangHarian = 400000;
        
    } elseif (in_array($grade, [17, 18]) && $jabatan == 'Ketua Tim Desk') {
        $uangMakan = 300000;
        $uangHarian = 400000;
    } elseif ($grade == 16 && in_array($jabatan, ['Pemimpin cabang utama', 'Ketua Tim Desk', 'Pinbag KPS'])) {
        $uangMakan = 250000;
        $uangHarian = 350000;
    }
    elseif ($grade == 15 && in_array($jabatan, ['Pemimpin cabang', 'Ketua Tim Desk', 'Pinbag KPS','Anggota Tim Desk'])) {
        $uangMakan = 225000;
        $uangHarian = 290000;
    }elseif (in_array($grade, [13, 14]) && in_array($jabatan, ['Pemimpin cabang', 'Pemimpin capem', 'Ketua Tim Desk', 'Pinbag KPS'])) {
        $uangMakan = 200000;
        $uangHarian = 260000;
    } elseif (in_array($grade, [13, 14]) && in_array($jabatan, ['Pinbag Cabang', 'Anggota Tim Desk'])) {
        $uangMakan = 175000;
        $uangHarian = 230000;
    } elseif (in_array($grade, [11, 12]) && in_array($jabatan, ['Pemimpin Kedai', 'Pemimpin Seksi/Staf'])) {
        $uangMakan = 150000;
        $uangHarian = 200000;
    } elseif (in_array($grade, [9, 10, 11]) && in_array($jabatan, ['Pelaksana & Pegawai Core (PT&PTT)'])) {
        $uangMakan = 135000;
        $uangHarian = 175000;
    } elseif ($grade == 8 && in_array($jabatan, ['Pegawai Non Core (PT&PTT)'])) {
        $uangMakan = 100000;
        $uangHarian = 140000;
    }
} else {
    // Karyawan bekerja di luar Pekanbaru
    if (in_array($grade, [16, 17, 18]) && $jabatan == 'Pemimpin Divisi') {
        $uangMakan = 300000;
        $uangHarian = 400000;
   
    } elseif (in_array($grade, [17, 18]) && $jabatan == 'Ketua Tim Desk') {
        $uangMakan = 300000;
        $uangHarian = 400000;

    } elseif ($grade == 16 && in_array($jabatan, ['Pemimpin cabang utama', 'Ketua Tim Desk', 'Pinbag KPS'])) {
        $uangMakan = 250000;
        $uangHarian = 350000;
    }
    elseif ($grade == 15 && in_array($jabatan, ['Pemimpin cabang', 'Ketua Tim Desk', 'Pinbag KPS','Anggota Tim Desk'])) {
        $uangMakan = 225000;
        $uangHarian = 290000;
    }elseif (in_array($grade, [13, 14]) && in_array($jabatan, ['Pemimpin cabang', 'Pemimpin capem', 'Ketua Tim Desk', 'Pinbag KPS'])) {
        $uangMakan = 200000;
        $uangHarian = 260000;
    } elseif (in_array($grade, [13, 14]) && in_array($jabatan, ['Pinbag Cabang', 'Anggota Tim Desk'])) {
        $uangMakan = 175000;
        $uangHarian = 230000;
    } elseif (in_array($grade, [11, 12]) && in_array($jabatan, ['Pemimpin Kedai', 'Pemimpin Seksi/Staf'])) {
        $uangMakan = 150000;
        $uangHarian = 200000;
    } elseif (in_array($grade, [9, 10, 11]) && in_array($jabatan, ['Pelaksana & Pegawai Core (PT&PTT)'])) {
        $uangMakan = 135000;
        $uangHarian = 175000;
    } elseif ($grade == 8 && in_array($jabatan, ['Pegawai Non Core (PT&PTT)'])) {
        $uangMakan = 100000;
        $uangHarian = 140000;
    } 
     // Hanya atur uang taxi jika karyawan bekerja di luar Pekanbaru
     $uangTaxi = 400000;
}


// Hitung jumlah absen harian
$todayAbsences = Absen::where('nama', $validatedData['nama'])
                      ->whereDate('created_at', Carbon::today())
                      ->count();

// Cek apakah absen 3 kali
if ($todayAbsences == 2) {
    // Cek apakah semua absen ontime
    $ontimeAbsences = Absen::where('nama', $validatedData['nama'])
                           ->whereDate('created_at', Carbon::today())
                           ->where('status', 'Ontime')
                           ->count();

    if ($ontimeAbsences == 2) {
        $total = $uangMakan + $uangHarian + $uangTaxi;
    } else {
        $total = $uangMakan + (0.8 * $uangHarian); // Hanya uangHarian yang dikurangi 20% jika telat
    }
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
            'uangMakan' => $uangMakan, // Simpan uang makan
            'uangHarian' => $uangHarian, // Simpan uang harian
            'uangTaxi' => $uangTaxi,
            'total' => $total, // Simpan total
        ];

        $absen = Absen::create($absenData);

       // Kantor pusat Bank Riau Kepri Syariah
        $officeLat = 0.5192642503417606;
        $officeLon = 101.4465773437769;
        $radius = 100; // Radius dalam meter
       
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
