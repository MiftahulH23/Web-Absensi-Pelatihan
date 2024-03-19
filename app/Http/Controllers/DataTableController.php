<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\DataTableExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\AbsenExport;
use App\Models\Absen;
class DataTableController extends Controller
{
    public function downloadExcel()
    {
        // Menggunakan Laravel Excel untuk membuat dan mendownload file Excel
        return Excel::download(new AbsenExport, 'data_table.xlsx');
    }
}
