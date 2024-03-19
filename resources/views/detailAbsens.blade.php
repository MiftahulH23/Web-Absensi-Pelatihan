<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <link rel="icon" href="images/logokecil.png" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <title>Detail Absen</title>
</head>

<body class="bg-[#efefef] mx-8 mt-5 overflow-hidden" data-aos="zoom-in-down">
    <!-- Header -->
    <div class="w-full bg-white rounded-3xl h-fitt py-4 shadow-xl">
        <div class="overflow-hidden w-36 ml-5">
            <img src="/images/logobrk.png" alt="" class="w-full h-full object-cover">
        </div>
    </div>
    <!-- Main content -->
    <p class="text-lg font-bold mt-5">Tabel Absens</p>
    <div class=" bg-white rounded-3xl shadow-xl mt-2 p-5 lg:h-[80vh] md:h-[90vh] overflow-y-scroll">
        <table class="w-full">
            <thead>
                <tr class="border-b text-center">
                    <th class="w-8 font-semibold text-sm py-2">No</th>
                    <th class="w-16 font-semibold text-sm py-2">Nama</th>
                    <th class="w-10 font-semibold text-sm py-2">No Rekening</th>
                    <th class="w-10 font-semibold text-sm py-2">Nik</th>
                    <th class="w-10 font-semibold text-sm py-2">Level Jabatan</th>
                    <th class="w-16 font-semibold text-sm py-2">Jabatan</th>
                    <th class="w-16 font-semibold text-sm py-2">Unit Kantor</th>
                    <th class="w-12 font-semibold text-sm py-2">Dokumentasi</th>
                    <th class="w-20 font-semibold text-sm py-2">Tanda Tangan</th>
                    <th class="w-16 font-semibold text-sm py-2">Absen</th>
                    <th class="w-16 font-semibold text-sm py-2">Waktu</th>
                    <th class="w-16 font-semibold text-sm py-2">Status</th>
                </tr>
            </thead>
            <tbody class="py-3">
                @foreach($absens as $absen)
                <tr class="border-b text-center">
                    <td class="text-sm py-2">{{ $absen->id }}</td>
                    <td class="text-sm py-2">{{ $absen->nama }}</td>
                    <td class="text-sm py-2">{{ $absen->norek }}</td>
                    <td class="text-sm py-2">{{ $absen->nik }}</td>
                    <td class="text-sm py-2">{{ $absen->levelJabatan }}</td>
                    <td class="text-sm py-2">{{ $absen->jabatan }}</td>
                    <td class="text-sm py-2">{{ $absen->unitKantor }}</td>
                    <td class="text-sm py-2">
                        <img src="{{ asset('storage/absens/' . $absen->foto) }}" alt="" class="w-20 h-20 object-cover inline-block">
                    </td>
                    <td class="text-sm py-2">
                        <img src="{{ asset('storage/ttd/'. $absen->ttd) }}" alt="" class="w-20 h-20 object-cover inline-block">
                    </td>
                    <td class="text-sm py-2">Pagi</td>
                    <td class="text-sm py-2">{{ $absen->created_at }}</td>
                    <td class="text-sm py-2">telat</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- js -->
    <script>
        AOS.init();
    </script>
</body>

</html>