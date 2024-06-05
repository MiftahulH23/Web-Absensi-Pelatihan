<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <link rel="icon" href="/images/logokecil.png" type="image/x-icon">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <!-- Signature pad -->
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.css">

    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <link type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/south-street/jquery-ui.css"
        rel="stylesheet">
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script type="text/javascript" src="http://keith-wood.name/js/jquery.signature.js"></script>
    <link rel="stylesheet" type="text/css" href="http://keith-wood.name/css/jquery.signature.css">
    <!-- CSS Select2 -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />

    <title>Form Absensi</title>

</head>

<body data-aos="zoom-in" data-aos-duration="3000" class="bg-[#efefef]">
    <script>
        // Ambil pesan error jika ada dari session
        @if(session('error'))
            alert('{{ session('error') }}');
        @endif
    </script>
    <div>
        <div class="container grid place-items-center mt-16">
            <div class="w-64 h-28 overflow-hidden flex justify-center items-center">
                <img src="/images/newlogo.png" alt="logo" class="object-cover w-full h-full">
            </div>
            <div class="relative mt-20 animate-line">
                <div class="w-full h-2 overflow-hidden ml-2">
                    <img src="/images/linered.png" alt="line" class="object-cover">
                </div>
                <div class="w-20 h-20 overflow-hidden mt-32 absolute -top-[178px] -left-7">
                    <img src="/images/logokecil.png" alt="line" class="object-cover ">
                </div>
            </div>
        </div>
        <div class="w-80 overflow-hidden ml-16 mt-14 fixed right-0 bottom-0">
            <img src="/images/gedungbrk.png" alt="logo" class="object-cover w-full h-full opacity-50">
        </div>
    </div>

    <!-- Inisialisasi AOS di bagian head -->
    <script>
        // Matikan AOS
        AOS.init({
            disable: true
        });
    </script>

    <!-- JS untuk menunjukkan form absensi -->
    <script>
        // Ketika dokumen selesai dimuat
        $(document).ready(function () {
            // Menyembunyikan elemen form absensi saat dokumen pertama kali dimuat
            $('.form-absensi').hide();
            // Menampilkan form absensi setelah beberapa waktu
            setTimeout(showForm, 3000);
        });

        function showForm() {
            // Ambil lokasi pengguna
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function (position) {
                    document.getElementById('latitude').value = position.coords.latitude;
                    document.getElementById('longitude').value = position.coords.longitude;
                    // Menyembunyikan elemen form absensi
                    $('.form-absensi').fadeIn();
                    // Setelah menampilkan form absensi, maka baru menyembunyikan body
                    $('body[data-aos]').hide();
                    $('.container.grid.place-items-center').hide();
                    $('.w-80.overflow-hidden.ml-16.mt-14.fixed.right-0.bottom-0').hide();
                }, function (error) {
                    alert('Geolocation error: ' + error.message);
                });
            } else {
                alert("Geolocation is not supported by this browser.");
            }
        }
    </script>

    <!-- Form Absensi -->
    <div class="container mt-2 mb-10 form-absensi">
        <p class="font-semibold text-xl text-center mt-2">Form Absensi</p>
        <!-- Form Absensi -->
        <form class="container" action="{{ route('acara.absen.store', ['id' => $acara->id]) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            <!-- Dokumentasi -->
            <div class="flex flex-col gap-1 mt-1">
                <p class="font-semibold">Dokumentasi</p>
                <a href="{{ route('acara.absen.takeFoto', ['id' => $acara->id]) }}" for="foto"
                    class="relative w-full md:w-full p-2 h-9 rounded-xl bg-white opacity-90 cursor-pointer">
                    @if (isset($filename))
                        <input id="fotoContainer" type="text" accept="image/*" capture="camera" id="foto" name="foto"
                            class="hidden" value="{{$filename}}" />
                    @endif
                    <span class="absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none">
                        <!-- Logo Input -->
                        <img src="/images/input.png" alt="" class="h-6">
                    </span>
                    <p id="fileName" class="text-sm">
                        @if (isset($filename))
                            {{ $filename }}
                        @else
                            Ambil Foto
                        @endif
                    </p>
                </a>
            </div>
            <!-- Nama Lengkap -->
            <div class="flex flex-col mt-3">
                <p class="font-semibold ">Nama Lengkap</p>
                <input type="text" id="nama" name="nama" class="p-2 w-full md:w-full h-9 rounded-xl" required>
            </div>
            <!--No Rekening -->
            <div class="flex flex-col gap-1 mt-1">
                <p class="font-semibold ">Nomor Rekening</p>
                <input type="text" id="norek" name="norek" class="p-2 w-full md:w-full h-9 rounded-xl" required>
            </div>
            <!-- Nik -->
            <div class="flex flex-col gap-1 mt-1">
                <p class="font-semibold ">Nik</p>
                <input type="text" id="nik" name="nik" class="p-2 w-full md:w-full h-9 rounded-xl" required>
            </div>
            <!-- Level Jabatan -->
            <div class="flex flex-col gap-1 mt-1">
                <label for="levelJabatan" class="font-semibold">Level Jabatan</label>
                <select id="levelJabatan" name="levelJabatan"
                    class="p-2 w-full md:w-full h-9 rounded-xl bg-white bg-opacity-90 text-base">
                    <option value="" disabled selected class="text-sm">- Pilih Level Jabatan -</option>
                    <option value="divisi_a" class="text-sm">Divisi A</option>
                    <option value="divisi_b" class="text-sm">Divisi B</option>
                    <option value="divisi_c" class="text-sm">Divisi C</option>
                </select>
            </div>
            <!-- Jabatan -->
            <div class="flex flex-col gap-1 mt-1">
                <label for="jabatan" class="font-semibold" class="text-sm">Jabatan</label>
                <select id="jabatan" name="jabatan"
                    class="p-2 w-full md:w-full h-9 rounded-xl bg-white bg-opacity-90 text-base">
                    <option value="" disabled selected>- Pilih Jabatan -</option>
                    <option value="Pemimpin Divisi" class="text-sm">Pemimpin Divisi</option>
                    <option value="Ketua Tim Desk" class="text-sm">Ketua Tim Desk</option>
                    <option value="Pemimpin Cabang Utama" class="text-sm">Pemimpin Cabang Utama</option>
                    <option value="Pinbag KPS" class="text-sm">Pinbag KPS</option>
                    <option value="Pemimpin Cabang" class="text-sm">Pemimpin Cabang</option>
                    <option value="Anggota Tim Desk" class="text-sm">Anggota Tim Desk</option>
                    <option value="Pemimpin Capem" class="text-sm">Pemimpin Capem</option>
                    <option value="Pinbag Cabang" class="text-sm">Pinbag Cabang</option>
                    <option value="Pemimpin Kedai" class="text-sm">Pemimpin Kedai</option>
                    <option value="Pemimpin Seksi/Staf" class="text-sm">Pemimpin Seksi/Staf</option>
                    <option value="Pelaksana & Pegawai Core (PT&PTT)" class="text-sm">Pelaksana & Pegawai Core (PT&PTT)
                    </option>
                    <option value="Pegawai Non Core (PT&PTT)" class="text-sm">Pegawai Non Core (PT&PTT)</option>
                </select>
            </div>
            <!-- Unit Kantor -->
            <div class="flex flex-col gap-1 mt-1">
                <label for="unitKantor" class="font-semibold">Unit Kantor</label>
                <select id="unitKantor" name="unitKantor"
                    class="p-2 w-full md:w-full h-9 rounded-xl bg-white bg-opacity-90 text-base">
                    <option value="" disabled selected class="text-sm">- Pilih Unit Kantor -</option>
                    <option value="BRKS Kantor Pusat" class="text-sm">BRKS Kantor Pusat</option>
                    <option value="Divisi Audit Internal & Anti Fraud" class="text-sm">Divisi Audit Internal & Anti
                        Fraud</option>
                    <option value="Divisi Manajemen Sumber Daya Insani" class="text-sm">Divisi Manajemen Sumber Daya
                        Insani</option>
                    <option value="Divisi Sekretariat Perusahaan" class="text-sm">Divisi Sekretariat Perusahaan</option>
                    <option value="Divisi Kepatuhan" class="text-sm">Divisi Kepatuhan</option>
                    <option value="Divisi Manajemen Risiko" class="text-sm">Divisi Manajemen Risiko</option>
                    <option value="Divisi Hukum" class="text-sm">Divisi Hukum</option>
                    <option value="Divisi Sistem Prosedur & Service Quality" class="text-sm">Divisi Sistem Prosedur &
                        Service Quality</option>
                    <option value="Divisi Operasional & Akuntansi" class="text-sm">Divisi Operasional & Akuntansi
                    </option>
                    <option value="Divisi Teknologi & Sistem Informasi" class="text-sm">Divisi Teknologi & Sistem
                        Informasi</option>
                    <option value="Divisi Umum" class="text-sm">Divisi Umum</option>
                    <option value="Divisi Dana & Digital Banking" class="text-sm">Divisi Dana & Digital Banking</option>
                    <option value="Divisi Treasury & International Banking" class="text-sm">Divisi Treasury &
                        International Banking</option>
                    <option value="Divisi Perencanaan & Keuangan" class="text-sm">Divisi Perencanaan & Keuangan</option>
                    <option value="Divisi Komersial" class="text-sm">Divisi Komersial</option>
                    <option value="Divisi Mikro, Kecil dan Menengah" class="text-sm">Divisi Mikro, Kecil dan Menengah
                    </option>
                    <option value="Divisi Konsumer" class="text-sm">Divisi Konsumer</option>
                    <option value="Divisi Special Asset Management" class="text-sm">Divisi Special Asset Management
                    </option>
                    <option value="BRKS Pekanbaru Sudirman" class="text-sm">BRKS Pekanbaru Sudirman</option>
                    <option value="BRKS Pekanbaru Tangkerang" class="text-sm">BRKS Pekanbaru Tangkerang</option>
                    <option value="BRKS Pekanbaru Rumbai" class="text-sm">BRKS Pekanbaru Rumbai</option>
                    <option value="BRKS Pekanbaru Senapelan" class="text-sm">BRKS Pekanbaru Senapelan</option>
                    <option value="BRKS Pekanbaru Panam" class="text-sm">BRKS Pekanbaru Panam</option>
                    <option value="BRKS Pekanbaru Tuanku Tambusai" class="text-sm">BRKS Pekanbaru Tuanku Tambusai
                    </option>
                    <option value="BRKS Pekanbaru Jalan Riau" class="text-sm">BRKS Pekanbaru Jalan Riau</option>
                    <option value="BRKS Pekanbaru Sukaramai Trade Center" class="text-sm">BRKS Pekanbaru Sukaramai Trade
                        Center</option>
                    <option value="BRKS Pekanbaru Delima Panam" class="text-sm">BRKS Pekanbaru Delima Panam</option>
                    <option value="BRKS Pekanbaru Cabang Utama" class="text-sm">BRKS Pekanbaru Cabang Utama</option>
                    <option value="BRKS Tembilahan" class="text-sm">BRKS Tembilahan</option>
                    <option value="BRKS Inhil Sungai Guntung" class="text-sm">BRKS Inhil Sungai Guntung</option>
                    <option value="BRKS Inhil Kota Baru" class="text-sm">BRKS Inhil Kota Baru</option>
                    <option value="BRKS Tembilahan Pasar Baru" class="text-sm">BRKS Tembilahan Pasar Baru</option>
                    <option value="BRKS Tanjung Pinang" class="text-sm">BRKS Tanjung Pinang</option>
                    <option value="BRKS Lingga Dabo Singkep" class="text-sm">BRKS Lingga Dabo Singkep</option>
                    <option value="BRKS Anambas Tarempa" class="text-sm">BRKS Anambas Tarempa</option>
                    <option value="BRKS Lingga Daik" class="text-sm">BRKS Lingga Daik</option>
                    <option value="BRKS Tanjung Pinang Bintan Center" class="text-sm">BRKS Tanjung Pinang Bintan Center
                    </option>
                    <option value="BRKS Anambas Palmatak" class="text-sm">BRKS Anambas Palmatak</option>
                    <option value="BRKS Anambas Letung" class="text-sm">BRKS Anambas Letung</option>
                    <option value="BRKS Dumai" class="text-sm">BRKS Dumai</option>
                    <option value="BRKS Dumai Pasar Bukit Kapur" class="text-sm">BRKS Dumai Pasar Bukit Kapur</option>
                    <option value="BRKS Dumai Sungai Sembilan" class="text-sm">BRKS Dumai Sungai Sembilan</option>
                    <option value="BRKS Selat Panjang" class="text-sm">BRKS Selat Panjang</option>
                    <option value="BRKS Meranti Tanjung Samak" class="text-sm">BRKS Meranti Tanjung Samak</option>
                    <option value="BRKS Meranti Teluk Belitung" class="text-sm">BRKS Meranti Teluk Belitung</option>
                    <option value="BRKS Batam" class="text-sm">BRKS Batam</option>
                    <option value="BRKS Batam Lubuk Baja" class="text-sm">BRKS Batam Lubuk Baja</option>
                    <option value="BRKS Batam Batu Aji" class="text-sm">BRKS Batam Batu Aji</option>
                    <option value="BRKS Batam Botania" class="text-sm">BRKS Batam Botania</option>
                    <option value="BRKS Batam Tiban" class="text-sm">BRKS Batam Tiban</option>
                    <option value="BRKS Batam Bengkong" class="text-sm">BRKS Batam Bengkong</option>
                    <option value="BRKS Batam SP Plaza" class="text-sm">BRKS Batam SP Plaza</option>
                    <option value="BRKS Batam Nongsa" class="text-sm">BRKS Batam Nongsa</option>
                    <option value="BRKS Batam Belakang Padang" class="text-sm">BRKS Batam Belakang Padang</option>
                    <option value="BRKS Bengkalis" class="text-sm">BRKS Bengkalis</option>
                    <option value="BRKS Bengkalis Duri Hangtuah" class="text-sm">BRKS Bengkalis Duri Hangtuah</option>
                    <option value="BRKS Bengkalis Sungai Pakning" class="text-sm">BRKS Bengkalis Sungai Pakning</option>
                    <option value="BRKS Bengkalis Pasar Pinggir" class="text-sm">BRKS Bengkalis Pasar Pinggir</option>
                    <option value="BRKS Bengkalis Batupanjang Rupat" class="text-sm">BRKS Bengkalis Batupanjang Rupat
                    </option>
                    <option value="BRKS Bengkalis Duri Sudirman" class="text-sm">BRKS Bengkalis Duri Sudirman</option>
                    <option value="BRKS Bengkalis Bantan" class="text-sm">BRKS Bengkalis Bantan</option>
                    <option value="BRKS Bengkalis Rupat Utara" class="text-sm">BRKS Bengkalis Rupat Utara</option>
                    <option value="BRKS Bengkalis Bathin Solapan" class="text-sm">BRKS Bengkalis Bathin Solapan</option>
                    <option value="BRKS Bangkinang" class="text-sm">BRKS Bangkinang</option>
                    <option value="BRKS Kampar Lipat Kain" class="text-sm">BRKS Kampar Lipat Kain</option>
                    <option value="BRKS Kampar Petapahan" class="text-sm">BRKS Kampar Petapahan</option>
                    <option value="BRKS Kampar Pasar Air Tiris" class="text-sm">BRKS Kampar Pasar Air Tiris</option>
                    <option value="BRKS Kampar Pasar Kuok" class="text-sm">BRKS Kampar Pasar Kuok</option>
                    <option value="BRKS Kampar Pasar Sukaramai" class="text-sm">BRKS Kampar Pasar Sukaramai</option>
                    <option value="BRKS Kampar Flamboyan" class="text-sm">BRKS Kampar Flamboyan</option>
                    <option value="BRKS Kampar Kota Bangun" class="text-sm">BRKS Kampar Kota Bangun</option>
                    <option value="BRKS Air Molek" class="text-sm">BRKS Air Molek</option>
                    <option value="BRKS Inhu Belilas" class="text-sm">BRKS Inhu Belilas</option>
                    <option value="BRKS Inhu Pasar Peranap" class="text-sm">BRKS Inhu Pasar Peranap</option>
                    <option value="BRKS Inhu Pasar Rengat" class="text-sm">BRKS Inhu Pasar Rengat</option>
                    <option value="BRKS Inhu Sei Lala" class="text-sm">BRKS Inhu Sei Lala</option>
                    <option value="BRKS Inhu Kuala Kilan" class="text-sm">BRKS Inhu Kuala Kilan</option>
                    <option value="BRKS Tanjung Balai Karimun" class="text-sm">BRKS Tanjung Balai Karimun</option>
                    <option value="BRKS Karimun Tanjung Batu" class="text-sm">BRKS Karimun Tanjung Batu</option>
                    <option value="BRKS Karimun Meral" class="text-sm">BRKS Karimun Meral</option>
                    <option value="BRKS Karimun Ahmad Yani" class="text-sm">BRKS Karimun Ahmad Yani</option>
                    <option value="BRKS Karimun Moro" class="text-sm">BRKS Karimun Moro</option>
                    <option value="BRKS Pangkalan Kerinci" class="text-sm">BRKS Pangkalan Kerinci</option>
                    <option value="BRKS Pelalawan Sorek" class="text-sm">BRKS Pelalawan Sorek</option>
                    <option value="BRKS Pelalawan Pasar Ukui" class="text-sm">BRKS Pelalawan Pasar Ukui</option>
                    <option value="BRKS Pasar Pangkalan Kerinci" class="text-sm">BRKS Pasar Pangkalan Kerinci</option>
                    <option value="BRKS Pelalawan Bandar Sei Kijang" class="text-sm">BRKS Pelalawan Bandar Sei Kijang
                    </option>
                    <option value="BRKS Bagansiapiapi" class="text-sm">BRKS Bagansiapiapi</option>
                    <option value="BRKS Rohil Bagan Batu" class="text-sm">BRKS Rohil Bagan Batu</option>
                    <option value="BRKS Rohil Ujung Tanjung" class="text-sm">BRKS Rohil Ujung Tanjung</option>
                    <option value="BRKS Rohil Pujud" class="text-sm">BRKS Rohil Pujud</option>
                    <option value="BRKS Rohil Kubu" class="text-sm">BRKS Rohil Kubu</option>
                    <option value="BRKS Rohil Panipahan" class="text-sm">BRKS Rohil Panipahan</option>
                    <option value="BRKS Teluk Kuantan" class="text-sm">BRKS Teluk Kuantan</option>
                    <option value="BRKS Kuansing Baserah" class="text-sm">BRKS Kuansing Baserah</option>
                    <option value="BRKS Kuansing Pasar Lubuk Jambi" class="text-sm">BRKS Kuansing Pasar Lubuk Jambi
                    </option>
                    <option value="BRKS Kuansing Pasar Muara Lembu" class="text-sm">BRKS Kuansing Pasar Muara Lembu
                    </option>
                    <option value="BRKS Teluk Kuantan Sudirman" class="text-sm">BRKS Teluk Kuantan Sudirman</option>
                    <option value="BRKS Pasir Pengaraian" class="text-sm">BRKS Pasir Pengaraian</option>
                    <option value="BRKS Rohul Ujung Batu" class="text-sm">BRKS Rohul Ujung Batu</option>
                    <option value="BRKS Rohul Dalu Dalu" class="text-sm">BRKS Rohul Dalu Dalu</option>
                    <option value="BRKS Rohul Kota Tengah" class="text-sm">BRKS Rohul Kota Tengah</option>
                    <option value="BRKS Rohul Kabun" class="text-sm">BRKS Rohul Kabun</option>
                    <option value="BRKS Rohul Tandun" class="text-sm">BRKS Rohul Tandun</option>
                    <option value="BRKS Rohul Rantau Kasai" class="text-sm">BRKS Rohul Rantau Kasai</option>
                    <option value="BRKS Pasir Pengarayan Pasar Lama" class="text-sm">BRKS Pasir Pengarayan Pasar Lama
                    </option>
                    <option value="BRKS Siak Sri Indrapura" class="text-sm">BRKS Siak Sri Indrapura</option>
                    <option value="BRKS Siak Perawang" class="text-sm">BRKS Siak Perawang</option>
                    <option value="BRKS Siak Kandis" class="text-sm">BRKS Siak Kandis</option>
                    <option value="BRKS Siak Sungai Apit" class="text-sm">BRKS Siak Sungai Apit</option>
                    <option value="BRKS Siak Pasar Minas" class="text-sm">BRKS Siak Pasar Minas</option>
                    <option value="BRKS Siak Lubuk Dalam" class="text-sm">BRKS Siak Lubuk Dalam</option>
                    <option value="BRKS Siak Dayun" class="text-sm">BRKS Siak Dayun</option>
                    <option value="BRKS Siak Sabak Auh" class="text-sm">BRKS Siak Sabak Auh</option>
                    <option value="BRKS Siak Kampung Belutu" class="text-sm">BRKS Siak Kampung Belutu</option>
                    <option value="BRKS Ranai" class="text-sm">BRKS Ranai</option>
                    <option value="BRKS Natuna Sedanau" class="text-sm">BRKS Natuna Sedanau</option>
                    <option value="BRKS Natuna Midai" class="text-sm">BRKS Natuna Midai</option>
                    <option value="BRKS Natuna Serasan" class="text-sm">BRKS Natuna Serasan</option>
                    <option value="BRKS Natuna Subi" class="text-sm">BRKS Natuna Subi</option>
                    <option value="BRKS Jakarta" class="text-sm">BRKS Jakarta</option>
                    <option value="BRKS Bintan" class="text-sm">BRKS Bintan</option>
                    <option value="BRKS Bintan Tanjung Uban" class="text-sm">BRKS Bintan Tanjung Uban</option>
                    <option value="BRKS Bintan Kijang" class="text-sm">BRKS Bintan Kijang</option>
                    <option value="BRKS Pekanbaru 2" class="text-sm">BRKS Pekanbaru 2</option>
                    <option value="BRKS Pekanbaru Tenayan Raya" class="text-sm">BRKS Pekanbaru Tenayan Raya</option>
                    <option value="BRKS Pekanbaru Marpoyan" class="text-sm">BRKS Pekanbaru Marpoyan</option>
                    <option value="BRKS Pekanbaru Pasar Sail" class="text-sm">BRKS Pekanbaru Pasar Sail</option>
                    <option value="BRKS Pekanbaru Durian" class="text-sm">BRKS Pekanbaru Durian</option>
                    <option value="BRKS Pekanbaru Pasar Pagi Arengka" class="text-sm">BRKS Pekanbaru Pasar Pagi Arengka
                    </option>
                    <option value="BRKS Pekanbaru Garuda Sakti" class="text-sm">BRKS Pekanbaru Garuda Sakti</option>
                    <option value="BRKS Tanjung Pinang Pamedan" class="text-sm">BRKS Tanjung Pinang Pamedan</option>
                </select>
            </div>
            <!-- Grade -->
            <div class="flex flex-col gap-1 mt-1">
                <p class="font-semibold ">Grade</p>
                <select id="grade" name="grade"
                    class="p-2 w-full md:w-full h-9 rounded-xl bg-white bg-opacity-90 text-base">
                    <option value="" disabled selected>- Pilih Grade -</option>
                    <option value="18" class="text-sm">18</option>
                    <option value="17" class="text-sm">17</option>
                    <option value="16" class="text-sm">16</option>
                    <option value="15" class="text-sm">15</option>
                    <option value="14" class="text-sm">14</option>
                    <option value="13" class="text-sm">13</option>
                    <option value="12" class="text-sm">12</option>
                    <option value="11" class="text-sm">11</option>
                    <option value="10" class="text-sm">10</option>
                    <option value="9" class="text-sm">9</option>
                    <option value="8" class="text-sm">8</option>

                </select>
            </div>
            <!-- Tanda Tangan -->
            <div class="flex flex-col gap-1 mt-1 rounded-xl">
                <p class="font-semibold">Tanda Tangan</p>
                <div id="ttd" class="relative w-full rounded-xl md:w-full h-36 bg-white opacity-90">
                    <div class="absolute top-0 right-0">
                        <img id="clear" src="/images/clear.png" alt="Hapus Tanda Tangan" class="w-12 h-12 z-0">
                    </div>
                </div>
                <input type="hidden" id="signature64" name="ttd"> <!-- Pastikan nama inputnya adalah 'ttd' -->
            </div>
            <input type="hidden" name="acara_id" id="acara_id" value="{{ $acara->id }}">
            <!-- button -->
            <div class="grid place-items-center">
                <button type="submit"
                    class="bg-[#b72026] px-7 py-2 text-white font-semibold text-lg rounded-xl mt-3 ">Submit</button>
            </div>
            <input type="hidden" id="latitude" name="latitude">
            <input type="hidden" id="longitude" name="longitude">

        </form>
        <div class="w-96 overflow-hidden ml-16 fixed right-0 -bottom-16 -z-10">
            <img src="/images/gedungbrk.png" alt="logo" class="object-cover w-full h-full opacity-50">
        </div>
        <!-- js Tanda Tangan -->
        <script>
            var sig = $('#ttd').signature({
                syncField: '#ttd',
                syncFormat: 'PNG'
            });
            $('#clear').click(function (e) {
                e.preventDefault();
                sig.signature('clear');
                $("#signature64").val('');
            });

            // Menyimpan tanda tangan ke input hidden saat form disubmit
            $('form').submit(function () {
                $("#signature64").val(sig.signature('toDataURL'));
            });
        </script>

        <!-- Js Aos -->
        <script>
            AOS.init();
        </script>

        <!-- js Dokumentasi -->
        <script>
            function displayFileName(input) {
                const fileName = input.files[0].name;
                document.getElementById('fileName').innerText = fileName;
            }
        </script>
        <!-- JS Select2 -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
        <script>
            $(document).ready(function () {
                $('.select2').select2();
            });
        </script>
    </div>
</body>

</html>