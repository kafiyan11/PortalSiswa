<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        // Mengambil semua postingan dengan relasi user dan komentar
        $posts = Post::with(['user', 'comments.user'])->get();
    
        return view('forum.index', compact('posts'));
    }
    

    public function store(Request $request)
    {
        // Validasi konten, gambar, dan video
        $request->validate([
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi untuk gambar
            'video' => 'nullable|mimes:mp4,mov,ogg,qt|max:20000', // Validasi untuk video
        ]);

        // Buat postingan baru
        $post = new Post();
        $post->content = $request->input('content');
        $post->user_id = auth()->id(); // Menyimpan ID user yang membuat post

        // Cek jika ada file gambar yang diupload
        if ($request->hasFile('image')) {
            $post->image = $request->file('image')->store('images', 'public'); // Simpan ke storage/public/images
        }

        // Cek jika ada file video yang diupload
        if ($request->hasFile('video')) {
            $post->video = $request->file('video')->store('videos', 'public'); // Simpan ke storage/public/videos
        }

        // Simpan postingan ke database
        $post->save();

        // Redirect kembali dengan pesan sukses
        return redirect()->back()->with('success', 'Post created successfully!');
    }

    public function comment(Request $request, Post $post)
    {
        $request->validate([
            'comment' => 'required',
        ]);
    
        // Simpan komentar baru (dengan atau tanpa parent_id)
        $post->comments()->create([
            'user_id' => auth()->id(),
            'comment' => $request->comment,
            'parent_id' => $request->parent_id,  // Cek jika ini adalah balasan
        ]);
    
        return back();
    }
    public function tampil()
    {
        // Mengambil semua postingan bersama komentar dan user yang terkait
        $posts = Post::with('comments.user', 'user')->latest()->get();
        return view('siswa.forumdiskusi', compact('posts'));
    }
    public function tampilGuru()
    {
        // Mengambil semua postingan bersama komentar dan user yang terkait
        $posts = Post::with('comments.user', 'user')->latest()->get();
        return view('guru.forumdiskusi', compact('posts'));
    }
    
}
