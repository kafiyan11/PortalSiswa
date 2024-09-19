@extends('layouts.app')

@section('content')
<head>
    <!-- Memuat library SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<h2 class="text-center">Nilai Siswa</h2>
<div class="container mt-4" style="max-width: 1000px;">
    <!-- Membuat header halaman dengan judul dan tombol tambah nilai -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <form action="" method="GET" class="input-group" style="max-width: 400px;">
            <input type="text" name="cari" class="form-control search-input" placeholder="Cari siswa..." value="{{ request()->get('search') }}">
            <div class="input-group-append">
                <button class="btn btn-primary search-btn" type="submit">
                    <i class="fas fa-search"></i> Cari
                </button>
            </div>
        </form>
        <a href="{{ route('scores.create') }}" class="btn btn-primary shadow-sm">
            <i class="fas fa-plus"></i> Tambah Nilai
        </a>
    </div>

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
                    <th style="width: 150px;" class="text-center">Aksi</th> <!-- Kolom aksi (edit, hapus) -->
                </tr>
            </thead>
            <tbody>
                @foreach($scores as $index => $score) <!-- Looping untuk menampilkan setiap data nilai siswa -->
                <tr>
                    <td>{{ $index + 1 }}</td> <!-- Menampilkan nomor urut -->
                    <td>{{ $score->nama }}</td> <!-- Menampilkan nama siswa -->
                    <td>{{ $score->nis }}</td> <!-- Menampilkan NIS siswa -->
                    <td>{{ $score->daily_test_score }}</td> <!-- Menampilkan nilai UH -->
                    <td>{{ $score->midterm_test_score }}</td> <!-- Menampilkan nilai UTS -->
                    <td>{{ $score->final_test_score }}</td> <!-- Menampilkan nilai UAS -->
                    <td class="text-center">
                        <!-- Tindakan: Edit dan Hapus -->
                        <div class="d-inline-flex align-items-center">
                            <!-- Tombol Edit -->
                            <a href="{{ route('scores.edit', $score->id) }}" class="btn btn-warning btn-sm mr-1 shadow-sm">
                                <i class="fas fa-edit"></i> Edit
                            </a>

                            <!-- Tombol Hapus yang menggunakan konfirmasi SweetAlert2 -->
                            <button type="button" class="btn btn-danger btn-sm shadow-sm" onclick="confirmDelete('{{ $score->id }}')">
                                <i class="fas fa-trash"></i> Hapus
                            </button>

                            <!-- Form tersembunyi untuk menghapus nilai siswa -->
                            <form id="delete-form-{{ $score->id }}" action="{{ route('scores.destroy', $score->id) }}" method="POST" style="display: none;">
                                @csrf <!-- Token keamanan Laravel -->
                                @method('DELETE') <!-- Metode DELETE untuk penghapusan -->
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script>
    // Fungsi untuk menampilkan dialog konfirmasi penghapusan menggunakan SweetAlert2
    function confirmDelete(id) {
        Swal.fire({
            title: "Apakah Anda yakin?", // Judul konfirmasi
            text: "Data ini akan dihapus secara permanen!", // Pesan konfirmasi
            icon: "warning", // Ikon peringatan
            showCancelButton: true, // Tampilkan tombol batal
            confirmButtonColor: "#3085d6", // Warna tombol konfirmasi
            cancelButtonColor: "#d33", // Warna tombol batal
            confirmButtonText: "Ya, hapus!", // Teks pada tombol konfirmasi
            cancelButtonText: "Batal" // Teks pada tombol batal
        }).then((result) => {
            if (result.isConfirmed) {
                // Jika pengguna menekan "Ya, hapus!", submit form penghapusan
                document.getElementById('delete-form-' + id).submit();
            }
        });
    }
</script>
@endsection
  