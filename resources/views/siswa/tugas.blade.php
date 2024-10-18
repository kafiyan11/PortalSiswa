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
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            padding-top: 50px;
        }
        .container {
            max-width: 900px;
            margin: auto;
        }
        h1 {
            text-align: center;
            margin-bottom: 30px;
            color: #007bff;
        }
        .card {
            border: 1px solid #dee2e6;
        }
        .card-body {
            padding: 20px;
        }
        .table th, .table td {
            text-align: center;
            vertical-align: middle;
        }
        .table img {
            width: 100px;
            height: auto;
            border-radius: 5px;
        }
        .text-center {
            text-align: center;
        }
    </style>
</head>
<body>
    @extends('layouts.app') 
    
    @section('content') <!-- Define a section for your content -->
    <div class="container">
        <h1>Tugas </h1>
        <div class="card">
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>NIS</th>
                            <th>Nama</th>
                            <th>Kelas</th>
                            <th>Gambar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($tugas as $no => $tugasItem)
                        <tr>
                            <td>{{ $no + 1 }}</td>
                            <td>{{ $tugasItem->nis }}</td>
                            <td>{{ $tugasItem->nama }}</td>
                            <td>{{ $tugasItem->kelas }}</td>
                            <td>
                                @if ($tugasItem->gambar_tugas)
                                    <a href="{{ asset('gambar_tugas/' . $tugasItem->gambar_tugas) }}" target="_blank">
                                        <img src="{{ asset('gambar_tugas/' . $tugasItem->gambar_tugas) }}" alt="Gambar Tugas" width="100">
                                    </a> <!-- Ensure the link is closed properly -->
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center">Tidak ada tugas tersedia</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @endsection <!-- End of section -->
</body>
</html>
