<?php

namespace App\Models;

// App\Models\Post.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    // Relasi ke model User
    public function user()
    {
        return $this->belongsTo(User::class);
    }


public function comments()
{
    return $this->hasMany(Comment::class);
}

}

