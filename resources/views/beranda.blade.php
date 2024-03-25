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
    <title>Beranda</title>
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
                <a href="{{ route('logout') }}" class="w-6 h-6 overflow-hidden">
                    <img src="/images/logoutIcon.png" alt="homeIcon" class="w-full h-full object-cover">
                </a>
            </div>
            <div class="mt-8 flex flex-col gap-3">
                <!-- beranda -->
                <div class="bg-gray-300 rounded-xl bg-opacity-40 py-1">
                    <div class="flex gap-5 items-center ml-3">
                        <div class="w-6 h-6 overflow-hidden">
                            <img src="/images/homeIcon.png" alt="homeIcon" class="w-full h-full object-cover">
                        </div>
                        <p class="text-gray-500 font-semibold text-sm">Beranda</p>
                    </div>
                </div>
                <!-- Riwayat -->
                <a href="{{ route('acaras.index') }}" class="flex gap-5 items-center ml-3">
                    <div class="w-6 h-6 overflow-hidden">
                        <img src="/images/historyIcon.png" alt="riwayatIcon" class="w-full h-full object-cover">
                    </div>
                    <p class="text-gray-500 font-semibold text-sm">Daftar Acara</p>
                </a>
                <!-- Tambah Acara -->
                <a href="{{ route('tambahAcara') }}" class="flex gap-5 items-center ml-3">
                    <div class="w-6 h-6 overflow-hidden">
                        <img src="/images/addEventIcon.png" alt="addEventIcon" class="w-full h-full object-cover">
                    </div>
                    <p class="text-gray-500 font-semibold text-sm">Tambah Acara</p>
                </a>
            </div>
        </div>
        <!-- kanan -->
        <div class="flex flex-col w-full">
            <p class="font-bold text-lg">Beranda</p>
            <div class="flex-auto bg-white rounded-3xl shadow-xl mt-2 p-5">
                <!-- Konten kanan di sini -->
                <p class="font-bold text-lg">Acara yang Sedang Berlangsung</p>
                @if(count($acaraSedangBerlangsung) > 0)
                <ul>
                    @foreach($acaraSedangBerlangsung as $acara)
                    <div class="w-full bg-[#CCCCCC] mt-3 bg-opacity-20 h-fitt py-3 px-4 rounded-3xl border shadow-xl flex justify-between items-center">
                        <div>
                            <p class="text-black font-semibold text-sm">{{ $acara->judul }}</p>
                            <p class="text-gray-500 text-[10px] ml-3" style="font-size: 0.75rem;">Dilakukan di {{ $acara->tempat }}</p>
                        </div>
                        <div class="flex gap-4">
                            <a href="{{ route('acaras.show', ['id' => $acara->id]) }}" class="w-5 h-5 overflow-hidden">
                                <img src="/images/openIcon.png" alt="iconOpen" class="w-full h-full object-cover">
                            </a>
                            <!-- edit -->
                            <a href="{{ route('acaras.edit', $acara->id) }}" class="w-5 h-5 overflow-hidden">
                                <img src="/images/editIcon.png" alt="iconEdit" class="w-full h-full object-cover">
                            </a>
                            <!-- share -->
                            <a href="{{ route('acara.absen.create', ['id' => $acara->id]) }}" class="w-5 h-5 overflow-hidden">
                                <img src="/images/shareIcon.png" alt="iconShare" class="w-full h-full object-cover">
                            </a>
                        </div>
                    </div>
                    @endforeach
                </ul>
                @else
                <div class="flex justify-start">
                    <p class="bg-[#c2ebc1] text-center px-2 py-1 rounded-xl text-[#03ad00]">Sedang tidak ada acara berlangsung</p>
                </div>
                @endif
                <p class="font-bold text-lg mt-10">Riwayat Pelatihan Terakhir</p>
                <ul>
                    @foreach($riwayatPelatihan as $acara)
                    <div class="w-full bg-[#CCCCCC] mt-3 bg-opacity-20 h-fitt py-3 px-4 rounded-3xl border shadow-xl flex justify-between items-center">
                        <div>
                            <p class="text-black font-semibold text-sm">{{ $acara->judul }}</p>
                            <p class="text-gray-500 text-[10px] ml-3" style="font-size: 0.75rem;">Dilakukan di {{ $acara->tempat }}</p>
                        </div>
                        <div class="flex gap-4">
                            <a href="{{ route('acaras.show', ['id' => $acara->id]) }}" class="w-5 h-5 overflow-hidden">
                                <img src="/images/openIcon.png" alt="iconOpen" class="w-full h-full object-cover">
                            </a>
                            <!-- edit -->
                            <a href="{{ route('acaras.edit', $acara->id) }}" class="w-5 h-5 overflow-hidden">
                                <img src="/images/editIcon.png" alt="iconEdit" class="w-full h-full object-cover">
                            </a>
                            <!-- share -->
                            <a href="{{ route('acara.absen.create', ['id' => $acara->id]) }}" class="w-5 h-5 overflow-hidden">
                                <img src="/images/shareIcon.png" alt="iconShare" class="w-full h-full object-cover">
                            </a>
                        </div>
                    </div>
                    @endforeach
                </ul>


            </div>
        </div>
    </div>
    <script>
        AOS.init();
    </script>
</body>

</html>