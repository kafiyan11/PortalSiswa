@extends('layouts.app')

@section('content')
<head>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- Pastikan jQuery dimuat -->
</head>
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="fw-bold">Daftar Jadwal</h1>
        <a href="{{ route('admin.jadwal.create') }}" class="btn btn-primary btn-lg">
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

    <div class="table-responsive">
        <table class="table table-hover table-striped align-middle">
            <thead class="table-dark">
                <tr>
                    <th>Kelas</th>
                    <th>Mata Pelajaran</th>
                    <th>Guru</th>
                    <th>Jam Mulai</th>
                    <th>Jam Selesai</th>
                    <th>Tanggal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($jadwals as $jadwal)
                <tr>
                    <td>{{ $jadwal->kelas }}</td>
                    <td>{{ $jadwal->mata_pelajaran }}</td>
                    <td>{{ $jadwal->guru }}</td>
                    <td>{{ $jadwal->jam_mulai }}</td>
                    <td>{{ $jadwal->jam_selesai }}</td>
                    <td>{{ $jadwal->tanggal }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

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
