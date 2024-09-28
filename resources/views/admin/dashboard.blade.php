@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard Admin</title>
  <link href="assets/img/favicon.png" rel="icon">
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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

<nav class="navbar navbar-expand-lg navbar-dark">
  <a class="navbar-brand" href="#">
    <img src="{{ asset('assets/img/logo2.png') }}" alt="Logo"> <!-- Replace with your logo image -->
    <div class="portal-info">
      <h1>Portal Siswa</h1>
      <h2>SMKN 1 KAWALI</h2>
    </div>
  </a>
</nav>

<div class="sidebar collapsed" id="sidebar" onmouseover="expandSidebar()" onmouseout="collapseSidebar()">
  <a href="{{ route('admin.dashboard') }}"><i class="fas fa-home"></i> Beranda</a>
  <a href="{{ route('admin.profil') }}"><i class="fas fa-user"></i> Profil</a>

  <!-- Dropdown for 'Tambah Akun' -->
  <div class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="collapse" data-target="#tambahAkunDropdown" aria-expanded="false" aria-controls="tambahAkunDropdown">
      <i class="fas fa-plus"></i> Tambah Akun
    </a>
    <div class="collapse" id="tambahAkunDropdown">
      <a class="dropdown-item" href="{{ route('tambah') }}"><i class="fas fa-user-graduate"></i>Data Siswa</a>
      <a class="dropdown-item" href="{{ route('tambahguru') }}"><i class="fas fa-chalkboard-teacher"></i>Data Guru</a>
      <a class="dropdown-item" href="{{ route('ortu') }}"><i class="fas fa-user-friends"></i>Data Orang Tua</a>
    </div>
  </div>

  {{-- <a href="{{ route('admin.materi.index') }}"><i class="fas fa-book"></i> Materi Pelajaran</a> --}}
  <div class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="collapse" data-target="#jadwalDropdown" aria-expanded="false" aria-controls="jadwalDropdown">
      <i class="fas fa-calendar-alt"></i> Jadwal 
    </a>
    <div class="collapse" id="jadwalDropdown">
      <a class="dropdown-item" href="{{ route('admin.jadwal.index') }}"><i class="fas fa-calendar-alt"></i> Jadwal Pelajaran</a>
      <a class="dropdown-item" href="#"><i class="fas fa-chalkboard-teacher"></i> Jadwal Guru</a>
    </div>
  </div>
  
  <a href="{{ route('admin.tugas.index') }}"><i class="fas fa-tasks"></i> Tugas</a>
  <a href="{{ route('admin.materi.index') }}"><i class="fas fa-book"></i> Materi Pelajaran</a>
  <a href="{{ route('scores.index') }}"><i class="fas fa-graduation-cap"></i> Nilai</a>
  <a href="{{ route('post.index') }}"><i class="fas fa-comments"></i>Forum Diskusi </a>
  <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
    <i class="fas fa-sign-out-alt"></i> Log Out
  </a>
  <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
    @csrf
  </form>
</div>


<div class="main-content" id="main-content">
  <div class="container">
    @if(session('success'))
    <script>
        Swal.fire({
            title: "Good job!",
            text: "{{ session('success') }}", // Mengambil pesan dari session
            icon: "success"
        });
    </script>
    @endif
    <div class="title">
      <h1>Beranda</h1>
      <p>Selamat datang, {{ Auth::user()->name }}!</p>
    </div>
    <div class="row">
      <div class="col-md-4">
        <div class="card">
          <div class="card-header">
            <i class="fas fa-calendar-alt"></i>
            <h3>Jadwal Pelajaran</h3>
          </div>
          <div class="card-body">
            <p>Informasi mengenai jadwal pelajaran Anda.</p>
          </div>
          <div class="card-footer">
            <a href="{{ route('admin.jadwal.index') }}" class="btn btn-primary">Lihat Jadwal</a>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card">
          <div class="card-header">
            <i class="fas fa-tasks"></i>
            <h3>Tugas</h3>
          </div>
          <div class="card-body">
            <p>Informasi mengenai tugas-tugas Anda.</p>
          </div>
          <div class="card-footer">
            <a href="{{ route('admin.tugas.index') }}" class="btn btn-primary">Lihat Tugas</a>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card">
          <div class="card-header">
            <i class="fas fa-graduation-cap"></i>
            <h3>Nilai</h3>
          </div>
          <div class="card-body">
            <p>Informasi mengenai nilai-nilai Anda.</p>
          </div>
          <div class="card-footer">
            <a href="{{ route('scores.index') }}" class="btn btn-primary">Lihat Nilai</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  // Function to expand sidebar on hover
  function expandSidebar() {
    var sidebar = document.getElementById('sidebar');
    sidebar.classList.remove('collapsed');
    document.getElementById('main-content').classList.add('full-width');
  }

  // Function to collapse sidebar when not hovering
  function collapseSidebar() {
    var sidebar = document.getElementById('sidebar');
    sidebar.classList.add('collapsed');
    document.getElementById('main-content').classList.remove('full-width');
  }

  // Attach event listeners for hover
  document.getElementById('sidebar').addEventListener('mouseover', expandSidebar);
  document.getElementById('sidebar').addEventListener('mouseout', collapseSidebar);
</script>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
