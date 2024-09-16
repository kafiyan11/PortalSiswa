@extends('layouts.app')

@section('content')
<div class="container mt-4" style="max-width: 1000px;"> <!-- Set max-width to match the table width -->
    <div class="d-flex justify-content-between align-items-center mb-3"> <!-- Use justify-content-between to spread content -->
        <h2>Nilai Siswa</h2>
        <a href="{{ route('scores.create') }}" class="btn btn-primary shadow-sm"> <!-- Button aligned to the right -->
            <i class="fas fa-plus"></i> Tambah Nilai
        </a>
    </div>
    <div class="table-responsive shadow-sm rounded"> <!-- Removed margin to auto-center -->
        <table class="table table-striped table-bordered table-hover">
            <thead class="thead-dark">
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
                            <a href="{{ route('scores.edit', $score->id) }}" class="btn btn-warning btn-sm mr-1 shadow-sm">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <form action="{{ route('scores.destroy', $score->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm shadow-sm">
                                    <i class="fas fa-trash"></i> Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

@push('styles')
<style>
    .container {
        max-width: 1000px; /* Ensure the container matches the table's width */
        margin: 0 auto; /* Center the container */
    }

    .table-responsive {
        max-width: 100%; /* Ensure table is responsive within the container */
    }

    .table {
        background-color: #ffffff;
        border-radius: 10px;
        border: 1px solid #dee2e6;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .table thead {
        background-color: #343a40;
        color: #ffffff;
    }

    .table-hover tbody tr:hover {
        background-color: #f8f9fa;
    }

    .btn-primary, .btn-warning, .btn-danger {
        border-radius: 20px;
        padding: 0.375rem 0.75rem;
        font-size: 0.9rem;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }

    .btn-warning:hover {
        background-color: #e0a800;
    }

    .btn-danger:hover {
        background-color: #c82333;
    }

    .btn-sm {
        padding: 0.3rem 0.6rem;
        font-size: 0.85rem;
        border-radius: 0.2rem;
    }

    .btn i {
        margin-right: 5px;
    }

    td, th {
        padding: 12px 15px;
    }

    td.text-center {
        vertical-align: middle;
        text-align: center;
    }

    .d-inline-flex {
        display: inline-flex;
    }
</style>
@endpush
