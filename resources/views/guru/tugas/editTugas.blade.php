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
            max-width: 600px;
            margin-top: 30px;
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

        .form-label {
            font-weight: 500;
        }
    </style>
</head>
<body>
    @extends('layouts.app') <!-- Correct usage of extends here -->

    @section('content')
    <div class="container container-custom">
        <div class="form-section">
            <h2 class="text-center">Edit Tugas</h2>
            <form action="{{ route('guru.tugas.update', $siswa->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="mb-3">
                    <label for="kelas" class="form-label">Kelas</label>
                    <input type="text" class="form-control" id="kelas" name="kelas" required value="{{ old('kelas', $siswa->kelas) }}">
                </div>

                <div class="mb-3">
                    <label for="id_mapel" class="form-label">Mapel</label>
                    <select name="id_mapel" id="id_mapel" class="form-control" required>
                        @foreach($mapel as $m)
                            <option value="{{ $m->id_mapel }}" {{ $m->id_mapel == $siswa->id_mapel ? 'selected' : '' }}>
                                {{ $m->nama_mapel }}
                            </option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback">
                        Mohon pilih mapel.
                    </div>
                </div>

                <div class="mb-3">
                    <label for="gambar_tugas" class="form-label">Gambar Tugas</label>
                    <div class="mb-2">
                        @if ($siswa->gambar_tugas)
                            <img src="{{ asset('gambar_tugas/' . $siswa->gambar_tugas) }}" alt="Gambar Tugas" class="img-thumbnail" style="width: 100px;">
                        @endif
                    </div>
                    <input type="file" class="form-control" id="gambar_tugas" name="gambar_tugas">
                </div>

                <div class="text-end">
                    <input type="submit" value="Simpan Data" class="btn btn-primary">
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @endsection <!-- End of the content section -->
</body>
</html>
