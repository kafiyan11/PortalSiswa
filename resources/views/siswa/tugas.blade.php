<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Tugas Siswa</title>
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
    @include('layouts.app')
    <div class="container">
        <h1>Data Tugas Siswa</h1>
        <div class="card">
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>NIS</th>
                            <th>Nama</th>
                            <th>Kelas</th>
                            <th>Jurusan</th>
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
                            <td>{{ $tugasItem->jurusan }}</td>
                            <td>
                                @if ($tugasItem->gambar_tugas)
                                    <img src="{{ asset('gambar_tugas/' . $tugasItem->gambar_tugas) }}" alt="Gambar Tugas" width="100">
                                @else
                                    Tidak ada gambar
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center">Tidak ada tugas tersedia</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
