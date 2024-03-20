<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="icon" href="/images/logokecil.png" type="image/x-icon">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <!-- Signature pad -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.css">

    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <link type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/south-street/jquery-ui.css" rel="stylesheet">
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script type="text/javascript" src="http://keith-wood.name/js/jquery.signature.js"></script>

    <link rel="stylesheet" type="text/css" href="http://keith-wood.name/css/jquery.signature.css">
    <title>Dokumentasi</title>
</head>
<body class="bg-[rgb(239,239,239)] h-fit">
    <div class="container flex flex-col justify-center items-center">
        <!-- selamat datang -->
        <p class="font-bold text-xl text-center mt-4">Selamat Datang</p>
        <!-- logo brks academy -->
        <div class="w-40 overflow-hidden mt-2">
            <img src="images/logobrkacademy.png" alt="logobrkacademy" class="w-full h-full object-cover">
        </div>
        <!-- take foto -->
        <div class="mx-5 mb-2 mt-4">
            <div class="h-full w-full md:h-full md:w-full  bg-white flex flex-col justify-center items-center p-4 rounded-2xl shadow-xl">
                <p class="font-semibold text-lg">Konfirmasi Foto</p>
                <div class="w-56 h-64 md:w-full bg-gray-500 grid place-items-center mt-2 rounded-xl">
                    <p>Camera</p>
                </div>
                <button class="w-52 h-fitt py-2 text-center bg-[#f5df66] mt-3 rounded-full">Ulangi Foto</button>
                <button class="w-52 text-white h-fitt py-2 text-center bg-[#03ad00] mt-3 rounded-full">Ambil Sekarang</button>
            </div>
        </div>
    </div>
    <!-- motifmelayu -->
    <div class="w-full h-[85px] mt-3">
        <img src="images/motifMelayu.png" alt="" class="w-full h-full object-cover">
    </div>
</body>
</html>