<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Siswa</title>
    <link href="assets/img/favicon.png" rel="icon">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: #f7f9fc;
            font-family: 'Poppins', sans-serif;
        }
        h1 {
            font-weight: 600;
            color: #004085;
        }
        .btn-primary, .btn-success {
            border-radius: 30px;
            padding: 10px 20px;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        .btn-primary {
            background: linear-gradient(90deg, #007bff, #00c6ff);
            border: none;
            color: white;
        }
        .btn-primary:hover {
            background: linear-gradient(90deg, #0056b3, #007bff);
        }
        .btn-success {
            background: linear-gradient(90deg, #28a745, #5cb85c);
            border: none;
            color: white;
        }
        .btn-success:hover {
            background: linear-gradient(90deg, #218838, #28a745);
        }
        .table-responsive {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            background: white;
            padding: 20px;
        }
        .table thead {
            background-color: #004085;
            color: white;
            font-weight: 600;
        }
        .table tbody tr:hover {
            background-color: #f1f1f1;
        }
        .table th, .table td {
            vertical-align: middle;
        }
        .badge {
            padding: 0.5em 0.75em;
            font-size: 0.9em;
            font-weight: 500;
            border-radius: 12px;
        }
        .badge-success {
            background-color: #28a745;
        }
        .badge-primary {
            background-color: #007bff;
        }
        .badge-info {
            background-color: #17a2b8;
        }
        .badge-warning {
            background-color: #ffc107;
        }
        .input-group {
            border-radius: 30px;
            overflow: hidden;
        }
        .input-group input {
            border: none;
            border-radius: 30px 0 0 30px;
            box-shadow: none;
        }
        .input-group-append button {
            border-radius: 0 30px 30px 0;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
</head>
<body>
    @include('layouts.app')

    <div class="container mt-5">
        <!-- Header dan Form Pencarian -->
        <div class="row mb-4">
            <div class="col-md-6">
                <h1 class="text-primary">Daftar Siswa</h1>
            </div>
            <div class="col-md-3 mb-3 mb-md-0">
                <form action="" method="GET">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Cari Nama atau NIS" value="{{ request()->get('search') }}">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="submit">
                                <i class="fas fa-search"></i> Cari
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-3 text-md-right">
                <a href="/admin-create" class="btn btn-success btn-lg">
                    <i class="fas fa-user-plus"></i> Tambah Siswa
                </a>
            </div>
        </div>

        <!-- Pesan Sukses -->
        @if(session('success'))
            <script>
                Swal.fire({
                    title: "Good job!",
                    text: "{{ session('success') }}",
                    icon: "success"
                });
            </script>
        @endif

        <!-- Tabel Daftar Siswa -->
        <div class="table-responsive">
            <table class="table table-hover table-bordered text-center">
                <thead class="thead-dark">
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>NIS</th>
                        <th>Password</th>
                        <th>Role</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @if($data->count() > 0)
                        @foreach($data as $no => $item)
                        <tr>
                            <td>{{ $no + 1 }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->nis }}</td>
                            <td>{{ $item->plain_password }}</td>
                            <td>
                                <span class="badge 
                                    @if($item->role == 'Admin') badge-success 
                                    @elseif($item->role == 'Siswa') badge-primary 
                                    @elseif($item->role == 'Guru') badge-info 
                                    @elseif($item->role == 'Orang Tua') badge-warning 
                                    @endif">
                                    {{ ucfirst($item->role) }}
                                </span>
                            </td>
                            <td class="d-flex justify-content-center">
                                <a href="{{ route('edit', $item->id) }}" class="btn btn-warning btn-sm mr-2">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <form id="form-delete-{{ $item->id }}" action="{{ route('delete', $item->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-danger btn-sm delete-btn" data-id="{{ $item->id }}">
                                        <i class="fas fa-trash-alt"></i> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="6">Tidak ada data ditemukan.</td>
                        </tr>
                    @endif
                </tbody>
            </table>
            <!-- Tampilkan tautan pagination -->
            {{ $data->appends(['search' => request()->get('search')])->links() }}   
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- SweetAlert2 Delete Confirmation -->
    <script>
        $(document).ready(function() {
            $('.delete-btn').click(function() {
                var button = $(this);
                var id = button.data('id');

                Swal.fire({
                    title: "Apa kamu yakin?",
                    text: "Menghapus data siswa ini tidak dapat dikembalikan!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Ya, hapus!",
                    cancelButtonText: "Batal"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $(this).parent().submit();
                    }
                });
            });
        });
    </script>
</body>
</html>
