@extends('layouts.app')

@section('content')
<head>
    <title>Edit Jadwal | Portal Siswa</title>
    <style>
        .container {
            margin-top: -20px;
        }
    </style>
</head>

<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="fw-bold">Edit Jadwal</h1>
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

    <form action="{{ route('admin.jadwal.update', $jadwal->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="kelas" class="form-label">Kelas</label>
            <input type="text" name="kelas" class="form-control" value="{{ old('kelas', $jadwal->kelas) }}" required>
        </div>

        <div class="mb-3">
            <label for="mata_pelajaran" class="form-label">Mata Pelajaran</label>
            <select id="mata_pelajaran" name="mata_pelajaran" class="form-control" required>
                <option value="">Pilih Mata Pelajaran</option>
                @foreach($mapel as $m)
                    <option value="{{ $m->id_mapel }}" {{ old('mata_pelajaran', $jadwal->mata_pelajaran) == $m->id_mapel ? 'selected' : '' }}>
                        {{ $m->nama_mapel }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="guru" class="form-label">Guru</label>
            <select id="guru" name="guru" class="form-control" required>
                <option value="">Pilih Guru</option>
                @foreach($gurus as $guru)
                    <option value="{{ $guru->name }}" {{ old('guru', $jadwal->guru) == $guru->id ? 'selected' : '' }}>
                        {{ $guru->name }} <!-- Pastikan ini field yang sesuai dari model User -->
                    </option>
                @endforeach
            </select>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="jam_mulai" class="form-label">Jam Mulai</label>
                <input type="time" name="jam_mulai" class="form-control" value="{{ old('jam_mulai', $jadwal->jam_mulai) }}" required>
            </div>
            <div class="col-md-6 mb-3">
                <label for="jam_selesai" class="form-label">Jam Selesai</label>
                <input type="time" name="jam_selesai" class="form-control" value="{{ old('jam_selesai', $jadwal->jam_selesai) }}" required>
            </div>
        </div>

        <div class="mb-3">
            <label for="tanggal" class="form-label">Tanggal</label>
            <input type="date" name="tanggal" class="form-control" value="{{ old('tanggal', $jadwal->tanggal) }}" required>
        </div>

        <div class="text-end">
            <button type="submit" class="btn btn-primary btn-lg">
                <i class="bi bi-save"></i> Simpan Perubahan
            </button>
        </div>
    </form>
</div>
@endsection
