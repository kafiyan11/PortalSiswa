<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
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
        'mengajar',
        'parent_id',
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

    /**
     * Relasi satu ke banyak: Orang tua memiliki banyak siswa.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function children()
    {
        return $this->belongsToMany(User::class, 'parent_child', 'parent_id', 'child_id');
    }

    /**
     * Relasi banyak ke satu: Siswa memiliki satu orang tua.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(User::class, 'parent_id', 'id');
    }

    /**
     * Relasi dengan Siswa Model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function siswa()
    {
        return $this->hasOne(Siswa::class, 'user_id', 'id');
    }

    /**
     * Relasi dengan Post.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    /**
     * Relasi dengan Comment.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * Relasi dengan Score.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function scores(): HasMany
    {
        return $this->hasMany(Score::class, 'nis', 'nis');
    }

    /**
     * Relasi dengan Materi.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function materi()
    {
        return $this->hasMany(Materi::class);
    }


}
