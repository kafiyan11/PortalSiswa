@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <!-- Form Box -->
            <div class="card shadow-sm">

                <div class="card-body">
                    <!-- Success Message -->
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <!-- Validation Errors -->
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Edit Form -->
                    <form action="{{ route('namamapel.update', $materi) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <h3>Edit Materi</h3><br>
                        <!-- Nama Materi Field -->
                        <div class="form-group">
                            <label for="nama_mapel">Nama Pelajaran</label>
                            <input type="text" name="nama_mapel" id="nama_mapel" 
                                   value="{{ old('nama_mapel', $materi->nama_mapel) }}" 
                                   class="form-control @error('nama_mapel') is-invalid @enderror" 
                                   required style="border-color: black;">
                            @error('nama_mapel')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- Icon Field -->
                        <div class="form-group">
                            <label for="icon">Icon</label>
                            <div class="custom-file">
                                <input type="file" name="icon" id="icon" 
                                       class="custom-file-input @error('icon') is-invalid @enderror">
                                <label class="custom-file-label" for="icon">Pilih File</label>
                                @error('icon')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            @if($materi->icon)
                                <small class="form-text text-muted mt-2">
                                    <img src="{{ asset('storage/' . $materi->icon) }}" alt="Icon" width="50">
                                    <span class="ml-2">Icon saat ini</span>
                                </small>
                            @endif
                        </div>

                        <!-- Form Buttons -->
                        <div class="form-group mt-4">
                            <button type="submit" class="btn btn-dark">Update Pelajaran</button>
                            <a href="{{ route('namamapel.index') }}" class="btn btn-light">Kembali</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Include jQuery and Bootstrap JS for Bootstrap 4 -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>

<!-- JavaScript to Update File Input Label -->
<script>
    $(document).ready(function(){
        $('.custom-file-input').on('change', function(){
            let fileName = $(this).val().split('\\').pop();
            if(fileName){
                $(this).next('.custom-file-label').html(fileName);
            } else {
                $(this).next('.custom-file-label').html('Pilih File');
            }
        });
    });
</script>
@endsection
