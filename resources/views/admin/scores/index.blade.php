<head>
    <title>Nilai Siswa | Portal Siswa</title>
</head>@extends('layouts.app')

@section('content')
<head>
    <!-- Load SweetAlert2 library -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <style>
        body {
            background-color: #f8f9fa; /* Background color */
            font-family: 'Arial', sans-serif; /* Font style */
        }
        h2 {
            color: #343a40; /* Title color */
            margin-bottom: 20px; /* Margin below title */
            font-weight: bold; /* Bold title */
        }
        .card {
            border: none; /* No border */
            border-radius: 15px; /* Rounded corners */
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); /* Soft shadow */
        }
        .table th, .table td {
            vertical-align: middle; /* Vertical alignment */
            padding: 12px; /* Padding in table cells */
        }
        .table tbody tr:hover {
            background-color: #f1f1f1; /* Row hover effect */
        }
        .search-container {
            padding: 10px; /* Padding around search container */
            background: linear-gradient(to right, #e9ecef, #f8f9fa); /* Background gradient */
            border-radius: 10px; /* Rounded corners */
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); /* Light shadow */
        }
        .search-input {
            border-radius: 20px; /* Rounded input */
            transition: box-shadow 0.3s; /* Transition effect */
        }
        .search-input:focus {
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5); /* Focus effect */
            border-color: #007bff; /* Border color on focus */
        }
        .search-btn {
            border-radius: 20px; /* Rounded button */
            transition: background-color 0.3s; /* Transition effect */
        }
        .search-btn:hover {
            background-color: #0056b3; /* Darker on hover */
        }
        .btn-custom {
            border-radius: 20px; /* Rounded buttons */
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
                <a href="{{ route('admin.scores.create') }}" class="btn btn-success btn-custom">
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
                            <th>Total Nilai</th>
                            <th>Rata-rata</th>
                            <th>Peringkat</th>
                            <th style="width: 150px;" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($scores as $score)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $score->nama }}</td>
                            <td>{{ $score->nis }}</td>
                            <td>{{ $score->daily_test_score }}</td>
                            <td>{{ $score->midterm_test_score }}</td>
                            <td>{{ $score->final_test_score }}</td>
                            <td>{{ $score->total_score }}</td>
                            <td>{{ number_format($score->average_score, 2) }}</td>
                            <td>{{ $score->rank }}</td>
                            <td class="text-center">
                                <div class="d-inline-flex align-items-center">
                                    <a href="{{ route('admin.scores.edit', $score->id) }}" class="btn btn-warning btn-sm mr-1 btn-custom">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button type="button" class="btn btn-danger btn-sm btn-custom" onclick="confirmDelete('{{ $score->id }}')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                    <form id="delete-form-{{ $score->id }}" action="{{ route('admin.scores.destroy', $score->id) }}" method="POST" style="display: none;">
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
