<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Orang Tua | Portal Siswa</title>
    <link href="{{ asset('assets/img/favicon.png') }}" rel="icon">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        body {
            background-color: #f7f9fc;
            font-family: 'Poppins', sans-serif;
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
        @media (max-width: 992px) {
            .content {
                padding-left: 0;
                padding-right: 0;
            }
        }
    </style>
</head>
<body>

@include('layouts.app')

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-10 col-md-9 offset-lg-2 offset-md-3 content">
            <h1 class="text-primary">Data Orang Tua</h1>

            <div class="d-flex justify-content-between align-items-center mb-3">
                <a href="{{ route('create.ortu') }}" class="btn btn-success">
                    <i class="fas fa-plus"></i> Tambah Orang Tua
                </a>

                <form action="{{ route('ortu') }}" method="GET" class="form-inline">
                    <input class="form-control mr-sm-2" type="search" name="search" placeholder="Cari Orang Tua" aria-label="Search" value="{{ request()->get('search') }}">
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
                            <th>NIS</th>
                            <th>Orang Tua Dari</th>
                            <th>Password</th>
                            <th>Role</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($orang as $index => $item)
                        <tr>
                            <td>{{ ($orang->currentPage()-1) * $orang->perPage() + $loop->iteration }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->nis }}</td>
                            <td>
                                @if($item->children->isNotEmpty())
                                    <ul class="list-unstyled">
                                        @foreach($item->children as $child)
                                            <li>{{ $child->name }}</li>
                                        @endforeach
                                    </ul>
                                @else
                                    <span>Tidak ada siswa yang terhubung.</span>
                                @endif
                            </td> 
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
                                <a href="{{ route('edit.ortu', $item->id) }}" class="btn btn-warning btn-sm mr-2" aria-label="Edit">
                                    <i class="fas fa-edit"></i> 
                                </a>
                                <form id="form-delete-{{ $item->id }}" action="{{ route('delet.ortu', $item->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-danger btn-sm delete-btn" data-id="{{ $item->id }}" aria-label="Delete">
                                        <i class="fas fa-trash-alt"></i> 
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7">Tidak ada data ditemukan.</td>
                        </tr>
                        @endforelse
                    </tbody>
                    
                    
                </table>
                <div class="mb-4">
                    <p>Total Orang Tua: <span class="badge badge-primary">{{ $totalOrangTua }}</span></p>
                </div>
                <div class="d-flex justify-content-left">
                    {{ $orang->appends(['search' => request()->get('search')])->links() }}
                </div>   
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    $(document).ready(function() {
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
