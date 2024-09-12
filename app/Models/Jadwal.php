<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    protected $fillable = [
        'kelas',
        'mata_pelajaran',
        'guru',
        'jam_mulai',
        'jam_selesai',
        'tanggal',
        
    ];
}
