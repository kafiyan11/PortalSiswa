<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class PostsiswaController extends Controller
{
    public function index()
    {
        // Mengambil postingan yang sudah disetujui dan mengurutkannya berdasarkan waktu terbaru
        $posts = Post::with(['user', 'comments.replies.user'])
            ->where('is_approved', true)
            ->orderBy('created_at', 'desc') // Urutkan berdasarkan created_at dari terbaru
            ->get();

        return view('forum.index', compact('posts'));
    }

    public function store(Request $request)
{
    $request->validate([
        'content' => 'required|string',
        'image' => 'nullable|image',
        'video' => 'nullable|mimes:mp4,mov,avi|max:20480',
    ]);

    $post = new Post();
    $post->content = $request->content;
    $post->is_approved = false; // Set status postingan sebagai "belum disetujui"
    $post->user_id = auth()->id(); // Id siswa yang sedang login

    if ($request->hasFile('image')) {
        $post->image = $request->file('image')->store('image', 'public');
    }

    if ($request->hasFile('video')) {
        $post->video = $request->file('video')->store('videos', 'public');
    }

    $post->save();

    // Redirect siswa ke halaman forumdiskusi mereka dengan alert pesan
    session()->flash('pending', 'Postingan Anda sedang dalam masa pending untuk persetujuan.');

    return redirect()->route('siswa.forumdiskusi');}

    
    

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

            return redirect()->route('siswa.forumdiskusi')->with('success', 'Postingan berhasil dihapus.');
        }

    }
}
