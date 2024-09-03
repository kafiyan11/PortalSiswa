<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Bootstrap and FontAwesome -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- Custom Styles -->
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: url('your-background-image.jpg') no-repeat center center fixed;
            background-size: cover;
            background-color: rgb(246, 246, 246);
        }
        .navbar {
            background: linear-gradient(90deg, #ffffff, #ffffff);
            color: rgb(0, 0, 0);
            z-index: 1000;
            width: 100%;
            position: fixed;
            top: 0;
            left: 0;
            box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.3);
        }
        .navbar-brand {
            display: flex;
            align-items: center;
        }
        .navbar-brand img {
            width: 150px;
            height: 60px;
            margin-right: 20px;
            margin-top: 5px;
        }
        .navbar-brand .portal-info {
            line-height: 1.2;
        }
        .navbar-brand .portal-info h1 {
            margin: 0;
            color: black;
        }
        .navbar-brand .portal-info h2 {
            margin: 0;
            font-size: 0.8em;
            text-transform: uppercase;
            color: black;
        }
        .sidebar {
            height: 100vh;
            padding-left: 2px;
            position: fixed;
            top: 0;
            left: 0;
            width: 250px;
            background: white;
            padding-top: 100px;
            z-index: 999;
            transition: width 0.3s ease, background 0.3s ease;
            overflow: hidden;
            border-right: 1px solid #a8acb0;
        }
        .sidebar.collapsed {
            width: 60px;
            background: white;
        }
        .sidebar a {
            color: #000000;
            text-decoration: none;
            padding: 11.5px 22px;
            display: flex;
            align-items: center;
            transition: background-color 0.3s ease, padding 0.3s ease;
        }
        .sidebar a i {
            font-size: 1.5em;
            margin-right: 15px;
        }
        .sidebar a:hover {
            padding: 15px;
            background-color: #888888;
        }
        .main-content {
            margin-left: 250px;
            padding: 20px;
            padding-top: 120px;
            transition: margin-left 0.3s ease;
            position: relative;
            z-index: 1;
        }
        /* .main-content.full-width {
            margin-left: 60px;
        } */
        .title {
            margin-bottom: 20px;
            padding-top: 20px;
            text-align: left;
            color: #333;
            animation: slideInFromBottom 0.5s ease-out;
        }
        .title h1 {
            font-size: 2.5em;
            color: #007bff;
            margin-bottom: 10px;
        }
        .title p {
            font-size: 1.2em;
            color: #6c757d;
        }
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            position: relative;
        }
        .card-header {
            background: linear-gradient(90deg, #007bff, #ffffff);
            color: white;
            padding: 20px;
            text-align: center;
        }
        .card-body {
            padding: 20px;
            background-color: #ffffff;
            color: #333;
        }
        .card-footer {
            background-color: #f8f9fa;
            padding: 15px;
            text-align: center;
        }
        .forum-link {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background-color: #007bff;
            color: white;
            padding: 10px 15px;
            border-radius: 50px;
            text-align: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s ease;
        }
        .forum-link:hover {
            background-color: #0056b3;
            text-decoration: none;
            color: white;
        }
        .forum-link i {
            margin-right: 8px;
        }
        @keyframes slideInFromBottom {
            0% {
                opacity: 0;
                transform: translateY(50px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }
        @media (max-width: 1000px) {
            h1 {
                font-size: 1.8rem;
            }
            .main-content {
                grid-template-columns: repeat(2, 1fr);
                max-width: 600px;
            }
        }
        @media (max-width: 600px) {
            h1 {
                font-size: 1.6rem;
            }
            .main-content {
                grid-template-columns: 1fr;
                max-width: 300px;
            }
        }
    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-lg navbar-dark">
            <a class="navbar-brand" href="#">
                <img src="{{ asset('assets/img/logo2.png') }}" alt="Logo">
                <div class="portal-info">
                    <h1>Portal Siswa</h1>
                    <h2>SMKN 1 KAWALI</h2>
                </div>
            </a>
        </nav>

        <div class="sidebar collapsed" id="sidebar" onmouseover="expandSidebar()" onmouseout="collapseSidebar()">
            <a href="{{ route('admin.dashboard') }}"><i class="fas fa-home"></i> Beranda</a>
            <a href="{{ route('admin.profil') }}"><i class="fas fa-user"></i> Profil</a>
            <a href="{{ route('tambah') }}"><i class="fas fa-user"></i> Tambah Akun</a>
            <a href="{{ route('admin.materi') }}"><i class="fas fa-book"></i> Materi Pelajaran</a>
            <a href="{{ route('admin.jadwal') }}"><i class="fas fa-calendar-alt"></i> Jadwal Pelajaran</a>
            <a href="#tugas"><i class="fas fa-tasks"></i> Tugas</a>
            <a href="#grades"><i class="fas fa-graduation-cap"></i> Nilai</a>
            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fas fa-sign-out-alt"></i> Log Out
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </div>

        <main class="main-content" id="main-content">
            @yield('content')
        </main>
    </div>

    <script>
        function expandSidebar() {
            var sidebar = document.getElementById('sidebar');
            sidebar.classList.remove('collapsed');
            document.getElementById('main-content').classList.add('full-width');
        }

        function collapseSidebar() {
            var sidebar = document.getElementById('sidebar');
            sidebar.classList.add('collapsed');
            document.getElementById('main-content').classList.remove('full-width');
        }

        document.getElementById('sidebar').addEventListener('mouseover', expandSidebar);
        document.getElementById('sidebar').addEventListener('mouseout', collapseSidebar);
    </script>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
