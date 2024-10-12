<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil</title>
    <link href="assets/img/favicon.png" rel="icon">
    
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    
    <!-- SweetAlert2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    
    <!-- Custom CSS -->
    <style>
        /* Mengatur tampilan dasar body */
        body {
            font-family: Arial, sans-serif; /* Font yang digunakan */
            background-color: #f4f7f6; /* Warna latar belakang */
            margin: 0; /* Menghilangkan margin default */
            padding: 0; /* Menghilangkan padding default */
            padding-top: 50px; /* Menambahkan padding atas untuk menghindari navbar */
            margin-top: 20px;
        }

        /* Kontainer utama profil */
        .profile-container {
            max-width: 1100px; /* Lebar maksimal kontainer */
            margin: auto; /* Menengahkan kontainer */
            background-color: white; /* Warna latar belakang putih */
            border-radius: 10px; /* Sudut melengkung */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Bayangan kotak */
            overflow: hidden; /* Menghindari overflow */
            padding: 20px; /* Padding di dalam kontainer */
        }

        /* Breadcrumb */
        .main-breadcrumb {
            background-color: #f8f9fa; /* Warna latar belakang breadcrumb */
            padding: 10px 20px; /* Padding di dalam breadcrumb */
            border-radius: 5px; /* Sudut melengkung breadcrumb */
            margin-bottom: 20px; /* Margin bawah breadcrumb */
        }

        /* Header profil */
        .profile-header {
            display: flex; /* Menggunakan Flexbox */
            align-items: center; /* Menyelaraskan item secara vertikal */
            background-color: #4a6670; /* Warna latar belakang header */
            padding: 30px; /* Padding di dalam header */
            color: white; /* Warna teks */
            text-align: left; /* Teks di sebelah kiri */
            position: relative; /* Posisi relatif */
            height: 200px; /* Tinggi header */
            border-radius: 10px; /* Sudut melengkung */
        }

        /* Gambar profil */
        .profile-header img {
            border-radius: 50%; /* Membuat gambar bulat */
            width: 150px; /* Lebar gambar */
            height: 150px; /* Tinggi gambar */
            background-color: white; /* Latar belakang gambar */
            margin-right: 20px; /* Margin kanan */
            object-fit: cover; /* Memastikan gambar menutupi area tanpa distorsi */
        }

        /* Judul profil */
        .profile-header h2 {
            margin: 0; /* Menghilangkan margin */
            font-size: 32px; /* Ukuran font */
        }

        /* Navigasi Tabs */
        .tabs {
            display: flex; /* Menggunakan Flexbox */
            justify-content: space-around; /* Menyebar tabs secara merata */
            background-color: #f1f1f1; /* Warna latar belakang tabs */
            padding: 10px 0; /* Padding atas dan bawah */
            border-radius: 5px; /* Sudut melengkung */
            margin-bottom: 20px; /* Margin bawah tabs */
        }

        /* Link tabs */
        .tabs a {
            text-decoration: none; /* Menghilangkan garis bawah */
            padding: 10px 20px; /* Padding di dalam tabs */
            color: #333; /* Warna teks */
            border-bottom: 2px solid transparent; /* Border bawah transparan */
            transition: border-bottom 0.3s ease, color 0.3s ease; /* Transisi efek */
            font-weight: 600; /* Ketebalan font */
        }

        /* Tab aktif */
        .tabs a.active {
            border-bottom: 2px solid #4a6670; /* Border bawah aktif */
            color: #4a6670; /* Warna teks aktif */
        }

        /* Isi profil */
        .profile-body {
            padding: 20px; /* Padding di dalam body */
        }

        /* Grup form */
        .form-group {
            display: flex; /* Menggunakan Flexbox */
            align-items: center; /* Menyelaraskan item secara vertikal */
            margin-bottom: 20px; /* Margin bawah */
        }

        /* Label form */
        .form-group label {
            width: 150px; /* Lebar label */
            font-size: 14px; /* Ukuran font */
            color: #333; /* Warna teks */
            margin-right: 10px; /* Margin kanan */
        }

        /* Input form */
        .form-group input {
            width: calc(100% - 170px); /* Menghitung lebar input */
            padding: 10px; /* Padding di dalam input */
            border: 1px solid #ccc; /* Garis tepi */
            border-radius: 5px; /* Sudut melengkung */
            font-size: 16px; /* Ukuran font */
        }

        /* Tombol */
        .btn {
            text-decoration: none; /* Menghilangkan garis bawah */
            background-color: #4a6670; /* Warna latar belakang tombol */
            color: white; /* Warna teks tombol */
            padding: 10px 20px; /* Padding di dalam tombol */
            border-radius: 5px; /* Sudut melengkung */
            transition: background-color 0.3s ease; /* Transisi efek */
            margin-right: 10px; /* Margin kanan */
        }

        /* Tombol warning */
        .btn-warning {
            background-color: orange; /* Warna latar belakang */
            color: white; /* Warna teks */
        }

        /* Hover efek untuk tombol */
        .btn:hover {
            background-color: #333; /* Warna latar belakang saat hover */
            color: white; /* Warna teks saat hover */
        }

        /* Tombol khusus */
        .btn-custom {
            background-color: #007bff; /* Warna latar belakang */
            color: #fff; /* Warna teks */
        }

        .btn-custom:hover {
            background-color: #0056b3; /* Warna latar belakang saat hover */
            color: #fff; /* Warna teks tetap */
        }

        /* Alert */
        .alert {
            background-color: #f9f9f9; /* Warna latar belakang */
            padding: 10px; /* Padding di dalam alert */
            border: 1px solid #ccc; /* Garis tepi */
            border-radius: 5px; /* Sudut melengkung */
            font-size: 14px; /* Ukuran font */
            color: #555; /* Warna teks */
            margin-bottom: 20px; /* Margin bawah */
        }

        /* Styling untuk card list sosial */
        .list-group-item h6 {
            display: flex;
            align-items: center;
            font-size: 16px;
        }

        .list-group-item svg {
            margin-right: 8px; /* Margin kanan untuk ikon */
        }

        /* Responsif: Mengubah tampilan pada layar kecil */
        @media (max-width: 768px) {
            .profile-header {
                flex-direction: column; /* Mengubah arah Flexbox */
                height: auto; /* Mengubah tinggi */
                text-align: center; /* Teks di tengah */
            }

            .profile-header img {
                margin-bottom: 10px; /* Margin bawah */
            }

            .form-group {
                flex-direction: column; /* Mengubah arah Flexbox */
                align-items: flex-start; /* Menyelaraskan item ke kiri */
            }

            .form-group label {
                width: 100%; /* Lebar penuh */
                margin-bottom: 5px; /* Margin bawah */
            }

            .form-group input {
                width: 100%; /* Lebar penuh */
            }
            
            .tabs {
                flex-direction: column; /* Mengubah arah Flexbox */
                align-items: center; /* Menyelaraskan item ke tengah */
            }

            .tabs a {
                margin-bottom: 5px; /* Margin bawah */
            }

            .btn {
                width: 100%; /* Lebar penuh */
                margin-bottom: 10px; /* Margin bawah */
            }
            
            .btn:last-child {
                margin-bottom: 0; /* Menghilangkan margin pada tombol terakhir */
            }
        }
        .judul{
            margin-top: 20px;
            margin-left: 50px;
        }
        .poto{
            margin-top: 100px;
            margin-left: 70px;
        }
        /* col-md-4 mb-3 */
        </style>
</head>
<body>    
    <div class="container">
        <div class="card">
            <div class="main-body">
                <div class="row gutters-sm">
                    <!-- Sidebar Profil -->
                    <div class="poto">
                            <div class="card-body">
                                <div class="d-flex flex-column align-items-center text-center">
                                <img src="{{ Auth::user()->photo ? asset('storage/' . Auth::user()->photo) : asset('default-avatar.png') }}" alt="Admin" class="rounded-circle" width="150">
                                <div class="mt-3">
                                    <h4>{{ Auth::user()->name }}</h4>
                                    <h6>{{ Auth::user()->alamat }}</h6>
                                    <hr>
                                </div>
                            </div>
                    </div>
                </div>
                <!-- Bagian Utama Profil -->
                <div class="col-md-8">

                    <div class="judul"><h1>Profil Siswa</h1><br></div>

                    <div class="card mb-3">
                        <div class="card-body">
                            <!-- SweetAlert untuk pesan sukses -->
                            @if(session('success'))
                                <script>
                                    document.addEventListener('DOMContentLoaded', function() {
                                        Swal.fire({
                                            icon: 'success',
                                            title: 'Berhasil',
                                            text: '{{ session('success') }}',
                                            confirmButtonText: 'OK'
                                        });
                                    });
                                    </script>
                            @endif

                            <!-- Menampilkan pesan error jika ada -->
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <!-- Informasi Profil -->
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Nama Lengkap</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    {{ Auth::user()->name }}
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">NIS</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    {{ Auth::user()->nis }}
                                </div>
                            </div>
                            <hr>
                            <!-- Bagian Kelas - hanya tampil jika bukan guru -->
                            @if(Auth::user()->role !== 'guru')
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Kelas</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        {{ Auth::user()->kelas }}
                                    </div>
                                </div>
                                <hr>
                            @endif
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">No Hp</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    {{ Auth::user()->nohp ?? 'Nomor HP Belum Di isi' }}
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Alamat</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    {{ Auth::user()->alamat ?? 'Alamat Belum Di isi' }}
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Sebagai</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    {{ Auth::user()->role }}
                                </div>
                            </div>
                            <hr>
                            <!-- Tombol Aksi -->
                            <div class="row">
                                <div class="col-sm-12">
                                    <a href="{{ route('siswa.dashboard') }}" class="btn btn-primary">Kembali</a>
                                    <a href="{{ route('siswa.profiles.edit', Auth::user()->id) }}" class="btn btn-primary">Edit Profil Siswa</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>

    <!-- Bootstrap JS dan dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    
    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
    <script>
        document.getElementById('photo-upload').addEventListener('change', function(event) {
            const [file] = this.files;
            if (file) {
                const img = this.parentElement.parentElement.querySelector('img');
                img.src = URL.createObjectURL(file);
                img.onload = () => URL.revokeObjectURL(img.src); // Membersihkan URL objek
            }
        });
    </script>
</body>
</html>
