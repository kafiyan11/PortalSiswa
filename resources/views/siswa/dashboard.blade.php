<head>
    <title>Beranda | Portal Siswa</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Beranda</h1>
    <p>Selamat datang <strong>{{ Auth::user()->name }}</strong></p>
    <hr>
    <div class="d-flex justify-content-center align-items-center mb-4">
        <h2 class="fw-bold  text-center">Jadwal Hari Ini</h2>
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
<script>
    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Sukses!',
            text: '{{ session('success') }}',
            confirmButtonText: 'OK'
        });
    @endif
</script>
@endsection
