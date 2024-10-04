@extends('layouts.app')

@section('content')
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            background-color: #f0f2f5;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #333;
        }
        .card {
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            transition: box-shadow 0.3s ease;
        }
        .card:hover {
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.15);
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            transition: background-color 0.3s, transform 0.3s;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
            transform: translateY(-2px);
        }
        .custom-file-upload {
            display: inline-block;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 5px;
            border: 1px solid #007bff;
            background-color: #fff;
            color: #007bff;
            transition: background-color 0.3s;
        }
        .custom-file-upload:hover {
            background-color: #007bff;
            color: #fff;
        }
        .input-file {
            display: none; /* Hide the default file input */
        }
        .comment-box {
            background-color: #f9f9f9;
            border-radius: 10px;
            padding: 10px;
            margin-bottom: 10px;
            text-align: left; /* Set text alignment to left */
        }
        .reply-form {
            display: none; /* Hide reply form by default */
            margin-top: 10px;
        }
        .replies-container {
            margin-left: 20px; /* Indent replies to distinguish them */
        }
    </style>
</head>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 mb-4">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <form action="{{ route('guru.forumdiskusi.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-3">
                            <textarea name="content" class="form-control" rows="3" placeholder="Apa yang Anda pikirkan?" required style="resize: none; background-color: #f7f9fc; padding: 15px;"></textarea>
                        </div>

                        <div class="form-group mb-3">
                            <label class="custom-file-upload">
                                <input type="file" name="image" class="input-file" accept="image/*">
                                Pilih Gambar
                            </label>
                            <label class="custom-file-upload mt-2">
                                <input type="file" name="video" class="input-file" accept="video/*">
                                Pilih Video
                            </label>
                        </div>

                        <button type="submit" class="btn btn-primary mt-3 w-100">Post</button>
                    </form>
                </div>
            </div>
        </div>

        @foreach($posts as $post)
        <div class="col-md-8 mb-4">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                        <img src="{{ $post->user->photo ? asset('storage/' . $post->user->photo) : 'https://via.placeholder.com/50' }}" alt="profile" class="rounded-circle me-3" style="width: 50px; height: 50px;">
                        <div>
                            <strong class="user-name">{{ $post->user->name }}</strong>
                            <br>
                            <span class="text-muted">{{ $post->created_at->diffForHumans() }}</span>
                        </div>
                    </div>
                    @if($post->user_id == Auth::id())
                        <form action="{{ route('guru.forumdiskusi.destroy', $post->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus postingan ini?')">Hapus</button>
                        </form>
                    @endif
                </div>
                <div class="card-body">
                    <p>{{ $post->content }}</p>

                    @if($post->image)
                        <img src="{{ asset('storage/' . $post->image) }}" alt="image" class="img-fluid rounded mb-3" style="max-width: 100%; height: auto; max-height: 300px;">
                    @endif

                    @if($post->video)
                        <video width="100%" controls class="rounded mb-3">
                            <source src="{{ asset('storage/' . $post->video) }}" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                    @endif
                </div>
                <div class="card-footer bg-white border-0">
                    @foreach($post->comments as $comment)
                        <div class="comment-box">
                            <strong>{{ $comment->user->name }}</strong>
                            <p>{{ $comment->comment }}</p>
                            <span class="text-muted">{{ $comment->created_at->diffForHumans() }}</span>

                            @if($comment->user_id == Auth::id())
                                <form action="{{ route('guru.comment.destroy', $comment->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-link p-0 text-danger" onclick="return confirm('Yakin ingin menghapus komentar ini?')">Hapus</button>
                                </form>
                            @endif

                            <button class="btn btn-link p-0" onclick="toggleReplyForm(this)">Balas</button>

                            <div class="reply-form mt-2" style="display: none;">
                                <form action="{{ route('guru.comment.reply', [$post->id, $comment->id]) }}" method="POST">
                                    @csrf
                                    <div class="input-group mb-2">
                                        <input type="text" name="reply" class="form-control" placeholder="Tambahkan balasan..." required>
                                        <button class="btn btn-primary" type="submit">Kirim</button>
                                    </div>
                                </form>
                            </div>

                            <button class="btn btn-link" onclick="toggleReplies(this)">Lihat Balasan <span class="badge">{{ $comment->replies->count() }}</span></button>
                            
                            <div class="replies-container" style="display: none;">
                                @foreach($comment->replies as $reply)
                                    <div class="comment-box d-flex align-items-start mt-2">
                                        <img src="{{ $reply->user->photo ? asset('storage/' . $reply->user->photo) : 'https://via.placeholder.com/40' }}" alt="profile" class="rounded-circle me-3" style="width: 30px; height: 30px;">
                                        <div class="flex-grow-1">
                                            <strong style="color: #000;">{{ $reply->user->name }}</strong>
                                            <p class="mb-1">{{ $reply->comment }}</p>
                                            <span class="text-muted" style="font-size: 12px;">{{ $reply->created_at->diffForHumans() }}</span>

                                            @if($reply->user_id == Auth::id())
                                                <form action="{{ route('guru.comment.destroy', $reply->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-link p-0 text-danger" onclick="return confirm('Yakin ingin menghapus balasan ini?')">Hapus</button>
                                                </form>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach

                    <form action="{{ route('guru.comment.store', $post->id) }}" method="POST" class="d-flex align-items-center mt-3">
                        @csrf
                        <div class="form-group mb-0 flex-grow-1">
                            <input type="text" name="comment" class="form-control" placeholder="Tambahkan komentar..." required>
                        </div>
                        <button type="submit" class="btn btn-sm btn-primary ms-2">Kirim</button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<script>
    function toggleReplyForm(button) {
        const replyForm = button.nextElementSibling;
        replyForm.style.display = replyForm.style.display === 'block' ? 'none' : 'block';
    }

    function toggleReplies(button) {
        const repliesContainer = button.nextElementSibling;
        const isVisible = repliesContainer.style.display === 'block';

        // Tampilkan atau sembunyikan balasan
        repliesContainer.style.display = isVisible ? 'none' : 'block';

        // Ubah teks tombol
        button.innerHTML = isVisible ? `Lihat Balasan <span class="badge">${button.querySelector('.badge').textContent}</span>` : `Sembunyikan Balasan <span class="badge">${button.querySelector('.badge').textContent}</span>`;
    }
</script>
@endsection
