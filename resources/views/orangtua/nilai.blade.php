@extends('layouts.app')

@section('content')
<head>
    <!-- Memuat library SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<h2 class="text-center">Nilai Siswa</h2>
<div class="container mt-4" style="max-width: 1000px;">
    <!-- Alert untuk menampilkan pesan sukses jika ada session 'success' -->
    @if(session('success'))
    <script>
        Swal.fire({
            title: "Kerja Bagus!", // Judul popup
            text: "{{ session('success') }}", // Pesan sukses dari session
            icon: "success" // Ikon popup (success)
        });
    </script>
    @endif

    <!-- Cek apakah ada data siswa -->
    @if($scores->isEmpty())
    <div class="alert alert-warning text-center" role="alert">
        Belum ada siswa yang terhubung.
    </div>
    @else
    <!-- Tabel responsif untuk menampilkan daftar nilai siswa -->
    <div class="table-responsive shadow-sm rounded">
        <table class="table table-striped table-bordered table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>No</th> <!-- Nomor urut -->
                    <th>Nama</th> <!-- Nama siswa -->
                    <th>NIS</th> <!-- Nomor Induk Siswa -->
                    <th>UH</th> <!-- Nilai Ulangan Harian -->
                    <th>UTS</th> <!-- Nilai UTS -->
                    <th>UAS</th> <!-- Nilai UAS -->
                </tr>
            </thead>
            <tbody>
                @foreach($scores as $index => $score)
                <tr>
                    <td>{{ $index + 1 }}</td> <!-- Menampilkan nomor urut -->
                    <td>{{ $score->nama }}</td> <!-- Menampilkan nama siswa -->
                    <td>{{ $score->nis }}</td> <!-- Menampilkan NIS siswa -->
                    <td>{{ $score->daily_test_score }}</td> <!-- Menampilkan nilai UH -->
                    <td>{{ $score->midterm_test_score }}</td> <!-- Menampilkan nilai UTS -->
                    <td>{{ $score->final_test_score }}</td> <!-- Menampilkan nilai UAS -->
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif
</div>
@endsection
