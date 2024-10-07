@extends('layouts.app')

@section('content')
<head>
    <!-- Memuat library SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <style>
        body {
            background-color: #f8f9fa; /* Warna latar belakang */
        }
        h2 {
            color: #343a40; /* Warna judul */
            margin-bottom: 20px; /* Jarak bawah judul */
        }
        .card {
            border: none; /* Tanpa border */
            border-radius: 10px; /* Sudut melengkung */
        }
        .table th, .table td {
            vertical-align: middle; /* Vertikal alignment */
        }
        .search-container {
            padding: 10px; /* Padding di sekitar kontainer pencarian */
            background: linear-gradient(to right, #e9ecef, #f8f9fa); /* Warna latar belakang gradien */
            border-radius: 10px; /* Sudut melengkung */
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); /* Bayangan ringan */
        }
        .search-input {
            border-radius: 20px; /* Sudut melengkung untuk input pencarian */
        }
        .search-btn {
            border-radius: 20px; /* Sudut melengkung untuk tombol pencarian */
        }
    </style>
</head>

<div class="container mt-4" style="max-width: 1000px;">
    <h2 class="text-center">Nilai Siswa</h2>

    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3 search-container">
                <form action="" method="GET" class="input-group" style="max-width: 400px;">
                    <input type="text" name="cari" class="form-control search-input" placeholder="Cari siswa..." value="{{ request()->get('search') }}">
                    <div class="input-group-append">
                        <button class="btn btn-primary search-btn" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </form>
                <a href="{{ route('guru.scores.create') }}" class="btn btn-success">
                    <i class="fas fa-plus"></i> Tambah Nilai
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
                <table class="table table-striped table-hover">
                    <thead class="thead-light">
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>NIS</th>
                            <th>UH</th>
                            <th>UTS</th>
                            <th>UAS</th>
                            <th style="width: 150px;" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($scores as $index => $score)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $score->nama }}</td>
                            <td>{{ $score->nis }}</td>
                            <td>{{ $score->daily_test_score }}</td>
                            <td>{{ $score->midterm_test_score }}</td>
                            <td>{{ $score->final_test_score }}</td>
                            <td class="text-center">
                                <div class="d-inline-flex align-items-center">
                                    <a href="{{ route('guru.scores.edit', $score->id) }}" class="btn btn-warning btn-sm mr-1">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete('{{ $score->id }}')">
                                        <i class="fas fa-trash"></i> Hapus
                                    </button>
                                    <form id="delete-form-{{ $score->id }}" action="{{ route('guru.scores.destroy', $score->id) }}" method="POST" style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-end">
                    {{ $scores->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

<script>
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
@endsection
