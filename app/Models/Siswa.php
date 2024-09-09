<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;

    // Tentukan nama tabel jika berbeda dengan default
    protected $table = 'siswa'; // Pastikan nama tabel sesuai dengan yang ada di database

    // Kolom-kolom yang dapat diisi secara massal
    protected $fillable = [
        'nis',        // Nomor Induk Siswa
        'nama',       // Nama siswa
        'kelas',      // Kelas siswa
        'jurusan',    // Jurusan siswa
        'gambar_tugas' // Nama file gambar tugas jika ada
    ];

    public function siswa()
    {
        return $this->hasOne(Siswa::class, 'user_id', 'id'); // Relasi ke Siswa
    }
    
}