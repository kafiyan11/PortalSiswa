<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Materi</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .form-group img {
            max-width: 100%;
            height: auto;
        }
        .form-group.hidden {
            display: none;
        }
        .radio-label {
            margin-right: 15px;
        }
    </style>
</head>
<body>
    <div class="container mt-4">
        <h1>Edit Materi</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('materi.update', $materi->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="judul">Judul Materi:</label>
                <input type="text" name="judul" class="form-control" value="{{ $materi->judul }}" required>
            </div>
            <div class="mb-3 row">
                <label for="kelas" class="col-sm-2 col-form-label">Kelas</label>
                <div class="mb-3 col-sm-15">
                    <select class="form-select" id="kelas" name="kelas" required>
                        <option value="">- Pilih Kelas -</option>
                        <option value="10" {{ old('kelas', $materi->kelas) == '10' ? 'selected' : '' }}>10</option>
                        <option value="11" {{ old('kelas', $materi->kelas) == '11' ? 'selected' : '' }}>11</option>
                        <option value="12" {{ old('kelas', $materi->kelas) == '12' ? 'selected' : '' }}>12</option>
                    </select>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="jurusan" class="col-sm-2 col-form-label">Jurusan</label>
                 <div class="col-sm-10">
                    <select class="form-select" id="jurusan" name="jurusan" required>
                        <option value="">- Pilih Jurusan -</option>
                        <option value="TKR" {{ old('jurusan', $materi->jurusan) == 'TKR' ? 'selected' : '' }}>TKR</option>
                        <option value="TKJ" {{ old('jurusan', $materi->jurusan) == 'TKJ' ? 'selected' : '' }}>TKJ</option>
                        <option value="RPL" {{ old('jurusan', $materi->jurusan) == 'RPL' ? 'selected' : '' }}>RPL</option>
                        <option value="OTKP" {{ old('jurusan', $materi->jurusan) == 'OTKP' ? 'selected' : '' }}>OTKP</option>
                        <option value="AK" {{ old('jurusan', $materi->jurusan) == 'AK' ? 'selected' : '' }}>AK</option>
                        <option value="AK" {{ old('jurusan', $materi->jurusan) == 'DPIB' ? 'selected' : '' }}>DIPB</option>
                        <option value="SK" {{ old('jurusan', $materi->jurusan) == 'SK' ? 'selected' : '' }}>SK</option>
                    </select>
                </div>                    
            </div>
            <div class="form-group">
                <label for="tipe">Pilih jenis materi:</label><br>
                <input type="radio" id="uploadGambar" name="tipe" value="gambar" {{ $materi->tipe == 'gambar' ? 'checked' : '' }}>
                <label for="uploadGambar" class="radio-label">Unggah Gambar</label>
                <input type="radio" id="uploadYoutube" name="tipe" value="youtube" {{ $materi->tipe == 'youtube' ? 'checked' : '' }}>
                <label for="uploadYoutube" class="radio-label">Link YouTube</label>
            </div>

            <div id="gambarUpload" class="form-group {{ $materi->tipe == 'gambar' ? '' : 'hidden' }}">
                <label for="file">Unggah Gambar:</label>
                <input type="file" name="gambar" class="form-control">
                @if ($materi->file)
                    <p>Gambar saat ini:</p>
                    <img src="{{ asset('storage/' . $materi->gambar) }}" alt="Materi">
                @endif
            </div>

            <div id="linkYoutube" class="form-group {{ $materi->tipe == 'youtube' ? '' : 'hidden' }}">
                <label for="link_youtube">Link YouTube:</label>
                <input type="url" name="link_youtube" class="form-control" value="{{ $materi->link_youtube }}">
            </div>

            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        </form>
    </div>

    <script>
        document.querySelectorAll('input[name="tipe"]').forEach(option => {
            option.addEventListener('change', function () {
                document.getElementById('gambarUpload').classList.toggle('hidden', this.value !== 'gambar');
                document.getElementById('linkYoutube').classList.toggle('hidden', this.value !== 'youtube');
            });
        });
    </script>
</body>
</html>
