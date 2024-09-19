<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        .container{
            margin-top: 140px;
        }
    </style>
</head>
<body>
    @extends('layouts.app')

    @if(session('success'))
    <script>
        Swal.fire({
            title: "Good job!",
            text: "{{ session('success') }}", // Mengambil pesan dari session
            icon: "success"
        });
    </script>
    @endif
    <div class="container">
        <h1>Dashboard Guru</h1>
        <p>Selamat datang, {{ Auth::user()->name }}!</p>
        <!-- Konten tambahan untuk guru -->
    </div>
</body>
</html>