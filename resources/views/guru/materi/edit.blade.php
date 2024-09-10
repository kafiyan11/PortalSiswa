<!-- resources/views/guru/editMateri.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Materi</h1>
    <form action="{{ route('materi.update', $materi->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label for="kelas">Kelas</label>
            <input type="text" name="kelas" id="kelas" class="form-control" value="{{ old('kelas', $materi->kelas) }}" required>
        </div>

        <div class="form-group">
            <label for="jurusan">Jurusan</label>
            <input type="text" name="jurusan" id="jurusan" class="form-control" value="{{ old('jurusan', $materi->jurusan) }}" required>
        </div>

        <div class="form-group">
            <label for="mapel">Mapel</label>
            <input type="text" name="mapel" id="mapel" class="form-control" value="{{ old('mapel', $materi->mapel) }}" required>
        </div>

        <div class="form-group">
            <label for="gambar_materi">Gambar Materi (Opsional)</label>
            <input type="file" name="gambar_materi" id="gambar_materi" class="form-control">
            @if($materi->gambar_materi)
                <img src="{{ asset('public/' . $materi->gambar_materi) }}" alt="Gambar Materi" class="img-thumbnail mt-2" style="max-width: 150px;">
            @endif
        </div>

        <div class="form-group">
            <label for="video_materi">Video Materi (Opsional)</label>
            <input type="file" name="video_materi" id="video_materi" class="form-control">
            @if($materi->video_materi)
                <video controls class="mt-2" style="max-width: 300px;">
                    <source src="{{ asset('public/' . $materi->video_materi) }}" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
            @endif
        </div>

        <button type="submit" class="btn btn-primary">Update Materi</button>
    </form>
</div>
@endsection
