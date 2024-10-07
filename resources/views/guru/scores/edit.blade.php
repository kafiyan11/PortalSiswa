<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Nilai</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet" />
    <style>
        body {
            background: linear-gradient(to bottom right, #e2e2e2, #ffffff); /* Gradien latar belakang */
            font-family: 'Arial', sans-serif; /* Font yang lebih modern */
        }
        .container {
            max-width: 1000px; /* Lebar maksimal kontainer */
            margin-top: 50px; /* Jarak atas */
        }
        .card {
            border-radius: 10px; /* Sudut melengkung */
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2); /* Bayangan lebih kuat */
            padding: 30px; /* Ruang dalam card */
        }
        h1 {
            color: #343a40; /* Warna judul */
            margin-bottom: 30px; /* Jarak bawah judul */
            font-size: 2.5rem; /* Ukuran font judul lebih besar */
        }
        .form-group {
            font-size: 1.1rem; /* Ukuran font label lebih besar */
        }
        .form-control {
            border-radius: 5px; /* Sudut melengkung untuk input */
            font-size: 1.1rem; /* Ukuran font input lebih besar */
        }
        .btn {
            border-radius: 5px; /* Sudut melengkung untuk tombol */
            font-size: 1.1rem; /* Ukuran font tombol lebih besar */
        }
        .btn-primary {
            background-color: #007bff; /* Warna tombol utama */
            border: none; /* Tanpa border */
        }
        .btn-primary:hover {
            background-color: #0056b3; /* Warna tombol saat hover */
        }
        .btn-secondary {
            background-color: #6c757d; /* Warna tombol sekunder */
            border: none; /* Tanpa border */
        }
        .btn-secondary:hover {
            background-color: #5a6268; /* Warna tombol sekunder saat hover */
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="card">
            <h1 class="text-center">Edit Nilai</h1>
            <form action="{{ route('guru.scores.update', $score->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="nama">Nama</label>
                    <input type="text" name="nama" id="nama" class="form-control" value="{{ $score->nama }}" required>
                </div>
                <div class="form-group">
                    <label for="nis">NIS</label>
                    <input type="number" name="nis" id="nis" class="form-control" value="{{ $score->nis }}" required>
                </div>
                <div class="form-group">
                    <label for="daily_test_score">Nilai UH</label>
                    <input type="number" name="daily_test_score" id="daily_test_score" class="form-control" value="{{ $score->daily_test_score }}" required>
                </div>
                <div class="form-group">
                    <label for="midterm_test_score">Nilai UTS</label>
                    <input type="number" name="midterm_test_score" id="midterm_test_score" class="form-control" value="{{ $score->midterm_test_score }}" required>
                </div>
                <div class="form-group">
                    <label for="final_test_score">Nilai UAS</label>
                    <input type="number" name="final_test_score" id="final_test_score" class="form-control" value="{{ $score->final_test_score }}" required>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Update
                    </button>
                    <a href="{{ route('guru.scores.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
