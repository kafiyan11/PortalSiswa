@extends('layouts.app')

@section('content')
<head>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- Pastikan jQuery dimuat -->
    <style>
        /* Styling tambahan untuk memperindah tampilan */
        .table-hover tbody tr:hover {
            background-color: #f8f9fa;
        }
        .card {
            border: none;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }
        .btn-custom {
            background-color: #007bff;
            color: #fff;
        }
        .btn-custom:hover {
            background-color: #0056b3;
        }
        .btn-danger-custom {
            background-color: #dc3545;
            color: #fff;
        }
        .btn-danger-custom:hover {
            background-color: #c82333;
        }
    </style>
</head>
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="fw-bold">Jadwal Guru</h1> <!-- Ubah judul di sini -->
        <a href="{{ route('admin.jadwalguru.create') }}" class="btn btn-custom btn-lg">
            <i class="bi bi-plus-circle"></i> Tambah Jadwal
        </a>
    </div>

    @if(session('success'))
    <script>
        Swal.fire({
            title: "Kerja Bagus!",
            text: "{{ session('success') }}",
            icon: "success"
        });
    </script>
    @endif

    <!-- Menggunakan card untuk membungkus tabel -->
    @if($jadwalguru->isEmpty())
    <div class="alert alert-danger" role="alert">
        Tidak ada jadwal yang tersedia. Silakan tambahkan jadwal baru.
    </div>
    @else
    <!-- Menggunakan card untuk membungkus tabel -->
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                @foreach($jadwalguru as $group => $items)
                    <h3 class="mt-4">{{ str_replace('-', ' - ', $group) }}</h3> <!-- Menampilkan kelas dan minggu -->
                    <table class="table table-hover table-striped align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th>No</th> <!-- Tambahkan kolom No di sini -->
                                <th>Kelas</th>
                                <th>NIP</th>
                                <th>Nama Guru</th>
                                <th>Jam Mulai</th>
                                <th>Jam Selesai</th>
                                <th>Tanggal</th>
                                <th>Hari</th>
                                <th>Minggu</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($items as $index => $jadwal) <!-- Tambahkan $index untuk nomor -->
                            <tr>
                                <td>{{ $index + 1 }}</td> <!-- Tampilkan nomor di sini -->
                                <td>{{ $jadwal->kelas }}</td>
                                <td>{{ $jadwal->nis }}</td>
                                <td>{{ $jadwal->guru }}</td>
                                <td>{{ $jadwal->jam_mulai }}</td>
                                <td>{{ $jadwal->jam_selesai }}</td>
                                <td>{{ $jadwal->tanggal }}</td>
                                <td>{{ $jadwal->hari }}</td>
                                <td>{{ $jadwal->ganjil_genap }}</td>
                                <td>
                                    <a href="{{ route('admin.jadwalguru.edit', $jadwal->id) }}" class="btn btn-warning btn-sm">
                                        <i class="bi bi-pencil-square"></i> Edit
                                    </a>
                                    <form id="form-delete-{{ $jadwal->id }}" action="{{ route('admin.jadwalguru.destroy', $jadwal->id) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger btn-sm delete-btn" data-id="{{ $jadwal->id }}">
                                            <i class="fas fa-trash-alt"></i> Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endforeach
            </div>
        </div>
    </div>
    @endif

    <script>
        $(document).ready(function() {
            // Tambahkan debugging untuk memastikan event bekerja
            console.log('Script loaded and ready.');

            $('.delete-btn').click(function(e) {
                e.preventDefault(); // Mencegah form submit langsung

                var button = $(this); // Dapatkan tombol yang diklik
                var id = button.data('id'); // Dapatkan ID jadwal dari data-id
                var form = $('#form-delete-' + id); // Dapatkan form yang sesuai

                // Debugging: cek id dan form
                console.log('Button clicked, ID:', id);
                console.log('Form selector:', '#form-delete-' + id);
                console.log('Form:', form);

                Swal.fire({
                    title: "Apa kamu yakin?",
                    text: "Menghapus jadwal ini tidak dapat dikembalikan!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Ya, hapus!",
                    cancelButtonText: "Batal"
                }).then((result) => {
                    if (result.isConfirmed) {
                        console.log('Form will be submitted.');
                        form.submit(); // Submit form setelah konfirmasi
                    }
                });
            });
        });
    </script>
</div>
@endsection
