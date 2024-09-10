@extends('layouts.app')

@section('content')
<div class="container mt-4" style="margin-left: -20px;"> <!-- Sedikit geser ke kiri -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="text-left">Nilai Siswa</h2> <!-- Ubah text-center jadi text-left -->
        <a href="{{ route('scores.create') }}" class="btn btn-primary shadow-sm">
            <i class="fas fa-plus"></i> Tambah Nilai
        </a>
    </div>
    <div class="table-responsive shadow-sm rounded"> <!-- Tambahkan shadow -->
        <table class="table table-striped table-bordered table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>UH</th>
                    <th>UTS</th>
                    <th>UAS</th>
                    <th style="width: 150px;" class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($scores as $score)
                <tr>
                    <td>{{ $score->daily_test_score }}</td>
                    <td>{{ $score->midterm_test_score }}</td>
                    <td>{{ $score->final_test_score }}</td>
                    <td class="text-center">
                        <div class="d-inline-flex align-items-center">
                            <!-- Tombol Edit -->
                            <a href="{{ route('scores.edit', $score->id) }}" class="btn btn-warning btn-sm mr-1 shadow-sm"style="small">
                                <i class="fas fa-edit"></i> Edit
                            </a>&nbsp;
                            <!-- Tombol Hapus -->
                            <form action="{{ route('scores.destroy', $score->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm shadow-sm"style="small">
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
    /* Memberikan jarak pada container dan bayangan */
    .container {
        margin-top: 20px;
    }
    /* Table styling */
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
    /* Tombol styling */
    .btn-primary, .btn-warning, .btn-danger {
        border-radius: 20px;
        padding: 0.375rem 0.75rem;
        font-size: 0.9rem;
    }
    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
    }
    .btn-primary:hover {
        background-color: #0056b3;
    }
    .btn-warning {
        background-color: #ffc107;
        border-color: #ffc107;
    }
    .btn-warning:hover {
        background-color: #e0a800;
    }
    .btn-danger {
        background-color: #dc3545;
        border-color: #dc3545;
    }
    .btn-danger:hover {
        background-color: #c82333;
    }
    /* Jarak antar tombol */
    .btn-sm {
        padding: 0.3rem 0.6rem;
        font-size: 0.85rem;
        border-radius: 0.2rem;
    }
    .btn i {
        margin-right: 5px;
    }
    /* Penyesuaian kolom */
    td, th {
        padding: 12px 15px;
    }
    td.text-center {
        vertical-align: middle;
    }
    /* Membuat tombol Edit dan Hapus berdampingan */
    .d-inline-flex {
        display: inline-flex;
    }
    .d-inline-flex form {
        margin-left: 5px;
    }
</style>
@endpush
