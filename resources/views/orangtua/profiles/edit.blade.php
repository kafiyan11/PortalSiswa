<head>
    <title>Edit Profil | Portal Siswa</title>
</head>@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Edit Profil</h2>

    <!-- Display Validation Errors -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('orangtua.profiles.update', Auth::user()->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Nama Lengkap (Readonly) -->
                <div class="form-group">
                    <label for="name">Nama Lengkap</label>
                    <input type="text" name="name" class="form-control" value="{{ Auth::user()->name }}" readonly>
                </div>

                <!-- NIS (Readonly) -->
                <div class="form-group">
                    <label for="nis">NIS</label>
                    <input type="text" name="nis" class="form-control" value="{{ Auth::user()->nis }}" readonly>
                </div>

                <!-- No HP -->
                <div class="form-group">
                    <label for="nohp">No HP</label>
                    <input type="text" name="nohp" class="form-control" value="{{ old('nohp', Auth::user()->nohp) }}" placeholder="Masukkan No HP">
                </div>

                <!-- Alamat -->
                <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <input type="text" name="alamat" class="form-control" value="{{ old('alamat', Auth::user()->alamat) }}" placeholder="Masukkan Alamat">
                </div>

                <!-- Sebagai (Readonly) -->
                <div class="form-group">
                    <label for="role">Sebagai</label>
                    <input type="text" name="role" class="form-control" value="{{ Auth::user()->role }}" readonly>
                </div>

                <!-- Foto Profil -->
                <div class="form-group">
                    <label for="photo">Foto Profil</label>
                    <input type="file" name="photo" class="form-control-file">
                    @if(Auth::user()->photo)
                        <div class="mt-3">
                            <img src="{{ asset('storage/' . Auth::user()->photo) }}" alt="Foto Profil" class="profile-picture"
                            style="width: 150px; height: 150px; object-fit: cover; border-radius: 50%; border: 2px solid #ddd; padding: 5px;">
                        </div>
                    @endif
                </div>

                <!-- Tombol Submit dan Kembali -->
                <div class="mt-4">
                    <button type="submit" class="btn btn-primary">Update Profil</button>
                    <a href="{{ route('orangtua.dashboard') }}" class="btn btn-secondary ml-2">Kembali</a>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- JavaScript to Limit Selection to 2 -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const select = document.getElementById('students');
        select.addEventListener('change', function () {
            if (this.selectedOptions.length > 2) {
                alert('Anda hanya dapat memilih maksimal 2 siswa.');
                // Deselect the last selected option
                this.options[this.selectedOptions.length - 1].selected = false;
            }
        });
    });
</script>

<style>
    /* Tambahan styling untuk tampilan form */
    .form-group label {
        font-weight: bold;
    }

    .profile-picture {
        margin-top: 10px;
    }

    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
    }

    .btn-primary:hover {
        background-color: #0056b3;
        border-color: #0056b3;
    }

    .btn-secondary {
        background-color: #6c757d;
        border-color: #6c757d;
    }

    .btn-secondary:hover {
        background-color: #5a6268;
        border-color: #545b62;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .btn-secondary {
            margin-top: 10px;
        }
    }
</style>
@endsection
