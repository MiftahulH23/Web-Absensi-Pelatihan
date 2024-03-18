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
    <title>Tambah Acara</title>
</head>

<body class="bg-[#efefef] mx-8 mt-5 overflow-hidden" data-aos="zoom-in-down">
    <!-- Header -->
    <div class="w-full bg-white rounded-3xl h-fitt py-4 shadow-xl">
        <div class="overflow-hidden w-36 ml-5">
            <img src="/images/logobrk.png" alt="" class="w-full h-full object-cover">
        </div>
    </div>
    <!-- Main Content -->
    <div class="flex mt-5 gap-8 h-full pb-5">
        <!-- kiri -->
        <div class="flex-none w-[18%] bg-white rounded-3xl shadow-xl px-4 lg:h-[80vh] md:h-[90vh] py-8 mt-3">
            <div class="flex justify-between ml-3">
                <div class="flex gap-5">
                    <div class="w-6 h-6 overflow-hidden">
                        <img src="/images/akunIcon.png" alt="akunIcon" class="w-full h-full object-cover">
                    </div>
                    <p class="text-gray-500 font-semibold">
                        Admin
                    </p>
                </div>
            </div>
            <div class="mt-8 flex flex-col gap-3">
                <!-- beranda -->
                <a href="{{ route('home.index') }}">
                    <div class="flex gap-5 items-center ml-3">
                        <div class="w-6 h-6 overflow-hidden">
                            <img src="/images/homeIcon.png" alt="homeIcon" class="w-full h-full object-cover">
                        </div>
                        <p class="text-gray-500 font-semibold text-sm">Beranda</p>
                    </div>
                </a>
                <!-- Riwayat -->
                <a href="{{ route('riwayat') }}" class="flex gap-5 items-center ml-3">
                    <div class="w-6 h-6 overflow-hidden">
                        <img src="/images/historyIcon.png" alt="riwayatIcon" class="w-full h-full object-cover">
                    </div>
                    <p class="text-gray-500 font-semibold text-sm">Riwayat</p>
                </a>
                <!-- Tambah Acara -->
                <div class="bg-gray-300 rounded-xl bg-opacity-40 py-1">
                    <div class="flex gap-5 items-center ml-3">
                        <div class="w-6 h-6 overflow-hidden">
                            <img src="/images/addEventIcon.png" alt="addEventIcon" class="w-full h-full object-cover">
                        </div>
                        <p class="text-gray-500 font-semibold text-sm">Tambah Acara</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- kanan -->
        <div class="flex flex-col w-full">
            <p class="font-bold text-lg">Tambah Acara</p>
            <form action="{{ route('acaras.store') }}" class="flex-auto bg-white rounded-3xl shadow-xl mt-2 p-5" method="POST" enctype="multipart/form-data">
            @csrf
                <!-- Konten kanan di sini -->
                <div class="grid grid-cols-2 gap-8">
                    <!-- inputan kiri -->
                    <div class="flex flex-col gap-3">
                        <!-- judul -->
                        <p class="font-semibold text-gray-500">Judul</p>
                        <input type="text" name="judul" id="judul" class="border-2 rounded-lg py-2 px-3 focus:outline-none focus:border-[#c2ebc1]">
                        <!-- tempat -->
                        <p class="font-semibold text-gray-500">Tempat</p>
                        <input type="text" name="tempat" id="tempat" class="border-2 rounded-lg py-2 px-3 focus:outline-none focus:border-[#c2ebc1]">
                        <!-- absen -->
                        <p class="font-semibold text-gray-500">Absen</p>
                        <div class="relative">
                            <select name="absen" id="absen" class="appearance-none border-2 rounded-lg py-2 px-3 focus:outline-none focus:border-[#c2ebc1] w-full">
                                <option value="" disabled selected class="text-gray-500">Pilih waktu absen</option>
                                <option value="pagi">Pagi</option>
                                <option value="siang">Siang</option>
                                <option value="sore">Sore</option>
                            </select>
                        </div>

                    </div>
                    <!-- inputan kanan -->
                    <div class="flex flex-col gap-3">
                        <!-- tanggal -->
                        <p class="font-semibold text-gray-500">Tanggal</p>
                        <input type="date" name="tanggal" id="tanggal" class="border-2 rounded-lg py-2 px-3 focus:outline-none focus:border-[#c2ebc1]">
                        <!-- jam -->
                        <label for="jam_range" class="font-semibold text-gray-500">Jam</label>
                        <input type="text" name="jam" id="jam" class="border-2 rounded-lg py-2 px-3 focus:outline-none focus:border-[#c2ebc1] w-full" placeholder="Contoh: 08:00 - 08:30">
                    </div>
                </div>
                <div class="fixed bottom-24 left-[350px] flex gap-5">
                    <!-- ok -->
                    <div class="flex gap-2 bg-[#c2ebc1] bg-opacity-50 items-center w-36 py-1 px-5 rounded-xl">
                        <div class="w-6 h-6 overflow-hidden flex-none">
                            <img src="/images/checklis.png" alt="cheklis" class="w-full h-full object-cover">
                        </div>
                        <button type="submit" class="text-[#03ad00] font-bold flex-auto text-start">OK</button>
                    </div>
                    <!-- cancel -->
                    <div class="flex gap-2 bg-[#f3d9da] bg-opacity-50 items-center w-36 py-1 px-5 rounded-xl">
                        <div class="w-4 h-4 overflow-hidden flex-none">
                            <img src="/images/cancel.png" alt="cheklis" class="w-full h-full object-cover">
                        </div>
                        <button type="reset" class="text-[#b72026] flex-auto text-start font-bold">Cancel</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- Js Jam range -->
    <script>
        // Ambil elemen input
        const jamRangeInput = document.getElementById('jam_range');

        // Tambahkan event listener untuk memvalidasi format input
        jamRangeInput.addEventListener('input', function() {
            const value = this.value;
            // Validasi format jam menggunakan ekspresi reguler
            const regex = /^([01]?[0-9]|2[0-3]):[0-5][0-9]\s*-\s*([01]?[0-9]|2[0-3]):[0-5][0-9]$/;
            if (!regex.test(value)) {
                // Jika format tidak sesuai, tambahkan pesan kesalahan
                this.setCustomValidity('Format jam tidak valid. Harap masukkan dalam format HH:mm - HH:mm');
            } else {
                // Jika format sesuai, hapus pesan kesalahan
                this.setCustomValidity('');
            }
        });
    </script>
    <script>
        AOS.init();
    </script>
</body>

</html>