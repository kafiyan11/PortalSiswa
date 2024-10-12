<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Jadwal</title>
    <link href="assets/img/favicon.png" rel="icon">
    
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome (Opsional, jika Anda menggunakan ikon) -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    
    <!-- SweetAlert2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    
    <!-- Custom CSS -->
    <style>
        /* Mengatur tampilan dasar body */
        body {
            background-color: #f4f7f6; /* Warna latar belakang */
            color: #333; /* Warna teks */
            padding-top: 200px; /* Menambahkan padding atas pada body */
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; /* Font yang digunakan */
        }
        
        /* Kontainer utama */
        .container {
            background: #fff; /* Warna latar belakang putih */
            border-radius: 8px; /* Sudut melengkung */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Bayangan kotak */
            padding: 20px; /* Padding di dalam kontainer */
            margin-top: 80px; /* Menambahkan jarak atas tambahan */
            margin-bottom: 20px; /* Menambahkan jarak bawah tambahan (opsional) */
        }
        
        /* Styling untuk tabel */
        .table th, .table td {
            vertical-align: middle; /* Vertikal tengah */
        }
        
        /* Tombol custom */
        .btn-custom {
            background-color: #007bff; /* Warna latar belakang */
            color: #fff; /* Warna teks */
        }
        .btn-custom:hover {
            background-color: #0056b3; /* Warna latar belakang saat hover */
            color: #fff; /* Warna teks tetap putih saat hover */
        }
        
        /* Tombol warning */
        .btn-warning {
            background-color: #ffc107; /* Warna latar belakang */
            color: #212529; /* Warna teks */
        }
        .btn-warning:hover {
            background-color: #e0a800; /* Warna latar belakang saat hover */
            color: #212529; /* Warna teks tetap gelap saat hover */
        }
    </style>
</head>
<body>
    @include('layouts.app') <!-- Menyertakan layout utama, seperti navbar -->

    <div class="container mt-4">
        <h1 class="mb-4">Daftar Jadwal</h1>

        <!-- SweetAlert akan dijalankan jika ada session 'success' -->
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

        <!-- Tabel Daftar Jadwal -->
        <table class="table table-striped table-hover">                      
            <thead>
                <tr>
                    <th>Kelas</th>
                    <th>Mata Pelajaran</th>
                    <th>Guru</th>
                    <th>Jam Mulai</th>
                    <th>Jam Selesai</th>
                </tr>
            </thead>
            <tbody>
                @foreach($jadwals as $jadwal)
                    <tr>
                        <td>{{ $jadwal->kelas }}</td>
                        <td>{{ $jadwal->mata_pelajaran }}</td>
                        <td>{{ $jadwal->guru }}</td>
                        <td>{{ $jadwal->jam_mulai }}</td>
                        <td>{{ $jadwal->jam_selesai }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- JavaScript untuk Bootstrap dan SweetAlert -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    
    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
</body>
</html>
