@extends('layouts.app') <!-- Extend the layout -->

@section('content') <!-- Start the content section -->
    <div class="container">
        <div class="card">
            <h1 class="text-center">Edit Nilai</h1>
            <form action="{{ route('admin.scores.update', $score->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="nama">Nama</label>
                    <input type="text" name="nama" id="nama" class="form-control" value="{{ $score->nama }}" required>
                </div>
                <div class="form-group">
                    <label for="nis">NIS</label>
                    <input type="number" name="nis" id="nis" class="form-control" value="{{ $score->nis }}" required>
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
