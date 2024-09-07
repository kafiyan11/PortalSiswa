@extends('layouts.app')  <!-- Gunakan layout yang sama jika diperlukan -->

@section('content')
<div class="container">
    <div class="header">
        <button class="navbar-toggler" type="button">
            <span class="navbar-toggler-icon"></span>
        </button>
        <h2 class="text-center">Nilai Siswa</h2>
        <a href="{{ route('scores.create') }}" class="btn btn-primary">Tambah Nilai</a>
    </div>
    <div class="table-container">
        <table class="table">
            <thead>
                <tr>
                    <th>UH</th>
                    <th>UTS</th>
                    <th>UAS</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($scores as $score)
                <tr>
                    <td>{{ $score->daily_test_score }}</td>
                    <td>{{ $score->midterm_test_score }}</td>
                    <td>{{ $score->final_test_score }}</td>
                    <td>
                        <a href="{{ route('scores.edit', $score->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('scores.destroy', $score->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
