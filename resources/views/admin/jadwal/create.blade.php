<head>
    <title>Tambah Jadwal Siswa | Portal Siswa</title>
</head>
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="fw-bold">Tambah Jadwal</h1>
        <a href="{{ route('admin.jadwal.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left-circle"></i> Kembali
        </a>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-triangle-fill"></i> Terdapat beberapa kesalahan:
            <ul class="mt-2 mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <form action="{{ route('admin.jadwal.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="guru" class="form-label">Guru</label>
            <select id="guru" name="guru" class="form-control" required>
                <option value="">Pilih guru</option>
                @foreach($gurus as $guru)
                    <option value="{{ $guru->name }}" {{ old('guru') == $guru->name ? 'selected' : '' }}>
                        {{ $guru->name }} <!-- Ganti dengan field yang sesuai dari model User -->
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="tahun">Kelas</label>
            <select id="tahun" name="tahun" class="form-control" onchange="updateKelasOptions()">
                <option value="" disabled selected>Pilih Kelas</option>
                <option value="X">X</option>
                <option value="XI">XI</option>
                <option value="XII">XII</option>
            </select>
        </div>

        <div class="form-group">
            <label for="jenis_kelas">Jurusan</label>
            <select id="jenis_kelas" name="jenis_kelas" class="form-control" onchange="updateNomorOptions()" disabled>
                <option value="" disabled selected>Pilih Jurusan</option>
                <option value="TKRO">TKRO</option>
                <option value="TKJ">TKJ</option>
                <option value="RPL">RPL</option>
                <option value="MP">MP</option>
                <option value="AKL">AKL</option>
                <option value="DPIB">DPIB</option>
                <option value="SK">SK</option>
            </select>
        </div>

        <div class="form-group">
            <label for="nomor">Nomor Kelas</label>
            <select id="nomor" name="nomor" class="form-control" onchange="getSelectedKelas()" disabled>
                <option value="" disabled selected>Pilih Nomor Kelas</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
            </select>
        </div>

        <input type="hidden" id="kelas_hidden" name="kelas" value="">

        <div class="mb-3">
            <label for="mata_pelajaran" class="form-label">Mata Pelajaran</label>
            <select id="mata_pelajaran" name="mata_pelajaran" class="form-control" required>
                <option value="">Pilih Mata Pelajaran</option>
                @foreach($mapel as $m)
                    <option value="{{ $m->id_mapel }}" {{ old('mata_pelajaran') == $m->id_mapel ? 'selected' : '' }}>
                        {{ $m->nama_mapel }}
                    </option>
                @endforeach
            </select>
        </div>
        

        
    
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="jam_mulai" class="form-label">Jam Mulai</label>
                <input type="time" id="jam_mulai" name="jam_mulai" class="form-control" value="{{ old('jam_mulai') }}" required>
            </div>
            <div class="col-md-6 mb-3">
                <label for="jam_selesai" class="form-label">Jam Selesai</label>
                <input type="time" id="jam_selesai" name="jam_selesai" class="form-control" value="{{ old('jam_selesai') }}" required>
            </div>
        </div>
    
        <div class="mb-3">
            <label for="tanggal" class="form-label">Tanggal</label>
            <input type="date" id="tanggal" name="tanggal" class="form-control" value="{{ old('tanggal') }}" required>
        </div>
    
        <div class="text-end">
            <button type="submit" class="btn btn-primary btn-lg">
                <i class="bi bi-save"></i> Simpan Jadwal
            </button>
        </div>
    </form>
    
</div>
<script>
    function updateKelasOptions() {
        document.getElementById('jenis_kelas').disabled = false;
    }

    function updateNomorOptions() {
        document.getElementById('nomor').disabled = false;
    }

    function getSelectedKelas() {
        const tahun = document.getElementById('tahun').value;
        const jenisKelas = document.getElementById('jenis_kelas').value;
        const nomor = document.getElementById('nomor').value;

        if (tahun && jenisKelas && nomor) {
            document.getElementById('kelas_hidden').value = `${tahun} ${jenisKelas} ${nomor}`;
        }
    }

    document.getElementById('jenis_kelas').addEventListener('change', getSelectedKelas);
    document.getElementById('nomor').addEventListener('change', getSelectedKelas);
</script>
@endsection
