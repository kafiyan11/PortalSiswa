@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="text-center w-100">Nilai Siswa</h2> <!-- Posisi judul di tengah -->
        <a href="{{ route('scores.create') }}" class="btn btn-primary shadow-sm" style="position: absolute; right: 20px;">
            <i class="fas fa-plus"></i> Tambah Nilai
        </a>
    </div>
    <div class="table-responsive shadow-sm rounded"> <!-- Tambahkan shadow -->
        <table class="table table-striped table-bordered table-hover text-center"> <!-- Text center untuk tabel -->
            <thead class="thead-dark">
                <tr>
                    <th>Nama</th>
                    <th>NIS</th>
                    <th>UH</th>
                    <th>UTS</th>
                    <th>UAS</th>
                    <th style="width: 150px;" class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($scores as $score)
                <tr>
                    <td>{{ $score->nama }}</td>
                    <td>{{ $score->nis }}</td>
                    <td>{{ $score->daily_test_score }}</td>
                    <td>{{ $score->midterm_test_score }}</td>
                    <td>{{ $score->final_test_score }}</td>

                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

@push('styles')
<style>
    /* Menyesuaikan container */
    .container {
        margin-top: 20px;
        max-width: 1200px; /* Lebih sempit untuk tampilan terpusat */
    }
    /* Table styling */
    .table {
        background-color: #ffffff;
        border-radius: 10px;
        border: 1px solid #dee2e6;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15); /* Bayangan lebih halus */
    }
    .table thead {
        background-color: #343a40;
        color: #ffffff;
    }
    .table-hover tbody tr:hover {
        background-color: #f1f3f5;
    }
    /* Tombol styling */
    .btn-primary, .btn-warning, .btn-danger {
        border-radius: 20px;
        padding: 0.375rem 0.75rem;
        font-size: 0.9rem;
    }
    .btn-primary {
        background-color: #4CAF50; /* Hijau yang lebih modern */
        border-color: #4CAF50;
    }
    .btn-primary:hover {
        background-color: #45a049;
    }
    .btn-warning {
        background-color: #FFC107;
        border-color: #FFC107;
    }
    .btn-warning:hover {
        background-color: #E0A800;
    }
    .btn-danger {
        background-color: #f44336;
        border-color: #f44336;
    }
    .btn-danger:hover {
        background-color: #c82333;
    }
    /* Penataan tombol kecil */
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
        vertical-align: middle; /* Pusatkan secara vertikal */
    }
    /* Tombol edit dan hapus lebih rapat */
    .d-inline-flex form {
        margin-left: 5px;
    }
</style>
@endpush
