<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Tugas Siswa | Portal Siswa</title>
    <link href="assets/img/favicon.png" rel="icon">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        .table {
            margin: 0 auto;
            width: 80%;
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

        .btn-primary {
            margin-bottom: 20px;
        }

        .alert {
            margin-top: 20px;
            padding: 15px;
            border-radius: 5px;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .d-flex .input-group {
            max-width: 920px; /* Adjust as needed */
        }

        .search-input {
            border-radius: 25px 0 0 25px;
            border: 2px solid #007bff;
            transition: border-color 0.3s ease-in-out;
        }

        /* Change border color on focus */
        .search-input:focus {
            outline: none;
            border-color: #0056b3;
        }

        .search-btn {
            border-radius: 0 25px 25px 0;
            padding: 8px 20px;
            background-color: #007bff;
            border-color: #007bff;
            transition: background-color 0.3s ease-in-out, transform 0.2s;
        }

        .search-btn:hover {
            background-color: #0056b3;
            border-color: #0056b3;
            transform: scale(1.05);
        }

        .add-btn {
            padding: 8px 20px;
            background-color: #28a745;
            border-color: #28a745;
            transition: background-color 0.3s ease-in-out, transform 0.2s;
        }

        /* Hover effect for add button */
        .add-btn:hover {
            background-color: #218838;
            border-color: #218838;
            transform: scale(1.05);
        }

        /* Icon inside buttons */
        .search-btn i,
        .add-btn i {
            margin-right: 5px;
        }
    </style>
</head>
<body>
    @extends('layouts.app') 

    @section('content') <!-- Start of content section -->
    <div class="container">
        <h1 class="text-center">Data Tugas Siswa</h1>
        
        <!-- Main content -->
        <section class="content">
            <div class="card">
                <div class="card-body">
                    @if(session('success'))
                    <script>
                        Swal.fire({
                            title: "Kerja Bagus!", // Judul popup
                            text: "{{ session('success') }}", // Pesan sukses dari session
                            icon: "success" // Ikon popup (success)
                        });
                    </script>
                    @endif
                
                    @if(auth()->user()->role == 'Guru')
                    <div class="d-flex justify-content-between mb-2">
                        <form action="{{route('siswa.cari')}}" method="GET" class="input-group" style="max-width: 400px;">
                            <input type="text" name="cari" class="form-control search-input" placeholder="Cari tugas...">
                            <div class="input-group-append">
                                <button class="btn btn-primary search-btn" type="submit">
                                    <i class="fas fa-search"></i> Cari
                                </button>
                            </div>
                        </form>
                        <a href="{{ route('guru.addTugas') }}" class="btn btn-primary">
                            <i class="fas fa-plus-circle"></i> Tambah Tugas</a>
                    </div>
                    @endif
                    
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
                            @foreach ($siswa as $no => $siswas)
                            <tr>
                                <td>{{ $no + 1 }}</td>
                                <td>{{ $siswas->nis }}</td>
                                <td>{{ $siswas->nama }}</td>
                                <td>{{ $siswas->kelas }}</td>
                                <td>
                                    <a href="{{ asset('gambar_tugas/' . $siswas->gambar_tugas) }}" target="_blank">
                                        @if ($siswas->gambar_tugas)
                                            <img src="{{ asset('gambar_tugas/' . $siswas->gambar_tugas) }}" alt="Gambar Tugas" width="100"></a>
                                        @endif
                                </td>
                                <td>
                                    <a href="{{ route('edit_tugas', $siswas->id) }}" class="btn btn-sm btn-info">Edit</a>
                                    <button type="button" class="btn btn-sm btn-danger" onclick="confirmDelete('{{ $siswas->id }}')">Hapus</button>
                                    
                                    <!-- Form tersembunyi untuk menghapus materi -->
                                    <form id="delete-form-{{ $siswas->id }}" action="{{ route('guru.tugas.destroy', $siswas->id) }}" method="POST" style="display: none;">
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
        </section>
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
    @endsection <!-- End of content section -->
</body>
</html>
