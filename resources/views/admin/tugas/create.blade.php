<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Tugas | Potal Siswa</title>
    <link href="{{ asset('assets/img/favicon.png') }}" rel="icon">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Custom CSS -->

</head>
<body>
    @extends("layouts.app")
    @section('content')
    <div class="form-container">
        <div class="form-header">
            <h2 class="text-center">Tambah Tugas</h2>
        </div>
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-custom">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('admin.create') }}" method="POST" enctype="multipart/form-data" novalidate>
                @csrf
                @method('post')
                <div class="mb-4">
                    <label for="nis" class="form-label">NIS</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-card-text"></i></span>
                        <input type="text" class="form-control" id="nis" name="nis" placeholder="Masukkan NIS" required>
                    </div>
                </div>
                <div class="mb-4">
                    <label for="nama" class="form-label">Nama</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-person"></i></span>
                        <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan Nama" required>
                    </div>
                </div>
                <div class="mb-4">
                    <label for="kelas" class="form-label">Kelas</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-book"></i></span>
                        <input type="text" class="form-control" id="kelas" name="kelas" placeholder="Masukkan Kelas" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="id_mapel" class="form-label">Mapel <span class="text-danger">*</span></label>
                    <select class="form-control @error('id_mapel') is-invalid @enderror" 
                    name="id_mapel" 
                    id="id_mapel" 
                    required>
                <option value="">-- Pilih Mapel --</option>
                @foreach($mapel as $m)
                    <option value="{{ $m->id_mapel }}" {{ old('id_mapel') == $m->id_mapel ? 'selected' : '' }}>
                        {{ $m->nama_mapel }}
                    </option>
                @endforeach
            </select>
            </div>
                <div class="mb-4">
                    <label for="gambar_tugas" class="form-label">Gambar</label>
                    <yudiv class="input-group">
                        <span class="input-group-text"><i class="bi bi-image"></i></span>
                        <input type="file" class="form-control" id="gambar_tugas" name="gambar_tugas" accept="image/*" required>
                    </div>
                </div>
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary d-flex justify-content-end">Simpan Data</button>
                </div>
            </form>
        </div>
    </div>
    @endsection
    <!-- Bootstrap JS (Optional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
