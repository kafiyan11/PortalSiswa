<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Nilai</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <style>
        body {
            background-color: #f8f9fa; /* Latar belakang yang cerah */
        }
        .card {
            border: none; /* Tanpa border */
            border-radius: 15px; /* Sudut melengkung */
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); /* Efek bayangan */
        }
        h2 {
            color: #343a40; /* Warna judul */
            margin-bottom: 20px; /* Jarak bawah judul */
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <div class="card p-4">
            <h2 class="text-center"><i class="fas fa-plus-circle"></i> Tambah Nilai</h2>
            <form action="{{ route('admin.scores.store') }}" method="POST">
                @csrf
                <input type="hidden" name="student_id">  <!-- Pastikan ada student_id -->  
                <div class="form-group">
                    <label for="nama">Nama</label>
                    <input type="text" name="nama" id="nama" class="form-control" placeholder="Masukkan Nama Siswa" required>
                </div>
                <div class="form-group">
                    <label for="nis">NIS</label>
                    <input type="number" name="nis" id="nis" class="form-control" placeholder="Masukkan NIS Siswa" required>
                </div>
                <div class="form-group">
                    <label for="daily_test_score">UH</label>
                    <input type="number" name="daily_test_score" id="daily_test_score" class="form-control" placeholder="Masukkan Nilai UH" required>
                </div>
                <div class="form-group">
                    <label for="midterm_test_score">UTS</label>
                    <input type="number" name="midterm_test_score" id="midterm_test_score" class="form-control" placeholder="Masukkan Nilai UTS" required>
                </div>
                <div class="form-group">
                    <label for="final_test_score">UAS</label>
                    <input type="number" name="final_test_score" id="final_test_score" class="form-control" placeholder="Masukkan Nilai UAS" required>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Simpan <i class="fas fa-save"></i></button>
                <a href="{{ route('admin.scores.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </form>
        </div>
    @include('layouts.app')
    <div class="container">
        <h2 class="my-4">Tambah Nilai</h2>
        <form action="{{ route('admin.scores.store') }}" method="POST">
            @csrf
            <input type="hidden" name="student_id" >  <!-- Pastikan ada student_id -->  
            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" name="nama" id="nama" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="nis">NIS</label>
                <label for="daily_tesnist_score">NIS</label>
                <input type="number" name="nis" id="nis" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="daily_test_score">UH</label>
                <input type="number" name="daily_test_score" id="daily_test_score" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="midterm_test_score">UTS</label>
                <input type="number" name="midterm_test_score" id="midterm_test_score" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="final_test_score">UAS</label>
                <input type="number" name="final_test_score" id="final_test_score" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
        
        
    </div>
</body>
</html>
