<?php

namespace App\Http\Controllers;
use App\Models\Acara;
use Illuminate\Http\Request;
use Carbon\Carbon;
class HomeController extends Controller
{
    
    public function index()
    {
        // Ambil 3 acara terakhir tanpa menghiraukan kolom created_at
        $riwayatPelatihan = Acara::select('*')
                                ->from('acaras')
                                ->orderByDesc('tanggal') // Atau sesuaikan dengan kolom tanggal yang sesuai dengan waktu acara
                                ->take(3)
                                ->get();
    
       // Ambil acara yang sedang berlangsung
         $acaraSedangBerlangsung = Acara::where('tanggal', '=', Carbon::today()->toDateString())
         ->whereTime('jam', '<=', Carbon::now()->toTimeString())
         ->get();

        return view('beranda', compact('riwayatPelatihan', 'acaraSedangBerlangsung'));
    }
}