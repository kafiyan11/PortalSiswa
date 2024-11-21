@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="card p-4 shadow-sm">
            <h2 class="text-center mb-4"><i class="fas fa-edit"></i> Edit Nilai</h2>
            <form action="{{ route('guru.scores.update', $score->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="student_id" class="font-weight-bold">Pilih Siswa</label>
                    <select name="student_id" id="student_id" class="form-control custom-select" required onchange="updateNIS()">
                        <option value="">-- Pilih Siswa --</option>
                        @foreach($siswa as $s)
                            <option value="{{ $s->id }}" data-nis="{{ $s->nis }}" 
                                {{ (old('student_id', $score->student_id) == $s->id) ? 'selected' : '' }}>
                                {{ $s->name }} (NIS: {{ $s->nis }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="nis" class="font-weight-bold">NIS</label>
                    <input type="text" name="nis" id="nis" class="form-control" value="{{ $score->user->nis }}" readonly>
                </div>
                <div class="form-group">
                    <label for="nis" class="font-weight-bold">NIS</label>
                    <input type="text" name="nis" id="nis" class="form-control" placeholder="NIS" readonly>
                </div>

                <div class="form-group">
                    <label for="id_mapel" class="font-weight-bold">Mapel <span class="text-danger">*</span></label>
                    <select class="form-control custom-select @error('id_mapel') is-invalid @enderror" 
                            name="id_mapel" 
                            id="id_mapel" 
                            required>
                        <option value="">-- Pilih Mapel --</option>
                        @foreach($mapel as $m)
                            <option value="{{ $m->id_mapel }}" 
                                {{ $m->id_mapel == $score->id_mapel ? 'selected' : '' }}>
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

                <!-- Bagian UH, UTS, dan UAS -->
                <div class="form-group">
                    <label for="daily_test_score" class="font-weight-bold">UH</label>
                    <input type="number" name="daily_test_score" id="daily_test_score" 
                           class="form-control" 
                           value="{{ $score->daily_test_score }}" 
                           placeholder="Masukkan Nilai UH (Opsional)">
                </div>

                <div class="form-group">
                    <label for="midterm_test_score" class="font-weight-bold">UTS</label>
                    <input type="number" name="midterm_test_score" id="midterm_test_score" 
                           class="form-control" 
                           value="{{ $score->midterm_test_score }}" 
                           placeholder="Masukkan Nilai UTS (Opsional)">
                </div>

                <div class="form-group">
                    <label for="final_test_score" class="font-weight-bold">UAS</label>
                    <input type="number" name="final_test_score" id="final_test_score" 
                           class="form-control" 
                           value="{{ $score->final_test_score }}" 
                           placeholder="Masukkan Nilai UAS (Opsional)">
                </div>

                <div class="form-group mt-4">
                    <button type="submit" class="btn btn-success btn-block">
                        Update <i class="fas fa-save"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function updateNIS() {
            const select = document.getElementById('student_id');
            const selectedOption = select.options[select.selectedIndex];
            const nis = selectedOption.getAttribute('data-nis');
            document.getElementById('nis').value = nis;
        }
    </script>

    <style>
        .form-control, 
        .custom-select {
            width: 100%; /* Semua input memiliki lebar penuh */
            height: calc(2.375rem + 2px); /* Tinggi seragam untuk input dan select */
            padding: 0.375rem 0.75rem; /* Ruang dalam yang konsisten */
            font-size: 1rem;
            border-radius: 0.25rem;
        }

        .form-group {
            margin-bottom: 1.5rem; /* Tambahkan jarak antar elemen */
        }
    </style>
@endsection
