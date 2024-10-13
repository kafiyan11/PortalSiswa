<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
        }
        .navbar {
            background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
        }
        .navbar-brand {
            font-weight: 600;
        }
        .navbar-brand div {
            margin-left: 10px; /* Atur jarak antara gambar dan teks */
        }

        .navbar-brand h1 {
            font-size: 1.5rem; /* Ukuran font h1 */
        }

        .navbar-brand p {
            font-size: 1rem; /* Ukuran font p */
        }
        .sidebar {
            background-color: #ffffff;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            height: calc(100vh - 56px);
            padding-top: 20px;
        }
        .sidebar .nav-link {
            color: #495057;
            border-radius: 5px;
            margin-bottom: 5px;
            transition: all 0.3s ease;
        }
        .sidebar .nav-link:hover {
            background-color: #e9ecef;
            transform: translateX(5px);
        }
        .sidebar .nav-link.active {
            background-color: #007bff;
            color: #ffffff;
        }
        .main-content {
            padding: 30px;
        }
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease-in-out;
        }
        .card:hover {
            transform: translateY(-5px);
        }
        .card-header {
            background-color: #007bff;
            color: #ffffff;
            border-radius: 15px 15px 0 0;
            font-weight: 600;
        }
        .metrics-card {
            height: 100%;
        }
        .metrics-card .card-body {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .metrics-card h2 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 0;
        }
        .metrics-card p {
            font-size: 1.1rem;
            margin-bottom: 0;
        }
        .metrics-card i {
            font-size: 3rem;
            opacity: 0.7;
        }
        .dropdown-menu {
            border: none;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .dropdown-item {
            padding: 10px 20px;
            transition: all 0.3s ease;
        }
        .dropdown-item:hover {
            background-color: #e9ecef;
            transform: translateX(5px);
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container-fluid">
        <a class="navbar-brand d-flex align-items-center" href="#">
            <img src="{{ asset('assets/img/LOGO11.png') }}" alt="Logo" height="40" class="d-inline-block align-text-top me-2">
            <div>
                <h1 class="mb-0">Portal Siswa</h1>
                <p class="mb-0">SMKN 1 KAWALI</p>
            </div>
        </a>
        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt"></i> Log Out
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container-fluid">
    <div class="row">
        <nav id="sidebar" class="col-md-3 col-lg-2 d-md-block sidebar collapse">
            <div class="position-sticky">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('admin.dashboard') }}">
                            <i class="fas fa-home me-2"></i>
                            Beranda
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.profiles.show') }}">
                            <i class="fas fa-user me-2"></i>
                            Profil
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="tambahAkunDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-plus me-2"></i>
                            Tambah Akun
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="tambahAkunDropdown">
                            <li><a class="dropdown-item" href="{{ route('tambah') }}"><i class="fas fa-user-graduate me-2"></i>Data Siswa</a></li>
                            <li><a class="dropdown-item" href="{{ route('tambahguru') }}"><i class="fas fa-chalkboard-teacher me-2"></i>Data Guru</a></li>
                            <li><a class="dropdown-item" href="{{ route('ortu') }}"><i class="fas fa-user-friends me-2"></i>Data Orang Tua</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="jadwalDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-calendar-alt me-2"></i>
                            Jadwal
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="jadwalDropdown">
                            <li><a class="dropdown-item" href="{{ route('admin.jadwal.index') }}"><i class="fas fa-calendar-alt me-2"></i>Jadwal Pelajaran</a></li>
                            <li><a class="dropdown-item" href="{{ route('admin.jadwalguru.index') }}"><i class="fas fa-chalkboard-teacher me-2"></i>Jadwal Guru</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.tugas.index') }}">
                            <i class="fas fa-tasks me-2"></i>
                            Tugas
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('namamapel.index') }}">
                            <i class="fas fa-globe me-2"></i>
                            Daftar Pelajaran
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.materi.index') }}">
                            <i class="fas fa-book me-2"></i>
                            Materi Pelajaran
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.scores.index') }}">
                            <i class="fas fa-graduation-cap me-2"></i>
                            Nilai
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('posts.index') }}">
                            <i class="fas fa-comments me-2"></i>
                            Forum Diskusi
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('social-links.index') }}">
                            <i class="fas fa-link me-2"></i>
                            Tautan Sosial
                        </a>
                    </li>
                </ul>
            </div>
        </nav>

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Beranda</h1>
            </div>

            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="card metrics-card bg-primary text-white">
                        <div class="card-body">
                            <div>
                                <h2>{{ $totalSiswa }}</h2>
                                <p>Total Siswa</p>
                            </div>
                            <i class="fas fa-user-graduate"></i>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card metrics-card bg-success text-white">
                        <div class="card-body">
                            <div>
                                <h2>{{ $totalGuru }}</h2>
                                <p>Total Guru</p>
                            </div>
                            <i class="fas fa-chalkboard-teacher"></i>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card metrics-card bg-info text-white">
                        <div class="card-body">
                            <div>
                                <h2>{{ $totalOrangTua }}</h2>
                                <p>Total Orang Tua</p>
                            </div>
                            <i class="fas fa-user-friends"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Add more content here -->

        </main>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Add any additional JavaScript here
</script>
</body>
</html>