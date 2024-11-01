<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="assets/img/favicon.png" rel="icon">
    <title>Tugas | Portal Siswa</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Custom CSS */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #e9ecef; /* Softer light gray for a pleasant background */
            padding-top: 50px;
        }
        .container {
            max-width: 900px;
            margin: auto;
        }
        h1 {
            text-align: center;
            margin-bottom: 30px;
            color: #3f51b5; /* Indigo color for the heading */
            font-weight: bold;
            text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.2);
        }
        .card {
            border: none;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            border-radius: 12px;
            background: linear-gradient(to bottom right, #ffffff, #f7f7f9); /* Gradient background */
        }
        .card-body {
            padding: 20px;
        }
        .table th {
            background-color: #673ab7; /* Deep purple for the table header */
            color: white; /* White text for better contrast */
            text-align: center;
            font-weight: bold;
        }
        .table td {
            vertical-align: middle;
            transition: background-color 0.3s ease;
        }
        .table tr:hover td {
            background-color: #f0f0f0; /* Light hover effect for rows */
        }
        .table img {
            width: 100px;
            height: auto;
            border-radius: 8px; /* Slightly larger radius for images */
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2); /* Shadow for images */
        }
        .text-center {
            text-align: center;
        }
        .btn-back {
            margin-top: 20px; /* Space above the button */
            background-color: #007bff; /* Bright blue for the button */
            color: white; /* White text for the button */
            border: none;
            transition: background-color 0.3s ease;
            border-radius: 6px; /* Rounded button */
            padding: 10px 20px; /* Larger button size */
        }
        .btn-back:hover {
            background-color: #0056b3; /* Darker blue on hover */
        }
        .alert {
            margin-bottom: 20px; /* Space below alerts */
        }
    </style>
</head>
<body>
    @extends('layouts.app') 
    
    @section('content') <!-- Define a section for your content -->
    <div class="container">
        <h1>Tugas</h1>

        <div class="card">
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Oops!</strong> Ada beberapa masalah dengan input Anda:
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>Mata Pelajaran</th>
                            <th>Tugas</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($tugas as $no => $tugasItem)
                        <tr>
                            <td>{{ $no + 1 }}</td>
                            <td>{{ optional($tugasItem->mapel)->nama_mapel ?? 'N/A' }}</td>
                            <td>
                                @if ($tugasItem->gambar_tugas)
                                    <a href="{{ asset('gambar_tugas/' . $tugasItem->gambar_tugas) }}" target="_blank">
                                        <img src="{{ asset('gambar_tugas/' . $tugasItem->gambar_tugas) }}" alt="Gambar Tugas">
                                    </a>
                                @else
                                    <span>Tidak ada gambar</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="text-center">Tidak ada tugas tersedia</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>

                <!-- Kembali Button -->
                <div class="d-flex justify-content-end">
                    <a href="{{ url()->previous() }}" class="btn btn-back d-flex align-items-center">
                        <i class="fas fa-arrow-left me-2"></i> <!-- Font Awesome icon for the button -->
                        Kembali
                    </a>
                </div>
                
            </div>
        </div>
    </div>
    @endsection <!-- End of section -->
</body>
</html>
