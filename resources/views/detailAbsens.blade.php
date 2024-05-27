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
    <p class="text-lg font-bold mt-5">Tabel Peserta</p>
    <div class=" bg-white rounded-3xl shadow-xl mt-2 p-5 lg:h-[80vh] md:h-[90vh] overflow-y-scroll">
        <div class="flex justify-between">
            <a id="backButton" href="#" class="w-12 h-6 overflow-hidden border-l ml-1" data-from-home="true">
                <img src="/images/backIcon.png" alt="backIcon" class="w-full h-full object-contain">
            </a>
            <div class="flex gap-2">
                <!-- search peserta -->
                <div class="flex justify-end">
                    <div class="border rounded-lg px-5 mr-5 flex gap-4 items-center">
                        <div class="w-4 h-4 overflow-hidden">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-search fill-slate-500 object-cover w-full h-full" viewBox="0 0 16 16">
                                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
                            </svg>
                        </div>
                        <input id="searchInput" type="text" placeholder="Cari acara pelatihan" class="focus:outline-none">
                    </div>
                    <button id="searchButton" class="bg-[#c2ebc1] px-4 py-1 rounded-lg text-[#03ad00]" data-url="{{ route('trainings.search.peserta', ['id' => $acara->id]) }}">Cari</button>
                </div>
                <a href="{{ route('download.excel', ['id' => $acara->id]) }}" class="w-16 h-7 overflow-hidden">
                    <img src="/images/downloadIcon.png" alt="downloadIcon" class="w-full h-full object-contain">
                </a>
            </div>
        </div>
        <table class="w-full">
            <thead>
                <tr class="border-b text-center">
                    <th class="w-8 font-semibold text-sm py-2">No</th>
                    <th class="w-24 font-semibold text-sm py-2">Nama</th>
                    <th class="w-10 font-semibold text-sm py-2">No Rekening</th>
                    <th class="w-6 font-semibold text-sm py-2">Nik</th>
                    <th class="w-10 font-semibold text-sm py-2">Level Jabatan</th>
                    <th class="w-20 font-semibold text-sm py-2">Jabatan</th>
                    <th class="w-20 font-semibold text-sm py-2">Unit Kantor</th>
                    <th class="w-8 font-semibold text-sm py-2">Grade</th>
                    <th class="w-12 font-semibold text-sm py-2">Dokumentasi</th>
                    <th class="w-20 font-semibold text-sm py-2">Tanda Tangan</th>
                    <th class="w-16 font-semibold text-sm py-2">Absen</th>
                    <th class="w-16 font-semibold text-sm py-2">Waktu</th>
                    <th class="w-16 font-semibold text-sm py-2">Status</th>
                </tr>
            </thead>
            <tbody class="py-3" id="acaraContainer">
                @foreach($absens as $absen)
                <tr class="border-b text-center">
                    <td class="text-sm py-2">{{ $loop->iteration }}</td>
                    <td class="text-sm py-2">{{ $absen->nama }}</td>
                    <td class="text-sm py-2">{{ $absen->norek }}</td>
                    <td class="text-sm py-2">{{ $absen->nik }}</td>
                    <td class="text-sm py-2">{{ $absen->levelJabatan }}</td>
                    <td class="text-sm py-2">{{ $absen->jabatan }}</td>
                    <td class="text-sm py-2">{{ $absen->unitKantor }}</td>
                    <td class="text-sm py-2">{{ $absen->grade }}</td>
                    <td></td>
                    <td class="text-sm py-2">
                        <img src="{{ asset('storage/absens/' . $absen->foto) }}" alt="" class="w-20 h-20 object-cover inline-block">
                    </td>
                    <td class="text-sm py-2">
                        <img src="{{ asset('storage/ttd/'. $absen->ttd) }}" alt="" class="w-44 h-28 object-contain inline-block">
                    </td>
                    <td class="text-sm py-2">{{ $absen->absen }}</td>
                    <td class="text-sm py-2">{{ $absen->created_at }}</td>
                    <td class="text-sm py-2">
                        @if($absen->status == 'Late')
                        <span class="text-[#70241d] bg-[#f3d4d1] py-1 px-6 rounded-xl">Late</span>
                        @else
                        <span class="text-[#105352] bg-[#c9e8e8] py-1 px-3 rounded-xl">Ontime</span>
                        @endif
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
                    window.location.href = "{{ route('acaras.index') }}";
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
    <!-- Js Searching -->
    <script>
        // Event listener untuk menekan tombol "Enter" pada input pencarian
        document.getElementById('searchInput').addEventListener('keypress', function(event) {
            if (event.key === 'Enter') {
                search();
            }
        });

        // Event listener untuk tombol cari
        document.getElementById('searchButton').addEventListener('click', search);

        function search() {
            var keyword = document.getElementById('searchInput').value.trim();
            var url = document.getElementById('searchButton').getAttribute('data-url');

            if (keyword !== '') {
                url += '?keyword=' + encodeURIComponent(keyword);
            }

            // Tampilkan animasi loading
            var acaraContainer = document.getElementById('acaraContainer');
            acaraContainer.innerHTML = '<div id="loadingContainer" class="fixed top-0 left-0 w-full h-full flex justify-center items-center bg-gray-200 bg-opacity-50 z-50"><div class="bg-white p-4 rounded-lg"><img src="/images/loading.gif" alt="loading" class="w-16 h-16 mx-auto"></div></div>';

            var xhr = new XMLHttpRequest();
            xhr.open('GET', url, true);
            xhr.onload = function() {
                if (xhr.status === 200) {
                    try {
                        console.log('Response received:', xhr.responseText); // Log the raw response
                        var trainings = JSON.parse(xhr.responseText);
                        displaySearchResults(trainings); // Panggil fungsi untuk menampilkan hasil pencarian
                    } catch (e) {
                        console.error('Error parsing JSON response:', e);
                        acaraContainer.innerHTML = '<div class="text-center text-gray-500 font-semibold mt-3">Terjadi kesalahan dalam memproses data</div>';
                    }
                } else {
                    console.error('Error: ' + xhr.statusText);
                    acaraContainer.innerHTML = '<div class="text-center text-gray-500 font-semibold mt-3">Terjadi kesalahan pada permintaan</div>';
                }
            };
            xhr.onerror = function() {
                console.error('Request failed');
                acaraContainer.innerHTML = '<div class="text-center text-gray-500 font-semibold mt-3">Terjadi kesalahan pada permintaan</div>';
            };
            xhr.send();
        }

        function displaySearchResults(trainings) {
            var acaraContainer = document.getElementById('acaraContainer');
            acaraContainer.innerHTML = ''; // Kosongkan kontainer acara

            if (trainings.length === 0) {
                var notFoundMessage = '<div class="text-center text-gray-500 font-semibold mt-3">Data tidak ditemukan</div>';
                acaraContainer.innerHTML = notFoundMessage;
                return;
            }

            trainings.forEach(function(training, index) {
                var cardHTML = `
            <tr class="border-b text-center">
                <td class="text-sm py-2">${index + 1}</td>
                <td class="text-sm py-2">${training.nama}</td>
                <td class="text-sm py-2">${training.norek}</td>
                <td class="text-sm py-2">${training.nik}</td>
                <td class="text-sm py-2">${training.levelJabatan}</td>
                <td class="text-sm py-2">${training.jabatan}</td>
                <td class="text-sm py-2">${training.unitKantor}</td>
                <td class="text-sm py-2">${training.grade}</td>
                <td class="text-sm py-2">
                    <img src="${training.foto}" alt="Foto" class="w-20 h-20 object-cover inline-block">
                </td>
                <td class="text-sm py-2">
                    <img src="${training.ttd}" alt="TTD" class="w-44 h-28 object-contain inline-block">
                </td>
                <td class="text-sm py-2">${training.absen}</td>
                <td class="text-sm py-2">${new Date(training.created_at).toLocaleString('en-US', { timeZone: 'Asia/Jakarta', hour12: false }).replace(/\//g, '-').replace(/,/g, '')}</td>
                <td class="text-sm py-2">
                    ${training.status === 'Late' ? '<span class="text-[#70241d] bg-[#f3d4d1] py-1 px-6 rounded-xl">Late</span>' : '<span class="text-[#105352] bg-[#c9e8e8] py-1 px-3 rounded-xl">Ontime</span>'}
                </td>
            </tr>
        `;
                acaraContainer.innerHTML += cardHTML; // Tambahkan card ke kontainer acara
            });
        }
    </script>


</body>

</html>