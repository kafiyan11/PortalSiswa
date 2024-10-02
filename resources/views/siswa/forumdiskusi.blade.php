@extends('layouts.app')

@section('content')
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            background-color: #f4f6f9;
        }
        .card {
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .card:hover {
            transform: translateY(-5px);
            transition: 0.3s ease-in-out;
        }
        .rounded-circle {
            border: 2px solid #007bff;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            transition: background-color 0.3s;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }
        .comment-box {
            background-color: #f9f9f9;
            border-radius: 10px;
            padding: 10px;
        }
        .input-group .form-control {
            border-radius: 12px;
        }
        .btn {
            border-radius: 12px;
        }
        .img-fluid {
            border-radius: 12px;
        }
        .reply-form {
            display: none;
        }
    </style>
</head>

<div class="container">
    <div class="row justify-content-center">
        <!-- Form buat postingan -->
        <div class="col-md-8 mb-4">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-3">
                            <textarea name="content" class="form-control" rows="3" placeholder="Apa yang Anda pikirkan?" required style="resize: none; border-radius: 12px; background-color: #f7f9fc; padding: 15px;"></textarea>
                        </div>
                        <div class="form-group d-flex justify-content-between mb-3">
                            <label for="image" class="btn btn-outline-primary btn-sm">
                                <i class="fas fa-image"></i> Gambar
                                <input type="file" name="image" accept="image/*" class="form-control-file d-none" id="image">
                            </label>
                            <label for="video" class="btn btn-outline-primary btn-sm">
                                <i class="fas fa-video"></i> Video
                                <input type="file" name="video" accept="video/*" class="form-control-file d-none" id="video">
                            </label>
                        </div>
                        <button type="submit" class="btn btn-primary mt-3 w-100" style="border-radius: 12px;">Post</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Menampilkan postingan -->
        @foreach($posts as $post)
            <div class="col-md-8 mb-4">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center">
                            <!-- Tampilkan foto profil atau placeholder jika tidak ada foto -->
                            <img src="{{ $post->user->photo ? asset('storage/' . $post->user->photo) : 'https://via.placeholder.com/50' }}" 
                                 alt="profile" class="rounded-circle me-3" 
                                 style="width: 50px; height: 50px;">
                            <div>
                                <strong>{{ $post->user->name }}</strong>
                                <br>
                                <span class="text-muted">{{ $post->created_at->diffForHumans() }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <p>{{ $post->content }}</p>

                        <!-- Menampilkan gambar -->
                        @if($post->image)
                            <img src="{{ asset('storage/' . $post->image) }}" alt="image" class="img-fluid rounded mb-3" style="max-width: 100%; height: auto; max-height: 300px;">
                        @endif

                        <!-- Menampilkan video -->
                        @if($post->video)
                            <video width="100%" controls class="rounded mb-3">
                                <source src="{{ asset('storage/' . $post->video) }}" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                        @endif
                    </div>

                    <div class="card-footer bg-white border-0">
                        <!-- Menampilkan komentar -->
                        @foreach($post->comments as $comment)
                            <div class="d-flex mb-3 comment-box">
                                <img src="{{ $comment->user->photo ? asset('storage/' . $comment->user->photo) : 'https://via.placeholder.com/40' }}" alt="profile" class="rounded-circle me-3" style="width: 30px; height: 30px;">
                                <div>
                                    <strong>{{ $comment->user->name }}</strong>
                                    <p class="mb-1">{{ $comment->comment }}</p>
                                    <span class="text-muted" style="font-size: 12px;">{{ $comment->created_at->diffForHumans() }}</span>

                                    <!-- Tombol Balas -->
                                    <button class="btn btn-sm btn-link text-muted" onclick="document.getElementById('reply-form-{{ $comment->id }}').style.display='block'">Balas</button>

                                    <!-- Form Balasan -->
                                    <div id="reply-form-{{ $comment->id }}" class="mt-2 reply-form">
                                        <form action="{{ route('posts.comment.reply', [$post->id, $comment->id]) }}" method="POST">
                                            @csrf
                                            <div class="form-group">
                                                <input type="text" name="comment" class="form-control" placeholder="Tulis balasan..." style="border-radius: 12px;">
                                            </div>
                                            <button type="submit" class="btn btn-sm btn-primary mt-2" style="border-radius: 12px;">
                                                <i class="fas fa-reply"></i> Balas
                                            </button>
                                        </form>
                                    </div>

                                    <!-- Tombol Hapus Komentar -->
                                    @if($comment->user_id == Auth::id())
                                        <form action="{{ route('comments.delete', $comment->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus komentar?')">
                                                Hapus
                                            </button>
                                        </form>
                                    @endif

                                    <!-- Menampilkan balasan komentar -->
                                    @foreach($comment->replies as $reply)
                                        <div class="d-flex mt-3 ml-5 comment-box">
                                            <img src="{{ $reply->user->photo ? asset('storage/' . $reply->user->photo) : 'https://via.placeholder.com/40' }}" 
                                                 alt="profile" class="rounded-circle me-3" 
                                                 style="width: 30px; height: 30px;">
                                            <div>
                                                <strong>{{ $reply->user->name }}</strong>
                                                <p class="mb-1">{{ $reply->comment }}</p>
                                                <span class="text-muted" style="font-size: 12px;">{{ $reply->created_at->diffForHumans() }}</span>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach

                        <!-- Form untuk menambah komentar -->
                        <form action="{{ route('posts.comment', $post->id) }}" method="POST" class="d-flex align-items-center">
                            @csrf
                            <div class="form-group mb-0 flex-grow-1">
                                <input type="text" name="comment" class="form-control" placeholder="Tambahkan komentar..." style="border-radius: 12px; background-color: #f7f9fc; padding: 10px;">
                            </div>
                            <button type="submit" class="btn btn-sm btn-primary ms-2" style="border-radius: 12px;">
                                <i class="fas fa-paper-plane"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
