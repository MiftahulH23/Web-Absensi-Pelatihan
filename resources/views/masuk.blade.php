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
    <title>Masuk</title>
</head>

<body class="bg-[#efefef]">
    <div class="grid grid-cols-3 overflow-hidden h-screen">
        <!-- Kiri -->
        <div class="col-span-2 bg-white">
            <img src="/images/gedungbrk.png" alt="" class="w-full h-full object-cover opacity-50">
        </div>
        <!-- Kanan -->
        <div class="relative my-auto h-screen">
            <div class="mx-5">
                <div class="w-36 overflow-hidden mx-auto">
                    <img src="images/logobrkacademy.png" alt="logoBrkAcademy" class="w-full object-cover">
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
                <form action="{{ route('actionlogin') }}" method="post">
                    @csrf
                    <div class="flex flex-col mt-5 gap-5">
                        <!-- nama -->
                        <input type="email" placeholder="Masukkan Email" id="email" name="email" class="p-2 w-full md:w-full h-12 rounded-xl shadow-xl text-sm">
                        <!-- password -->
                        <input type="password" placeholder="Masukkan password" id="password" name="password" class="p-2 w-full md:w-full h-12 rounded-xl shadow-xl text-sm">
                    </div>
                    <!-- button -->
                    <button class="p-2 w-full md:w-full h-12 rounded-xl mt-14 text-white font-bold bg-[#03ad00] text-sm">Masuk</button>
                </form>
            </div>
            <!-- motif melayu -->
            <div class="absolute bottom-20 right-0 mb-5">
                <img src="/images/motifMelayu.png" alt="" class="w-[410px] h-auto">
            </div>
        </div>
    </div>
    <!-- Js Aos -->
    <script>
        AOS.init();
    </script>
</body>

</html>