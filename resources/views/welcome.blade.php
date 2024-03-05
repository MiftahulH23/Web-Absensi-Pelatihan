<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <title>Document</title>
</head>
<body>
    <div>
        <div class="container grid place-items-center mt-16">
            <div class="w-60 h-20 overflow-hidden">
                <img src="/images/logobrk.png" alt="logo" class="object-cover">
            </div>
            <div class="relative mt-8">
                <div class="w-full h-2 overflow-hidden mt-24">
                    <img src="/images/linered.png" alt="line" class="object-cover">
                </div>
                <div class="w-8 h-20 overflow-hidden mt-32 absolute -top-14 -right-0" data-aos="fade-right"  data-aos-duration="1000" data-aos-anchor-placement="bottom-bottom" >
                    <img src="/images/logobrkkecil.png" alt="line" class="object-cover">
                </div>
            </div>
        </div>
        <div class="w-80 h-full overflow-hidden ml-16 mt-14">
            <img src="/images/gedungbrk.png" alt="logo" class="object-cover">
        </div>
    </div>
    <script>
        AOS.init();
    </script>
</body>
</html>