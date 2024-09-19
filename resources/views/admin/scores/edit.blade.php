<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Nilai</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1 class="my-4">Edit Nilai</h1>
        <form action="{{ route('scores.update', $score->id) }}" method="POST">
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
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('scores.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</body>
</html>
