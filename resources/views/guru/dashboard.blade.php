<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Beranda Guru | Portal Siswa</title>
    <link href="assets/img/favicon.png" rel="icon">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <style>
        .container{
            margin-top: 15px; 
        }
        .menu-box {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 20px;
            border-radius: 15px;
            color: #fff;
            font-weight: bold;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.3);
            transition: transform 0.2s;
            background-color: #0d6efd; /* Default warna biru */
        }

        .menu-box:hover {
            transform: translateY(-5px);
        }

        .menu-box .icon {
            font-size: 2.5rem;
            opacity: 0.3;
        }

        .menu-box .text {
            text-align: left;
        }

        .menu-box .text h5 {
            margin: 0;
            font-size: 1.25rem;
        }

        .bg-warning {
            background-color: #ffc107 !important;
        }

        .bg-success {
            background-color: #28a745 !important;
        }
    </style>
</head>
<body>
    @extends('layouts.app')

    @section('content')
    <div class="container">
        <div class="text-left mb-5">
            <h1>Beranda</h1>
            <p class="lead">Selamat datang, <strong>{{ Auth::user()->name }}</strong>!</p>
            <hr>
        </div>

        <div class="container mt-5">
            <div class="row g-4">
                <!-- Box 1: Tambah Materi -->
                <div class="col-md-4">
                    <a href="{{ route('guru.materi') }}" class="menu-box text-decoration-none text-white">
                        <div class="text">
                            <h5>Tambah Materi</h5>
                        </div>
                        <div class="icon">
                            <i class="fas fa-book"></i>
                        </div>
                    </a>
                </div>
    
                <!-- Box 2: Tambah Tugas -->
                <div class="col-md-4">
                    <a href="{{ route('guru.tugas.tugas') }}" class="menu-box bg-warning text-decoration-none text-white">
                        <div class="text">
                            <h5>Tambah Tugas</h5>
                        </div>
                        <div class="icon">
                            <i class="fas fa-tasks"></i>
                        </div>
                    </a>
                </div>
    
                <!-- Box 3: Nilai Siswa -->
                <div class="col-md-4">
                    <a href="{{ route('guru.scores.index') }}" class="menu-box bg-success text-decoration-none text-white">
                        <div class="text">
                            <h5>Nilai Siswa</h5>
                        </div>
                        <div class="icon">
                            <i class="fas fa-calendar-alt"></i>
                        </div>
                    </a>
                </div>
            </div>    
        </div>   
    </div>
    @endsection

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
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
