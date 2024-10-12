@extends('layouts.app')

@section('content')
    <h1>Edit Materi</h1>

    <form action="{{ route('adminMateri.update', $materi->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Judul -->
        <div class="mb-3">
            <label for="judul" class="form-label">Judul</label>
            <input type="text" name="judul" id="judul" class="form-control" value="{{ old('judul', $materi->judul) }}" required>
            @error('judul')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Mapel Dropdown -->
        <div class="mb-3">
            <label for="id_mapel" class="form-label">Mapel</label>
            <select name="id_mapel" id="id_mapel" class="form-control" required>
                <option value="">-- Pilih Mapel --</option>
                @foreach($mapel as $m)
                    <option value="{{ $m->id_mapel }}" {{ (old('id_mapel', $materi->id_mapel) == $m->id_mapel) ? 'selected' : '' }}>
                        {{ $m->nama_mapel }}
                    </option>
                @endforeach
            </select>
            @error('id_mapel')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Tipe -->
        <div class="mb-3">
            <label class="form-label">Tipe</label>
            <div class="form-check">
                <input type="radio" name="tipe" id="tipe_gambar" value="gambar" class="form-check-input" {{ (old('tipe', $materi->tipe) == 'gambar') ? 'checked' : '' }} required>
                <label for="tipe_gambar" class="form-check-label">Gambar</label>
            </div>
            <div class="form-check">
                <input type="radio" name="tipe" id="tipe_youtube" value="youtube" class="form-check-input" {{ (old('tipe', $materi->tipe) == 'youtube') ? 'checked' : '' }} required>
                <label for="tipe_youtube" class="form-check-label">YouTube</label>
            </div>
            @error('tipe')
                <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
        </div>

        <!-- Gambar -->
        <div id="gambar_input" class="mb-3" style="{{ $materi->tipe == 'youtube' ? 'display:none;' : '' }}">
            <label for="gambar" class="form-label">Gambar</label>
            @if($materi->gambar)
                <div>
                    <img src="{{ asset('storage/' . $materi->gambar) }}" alt="{{ $materi->judul }}" width="150">
                </div>
            @endif
            <input type="file" name="gambar" id="gambar" accept="image/*" class="form-control">
            @error('gambar')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Link YouTube -->
        <div id="youtube_input" class="mb-3" style="{{ $materi->tipe == 'gambar' ? 'display:none;' : '' }}">
            <label for="link_youtube" class="form-label">Link YouTube</label>
            <input type="url" name="link_youtube" id="link_youtube" value="{{ old('link_youtube', $materi->link_youtube) }}" class="form-control">
            @error('link_youtube')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary">Perbarui</button>
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const tipeGambar = document.getElementById('tipe_gambar');
            const tipeYoutube = document.getElementById('tipe_youtube');
            const gambarInput = document.getElementById('gambar_input');
            const youtubeInput = document.getElementById('youtube_input');
    
            function toggleInputs() {
                console.log("Toggle Inputs Function Called");
                console.log("tipeGambar checked:", tipeGambar.checked);
                console.log("tipeYoutube checked:", tipeYoutube.checked);
    
                if (tipeGambar.checked) {
                    gambarInput.style.display = 'block';
                    youtubeInput.style.display = 'none';
                } else if (tipeYoutube.checked) {
                    gambarInput.style.display = 'none';
                    youtubeInput.style.display = 'block';
                }
            }
    
            // Set initial visibility based on the selected radio button
            toggleInputs();
    
            // Add event listeners to radio buttons
            tipeGambar.addEventListener('change', toggleInputs);
            tipeYoutube.addEventListener('change', toggleInputs);
        });
    </script>
    
@endsection
