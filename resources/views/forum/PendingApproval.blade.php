@extends('layouts.app')

@section('content')
    <h1 class="mb-4 text-center" >Daftar Postingan Menunggu Persetujuan</h1>

    @if(session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
    @endif

    <div class="row">
        @foreach($pendingPosts as $post)
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <!-- Foto Profil -->
                            <img src="{{ $post->user->photo ? asset('storage/' . $post->user->photo) : 'https://via.placeholder.com/50' }}" alt="profile" class="rounded-circle me-3" style="width: 50px; height: 50px;">
                            <!-- Konten Postingan -->
                            <div>
                                <h5 class="card-title">{{ $post->content }}</h5>
                                <p class="card-text"><strong>Nama Siswa: </strong>{{ $post->user->name }}</p>
                            </div>
                        </div>

                        <!-- Gambar Postingan -->
                        @if($post->image)
                            <img src="{{ asset('storage/' . $post->image) }}" alt="Image" class="img-fluid mt-2 mb-2">
                        @endif

                        <!-- Video Postingan -->
                        @if($post->video)
                            <video src="{{ asset('storage/' . $post->video) }}" controls class="img-fluid mt-2 mb-2"></video>
                        @endif

                        <!-- Tombol Setujui dan Tidak Setujui -->
                        <div class="mt-3">
                            <form action="{{ route('posts.approve', $post->id) }}" method="POST" style="display: inline;">
                                @csrf
                                <button type="submit" class="btn btn-success me-2">
                                    <i class="fas fa-check-circle"></i> Setujui
                                </button>
                            </form>

                            <form action="{{ route('posts.reject', $post->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Apakah Anda yakin ingin menolak dan menghapus postingan ini?');">
                                @csrf
                                <button type="submit" class="btn btn-danger">
                                    <i class="fas fa-times-circle"></i> Tidak Setujui
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
