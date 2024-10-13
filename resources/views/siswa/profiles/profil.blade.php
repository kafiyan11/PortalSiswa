@extends('layouts.app')

@section('title', 'Profil Siswa')

@section('content')
    <style>
        body {
            font-family: 'Poppins', sans-serif; /* Font yang digunakan */
            background-color: #f8f9fa; /* Warna latar belakang halaman */
            margin: 0;
            padding: 0;
            overflow: hidden; /* Mencegah pengguliran */
        }

        .main-content {
            display: flex;
            justify-content: center; /* Menjaga konten tetap di tengah */
            align-items: flex-start; /* Mengatur agar konten diatur ke atas */
            height: 100vh; /* Mengatur tinggi konten utama */
            padding: 20px; /* Tambahkan padding untuk ruang */
        }

        .card {
            border-radius: 15px; /* Sudut yang lebih halus */
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Bayangan untuk tampilan yang lebih modern */
            max-width: 600px; /* Maksimal lebar card yang lebih kecil */
            width: 100%; /* Lebar penuh */
            height: auto; /* Mengatur tinggi card agar otomatis */
            padding: 20px; /* Padding untuk ruang di dalam card */
            margin-top: 40px; /* Tambahkan margin atas agar tidak terlalu dekat dengan navbar */
        }

        .card-body {
            background: linear-gradient(to bottom right, #ffffff, #f8f9fa); /* Gradasi ringan untuk tampilan yang lebih modern */
            padding: 20px; /* Padding untuk ruang di dalam card */
        }

        .info-item {
            margin-bottom: 15px; /* Spasi di antara item info */
        }

        .info-item span {
            color: #343a40; /* Warna gelap untuk teks */
            display: block; /* Memastikan label dan nilai diatur di bawah satu sama lain */
        }

        .btn {
            transition: background-color 0.3s ease; /* Transisi halus saat hover */
            padding: 10px 15px; /* Padding tombol untuk ukuran yang lebih besar */
            border-radius: 5px; /* Sudut tombol yang halus */
            background-color: #007bff; /* Warna latar belakang tombol */
            color: #ffffff; /* Warna teks tombol */
            text-decoration: none; /* Menghilangkan garis bawah pada teks */
        }

        .btn:hover {
            background-color: #0056b3; /* Warna tombol saat hover */
        }
    </style>

    <div class="main-content">
        <div class="card shadow border-0 rounded">
            <div class="card-body">
                <h1 class="mb-4 text-center">Profil Siswa</h1>
                <div class="row">
                    <div class="col-md-4 text-center">
                        <img src="{{ Auth::user()->photo ? asset('storage/' . Auth::user()->photo) : asset('default-avatar.png') }}" alt="Admin" class="profile-img rounded-circle shadow" style="width: 150px; height: 150px; object-fit: cover;"> <!-- Mengurangi ukuran gambar -->
                        <h4 class="mt-3">{{ Auth::user()->name }}</h4>
                        <p class="text-muted">{{ Auth::user()->alamat }}</p>
                    </div>
                    <div class="col-md-8">
                        <div class="info-item mb-3">
                            <span class="info-label fw-bold">Nama Lengkap:</span>
                            <span>{{ Auth::user()->name }}</span>
                        </div>
                        <div class="info-item mb-3">
                            <span class="info-label fw-bold">NIS:</span>
                            <span>{{ Auth::user()->nis }}</span>
                        </div>
                        @if(Auth::user()->role !== 'guru')
                        <div class="info-item mb-3">
                            <span class="info-label fw-bold">Kelas:</span>
                            <span>{{ Auth::user()->kelas }}</span>
                        </div>
                        @endif
                        <div class="info-item mb-3">
                            <span class="info-label fw-bold">No Hp:</span>
                            <span>{{ Auth::user()->nohp ?? 'Nomor HP Belum Di isi' }}</span>
                        </div>
                        <div class="info-item mb-3">
                            <span class="info-label fw-bold">Alamat:</span>
                            <span>{{ Auth::user()->alamat ?? 'Alamat Belum Di isi' }}</span>
                        </div>
                        <div class="info-item mb-3">
                            <span class="info-label fw-bold">Sebagai:</span>
                            <span>{{ Auth::user()->role }}</span>
                        </div>
                        <div class="mt-4 d-flex justify-content-between">
                            <a href="{{ route('siswa.dashboard') }}" class="btn btn-primary btn-lg">Kembali</a>
                            <a href="{{ route('siswa.profiles.edit', Auth::user()->id) }}" class="btn btn-warning btn-lg">Edit Profil Siswa</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
