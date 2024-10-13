<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil</title>
    <link href="assets/img/favicon.png" rel="icon">

    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

    <!-- SweetAlert2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <style>
        /* Mengatur tampilan dasar body */
        body {
            font-family: Arial, sans-serif; /* Font yang digunakan */
            background-color: #f4f7f6; /* Warna latar belakang */
            margin: 0; /* Menghilangkan margin default */
            padding: 0; /* Menghilangkan padding default */
            padding-top: 50px; /* Menambahkan padding atas untuk menghindari navbar */
        }

        /* Kontainer utama profil */
        .profile-container {
            max-width: 1100px; /* Lebar maksimal kontainer */
            margin: auto; /* Menengahkan kontainer */
            background-color: white; /* Warna latar belakang putih */
            border-radius: 10px; /* Sudut melengkung */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Bayangan kotak */
            overflow: hidden; /* Menghindari overflow */
            padding: 20px; /* Padding di dalam kontainer */
        }

        /* Tambahan gaya lainnya sesuai kebutuhan di sini ... */
    </style>
</head>

@extends('layouts.app')

@section('content')
<body>
    <div class="container">
        <div class="profile-container">
            <div class="card">
                <div class="main-body">
                    <div class="row gutters-sm">
                        <!-- Sidebar Profil -->
                        <div class="col-md-4 mb-3">
                            <div class="card-body">
                                <div class="d-flex flex-column align-items-center text-center">
                                    <img src="{{ Auth::user()->photo ? asset('storage/' . Auth::user()->photo) : asset('default-avatar.png') }}" alt="Admin" class="rounded-circle" width="150">
                                    <div class="mt-3">
                                        <h4>{{ Auth::user()->name }}</h4>
                                        <h6>{{ Auth::user()->alamat }}</h6>
                                        <hr>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Bagian Utama Profil -->
                        <div class="col-md-8">
                            <div class="judul">
                                <h1>Profil Siswa</h1>
                                <br>
                            </div>

                            <div class="card mb-3">
                                <div class="card-body">
                                    <!-- SweetAlert untuk pesan sukses -->
                                    @if(session('success'))
                                    <script>
                                        document.addEventListener('DOMContentLoaded', function () {
                                            Swal.fire({
                                                icon: 'success',
                                                title: 'Berhasil',
                                                text: '{{ session('success') }}',
                                                confirmButtonText: 'OK'
                                            });
                                        });
                                    </script>
                                    @endif

                                    <!-- Menampilkan pesan error jika ada -->
                                    @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    @endif

                                    <!-- Informasi Profil -->
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Nama Lengkap</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            {{ Auth::user()->name }}
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">NIS</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            {{ Auth::user()->nis }}
                                        </div>
                                    </div>
                                    <hr>
                                    <!-- Bagian Kelas - hanya tampil jika bukan guru -->
                                    @if(Auth::user()->role !== 'guru')
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Kelas</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            {{ Auth::user()->kelas }}
                                        </div>
                                    </div>
                                    <hr>
                                    @endif
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">No Hp</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            {{ Auth::user()->nohp ?? 'Nomor HP Belum Di isi' }}
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Alamat</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            {{ Auth::user()->alamat ?? 'Alamat Belum Di isi' }}
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Sebagai</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            {{ Auth::user()->role }}
                                        </div>
                                    </div>
                                    <hr>
                                    <!-- Tombol Aksi -->
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <a href="{{ route('siswa.profiles.edit', Auth::user()->id) }}" class="btn btn-primary">Edit Profil Siswa</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS dan dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
    <script>
        document.getElementById('photo-upload').addEventListener('change', function (event) {
            const [file] = this.files;
            if (file) {
                const img = this.parentElement.parentElement.querySelector('img');
                img.src = URL.createObjectURL(file);
                img.onload = () => URL.revokeObjectURL(img.src); // Membersihkan URL objek
            }
        });
    </script>
</body>
@endsection

</html>
