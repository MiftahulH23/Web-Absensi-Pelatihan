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
                <div class="flex flex-col mt-5 gap-5">
                    <!-- nama -->
                    <input type="text" placeholder="Masukkan Nama" id="namaAdmin" name="namaAdmin" class="p-2 w-full md:w-full h-12 rounded-xl shadow-xl text-sm">
                    <!-- password -->
                    <input type="text" placeholder="Masukkan password" id="password" name="password" class="p-2 w-full md:w-full h-12 rounded-xl shadow-xl text-sm">
                </div>
                <!-- button -->
                <button class="p-2 w-full md:w-full h-12 rounded-xl mt-14 text-white font-bold bg-[#03ad00] text-sm">Masuk</button>
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
