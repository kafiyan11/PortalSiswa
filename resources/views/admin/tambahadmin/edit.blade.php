<head>
    <title>Edit Data Siswa | Portal Siswa</title>
</head>@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Data Admin</h1>
    
    <!-- Alert Section -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Sukses!</strong> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @elseif($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error!</strong> Terjadi kesalahan:
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <form action="{{ route('update.admin', $data->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <!-- Nama -->
        <div class="mb-3">
            <label for="name" class="form-label">Nama</label>
            <input 
                type="text" 
                class="form-control @error('name') is-invalid @enderror" 
                id="name" 
                name="name" 
                required 
                value="{{ old('name', $data->name) }}"
            >
            @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        
        <!-- NIS -->
        <div class="mb-3">
            <label for="nis" class="form-label">NIP</label>
            <input 
                type="text" 
                class="form-control @error('nis') is-invalid @enderror" 
                id="nis" 
                name="nis" 
                required 
                value="{{ old('nis', $data->nis) }}"
            >
            @error('nis')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        
        <!-- Password -->
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input 
                type="password" 
                class="form-control @error('password') is-invalid @enderror" 
                id="password" 
                name="password" 
                placeholder="Masukkan password baru (biarkan kosong jika tidak diubah)"
            >
            @error('password')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        
        <!-- Konfirmasi Password -->
        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
            <input 
                type="password" 
                class="form-control @error('password_confirmation') is-invalid @enderror" 
                id="password_confirmation" 
                name="password_confirmation" 
                placeholder="Konfirmasi password"
            >
            @error('password_confirmation')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        
        <button type="submit" class="btn btn-primary">Simpan</button>
        &nbsp;
        <a href="{{ route('tambah.admin') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
    const kelasSelect = document.getElementById('kelas');
    const jurusanSelect = document.getElementById('jurusan');
    const nomorSelect = document.getElementById('nomor');

    // Fungsi untuk mengaktifkan/menonaktifkan pilihan jurusan berdasarkan kelas yang dipilih
    function updateKelasOptions() {
        if (kelasSelect.value) {
            jurusanSelect.disabled = false; // Aktifkan dropdown jurusan jika kelas dipilih
        } else {
            jurusanSelect.disabled = true; // Nonaktifkan dropdown jurusan jika kelas belum dipilih
            jurusanSelect.value = ''; // Reset pilihan jurusan
            nomorSelect.disabled = true; // Nonaktifkan dropdown nomor
            nomorSelect.value = ''; // Reset pilihan nomor
        }
    }

    // Fungsi untuk mengaktifkan/menonaktifkan pilihan nomor berdasarkan jurusan yang dipilih
    function updateNomorOptions() {
        if (jurusanSelect.value) {
            nomorSelect.disabled = false; // Aktifkan dropdown nomor jika jurusan dipilih
        } else {
            nomorSelect.disabled = true; // Nonaktifkan dropdown nomor jika jurusan belum dipilih
            nomorSelect.value = ''; // Reset pilihan nomor
        }
    }

    // Event listener untuk mengaktifkan fungsi saat dropdown diubah
    kelasSelect.addEventListener('change', updateKelasOptions);
    jurusanSelect.addEventListener('change', updateNomorOptions);

    // Panggil fungsi saat halaman dimuat untuk memastikan status dropdown sesuai dengan kondisi awal
    updateKelasOptions();
    updateNomorOptions();
});

</script>
@endsection