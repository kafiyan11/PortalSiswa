<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard Guru</title>
    <link href="assets/img/favicon.png" rel="icon">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        .container{
            margin-top: 140px;
        }
    </style>
</head>
<body>
    @extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-md-12">
            <div class="jumbotron text-center bg-primary text-white rounded">
                <h1 class="display-4">Dashboard Guru</h1>
                <p class="lead">Selamat datang, <strong>{{ Auth::user()->name }}</strong>!</p>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <!-- Card for total students -->
        <div class="col-md-4">
            <div class="card border-primary shadow-sm">
                <div class="card-body text-center">
                    <h5 class="card-title">Jumlah Siswa</h5>
                    <p class="card-text">
                        <i class="fas fa-users fa-3x"></i>
                        <br>
                        {{-- {{ $totalStudents }} --}}
                    </p>
                </div>
            </div>
        </div>

        <!-- Card for recent assignments -->
        <div class="col-md-4">
            <div class="card border-warning shadow-sm">
                <div class="card-body text-center">
                    <h5 class="card-title">Tugas Terbaru</h5>
                    <p class="card-text">
                        <i class="fas fa-tasks fa-3x"></i>
                        <br>
                        {{-- {{ $recentAssignments }} --}}
                    </p>
                </div>
            </div>
        </div>

        <!-- Card for upcoming events -->
        <div class="col-md-4">
            <div class="card border-success shadow-sm">
                <div class="card-body text-center">
                    <h5 class="card-title">Acara Mendatang</h5>
                    <p class="card-text">
                        <i class="fas fa-calendar-alt fa-3x"></i>
                        <br>
                        {{-- {{ $upcomingEvents }} --}}
                    </p>
                </div>
            </div>
        </div>
    </div>    
</div>
@endsection

@push('styles')
<style>
    .jumbotron {
        background-color: #007bff;
        color: white;
        padding: 2rem 1rem;
        border-radius: 0.3rem;
    }

    .card {
        border-radius: 0.3rem;
    }

    .card-title {
        font-size: 1.25rem;
        font-weight: bold;
    }

    .card-text {
        font-size: 1.5rem;
        color: #333;
    }

    .card-body {
        padding: 1.5rem;
    }

    .display-4 {
        font-size: 2.5rem;
        font-weight: 300;
    }

    .fas {
        margin-bottom: 10px;
    }
</style>
@endpush
