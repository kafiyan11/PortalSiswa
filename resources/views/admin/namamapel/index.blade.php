<head>
    <title>Daftar Mata Pelajaran | Portal Siswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

</head>
@extends('layouts.app')

@section('content')
<div class="container">

    <h2 class="fw-bold mb-4">Daftar Mata Pelajaran</h2>
    <div class="d-flex justify-content-between mb-4">
        <a href="{{ route('namamapel.create') }}" class="btn btn-success">Tambah Mata Pelajaran</a>
        <!-- Form Pencarian -->
        <form action="{{ route('namamapel.index') }}" method="GET" class="w-50">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Cari Mata Pelajaran..." value="{{ request('search') }}">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-search"></i> Cari
                </button>
            </div>
        </form>
    </div>
    
    <table class="table table-hover">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Pelajaran</th>
                <th>Icon</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($materi as $no => $item)
            <tr>
                <td>{{ $no + 1 }}</td>
                <td>{{ $item->nama_mapel }}</td>
                <td><img src="{{ asset('storage/' . $item->icon) }}" alt="Icon" width="50"></td>
                <td>
                    <a href="{{ route('namamapel.edit', $item->id_mapel) }}" class="btn btn-warning btn-sm">
                        <i class="fa fa-edit"></i>
                    </a>
                    <form action="{{ route('namamapel.destroy', $item->id_mapel) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus?')">
                            <i class="fa fa-trash-alt"></i>
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $materi->links() }}
</div>
@endsection
