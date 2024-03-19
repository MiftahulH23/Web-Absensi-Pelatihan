<?php

namespace App\Exports;

use App\Models\Absen; // Import model Absen
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Collection; // Import Collection

class AbsenExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $data = [
            ['No', 'Nama', 'No Rekening', 'Nik', 'Level Jabatan', 'Jabatan', 'Unit Kantor', 'Dokumentasi', 'Tanda Tangan', 'Absen', 'Waktu', 'Status'],
            // Data selanjutnya
        ];

        // Mengambil semua data dari model Absen
        $absen = Absen::get()->toArray(); 

        // Gabungkan judul dan data
        return new Collection(array_merge($data, $absen));
    }
}
