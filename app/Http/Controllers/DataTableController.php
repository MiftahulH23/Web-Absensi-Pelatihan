<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\DataTableExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\AbsenExport;
use App\Models\Absen;
class DataTableController extends Controller
{
    public function downloadExcel(Request $request, $id)
    {
        // Menggunakan Laravel Excel untuk membuat dan mendownload file Excel
        $eventId = $id;
        return Excel::download(new AbsenExport($eventId), 'data_table.xlsx');
    }
}
