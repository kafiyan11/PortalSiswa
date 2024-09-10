<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materi extends Model
{
    use HasFactory;

    protected $table = 'materi';
    protected $fillable = [
    'kelas',
    'jurusan',
    'mapel',
    'gambar_materi',
    'video_materi'
];
}

