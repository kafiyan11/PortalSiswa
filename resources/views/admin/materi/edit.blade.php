<head>
    <title>Edit Materi | Portal Siswa</title>
</head>@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Edit Materi</h2>

    <form action="{{ route('adminMateri.update', $materi->id) }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="judul">Judul:</label>
            <input type="text" name="judul" id="judul" class="form-control" value="{{ old('judul', $materi->judul) }}" required>
            <div class="invalid-feedback">
                Mohon masukkan judul materi.
            </div>
        </div>

        <div class="form-group">
            <label for="id_mapel">Mapel:</label>
            <select name="id_mapel" id="id_mapel" class="form-control" required>
                @foreach($mapel as $m)
                    <option value="{{ $m->id_mapel }}" {{ $m->id_mapel == $materi->id_mapel ? 'selected' : '' }}>
                        {{ $m->nama_mapel }}
                    </option>
                @endforeach
            </select>
            <div class="invalid-feedback">
                Mohon pilih mapel.
            </div>
        </div>

        <div class="form-group">
            <label for="kelas">Kelas:</label>
            <input type="text" name="kelas" id="kelas" class="form-control" value="{{ old('kelas', $materi->kelas) }}" required>
            <div class="invalid-feedback">
                Mohon masukkan kelas.
            </div>
        </div>

        <div class="form-group">
            <label>Tipe:</label><br>
            <div class="form-check form-check-inline">
                <input type="radio" name="tipe" value="gambar" id="tipe_gambar" {{ $materi->tipe == 'gambar' ? 'checked' : '' }} onclick="showInput('gambar')" class="form-check-input">
                <label for="tipe_gambar" class="form-check-label">Gambar</label>
            </div>
            <div class="form-check form-check-inline">
                <input type="radio" name="tipe" value="youtube" id="tipe_youtube" {{ $materi->tipe == 'youtube' ? 'checked' : '' }} onclick="showInput('youtube')" class="form-check-input">
                <label for="tipe_youtube" class="form-check-label">YouTube</label>
            </div>
        </div>

        <div id="gambar-input" style="display: {{ $materi->tipe == 'gambar' ? 'block' : 'none' }};">
            <label for="gambar">Gambar:</label>
            <input type="file" name="gambar" id="gambar" class="form-control-file" accept="image/*" onchange="previewImage(event)">
            <small class="form-text text-muted">Format gambar: JPG, PNG, GIF</small>

            @if($materi->gambar)
                <div class="mt-2">
                    <p>Gambar saat ini:</p>
                    <img src="{{ Storage::url($materi->gambar) }}" alt="Materi Gambar" class="img-thumbnail mb-2" width="150">
                </div>
            @endif
            
            <div id="image-preview" class="mt-2" style="display: none;">
                <p>Preview Gambar:</p>
                <img id="preview" class="img-thumbnail" width="150" />
            </div>
        </div>

        <div id="youtube-input" style="display: {{ $materi->tipe == 'youtube' ? 'block' : 'none' }};">
            <label for="link_youtube">Link YouTube:</label>
            <input type="url" name="link_youtube" id="link_youtube" class="form-control" value="{{ old('link_youtube', $materi->link_youtube) }}" required>
            <div class="invalid-feedback">
                Mohon masukkan link YouTube yang valid.
            </div>
        </div>
        <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-primary mt-3">Perbarui Materi</button>
            <a href="{{ route('admin.materi.index') }}" class="btn btn-secondary mt-3">Kembali</a>
        <div>
    </form>
</div>

<script>
function showInput(type) {
    document.getElementById('gambar-input').style.display = type === 'gambar' ? 'block' : 'none';
    document.getElementById('youtube-input').style.display = type === 'youtube' ? 'block' : 'none';
}

// Preview image function
function previewImage(event) {
    const imagePreview = document.getElementById('image-preview');
    const preview = document.getElementById('preview');
    const file = event.target.files[0];

    if (file) {
        const reader = new FileReader();
        reader.onload = function() {
            preview.src = reader.result;
            imagePreview.style.display = 'block'; // Show the preview
        };
        reader.readAsDataURL(file);
    } else {
        imagePreview.style.display = 'none'; // Hide the preview if no file is selected
    }
}

// Set initial state
showInput('{{ $materi->tipe }}');
</script>

<style>
    .form-group label {
        font-weight: bold;
    }
    .form-control {
        border-radius: 0.5rem;
    }
    .btn-primary {
        border-radius: 0.5rem;
    }
    .btn-secondary {
        border-radius: 0.5rem;
    }
</style>
@endsection
