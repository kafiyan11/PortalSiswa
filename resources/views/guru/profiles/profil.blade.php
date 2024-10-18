<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Guru | Portal Siswa</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f7f6;
            margin: 0;
            padding-top: 50px;
        }

        .profile-container {
            max-width: 1100px;
            margin: auto;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            padding: 20px;
        }

        .poto img {
            border-radius: 50%;
            width: 150px;
            height: 150px;
            object-fit: cover;
        }

        .judul {
            margin-top: 20px;
            margin-left: 50px;
        }

        .card-body {
            padding: 20px;
        }

        @media (max-width: 768px) {
            .row {
                flex-direction: column;
            }
        }
    </style>
</head>
@extends('layouts.app')

@section('content')
<body>
    <div class="container profile-container">
        <div class="row">
            <!-- Sidebar Profil -->
            <div class="col-md-4 text-center poto">
                @if(Auth::user()->photo)
                    <!-- Menampilkan foto pengguna jika ada -->
                    <img src="{{ asset('storage/' . Auth::user()->photo) }}" alt="Admin" class="rounded-circle" style="width: 150px; height: 150px;">
                @else
                    <!-- Menampilkan ikon profil default jika foto belum ditambahkan -->
                    <i class="fas fa-user-circle" style="font-size: 150px; color: #ccc;"></i>
                @endif
                <div class="mt-3">
                    <h4>{{ Auth::user()->name }}</h4>
                    <h6>{{ Auth::user()->alamat }}</h6>
                </div>
            </div>
            <!-- Bagian Utama Profil -->
            <div class="col-md-8">
                <div class="judul"><h1>Profil Guru</h1><br></div>
                <div class="card mb-3">
                    <div class="card-body">
                        @if(session('success'))
                            <script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Berhasil',
                                        text: '{{ session('success') }}',
                                        confirmButtonText: 'OK'
                                    });
                                });
                            </script>
                        @endif
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="row">
                            <div class="col-sm-3"><h6 class="mb-0">Nama Lengkap</h6></div>
                            <div class="col-sm-9 text-secondary">{{ Auth::user()->name }}</div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3"><h6 class="mb-0">NIS</h6></div>
                            <div class="col-sm-9 text-secondary">{{ Auth::user()->nis }}</div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3"><h6 class="mb-0">No Hp</h6></div>
                            <div class="col-sm-9 text-secondary">{{ Auth::user()->nohp ?? 'Nomor HP Belum Diisi' }}</div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3"><h6 class="mb-0">Alamat</h6></div>
                            <div class="col-sm-9 text-secondary">{{ Auth::user()->alamat ?? 'Alamat Belum Diisi' }}</div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3"><h6 class="mb-0">Sebagai</h6></div>
                            <div class="col-sm-9 text-secondary">{{ Auth::user()->role }}</div>
                        </div>
                        <hr>
                        <!-- Bagian Mengajar -->
                        <div class="row">
                            <div class="col-sm-3"><h6 class="mb-0">Mengajar</h6></div>
                            <div class="col-sm-9 text-secondary">{{ Auth::user()->mengajar ?? 'Informasi Mengajar Belum Diisi' }}</div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-12">
                                <a href="{{ route('guru.dashboard') }}" class="btn btn-primary">Kembali</a>
                                <a href="{{ route('guru.profiles.edit', Auth::user()->id) }}" class="btn btn-primary">Edit Profil</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Pastikan script SweetAlert2 dimuat setelah elemen HTML lainnya -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
@endsection
