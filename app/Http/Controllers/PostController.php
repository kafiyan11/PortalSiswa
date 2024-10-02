<?php
namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with(['user', 'comments.replies.user'])->latest()->get();
        return view('forum.index', compact('posts'));
    }



public function store(Request $request)
{
    $request->validate([
        'content' => 'required|string|max:255',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi untuk gambar
        'video' => 'nullable|mimes:mp4,mov,avi,wmv|max:20480', // Validasi untuk video
    ]);

    $post = new Post();
    $post->content = $request->content;
    $post->user_id = auth()->id();

    // Menyimpan gambar jika ada
    if ($request->hasFile('image')) {
        $post->image = $request->file('image')->store('images', 'public');
    }

    // Menyimpan video jika ada
    if ($request->hasFile('video')) {
        $post->video = $request->file('video')->store('videos', 'public');
    }

    $post->save();

    return redirect()->route('posts.index')->with('success', 'Post created successfully.');
}


    public function destroy(Post $post)
    {
        if ($post->user_id == Auth::id()) {
            $post->delete();
            return redirect()->route('posts.index')->with('success', 'Postingan berhasil dihapus.');
        }
        return redirect()->route('posts.index')->with('error', 'Tidak dapat menghapus postingan orang lain.');
    }
}
