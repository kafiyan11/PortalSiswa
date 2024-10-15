<head>
    <title>Jadwal Mengajar | Portal Siswa</title>
    <link href="assets/img/favicon.png" rel="icon">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- Pastikan jQuery dimuat -->
    <style>
        /* Styling tambahan untuk memperindah tampilan */
        .table-hover tbody tr:hover {
            background-color: #f8f9fa;
        }
        .card {
            border: none;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }
        .btn-custom {
            background-color: #007bff;
            color: #fff;
        }
        .btn-custom:hover {
            background-color: #0056b3;
        }
        .btn-danger-custom {
            background-color: #dc3545;
            color: #fff;
        }
        .btn-danger-custom:hover {
            background-color: #c82333;
        }
    </style>
</head>

@extends('layouts.app')

@section('content')

<div class="container mt-5">
    <!-- Menggunakan card untuk membungkus tabel -->
    @if($jadwalguru->isEmpty())
    <div class="alert alert-danger" role="alert">
        Tidak ada jadwal yang tersedia. Silakan tambahkan jadwal baru.
    </div>
    @else
    <!-- Menggunakan card untuk membungkus tabel -->
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                @foreach($jadwalguru as $group => $items)
                    <h3 class="mt-4">{{ str_replace('-', ' - ', $group) }}</h3> <!-- Menampilkan kelas dan minggu -->
                    <table class="table table-hover table-striped align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th>No</th> <!-- Tambahkan kolom No di sini -->
                                <th>Nama</th>
                                <th>NIP</th>
                                <th>Kelas</th>
                                <th>Hari</th>
                                <th>Jam Mulai</th>
                                <th>Jam Selesai</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($items as $index => $jadwal) <!-- Tambahkan $index untuk nomor -->
                            <tr>
                                <td>{{ $index + 1 }}</td> <!-- Tampilkan nomor di sini -->
                                <td>{{ $jadwal->guru }}</td>
                                <td>{{ $jadwal->nis }}</td>
                                <td>{{ $jadwal->kelas }}</td>
                                <td>{{ $jadwal->hari }}</td>
                                <td>{{ $jadwal->jam_mulai }}</td>
                                <td>{{ $jadwal->jam_selesai }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endforeach
            </div>
        </div>
    </div>
    @endif

</div>
@endsection
