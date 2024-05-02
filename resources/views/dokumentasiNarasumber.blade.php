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
            <img src="/images/logobrkacademy.png" alt="logobrkacademy" class="w-full h-full object-cover">
        </div>
        <!-- take foto -->
        <div class="mx-5 mb-2 mt-4">
            <div class="h-full w-full md:h-full md:w-full bg-white flex flex-col justify-center items-center p-4 rounded-2xl shadow-xl">
                <p class="font-semibold text-lg">Konfirmasi Foto</p>
                <div class="relative w-56 h-64">
                    <div id="fotoContainer" class="w-full h-full overflow-hidden">
                        <video id="video" autoplay class="rounded-xl w-full h-full object-cover"></video>
                        <div id="dateTime" class="absolute bottom-0 left-0 text-white p-2">
                            <span id="time"></span> <span id="date"></span>
                        </div>
                    </div>
                    <!-- ulangi -->
                    <div class="absolute top-3 right-3" id="ulangiFoto">
                        <img id="clear" src="/images/Vector.png" alt="Ulangi Foto" class="w-4 h-4 z-0">
                    </div>
                </div>
                <form id="fotoForm" method="POST" action="{{ route('simpan.fotoNarasumber',['id'=>$id]) }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" id="foto" name="image">
                    <button type="button" id="ambilFotoBtn" class="w-52 h-fitt py-2 text-center bg-[#f5df66] mt-3 rounded-full">Ambil Foto</button>
                </form>
                <button type="submit" id="kirimBtn" class="w-52 text-white h-fitt py-2 text-center bg-[#03ad00] mt-3 rounded-full">Kirim</button>
            </div>
        </div>
    </div>
    <!-- motifmelayu -->
    <div class="w-full h-[85px] mt-20 fixed bottom-0">
        <img src="/images/motifMelayu.png" alt="" class="w-full h-full object-cover">
    </div> 
    <!-- js -->
    <script>
        var intervalID;
        document.addEventListener("DOMContentLoaded", function() {
            var ambilFotoBtn = document.getElementById('ambilFotoBtn');
            var clearFotoBtn = document.getElementById('clear');
            var kirimBtn = document.getElementById('kirimBtn');

            ambilFotoBtn.addEventListener('click', function() {
                captureSnapshot();
                clearInterval(intervalID);
            });

            clearFotoBtn.addEventListener('click', function() {
                clearFoto();
            });
            kirimBtn.addEventListener('click', function() {
                kirimFoto();
            });

            navigator.mediaDevices.getUserMedia({
                video: true
            }).then(function(stream) {
                var video = document.getElementById('video');
                video.srcObject = stream;
            }).catch(function(err) {
                console.log("Tidak dapat mengakses kamera: " + err);
            });

            // Inisialisasi updateTime() untuk menampilkan waktu pada awalnya
            updateTime();

            // Jika ambilFotoBtn diklik, hentikan pembaruan waktu
            ambilFotoBtn.addEventListener('click', function() {
                clearInterval(intervalID);
            });
        });

        function captureSnapshot() {
            var video = document.getElementById('video');
            var canvas = document.createElement('canvas');
            canvas.width = video.videoWidth;
            canvas.height = video.videoHeight;
            var context = canvas.getContext('2d');
            context.drawImage(video, 0, 0, canvas.width, canvas.height);

            // Menambahkan waktu ke dalam gambar
            var now = new Date();
            var time = now.toLocaleTimeString();
            var date = now.toLocaleDateString('en-US', {
                year: 'numeric',
                month: '2-digit',
                day: '2-digit'
            });

            // Menentukan ukuran dan posisi teks
            context.font = "bold 32px Arial";
            context.fillStyle = "white";
            context.textAlign = "left"; // Mengatur posisi teks menjadi di sebelah kiri
            context.fillText(date + ' ' + time, 140, 450); // Mengatur posisi teks pada (10, 30)

            var imageDataURL = canvas.toDataURL('image/png');

            // Menampilkan foto di dalam elemen fotoContainer
            var fotoContainer = document.getElementById('fotoContainer');
            fotoContainer.innerHTML = ''; // Menghapus konten sebelumnya
            var foto = document.createElement('img');
            foto.src = imageDataURL;
            foto.alt = 'Foto yang diambil';
            foto.className = 'rounded-xl w-full h-full object-cover';
            fotoContainer.appendChild(foto);

            // Menyimpan URL gambar di dalam input tersembunyi
            document.getElementById('foto').value = imageDataURL;
        }



        function clearFoto() {
            // Hapus konten fotoContainer
            var fotoContainer = document.getElementById('fotoContainer');
            fotoContainer.innerHTML = '';

            // Tampilkan kembali video
            var video = document.createElement('video');
            video.id = 'video';
            video.autoplay = true;
            video.className = 'rounded-xl w-full h-full object-cover';
            fotoContainer.appendChild(video);

            // Tampilkan waktu lagi
            var dateTime = document.createElement('div');
            dateTime.id = 'dateTime';
            dateTime.className = 'absolute bottom-0 left-0 text-white p-2';
            fotoContainer.appendChild(dateTime);

            // Mulai kembali pembaruan waktu
            intervalID = setInterval(updateTime, 1000);

            // Atur kamera kembali
            navigator.mediaDevices.getUserMedia({
                video: true
            }).then(function(stream) {
                var video = document.getElementById('video');
                video.srcObject = stream;
            }).catch(function(err) {
                console.log("Tidak dapat mengakses kamera: " + err);
            });
        }

        function kirimFoto() {
            var fotoContainer = document.getElementById('fotoContainer');
            var foto = fotoContainer.querySelector('img');
            var imageDataURL = foto.src;
            document.getElementById('foto').value = imageDataURL;
            document.getElementById('fotoForm').submit();
            console.log(imageDataURL)

        }

        // fungsi untuk menampilkan waktu secara real-time
        function updateTime() {
            var now = new Date();
            var date = now.toLocaleDateString('en-US', {
                year: 'numeric',
                month: '2-digit',
                day: '2-digit'
            });
            var time = now.toLocaleTimeString();
            document.getElementById('dateTime').innerText = date + ' ' + time;
        }

        // pemanggilan fungsi updateTime() setiap detik
        intervalID = setInterval(updateTime, 1000);
    </script>
    <script>
        // Ketika tombol "Kirim" ditekan
        document.getElementById('kirimBtn').addEventListener('click', function() {
            kirimFoto();
        });
    </script>
</body>

</html>