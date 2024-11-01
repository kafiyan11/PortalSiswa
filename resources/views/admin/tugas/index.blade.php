<!DOCTYPE html>
<html lang="en">
<head>
    <title>Data Tugas Siswa | Portal Siswa</title>
    <link href="{{ asset('assets/img/favicon.png') }}" rel="icon">
    <!-- Library SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <!-- Library Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    
    <!-- Library Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
@extends('layouts.app')

@section('content')
<head>

    <!-- Library SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <!-- Library Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    
    <!-- Library Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<div class="container mt-4" style="max-width: 1000px;">
    <h2 class="text-center">Data Tugas Siswa</h2>

    <div class="d-flex justify-content-between align-items-center mb-3">
            <form action="{{route('admin.tugas.index')}}" method="GET" class="input-group" style="max-width: 400px;">
                <input type="text" name="cari" class="form-control search-input" placeholder="Cari siswa..." value="{{ request()->get('cari') }}">
                <div class="input-group-append">
                    <button class="btn btn-primary search-btn" type="submit">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </form>
                <a href="{{ route('admin.create') }}" class="btn btn-primary"> Tambah Tugas</a>
    </div>

    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <!-- Pencarian dan Tombol Tambah Nilai -->
     

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

            <!-- Tabel Nilai Siswa -->
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="thead-light">
                        <tr>
                            <th>No</th>
                            <th>Kelas</th>
                            <th>Mata Pelajaran</th>
                            <th>Tugas</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                       <!-- Loop data siswa -->
                        @forelse ($siswa as $no => $siswas)
                        <tr>
                            <td>{{ $no + 1 }}</td>
                            <td>{{ $siswas->kelas }}</td>
                            <td>{{ optional($siswas->mapel)->nama_mapel }}</td> <!-- Menampilkan nama mapel -->
                            <td>
                                @if ($siswas->gambar_tugas)
                                    <a href="{{ asset('gambar_tugas/' . $siswas->gambar_tugas) }}" target="_blank">
                                        <img src="{{ asset('gambar_tugas/' . $siswas->gambar_tugas) }}" alt="Gambar Tugas" width="100" class="img-fluid d-block">
                                    </a>
                                @else
                                    -
                                @endif
                            </td>
                            <td>
                                <div class="d-inline-flex">
                                    <!-- Tombol Edit -->
                                    <a href="{{ route('tugas.edit', $siswas->id) }}" class="btn btn-sm btn-warning mr-2">
                                        <i class="fa fa-edit"></i> 
                                    </a>
                                    &nbsp;
                                    <!-- Tombol Hapus -->
                                    <form id="delete-form-{{ $siswas->id }}" action="{{ route('tugas.hapus', $siswas->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-sm btn-danger delete-btn" onclick="confirmDelete('{{ $siswas->id }}')">
                                            <i class="fas fa-trash-alt"></i> 
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center">Tidak ada data tugas ditemukan.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="d-flex justify-content-end">
                    {{ $siswa->appends(['cari' => request()->get('cari')])->links() }}
                </div> 
            </div>
        </div>
    </div>

    
    <script>
        // Fungsi konfirmasi hapus dengan SweetAlert2
        function confirmDelete(id) {
            Swal.fire({
                title: "Apakah Anda yakin?",
                text: "Data ini akan dihapus secara permanen!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya, hapus!",
                cancelButtonText: "Batal"
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + id).submit();
                }
            });
        }
    </script>
</body>
</html>
@endsection



