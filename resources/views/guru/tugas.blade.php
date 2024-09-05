<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Tugas Siswa</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #f7f8fc, #e0e7ff);
            color: #333;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px;
            margin: 0;

        }

        h1 {
            margin-bottom: 50px;
            color: #2c3e50;
            margin-top: 130px; /* Menambahkan jarak dari bagian atas halaman */
        }

        .subject-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            width: 100%;
            max-width: 1200px;
        }

        .subject-box {
            background-color: #fff;
            border-radius: 16px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            padding: 300px 200px;
            text-align: center;
            position: relative;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            cursor: pointer;
            animation: fadeIn 0.8s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .subject-box:hover {
            transform: translateY(-10px);
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.15);
        } 

        .subject-box img {
            width: 50px;
            height: 50px;
            margin-bottom: 15px;
            transition: transform 0.3s ease;
        }

        .subject-box:hover img {
            transform: scale(1.1);
        }

        .subject-box h2 {
            font-size: 1.6rem;
            margin-bottom: 10px;
            color: #2980b9;
        }

        .subject-box p {
            font-size: 1rem;
            color: #7f8c8d;
        }

        .new-assignment {
            position: absolute;
            top: 10px;
            right: 10px;
            background-color: #e74c3c;
            color: #fff;
            border-radius: 50%;
            padding: 8px;
            font-size: 0.9rem;
            font-weight: bold;
        }

        @media (max-width: 1000px) {
            h1 {
                font-size: 2rem;
            }
        }

        /* Delay untuk setiap box */
        .subject-box:nth-child(1) {
            animation-delay: 0.1s;
        }

        .subject-box:nth-child(2) {
            animation-delay: 0.2s;
        }

        .subject-box:nth-child(3) {
            animation-delay: 0.3s;
        }

        .subject-box:nth-child(4) {
            animation-delay: 0.4s;
        }

        .subject-box:nth-child(5) {
            animation-delay: 0.5s;
        }

        .subject-box:nth-child(6) {
            animation-delay: 0.6s;
        }

        .subject-box:nth-child(7) {
            animation-delay: 0.7s;
        }
        .wrapper {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .content-wrapper {
            flex: 1;
            animation: fadeIn 1s ease-in-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .table img {
            max-width: 100px;
            height: auto;
            border-radius: 5px;
        }

        @media (max-width: 767px) {
        .sidebar-mini .main-sidebar {
            width: 100%;
            padding-bottom: 20px;
            }
        .table thead {
            display: none;
            }
        .table tbody tr {
            display: block;
            margin-bottom: 15px;
            }
        .table tbody td {
            display: block;
            text-align: right;
            font-size: 14px;
            position: relative;
            padding-left: 50%;
            }
        .table tbody td::before {
            content: attr(data-label);
            position: absolute;
            left: 0;
            width: 45%;
            padding-left: 15px;
            font-weight: bold;
            text-align: left;
            }
        }
    </style>
</head>
<body>
    @include('layouts.app')
    <h1>Data Tugas Siswa</h1>
    <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                         <div class="col-sm-6">
                            
                        </div> 
                    </div>
                </div>
            </div>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="card animate__animated animate__fadeInUp">
                        <!-- <div class="input-group">
                            <div class="form-outline">
                                <input type="text" id="form1" name="cari" class="form-control" placeholder="Search">
                            </div>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-search"></i>
                            </button>
                        </div> -->
                        <div class="card-header">
                            @if(auth()->user()->role == 'Guru')
                            <form action="{{route('siswa.cari')}}" method="GET">
                            <div class="input-group">
                            <a href="{{ route('guru.addTugas') }}" class="btn btn-primary">Tambah</a>&nbsp;&nbsp;&nbsp;
                            <div class="form-outline">
                                <input type="text" id="form1" name="cari" class="form-control" placeholder="Search">
                            </div>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-search"></i>
                            </button>
                            </form>
               
                            @endif
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>NO</th>
                                        <th>NIS</th>
                                        <th>Nama</th>
                                        <th>Kelas</th>
                                        <th>Jurusan</th>
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
                                        <td>{{ $siswas->jurusan }}</td>
                                        <td>
                                            @if ($siswas->gambar_tugas)
                                                <img src="{{ asset('gambar_tugas/' . $siswas->gambar_tugas) }}" alt="Gambar Tugas" width="100">
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{route ('edit_tugas', $siswas->id)  }}" class="btn btn-warning btn-sm">Edit</a>
                                            <form action="{{ route('tugas.destroy', $siswas->id) }}" method="POST" style="display:inline;">
                                             @csrf
                                             @method('DELETE')
                                             <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                            </form>

                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </section>
        </div>
</body>
</html>