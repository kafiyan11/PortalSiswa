<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwalguru extends Model
{
    use HasFactory;

    protected $table = 'jadwalgurus'; // Pastikan nama tabel sesuai

    protected $fillable = [
        'kelas', 'guru', 'jam_mulai', 'jam_selesai', 'tanggal', 'hari', 'ganjil_genap'
    ];

    // Di model Jadwalguru
    public function guru()
    {
        return $this->belongsTo(User::class, 'id_guru'); // Pastikan 'id_guru' adalah kolom yang benar
    }

}
