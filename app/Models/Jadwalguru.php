<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwalguru extends Model
{
    use HasFactory;

    protected $table = 'jadwalgurus';

    protected $fillable = [
        'kelas', 'guru', 'jam_mulai', 'jam_selesai', 'tanggal', 'hari', 'ganjil_genap', 'nis',
    ];

    // Menentukan hubungan dengan model User
    public function guru()
    {
        return $this->belongsTo(User::class, 'guru_id'); // Menghubungkan dengan ID guru
    }
}

