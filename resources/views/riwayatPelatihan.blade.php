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
    <title>Daftar Acara</title>
</head>

<body class="bg-[#efefef] mx-8 mt-5 overflow-hidden" data-aos="zoom-in-down">
    <!-- Header -->
    <div class="w-full flex justify-between bg-white rounded-3xl h-fitt py-4 shadow-xl">
        <div class="overflow-hidden w-36 ml-5">
            <img src="/images/logobrk.png" alt="" class="w-full h-full object-cover">
        </div>
    </div>
    <!-- Main Content -->
    <div class="flex mt-5 gap-8 h-full pb-5">
        <!-- kiri -->
        <div class="flex-none w-[18%] bg-white rounded-3xl shadow-xl px-4  py-8 mt-3" style="font-size: 1rem;">
            <div class="flex justify-between ml-3">
                @auth
                <div class="flex gap-5">
                    <div class="w-6 h-6 overflow-hidden">
                        <img src="/images/akunIcon.png" alt="akunIcon" class="w-full h-full object-cover">
                    </div>
                    <p class="text-gray-500 font-semibold">
                        {{ Auth::user()->name }}
                    </p>
                </div>
                @endauth
                <a href="{{ route('logout') }}" class="w-6 h-6 overflow-hidden">
                    <img src="/images/logoutIcon.png" alt="homeIcon" class="w-full h-full object-cover">
                </a>
            </div>
            <div class="mt-8 flex flex-col gap-3">
                <!-- beranda -->
                <a href="{{ route('home.index') }}" class="flex gap-5 items-center ml-3">
                    <div class="w-6 h-6 overflow-hidden">
                        <img src="/images/homeIcon.png" alt="homeIcon" class="w-full h-full object-cover">
                    </div>
                    <p class="text-gray-500 font-semibold text-sm" style="font-size: 0.875rem;">Beranda</p>
                </a>
                <!-- Riwayat -->
                <div class="bg-gray-300 rounded-xl bg-opacity-40 py-1">
                    <div class="flex gap-5 items-center ml-3">
                        <div class="w-6 h-6 overflow-hidden">
                            <img src="/images/historyIcon.png" alt="riwayatIcon" class="w-full h-full object-cover">
                        </div>
                        <p class="text-gray-500 font-semibold text-sm" style="font-size: 0.875rem;">Daftar Acara</p>
                    </div>
                </div>
                <!-- Tambah Acara -->
                <a href="{{ route('tambahAcara') }}" class="flex gap-5 items-center ml-3">
                    <div class="w-6 h-6 overflow-hidden">
                        <img src="/images/addEventIcon.png" alt="addEventIcon" class="w-full h-full object-cover">
                    </div>
                    <p class="text-gray-500 font-semibold text-sm" style="font-size: 0.875rem;">Tambah Acara</p>
                </a>
            </div>
        </div>
        <!-- kanan -->
        <div class="flex flex-col w-full">
            <p class="font-bold text-lg">Daftar Acara</p>
            <div class="flex-auto bg-white rounded-3xl shadow-xl mt-2 p-5 lg:h-[80vh] md:h-[90vh] overflow-y-scroll ">
                <!-- search judul pelatihan -->
                <div class="flex justify-end">
                    <div class="border rounded-lg px-5 mr-5 flex gap-4 items-center">
                        <div class="w-4 h-4 overflow-hidden">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-search fill-slate-500 object-cover w-full h-full" viewBox="0 0 16 16">
                                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
                            </svg>
                        </div>
                        <input id="searchInput" type="text" placeholder="Cari judul pelatihan" class="focus:outline-none">
                    </div>
                    <button class="bg-[#c2ebc1] px-4 py-1 rounded-lg text-[#03ad00]">Cari</button>
                </div>
                @foreach($acaras as $acara)
                <div class="w-full bg-[#CCCCCC] mt-3 bg-opacity-20 h-fitt py-3 px-4 rounded-3xl border shadow-xl flex justify-between items-center">
                    <div>
                        <p class="text-black font-semibold text-sm">{{ $acara->judul }}</p>
                        <p class="text-gray-500 text-[10px] ml-3" style="font-size: 0.75rem;">Dilakukan di {{ $acara->tempat }}</p>
                        <p class="text-gray-500 text-[10px] ml-3" style="font-size: 0.75rem;">Kategori : {{ $acara->kategori }}</p>
                    </div>
                    <div class="flex gap-4">
                        <!-- detil -->
                        @if($acara->kategori == 'Peserta')
                        <a href="{{ route('acaras.show', ['id' => $acara->id]) }}" class="w-5 h-5 overflow-hidden">
                            <img src="/images/openIcon.png" alt="iconOpen" class="w-full h-full object-cover">
                        </a>
                        @elseif($acara->kategori == 'Narasumber')
                        <a href="{{ route('acaras.show.narasumber', ['id' => $acara->id]) }}" class="w-5 h-5 overflow-hidden">
                            <img src="/images/openIcon.png" alt="iconOpen" class="w-full h-full object-cover">
                        </a>
                        @elseif($acara->kategori == 'Panitia')
                        <!-- <a href="{{ route('acaras.show', ['id' => $acara->id]) }}" class="w-5 h-5 overflow-hidden">
                            <img src="/images/openIcon.png" alt="iconOpen" class="w-full h-full object-cover">
                        </a> -->
                        @endif
                        <!-- edit -->
                        <a href="{{ route('acaras.edit', $acara->id) }}" class="w-5 h-5 overflow-hidden">
                            <img src="/images/editIcon.png" alt="iconEdit" class="w-full h-full object-cover">
                        </a>
                        <!-- share -->
                        @if($acara->kategori == 'Peserta')
                        <a href="{{ route('acara.absen.create', ['id' => $acara->id]) }}" class="w-5 h-5 overflow-hidden">
                            <img src="/images/shareIcon.png" alt="iconShare" class="w-full h-full object-cover">
                        </a>
                        @elseif($acara->kategori == 'Narasumber')
                        <a href="{{ route('acara.absen.narasumber', ['id' => $acara->id]) }}" class="w-5 h-5 overflow-hidden">
                            <img src="/images/shareIcon.png" alt="iconShare" class="w-full h-full object-cover">
                        </a>
                        @elseif($acara->kategori == 'Panitai')
                        <a href="{{ route('acara.absen.panitia', ['id' => $acara->id]) }}" class="w-5 h-5 overflow-hidden">
                            <img src="/images/shareIcon.png" alt="iconShare" class="w-full h-full object-cover">
                        </a>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>

        </div>
    </div>
    <!-- Js Searching -->
    <script>
        const searchInput = document.getElementById('searchInput');
        const searchResults = document.getElementById('searchResults');

        searchInput.addEventListener('keypress', function(event) {
            // Check jika tombol yang ditekan adalah tombol "Enter"
            if (event.key === 'Enter') {
                // Lakukan pencarian
                search();
            }
        });

        searchInput.addEventListener('input', function() {
            // Jika input berubah, bersihkan hasil pencarian sebelumnya
            searchResults.innerHTML = '';

            // Lakukan pencarian
            search();
        });

        function search() {
            const query = searchInput.value.trim();

            if (query.length > 0) {
                fetch(`/search-training?query=${query}`)
                    .then(response => response.json())
                    .then(data => {
                        // Tampilkan hasil pencarian baru
                        data.forEach(training => {
                            const trainingElement = document.createElement('div');
                            trainingElement.textContent = training.judul;
                            searchResults.appendChild(trainingElement);
                        });
                    })
                    .catch(error => console.error('Error fetching search results:', error));
            } else {
                // Kosongkan hasil pencarian jika input kosong
                searchResults.innerHTML = '';
            }
        }
    </script>
    <script>
        AOS.init();
    </script>
</body>

</html>