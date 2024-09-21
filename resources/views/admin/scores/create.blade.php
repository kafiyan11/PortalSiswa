<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Nilai</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h2 class="my-4">Tambah Nilai</h2>
        <form action="{{ route('scores.store') }}" method="POST">
            @csrf
            <input type="hidden" name="student_id" value="{{ $student_id }}">  <!-- Pastikan ada student_id -->  
            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" name="nama" id="nama" class="form-control" required>
            </div>
            <div class="form-group">
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
