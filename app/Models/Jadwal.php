<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Models\User; // Pastikan menggunakan model User

class Jadwal extends Model
{
    protected $fillable = [
        'kelas',
        'mata_pelajaran',
        'guru', // Ini adalah foreign key yang merujuk ke kolom 'id' di tabel 'users'
        'jam_mulai',
        'jam_selesai',
        'tanggal',
        'hari',
        'ganjil_genap',
    ];

    // Relasi dengan model User untuk mendapatkan nama guru
    public function guru()
    {
        return $this->belongsTo(User::class, 'guru'); // Menghubungkan kolom guru di jadwals dengan kolom id di users
    }
    
    
    /**
     * Relasi dengan model NamaMateri untuk mendapatkan mata pelajaran.
     */
    public function materi()
    {
        return $this->belongsTo(NamaMateri::class, 'mata_pelajaran', 'id_mapel'); // Sesuaikan foreign key jika perlu
    }

    /**
     * Scope untuk menentukan apakah minggu tertentu ganjil atau genap.
     */
    public static function determineGanjilGenap($tanggal)
    {
        $minggu = Carbon::parse($tanggal)->weekOfYear; // Mendapatkan minggu dari tanggal
        return ($minggu % 2 == 0) ? 'genap' : 'ganjil'; // Mengembalikan ganjil atau genap
    }

    /**
     * Scope untuk memfilter jadwal berdasarkan minggu ganjil atau genap.
     */
    public function scopeMinggu($query)
    {
        $mingguType = self::determineGanjilGenap(now()); // Ambil tanggal sekarang
        return $query->where('ganjil_genap', $mingguType);
    }
}
