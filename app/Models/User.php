<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

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
        'kelas',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Scope untuk memfilter pengguna berdasarkan peran.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $role
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeWithRole($query, $role)
    {
        return $query->where('role', $role);
    }

    public function siswa()
    {
        return $this->hasOne(Siswa::class, 'user_id', 'id');
    }

    // Relasi dengan Post
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
    
    // Relasi dengan Comment
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    public function scores(): HasMany
    {
        return $this->hasMany(Score::class, 'nis', 'nis');
    }
}
