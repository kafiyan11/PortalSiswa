<!-- resources/views/admin/namapel/index.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Daftar Materi</h2>
    <a href="{{ route('namamapel.create') }}" class="btn btn-success mb-4">Tambah Materi</a>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Mapel</th>
                <th>Icon</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($materi as $no=>$item)
            <tr>
                <td>{{ $no+1 }}</td>
                <td>{{ $item->nama_mapel }}</td>
                <td><img src="{{ asset('storage/' . $item->icon) }}" alt="Icon" width="50"></td>
                <td>
                    <a href="{{ route('namamapel.edit', $item->id_mapel) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('namamapel.destroy', $item->id_mapel) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $materi->links() }}
</div>
@endsection
