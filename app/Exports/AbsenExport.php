<?php

namespace App\Exports;

use App\Models\Absen;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithDrawings;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

class AbsenExport implements FromCollection, WithHeadings, WithDrawings
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
    }
}
