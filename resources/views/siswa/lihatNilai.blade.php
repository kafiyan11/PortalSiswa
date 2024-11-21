<head>
    <title>Nilai | Portal Siswa</title>
</head>@extends('layouts.app')

@section('content')

<div class="container mt-5">
    <div class="d-flex justify-content-center align-items-center mb-4">
        <h2 class="font-weight-bold">Nilai </h2>
    </div>
    <div class="table-responsive shadow-lg mx-auto" style="max-width: 1000px;">
        <table class="table table-striped table-bordered table-hover">
            <thead class="thead-gradient"> <!-- Changed class to apply gradient -->
                <tr>
                    <th>No</th>
                    <th>Pelajaran</th>
                    <th>UH</th>
                    <th>UTS</th>
                    <th>UAS</th>
                </tr>
            </thead>
            <tbody>
                @foreach($scores as $index => $score)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ optional($score->mapel)->nama_mapel ?? '' }}</td>
                    <td>{{ $score->daily_test_score }}</td>
                    <td>{{ $score->midterm_test_score }}</td>
                    <td>{{ $score->final_test_score }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-end">
            <a href="{{ url()->previous() }}" class="btn btn-back d-flex align-items-center">
                <i class="fas fa-arrow-left me-2"></i> <!-- Font Awesome icon for the button -->
                Kembali
            </a>
        </div>
    </div>
</div>

@endsection