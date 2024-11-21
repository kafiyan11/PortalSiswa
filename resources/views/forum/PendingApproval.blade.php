@extends('layouts.app')

@section('content')
    <h1 class="mb-4 text-center" style="font-weight: 700; font-size: 2.5rem; color: #4A4A4A;">Daftar Postingan Menunggu Persetujuan</h1>

    @if(session('status'))
        <div class="alert alert-success text-center" style="font-size: 1.1rem;">{{ session('status') }}</div>
    @endif

    <div class="row justify-content-center">
        @foreach($pendingPosts as $post)
            <div class="col-lg-5 col-md-6 mb-4">
                <div class="card shadow-sm" style="border-radius: 10px;">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <!-- Foto Profil -->
                            <img src="{{ $post->user->photo ? asset('storage/' . $post->user->photo) : 'https://via.placeholder.com/50' }}" alt="profile" class="rounded-circle me-3" style="width: 55px; height: 55px; object-fit: cover;">
                            
                            <!-- Konten Postingan -->
                            <div>
                                <p class="card-text mb-1"><strong>Nama: </strong>{{ $post->user->name }}</p>
                                <p class="card-text mb-1 text-muted"><strong>Role:</strong> {{ $post->user->role ?? 'Role tidak ditemukan' }}</p>
                                <h5 class="card-title mt-2 mb-0" style="font-size: 0.85rem; color: #333;">Caption : {{ $post->content }}</h5> <!-- Ukuran teks lebih kecil -->
                            </div>
                        </div>

                        <!-- Gambar Postingan -->
                        @if($post->image)
                            <img src="{{ asset('storage/' . $post->image) }}" alt="Image" class="img-fluid rounded mb-3" style="max-height: 300px; object-fit: cover;">
                        @endif

                        <!-- Video Postingan -->
                        @if($post->video)
                            <video src="{{ asset('storage/' . $post->video) }}" controls class="img-fluid rounded mb-3" style="max-height: 300px; object-fit: cover;"></video>
                        @endif

                        <!-- Tombol Setujui dan Tidak Setujui -->
                        <div class="text-center mt-4">
                            <form action="{{ route('posts.approve', $post->id) }}" method="POST" style="display: inline;">
                                @csrf
                                <button type="submit" class="btn btn-success btn-sm me-2" style="font-size: 0.9rem; padding: 0.5rem 1.5rem;">
                                    <i class="fas fa-check-circle me-1"></i> Setujui
                                </button>
                            </form>

                            <form action="{{ route('posts.reject', $post->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Apakah Anda yakin ingin menolak dan menghapus postingan ini?');">
                                @csrf
                                <button type="submit" class="btn btn-danger btn-sm" style="font-size: 0.9rem; padding: 0.5rem 1.5rem;">
                                    <i class="fas fa-times-circle me-1"></i> Tidak Setujui
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection  
