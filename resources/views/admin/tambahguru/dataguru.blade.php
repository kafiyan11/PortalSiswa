<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Guru</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    @include('layouts.app')

    <div class="container mt-5">
        <!-- Header dan Form Pencarian -->
        <div class="row mb-4">
            <div class="col-md-6">
                <h1 class="text-primary">Daftar Guru</h1>
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
                <a href="{{route('createguru') }}" class="btn btn-success btn-lg">
                    <i class="fas fa-user-plus"></i> Tambah Guru
                </a>
            </div>
        </div>

        <!-- Pesan Sukses -->
        @if(session('success'))
            <script>
                Swal.fire({
                    title: "Good job!",
                    text: "{{ session('success') }}", // Mengambil pesan dari session
                    icon: "success"
                });
            </script>
        @endif

        <!-- Tabel Daftar Guru -->
        <div class="table-responsive shadow-sm">
            <table class="table table-hover table-bordered align-middle text-center">
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
                    @if($guru->count() > 0)
                        @foreach($guru as $no => $item)
                            <tr>
                                <td>{{ $no + 1 }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->nis }}</td>
                                <td>{{ $item->plain_password }}</td>
                                <td>
                                    <span class="badge 
                                        @if($item->role == 'Admin') bg-success 
                                        @elseif($item->role == 'Siswa') bg-primary 
                                        @elseif($item->role == 'Guru') bg-info 
                                        @elseif($item->role == 'Orang Tua') bg-warning 
                                        @endif">
                                        {{ ucfirst($item->role) }}
                                    </span>
                                </td>
                                <td class="d-flex justify-content-center">
                                    <a href="{{ route('edit.guru', $item->id) }}" class="btn btn-sm btn-warning me-2">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>&nbsp;
                                    <form id="form-delete-{{ $item->id }}" action="{{ route('delet.guru', $item->id) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-sm btn-danger delete-btn" data-id="{{ $item->id }}">
                                            <i class="fas fa-trash-alt"></i> Delete
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
        </div>
    </div>

    <!-- Bootstrap & jQuery Scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- SweetAlert2 Delete Confirmation -->
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
                    confirmButtonText: "Ya, Hapus!",
                    cancelButtonText: "Batal"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#form-delete-' + id).submit();
                    }
                });
            });
        });
    </script>
</body>
</html>
