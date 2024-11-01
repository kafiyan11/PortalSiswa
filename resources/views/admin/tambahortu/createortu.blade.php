<head>
    <title>Tambah Orang Tua | Portal Siswa</title>
</head>

@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4 text-primary">Tambah Data Orang Tua</h1>
    
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
        <form action="{{ route('store.ortu') }}" method="POST">
            @csrf
            <!-- Nama Orang Tua -->
            <div class="mb-3">
                <label for="name" class="form-label">Nama Orang Tua</label>
                <input 
                    type="text" 
                    class="form-control @error('name') is-invalid @enderror" 
                    id="name" 
                    name="name" 
                    placeholder="Masukkan nama orang tua" 
                    value="{{ old('name') }}" 
                    required
                >
                @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- NIS -->
            <div class="mb-3">
                <label for="nis" class="form-label">NIS</label>
                <input 
                    type="text" 
                    class="form-control @error('nis') is-invalid @enderror" 
                    id="nis" 
                    name="nis" 
                    placeholder="Masukkan NIS orang tua" 
                    value="{{ old('nis') }}" 
                    required
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

            <!-- Dropdown Siswa -->
            <div class="mb-3">
                <label for="students" class="form-label">Orang Tua Dari</label>
                <select 
                    class="form-select @error('students') is-invalid @enderror" 
                    id="students" 
                    name="students[]" 
                    required >
                    <option value="">Pilih Siswa</option>
                    @foreach($students as $student)
                        <option value="{{ $student->id }}" {{ in_array($student->id, old('students', [])) ? 'selected' : '' }}>
                            {{ $student->name }} ({{ $student->nis }})
                        </option>
                    @endforeach
                </select>
                @error('students')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Tombol Submit dan Kembali -->
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('ortu') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>
@endsection
