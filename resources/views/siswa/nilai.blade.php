@extends('layouts.app')

@section('content')

<div class="container mt-5">
    <div class="d-flex justify-content-center align-items-center mb-4">
        <h2 class="text-primary font-weight-bold">Nilai Siswa</h2>
    </div>
    <div class="table-responsive shadow-lg mx-auto" style="max-width: 1000px;">
        <table class="table table-striped table-bordered table-hover">
            <thead class="thead-gradient"> <!-- Changed class to apply gradient -->
                <tr>
                    <th>No</th>
                    <th>UH</th>
                    <th>UTS</th>
                    <th>UAS</th>
                </tr>
            </thead>
            <tbody>
                @foreach($scores as $index => $score)
                <tr>
                    <td>{{ $index + 1 }}</td>
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
    /* Container adjustments */
    .container {
        margin-top: 20px;
        max-width: 1200px; 
        text-align: center;
        font-family: 'Arial', sans-serif;
    }

    /* Table styling */
    .table {
        background-color: #ffffff;
        border-radius: 10px;
        border: 1px solid #dee2e6;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        margin: 0 auto;
        transition: transform 0.2s;
    }

    .table:hover {
        transform: scale(1.01);
    }

    .thead-gradient {
        background: linear-gradient(135deg, #007bff, #6610f2); /* Gradient from blue to purple */
        color: #ffffff;
        text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1); /* Soft shadow for text */
    }

    /* Table-hover effect */
    .table-hover tbody tr:hover {
        background-color: #f1f1f1;
    }

    /* Cell padding and alignment */
    td, th {
        padding: 15px;
        vertical-align: middle;
        font-size: 1rem;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .table {
            font-size: 0.9rem;
        }
    }

    /* Additional styles */
    h2 {
        font-size: 2rem;
        text-shadow: 1px 1px 2px rgba(0,0,0,0.1);
    }

    /* Button styling */
    .btn-primary, .btn-warning, .btn-danger {
        border-radius: 25px;
        padding: 0.5rem 1rem;
        font-size: 1rem;
        transition: background-color 0.3s ease, transform 0.2s;
    }

    .btn-primary {
        background-color: #28a745;
        border-color: #28a745;
    }

    .btn-primary:hover {
        background-color: #218838;
        transform: scale(1.05);
    }

    .btn-warning {
        background-color: #ffc107;
        border-color: #ffc107;
    }

    .btn-warning:hover {
        background-color: #e0a800;
        transform: scale(1.05);
    }

    .btn-danger {
        background-color: #dc3545;
        border-color: #dc3545;
    }

    .btn-danger:hover {
        background-color: #c82333;
        transform: scale(1.05);
    }
</style>
@endpush
