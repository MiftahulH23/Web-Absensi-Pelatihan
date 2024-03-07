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
    <!-- Signature pad -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.css">

    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <link type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/south-street/jquery-ui.css" rel="stylesheet">
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script type="text/javascript" src="http://keith-wood.name/js/jquery.signature.js"></script>

    <link rel="stylesheet" type="text/css" href="http://keith-wood.name/css/jquery.signature.css">
    <title>Form Absensi</title>
</head>

<body data-aos="zoom-in" data-aos-duration="3000" class="bg-[#efefef]">
    <p class="font-semibold text-xl text-center mt-2">Form Absensi</p>
    <div class="container">
        <!-- Nama Lengkap -->
        <div class="flex flex-col mt-3">
            <p class="font-semibold ">Nama Lengkap</p>
            <input type="text" id="namalengkap" name="namalengkap" class="p-2 w-full md:w-full h-9 rounded-xl">
        </div>
        <!--No Rekening -->
        <div class="flex flex-col gap-1 mt-1">
            <p class="font-semibold ">Nomor Rekening</p>
            <input type="text" id="norek" name="norek" class="p-2 w-full md:w-full h-9 rounded-xl">
        </div>
        <!-- Nik -->
        <div class="flex flex-col gap-1 mt-1">
            <p class="font-semibold ">Nik</p>
            <input type="text" id="nik" name="nik" class="p-2 w-full md:w-full h-9 rounded-xl">
        </div>
        <!-- Level Jabatan -->
        <div class="flex flex-col gap-1 mt-1">
            <label for="levelJabatan" class="font-semibold">Level Jabatan</label>
            <select id="levelJabatan" name="levelJabatan" class="p-2 w-full md:w-full h-9 rounded-xl bg-white bg-opacity-90 text-base">
                <option value="" disabled selected class="text-sm">- Pilih Level Jabatan -</option>
                <option value="divisi_a" class="text-sm">Divisi A</option>
                <option value="divisi_b" class="text-sm">Divisi B</option>
                <option value="divisi_c" class="text-sm">Divisi C</option>
            </select>
        </div>
        <!-- Jabatan -->
        <div class="flex flex-col gap-1 mt-1">
            <label for="jabatan" class="font-semibold" class="text-sm">Jabatan/Unit Kantor</label>
            <select id="jabatan" name="jabatan" class="p-2 w-full md:w-full h-9 rounded-xl bg-white bg-opacity-90 text-base">
                <option value="" disabled selected>- Pilih Jabatan -</option>
                <option value="divisi_a" class="text-sm">Divisi A</option>
                <option value="divisi_b" class="text-sm">Divisi B</option>
                <option value="divisi_c" class="text-sm">Divisi C</option>
            </select>
        </div>
        <!-- Unit Kantor -->
        <div class="flex flex-col gap-1 mt-1">
            <label for="unitKantor" class="font-semibold">Jabatan/Unit Kantor</label>
            <select id="unitKantor" name="unitKantor" class="p-2 w-full md:w-full h-9 rounded-xl bg-white bg-opacity-90 text-base">
                <option value="" disabled selected class="text-sm">- Pilih Unit Kantor -</option>
                <option value="divisi_a" class="text-sm">Divisi A</option>
                <option value="divisi_b" class="text-sm">Divisi B</option>
                <option value="divisi_c" class="text-sm">Divisi C</option>
            </select>
        </div>
        <!-- Dokumentasi -->
        <div class="flex flex-col gap-1 mt-1">
            <p class="font-semibold ">Dokumentasi</p>
            <div class="relative w-full md:w-full h-9 rounded-xl bg-white opacity-90">
                <input type="text" accept="image/*" capture="camera" id="dokumentasi" name="dokumentasi" class="w-full h-full object-cover rounded-xl bg-transparent" />
                <!-- Logo Input -->
                <img src="images/input.png" alt="Logo" class="h-6 absolute top-0 right-0 z-10 m-1">
            </div>
        </div>
        <!-- Tanda Tangan -->
        @if ($message = Session::get('success'))
        <div class="alert alert-success  alert-dismissible">

            <strong>{{ $message }}</strong>
        </div>
        @endif
        <form>
            @csrf
            <div class="flex flex-col gap-1 mt-1 rounded-xl">
                <p class="font-semibold">Tanda Tangan</p>
                <div id="sig" class="relative w-full rounded-xl md:w-full h-36 bg-white opacity-90">
                    <div class="absolute top-0 right-0">
                        <img id="clear" src="images/clear.png" alt="Hapus Tanda Tangan" class="w-12 h-12 z-0">
                    </div>
                </div>
            </div>
        </form>
        <div class="grid place-items-center">
            <button type="submit" class="bg-[#b72026] px-7 py-2 text-white font-semibold text-lg rounded-xl mt-3 ">Submit</button>
        </div>
    </div>
    <div class="w-96 overflow-hidden ml-16 fixed right-0 -bottom-16 -z-10">
        <img src="/images/gedungbrk.png" alt="logo" class="object-cover w-full h-full">
    </div>
    <!-- js Tanda Tangan -->
    <script type="text/javascript">
        var sig = $('#sig').signature({
            syncField: '#signature64',
            syncFormat: 'PNG'
        });
        $('#clear').click(function(e) {
            e.preventDefault();
            sig.signature('clear');
            $("#signature64").val('');
        });
    </script>

    <!-- Js Aos -->
    <script>
        AOS.init();
    </script>
</body>

</html>