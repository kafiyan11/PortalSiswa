<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tugas extends Model
{
    use HasFactory;

    protected $table = 'tugas';

    protected $fillable = [ 
        'kelas', 
        'jurusan', 
        'id_mapel',
        'gambar_tugas',
    ];

    public function mapel()
    {
        return $this->belongsTo(NamaMateri::class, 'id_mapel', 'id_mapel');
    }

    public function mapell()
    {
        return $this->belongsTo(NamaMateri::class, 'icon', 'icon');
    }

    // Relasi dengan model User
    public function guru()
    {
        return $this->belongsTo(User::class, 'mengajar'); // Ganti 'id_guru' sesuai dengan kolom yang sesuai
    }
}
