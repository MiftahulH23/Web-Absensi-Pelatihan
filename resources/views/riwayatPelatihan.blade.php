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
    <title>Riwayat Pelatihan</title>
</head>

<body class="bg-[#efefef] mx-5 mt-5 overflow-hidden">
    <!-- Header -->
    <div class="w-full bg-white rounded-lg h-fitt py-3 shadow-xl">
        <div class="overflow-hidden w-36 ml-5">
            <img src="/images/logobrk.png" alt="" class="w-full h-full object-cover">
        </div>
    </div>
    <!-- Main Content -->
    <div class="flex mt-5 gap-5 h-full">
        <!-- kiri -->
        <div class="flex-none w-[20%] bg-white rounded-lg shadow-xl overflow-y-auto" style="height: calc(104vh - 116px - 80px);"><!-- 116px adalah total tinggi elemen-elemen di atasnya (Header), 20px adalah margin bottom -->
            <div>
            </div>
        </div>
        <!-- kanan -->
        <div class="flex flex-col w-full">
            <p class="font-bold text-xl">Riwayat Pelatihan</p>
            <div class="flex-auto bg-white rounded-lg shadow-xl mt-2 p-5" style="height: calc(100vh - 116px - 20px);">
                <div class="w-full bg-[#CCCCCC] opacity-50 h-10">
                    <p>1.Pelatihan Sppur</p>
                </div>
            </div>
        </div>
    </div>
</body>




</html>