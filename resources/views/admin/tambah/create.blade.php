<head>
    <title>Tambah Siswa | Portal Siswa</title>
</head>
@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Tambah Data Siswa</h1>
    
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

    <div class="card p-4">
        <form action="{{ route('store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <!-- Nama -->
            <div class="mb-3">
                <label for="name" class="form-label">Nama</label>
                <input 
                    type="text" 
                    class="form-control @error('name') is-invalid @enderror" 
                    id="name" 
                    name="name" 
                    placeholder="Masukkan nama" 
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
                    placeholder="Masukkan NIS" 
                    value="{{ old('nis') }}" 
                    required
                >
                @error('nis')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <!-- Kelas -->
                <div class="form-group mb-3">
                    <label for="kelas">Kelas</label>
                    <select id="kelas" name="kelas" class="form-control @error('kelas') is-invalid @enderror" onchange="updateKelasOptions()">
                        <option value="" disabled selected>Pilih Kelas</option>
                        <option value="X">X</option>
                        <option value="XI">XI</option>
                        <option value="XII">XII</option>
                    </select>
                    @error('kelas')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="jurusan">Jurusan</label>
                    <select id="jurusan" name="jurusan" class="form-control @error('jurusan') is-invalid @enderror" onchange="updateNomorOptions()" disabled>
                        <option value="" disabled selected>Pilih Jurusan</option>
                        <option value="TKRO">TKRO</option>
                        <option value="TKJ">TKJ</option>
                        <option value="RPL">RPL</option>
                        <option value="MP">MP</option>
                        <option value="AKL">AKL</option>
                        <option value="DPIB">DPIB</option>
                        <option value="SK">SK</option>
                    </select>
                    @error('jurusan')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="nomor">Nomor Kelas</label>
                    <select id="nomor" name="nomor" class="form-control @error('nomor') is-invalid @enderror" disabled>
                        <option value="" disabled selected>Pilih Nomor Kelas</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                    </select>
                    @error('nomor')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <input type="hidden" name="kelas" id="kelas_hidden" value="{{ old('kelas', Auth::user()->kelas) }}">
            

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
            <!-- Tombol Submit -->
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('tambah') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>
<script>
    function updateKelasOptions() {
        // Aktifkan dropdown jurusan ketika kelas dipilih
        const kelas = document.getElementById('kelas').value;
        const jurusan = document.getElementById('jurusan');
        
        if (kelas) {
            jurusan.disabled = false;
        } else {
            jurusan.disabled = true;
        }
    }

    function updateNomorOptions() {
        // Aktifkan dropdown nomor kelas ketika jurusan dipilih
        const jurusan = document.getElementById('jurusan').value;
        const nomor = document.getElementById('nomor');
        
        if (jurusan) {
            nomor.disabled = false;
        } else {
            nomor.disabled = true;
        }
    }

    function getSelectedKelas() {
        const kelas = document.getElementById('kelas').value;
        const jurusan = document.getElementById('jurusan').value;
        const nomor = document.getElementById('nomor').value;

        if (kelas && jurusan && nomor) {
            document.getElementById('kelas_hidden').value = `${kelas} ${jurusan} ${nomor}`;
        }
    }

    document.getElementById('jurusan').addEventListener('change', getSelectedKelas);
    document.getElementById('nomor').addEventListener('change', getSelectedKelas);
</script>
@endsection
