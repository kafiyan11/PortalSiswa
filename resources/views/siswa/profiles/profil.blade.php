<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil</title>
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
        }
        .btn-warning {
            background-color: orange;
        }
    </style>
</head>
<body>
<div class="profile-container">   
    <div class="profile-header">
        <img src="{{ Auth::user()->photo ? asset('storage/' . Auth::user()->photo) : asset('default-avatar.png') }}" alt="Profile Picture">
        <h2>Profil</h2>
    </div>
    <div class="tabs">
        <a href="#" class="active">Lihat Profil</a>
    </div>
    <div class="profile-body">
        <div class="form-group">
            <label for="name">Nama</label>
            <input type="text" id="name" value="{{ Auth::user()->name }}" readonly>
        </div>
        <div class="form-group">
            <label for="nis">NIS</label>
            <input type="text" id="nis" value="{{ Auth::user()->nis }}" readonly>
        </div>
        <div class="form-group">
            <label for="role">Sebagai</label>
            <input type="text" id="role" value="{{ Auth::user()->role }}" readonly>
        </div>
        
        <!-- Bagian Kelas - hanya tampil jika bukan guru -->
        @if(Auth::user()->role !== 'guru')
            <div class="form-group">
                <label for="kelas">Kelas</label>
                <input type="text" id="kelas" value="{{ Auth::user()->kelas }}" readonly>
            </div>
        @endif

        <!-- Bagian Alamat -->
        <div class="form-group">
            <label for="alamat">Alamat</label>
            @if(Auth::user()->alamat)
                <input type="text" id="alamat" value="{{ Auth::user()->alamat }}" readonly>
            @else
                <div class="alert">
                    Alamat belum diisi. 
                    <a href="{{ route('profiles.edit', Auth::user()->id) }}" class="btn btn-sm btn-warning">Edit Alamat</a>
                </div>
            @endif
        </div>

        <!-- Bagian Nomer HP -->
        <div class="form-group">
            <label for="nohp">Nomer Hp</label>
            @if(Auth::user()->nohp)
                <input type="text" id="nohp" value="{{ Auth::user()->nohp }}" readonly>
            @else
                <div class="alert">
                    No HP belum diisi.
                    <a href="{{ route('profiles.edit', Auth::user()->id) }}" class="btn btn-sm btn-warning">Edit No HP</a>
                </div>
            @endif
        </div>
        <div class="text-right">
            @if(Auth::user()->role === 'guru')
                <a href="{{ route('guru.dashboard') }}" class="btn btn-primary">Go Back</a>
            @elseif(Auth::user()->role === 'siswa')
                <a href="{{ route('siswa.dashboard') }}" class="btn btn-primary">Go Back</a>
            @elseif(Auth::user()->role === 'admin')
                <a href="{{ route('admin.dashboard') }}" class="btn btn-primary">Go Back</a>
            @else
                <a href="{{ route('home') }}" class="btn btn-primary">Go Back</a> <!-- Default fallback link -->
            @endif
        
            <a href="{{ route('profiles.edit', Auth::user()->id) }}">Edit Profile</a>
        </div>
    </div>
</div>

</body>
</html>
