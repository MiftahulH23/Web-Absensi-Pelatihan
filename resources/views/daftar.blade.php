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
    <title>Daftar</title>
</head>

<body class="bg-[#efefef]">
    <div class="grid grid-cols-3 overflow-hidden h-screen">
        <!-- Kiri -->
        <div class="col-span-2 bg-white">
            <img src="/images/gedungbrk.png" alt="" class="w-full h-full object-cover opacity-50">
        </div>
        <!-- Kanan -->
        <div class="relative my-auto lg:h-[80vh] md:h-[90vh]">
            <div class="mx-5">
                <div class="w-36 overflow-hidden mx-auto">
                    <img src="images/logobrkacademy.png" alt="logoBrkAcademy" class="w-full object-cover">
                </div>
                <p class="font-bold text-xl mt-8">Daftar</p>
                @if (session('error_message'))
                    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
                    <script>
                        // Menampilkan SweetAlert untuk pesan kesalahan
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            html: '{{ session('error_message') }}' // Gunakan 'html' untuk memastikan pesan kesalahan ditampilkan sebagai HTML
                        });
                    </script>
                @endif

                <form action="{{ route('actiondaftar') }}" method="post">
                    @csrf
                    <div class="flex flex-col mt-5 gap-3">
                        <!-- nama -->
                        <input type="text" placeholder="Masukkan Nama" id="name" name="name" class="p-2 w-full md:w-full h-12 rounded-xl shadow-xl text-sm">
                        <!-- email -->
                        <input type="email" placeholder="Masukkan Email" id="email" name="email" class="p-2 w-full md:w-full h-12 rounded-xl shadow-xl text-sm">
                        <!-- password -->
                        <input type="password" placeholder="Masukkan Password" id="password" name="password" class="p-2 w-full md:w-full h-12 rounded-xl shadow-xl text-sm">
                    </div>
                    <!-- button -->
                    <button type="submit" class="p-2 w-full md:w-full h-12 rounded-xl mt-10 text-white font-bold bg-[#03ad00] text-sm">Daftar</button>
                </form>
            </div>
            <!-- motif melayu -->
            <div class="absolute bottom-0 w-[100%] h-48">
                <img src="/images/motifMelayu.png" alt="" class="w-full h-full">
            </div>
        </div>
    </div>
    <!-- Js Aos -->
    <script>
        AOS.init();
    </script>
</body>

</html>
