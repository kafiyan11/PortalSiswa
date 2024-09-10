<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Materi</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: #010504;
            color: #333;
            padding: 20px;
            margin: 0;
        }

        h1 {
            text-align: center;
            margin-bottom: 30px;
            color: #2c3e50;
        }

        .card {
            border-radius: 16px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 1200px;
            margin: auto;
        }

        .card-body {
            padding: 20px;
        }

        .table {
            background-color: #fff;
            border-radius: 8px;
            overflow: hidden;
            border: 2px solid black; /* Garis luar tabel */
        }

        .table th, .table td {
            text-align: center;
            vertical-align: middle;
            border: 2px solid black; /* Garis antar sel tabel */
        }

        .table thead {
            color: #070000;
            background-color: #f8f9fa; /* Menambah background untuk header */
        }

        .table tbody tr:nth-child(even) {
            background-color: #250202;
        }

        .table tbody tr:hover {
            background-color: #0e0000;
        }

        .table td img {
            max-width: 100px;
            height: auto;
            border-radius: 5px;
        }

        .btn-primary {
            background-color: #2980b9;
            border-color: #2980b9;
        }

        .btn-primary:hover {
            background-color: #1c4f78;
            border-color: #1c4f78;
        }

        .pagination .page-item.active .page-link {
            background-color: #2980b9;
            border-color: #00060a;
        }

        .pagination .page-link {
            border-radius: 5px;
        }
        
    </style>
</head>
<body>
    @include('layouts.app')
    <h1>Materi Siswa</h1>
    <section class="content">
        <div class="container-fluid">
            <div class="card animate__animated animate__fadeInUp">
                <div class="card-body">
                    <a href="{{ route('guru.materi.addMateri') }}" class="btn btn-primary">Tambah Tugas</a>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>Kelas</th>
                                <th>Jurusan</th>
                                <th>Mapel</th>
                                <th>Materi</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($materi as $no => $materis)
                            @if (is_object($materis))
                            <tr>
                                <td>{{ $no + 1 }}</td>
                                <td>{{ $materis->kelas }}</td>
                                <td>{{ $materis->jurusan }}</td>
                                <td>{{ $materis->mapel }}</td>
                                <td>{{ $materis->materi }}</td>
                                <td>
                                    @if ($materis->gambar_materi)
                                        <img src="{{ asset('gambar_materi/' . $materis->gambar_materi) }}" alt="Gambar Materi" width="100">
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('materi.edit', $materis->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('materi.hapus', $materis->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                    </form>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</body>
</html>
