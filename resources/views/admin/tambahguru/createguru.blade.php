<head>
    <title>Tambah Data Guru | Portal Siswa</title>
</head>@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4 text-primary">Tambah Data Guru</h1>
    
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

    <div class="card p-4 shadow-sm">
        <form action="{{ route('store.guru') }}" method="POST">
            @csrf
            <!-- Nama Guru -->
            <div class="mb-3">
                <label for="name" class="form-label">Nama Guru</label>
                <input 
                    type="text" 
                    class="form-control @error('name') is-invalid @enderror" 
                    id="name" 
                    name="name" 
                    placeholder="Masukkan nama guru" 
                    value="{{ old('name') }}" 
                    required
                >
                @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <!-- NIP -->
            <div class="mb-3">
                <label for="nis" class="form-label">NIP</label>
                <input 
                    type="text" 
                    class="form-control @error('nis') is-invalid @enderror" 
                    id="nis" 
                    name="nis" 
                    placeholder="Masukkan NIP guru" 
                    value="{{ old('nis') }}" 
                    required
                >
                @error('nis')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        <!-- Mengajar Dropdown -->
        <div class="mb-3">
            <label for="mengajar" class="form-label">Mengajar <span class="text-danger">*</span></label>
            <select 
                class="form-control @error('mengajar') is-invalid @enderror" 
                name="mengajar" 
                id="mengajar" 
                required
            >
                <option value="">-- Pilih Bagian Mengajar --</option>
                @foreach($mapel as $m) <!-- Pastikan variabel $mapel berisi data mapel -->
                    <option value="{{ $m->nama_mapel }}" {{ old('mengajar') == $m->nama_mapel ? 'selected' : '' }}>
                        {{ $m->nama_mapel }}
                    </option>
                @endforeach
            </select>
            
            @error('mengajar')
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
                    placeholder="Masukkan password" 
                    required
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
                    required
                >
                @error('password_confirmation')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <!-- Tombol Submit dan Kembali -->
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('tambahguru') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>
@endsection