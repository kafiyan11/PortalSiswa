<head>
    <title>Edit Nilai Siswa | Portal Siswa</title>
</head>@extends('layouts.app') <!-- Extend the layout -->

@section('content') <!-- Start the content section -->
    <div class="container">
        <div class="card">
            <h1 class="text-center">Edit Nilai</h1>
            <form action="{{ route('admin.scores.update', $score->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="student_id">Pilih Siswa</label>
                    <select name="student_id" id="student_id" class="form-control custom-select" required onchange="updateNIS()">
                        <option value="">-- Pilih Siswa --</option>
                        @foreach($siswa as $s)
                            <option value="{{ $s->id }}" data-nis="{{ $s->nis }}">
                                {{ $s->name }} (NIS: {{ $s->nis }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="nis">NIS</label>
                    <input type="text" name="nis" id="nis" class="form-control" placeholder="NIS" readonly>
                </div>
                
                <div class="mb-3">
                    <label for="id_mapel" class="form-label">Mapel <span class="text-danger">*</span></label>
                    <select class="form-control @error('id_mapel') is-invalid @enderror" 
                    name="id_mapel" 
                    id="id_mapel" required>
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
                <div class="form-group">
                    <label for="daily_test_score">Nilai UH</label>
                    <input type="number" name="daily_test_score" id="daily_test_score" class="form-control" value="{{ $score->daily_test_score }}" required>
                </div>
                <div class="form-group">
                    <label for="midterm_test_score">Nilai UTS</label>
                    <input type="number" name="midterm_test_score" id="midterm_test_score" class="form-control" value="{{ $score->midterm_test_score }}" required>
                </div>
                <div class="form-group">
                    <label for="final_test_score">Nilai UAS</label>
                    <input type="number" name="final_test_score" id="final_test_score" class="form-control" value="{{ $score->final_test_score }}" required>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Update
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection <!-- End the content section -->

<!-- Custom CSS can be included in the layout file, so it's not necessary here. -->
