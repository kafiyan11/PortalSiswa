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
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>Judul</th>
                                <th>Materi</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            @foreach($materi as $index => $item)
                                <tr>
                                    <td>{{ $index + 1 }}</td> <!-- Menampilkan nomor urut -->
                                    <td>{{ $item->judul }}</td> <!-- Menampilkan judul materi -->
                                    <td>
                                        @if($item->tipe == 'gambar')
                                        <a href="{{ asset('storage/' . $item->gambar) }}" target="_blank">
                                            <img src="{{ asset('storage/' . $item->gambar) }}" alt="Materi Gambar" width="100px">
                                        @else
                                            <a href="{{ $item->link_youtube }}" target="_blank"><i class="fab fa-youtube"></i> Link YouTube</a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                        <tr>
                            <td colspan="6" class="text-align-center">Tidak ada materi</td>
                        </tr>
                    
                </div>
            </div>
        </div>
    </section>
</body>
</html>
