<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = ['comment', 'user_id', 'post_id', 'parent_id'];

    // Relasi ke user
    // App\Models\Comment.php

public function user()
{
    return $this->belongsTo(User::class);
}

public function post()
{
    return $this->belongsTo(Post::class);
}


    // Relasi ke parent comment (jika ini adalah balasan)
    public function parent()
    {
        return $this->belongsTo(Comment::class, 'parent_id');
    }

    // Relasi ke balasan (anak) komentar
    public function replies()
    {
        return $this->hasMany(Comment::class, 'parent_id');
    }
}
