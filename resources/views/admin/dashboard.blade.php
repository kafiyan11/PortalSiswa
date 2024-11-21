<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda Admin | Portal Siswa</title>
    <link href="{{ asset('assets/img/favicon.png') }}" rel="icon">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- Library Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
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
            margin-left: 10px;
        }
        .navbar-brand h1 {
            font-size: 1.5rem;
        }
        .navbar-brand p {
            font-size: 1rem;
        }
        .sidebar {
            background-color: #ffffff;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            height: calc(100vh - 56px);
            padding-top: 20px;
            position: sticky;
            top: 0;
            z-index: 1000; /* Pastikan sidebar di atas konten lainnya */
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
        <nav id="sidebar" class="col-md-3 col-lg-2 d-md-block sidebar">
            <div class="position-sticky">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('guru.dashboard') }}">
                            <i class="fas fa-home me-2"></i>
                            Beranda
                        </a>
                </li>
                <li class="nav-item ">
                        <a class="nav-link" href="{{ route('admin.profiles.show') }}">
                            <i class="fas fa-user me-2"></i> 
                            Profil
                        </a>
                    </li>
                    <li class="nav-item dropdown ">
                        <a class="nav-link dropdown-toggle" href="#" id="tambahAkunDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-plus me-2"></i> Tambah Akun
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="tambahAkunDropdown">
                            <li><a class="dropdown-item" href="{{ route('tambah.admin') }}"><i class="fas fa-user-shield me-2"></i> Data Admin</a></li>
                            <li><a class="dropdown-item" href="{{ route('tambah') }}"><i class="fas fa-user-graduate me-2"></i> Data Siswa</a></li>
                            <li><a class="dropdown-item" href="{{ route('tambahguru') }}"><i class="fas fa-chalkboard-teacher me-2"></i> Data Guru</a></li>
                            <li><a class="dropdown-item" href="{{ route('ortu') }}"><i class="fas fa-user-friends me-2"></i> Data Orang Tua</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown ">
                        <a class="nav-link dropdown-toggle" href="#" id="jadwalDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-calendar-alt me-2"></i> Jadwal
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="jadwalDropdown">
                            <li><a class="dropdown-item" href="{{ route('admin.jadwal.index') }}"><i class="fas fa-calendar-alt me-2"></i> Jadwal Pelajaran</a></li>
                            <li><a class="dropdown-item" href="{{ route('admin.jadwalguru.index') }}"><i class="fas fa-chalkboard-teacher me-2"></i> Jadwal Guru</a></li>
                        </ul>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link" href="{{ route('admin.tugas.index') }}">
                            <i class="fas fa-tasks me-2"></i> Tugas
                        </a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link" href="{{ route('namamapel.index') }}">
                            <i class="fas fa-globe me-2"></i> Daftar Pelajaran
                        </a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link" href="{{ route('admin.materi.index') }}">
                            <i class="fas fa-book me-2"></i> Materi Pelajaran
                        </a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link" href="{{ route('admin.scores.index') }}">
                            <i class="fas fa-graduation-cap me-2"></i> Nilai
                        </a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link" href="{{ route('posts.index') }}">
                            <i class="fas fa-comments me-2"></i> Forum Diskusi
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('admin.posts.pendingApproval') ? 'active' : '' }}" href="{{ route('admin.posts.pendingApproval') }}">
                            <i class="fas fa-check-circle me-2"></i> Approve Post
                        </a>
                    </li>
                    
                    <li class="nav-item ">
                        <a class="nav-link" href="{{ route('social-links.index') }}">
                            <i class="fas fa-link me-2"></i> Tautan Sosial
                        </a>
                    </li>
                </ul>
            </div>
        </nav>

        <main class="col-md-9 ms-sm-auto col-lg-10 main-content">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Beranda</h1>
                <p>Selamat Datang <strong>{{ Auth::user()->name }}</strong></p>
            </div>
            <br>
            <div class="row">
                <!-- Mengubah box Total Admin -->
                <div class="col-md-4 mb-4">
                    <div class="card metrics-card bg-warning text-white"> <!-- Ubah warna latar belakang menjadi bg-warning -->
                        <div class="card-body">
                            <div>
                                <h2>{{ $totalAdmin }}</h2>
                                <p>Total Admin</p>
                            </div>
                            <i class="fas fa-user-shield"></i> <!-- Mengganti ikon menjadi fas fa-user-shield -->
                        </div>
                    </div>
                </div>
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
                <!-- Mengubah box Total Orang Tua -->
                <div class="col-md-4 mb-4">
                    <div class="card metrics-card bg-info text-white">
                        <div class="card-body">
                            <div>
                                <h2>{{ $totalOrangTua }}</h2>
                                <p>Total Orang Tua</p>
                            </div>
                            <i class="fas fa-users"></i> <!-- Mengganti ikon menjadi fas fa-users -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mt-4">
                <div class="card-body">
                    <h5 class="text-center">Grafik Nilai Rata-Rata Siswa</h5>
                    
                    <!-- Search Button aligned to the right -->
                    <div class="d-flex justify-content-center mb-3">
                        <button id="openSearchButton" class="btn btn-primary">Cari Siswa</button>
                    </div>                    
                    <canvas id="averageScoreChart" width="400" height="200"></canvas>
                    <div id="noResultsMessage" class="text-danger text-center mt-3" style="display: none;">Siswa tidak ditemukan.</div>
                </div>
            </div>
            @php
                // Mendapatkan daftar unik mata pelajaran dari data nilai
                $subjects = $scores->pluck('mapel.nama_mapel')->unique()->values();
            @endphp
            </main>
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script>
                document.addEventListener("DOMContentLoaded", function () {
                    // Ambil daftar mata pelajaran sebagai label sumbu-x
                    const subjects = {!! json_encode($subjects) !!};
            
                    // Mengelompokkan nilai rata-rata per siswa untuk setiap mata pelajaran
                    const studentsData = {!! json_encode(
                        $scores->groupBy('nama')->map(function ($studentScores) use ($subjects) {
                            return $subjects->map(function ($subject) use ($studentScores) {
                                return optional($studentScores->firstWhere('mapel.nama_mapel', $subject))->average_score ?? 0;
                            });
                        })
                    ) !!};
            
                    // Membuat dataset untuk setiap siswa
                    const allDatasets = Object.keys(studentsData).map((studentName, index) => {
                        return {
                            label: studentName,
                            data: studentsData[studentName],
                            backgroundColor: `rgba(${54 + (index * 30) % 200}, 162, 235, 0.6)`,
                            borderColor: `rgba(${54 + (index * 30) % 200}, 162, 235, 1)`,
                            borderWidth: 1
                        };
                    });
            
                    // Inisialisasi grafik dengan Chart.js
                    const ctx = document.getElementById('averageScoreChart').getContext('2d');
                    const averageScoreChart = new Chart(ctx, {
                        type: 'bar', // Mengubah tipe grafik menjadi bar chart
                        data: {
                            labels: subjects,
                            datasets: allDatasets.slice(0, 1) // Menampilkan data siswa pertama secara default
                        },
                        options: {
                            responsive: true,
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    title: {
                                        display: true,
                                        text: 'Nilai Rata-Rata'
                                    }
                                },
                                x: {
                                    title: {
                                        display: true,
                                        text: 'Mata Pelajaran'
                                    }
                                }
                            },
                            plugins: {
                                legend: {
                                    display: true,
                                    position: 'top'
                                },
                                tooltip: {
                                    enabled: true,
                                    callbacks: {
                                        label: function (tooltipItem) {
                                            return `Nilai: ${tooltipItem.raw}`;
                                        }
                                    }
                                }
                            }
                        }
                    });
            
                    // SweetAlert search functionality
                    document.getElementById('openSearchButton').addEventListener('click', function() {
                        Swal.fire({
                            title: 'Cari Siswa',
                            input: 'text',
                            inputPlaceholder: 'Masukkan nama siswa...',
                            showCancelButton: true,
                            confirmButtonText: 'Cari',
                            cancelButtonText: 'Batal',
                            inputValidator: (value) => {
                                if (!value) {
                                    return 'Silakan masukkan nama siswa!';
                                }
                            }
                        }).then((result) => {
                            if (result.isConfirmed) {
                                const searchTerm = result.value.toLowerCase();
                                const filteredDatasets = allDatasets.filter(dataset => dataset.label.toLowerCase().includes(searchTerm));
            
                                if (filteredDatasets.length > 0) {
                                    averageScoreChart.data.datasets = filteredDatasets;
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Siswa Ditemukan!',
                                        text: `Menampilkan grafik untuk siswa: ${filteredDatasets.map(dataset => dataset.label).join(", ")}`,
                                        confirmButtonText: 'OK'
                                    });
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Oops...',
                                        text: 'Siswa tidak ditemukan!',
                                        confirmButtonText: 'OK'
                                    });
                                    averageScoreChart.data.datasets = allDatasets.slice(0, 1);
                                }
            
                                averageScoreChart.update();
                            }
                        });
                    });
                });
            </script>
            
            <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2"></script>
                                        
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
<script>
    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Sukses!',
            text: '{{ session('success') }}',
            confirmButtonText: 'OK'
        });
    @endif
</script>
</body>
</html>