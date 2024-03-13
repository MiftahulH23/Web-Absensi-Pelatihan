<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <link rel="icon" href="images/logokecil.png" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="icon" href="images/logokecil.png" type="image/x-icon">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <title>Terima Kasih</title>
</head>

<body class="bg-[#efefef]">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-xl md:max-w-md mx-auto mt-16">
            <div class="bg-red-500 w-full h-2 rounded-t-xl"></div>
            <p class="text-center mt-8 font-semibold text-lg">Terima Kasih Telah Melakukan Absen pada Acara Pelatihan {Judul Pelatihan }</p>
            <p class="text-center mt-8">Kunjungi link di bawah ini:</p>
            <div class="text-center pb-8">
                <a href="https://academy.brks-institute.com/" class="text-sky-500 inline-block">https://academy.brks-institute.com</a>
            </div>
        </div>
    </div>
    <!-- logo -->
    <div class="w-40 overflow-hidden mt-5 mx-auto">
        <img src="images/logobrk.png" alt="logoBrk" class="w-full object-cover opacity-50">
    </div>
    <div class="w-36 overflow-hidden mt-5 mx-auto">
        <img src="images/logobrkacademy.png" alt="logoBrkAcademy" class="w-full object-cover opacity-50">
    </div>
    <!-- gedung brk -->
    <div class="w-80 overflow-hidden ml-16 mt-14 fixed right-0 bottom-0">
        <img src="/images/gedungbrk.png" alt="logo" class="object-cover w-full h-full opacity-50">
    </div>
</body>
</html>