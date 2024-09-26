<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Dashboard') }}</title>
    <link href="assets/img/favicon.png" rel="icon">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link href="assets/img/favicon.png" rel="icon">


    <!-- Bootstrap and FontAwesome -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    

    <!-- Custom Styles -->
    <style>
        /* Mengatur gaya dasar untuk seluruh halaman */
      body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background: url('your-background-image.jpg') no-repeat center center fixed; /* Menambahkan background image */
        background-size: cover; /* Mengatur ukuran background agar menutupi seluruh layar */
        background-color: rgb(246, 246, 246);
      }
  
      /* Gaya untuk navbar (menu navigasi di bagian atas) */
      .navbar {
        background: linear-gradient(90deg, #ffffff, #ffffff); /* Gradien biru ke putih */
        color: rgb(0, 0, 0);
        z-index: 1000;
        width: 100%;
        position: fixed;
        top: 0;
        left: 0;
        box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.3); /* Bayangan halus untuk navbar */
      }
  
      .navbar-brand {
        display: flex;
        align-items: center;
      }
  
      .navbar-brand img {
        width: 55px;
        height: 80px;
        margin-right: 20px;
        margin-top: 5px;
      }
  
      .navbar-brand .portal-info {
        line-height: 1.2;
      }
  
      .navbar-brand .portal-info h1 {
        margin: 0;
        color: black;
        font-size: 30px;
      }
  
      .navbar-brand .portal-info h2 {
        margin: 0;
        font-size: 15px;
        text-transform: uppercase;
        color: black;
      }
  
      /* Gaya untuk sidebar (menu samping) */
      .sidebar {
        height: 100vh;
        padding-left: 2px;
        position: fixed;
        top: 15px; /* Disesuaikan dengan tinggi navbar */
        left: 0;
        width: 250px;
        background: white;  
        padding-top: 100px;
        z-index: 999;
        transition: width 0.3s ease, background 0.3s ease;
        overflow: hidden;
        border-right: 1px solid #a8acb0;
        box-shadow: 5px 5px 10px rgb(0, 0, 0, 0.4);
      }
  
      .sidebar.collapsed {
        margin-left: -10px;
        width: 60px; /* Lebar saat sidebar dikompres */
        background: white;
      }
  
      .sidebar a {
        color: #000000; /* Warna biru terang untuk tautan */
        text-decoration: none;
        padding: 11.5px 22px; /* Menyesuaikan padding */
        display: flex;
        align-items: center;
        transition: background-color 0.3s ease, padding 0.3s ease;
      }
  
      .sidebar a i {
        font-size: 1.5em; /* Ukuran ikon */
        margin-right: 20px;
        margin-left: -2px;
      }
  
      /* .sidebar a span {
        display: flex ;
        transition: opacity 0.3s ease;
      }
  
      .sidebar.collapsed a span {
        opacity: 0;
        visibility: hidden;
      } */
  
      .sidebar a:hover {
        padding: 15px;
        background-color: #888888; /* Warna latar abu-abu muda saat hover */
        box-shadow: 5px 5px 10px rgb(0, 0, 0, 0.4);
      }
  
      /* Gaya untuk konten utama */
      .main-content {
        margin-left: 50px; /* Disesuaikan dengan lebar sidebar */
        padding: 20px;
        padding-top: 180px; /* Disesuaikan dengan tinggi navbar */
        transition: margin-left 0.3s ease;
        position: relative;
        z-index: 1; /* Memastikan konten berada di bawah sidebar */
      }
  
      /* .main-content.full-width {
        margin-left: 60px; /* Disesuaikan dengan sidebar yang dikompres */
       */
  
      /* Gaya untuk judul di bagian "Beranda" */
      .title {
        margin-bottom: 20px;
        padding-top: 20px;
        text-align: left; /* Menggeser teks ke kiri */
        color: #333; /* Warna teks gelap */
        animation: slideInFromBottom 0.5s ease-out; /* Animasi dari bawah ke atas */
      }
  
      .title h1 {
        font-size: 2.5em;
        color: #000000; /* Biru terang untuk judul */
        margin-bottom: 10px;
      }
  
      .title p {
        font-size: 1.2em;
        color: #000000; /* Abu-abu untuk subtitle */
      }
  
      /* Gaya untuk kotak */
      .card {
        border: none;
        border-radius: 15px; /* Sudut yang membulat */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Bayangan halus */
        overflow: hidden;
        position: relative;
      }
  
      .card-header {
        background: rgb(97, 97, 97); /* Gradien biru ke putih untuk header kartu */
        color: white;
        padding: 20px;
        text-align: center;
      }
  
      .card-body {
        padding: 20px;
        background-color: #ffffff; /* Latar belakang putih untuk body kartu */
        color: #333;
      }
  
      .card-footer {
        background-color: #f8f9fa; /* Abu-abu terang untuk footer kartu */
        padding: 15px;
        text-align: center;
      }
  
      /* Gaya untuk link forum diskusi */
      .forum-link {
        position: fixed;
        bottom: 20px;
        right: 20px;
        background-color: #007bff;
        color: white;
        padding: 10px 15px;
        border-radius: 50px;
        text-align: center;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        transition: background-color 0.3s ease;
      }
  
      .forum-link:hover {
        background-color: #0056b3;
        text-decoration: none;
        color: white;
      }
  
      .forum-link i {
        margin-right: 8px;
      }
  
      @media (max-width: 1000px) {
              h1 {
                  font-size: 1.8rem;
              }
              .main-content {
                  grid-template-columns: repeat(2, 1fr); /* Tampilkan 2 subject-box per baris di layar yang lebih kecil */
                  max-width: 600px;
              }
          }
  
          @media (max-width: 600px) {
              h1 {
                  font-size: 1.6rem;
              }
              .main-content {
                  grid-template-columns: 1fr; /* Tampilkan 1 subject-box per baris di layar yang lebih kecil */
                  max-width: 300px;
              }
          }
  
      /* Keyframes untuk animasi slide dari bawah ke atas */
      @keyframes slideInFromBottom {
        0% {
          opacity: 0;
          transform: translateY(50px); /* Mulai dari posisi bawah */
        }
        100% {
          opacity: 1;
          transform: translateY(0); /* Berhenti pada posisi awal */
        }
      }
    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-lg navbar-dark">
            <a class="navbar-brand" href="#">
                <img src="{{ asset('assets/img/logo2.png') }}" alt="Logo">
                <div class="portal-info">
                    <h1>Portal Siswa</h1>
                    <h2>SMKN 1 KAWALI</h2>
                </div>
            </a>
        </nav>

            @auth
            @if(auth()->user()->role=='Siswa')
                    @include('layouts.sidebarSiswa')    

            @elseif(auth()->user()->role=='Guru')
                    @include('layouts.sidebarGuru')

            @elseif(auth()->user()->role=='Orang Tua')
                    @include('layouts.sidebarOrangTua')
            @else
                    @include('layouts.sidebarAdmin')
            @endif


            @endauth

        <main class="main-content" id="main-content">
            @yield('content')
        </main>
    </div>

    <script>
        function expandSidebar() {
            var sidebar = document.getElementById('sidebar');
            sidebar.classList.remove('collapsed');
            document.getElementById('main-content').classList.add('full-width');
        }

        function collapseSidebar() {
            var sidebar = document.getElementById('sidebar');
            sidebar.classList.add('collapsed');
            document.getElementById('main-content').classList.remove('full-width');
        }

        document.getElementById('sidebar').addEventListener('mouseover', expandSidebar);
        document.getElementById('sidebar').addEventListener('mouseout', collapseSidebar);

        // Script untuk menampilkan/menghilangkan form input sesuai pilihan
        document.querySelectorAll('input[name="uploadOption"]').forEach(option => {
            option.addEventListener('change', function () {
                if (this.value === 'gambar') {
                    document.getElementById('gambarUpload').style.display = 'block';
                    document.getElementById('linkYoutube').style.display = 'none';
                } else {
                    document.getElementById('gambarUpload').style.display = 'none';
                    document.getElementById('linkYoutube').style.display = 'block';
                }
            });
        });
    </script>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
