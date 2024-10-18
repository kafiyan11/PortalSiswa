@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Beranda</h1>
    <p>Selamat datang, <strong>{{ Auth::user()->name }}!</strong></p>
    <hr>

    <!-- Biodata Siswa -->
    <div class="biodata-siswa mt-4">
        <h3 class="mb-4">Biodata Siswa</h3>
        
        @if(Auth::user()->children->isEmpty())
        <div class="alert alert-warning" role="alert">
            Tidak ada anak yang terhubung.
        </div>
        @else
        <div class="row">
            @foreach(Auth::user()->children as $child)
                <div class="col-md-6 mb-4">
                    <div class="card shadow-sm p-3">
                        <div class="card-body d-flex align-items-start">
                            <!-- Gambar Profil -->
                            <img src="{{ $child->photo ? asset('storage/' . $child->photo) : asset('images/default-profile.png') }}"  
                                 class="rounded mr-3" 
                                 width="60" 
                                 height="60">
                                
                            <!-- Informasi Biodata -->
                            <div>
                                <div class="mb-1"><strong>Nama:</strong> {{ $child->name }}</div>
                                <div class="mb-1"><strong>NIS:</strong> {{ $child->nis }}</div>
                                <div class="mb-1"><strong>Kelas:</strong> {{ $child->kelas }}</div>
                                <div class="mb-1"><strong>Telepon:</strong> {{ $child->nohp }}</div>
                                <div class="mb-1"><strong>Alamat:</strong> {{ $child->alamat }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            @foreach(Auth::user()->children as $child)
                <div class="col-md-6 mb-4">
                    <div class="card shadow-sm p-3">
                        <div class="card-body d-flex align-items-start">
                            <!-- Gambar Profil -->
                            <img src="{{ $child->photo ? asset('storage/' . $child->photo) : asset('images/default-profile.png') }}"  
                                 class="rounded mr-3" 
                                 width="60" 
                                 height="60">
                                
                            <!-- Informasi Biodata -->
                            <div>
                                <div class="mb-1"><strong>Nama:</strong> {{ $child->name }}</div>
                                <div class="mb-1"><strong>NIS:</strong> {{ $child->nis }}</div>
                                <div class="mb-1"><strong>Kelas:</strong> {{ $child->kelas }}</div>
                                <div class="mb-1"><strong>Telepon:</strong> {{ $child->nohp }}</div>
                                <div class="mb-1"><strong>Alamat:</strong> {{ $child->alamat }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        @endif
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Sukses!',
            text: '{{ session('success') }}',
            confirmButtonText: 'OK'
        });
    @endif
</script>
@endsection
