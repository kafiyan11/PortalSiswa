@extends('layouts.app')

@section('content')
<div class="container mt-4" style="max-width: 1000px;">
    <!-- Alert untuk notifikasi sukses atau error -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Nilai Siswa</h2>
        <a href="{{ route('scores.create') }}" class="btn btn-primary shadow-sm">
            <i class="fas fa-plus"></i> Tambah Nilai
        </a>
    </div>

    <div class="table-responsive shadow-sm rounded">
        <table class="table table-striped table-bordered table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>NIS</th>
                    <th>UH</th>
                    <th>UTS</th>
                    <th>UAS</th>
                    <th style="width: 150px;" class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($scores as $index => $score)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $score->nama }}</td>
                    <td>{{ $score->nis }}</td>
                    <td>{{ $score->daily_test_score }}</td>
                    <td>{{ $score->midterm_test_score }}</td>
                    <td>{{ $score->final_test_score }}</td>
                    <td class="text-center">
                        <div class="d-inline-flex align-items-center">
                            <a href="{{ route('scores.edit', $score->id) }}" class="btn btn-warning btn-sm mr-1 shadow-sm">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <form action="{{ route('scores.destroy', $score->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm shadow-sm">
                                    <i class="fas fa-trash"></i> Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
