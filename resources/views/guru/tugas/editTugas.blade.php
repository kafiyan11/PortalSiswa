<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Tugas | Portal Siswa</title>
    <link href="{{ asset('assets/img/favicon.png') }}" rel="icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .container-custom {
            max-width: 800px;
            margin-top: 20px;
            margin-left: 320px; /* Mengatur margin agar tetap berada di tengah */
            margin-right: 320px;
        }

        .form-section {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .form-section h2 {
            margin-bottom: 20px;
            font-size: 24px;
            font-weight: bold;
            color: #007bff;
        }
    </style>
</head>

<body>
@include('layouts.app')

    <div class="mx-auto">
        <div class="card">
            <div class="card-header">
                Edit Tugas
            </div>
            <div class="card-body">
                <form action="{{ route('guru.tugas.update', $siswa->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-3 row">
                        <label for="nis" class="col-sm-2 col-form-label">NIS</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nis" name="nis" required value="{{ old('nis', $siswa->nis) }}">
                        </div>
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
                        <input type="text" class="form-control" id="kelas" name="kelas" required value="{{ old('kelas', $siswa->kelas) }}">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="gambar_tugas" class="col-sm-2 col-form-label">Gambar</label>
                    <div class="col-sm-10">
                        @if ($siswa->gambar_tugas)
                            <img src="{{ asset('gambar_tugas/' . $siswa->gambar_tugas) }}" alt="Gambar Tugas" class="mb-2" style="width: 100px;">
                        @endif
                        <input type="file" class="form-control" id="gambar_tugas" name="gambar_tugas">
                    </div>
                </div>
                <div class="text-end">
                    <input type="submit" value="Simpan Data" class="btn btn-primary">
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
