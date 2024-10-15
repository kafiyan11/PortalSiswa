<head>
    <title>Tambah Nilai | Portal Siswa</title>
</head>

@extends('layouts.app')

@section('content')

<body>
    <div class="container mt-5">
        <div class="card p-4">
            <h2 class="text-center"><i class="fas fa-plus-circle"></i> Tambah Nilai</h2>
            <form action="{{ route('guru.scores.store') }}" method="POST">
                @csrf
                <input type="hidden" name="student_id"> <!-- Ensure there's a student_id -->
                
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
                <a href="{{ route('guru.scores.index') }}" class="btn btn-secondary btn-block">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
@endsection