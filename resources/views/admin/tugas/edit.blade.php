<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Tugas | Portal Siswa</title>
    <link href="{{ asset('assets/img/favicon.png') }}" rel="icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .container-custom {
            max-width: 800px;
            margin: 20px auto; /* Mengatur margin agar tetap berada di tengah */
        }

        .form-section {
            background-color: #f8f9fa;
            padding: 30px; /* Tambahkan padding untuk tampilan yang lebih baik */
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .form-section h2 {
            margin-bottom: 20px;
            font-size: 28px; /* Ukuran font yang lebih besar */
            font-weight: bold;
            color: #007bff;
        }

        .form-section label {
            font-weight: bold; /* Menebalkan label */
        }

        .btn-custom {
            background-color: #007bff; /* Warna tombol yang lebih mencolok */
            color: #fff;
        }

        .btn-custom:hover {
            background-color: #0056b3; /* Warna tombol saat hover */
        }

        .invalid-feedback {
            display: none; /* Sembunyikan feedback jika tidak ada kesalahan */
        }

        .is-invalid ~ .invalid-feedback {
            display: block; /* Tampilkan feedback jika input invalid */
        }
    </style>
</head>

<body>

@extends('layouts.app')

@section('content')
<div class="container-custom">
    <div class="form-section">
        <h2>Edit Tugas</h2>
        <form action="{{ route('updatee_tugas', $siswa->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="kelas" class="form-label">Kelas</label>
                <input type="text" class="form-control @error('kelas') is-invalid @enderror" id="kelas" name="kelas" required value="{{ old('kelas', $siswa->kelas) }}">
                @error('kelas')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="id_mapel" class="form-label">Mapel</label>
                <select name="id_mapel" id="id_mapel" class="form-select @error('id_mapel') is-invalid @enderror" required>
                    @foreach($mapel as $m)
                        <option value="{{ $m->id_mapel }}" {{ $m->id_mapel == $siswa->id_mapel ? 'selected' : '' }}>
                            {{ $m->nama_mapel }}
                        </option>
                    @endforeach
                </select>
                @error('id_mapel')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="gambar_tugas" class="form-label">Gambar</label>
                @if ($siswa->gambar_tugas)
                    <img src="{{ asset('gambar_tugas/' . $siswa->gambar_tugas) }}" alt="Gambar Tugas" class="mb-2" style="width: 100px;">
                @endif
                <input type="file" class="form-control @error('gambar_tugas') is-invalid @enderror" id="gambar_tugas" name="gambar_tugas">
                @error('gambar_tugas')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="text-end">
                <button type="submit" class="btn btn-custom">Simpan</button>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection

</body>

</html>
