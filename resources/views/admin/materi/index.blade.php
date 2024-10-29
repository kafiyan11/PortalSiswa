<!DOCTYPE html>
<html lang="en">
<head>
    <title>Materi Siswa | Portal Siswa</title>
    <link href="{{ asset('assets/img/favicon.png') }}" rel="icon">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
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
    <h2 class="text-center">Materi Siswa</h2><br>

    <div class="d-flex justify-content-between align-items-center mb-3">
            <form action="{{route('materiAdmin.cari')}}" method="GET" class="input-group" style="max-width: 400px;">
                <input type="text" name="cari" class="form-control search-input" placeholder="Cari siswa..." value="{{ request()->get('cari') }}">
                <div class="input-group-append">
                    <button class="btn btn-primary search-btn" type="submit">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </form>
                <a href="{{ route('adminMateri.create') }}" class="btn btn-primary"> Tambah Materi</a>
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
                            <th>NO</th>
                            <th>Judul</th>
                            <th>Kelas</th>
                            <th>Mata Pelajaran</th>
                            <th>Materi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                       <!-- Loop data siswa -->
                       @foreach($materi as $index => $item)
                            <tr>
                                <td>{{ $index + 1 }}</td> <!-- Menampilkan nomor urut -->
                                <td>{{ $item->judul }}</td> <!-- Menampilkan judul materi -->
                                <td>{{ $item->kelas }}</td>
                                <td>{{ optional($item->mapel)->nama_mapel }}</td>
                                <td>
                                    @if($item->tipe == 'gambar')
                                        <a href="{{ asset('storage/' . $item->gambar) }}" target="_blank">
                                        <img src="{{ asset('storage/' . $item->gambar) }}" alt="Materi Gambar" width="100px"></a>
                                    @else
                                        @if (Str::contains($item->link_youtube, 'youtube.com') || Str::contains($item->link_youtube, 'youtu.be'))
                                            @php
                                                // Mendapatkan video ID dari link YouTube
                                                $youtubeUrl = $item->link_youtube;
                                                $videoId = null;
                                                if (preg_match('/(youtube\.com.*(\?v=|\/embed\/)|youtu\.be\/)([a-zA-Z0-9_-]+)/', $youtubeUrl, $matches)) {
                                                $videoId = $matches[3];
                                                }
                                            @endphp
                                        @if($videoId)
                                            <iframe width="150" height="100" src="https://www.youtube.com/embed/{{ $videoId }}" frameborder="0" allowfullscreen></iframe>
                                                @else
                                                    <a href="{{ $item->link_youtube }}" target="_blank"><i class="fab fa-youtube"></i> Link YouTube</a>
                                                @endif
                                                @else
                                                <a href="{{ $item->link_youtube }}" target="_blank"><i class="fab fa-youtube"></i> Link YouTube</a>
                                                @endif
                                        @endif
                                </td>
                                <td>
                                <div class="d-inline-flex">
                                    <a href="{{ route('adminMateri.edit', $item->id) }}" class="btn btn-warning btn-sm mr-2">
                                        <i class="fa fa-edit"></i></a>
                                            <button type="button" class="btn btn-sm btn-danger" onclick="confirmDelete('{{ $item->id }}')">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                </div>
                                    <!-- Form tersembunyi untuk menghapus materi -->
                                    <form id="delete-form-{{ $item->id }}" action="{{ route('adminMateri.destroy', $item->id) }}" method="POST" style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                            @if($materi->isEmpty())
                                <tr>
                                    <td colspan="5" class="text-center">Tidak ada data materi ditemukan.</td>
                                </tr>
                            @endif
                        </tbody>
                </table>
            </div>
                <div class="d-flex justify-content-end">
                    {{ $materi->links() }}
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




