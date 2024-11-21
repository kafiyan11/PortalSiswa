<head>
    <title>Daftar Mata Pelajaran | Portal Siswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="fw-bold mb-4">Daftar Mata Pelajaran</h2>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <a href="{{ route('namamapel.create') }}" class="btn btn-success">
            <i class="bi bi-plus-circle"></i> Tambah
        </a>
    
        <form action="{{ route('namamapel.index') }}" method="GET" class="w-50">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Cari Mata Pelajaran..." value="{{ request('search') }}">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-search"></i> Cari
                </button>
            </div>
        </form>
    </div>
    
    <br>
    <!-- Notifikasi SweetAlert2 -->
    @if(session('success'))
    <script>
        Swal.fire({
            title: "Kerja Bagus!",
            text: "{{ session('success') }}",
            icon: "success"
        });
    </script>
    @endif

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
            @if($materi->isEmpty())
            <tr>
                <td colspan="4" class="text-center">Tidak ada mata pelajaran yang tersedia.</td>
            </tr>
            @else
                @foreach($materi as $no => $item)
                <tr>
                    <td>{{ $no + 1 }}</td>
                    <td>{{ $item->nama_mapel }}</td>
                    <td><img src="{{ asset('storage/' . $item->icon) }}" alt="Icon" width="50"></td>
                    <td>
                        <a href="{{ route('namamapel.edit', $item->id_mapel) }}" class="btn btn-warning btn-sm">
                            <i class="bi bi-pencil-fill"></i>
                        </a>
                        <form action="{{ route('namamapel.destroy', $item->id_mapel) }}" id="form-delete-{{$item->id_mapel}}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-danger btn-sm delete-btn" data-id="{{$item->id_mapel}}">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            @endif
        </tbody>
        
    </table>
    <div class="d-flex justify-content-end">
        {{ $materi->links() }}
    </div>
</div>

<script>
    $(document).ready(function() {
        // Konfirmasi penghapusan dengan SweetAlert2
        $('.delete-btn').click(function() {
            var button = $(this);
            var id = button.data('id');

            Swal.fire({
                title: "Apa kamu yakin?",
                text: "Menghapus akun ini tidak dapat dikembalikan!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya, hapus!",
                cancelButtonText: "Batal"
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#form-delete-' + id).submit();
                }
            });
        });
    });
</script>
@endsection
