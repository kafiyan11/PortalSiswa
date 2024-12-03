<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class PostGuruController extends Controller
{
    public function index()
    {
        // Mengambil postingan yang sudah disetujui dan mengurutkannya berdasarkan waktu terbaru
        $posts = Post::with(['user', 'comments.replies.user'])
            ->where('is_approved', true)
            ->orderBy('created_at', 'desc') // Urutkan berdasarkan created_at dari terbaru
            ->get();

        return view('guru.forumdiskusi', compact('posts'));
    }

    public function store(Request $request)
{
    $request->validate([
        'content' => 'required|string',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'video' => 'nullable|mimetypes:video/mp4|max:10240', // video max 10MB
    ]);

    $post = new Post();
    $post->content = $request->input('content');
    $post->user_id = auth()->id();

    if ($request->hasFile('image')) {
        $post->image = $request->file('image')->store('uploads', 'public');
    }
    if ($request->hasFile('video')) {
        $post->video = $request->file('video')->store('uploads', 'public');
    }

    $post->save();
    session()->flash('pending', 'Postingan Anda sedang dalam masa pending untuk persetujuan.');

    return redirect()->back()->with('success', 'Post berhasil ditambahkan!');
}

    

    public function destroy(Post $post)
    {
        // Cek jika user yang menghapus adalah pemilik postingan
        if ($post->user_id == Auth::id()) {
            // Hapus file gambar/video jika ada
            if ($post->image) {
                Storage::disk('public')->delete($post->image);
            }
            if ($post->video) {
                Storage::disk('public')->delete($post->video);
            }

            // Hapus postingan dari database
            $post->delete();

            return redirect()->route('guru.forumdiskusi')->with('success', 'Postingan berhasil dihapus.');
        }

    }
}
