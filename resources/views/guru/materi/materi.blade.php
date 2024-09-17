<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Materi</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        /* Table Centering */
        .table {
            margin: 0 auto; /* Center the table horizontally */
            width: 80%; /* Optional: Adjust the width of the table */
        }

        /* Table header and cell text alignment */
        table th, table td {
            text-align: center; /* Align text in the center */
            vertical-align: middle; /* Align text vertically in the middle */
        }

        /* Style for table header */
        table th {
            background-color: #343a40;
            color: white;
            padding: 15px;
        }

        /* Style for table rows */
        table td {
            padding: 10px;
        }

        /* Table stripes */
        table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        /* Hover effect */
        table tr:hover {
            background-color: #e9ecef;
        }

        /* Button styling */
        .btn-primary {
            margin-bottom: 20px;
        }
        .alert {
            margin-top: 20px;
            padding: 15px;
            border-radius: 5px;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

    </style>
</head>
<body>
    @include('layouts.app')
    <h1 class="text-center">Materi Siswa</h1>
    <section class="content">
        <div class="container">
            <div class="card">
                <div class="card-body">
                    <!-- Menampilkan pesan flash -->
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    <a href="{{route('materi.create')}}" class="btn btn-primary">Tambah</a>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>Judul</th>
                                <th>Materi</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($materi as $index => $item)
                                <tr>
                                    <td>{{ $index + 1 }}</td> <!-- Menampilkan nomor urut -->
                                    <td>{{ $item->judul }}</td> <!-- Menampilkan judul materi -->
                                    <td>
                                        @if($item->tipe == 'gambar')
                                            <img src="{{ asset('storage/' . $item->gambar) }}" alt="Materi Gambar" width="100px">
                                        @else
                                            <a href="{{ $item->link_youtube }}" target="_blank"><i class="fab fa-youtube"></i> Link YouTube</a>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('materi.edit', $item->id) }}" class="btn btn-sm btn-info">Edit</a>
                                        <form action="{{ route('materi.destroy', $item->id) }}" method="POST" style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                        </form>
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
