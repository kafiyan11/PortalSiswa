<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Materi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .mx-auto { 
            max-width: 800px; /* Mengurangi lebar agar lebih rapi */
            margin-top: 50px; /* Mengurangi margin top */
        }
        .card {
            margin-top: 20px;
            padding: 20px; /* Memberikan padding di dalam card */
            box-shadow: 3px 3px 8px rgba(0, 0, 0, 0.1); /* Menghaluskan shadow */
        }
        .form-group {
            margin-bottom: 15px; /* Memberikan jarak antar form */
        }
        .btn {
            margin-top: 10px;
        }
        h2 {
            margin-bottom: 20px; /* Memberikan jarak bawah pada judul */
        }
    </style>
</head>
<body>
    @include("layouts.app")

    <div class="container mx-auto">
        <div class="card">
            <h2>Unggah Materi</h2>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('materi.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="judul">Judul Materi:</label>
                    <input type="text" name="judul" class="form-control" required>
                </div>
                <div class="mb-3 row">
                    <label for="kelas" class=" col-form-label">Kelas</label>
                <div class="mb-3 col-sm-15 ">
                    <select class="form-select" id="kelas" name="kelas" required>
                        <option value="">- Pilih Kelas -</option>
                        <option value="10">10</option>
                        <option value="11">11</option>
                        <option value="12">12</option>
                    </select>
                </div>
                <div class="mb-3 row">
                    <label for="jurusan" class="col-sm-2 col-form-label">Jurusan</label>
                <div class="mb-3 col-sm-15">
                    <select class="form-select" id="jurusan" name="jurusan" required>
                        <option value="">- Pilih Jurusan -</option>
                        <option value="TKR"  >TKR </option>
                        <option value="TKJ"  >TKJ</option>
                        <option value="RPL"  >RPL</option>
                        <option value="OTKP" >OTKP</option>
                        <option value="AK"   >AK</option>
                        <option value="DPIB" >DPIB</option>
                        <option value="SK"   >SK</option>
                    </select>
            </div>
            </div>

                <div class="form-group">
                    <label for="uploadOption">Pilih jenis materi:</label><br>
                    <input type="radio" id="uploadGambar" name="tipe" value="gambar" checked>
                    <label for="uploadGambar">Unggah Gambar</label><br>
                    <input type="radio" id="uploadYoutube" name="tipe" value="youtube">
                    <label for="uploadYoutube">Link YouTube</label>
                </div>

                <div class="form-group" id="gambarUpload">
                    <label for="gambar">Unggah Gambar:</label>
                    <input type="file" name="gambar" class="form-control">
                </div>

                <div class="form-group" id="linkYoutube" style="display: none;">
                    <label for="link_youtube">Link YouTube:</label>
                    <input type="url" name="link_youtube" class="form-control">
                </div>

                <button type="submit" class="btn btn-primary">Unggah Materi</button>
            </form>
        </div>
    </div>

    <script>
        // Script untuk menampilkan/menghilangkan form input sesuai pilihan
        document.addEventListener("DOMContentLoaded", function () {
            const uploadOptions = document.querySelectorAll('input[name="tipe"]');
            const gambarUpload = document.getElementById('gambarUpload');
            const linkYoutube = document.getElementById('linkYoutube');

            uploadOptions.forEach(option => {
                option.addEventListener('change', function () {
                    if (this.value === 'gambar') {
                        gambarUpload.style.display = 'block';
                        linkYoutube.style.display = 'none';
                    } else if (this.value === 'youtube') {
                        gambarUpload.style.display = 'none';
                        linkYoutube.style.display = 'block';
                    }
                });
            });

            // Jalankan saat halaman pertama kali dimuat
            const selectedOption = document.querySelector('input[name="tipe"]:checked').value;
            if (selectedOption === 'gambar') {
                gambarUpload.style.display = 'block';
                linkYoutube.style.display = 'none';
            } else if (selectedOption === 'youtube') {
                gambarUpload.style.display = 'none';
                linkYoutube.style.display = 'block';
            }
        });
    </script>
    
</body>
</html>
