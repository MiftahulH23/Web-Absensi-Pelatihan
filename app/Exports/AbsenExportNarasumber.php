<?php

namespace App\Exports;

use App\Models\Narasumber;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithDrawings;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithEvents;
use Illuminate\Support\Collection;

class AbsenExportNarasumber implements FromCollection, WithHeadings, WithDrawings, WithEvents
{
    /**
     * @return \Illuminate\Support\Collection
     */
    protected $eventId;

    public function __construct($eventId)
    {
        $this->eventId = $eventId;
    }
    public function collection()
    {
        $eventId = request()->route('id'); // Mengambil id acara dari URL
        $absens = Narasumber::where('id_acara', $eventId)->get();

        $data = [];
        $counter = 1;
        foreach ($absens as $absen) {
            $data[] = [
                'No' => $counter++,
                'Nama' => $absen->nama,
                'Nik' => $absen->nik,
                'Jabatan' => $absen->jabatan,
                'Unit Kantor' => $absen->unitKantor,
                'Jam Mengajar' => $absen->jamMengajar,
                'Materi' => $absen->Materi,
                'Dokumentasi' => $absen->dokumentasi,
                'Tanda Tangan' => $absen->tanda_tangan
            ];
        }

        return new Collection($data);
    }


    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'No', 'Nama', 'Nik', 'Jabatan', 'Unit Kantor', 'Jam Mengajar', 'Materi',
            'Dokumentasi', 'Tanda Tangan'
        ];
    }

    /**
     * Menambahkan gambar ke dalam file Excel
     *
     * @return array
     */
    public function drawings()
    {
        $eventId = request()->route('id'); // Mengambil id acara dari URL
        $absens = Narasumber::where('id_acara', $eventId)->get();
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
    public function registerEvents(): array
    {

        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet;
                $absenCount = Narasumber::count();

                for ($i = 0; $i < $absenCount; $i++) {
                    $sheet->getRowDimension($i + 2)->setRowHeight(100); // Sesuaikan dengan tinggi gambar
                }
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
