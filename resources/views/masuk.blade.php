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
    <title>Masuk</title>
</head>

<body class="bg-[#efefef]">
    <div class="flex overflow-hidden h-screen">
        <!-- Kiri -->
        <div class="flex-auto bg-white">
            <img src="/images/gedungbrk.png" alt="" class="w-full h-full opacity-50">
        </div>
        <!-- Kanan -->
        <div class="relative lg:h-[100vh] md:h-[90vh] flex-none w-[35%] my-auto">
            <div class="mx-5">
                <div class="w-36 overflow-hidden mx-auto md:mt-28 lg:mt-32">
                    <img src="images/logobrkacademy.png" alt="logoBrkAcademy" class="w-full object-contain">
                </div>
                <p class="font-bold text-xl mt-8">Masuk</p>
                @if ($errors->any())
                    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
                    <script>
                    // Menampilkan SweetAlert untuk setiap pesan kesalahan
                    @foreach ($errors->all() as $error)
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: '{{ $error }}'
                        });
                    @endforeach
                    </script>
                @endif
                @if (session('error'))
                    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
                    <script>
                        // Menampilkan SweetAlert jika ada pesan kesalahan dari sesi
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: '{{ session('error') }}'
                        });
                    </script>
                @endif
                <form id="loginForm" action="{{ route('actionlogin') }}" method="post">
                    @csrf
                    <div class="flex flex-col mt-5 gap-5">
                        <!-- email -->
                        <input type="email" placeholder="Masukkan Email" id="email" name="email" class="p-2 w-full md:w-full h-12 rounded-xl shadow-xl text-sm" required>
                        <!-- password -->
                        <input type="password" placeholder="Masukkan password" id="password" name="password" class="p-2 w-full md:w-full h-12 rounded-xl shadow-xl text-sm" required>
                        <!-- latitude dan longitude -->
                        <input type="hidden" id="latitude" name="latitude">
                        <input type="hidden" id="longitude" name="longitude">
                    </div>
                    <!-- button -->
                    <button type="submit" class="p-2 w-full md:w-full h-12 rounded-xl mt-14 text-white font-bold bg-[#03ad00] text-sm">Masuk</button>
                </form>
            </div>
            <!-- motif melayu -->
            <div class="absolute bottom-0 w-[100%] h-36">
                <img src="/images/motifMelayu.png" alt="" class="w-full h-full">
            </div>
        </div>
    </div>
    <!-- Js Aos -->
    <script>
        AOS.init();

        document.getElementById('loginForm').addEventListener('submit', function(event) {
            event.preventDefault();
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    document.getElementById('latitude').value = position.coords.latitude;
                    document.getElementById('longitude').value = position.coords.longitude;
                    console.log('Latitude:', position.coords.latitude, 'Longitude:', position.coords.longitude);
                    document.getElementById('loginForm').submit();
                }, function(error) {
                    alert('Geolocation error: ' + error.message);
                });
            } else {
                alert("Geolocation is not supported by this browser.");
            }
        });
    </script>
</body>

</html>
