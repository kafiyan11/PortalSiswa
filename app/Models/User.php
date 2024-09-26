<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'nis',
        'role',
        'password',
        'plain_password',
        'alamat',
        'nohp',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
    public function siswa()
    {
        return $this->hasOne(Siswa::class, 'user_id', 'id');
    }
    // App\Models\User.php

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
    
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }



}
