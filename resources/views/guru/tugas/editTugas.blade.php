<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Tugas</title>
    <link href="{{asset('assets/img/favicon.png')}}" rel="icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .mx-auto { width: 800px; }
        .card { margin-top: 10px; }
    </style>
</head>

<body>
    <div class="mx-auto">
        <div class="card">
            <div class="card-header">
                Edit Tugas
            </div>
            <div class="card-body">
                <form action="{{ route('update_tugas', $siswa->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-3 row">
                        <label for="nis" class="col-sm-2 col-form-label">NIS</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nis" name="nis" required value="{{ old('nis', $siswa->nis) }}">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nama" name="nama" required value="{{ old('nama', $siswa->nama) }}">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="kelas" class="col-sm-2 col-form-label">Kelas</label>
                        <div class="col-sm-10">
                            <select class="form-select" id="kelas" name="kelas" required>
                                <option value="">- Pilih Kelas -</option>
                                <option value="10" {{ old('kelas', $siswa->kelas) == '10' ? 'selected' : '' }}>10</option>
                                <option value="11" {{ old('kelas', $siswa->kelas) == '11' ? 'selected' : '' }}>11</option>
                                <option value="12" {{ old('kelas', $siswa->kelas) == '12' ? 'selected' : '' }}>12</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="jurusan" class="col-sm-2 col-form-label">Jurusan</label>
                        <div class="col-sm-10">
                            <select class="form-select" id="jurusan" name="jurusan" required>
                                <option value="">- Pilih Jurusan -</option>
                                <option value="TKR" {{ old('jurusan', $siswa->jurusan) == 'TKR' ? 'selected' : '' }}>TKR</option>
                                <option value="TKJ" {{ old('jurusan', $siswa->jurusan) == 'TKJ' ? 'selected' : '' }}>TKJ</option>
                                <option value="RPL" {{ old('jurusan', $siswa->jurusan) == 'RPL' ? 'selected' : '' }}>RPL</option>
                                <option value="OTKP" {{ old('jurusan', $siswa->jurusan) == 'OTKP' ? 'selected' : '' }}>OTKP</option>
                                <option value="AK" {{ old('jurusan', $siswa->jurusan) == 'AK' ? 'selected' : '' }}>AK</option>
                                <option value="SK" {{ old('jurusan', $siswa->jurusan) == 'SK' ? 'selected' : '' }}>SK</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="gambar_tugas" class="col-sm-2 col-form-label">Gambar</label>
                        <div class="col-sm-10">
                            @if ($siswa->gambar_tugas)
                                <img src="{{ asset('gambar_tugas/' . $siswa->gambar_tugas) }}" alt="Gambar Tugas" style="width: 100px;">
                            @endif
                            <input type="file" class="form-control" id="gambar_tugas" name="gambar_tugas">
                        </div>
                    </div>
                    <div class="col-12">
                        <input type="submit" value="Simpan Data" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>