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
                <a href="{{ route('home.index') }}">
                    <div class="flex gap-5 items-center ml-3">
                        <div class="w-6 h-6 overflow-hidden">
                            <img src="/images/homeIcon.png" alt="homeIcon" class="w-full h-full object-cover">
                        </div>
                        <p class="text-gray-500 font-semibold text-sm">Beranda</p>
                    </div>
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
            <p class="font-bold text-lg">Tambah Acara</p>
            <form action="{{ route('acaras.store') }}" class="flex-auto bg-white rounded-3xl shadow-xl mt-2 p-5" method="POST" enctype="multipart/form-data">
                @csrf
                <!-- Konten kanan di sini -->
                <div class="grid grid-cols-2 gap-8">
                    <!-- inputan kiri -->
                    <div class="flex flex-col gap-3">
                        <!-- judul -->
                        <p class="font-semibold text-gray-500">Judul</p>
                        <input type="text" name="judul" id="judul" class="border-2 rounded-lg py-2 px-3 focus:outline-none focus:border-[#c2ebc1]" required>
                        <!-- tempat -->
                        <p class="font-semibold text-gray-500">Tempat</p>
                        <input type="text" name="tempat" id="tempat" class="border-2 rounded-lg py-2 px-3 focus:outline-none focus:border-[#c2ebc1]" required>
                        <!-- absen -->
                        <p class="font-semibold text-gray-500">Absen</p>
                        <div class="relative">
                            <select name="absen" id="absen" class="appearance-none border-2 rounded-lg py-2 px-3 focus:outline-none focus:border-[#c2ebc1] w-full" required>
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
                        <input type="date" name="tanggal" id="tanggal" class="border-2 rounded-lg py-2 px-3 focus:outline-none focus:border-[#c2ebc1]" required>
                        <!-- jam -->
                        <label for="jam_range" class="font-semibold text-gray-500">Jam</label>
                        <input type="time" name="jam" id="jam" class="border-2 rounded-lg py-2 px-3 focus:outline-none focus:border-[#c2ebc1] w-full" placeholder="Contoh: 08:00 - 08:30" required>
                        <!-- Kategori -->
                        <p class="font-semibold text-gray-500">Kategori</p>
                        <div class="relative">
                            <select name="kategori" id="kategori" class="appearance-none border-2 rounded-lg py-2 px-3 focus:outline-none focus:border-[#c2ebc1] w-full" required>
                                <option value="" disabled selected class="text-gray-500">Pilih Kategori</option>
                                <option value="Peserta">Peserta</option>
                                <option value="Panitia">Panitia</option>
                                <option value="Narasumber">Narasumber</option>
                            </select>
                        </div>
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
                        <a href="{{ route('home.index') }}" class=" text-[#b72026] font-bold text-center small-font">Batal</a>

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