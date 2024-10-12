@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Profil</h2>
    <div class="card">
        <div class="card-body">
            <form action="{{ route('guru.profiles.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Nama (readonly) -->
                <div class="form-group">
                    <label for="name">Nama</label>
                    <input type="text" name="name" class="form-control" value="{{ $user->name }}" readonly>
                </div>

                {{-- Bagian Kelas hanya ditampilkan jika user bukan Guru --}}
                @if($user->role !== 'Guru')
                <div class="form-group">
                    <label for="tahun">Tahun</label>
                    <select id="tahun" name="tahun" class="form-control" onchange="updateKelasOptions()">
                        <option value="" disabled selected>Pilih Tahun</option>
                        <option value="X" {{ substr($user->kelas, 0, 1) === 'X' ? 'selected' : '' }}>X</option>
                        <option value="XI" {{ substr($user->kelas, 0, 2) === 'XI' ? 'selected' : '' }}>XI</option>
                        <option value="XII" {{ substr($user->kelas, 0, 3) === 'XII' ? 'selected' : '' }}>XII</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="jenis_kelas">Jenis Kelas</label>
                    <select id="jenis_kelas" name="jenis_kelas" class="form-control" onchange="updateNomorOptions()" {{ $user->kelas ? '' : 'disabled' }}>
                        <option value="" disabled selected>Pilih Jenis Kelas</option>
                        <option value="TKRO" {{ strpos($user->kelas, 'TKRO') !== false ? 'selected' : '' }}>TKRO</option>
                        <option value="TKJ" {{ strpos($user->kelas, 'TKJ') !== false ? 'selected' : '' }}>TKJ</option>
                        <option value="RPL" {{ strpos($user->kelas, 'RPL') !== false ? 'selected' : '' }}>RPL</option>
                        <option value="MP" {{ strpos($user->kelas, 'MP') !== false ? 'selected' : '' }}>MP</option>
                        <option value="AKL" {{ strpos($user->kelas, 'AKL') !== false ? 'selected' : '' }}>AKL</option>
                        <option value="DPIB" {{ strpos($user->kelas, 'DPIB') !== false ? 'selected' : '' }}>DPIB</option>
                        <option value="SK" {{ strpos($user->kelas, 'SK') !== false ? 'selected' : '' }}>SK</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="nomor">Nomor Kelas</label>
                    <select id="nomor" name="nomor" class="form-control" {{ $user->kelas ? '' : 'disabled' }}>
                        <option value="" disabled selected>Pilih Nomor Kelas</option>
                        <option value="1" {{ strpos($user->kelas, '1') !== false ? 'selected' : '' }}>1</option>
                        <option value="2" {{ strpos($user->kelas, '2') !== false ? 'selected' : '' }}>2</option>
                        <option value="3" {{ strpos($user->kelas, '3') !== false ? 'selected' : '' }}>3</option>
                    </select>
                </div>

                <!-- Hidden input untuk kelas -->
                <input type="hidden" name="kelas" id="kelas_hidden" value="{{ $user->kelas }}">
                @endif

                <!-- NIP atau NIS (readonly) -->
                <div class="form-group">
                    @if($user->role === 'Guru')
                        <label for="nip">NIP</label>
                        <input type="text" name="nip" class="form-control" value="{{ $user->nis }}" readonly>
                    @else
                        <label for="nis">NIS</label>
                        <input type="text" name="nis" class="form-control" value="{{ $user->nis }}" readonly>
                    @endif
                </div>
                @if($user->role === 'Guru')
                <div class="form-group">
                    <label for="judul">Mengajar</label>
                    <input type="text" name="judul" class="form-control" value="{{ $user->judul }}">
                    <small class="form-text text-muted">Misalnya mata pelajaran yang Anda ajarkan.</small>
                </div>
                @endif
                
                <!-- Alamat -->
                <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <input type="text" name="alamat" class="form-control" value="{{ $user->alamat }}">
                </div>

                <!-- Nomor HP -->
                <div class="form-group">
                    <label for="nohp">No HP</label>
                    <input type="text" name="nohp" class="form-control" value="{{ $user->nohp }}">
                </div>

                <!-- Judul (hanya untuk Guru) -->

                <!-- Foto Profil -->
                <div class="form-group">
                    <label for="photo">Foto Profil</label>
                    <input type="file" name="photo" class="form-control">
                    @if($user->photo)
                        <img src="{{ asset('storage/' . $user->photo) }}" alt="Foto Profil" class="img-thumbnail mt-2" width="150">
                    @endif
                </div>
                
                <a href="{{ route('guru.profil') }}" class="btn btn-danger">Kembali</a>
                <button type="submit" class="btn btn-primary">Perbarui Profil</button>
            </form>
        </div>
    </div>
</div>

<style>
    /* Tambahkan style tambahan jika diperlukan */
    .img-thumbnail {
        border-radius: 50%;
    }
</style>

<script>
    function updateKelasOptions() {
        document.getElementById('jenis_kelas').disabled = false;
        // Reset jenis_kelas dan nomor kelas jika tahun diubah
        document.getElementById('jenis_kelas').selectedIndex = 0;
        document.getElementById('nomor').selectedIndex = 0;
        document.getElementById('nomor').disabled = true;
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

    // Jika kelas sudah diisi, aktifkan jenis_kelas dan nomor kelas
    document.addEventListener('DOMContentLoaded', function() {
        @if($user->kelas)
            document.getElementById('jenis_kelas').disabled = false;
            document.getElementById('nomor').disabled = false;
        @endif
    });
</script>
@endsection
