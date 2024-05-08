<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite('resources/css/app.css')
    <link rel="icon" href="/images/logokecil.png" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <style>
        .toggleButton.bg-gray-300 {
            background-color: #D1D5DB;
            /* Warna latar belakang untuk status "off" */
        }

        .toggleButton:focus {
            outline: none;
        }

        .toggleCircle.translate-x-full {
            transform: translateX(75%);
        }
    </style>
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
                    <p class="text-gray-500 font-semibold capitalize">
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
                <!-- Tambah Acara -->
                <a href="{{ route('tambahAcara') }}" class="flex gap-5 items-center ml-3">
                    <div class="w-6 h-6 overflow-hidden">
                        <img src="/images/addEventIcon.png" alt="addEventIcon" class="w-full h-full object-cover">
                    </div>
                    <p class="text-gray-500 font-semibold text-sm" style="font-size: 0.875rem;">Tambah Acara</p>
                </a>
                <!-- Riwayat -->
                <a href="{{ route('acaras.index') }}" class="bg-gray-300 rounded-xl bg-opacity-40 py-1">
                    <div class="flex gap-5 items-center ml-3">
                        <div class="w-6 h-6 overflow-hidden">
                            <img src="/images/daftarAcara.png" alt="riwayatIcon" class="w-full h-full object-cover">
                        </div>
                        <p class="text-gray-500 font-semibold text-sm" style="font-size: 0.875rem;">Daftar Acara</p>
                    </div>
                </a>
            </div>
            <!-- Kalender -->
            <div class="mt-32 flex flex-col items-center justify-center">
                <div class="flex items-center justify-between w-full">
                    <button onclick="previousMonth()" class="text-gray-500 text-sm font-bold py-2 px-4 rounded">&lt;</button>
                    <div id="month-year" class="font-bold text-gray-500 text-sm"></div>
                    <button onclick="nextMonth()" class="text-gray-500 text-sm font-bold py-2 px-4 rounded">&gt;</button>
                </div>
                <div id="calendar" class="max-w-full overflow-x-auto mt-4 text-[11px]"></div> <!-- Menambahkan kelas text-sm untuk ukuran font kecil -->
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
                        <input id="searchInput" type="text" placeholder="Cari acara pelatihan" class="focus:outline-none">
                    </div>
                    <button id="searchButton" class="bg-[#c2ebc1] px-4 py-1 rounded-lg text-[#03ad00]" data-url="{{ route('trainings.search') }}">Cari</button>
                </div>

                <div id="acaraContainer">
                    <!-- Render semua data acara saat halaman dimuat -->
                    @foreach($acaras as $acara)
                    <div class="acara-card w-full bg-[#CCCCCC] mt-3 bg-opacity-20 h-fitt py-3 px-4 rounded-3xl border shadow-xl flex justify-between items-center">
                        <div>
                            <p class="text-black font-semibold text-sm">{{ $acara->judul }}</p>
                            <p class="text-gray-500 text-[10px] ml-3" style="font-size: 0.75rem;">Dilakukan di {{ $acara->tempat }}</p>
                            <p class="text-gray-500 text-[10px] ml-3" style="font-size: 0.75rem;">Kategori : {{ $acara->kategori }}</p>
                        </div>
                        <div class="flex justify-center items-center gap-4">
                            <!-- toogle button -->
                            <div class="flex items-center justify-center h-full">
                                <button class="toggleButton relative w-12 h-6 rounded-full focus:outline-none {{ $acara->status == 'on' ? 'bg-green-500' : 'bg-gray-300' }}" data-id="{{ $acara->id }}">
                                    <div class="ml-1 toggleCircle absolute left-0 top-1/2 transform -translate-y-1/2 w-4 h-4 rounded-full bg-white transition-transform {{ $acara->status == 'on' ? 'translate-x-5' : 'translate-x-1' }}"></div>
                                </button>
                            </div>
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
                            <a href="{{ route('acaras.show', ['id' => $acara->id]) }}" class="w-5 h-5  overflow-hidden">
                                <img src="/images/openIcon.png" alt="iconOpen" class="w-full h-full object-cover">
                            </a>
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
                            @elseif($acara->kategori == 'Panitia')
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
    </div>
    <!-- js toggle button -->
    <script>
        document.querySelectorAll('.toggleButton').forEach(button => {
            button.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                const toggleCircle = this.querySelector('.toggleCircle');
                const isActive = toggleCircle.classList.contains('translate-x-1');

                fetch(`/update-status/${id}`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({
                            isActive: !isActive
                        }) // Mengirimkan status baru (dibolak-balik)
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Terjadi kesalahan saat memperbarui status acara');
                        }
                        return response.json();
                    })
                    .then(data => {
                        console.log(data.message); // Menampilkan pesan sukses
                        toggleCircle.classList.toggle('translate-x-5'); // Mengubah status toggle button
                        this.classList.toggle('bg-gray-300'); // Mengubah warna latar belakang untuk status "off"
                        this.classList.toggle('bg-green-500'); // Mengubah warna latar belakang untuk status "on"
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
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
                url += '?keyword=' + keyword;
            }

            // Tampilkan animasi loading
            var acaraContainer = document.getElementById('acaraContainer');
            acaraContainer.innerHTML = '<div id="loadingContainer" class="fixed top-0 left-0 w-full h-full flex justify-center items-center bg-gray-200 bg-opacity-50 z-50"><div class="bg-white p-4 rounded-lg"><img src="/images/loading.gif" alt="loading" class="w-16 h-16 mx-auto"></div></div>';

            var xhr = new XMLHttpRequest();
            xhr.open('GET', url, true);
            xhr.onload = function() {
                if (xhr.status === 200) {
                    var trainings = JSON.parse(xhr.responseText);
                    displaySearchResults(trainings); // Panggil fungsi untuk menampilkan hasil pencarian
                } else {
                    console.error('Error: ' + xhr.statusText);
                }
            };
            xhr.send();
        }

        function displaySearchResults(trainings) {
            var acaraContainer = document.getElementById('acaraContainer');
            acaraContainer.innerHTML = ''; // Kosongkan kontainer acara

            // Jika tidak ada hasil pencarian, tampilkan pesan "Data tidak ditemukan"
            if (trainings.length === 0) {
                var notFoundMessage = `
                <div class="text-center text-gray-500 font-semibold mt-3">Data tidak ditemukan</div>
            `;
                acaraContainer.innerHTML = notFoundMessage;
                return;
            }

            trainings.forEach(function(training) {
                var detailLink = '';
                var editLink = '';
                var shareLink = '';

                if (training.kategori === 'Peserta') {
                    detailLink = '{{ route("acaras.show", ["id" => ":id"]) }}'.replace(':id', training.id);
                    editLink = '{{ route("acaras.edit", ["id" => ":id"]) }}'.replace(':id', training.id);
                    shareLink = '{{ route("acara.absen.create", ["id" => ":id"]) }}'.replace(':id', training.id);
                } else if (training.kategori === 'Narasumber') {
                    detailLink = '{{ route("acaras.show.narasumber", ["id" => ":id"]) }}'.replace(':id', training.id);
                    editLink = '{{ route("acaras.edit", ["id" => ":id"]) }}'.replace(':id', training.id);
                    shareLink = '{{ route("acara.absen.narasumber", ["id" => ":id"]) }}'.replace(':id', training.id);
                } else if (training.kategori === 'Panitia') {
                    detailLink = '{{ route("acaras.show", ["id" => ":id"]) }}'.replace(':id', training.id);
                    editLink = '{{ route("acaras.edit", ["id" => ":id"]) }}'.replace(':id', training.id);
                    shareLink = '{{ route("acara.absen.panitia", ["id" => ":id"]) }}'.replace(':id', training.id);
                }

                var cardHTML = `
                <div class="acara-card w-full bg-[#CCCCCC] mt-3 bg-opacity-20 h-fitt py-3 px-4 rounded-3xl border shadow-xl flex justify-between items-center">
                    <div>
                        <p class="text-black font-semibold text-sm">${training.judul}</p>
                        <p class="text-gray-500 text-[10px] ml-3" style="font-size: 0.75rem;">Dilakukan di ${training.tempat}</p>
                        <p class="text-gray-500 text-[10px] ml-3" style="font-size: 0.75rem;">Kategori : ${training.kategori}</p>
                    </div>
                    <div class="flex gap-4">
                        <!-- detil -->
                        <a href="${detailLink}" class="w-5 h-5 overflow-hidden">
                            <img src="/images/openIcon.png" alt="iconOpen" class="w-full h-full object-cover">
                        </a>
                        <!-- edit -->
                        <a href="${editLink}" class="w-5 h-5 overflow-hidden">
                            <img src="/images/editIcon.png" alt="iconEdit" class="w-full h-full object-cover">
                        </a>
                        <!-- share -->
                        <a href="${shareLink}" class="w-5 h-5 overflow-hidden">
                            <img src="/images/shareIcon.png" alt="iconShare" class="w-full h-full object-cover">
                        </a>
                    </div>
                </div>
            `;
                acaraContainer.innerHTML += cardHTML; // Tambahkan card ke kontainer acara
            });
        }
    </script>
    <!-- Inisialisasi datepicker -->
    <script>
        // Get the current date
        let today = new Date();
        let currentMonth = today.getMonth();
        let currentYear = today.getFullYear();

        // Function to render calendar
        function renderCalendar(month, year) {
            let calendar = document.getElementById("calendar");
            let monthYearText = document.getElementById("month-year");

            // Array of month names
            let monthNames = ["January", "February", "March", "April", "May", "June",
                "July", "August", "September", "October", "November", "December"
            ];

            // Get the first day of the month
            let firstDay = new Date(year, month).getDay();

            // Number of days in the month
            let daysInMonth = 32 - new Date(year, month, 32).getDate();

            // Clear previous calendar
            calendar.innerHTML = "";

            // Create table header with month and year
            let table = document.createElement("table");
            table.classList.add("table", "table-bordered", "w-full");
            let caption = table.createCaption();
            monthYearText.textContent = monthNames[month] + " " + year;

            // Create table header with days of the week
            let header = table.createTHead();
            let row = header.insertRow();
            let daysOfWeek = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];
            for (let day of daysOfWeek) {
                let cell = row.insertCell();
                cell.classList.add("text-center", "text-gray-500", "font-semibold");
                cell.textContent = day;
            }

            // Create table body with dates
            let body = table.createTBody();
            let date = 1;
            for (let i = 0; i < 6; i++) {
                row = body.insertRow();
                for (let j = 0; j < 7; j++) {
                    if (i === 0 && j < firstDay) {
                        let cell = row.insertCell();
                        cell.textContent = "";
                    } else if (date > daysInMonth) {
                        break;
                    } else {
                        let cell = row.insertCell();
                        cell.textContent = date;
                        cell.classList.add("p-2", "text-center", "text-gray-500", "font-semibold");
                        if (date === today.getDate() && year === today.getFullYear() && month === today.getMonth()) {
                            cell.classList.add("bg-gray-200", "rounded-full");
                        }
                        date++;
                    }
                }
            }

            calendar.appendChild(table);
        }

        // Render calendar for the current month
        renderCalendar(currentMonth, currentYear);

        // Function to show previous month
        function previousMonth() {
            currentMonth--;
            if (currentMonth === -1) {
                currentMonth = 11;
                currentYear--;
            }
            renderCalendar(currentMonth, currentYear);
        }

        // Function to show next month
        function nextMonth() {
            currentMonth++;
            if (currentMonth === 12) {
                currentMonth = 0;
                currentYear++;
            }
            renderCalendar(currentMonth, currentYear);
        }
    </script>
    <script>
        AOS.init();
    </script>
</body>

</html>