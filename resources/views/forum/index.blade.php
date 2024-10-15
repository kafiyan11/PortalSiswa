@extends('layouts.app')

@section('content')
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
            margin-bottom: 20px;
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
        .post-image {
            display: block; /* Set display to block to allow centering */
            margin-left: auto; /* Center the image */
            margin-right: auto; /* Center the image */
            max-width: 90%; /* Adjust this value to make the image wider or narrower */
            height: auto; /* Maintain aspect ratio */
        }


        .comment-box {
            background-color: #f9f9f9;
            border-radius: 10px;
            padding: 10px;
            margin-bottom: 10px;
            text-align: left; /* Ensure comments are left-aligned */
            border-left: 4px solid #007bff; /* Optional: add a left border for visual distinction */
        }

        .replies-container {
            margin-left: 20px; /* Indent replies to distinguish them */
            padding-left: 10px; /* Add padding to the left for better alignment */
            border-left: 2px solid #ddd; /* Optional: add a left border for replies */
        }

        .reply-form {
            margin-top: 10px; /* Add margin to separate the reply form */
            margin-left: 20px; /* Indent the reply form */
        }

        .timestamp {
            font-size: 0.85em;
            color: #888;
        }

        .input-group {
            margin-top: 15px;
        }

        .preview-media {
            margin-top: 15px;
            max-height: 150%; 
            max-width: 100%; 
            object-fit: contain; 
        }

        .user-name {
            color: #000;
        }
    </style>
</head>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 mb-4">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-3">
                            <textarea name="content" class="form-control" rows="3" placeholder="Apa yang Anda pikirkan?" required style="resize: none; background-color: #f7f9fc; padding: 15px;"></textarea>
                        </div>

                        <div class="form-group mb-3">
                            <label for="media-select" class="form-label">Pilih jenis media:</label>
                            <select id="media-select" class="form-control mb-2">
                                <option value="none">Pilih media...</option>
                                <option value="image">Foto</option>
                                <option value="video">Video</option>
                            </select>

                            <div id="image-container" style="display: none;">
                                <label class="custom-file-upload">
                                    <input type="file" name="image" id="image-upload" class="input-file" accept="image/*">
                                    Pilih Gambar
                                </label>
                                <span id="image-name" class="text-muted"></span>
                                <img id="image-preview" class="preview-media" style="display: none;">
                            </div>

                            <div id="video-container" style="display: none;">
                                <label class="custom-file-upload">
                                    <input type="file" name="video" id="video-upload" class="input-file" accept="video/*">
                                    Pilih Video
                                </label>
                                <span id="video-name" class="text-muted"></span>
                                <video id="video-preview" class="preview-media" controls style="display: none;"></video>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary mt-3 w-100">Post</button>
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
                        <img src="{{ $post->user->photo ? asset('storage/' . $post->user->photo) : 'https://via.placeholder.com/50' }}" alt="profile" class="rounded-circle me-3" style="width: 50px; height: 50px;">
                        <div>
                            <strong class="user-name">{{ $post->user->name }}</strong>
                            <br>
                            <span class="text-muted">{{ $post->created_at->diffForHumans() }}</span>
                        </div>
                    </div>
                    @if($post->user_id == Auth::id())
                    <form id="delete-form-{{ $post->id }}" action="{{ route('posts.destroy', $post->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-sm btn-danger" onclick="confirmDelete({{ $post->id }})">Hapus</button>
                    </form>
                    @endif
                </div>
                <div class="card-body">
                    <p>{{ $post->content }}</p>
                    @if($post->image)
                    <img src="{{ asset('storage/' . $post->image) }}" alt="image" class="img-fluid rounded mb-3 post-image">
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
                        <img src="{{ $comment->user->photo ? asset('storage/' . $comment->user->photo) : 'https://via.placeholder.com/40' }}" alt="profile" class="rounded-circle me-2" style="width: 40px; height: 40px;">
                        <strong>{{ $comment->user->name }}</strong>
                        <p>{{ $comment->comment }}</p>
                        <span class="text-muted">{{ $comment->created_at->diffForHumans() }}</span>

                        <!-- Bagian penghapusan komentar -->
                        @if($comment->user_id == Auth::id())
                        <form id="delete-comment-form-{{ $comment->id }}" action="{{ route('comment.delete', $comment->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-link text-danger" onclick="confirmCommentDelete({{ $comment->id }})">Hapus</button>
                        </form>
                        @endif

                        <button class="btn btn-link p-0" onclick="toggleReplyForm(this)">Balas</button>

                        <div class="reply-form mt-2" style="display: none;">
                            <form action="{{ route('posts.comment.reply', [$post->id, $comment->id]) }}" method="POST">
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
                                        <form action="{{ route('comment.delete', $reply->id) }}" method="POST" class="d-inline">
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

                    <div class="reply-form">
                        <form action="{{ route('posts.comment.store', $post->id) }}" method="POST">
                            @csrf
                            <div class="input-group mb-2">
                                <input type="text" name="comment" class="form-control" placeholder="Tambahkan komentar..." required>
                                <button class="btn btn-primary" type="submit">Kirim</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<script>
    function toggleReplyForm(button) {
        const replyForm = button.closest('.comment-box').querySelector('.reply-form');
        replyForm.style.display = replyForm.style.display === 'none' ? 'block' : 'none';
    }

    function toggleReplies(button) {
        const repliesContainer = button.closest('.comment-box').querySelector('.replies-container');
        repliesContainer.style.display = repliesContainer.style.display === 'none' ? 'block' : 'none';
    }

    function confirmDelete(postId) {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: 'Anda tidak akan dapat mengembalikan ini!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus!'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById(`delete-form-${postId}`).submit();
            }
        });
    }

    function confirmCommentDelete(commentId) {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: 'Anda tidak akan dapat mengembalikan ini!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus!'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById(`delete-comment-form-${commentId}`).submit();
            }
        });
    }

    function confirmReplyDelete(replyId) {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: 'Anda tidak akan dapat mengembalikan ini!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus!'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById(`delete-reply-form-${replyId}`).submit();
            }
        });
    }

    document.getElementById('media-select').addEventListener('change', function () {
        const imageContainer = document.getElementById('image-container');
        const videoContainer = document.getElementById('video-container');
        const selectedValue = this.value;

        imageContainer.style.display = selectedValue === 'image' ? 'block' : 'none';
        videoContainer.style.display = selectedValue === 'video' ? 'block' : 'none';

        // Reset input fields when changing media type
        document.getElementById('image-upload').value = '';
        document.getElementById('video-upload').value = '';
        document.getElementById('image-name').textContent = '';
        document.getElementById('video-name').textContent = '';
        document.getElementById('image-preview').style.display = 'none';
        document.getElementById('video-preview').style.display = 'none';
    });

    document.getElementById('image-upload').addEventListener('change', function () {
        const imageName = document.getElementById('image-name');
        const imagePreview = document.getElementById('image-preview');
        const file = this.files[0];

        if (file) {
            imageName.textContent = file.name;
            const reader = new FileReader();
            reader.onload = function (e) {
                imagePreview.src = e.target.result;
                imagePreview.style.display = 'block';
            }
            reader.readAsDataURL(file);
        }
    });

    document.getElementById('video-upload').addEventListener('change', function () {
        const videoName = document.getElementById('video-name');
        const videoPreview = document.getElementById('video-preview');
        const file = this.files[0];

        if (file) {
            videoName.textContent = file.name;
            videoPreview.src = URL.createObjectURL(file);
            videoPreview.style.display = 'block';
        }
    });
</script>
@endsection
