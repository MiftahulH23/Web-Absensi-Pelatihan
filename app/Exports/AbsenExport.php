<?php

namespace App\Exports;

use App\Models\Absen; // Import model Absen
use Maatwebsite\Excel\Concerns\FromCollection;

class AbsenExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        // Mengambil semua data dari model Absen
        return Absen::get(); 
    }
}
