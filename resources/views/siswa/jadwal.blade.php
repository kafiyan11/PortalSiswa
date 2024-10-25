<head>
    <title>Jadwal | Portal Siswa</title>
    <style>
        .table-custom thead {
            background-color: #3498db; /* Warna biru terang */
            color: white;
        }

        .table-custom tbody tr:hover {
            background-color: #f1f1f1; /* Warna latar saat di-hover */
        }

        .alert-custom {
            background-color: #e3f2fd; /* Biru lembut untuk alert */
            color: #0d6efd;
            border-radius: 8px; /* Membuat sudut alert melengkung */
        }

        .table td, .table th {
            vertical-align: middle; /* Membuat teks sejajar di tengah */
            padding: 12px;
        }

        .table-custom th, .table-custom td {
            border-bottom: 1px solid #dee2e6; /* Warna border lebih halus */
        }

        .bi-calendar-x-fill {
            color: #ff6b6b; /* Warna merah untuk ikon kosong */
        }
    </style>
</head>

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="fw-bold text-primary">Jadwal Hari Ini</h1>
    </div>

    @if($jadwals->isEmpty())
        <div class="alert alert-custom text-center shadow-lg" role="alert">
            <i class="bi bi-calendar-x-fill"></i> Tidak ada jadwal untuk hari ini.
        </div>
    @else
        <div class="table-responsive shadow-lg rounded">
            <table class="table table-hover table-custom align-middle">
                <thead>
                    <tr>
                        <th>Kelas</th>
                        <th>Mata Pelajaran</th>
                        <th>Guru</th>
                        <th>Hari</th>
                        <th>Jam Mulai</th>
                        <th>Jam Selesai</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($jadwals as $jadwal)
                    <tr>
                        <td>{{ $jadwal->kelas }}</td>
                        <td>{{ $jadwal->materi->nama_mapel }}</td>
                        <td>{{ $jadwal->guru }}</td>
                        <td>{{ $jadwal->hari }}</td>
                        <td>{{ $jadwal->jam_mulai }}</td>
                        <td>{{ $jadwal->jam_selesai }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
