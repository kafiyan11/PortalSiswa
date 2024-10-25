<head>
    <title>Edit Profil | Portal Siswa</title>
</head>@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Profil </h2>
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.profiles.update', Auth::user()->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="name">Nama Lengkap</label>
                    <input type="text" name="name" class="form-control" value="{{ Auth::user()->name }}">
                </div>
                
                <div class="form-group">
                    @if(Auth::user()->role === 'Guru')
                        <label for="nip">NIP</label>
                        <input type="text" name="nip" class="form-control" value="{{ Auth::user()->nip }}">
                    @else
                        <label for="nis">NIS</label>
                        <input type="text" name="nis" class="form-control" value="{{ Auth::user()->nis }}">
                    @endif
                </div>
                


                <div class="form-group">
                    <label for="nohp">No HP</label>
                    <input type="text" name="nohp" class="form-control" value="{{ Auth::user()->nohp }}">
                </div>

                <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <input type="text" name="alamat" class="form-control" value="{{ Auth::user()->alamat }}">
                </div>

                <div class="form-group">
                    <label for="role">Sebagai</label>
                    <input type="text" name="role" class="form-control" value="{{ Auth::user()->role }}" readonly>
                </div>

                <div class="form-group">
                    <label for="photo">Foto Profil</label>
                    <input type="file" name="photo" class="form-control">
                    @if(Auth::user()->photo)
                        <img src="{{ asset('storage/' . Auth::user()->photo) }}" alt="Profile Picture" class="profile-picture"
                        style="width: 150px; height: 150px; object-fit: cover; border-radius: 50%; border: 2px solid #ddd; padding: 5px;">
                    @endif
                </div>

                <button type="submit" class="btn btn-primary">Update Profil</button>
            </form>
        </div>
    </div>
</div>

<style>
    /* Style yang sudah ada tetap digunakan */
</style>

<script>
    function updateKelasOptions() {
        // Aktifkan dropdown jurusan ketika kelas dipilih
        const kelas = document.getElementById('kelas').value;
        const jurusan = document.getElementById('jurusan');
        
        if (kelas) {
            jurusan.disabled = false;
        } else {
            jurusan.disabled = true;
        }
    }

    function updateNomorOptions() {
        // Aktifkan dropdown nomor kelas ketika jurusan dipilih
        const jurusan = document.getElementById('jurusan').value;
        const nomor = document.getElementById('nomor');
        
        if (jurusan) {
            nomor.disabled = false;
        } else {
            nomor.disabled = true;
        }
    }

    function getSelectedKelas() {
        const kelas = document.getElementById('kelas').value;
        const jurusan = document.getElementById('jurusan').value;
        const nomor = document.getElementById('nomor').value;

        if (kelas && jurusan && nomor) {
            document.getElementById('kelas_hidden').value = `${kelas} ${jurusan} ${nomor}`;
        }
    }

    document.getElementById('jurusan').addEventListener('change', getSelectedKelas);
    document.getElementById('nomor').addEventListener('change', getSelectedKelas);
</script>
@endsection
