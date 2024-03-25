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
                <div id="fotoContainer" class="w-56 h-64 overflow-hidden relative">
                    <video id="video" autoplay class="rounded-xl w-full h-full object-cover"></video>
                    <div class="absolute top-0 right-0">
                        <img id="clear" src="/images/clear.png" alt="Hapus Foto" class="w-12 h-12 z-0">
                    </div>
                    <div id="dateTime" class="absolute bottom-0 left-0 text-white p-2">
                        <span id="time"></span> <span id="date"></span>
                    </div>
                </div>
                <form id="fotoForm" method="POST" action="{{ route('simpan.foto') }}">
                    @csrf
                    <input type="hidden" id="foto" name="image">
                    <button type="button" id="ambilFotoBtn" class="w-52 h-fitt py-2 text-center bg-[#f5df66] mt-3 rounded-full">Ambil Foto</button>
                </form>
                <button type="submit" class="w-52 text-white h-fitt py-2 text-center bg-[#03ad00] mt-3 rounded-full">Kirim</button>
            </div>
        </div>
    </div>
    <!-- motifmelayu -->
    <!-- <div class="w-full h-[85px] mt-20 fixed bottom-0">
        <img src="/images/motifMelayu.png" alt="" class="w-full h-full object-cover">
    </div> -->
    <!-- js -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var ambilFotoBtn = document.getElementById('ambilFotoBtn');
            var clearFotoBtn = document.getElementById('clear');
            ambilFotoBtn.addEventListener('click', function() {
                captureSnapshot();
            });

            clearFotoBtn.addEventListener('click', function() {
                clearFoto();
            });

            navigator.mediaDevices.getUserMedia({
                    video: true
                })
                .then(function(stream) {
                    var video = document.getElementById('video');
                    video.srcObject = stream;
                })
                .catch(function(err) {
                    console.log("Tidak dapat mengakses kamera: " + err);
                });
        });

        function captureSnapshot() {
            var video = document.getElementById('video');
            var canvas = document.createElement('canvas');
            canvas.width = video.videoWidth;
            canvas.height = video.videoHeight;
            var context = canvas.getContext('2d');
            context.drawImage(video, 0, 0, canvas.width, canvas.height);
            var imageDataURL = canvas.toDataURL('image/png');

            // Menampilkan foto di dalam elemen video
            video.style.display = 'none';
            var foto = document.createElement('img');
            foto.src = imageDataURL;
            foto.alt = 'Foto yang diambil';
            foto.className = 'rounded-xl w-full h-full object-cover';
            video.parentNode.replaceChild(foto, video);

            document.getElementById('foto').value = imageDataURL;
        }

        function clearFoto() {
            var video = document.getElementById('video');
            var fotoContainer = document.getElementById('fotoContainer');

            // Menghapus foto yang sedang ditampilkan
            var foto = fotoContainer.querySelector('img');
            if (foto) {
                fotoContainer.removeChild(foto);
            }

            // Menampilkan kembali video
            video.style.display = 'block';

            // Menghentikan track kamera sebelumnya
            var stream = video.srcObject;
            var tracks = stream.getTracks();
            tracks.forEach(function(track) {
                track.stop();
            });

            // Membuka kembali kamera untuk mengambil foto baru
            navigator.mediaDevices.getUserMedia({
                    video: true
                })
                .then(function(stream) {
                    video.srcObject = stream;
                })
                .catch(function(err) {
                    console.log("Tidak dapat mengakses kamera: " + err);
                });
        }
        // waktu
        function updateTime() {
            var now = new Date();
            var date = now.toLocaleDateString('en-US', {
                year: 'numeric',
                month: 'numeric',
                day: 'numeric'
            });
            var time = now.toLocaleTimeString();
            document.getElementById('date').innerText = date;
            document.getElementById('time').innerText = time;
        }

        updateTime(); // initial call
        setInterval(updateTime, 1000); // update every second
    </script>

</body>

</html>