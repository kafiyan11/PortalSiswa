<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Siswa</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>
<body>
    @include('layouts.app')
    <div class="container custom-margin pl-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="text-primary">Daftar Guru</h1>
            <a href="{{ route('createguru') }}" class="btn btn-success btn-lg shadow-sm">
                <i class="fas fa-user-plus"></i> Tambah Guru
            </a>
        </div>
        
        <!-- Alert Section -->
        <?php if(isset($_SESSION['success'])): ?>
            <div class="alert alert-success" role="alert">
                <strong>Sukses!</strong> <?php echo $_SESSION['success']; unset($_SESSION['success']); ?>
            </div>
        <?php elseif(isset($_SESSION['error'])): ?>
            <div class="alert alert-danger" role="alert">
                <strong>Error!</strong> <?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
            </div>
        <?php endif; ?>

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
                    <?php foreach($guru as $no => $item): ?>
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
                                    <a href="{{ route('edit.guru', $item->id) }}" class="btn btn-sm btn-warning me-2">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>&nbsp;&nbsp;
                                    <form action="{{ route('delet.guru', $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
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
</body>
</html>