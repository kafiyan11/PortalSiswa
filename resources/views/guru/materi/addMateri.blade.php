<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Materi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .mx-auto { 
            width: 1350px;
            margin-top: 120px;
        }
        .card {
            margin-top: 10px;
            margin-left: 200px;
            box-shadow: 5px 5px 10px rgb(0, 0, 0.3);
            height: 450px;
        }
    </style>
</head>
<body>
    @include("layouts.app")
    <div class="container">
        <h2 class="text-center">Tambah Materi</h2>
    
        <form action="" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="kelas">Kelas:</label>
                <input type="text" name="kelas" class="form-control" required>
            </div>
    
            <div class="form-group">
                <label for="jurusan">Jurusan:</label>
                <input type="text" name="jurusan" class="form-control" required>
            </div>
    
            <div class="form-group">
                <label for="mapel">Mata Pelajaran:</label>
                <input type="text" name="mapel" class="form-control" required>
            </div>
    
            <div class="form-group">
                <label for="gambar_materi">Unggah Gambar Materi:</label>
                <input type="file" name="gambar_materi" class="form-control">
            </div>
    
            <div class="form-group">
                <label for="video_materi">Unggah Video Materi:</label>
                <input type="file" name="video_materi" class="form-control">
            </div>
    
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
    
</body>
</html>