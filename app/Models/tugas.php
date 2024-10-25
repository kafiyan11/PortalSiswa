<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tugas extends Model
{
    use HasFactory;

    protected $table = 'tugas';

    protected $fillable = [
        'nis', 
        'nama', 
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
}
