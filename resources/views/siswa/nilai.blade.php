@extends('layouts.app')

@section('content')
<div class="container mt-4" style="text-align: center;"> <!-- Center content within container -->
    <div class="d-flex justify-content-center align-items-center mb-3">
        <h2>Nilai Siswa</h2>
        <a href="{{ route('scores.create') }}" class="btn btn-primary shadow-sm ml-3">
            <i class="fas fa-plus"></i> Tambah Nilai
        </a>
    </div>
    <div class="table-responsive shadow-sm rounded mx-auto" style="max-width: 1000px;"> <!-- Center table with max-width -->
        <table class="table table-striped table-bordered table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>Nama</th>
                    <th>NIS</th>
                    <th>UH</th>
                    <th>UTS</th>
                    <th>UAS</th>
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
    /* Center the container and table */
    .container {
        text-align: center;
    }

    .table-responsive {
        margin: 0 auto;
        max-width: 1000px; /* Adjust based on your design */
    }

    /* Table styling */
    .table {
        background-color: #ffffff;
        border-radius: 10px;
        border: 1px solid #dee2e6;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        margin: 0 auto; /* Center table */
    }

    .table thead {
        background-color: #343a40;
        color: #ffffff;
    }

    .table-hover tbody tr:hover {
        background-color: #f8f9fa;
    }

    /* Button styling */
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

    /* Button spacing */
    .btn-sm {
        padding: 0.3rem 0.6rem;
        font-size: 0.85rem;
        border-radius: 0.2rem;
    }

    .btn i {
        margin-right: 5px;
    }

    /* Cell padding and alignment */
    td, th {
        padding: 12px 15px;
    }

    td.text-center {
        vertical-align: middle;
        text-align: center;
    }

    /* Ensure inline-flex items align properly */
    .d-inline-flex {
        display: inline-flex;
    }
</style>
@endpush
