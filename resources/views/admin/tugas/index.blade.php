<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Tugas Siswa | Portal Siswa</title>
    <link href="{{ asset('assets/img/favicon.png') }}" rel="icon">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" crossorigin="anonymous" />
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>
<body>

@extends('layouts.app')
@section('content')
<div class="container-main">
    <!-- Konten Utama -->
    <div class="content">
        <h1 class="text-center mb-4">Data Tugas Siswa</h1>

        <!-- Main content -->
        <div class="d-flex justify-content-between flex-wrap mb-3">
            <!-- Fitur pencarian -->
            <form action="{{ route('siswa.cari') }}" method="GET" class="input-group mb-2 mb-md-0">
                <input type="text" name="cari" class="form-control form-control-sm text-center" placeholder="Cari tugas..." value="{{ request()->get('cari') }}" required style="max-width: 200px;">
                <button class="btn btn-primary btn-sm" type="submit">
                    <i class="bi bi-search"></i> Cari
                </button>
            </form>
            <!-- Tombol tambah tugas -->
            <a href="{{ route('admin.create') }}" class="btn btn-primary btn-sm ml-auto" style="width: 150px;">
                <i class="bi bi-plus-circle"></i> Tambah Tugas
            </a>
        </div>

        <table class="table table-bordered text-center">
            <thead>
                <tr>
                    <th scope="col">NO</th>
                    <th scope="col">NIS</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Kelas</th>
                    <th scope="col">Mata Pelajaran</th>
                    <th scope="col">Tugas</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <!-- Loop data siswa -->
                @forelse ($siswa as $no => $siswas)
                <tr>
                    <td>{{ $no + 1 }}</td>
                    <td>{{ $siswas->nis }}</td>
                    <td>{{ $siswas->nama }}</td>
                    <td>{{ $siswas->kelas }}</td>
                    <td>{{ optional($siswas->mapel)->nama_mapel }}</td> <!-- Menampilkan nama mapel -->
                    <td>
                        @if ($siswas->gambar_tugas)
                            <a href="{{ asset('gambar_tugas/' . $siswas->gambar_tugas) }}" target="_blank">
                                <img src="{{ asset('gambar_tugas/' . $siswas->gambar_tugas) }}" alt="Gambar Tugas" width="100" class="img-fluid mx-auto d-block">
                            </a>
                        @else
                            -
                        @endif
                    </td>
                    <td>
                        <div class="d-inline-flex">
                            <!-- Tombol Edit -->
                            <a href="{{ route('tugas.edit', $siswas->id) }}" class="btn btn-sm btn-warning mr-2">
                                <i class="fa fa-edit"></i> 
                            </a>
                            <!-- Tombol Hapus -->
                            <form id="delete-form-{{ $siswas->id }}" action="{{ route('tugas.hapus', $siswas->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-sm btn-danger delete-btn" onclick="confirmDelete('{{ $siswas->id }}')">
                                    <i class="fas fa-trash-alt"></i> 
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center">Tidak ada data tugas ditemukan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <!-- Link pagination -->
        <div class="d-flex justify-content-end">
            {{ $siswa->links() }}
        </div>
    </div>
</div>
@endsection

<!-- Script SweetAlert untuk konfirmasi hapus dan pesan sukses -->
<script>
    // Konfirmasi hapus menggunakan SweetAlert
    function confirmDelete(id) {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Data ini akan dihapus dan tidak bisa dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                // Jika dikonfirmasi, submit form penghapusan
                document.getElementById('delete-form-' + id).submit();
            }
        });
    }

    // SweetAlert untuk pesan sukses setelah operasi
    @if(session('success'))
        Swal.fire({
            title: 'Good job!',
            text: "{{ session('success') }}",
            icon: 'success',
            confirmButtonText: 'OK'
        });
    @endif
</script>

</body>
</html>
