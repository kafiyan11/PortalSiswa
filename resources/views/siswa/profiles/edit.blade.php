@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Profile</h2>
    <div class="card">
        <div class="card-body">
            <form action="{{ route('profiles.update', Auth::user()->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" class="form-control" value="{{ Auth::user()->name }}" readonly>
                </div>

                <div class="form-group">
                    <label for="kelas">Kelas</label>
                    <select id="tahun" name="tahun" class="form-control" onchange="updateKelasOptions()">
                        <option value="" disabled selected>Pilih Tahun</option>
                        <option value="X">X</option>
                        <option value="XI">XI</option>
                        <option value="XII">XII</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="jenis_kelas">Jenis Kelas</label>
                    <select id="jenis_kelas" name="jenis_kelas" class="form-control" onchange="updateNomorOptions()" disabled>
                        <option value="" disabled selected>Pilih Jenis Kelas</option>
                        <option value="TKRO">TKRO</option>
                        <option value="TKJ">TKJ</option>
                        <option value="RPL">RPL</option>
                        <option value="MP">MP</option>
                        <option value="AKL">AKL</option>
                        <option value="DPIB">DPIB</option>
                        <option value="SK">SK</option>
                        <!-- Tambahkan jenis kelas lain jika ada -->
                    </select>
                </div>

                <div class="form-group">
                    <label for="nomor">Nomor Kelas</label>
                    <select id="nomor" name="nomor" class="form-control" disabled>
                        <option value="" disabled selected>Pilih Nomor Kelas</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                    </select>
                </div>

                <input type="hidden" name="kelas" id="kelas_hidden" value="{{ Auth::user()->kelas }}">

                <div class="form-group">
                    @if(Auth::user()->role === 'Guru')
                        <label for="nip">NIP</label>
                        <input type="text" name="nip" class="form-control" value="{{ Auth::user()->nis }}" readonly>
                    @else
                        <label for="nis">NIS</label>
                        <input type="text" name="nis" class="form-control" value="{{ Auth::user()->nis }}" readonly>
                    @endif
                </div>

                <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <input type="text" name="alamat" class="form-control" value="{{ Auth::user()->alamat }}">
                </div>

                <div class="form-group">
                    <label for="nohp">No HP</label>
                    <input type="text" name="nohp" class="form-control" value="{{ Auth::user()->nohp }}">
                </div>

                <div class="form-group">
                    <label for="photo">Foto Profil</label>
                    <input type="file" name="photo" class="form-control">
                    @if(Auth::user()->photo)
                        <img src="{{ asset('storage/' . Auth::user()->photo) }}" alt="Profile Picture" class="profile-picture">
                    @endif
                </div>

                <button type="submit" class="btn btn-primary">Update Profile</button>
            </form>
        </div>
    </div>
</div>

<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f7fa;
        margin: 0;
        padding: 20px;
    }
    
    .container {
        max-width: 700px;
        margin: 0 auto;
        background-color: #fff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    
    h2 {
        text-align: center;
        color: #333;
        margin-bottom: 30px;
        font-size: 24px;
    }
    
    .card {
        background-color: #fff;
        border: none;
        border-radius: 10px;
        padding: 20px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }
    
    .form-group {
        margin-bottom: 20px;
    }
    
    label {
        font-size: 14px;
        color: #333;
        margin-bottom: 8px;
        display: block;
    }
    
    input[type="text"], input[type="file"] {
        width: 100%;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 5px;
        background-color: #f9f9f9;
        font-size: 14px;
        transition: all 0.3s;
    }
    
    input[type="text"]:focus, input[type="file"]:focus {
        border-color: #3f7dff;
        background-color: #fff;
    }
    
    .btn {
        background-color: #3f7dff;
        color: #fff;
        padding: 12px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        width: 100%;
        font-size: 16px;
        transition: background-color 0.3s;
    }
    
    .btn:hover {
        background-color: #365dcf;
    }
    
    .profile-picture {
        display: block;
        margin-top: 10px;
        border-radius: 50%;
        width: 120px;
        height: 120px;
    }
</style>

<script>
    function updateKelasOptions() {
        document.getElementById('jenis_kelas').disabled = false;
    }

    function updateNomorOptions() {
        document.getElementById('nomor').disabled = false;
    }

    function getSelectedKelas() {
        const tahun = document.getElementById('tahun').value;
        const jenisKelas = document.getElementById('jenis_kelas').value;
        const nomor = document.getElementById('nomor').value;

        if (tahun && jenisKelas && nomor) {
            document.getElementById('kelas_hidden').value = `${tahun} ${jenisKelas} ${nomor}`;
        }
    }

    document.getElementById('jenis_kelas').addEventListener('change', getSelectedKelas);
    document.getElementById('nomor').addEventListener('change', getSelectedKelas);
</script>
@endsection
