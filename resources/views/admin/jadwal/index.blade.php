@extends('layouts.app')

@section('content')
<head>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="fw-bold">Daftar Jadwal</h1>
        <a href="{{ route('admin.jadwal.create') }}" class="btn btn-primary btn-lg">
            <i class="bi bi-plus-circle"></i> Tambah Jadwal
        </a>
    </div>

    @if(session('success'))
    <script>
        Swal.fire({
        title: "Kerja Bagus!",
        text: "{{ session('success') }}",
        icon: "success"
        });
    </script>
    @endif

    <div class="table-responsive">
        <table class="table table-hover table-striped align-middle">
            <thead class="table-dark">
                <tr>
                    <th>Kelas</th>
                    <th>Mata Pelajaran</th>
                    <th>Guru</th>
                    <th>Jam Mulai</th>
                    <th>Jam Selesai</th>
                    <th>Tanggal</th>
                    <th>Hari</th> <!-- Tambahkan kolom untuk hari -->
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($jadwals as $jadwal)
                <tr>
                    <td>{{ $jadwal->kelas }}</td>
                    <td>{{ $jadwal->mata_pelajaran }}</td>
                    <td>{{ $jadwal->guru }}</td>
                    <td>{{ $jadwal->jam_mulai }}</td>
                    <td>{{ $jadwal->jam_selesai }}</td>
                    <td>{{ $jadwal->tanggal }}</td>
                    <td>{{ $jadwal->hari }}</td> <!-- Tampilkan hari di sini -->
                    <td class="text-center">
                        <a href="{{ route('admin.jadwal.edit', $jadwal->id) }}" class="btn btn-warning btn-sm">
                            <i class="bi bi-pencil-square"></i> Edit
                        </a>
                        <form action="{{ route('admin.jadwal.destroy', $jadwal->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus jadwal ini?')">
                                <i class="bi bi-trash"></i> Hapus
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
