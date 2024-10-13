<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Guru</title>
    <link href="{{ asset('assets/img/favicon.png') }}" rel="icon">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .profile-container {
            max-width: 1100px;
            margin: auto;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.4);
            overflow: hidden;
            margin-top: 30px;
        }
        .profile-header {
            display: flex;
            align-items: center;
            background-color: #4a6670;
            padding: 30px;
            color: white;
            text-align: left;
            position: relative;
            height: 200px;
        }
        .profile-header img {
            border-radius: 50%;
            width: 120px;
            height: 120px;
            object-fit: cover;
            background-color: white;
            margin-right: 20px;
        }
        .profile-header h2 {
            margin: 0;
            font-size: 32px;
        }
        .profile-body {
            padding: 20px;
        }
        .form-group {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }
        .form-group label {
            width: 150px;
            font-size: 14px;
            color: #333;
            margin-right: 10px;
        }
        .form-group input {
            width: calc(100% - 170px);
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }
        .tabs {
            display: flex;
            justify-content: space-around;
            background-color: #f1f1f1;
            padding: 10px 0;
        }
        .tabs a {
            text-decoration: none;
            padding: 10px 20px;
            color: #333;
            border-bottom: 2px solid transparent;
        }
        .tabs a.active {
            border-bottom: 2px solid #4a6670;
            color: #4a6670;
        }
        .alert {
            background-color: #f9f9f9;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
            color: #555;
            width: calc(100% - 170px);
        }
        .text-right {
            text-align: right;
        }
        .btn {
            text-decoration: none;
            background-color: #4a6670;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            margin-left: 10px;
        }
        .btn-warning {
            background-color: orange;
            padding: 5px 10px;
            font-size: 12px;
        }
        .btn-sm {
            padding: 5px 10px;
            font-size: 12px;
        }
    </style>
</head>
<body>
<div class="profile-container">
    <div class="profile-header">
        <img src="{{ $user->photo ? asset('storage/' . $user->photo) : asset('assets/img/default-avatar.png') }}" alt="Profile Picture">
        <h2>Profil</h2>
    </div>
    <div class="tabs">
        <a class="active">Lihat Profil</a>
    </div>
    <div class="profile-body">
        <!-- Nama -->
        <div class="form-group">
            <label for="name">Nama</label>
            <input type="text" id="name" value="{{ $user->name }}" readonly>
        </div>

        <!-- NIP -->
        <div class="form-group">
            <label for="nip">NIP</label>
            <input type="text" id="nip" value="{{ $user->nis }}" readonly>
        </div>
                <!-- Judul -->
        <div class="form-group">
            <label for="judul">Mengajar</label>
            @if($user->judul)
                <input type="text" id="judul" value="{{ $user->judul }}" readonly>
            @else
                <div class="alert">
                    Mengajar belum diisi.
                </div>
            @endif
        </div>
        <!-- Sebagai -->
        <div class="form-group">
            <label for="role">Sebagai</label>
            <input type="text" id="role" value="{{ $user->role }}" readonly>
        </div>

        <!-- Alamat -->
        <div class="form-group">
            <label for="alamat">Alamat</label>
            @if($user->alamat)
                <input type="text" id="alamat" value="{{ $user->alamat }}" readonly>
            @else
                <div class="alert">
                    Alamat belum diisi.
                </div>
            @endif
        </div>

        <!-- Nomor HP -->
        <div class="form-group">
            <label for="nohp">Nomor HP</label>
            @if($user->nohp)
                <input type="text" id="nohp" value="{{ $user->nohp }}" readonly>
            @else
                <div class="alert">
                    Nomor HP belum diisi.
                </div>
            @endif
        </div>
        <!-- Tombol Aksi -->
        <div class="text-right">
            <a href="{{ route('guru.dashboard') }}" class="btn">Kembali</a>
            <a href="{{ route('guru.profiles.edit', $user->id) }}" class="btn">Edit Profil</a>
        </div>  
    </div>
</div>
</body>
</html>