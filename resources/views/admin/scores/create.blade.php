<head>
    <title>Tambah Nilai Siswa | Portal Siswa</title>
</head>@extends('layouts.app') <!-- Extend the layout -->

@section('content') <!-- Define the content section -->
    <div class="container mt-5">
        <div class="card p-4">
            <h2 class="text-center"><i class="fas fa-plus-circle"></i> Tambah Nilai</h2>
            <form action="{{ route('admin.scores.store') }}" method="POST">
                @csrf
                <input type="hidden" name="student_id"> <!-- Ensure there's a student_id -->
                
                <div class="form-group">
                    <label for="nama">Nama</label>
                    <input type="text" name="nama" id="nama" class="form-control" placeholder="Masukkan Nama Siswa" required>
                </div>
                
                <div class="form-group">
                    <label for="nis">NIS</label>
                    <input type="number" name="nis" id="nis" class="form-control" placeholder="Masukkan NIS Siswa" required>
                </div>
                
                <div class="form-group">
                    <label for="daily_test_score">UH</label>
                    <input type="number" name="daily_test_score" id="daily_test_score" class="form-control" placeholder="Masukkan Nilai UH" required>
                </div>
                
                <div class="form-group">
                    <label for="midterm_test_score">UTS</label>
                    <input type="number" name="midterm_test_score" id="midterm_test_score" class="form-control" placeholder="Masukkan Nilai UTS" required>
                </div>
                
                <div class="form-group">
                    <label for="final_test_score">UAS</label>
                    <input type="number" name="final_test_score" id="final_test_score" class="form-control" placeholder="Masukkan Nilai UAS" required>
                </div><br>

                <button type="submit" class="btn btn-primary btn-block">Simpan <i class="fas fa-save"></i></button>
            </form>
        </div>
    </div>
@endsection <!-- End the content section -->

<!-- Optionally, if you need custom scripts for this page, you can add them here -->
