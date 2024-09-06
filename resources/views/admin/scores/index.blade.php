<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Nilai</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Tambahkan CSS sesuai dengan yang sudah kamu buat sebelumnya */
    </style>
</head>
<body>
    @include('layouts.app')
    
    <div class="container">
        <div class="header">
            <button class="navbar-toggler" type="button">
                <span class="navbar-toggler-icon"></span>
            </button>
            <h2 class="text-center">Nilai</h2>
            <a href="{{ route('scores.create') }}" class="btn btn-primary">Tambah Nilai</a>
        </div>
        <div class="table-container">
            <table class="table">
                <thead>
                    <tr>
                        <th>UH</th>
                        <th>UTS</th>
                        <th>UAS</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($scores as $score)
                    <tr>
                        <td>{{ $score->daily_test_score }}</td>
                        <td>{{ $score->midterm_test_score }}</td>
                        <td>{{ $score->final_test_score }}</td>
                        <td>
                            <a href="{{ route('scores.edit', $score->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('scores.destroy', $score->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
