<head>
    <title>Edit Data Guru | Portal Siswa</title>
</head>
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Data Guru</h1>
    
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

    <form action="{{ route('update.guru', $data->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <!-- Nama Guru -->
        <div class="mb-3">
            <label for="name" class="form-label">Nama Guru</label>
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
        
        <!-- NIP -->
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
        
        <!-- Mengajar Dropdown -->
        <div class="mb-3">
            <label for="mengajar" class="form-label">Mengajar</label>
            <select 
                class="form-control @error('mengajar') is-invalid @enderror" 
                name="mengajar" 
                id="mengajar"
            >
                <option value="">-- Pilih Bagian Mengajar (Kosongkan jika tidak ingin mengubah) --</option>
                @foreach($mapel as $m)
                    <option value="{{ $m->nama_mapel }}" {{ (old('mengajar') == $m->nama_mapel || $data->mengajar == $m->nama_mapel) ? 'selected' : '' }}>
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
            <label for="password" class="form-label">Password Baru</label>
            <input 
                type="password" 
                class="form-control @error('password') is-invalid @enderror" 
                id="password" 
                name="password" 
                placeholder="Masukkan password baru jika ingin mengganti"
            >
            @error('password')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        
        <!-- Konfirmasi Password -->
        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Konfirmasi Password Baru</label>
            <input 
                type="password" 
                class="form-control @error('password_confirmation') is-invalid @enderror" 
                id="password_confirmation" 
                name="password_confirmation" 
                placeholder="Konfirmasi password baru"
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
@endsection
