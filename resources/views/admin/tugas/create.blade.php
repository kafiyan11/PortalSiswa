<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Tugas</title>
    <link href="{{ asset('assets/img/favicon.png') }}" rel="icon">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f8f9fa;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding: 20px;
        }

        .form-container {
            background-color: #ffffff;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            padding: 40px;
            max-width: 500px;
            width: 100%;
            margin-top: 100px;
            margin-left: 250px;
        }

        .form-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .form-header h2 {
            font-weight: 700;
            color: #343a40;
            position: relative;
            display: inline-block;
        }

        .form-header h2::after {
            content: '';
            width: 60px;
            height: 3px;
            background-color: #0d6efd;
            display: block;
            margin: 8px auto 0;
            border-radius: 2px;
        }

        .form-label {
            font-weight: 500;
            color: #495057;
        }

        .form-control {
            border-radius: 8px;
            padding: 12px 14px;
            border: 1px solid #ced4da;
            transition: border-color 0.3s, box-shadow 0.3s;
        }

        .form-control:focus {
            border-color: #0d6efd;
            box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
        }

        .input-group-text {
            background-color: #0d6efd;
            color: #ffffff;
            border: none;
            border-radius: 8px 0 0 8px;
        }

        .btn-submit {
            background-color: #0d6efd;
            border-color: #0d6efd;
            border-radius: 8px;
            padding: 12px;
            font-size: 16px;
            font-weight: 600;
            transition: background-color 0.3s, transform 0.3s;
            width: 100%;
        }

        .btn-submit:hover {
            background-color: #0b5ed7;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(13, 110, 253, 0.3);
        }

        .alert-custom {
            border-left: 5px solid #dc3545;
            padding: 15px 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            background-color: #f8d7da;
            color: #842029;
        }

        /* Responsive Adjustments */
        @media (max-width: 576px) {
            .form-container {
                padding: 30px 20px;
            }

            .form-header h2::after {
                width: 40px;
            }
        }
    </style>
</head>
<body>
    @extends("layouts.app")
    @section('content')
    <div class="form-container">
        <div class="form-header">
            <h2>Tambah Tugas</h2>
        </div>
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-custom">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('admin.create') }}" method="POST" enctype="multipart/form-data" novalidate>
                @csrf
                @method('post')
                <div class="mb-4">
                    <label for="nis" class="form-label">NIS</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-card-text"></i></span>
                        <input type="text" class="form-control" id="nis" name="nis" placeholder="Masukkan NIS" required>
                    </div>
                </div>
                <div class="mb-4">
                    <label for="nama" class="form-label">Nama</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-person"></i></span>
                        <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan Nama" required>
                    </div>
                </div>
                <div class="mb-4">
                    <label for="kelas" class="form-label">Kelas</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-book"></i></span>
                        <input type="text" class="form-control" id="kelas" name="kelas" placeholder="Masukkan Kelas" required>
                    </div>
                </div>
                <div class="mb-4">
                    <label for="gambar_tugas" class="form-label">Gambar</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-image"></i></span>
                        <input type="file" class="form-control" id="gambar_tugas" name="gambar_tugas" accept="image/*" required>
                    </div>
                </div>
                <button type="submit" class="btn btn-submit">Simpan Data</button>
            </form>
        </div>
    </div>
    @endsection
    <!-- Bootstrap JS (Optional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
