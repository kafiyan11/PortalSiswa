<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Materi</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        .table {
            margin: 0 auto;
            width: 80%;
        }

        table th, table td {
            text-align: center;
            vertical-align: middle;
        }

        table th {
            background-color: #343a40;
            color: white;
            padding: 15px;
        }

        table td {
            padding: 10px;
        }

        table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        table tr:hover {
            background-color: #e9ecef;
        }

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

        .d-flex .input-group {
            max-width: 920px; /* Adjust as needed */
        }
        .search-input {
        border-radius: 25px 0 0 25px;
        border: 2px solid #007bff;
        transition: border-color 0.3s ease-in-out;
        }

        /* Change border color on focus */
        .search-input:focus {
            outline: none;
            border-color: #0056b3;
        }


        .search-btn {
            border-radius: 0 25px 25px 0;
            padding: 8px 20px;
            background-color: #007bff;
            border-color: #007bff;
            transition: background-color 0.3s ease-in-out, transform 0.2s;
        }

        .search-btn:hover {
            background-color: #0056b3;
            border-color: #0056b3;
            transform: scale(1.05);
        }


        .add-btn {
            padding: 8px 20px;
            background-color: #28a745;
            border-color: #28a745;
            transition: background-color 0.3s ease-in-out, transform 0.2s;
        }

        /* Hover effect for add button */
        .add-btn:hover {
            background-color: #218838;
            border-color: #218838;
            transform: scale(1.05);
        }

        /* Icon inside buttons */
        .search-btn i,
        .add-btn i {
            margin-right: 5px;
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

                <!-- Form Pencarian dan Tombol Tambah dalam satu baris -->
                <div class="d-flex justify-content-between mb-2">
                    <form action="{{ route('materi.cari') }}" method="GET" class="input-group" style="max-width: 400px;">
                        <input type="text" name="cari" class="form-control search-input" placeholder="Cari materi..." value="{{ request()->get('search') }}">
                            <div class="input-group-append">
                                <button class="btn btn-primary search-btn" type="submit">
                                    <i class="fas fa-search"></i> Cari
                                </button>
                            </div>
                        </form>
                        <a href="{{ route('materi.create') }}" class="btn btn-primary add-btn">
                    <i class="fas fa-plus-circle"></i> Tambah Materi</a>
                </div>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>Judul</th>
                                <th>Kelas</th>
                                <th>Jurusan</th>
                                <th>Materi</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($materi as $index => $item)
                                <tr>
                                    <td>{{ $index + 1 }}</td> <!-- Menampilkan nomor urut -->
                                    <td>{{ $item->judul }}</td> <!-- Menampilkan judul materi -->
                                    <td>{{ $item->kelas }}</td>
                                    <td>{{ $item->jurusan }}</td>
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
                    <!-- Link pagination -->
                    <div class="d-flex justify-content-end">
                        {{ $materi->links() }}
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
</html>
