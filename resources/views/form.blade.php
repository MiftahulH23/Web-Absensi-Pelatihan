<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="icon" href="images/logokecil.png" type="image/x-icon">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <title>Scan QR</title>
</head>
<body  data-aos="zoom-in" data-aos-duration="3000" class="bg-[#efefef]" >
    <p class="font-semibold text-xl text-center mt-2">Form Absensi</p>
    <div class="container">
        <!-- Nama Lengkap -->
        <div class="flex flex-col gap-2 mt-1 ml-4">
            <p class="font-semibold ">Nama Lengkap</p>
            <input type="text" id="namalengkap" name="namalengkap" class="w-[350px] h-9 rounded-xl"> 
        </div>
        <!--No Rekening -->
        <div class="flex flex-col gap-2 mt-1 ml-4">
            <p class="font-semibold ">Nomor Rekening</p>
            <input type="text" id="norek" name="norek" class="w-[350px] h-9 rounded-xl"> 
        </div>
        <!-- Nik -->
        <div class="flex flex-col gap-2 mt-1 ml-4">
            <p class="font-semibold ">Nik</p>
            <input type="text" id="nik" name="nik" class="w-[350px] h-9 rounded-xl"> 
        </div>
        <!-- Jabatan/Unit Kantor -->
        <div class="flex flex-col gap-2 mt-1 ml-4">
            <p class="font-semibold ">Jabatan/Unit Kantor</p>
            <input type="text" id="jabatan/uk" name="jabatan/uk" class="w-[350px] h-9 rounded-xl bg-white bg-opacity-90"> 
        </div>
        <!-- Dokumentasi -->
        <div class="flex flex-col gap-2 mt-1 ml-4">
            <p class="font-semibold ">Dokumentasi</p>
            <input type="text" accept="image/*" capture="camera" id="dokumentasi" name="dokumentasi" class="w-[350px] h-9 rounded-xl bg-white bg-opacity-90"> 
        </div>
        <!-- Tanda Tangan -->
        <div class="flex flex-col gap-2 mt-1 ml-4">
            <p class="font-semibold ">Tanda Tangan</p>
            <input type="text" id="jabatan/uk" name="jabatan/uk" class="w-[350px] h-36 rounded-xl bg-white bg-opacity-90"> 
        </div>
        <div class="grid place-items-center"> 
            <button type="submit" class="bg-[#b72026] px-7 py-2 text-white font-semibold text-lg rounded-xl mt-5 ">Submit</button>
        </div>
    </div>
    <div class="w-96 overflow-hidden ml-16 fixed right-0 -bottom-20 -z-10">
        <img src="/images/gedungbrk.png" alt="logo" class="object-cover w-full h-full">
    </div>
    <script>
        AOS.init();
    </script>
</body>
</html>