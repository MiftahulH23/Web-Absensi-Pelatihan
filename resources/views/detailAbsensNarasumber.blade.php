<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <link rel="icon" href="/images/logokecil.png" type="image/x-icon">
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
        <div class="flex justify-between">
            <a id="backButton" href="#" class="w-12 h-6 overflow-hidden border-l ml-1" data-from-home="true">
                <img src="/images/backIcon.png" alt="backIcon" class="w-full h-full object-contain">
            </a>
            <a href="{{ route('download.excel', ['id' => $acara->id]) }}" class="w-16 h-7 overflow-hidden">
                <img src="/images/downloadIcon.png" alt="downloadIcon" class="w-full h-full object-contain">
            </a>
        </div>
        <table class="w-full">
            <thead>
                <tr class="border-b text-center">
                    <th class="w-8 font-semibold text-sm py-2">No</th>
                    <th class="w-24 font-semibold text-sm py-2">Nama</th>
                    <th class="w-6 font-semibold text-sm py-2">Nik</th>
                    <th class="w-20 font-semibold text-sm py-2">Jabatan</th>
                    <th class="w-20 font-semibold text-sm py-2">Unit Kantor</th>
                    <th class="w-20 font-semibold text-sm py-2">Jam Mengajar</th>
                    <th class="w-20 font-semibold text-sm py-2">Materi</th>
                    <th class="w-12 font-semibold text-sm py-2">Dokumentasi</th>
                    <th class="w-20 font-semibold text-sm py-2">Tanda Tangan</th>
                </tr>
            </thead>
            <tbody class="py-3">
                @foreach($narasumber as $narasumber)
                <tr class="border-b text-center">
                    <td class="text-sm py-2">{{ $loop->iteration }}</td>
                    <td class="text-sm py-2">{{ $narasumber->nama }}</td>
                    <td class="text-sm py-2">{{ $narasumber->nik }}</td>
                    <td class="text-sm py-2">{{ $narasumber->jabatan }}</td>
                    <td class="text-sm py-2">{{ $narasumber->unitKantor }}</td>
                    <td class="text-sm py-2">{{ $narasumber->jamMengajar }}</td>
                    <td class="text-sm py-2">{{ $narasumber->Materi }}</td>
                    <td class="text-sm py-2">
                        <img src="{{ asset('storage/absens/' . $narasumber->foto) }}" alt="" class="w-20 h-20 object-cover inline-block">
                    </td>
                    <td class="text-sm py-2">
                        <img src="{{ asset('storage/ttd/'. $narasumber->ttd) }}" alt="" class="w-44 h-28 object-contain inline-block">
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- js -->
    <script>
        AOS.init();
    </script>
    <!-- js navigasi back -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var backButton = document.getElementById('backButton');

            // Fungsi untuk menangani navigasi kembali
            function navigateBack() {
                var referer = document.referrer;

                // Jika referer URL tidak kosong dan bukan dari halaman home, arahkan kembali ke referer URL
                if (referer !== "" && !referer.includes("home")) {
                    window.location.href = referer;
                } else {
                    window.location.href = "{{ route('home.index') }}";
                }
            }

            // Tambahkan event listener untuk tombol kembali
            backButton.addEventListener('click', function(event) {
                event.preventDefault();
                navigateBack();
            });
        });
    </script>

</body>

</html>