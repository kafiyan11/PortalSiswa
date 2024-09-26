<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Siswa</title>
    <link href="assets/img/favicon.png" rel="icon">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    @include('layouts.app')
    <div class="container custom-margin pl-4">
        <div class="row mb-4">
            <div class="col-md-6">
                <h1 class="text-primary">Daftar Orang Tua</h1>
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
                <a href="{{route('create.ortu')}}" class="btn btn-success btn-lg">
                    <i class="fas fa-user-plus"></i> Tambah Orang Tua
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

        <div class="table-responsive shadow-sm">
            <table class="table table-hover table-bordered align-middle text-center">
                <thead class="table-dark">
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
                    <?php foreach($orang as $no => $item): ?>
                        <tr>
                            <td><?php echo $no + 1; ?></td>
                            <td><?php echo htmlspecialchars($item->name); ?></td>
                            <td><?php echo htmlspecialchars($item->nis); ?></td>
                            <td><?php echo htmlspecialchars($item->plain_password); ?></td>
                            <td>
                                <span class="badge 
                                    <?php 
                                    if($item->role == 'Admin') echo 'bg-success'; 
                                    elseif($item->role == 'Siswa') echo 'bg-primary'; 
                                    elseif($item->role == 'Guru') echo 'bg-info'; 
                                    elseif($item->role == 'Orang Tua') echo 'bg-warning'; 
                                    ?>">
                                    <?php echo ucfirst($item->role); ?>
                                </span>
                                <td class="d-flex justify-content-center">
                                    <a href="{{ route('edit.ortu', $item->id) }}" class="btn btn-sm btn-warning me-2">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>&nbsp;&nbsp;
                                    <form id="form-delete-{{ $item->id }}" action="{{ route('delet.ortu', $item->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-sm btn-danger delete-btn"data-id="{{ $item->id }}">
                                            <i class="fas fa-trash-alt"></i> Delete
                                        </button>
                                    </form>
                                </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
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