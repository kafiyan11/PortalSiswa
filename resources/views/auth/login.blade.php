<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Portal Siswa</title>
    <link href="assets/img/favicon.png" rel="icon">
    
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    
    <!-- SweetAlert2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    
    <!-- Custom CSS -->
    <style>
        /* Mengatur tampilan dasar body */
        body {
            background: #f2f3f5; /* Warna latar belakang */
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; /* Font yang digunakan */
            justify-content: center; /* Menengahkan secara horizontal */
            align-items: center; /* Menengahkan secara vertikal */
            min-height: 100vh; /* Tinggi minimal 100% viewport height */
            margin: 0; /* Menghilangkan margin default */
        }

        /* Kontainer utama untuk login */
        .login-container {
            margin: auto;
            max-width: 900px; /* Lebar maksima-l kontainer */
            width: 100%; /* Lebar penuh */
            padding: 20px; /* Padding di dalam kontainer */
            background: white; /* Warna latar belakang putih */
            border-radius: 12px; /* Sudut melengkung */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Bayangan kotak */
            border: 1px solid #ddd; /* Garis tepi */
        }

        /* Header pada kontainer login */
        .login-header {
            text-align: center; /* Teks di tengah */
            margin-bottom: 20px; /* Margin bawah */
        }

        /* Judul header */
        .login-header h3 {
            font-size: 24px; /* Ukuran font */
            color: #333; /* Warna teks */
            font-weight: 600; /* Ketebalan font */
        }

        /* Mengatur tampilan input form */
        .form-control {
            border-radius: 8px; /* Sudut melengkung */
            border: 1px solid #ddd; /* Garis tepi */
            padding: 12px; /* Padding di dalam input */
            font-size: 16px; /* Ukuran font */
            transition: border-color 0.3s ease; /* Transisi saat fokus */
        }

        /* Efek saat input form difokuskan */
        .form-control:focus {
            border-color: #007bff; /* Warna border saat fokus */
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25); /* Bayangan */
        }

        /* Grup input untuk password dengan toggle */
        .input-group {
            position: relative; /* Posisi relatif untuk penempatan toggle */
        }

        /* Tampilan tombol toggle password */
        .input-group .input-group-text {
            background: #f8f9fa; /* Warna latar belakang */
            border: 1px solid #ddd; /* Garis tepi */
            border-radius: 0 8px 8px 0; /* Sudut melengkung kanan */
            cursor: pointer; /* Kursor pointer saat hover */
            transition: background-color 0.3s ease, color 0.3s ease; /* Transisi saat hover */
            position: absolute; /* Posisi absolut */
            top: 50%; /* Vertikal tengah */
            right: 0; /* Posisi kanan */
            transform: translateY(-50%); /* Penyesuaian vertikal */
            width: 50px; /* Lebar tombol */
            height: 100%; /* Tinggi penuh input */
            display: flex; /* Flexbox untuk penempatan ikon */
            align-items: center; /* Penempatan vertikal ikon */
            justify-content: center; /* Penempatan horizontal ikon */
        }

        /* Efek hover pada tombol toggle password */
        .input-group .input-group-text:hover {
            background: #e9ecef; /* Warna latar belakang saat hover */
        }

        /* Tombol utama (Sign in) */
        .btn-primary {
            background: #007bff; /* Warna latar belakang */
            border: none; /* Tanpa border */
            border-radius: 8px; /* Sudut melengkung */
            padding: 12px; /* Padding di dalam tombol */
            font-size: 16px; /* Ukuran font */
            transition: background 0.3s ease, transform 0.3s ease; /* Transisi saat hover */
            width: 100%; /* Lebar penuh */
        }

        /* Efek hover pada tombol utama */
        .btn-primary:hover {
            background: #0056b3; /* Warna latar belakang saat hover */
            transform: scale(1.05); /* Efek memperbesar tombol */
        }

        /* Pembatas (OR) antara form dan social login */
        .divider {
            display: flex; /* Menggunakan Flexbox */
            align-items: center; /* Penempatan vertikal */
            text-align: center; /* Teks di tengah */
            margin: 1.5rem 0; /* Margin atas dan bawah */
        }

        /* Garis sebelum dan sesudah pembatas */
        .divider::before,
        .divider::after {
            content: ''; /* Konten kosong */
            flex: 1; /* Mengisi ruang yang tersedia */
            border-bottom: 1px solid #ddd; /* Garis bawah */
        }

        /* Margin antara teks dan garis */
        .divider:not(:empty)::before {
            margin-right: .5em; /* Margin kanan */
        }

        .divider:not(:empty)::after {
            margin-left: .5em; /* Margin kiri */
        }
    </style>
</head>
<body>
    @include('layouts.app')

    <div class="login-container">
        <div class="login-header">
            <h1>Login</h1>
        </div>
        <div class="container py-5">
            <div class="row d-flex align-items-center justify-content-center">
                <!-- Kolom untuk gambar -->
                <div class="col-md-6 col-lg-5">
                    <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/draw2.webp"
                        class="img-fluid" alt="Phone image">
                </div>
                
                <!-- Kolom untuk form login -->
                <div class="col-md-6 col-lg-7">
                    <form id="loginForm" method="POST" action="{{ route('login') }}"> <!-- Update the route jika diperlukan -->
                        @csrf
                        
                        <!-- Input NIS -->
                        <div class="mb-4">
                            <label for="nis" class="form-label">NIS</label>
                            <input id="nis" type="text" class="form-control @error('nis') is-invalid @enderror" name="nis" value="{{ old('nis') }}" required autofocus>
                            @error('nis')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- Input Password dengan Toggle -->
                        <div class="mb-4">
                            <label for="password" class="form-label">Password</label>
                            <div class="input-group">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required>
                                <span class="input-group-text" id="togglePassword" style="cursor: pointer;">
                                    <i class="fas fa-eye"></i>
                                </span>
                                @error('password')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <!-- Tombol Submit -->
                        <button type="submit" class="btn btn-primary btn-lg btn-block">
                            Login
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS dan dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    
    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>

    <script>
        // Fungsi untuk toggle visibilitas password
        document.getElementById('togglePassword').addEventListener('click', function () {
            const passwordField = document.getElementById('password');
            const passwordIcon = this.querySelector('i');
            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                passwordIcon.classList.remove('fa-eye');
                passwordIcon.classList.add('fa-eye-slash');
            } else {
                passwordField.type = 'password';
                passwordIcon.classList.remove('fa-eye-slash');
                passwordIcon.classList.add('fa-eye');
            }
        });

        // SweetAlert2 untuk penanganan error
        @if(session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: '{{ session('error') }}',
            });
        @endif

        // Menangani error validasi menggunakan SweetAlert2
        @if ($errors->any())
            Swal.fire({
                icon: 'error',
                title: 'Validation Errors',
                html: `
                    <ul style="text-align: left;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                `,
            });
        @endif
    </script>
</body>
</html>
