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
        // Mengambil postingan yang masih dalam batas waktu yang ditentukan (misal 24 jam)
        $posts = Post::with(['user', 'comments.replies.user'])
        ->where('created_at', '>=', now()->subHours(24)) 
        ->latest()
        ->get();        
        

        return view('siswa.forumdiskusi', compact('posts'));
    }

    public function store(Request $request)
    {
        // Validasi data input
        $request->validate([
            'content' => 'required',
            'image' => 'nullable|image|max:2048',
            'video' => 'nullable|mimes:mp4,mov,ogg|max:20480'
        ]);
    
        // Buat posting baru
        $post = new Post;
        $post->content = $request->input('content');
        $post->user_id = auth()->id();
    
        // Simpan file gambar/video jika ada
        if ($request->hasFile('image')) {
            $post->image = $request->file('image')->store('images', 'public');
        }
        if ($request->hasFile('video')) {
            $post->video = $request->file('video')->store('videos', 'public');
        }
    
        $post->save();
    
        return redirect()->back()->with('success', 'Postingan berhasil ditambahkan!');
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

            return redirect()->route('siswa.forumdiskusi')->with('success', 'Postingan berhasil dihapus.');
        }

    }
}
