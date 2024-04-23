<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda</title>
    @vite('resources/css/app.css')
    <link rel="icon" href="/images/logokecil.png" type="image/x-icon">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <link rel="stylesheet" href="datepicker.material.css">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/datepicker.js/dist/datepicker.min.css">
    <script src="https://cdn.jsdelivr.net/npm/datepicker.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>

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
        <div class="flex-none w-[18%] bg-white rounded-3xl shadow-xl px-4 lg:h-[82vh] md:h-[90vh] py-8 mt-3">
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
                <div class="bg-gray-300 rounded-xl bg-opacity-40 py-1">
                    <div class="flex gap-5 items-center ml-3">
                        <div class="w-6 h-6 overflow-hidden">
                            <img src="/images/homeIcon.png" alt="homeIcon" class="w-full h-full object-cover">
                        </div>
                        <p class="text-gray-500 font-semibold text-sm">Beranda</p>
                    </div>
                </div>
                <!-- Tambah Acara -->
                <a href="{{ route('tambahAcara') }}" class="flex gap-5 items-center ml-3">
                    <div class="w-6 h-6 overflow-hidden">
                        <img src="/images/addEventIcon.png" alt="addEventIcon" class="w-full h-full object-cover">
                    </div>
                    <p class="text-gray-500 font-semibold text-sm">Tambah Acara</p>
                </a>
                <!-- Riwayat -->
                <a href="{{ route('acaras.index') }}" class="flex gap-5 items-center ml-3">
                    <div class="w-6 h-6 overflow-hidden">
                        <img src="/images/historyIcon.png" alt="riwayatIcon" class="w-full h-full object-cover">
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
            <!-- data-without=" [2/13/2016,2/14/2016,2/17/2016]" -->
        </div>
        <!-- kanan -->
        <div class="flex flex-col w-full">
            <p class="font-bold text-lg">Beranda</p>
            <div class="flex-auto bg-white rounded-3xl shadow-xl mt-2 p-5">
                <!-- Konten kanan di sini -->
                <div class="w-full rounded-3xl overflow-hidden shadow-lg">
                    <img src="/images/bannerWeb.png" alt="banner" class="w-full h-full object-fill">
                </div>
                <p class="font-bold text-xl mt-3">Acara yang Sedang Berlangsung</p>
                @if(count($acaraSedangBerlangsung) > 0)
                <ul class="">
                    @foreach($acaraSedangBerlangsung as $acara)
                    <div class="w-full bg-[#CCCCCC] mt-3 bg-opacity-20 h-fitt py-3 px-4 rounded-3xl border shadow-md flex justify-between items-center">
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
                            <a href="{{ route('acaras.show', ['id' => $acara->id]) }}" class="w-5 h-5 overflow-hidden">
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
                </ul>
                @else
                <div class="flex justify-start">
                    <p class="bg-[#b72026] text-center px-2 py-1 rounded-xl text-[#fff]">Sedang tidak ada acara berlangsung</p>
                </div>
                @endif
            </div>
        </div>

    </div>
    <!-- Inisialisasi datepicker -->
    <script src="datepicker.js"></script>
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
    <!-- Other Scripts -->
    <script>
        AOS.init();
    </script>
</body>

</html>