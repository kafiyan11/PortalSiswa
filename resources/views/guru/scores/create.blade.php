@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="card p-4 shadow-sm">
            <h2 class="text-center mb-4"><i class="fas fa-plus-circle"></i> Tambah Nilai</h2>
            <form action="{{ route('guru.scores.store') }}" method="POST">
                @csrf

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
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="daily_test_score">UH</label>
                        <input type="number" name="daily_test_score" id="daily_test_score" class="form-control" placeholder="Masukkan Nilai UH (Opsional)">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="midterm_test_score">UTS</label>
                        <input type="number" name="midterm_test_score" id="midterm_test_score" class="form-control" placeholder="Masukkan Nilai UTS (Opsional)">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="final_test_score">UAS</label>
                        <input type="number" name="final_test_score" id="final_test_score" class="form-control" placeholder="Masukkan Nilai UAS (Opsional)">
                    </div>
                </div>

                <button type="submit" class="btn btn-primary btn-block">Simpan <i class="fas fa-save"></i></button>
            </form>
        </div>
    </div>

    <script>
        function updateNIS() {
            var select = document.getElementById('student_id');
            var selectedOption = select.options[select.selectedIndex];

            // Ambil NIS dari data-nis atribut
            var nis = selectedOption.getAttribute('data-nis');
            document.getElementById('nis').value = nis; // Set nilai NIS ke input
        }
    </script>
@endsection
