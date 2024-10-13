<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Tugas Siswa</title>
    <link href="assets/img/favicon.png" rel="icon">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        body {
            background-color: #f8f9fa; /* Light background for contrast */
        }

        /* Layout utama dengan Flexbox */
        .container-main {
            display: flex;
            height: 100vh; /* Full height */
            overflow: hidden; /* Prevent content overflow */
        }

        /* Konten utama */
        .content {
            margin-left: 250px; /* Menyesuaikan dengan lebar sidebar */
            padding: 20px;
            width: calc(100% - 250px); /* Sesuaikan dengan sisa ruang */
            height: 100vh; /* Full height */
            overflow-y: auto; /* Allow content scrolling */
            background-color: #f8f9fa;
        }

        /* Tabel dan isinya */
        .table {
            margin: 0 auto;
            width: 100%; /* Use full width */
            max-width: 1200px; /* Maximum width for larger screens */
        }

        table th, table td {
            text-align: center;
            vertical-align: middle;
        }

        table th {
            background-color: #343a40;
            color: white;
            padding: 15px;
        }

        table td {
            padding: 10px;
        }

        table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        table tr:hover {
            background-color: #e9ecef;
        }

        /* Tombol */
        .btn-primary, .btn-danger, .btn-info {
            margin-bottom: 20px;
            transition: transform 0.2s;
        }

        .btn-primary:hover, .btn-danger:hover, .btn-info:hover {
            transform: scale(1.05); /* Scale effect on hover */
        }

        .d-flex .input-group {
            max-width: 400px;
        }

        .search-input {
            border-radius: 25px 0 0 25px;
            border: 2px solid #007bff;
        }

        .search-btn {
            border-radius: 0 25px 25px 0;
            padding: 8px 20px;
            background-color: #007bff;
        }

        .add-btn {
            padding: 8px 20px;
            background-color: #28a745;
        }

        /* Responsif untuk layar kecil */
        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                position: relative; /* Tidak fixed pada layar kecil */
                height: auto; /* Adjust height */
            }

            .content {
                margin-left: 0;
                width: 100%;
                height: auto; /* Adjust height */
            }
        }
    </style>
</head>
<body>

@include('layouts.app')

<div class="container-main">
    <!-- Konten Utama -->
    <div class="content">
        <h1 class="text-center mb-4">Data Tugas Siswa</h1>

        <!-- Main content -->
        <div class="d-flex justify-content-between mb-2">
            <!-- Fitur pencarian -->
            <form action="{{route('siswa.cari')}}" method="GET" class="input-group">
                <input type="text" name="cari" class="form-control search-input" placeholder="Cari tugas..." required>
                <div class="input-group-append">
                    <button class="btn btn-primary search-btn" type="submit">
                        <i class="fas fa-search"></i> Cari
                    </button>
                </div>
            </form>
            <!-- Tombol tambah tugas -->
            <a href="{{ route('admin.create') }}" class="btn btn-primary add-btn">
                <i class="fas fa-plus-circle"></i> Tambah Tugas
            </a>
        </div>

        <!-- Tabel Data -->
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>NO</th>
                    <th>NIS</th>
                    <th>Nama</th>
                    <th>Kelas</th>
                    <th>Gambar</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <!-- Loop data siswa -->
                @foreach ($siswa as $no => $siswas)
                <tr>
                    <td>{{ $no + 1 }}</td>
                    <td>{{ $siswas->nis }}</td>
                    <td>{{ $siswas->nama }}</td>
                    <td>{{ $siswas->kelas }}</td>
                    <td>
                        @if ($siswas->gambar_tugas)
                            <img src="{{ asset('gambar_tugas/' . $siswas->gambar_tugas) }}" alt="Gambar Tugas" width="100" height="auto" class="img-fluid">
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('tugas.edit', $siswas->id) }}" class="btn btn-sm btn-info">Edit</a>
                        <button type="button" class="btn btn-sm btn-danger" onclick="confirmDelete('{{ $siswas->id }}')">Hapus</button>
                        <form id="delete-form-{{ $siswas->id }}" action="{{ route('tugas.hapus', $siswas->id) }}" method="POST" style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="d-flex justify-content-end">
            {{ $siswa->links() }}
        </div>
    </div>
</div>

<script>
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
</script>
</body>
</html>
