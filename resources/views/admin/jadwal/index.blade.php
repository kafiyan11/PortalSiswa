<head>
    <title>Jadwal Siswa | Portal Siswa</title>
</head>
@extends('layouts.app')

@section('content')
<head>
    <link href="assets/img/favicon.png" rel="icon">
    <!-- Tambahkan Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- Pastikan jQuery dimuat -->
    <style>
        /* Mengatur font global */
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f4f6f9; /* Tambahkan warna latar belakang yang lembut */
        }

        /* Styling tambahan untuk tampilan yang lebih modern */
        .table-hover tbody tr:hover {
            background-color: #e9f7fe;
        }
        .card {
            border: none;
            box-shadow: 0 0 15px rgba(0, 123, 255, 0.2);
            border-radius: 10px;
        }
        .btn-custom {
            background-color: #28a745;
            color: #fff;
            border-radius: 5px;
            font-weight: 500;
        }
        .btn-custom:hover {
            background-color: #218838;
        }
        .btn-warning {
            background-color: #ffc107;
            color: #fff;
            border-radius: 5px;
            font-weight: 500;
        }
        .btn-warning:hover {
            background-color: #e0a800;
        }
        .btn-danger-custom {
            background-color: #dc3545;
            color: #fff;
            border-radius: 5px;
            font-weight: 500;
        }
        .btn-danger-custom:hover {
            background-color: #c82333;
        }
        .table thead {
            background-color: #007bff;
            color: #fff;
            font-weight: 700;
        }
        h1, h3 {
            font-weight: 700;
        }
        .alert {
            font-weight: 500;
        }
    </style>
</head>

<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="fw-bold">Jadwal Siswa</h1>
        <a href="{{ route('admin.jadwal.create') }}" class="btn btn-custom btn-lg">
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

    @if($jadwals->isEmpty())
    <div class="alert alert-danger" role="alert">
        Tidak ada jadwal yang tersedia. Silakan tambahkan jadwal baru.
    </div>
    @else
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                @foreach($jadwals as $group => $items)
                    <h3 class="mt-4">{{ str_replace('-', ' - ', $group) }}</h3>
                    <table class="table table-hover table-striped align-middle">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kelas</th>
                                <th>Mata Pelajaran</th>
                                <th>Guru</th>
                                <th>Jam Mulai</th>
                                <th>Jam Selesai</th>
                                <th>Tanggal</th>
                                <th>Hari</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($items as $index => $jadwal)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $jadwal->kelas }}</td>
                                <td>{{ $jadwal->materi ? $jadwal->materi->nama_mapel : 'Tidak Diketahui' }}</td>
                                <td>{{ $jadwal->guru }}</td>
                                <td>{{ $jadwal->jam_mulai }}</td>
                                <td>{{ $jadwal->jam_selesai }}</td>
                                <td>{{ $jadwal->tanggal }}</td>
                                <td>{{ $jadwal->hari }}</td>
                                <td>
                                    <a href="{{ route('admin.jadwal.edit', $jadwal->id) }}" class="btn btn-warning btn-sm mr-2">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form id="form-delete-{{ $jadwal->id }}" action="{{ route('admin.jadwal.destroy', $jadwal->id) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger-custom btn-sm delete-btn" data-id="{{ $jadwal->id }}">
                                            <i class="fas fa-trash-alt"></i> 
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach           
                        </tbody>
                    </table>
                @endforeach
            </div>
        </div>
    </div>
    @endif

    <script>
        $(document).ready(function() {
            $('.delete-btn').click(function(e) {
                e.preventDefault();
                var id = $(this).data('id');
                var form = $('#form-delete-' + id);
                Swal.fire({
                    title: "Apa kamu yakin?",
                    text: "Menghapus jadwal ini tidak dapat dikembalikan!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Ya, hapus!",
                    cancelButtonText: "Batal"
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    </script>
</div>
@endsection
