<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Tugas Siswa | Portal Siswa</title>
    <link href="{{ asset('assets/img/favicon.png') }}" rel="icon">
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" crossorigin="anonymous" />
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        body {
            background-color: #f8f9fa; /* Warna latar belakang yang lebih terang */
        }

        /* Layout utama dengan Flexbox */
        .container-main {
            display: flex;
            min-height: 100vh; /* Minimal tinggi viewport */
            overflow: hidden; /* Mencegah overflow konten */
        }

        /* Konten utama */
        .content {
            margin-left: 250px; /* Menyesuaikan dengan lebar sidebar */
            padding: 20px;
            width: calc(100% - 250px); /* Sesuaikan dengan sisa ruang */
            background-color: #f8f9fa;
            overflow-y: auto; /* Memungkinkan scrolling vertikal */
        }

        /* Kontainer tabel */
        .table-container {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
        }

        /* Tabel dan isinya */
        table th, table td {
            text-align: center; /* Pusatkan teks dalam tabel */
            vertical-align: middle;
        }

        table th {
            background-color: #343a40; /* Warna header tabel */
            color: white;
            padding: 15px;
        }

        table td {
            padding: 10px;
        }

        table tr:nth-child(even) {
            background-color: #f2f2f2; /* Warna untuk baris genap */
        }

        table tr:hover {
            background-color: #e9ecef; /* Warna saat hover */
        }

        /* Tombol */
        .btn-primary, .btn-danger, .btn-info {
            margin-bottom: 20px; /* Margin bawah untuk tombol */
            transition: transform 0.2s; /* Transisi untuk efek hover */
        }

        .btn-primary:hover, .btn-danger:hover, .btn-info:hover {
            transform: scale(1.05); /* Efek skala saat hover */
        }

        /* Form Pencarian */
        .search-form {
            flex: 1;
            max-width: 300px; /* Lebar maksimum formulir pencarian */
            margin-right: 10px; /* Margin kanan untuk spasi */
        }

        .search-input {
            border-radius: 25px 0 0 25px; /* Rounded corners */
            border: 2px solid #007bff; /* Border berwarna biru */
            padding-left: 15px; /* Padding kiri untuk jarak teks dari border */
            height: 38px; /* Menyesuaikan tinggi input dengan tombol */
        }

        .search-btn {
            border-radius: 0 25px 25px 0; /* Rounded corners untuk tombol */
            padding: 6px 10px; /* Padding tombol lebih kecil */
            background-color: #007bff; /* Warna tombol */
            border: none; /* Menghilangkan border default */
            color: white; /* Warna teks tombol */
            font-size: 0.875rem; /* Mengurangi ukuran font */
        }

        .search-btn:hover {
            background-color: #0056b3; /* Warna saat hover */
        }

        .add-btn {
            padding: 6px 10px; /* Padding tombol tambah lebih kecil */
            background-color: #28a745; /* Warna tombol tambah */
            border: none; /* Menghilangkan border default */
            color: white; /* Warna teks tombol */
            font-size: 0.875rem; /* Konsisten dengan tombol pencarian */
        }

        .add-btn:hover {
            background-color: #218838; /* Warna saat hover tombol tambah */
        }

        /* Responsif untuk layar kecil */
        @media (max-width: 768px) {
            .content {
                margin-left: 0; /* Tidak ada margin kiri pada layar kecil */
                width: 100%; /* Lebar penuh untuk konten */
                padding: 10px; /* Padding yang lebih kecil */
            }

            .d-flex {
                flex-direction: column; /* Susun ulang elemen dalam kolom */
                align-items: stretch; /* Elemen mengisi lebar penuh */
            }

            .search-form {
                max-width: 100%; /* Lebar penuh pada layar kecil */
                margin-right: 0; /* Menghilangkan margin kanan */
                margin-bottom: 10px; /* Margin bawah untuk spasi */
            }

            /* Memastikan tombol berada di bawah input */
            .search-form .input-group-append {
                display: block;
                width: 100%;
            }

            .search-btn {
                width: 100%; /* Lebar penuh untuk tombol */
                border-radius: 5px; /* Rounded corners yang lebih kecil */
                margin-top: 5px; /* Margin atas untuk spasi */
                padding: 6px 10px; /* Padding tombol lebih kecil */
                font-size: 0.875rem; /* Ukuran font kecil */
            }

            .add-btn {
                width: 100%; /* Lebar penuh pada tombol tambah */
                margin-bottom: 10px; /* Margin bawah */
                padding: 6px 10px; /* Padding tombol lebih kecil */
                font-size: 0.875rem; /* Ukuran font kecil */
            }

            table th, table td {
                padding: 8px; /* Padding yang lebih kecil pada tabel */
            }

            /* Mengurangi border-radius pada mobile */
            .search-input, .search-btn, .add-btn {
                border-radius: 5px; /* Rounded corners yang lebih kecil */
            }

            .search-input {
                margin-bottom: 5px; /* Margin bawah untuk input */
            }

            .search-btn {
                margin-bottom: 10px; /* Margin bawah untuk tombol */
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
        <div class="d-flex justify-content-between flex-wrap mb-3">
            <!-- Fitur pencarian -->
            <form action="{{ route('siswa.cari') }}" method="GET" class="input-group search-form">
                <input type="text" name="cari" class="form-control search-input" placeholder="Cari tugas..." value="{{ request()->get('cari') }}" required>
                <div class="input-group-append">
                    <button class="btn search-btn btn-sm" type="submit">
                    </button>
                </div>
            </form>
            <!-- Tombol tambah tugas -->
            <a href="{{ route('admin.create') }}" class="btn add-btn btn-sm">
                <i class="fas fa-plus-circle"></i> Tambah Tugas
            </a>
        </div>

        <!-- Tabel Data -->
        <div class="table-container">
            <div class="table-responsive">
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
                        @forelse ($siswa as $no => $siswas)
                        <tr>
                            <td>{{ $no + 1 }}</td>
                            <td>{{ $siswas->nis }}</td>
                            <td>{{ $siswas->nama }}</td>
                            <td>{{ $siswas->kelas }}</td>
                            <td>
                                @if ($siswas->gambar_tugas)
                                    <a href="{{ asset('gambar_tugas/' . $siswas->gambar_tugas) }}" target="_blank">
                                        <img src="{{ asset('gambar_tugas/' . $siswas->gambar_tugas) }}" alt="Gambar Tugas" width="100" class="img-fluid">
                                    </a>
                                @else
                                    -
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
                        @empty
                        <tr>
                            <td colspan="6" class="text-center">Tidak ada data tugas ditemukan.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Link pagination -->
        <div class="d-flex justify-content-end">
            {{ $siswa->links() }}
        </div>
    </div>
</div>


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
