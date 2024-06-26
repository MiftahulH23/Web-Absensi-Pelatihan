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
                <a href="{{ route('home.index') }}">
                    <div class="flex gap-5 items-center ml-3">
                        <div class="w-6 h-6 overflow-hidden">
                            <img src="/images/homeIcon.png" alt="homeIcon" class="w-full h-full object-cover">
                        </div>
                        <p class="text-gray-500 font-semibold text-sm">Beranda</p>
                    </div>
                </a>
                <!-- Tambah Acara -->
                <a href="{{ route('tambahAcara') }}" class="flex gap-5 items-center ml-3">
                    <div class="w-6 h-6 overflow-hidden">
                        <img src="/images/addEventIcon.png" alt="addEventIcon" class="w-full h-full object-cover">
                    </div>
                    <p class="text-gray-500 font-semibold text-sm" style="font-size: 0.875rem;">Tambah Acara</p>
                </a>
                <!-- Riwayat -->
                <a href="{{ route('acaras.index') }}" class="flex gap-5 items-center ml-3">
                    <div class="w-6 h-6 overflow-hidden">
                        <img src="/images/daftarAcara.png" alt="riwayatIcon" class="w-full h-full object-cover">
                    </div>
                    <p class="text-gray-500 font-semibold text-sm">Daftar Acara</p>
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
            <p class="font-bold text-lg">Edit Acara</p>
            <form action="{{ route('acaras.update', $acara->id) }}" method="POST" enctype="multipart/form-data" class="flex-auto bg-white rounded-3xl shadow-xl mt-2 p-5">
                @csrf
                @method('PUT') <!-- Menggunakan metode PUT -->
                <!-- Konten Form -->
                <div class="grid grid-cols-2 gap-8">
                    <!-- Input kiri -->
                    <div class="flex flex-col gap-3">
                        <!-- Judul -->
                        <p class="font-semibold text-gray-500">Judul</p>
                        <input type="text" name="judul" id="judul" class="border-2 rounded-lg py-2 px-3 focus:outline-none focus:border-[#c2ebc1]" value="{{ $acara->judul }}">
                        <!-- Tempat -->
                        <p class="font-semibold text-gray-500">Tempat</p>
                        <input type="text" name="tempat" id="tempat" class="border-2 rounded-lg py-2 px-3 focus:outline-none focus:border-[#c2ebc1]" value="{{ $acara->tempat }}">
                        <!-- Absen -->
                        <p class="font-semibold text-gray-500">Absen</p>
                        <div class="relative">
                            <select name="absen" id="absen" class="appearance-none border-2 rounded-lg py-2 px-3 focus:outline-none focus:border-[#c2ebc1] w-full">
                                <option value="pagi" {{ $acara->absen === 'pagi' ? 'selected' : '' }}>Pagi</option>
                                <option value="siang" {{ $acara->absen === 'siang' ? 'selected' : '' }}>Siang
                                </option>
                                <option value="sore" {{ $acara->absen === 'sore' ? 'selected' : '' }}>Sore</option>
                            </select>
                        </div>
                    </div>
                    <!-- Input kanan -->
                    <div class="flex flex-col gap-3">
                        <!-- Tanggal -->
                        <p class="font-semibold text-gray-500">Tanggal</p>
                        <input type="date" name="tanggal" id="tanggal" class="border-2 rounded-lg py-2 px-3 focus:outline-none focus:border-[#c2ebc1]" value="{{ $acara->tanggal }}">
                        <!-- Jam -->
                        <p class="font-semibold text-gray-500">Jam</p>
                        <input type="time" name="jam" id="jam" class="border-2 rounded-lg py-2 px-3 focus:outline-none focus:border-[#c2ebc1] w-full" placeholder="Contoh: 08:00 - 08:30" value="{{ $acara->jam }}">
                        <!-- Kategori -->
                        <p class="font-semibold text-gray-500">Kategori</p>
                        <div class="relative">
                            <select name="kategori" id="kategori" class="appearance-none border-2 rounded-lg py-2 px-3 focus:outline-none focus:border-[#c2ebc1] w-full" required>
                                <option value="" disabled selected class="text-gray-500">Pilih Kategori</option>
                                <option value="Peserta" {{ $acara->kategori === 'Peserta' ? 'selected' : '' }}>Peserta</option>
                                <option value="Narasumber" {{ $acara->kategori === 'Narasumber' ? 'selected' : '' }}>Narasumber</option>
                            </select>
                        </div>
                    </div>
                </div>
                <!-- Tombol Submit -->
                <div class="flex gap-5 mt-5">
                    <!-- OK -->
                    <button type="submit" class="w-[100px] bg-[#c2ebc1] text-[#03ad00] font-bold py-2 rounded-lg">OK</button>
                    <!-- Tombol Batal -->
                    <style>
                        .small-font {
                            font-size: 16px;
                        }
                    </style>
                    <a id="backButton" href="#" class="w-[100px] bg-[#f3d9da] text-[#b72026] font-bold py-2 rounded-lg block text-center small-font" data-from-home="true">Batal</a>
                </div>
            </form>
        </div>
    </div>
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
                cell.classList.add("text-center", "text-gray-500" , "font-semibold");
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