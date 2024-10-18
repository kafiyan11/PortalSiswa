<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Guru | Portal Siswa</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        body {
            background-color: #f7f9fc;
            font-family: 'Poppins', sans-serif;
            overflow: hidden; /* Dihapus jika tidak diperlukan */
        }
        .sidebar {
            background-color: #343a40;
            color: white;
            min-height: 100vh;
            padding: 15px;
        }
        .content {
            padding: 20px;
        }
        .table-responsive {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            background: white;
            padding: 20px;
            margin-bottom: 30px;
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
        .badge-primary {
            background-color: #007bff;
        }
        /* Responsiveness: Ensure content does not overlap */
        @media (max-width: 992px) {
            .content {
                padding-left: 0;
                padding-right: 0;
            }
        }
    </style>
</head>
<body>

<!-- Jangan hapus layout atau fungsi yang lain -->
@include('layouts.app')

<div class="container-fluid">
    <div class="row">
        <!-- Sidebar sudah ada di 'layouts.app', jadi fokus ke content -->
        <div class="col-lg-10 col-md-9 offset-lg-2 offset-md-3 content">
            <h1 class="text-primary">Data Guru</h1>

            <!-- Tombol Tambah Siswa dan Pencarian -->
            <div class="d-flex justify-content-between align-items-center mb-3">
                <!-- Tombol Tambah Siswa -->
                <a href="{{ route('createguru') }}" class="btn btn-success">
                    <i class="fas fa-plus"></i> Tambah Guru
                </a>

                <!-- Form Pencarian -->
                <form action="{{ route('tambahguru') }}" method="GET" class="form-inline">
                    <input class="form-control mr-sm-2" type="search" name="search" placeholder="Cari Guru" aria-label="Search" value="{{ request()->get('search') }}">
                    <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">
                        <i class="fas fa-search"></i> Cari
                    </button>
                </form>
            </div>

            <div class="table-responsive">
                <table class="table table-hover table-bordered text-center">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>NIP</th>
                            <th>Password</th>
                            <th>Role</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($guru->count() > 0)
                            @foreach($guru as $index => $item)
                            <tr>
                                <!-- Penomoran Kontinu -->
                                <td>{{ ($guru->currentPage()-1) * $guru->perPage() + $loop->iteration }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->nis }}</td>
                                <td>{{ $item->plain_password }}</td>
        
                                <td>
                                    <span class="badge 
                                        @if($item->role == 'Admin') badge-success 
                                        @elseif($item->role == 'Guru') badge-info 
                                        @elseif($item->role == 'Orang Tua') badge-warning 
                                        @endif">
                                        {{ ucfirst($item->role) }}
                                    </span>
                                </td>
                                <td class="d-flex justify-content-center">
                                    <a href="{{ route('edit.guru', $item->id) }}" class="btn btn-warning btn-sm mr-2">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <form id="form-delete-{{ $item->id }}" action="{{ route('delet.guru', $item->id) }}" method="POST" style="display:inline-block;">
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
                <div class="mb-4">
                    <p>Total Guru: <span class="badge badge-primary">{{ $totalGuru }}</span></p> <!-- Menampilkan jumlah guru -->
                </div>
                <!-- Tampilkan tautan pagination -->
                <div class="d-flex justify-content-center">
                    {{ $guru->appends(['search' => request()->get('search')])->links() }}
                </div>   
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS dan Popper.js -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<!-- Inklusi SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    $(document).ready(function() {
        // Fungsi untuk mengonfirmasi penghapusan
        $('.delete-btn').click(function() {
            var button = $(this);
            var id = button.data('id');

            Swal.fire({
                title: "Apa kamu yakin?",
                text: "Menghapus akun ini tidak dapat dikembalikan!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya, hapus!",
                cancelButtonText: "Batal"
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#form-delete-' + id).submit();
                }
            });
        });

        // Fungsi untuk menampilkan SweetAlert jika ada pesan sukses
        @if(session('success'))
            Swal.fire({
                title: "Good job!",
                text: "{{ session('success') }}",
                icon: "success",
                confirmButtonText: "OK"
            });
        @endif
    });
</script>
</body>
</html>
