<?php
namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request, Post $post)
    {
        $request->validate([
            'comment' => 'required|string|max:255',
        ]);

        $post->comments()->create([
            'user_id' => Auth::id(),
            'comment' => $request->comment,
        ]);

        return redirect()->route('posts.index')->with('success', 'Komentar berhasil ditambahkan.');
    }

    public function replyComment(Request $request, $postId, $commentId)
    {
        $request->validate([
            'reply' => 'required|string|max:255',
        ]);
    
        // Buat balasan komentar
        $reply = new Comment();
        $reply->user_id = Auth::id();
        $reply->post_id = $postId;
        $reply->parent_id = $commentId; // Menyimpan parent_id (ID dari komentar induk)
        $reply->comment = $request->reply;
        $reply->save();
    
        return redirect()->back()->with('message', 'Balasan berhasil ditambahkan.');
    }
    




    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);
        
        // Pastikan user hanya bisa menghapus komentarnya sendiri
        if (Auth::User()->id == $comment->user_id) {
            $comment->delete();
            return back()->with('success', 'Komentar berhasil dihapus');
        } else {
            return back()->with('error', 'Anda tidak memiliki izin untuk menghapus komentar ini');
        }
    }
    
    
}
