@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Tambah Materi</h1>

    <form action="{{ route('namamapel.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="nama_mapel">Nama Materi</label>
            <input type="text" name="nama_mapel" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="icon">Upload Ikon</label>
            <input type="file" name="icon" class="form-control" accept="image/*" required>
        </div>
        <button type="submit" class="btn btn-primary">Simpan Materi</button>
        <a href="{{ route('namamapel.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
