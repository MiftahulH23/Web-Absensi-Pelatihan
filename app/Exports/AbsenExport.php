<?php

namespace App\Exports;

use App\Models\Absen;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithDrawings;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithEvents;

class AbsenExport implements FromCollection, WithHeadings, WithDrawings, WithEvents
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Absen::all();
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'No', 'Nama', 'No Rekening', 'Nik', 'Level Jabatan', 'Jabatan', 'Unit Kantor',
            'Dokumentasi', 'Tanda Tangan', 'Absen', 'Waktu', 'Status',
        ];
    }

    /**
     * Menambahkan gambar ke dalam file Excel
     *
     * @return array
     */
    public function drawings()
    {
        $absens = Absen::all();
        $drawings = [];

        foreach ($absens as $index => $absen) {
            $fotoPath = storage_path('app/public/absens/' . $absen->foto);
            $ttdPath = storage_path('app/public/ttd/' . $absen->ttd);

            // Membuat objek gambar untuk foto
            $drawingFoto = new Drawing();
            $drawingFoto->setName('Foto_' . $index); // Nama unik untuk gambar
            $drawingFoto->setDescription('Foto');
            $drawingFoto->setPath($fotoPath);
            $drawingFoto->setHeight(100); // Sesuaikan dengan tinggi yang diinginkan
            $drawingFoto->setCoordinates('H' . ($index + 2)); // Sesuaikan dengan kolom yang diinginkan

            // Membuat objek gambar untuk tanda tangan
            $drawingTtd = new Drawing();
            $drawingTtd->setName('Tanda_Tangan_' . $index); // Nama unik untuk gambar
            $drawingTtd->setDescription('Tanda Tangan');
            $drawingTtd->setPath($ttdPath);
            $drawingTtd->setHeight(100); // Sesuaikan dengan tinggi yang diinginkan
            $drawingTtd->setCoordinates('I' . ($index + 2)); // Sesuaikan dengan kolom yang diinginkan

            
            // Menambahkan objek gambar ke dalam array drawings
            $drawings[] = $drawingFoto;
            $drawings[] = $drawingTtd;
        }

        return $drawings;
    }public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet;
                $sheet->getParent()->getDefaultStyle()->getAlignment()->setWrapText(true); // Mengaktifkan wrap text untuk teks panjang
                $sheet->getParent()->getDefaultStyle()->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT); // Mengatur teks menjadi rata kiri
                $sheet->getParent()->getDefaultStyle()->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER); // Mengatur teks menjadi rata tengah
    
                $headerRange = 'A1:' . $sheet->getHighestDataColumn() . '1';
                $sheet->getStyle($headerRange)->getFont()->setBold(true); // Mengatur teks tebal pada baris pertama
                $sheet->getStyle($headerRange)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER); // Mengatur rata tengah pada baris pertama
    
                foreach (range('A', $sheet->getHighestDataColumn()) as $columnID) {
                    $sheet->getColumnDimension($columnID)->setAutoSize(true);
                }
            },
        ];
    }
    

    
}
