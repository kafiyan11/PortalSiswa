@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Profile</h2>
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.profile.update', Auth::user()->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" class="form-control" value="{{ Auth::user()->name }}" readonly>
                </div>


                <div class="form-group">
                    @if(Auth::user()->role === 'Admin')
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
    /* Style yang sudah ada tetap digunakan */
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
