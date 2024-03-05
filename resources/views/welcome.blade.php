<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <title>Selamat Datang</title>
</head>
<body>
    <div>
        <div class="container grid place-items-center mt-16">
            <div class="w-60 h-20 overflow-hidden">
                <img src="/images/logobrk.png" alt="logo" class="object-cover">
            </div>
            <div class="relative mt-8 animate-line">
                <div class="w-full h-2 overflow-hidden mt-24 ml-2">
                    <img src="/images/linered.png" alt="line" class="object-cover">
                </div>
                <div class="w-20 h-20 overflow-hidden mt-32 absolute -top-[82px] -left-7">
                    <img src="/images/logokecil.png" alt="line" class="object-cover ">
                </div>
            </div>
        </div>
        <div class="w-80 overflow-hidden ml-16 mt-14 fixed right-0 bottom-0">
            <img src="/images/gedungbrk.png" alt="logo" class="object-cover w-full h-full">
        </div>
    </div>
    <script>
        AOS.init();
    </script>
    <script>
        var scanRoute = "{{ route('scanqr')}}";
        setTimeout(function() {
            window.location.href = scanRoute
        }, 3000);
    </script>
</body>
</html>