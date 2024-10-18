<head>
    <title>Tambah Mata Pelajaran | Portal Siswa</title>
</head>
@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Tambah Mata Pelajaran</h1>

    <form action="{{ route('namamapel.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="nama_mapel">Nama Mata Pelajaran</label>
            <input type="text" name="nama_mapel" class="form-control" required>
        </div><br>
        <div class="form-group">
            <label for="icon">Upload Icon</label>
            <input type="file" name="icon" class="form-control" accept="image/*" required>

        </div><br>
        <button type="submit" class="btn btn-primary">Simpan Mata Pelajaran</button>
        <a href="{{ route('namamapel.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
