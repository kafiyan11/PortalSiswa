<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Tugas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f0f2f5;
            font-family: 'Poppins', sans-serif;
        }
        .container {
            max-width: 700px;
            margin-top: 60px;
            background-color: #ffffff;
            border-radius: 15px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
            padding: 20px 30px;
        }
        .card-header {
            background-color: #007bff;
            color: #fff;
            font-size: 20px;
            font-weight: bold;
            text-align: center;
            border-top-left-radius: 15px;
            border-top-right-radius: 15px;
            padding: 20px;
        }
        .form-control, .form-select {
            border-radius: 25px;
            transition: all 0.3s ease-in-out;
        }
        .form-control:focus, .form-select:focus {
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
            border-color: #007bff;
        }
        .btn-primary {
            background-color: #28a745;
            border-color: #28a745;
            border-radius: 30px;
            padding: 10px 25px;
            font-size: 16px;
            transition: all 0.3s ease-in-out;
            width: 100%;
        }
        .btn-primary:hover {
            background-color: #218838;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 123, 255, 0.3);
        }
        label {
            font-weight: 600;
        }
        .mb-3 {
            margin-bottom: 20px;
        }
        .card-body {
            padding: 30px;
        }
        /* Responsiveness */
        @media (max-width: 768px) {
            .container {
                width: 100%;
                padding: 15px;
            }
        }
    </style>
    <script>
        function showJurusanOptions() {
            const category = document.getElementById("kategori").value;
            const jurusanDropdown = document.getElementById("jurusan");

            jurusanDropdown.innerHTML = "";

            if (category === "Teknik") {
                jurusanDropdown.innerHTML += '<option value="TKR">TKR</option>';
                jurusanDropdown.innerHTML += '<option value="TKJ">TKJ</option>';
                jurusanDropdown.innerHTML += '<option value="RPL">RPL</option>';
                jurusanDropdown.innerHTML += '<option value="DPIB">DPIB</option>';
            } else if (category === "Non-Teknik") {
                jurusanDropdown.innerHTML += '<option value="OTKP">OTKP</option>';
                jurusanDropdown.innerHTML += '<option value="AK">Akuntansi</option>';
                jurusanDropdown.innerHTML += '<option value="SK">SK</option>';
            }
        }
    </script>
</head>
<body>
    @include("layouts.app")
    <div class="container">
        <div class="card">
            <div class="card-header">
                Tambah Tugas
            </div>
            <div class="card-body">
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <form action="{{route('admin.create')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('post')
                    <div class="mb-3">
                        <label for="nis" class="form-label">NIS</label>
                        <input type="text" class="form-control" id="nis" name="nis" required>
                    </div>
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama" required>
                    </div>
                    <div class="mb-3">
                        <label for="kelas" class="form-label">Kelas</label>
                        <select class="form-select" id="kelas" name="kelas" required>
                            <option value="">- Pilih Kelas -</option>
                            <option value="10">10</option>
                            <option value="11">11</option>
                            <option value="12">12</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="kategori" class="form-label">Kategori Jurusan</label>
                        <select class="form-select" id="kategori" name="kategori" onchange="showJurusanOptions()" required>
                            <option value="">- Pilih Kategori -</option>
                            <option value="Teknik">Teknik</option>
                            <option value="Non-Teknik">Non-Teknik</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="jurusan" class="form-label">Jurusan</label>
                        <select class="form-select" id="jurusan" name="jurusan" required>
                            <option value="">- Pilih Jurusan -</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="gambar_tugas" class="form-label">Gambar</label>
                        <input type="file" class="form-control" id="gambar_tugas" name="gambar_tugas" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan Data</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>