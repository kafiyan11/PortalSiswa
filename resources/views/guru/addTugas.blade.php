<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Tugas</title>
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
    <div class="mx-auto">
        <div class="card">
            <div class="card-header">
                Tambah tugas
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
                <form action="{{route('guru.addTugas')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('post')
                    <div class="mb-3 row">
                        <label for="nis" class="col-sm-2 col-form-label">NIS</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nis" name="nis" required>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nama" name="nama" required>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="kelas" class="col-sm-2 col-form-label">Kelas</label>
                        <div class="col-sm-10">
                            <select class="form-select" id="kelas" name="kelas" required>
                                <option value="">- Pilih Kelas -</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="jurusan" class="col-sm-2 col-form-label">Jurusan</label>
                        <div class="col-sm-10">
                            <select class="form-select" id="jurusan" name="jurusan" required>
                                <option value="">- Pilih Jurusan -</option>
                                <option value="TKR">TKR 1</option>
                                <option value="TKR">TKR 2</option>
                                <option value="TKR">TKR 3</option>
                                <option value="TKJ">TKJ 1</option>
                                <option value="TKJ">TKJ 2</option>
                                <option value="TKJ">TKJ 3</option>
                                <option value="RPL">RPL 1</option>
                                <option value="RPL">RPL 2</option>
                                <option value="RPL">RPL 3</option>
                                <option value="RPL">DPIB 1</option>
                                <option value="RPL">DPIB 2</option>
                                <option value="OTKP">OTKP 1</option>
                                <option value="OTKP">OTKP 2</option>
                                <option value="AK">AK 1</option>
                                <option value="AK">AK 2</option>
                                <option value="SK">SK 1</option>
                                <option value="SK">SK 2</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="gambar_tugas" class="col-sm-2 col-form-label">Gambar</label>
                        <div class="col-sm-10">
                            <input type="file" class="form-control" id="gambar_tugas" name="gambar_tugas" required>
                        </div>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">Simpan Data</button>
                    </div>
                </form>
                
            </div>
        </div>
    </div>
</body>
</html>