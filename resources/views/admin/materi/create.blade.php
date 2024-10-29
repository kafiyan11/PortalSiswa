<!-- resources/views/admin/materi/create.blade.php -->
<head>
    <title>Tambah Materi | Portal Siswa</title>
</head>
@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4 text-center">Tambah Materi</h1>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('adminMateri.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Judul -->
                <div class="mb-3">
                    <label for="judul" class="form-label">Judul <span class="text-danger">*</span></label>
                    <input type="text" 
                           class="form-control @error('judul') is-invalid @enderror" 
                           name="judul" 
                           id="judul" 
                           value="{{ old('judul') }}" 
                           required>
                    @error('judul')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Mapel Dropdown -->
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
            
                    @error('id_mapel')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Kelas -->
                <div class="mb-3">
                    <label for="kelas" class="form-label">Kelas <span class="text-danger">*</span></label>
                    <input type="text" 
                           class="form-control @error('kelas') is-invalid @enderror" 
                           name="kelas" 
                           id="kelas" 
                           value="{{ old('kelas') }}" 
                           required>
                    @error('kelas')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Tipe -->
                <div class="mb-3">
                    <label class="form-label d-block">Tipe <span class="text-danger">*</span></label>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input @error('tipe') is-invalid @enderror" 
                               type="radio" 
                               name="tipe" 
                               id="tipe_gambar" 
                               value="gambar" 
                               {{ old('tipe') == 'gambar' ? 'checked' : '' }} 
                               onclick="toggleInput()">
                        <label class="form-check-label" for="tipe_gambar">Gambar</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input @error('tipe') is-invalid @enderror" 
                               type="radio" 
                               name="tipe" 
                               id="tipe_youtube" 
                               value="youtube" 
                               {{ old('tipe') == 'youtube' ? 'checked' : '' }} 
                               onclick="toggleInput()">
                        <label class="form-check-label" for="tipe_youtube">YouTube</label>
                    </div>
                    @error('tipe')
                        <div class="invalid-feedback d-block">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Gambar -->
                <div class="mb-3" id="gambar_input" style="display: none;">
                    <label for="gambar" class="form-label">Gambar <span class="text-danger">*</span></label>
                    <input type="file" 
                           class="form-control @error('gambar') is-invalid @enderror" 
                           name="gambar" 
                           id="gambar" 
                           accept="image/*">
                    @error('gambar')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Link YouTube -->
                <div class="mb-3" id="youtube_input" style="display: none;">
                    <label for="link_youtube" class="form-label">Link YouTube <span class="text-danger">*</span></label>
                    <input type="url" 
                           class="form-control @error('link_youtube') is-invalid @enderror" 
                           name="link_youtube" 
                           id="link_youtube" 
                           value="{{ old('link_youtube') }}">
                    @error('link_youtube')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
</div>

<!-- JavaScript untuk toggle input berdasarkan tipe yang dipilih -->
<script>
    function toggleInput() {
        var tipeGambar = document.getElementById('tipe_gambar').checked;
        var tipeYoutube = document.getElementById('tipe_youtube').checked;

        document.getElementById('gambar_input').style.display = tipeGambar ? 'block' : 'none';
        document.getElementById('youtube_input').style.display = tipeYoutube ? 'block' : 'none';

        // Menandai field sebagai required jika ditampilkan
        if(tipeGambar){
            document.getElementById('gambar').setAttribute('required', 'required');
            document.getElementById('link_youtube').removeAttribute('required');
        } else if(tipeYoutube){
            document.getElementById('link_youtube').setAttribute('required', 'required');
            document.getElementById('gambar').removeAttribute('required');
        } else {
            document.getElementById('gambar').removeAttribute('required');
            document.getElementById('link_youtube').removeAttribute('required');
        }
    }

    // Panggil fungsi saat halaman dimuat agar input tampil sesuai dengan old value
    window.onload = function() {
        toggleInput();
    }
</script>
@endsection