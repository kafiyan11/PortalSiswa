<head>
    <title>Dashboard | Portal Siswa</title>
</head>@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="fw-bold">Beranda</h1>
    </div>

    @if($jadwals->isEmpty())
        <div class="alert alert-info text-center" role="alert">
            <i class="bi bi-calendar "></i> Tidak ada jadwal untuk hari ini.
        </div>
    @else
        <div class="table-responsive">
            <table class="table table-hover table-striped align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>Kelas</th>
                        <th>Mata Pelajaran</th>
                        <th>Guru</th>
                        <th>Jam Mulai</th>
                        <th>Jam Selesai</th>
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
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
