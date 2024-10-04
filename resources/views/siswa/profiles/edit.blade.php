@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Profile</h2>
    <div class="card">
        <div class="card-body">
            <form action="{{ route('siswa.profiles.update', Auth::user()->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" class="form-control" value="{{ Auth::user()->name }}" readonly>
                </div>

                <div class="form-group">
                    @if(Auth::user()->role === 'Guru')
                        <label for="nip">NIP</label>
                        <input type="text" name="nip" class="form-control" value="{{ Auth::user()->nis }}" readonly>
                    @else
                        <label for="nis">NIS</label>
                        <input type="text" name="nis" class="form-control" value="{{ Auth::user()->nis }}" readonly>
                    @endif
                </div>

                {{-- Bagian kelas hanya ditampilkan jika user bukan Guru --}}
                @if(Auth::user()->role !== 'Guru')
                <div class="form-group">
                    <label for="kelas">Kelas</label>
                    <select id="kelas" name="kelas" class="form-control" onchange="updateKelasOptions()">
                        <option value="" disabled selected>Pilih Kelas</option>
                        <option value="X">X</option>
                        <option value="XI">XI</option>
                        <option value="XII">XII</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="jurusan">Jurusan</label>
                    <select id="jurusan" name="jurusan" class="form-control" onchange="updateNomorOptions()" disabled>
                        <option value="" disabled selected>Pilih Jurusan</option>
                        <option value="TKRO">TKRO</option>
                        <option value="TKJ">TKJ</option>
                        <option value="RPL">RPL</option>
                        <option value="MP">MP</option>
                        <option value="AKL">AKL</option>
                        <option value="DPIB">DPIB</option>
                        <option value="SK">SK</option>
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
                @endif

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
