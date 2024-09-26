<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Jadwal extends Model
{
    protected $fillable = [
        'kelas',
        'mata_pelajaran',
        'guru',
        'jam_mulai',
        'jam_selesai',
        'tanggal',
        'hari',
        'ganjil_genap',
    ];

    // Menentukan apakah minggu untuk tanggal tertentu ganjil atau genap
    public static function determineGanjilGenap($tanggal)
    {
        $minggu = Carbon::parse($tanggal)->weekOfYear; // Mendapatkan minggu dari tanggal
        return ($minggu % 2 == 0) ? 'genap' : 'ganjil'; // Ganjil atau genap
    }

    public function scopeMinggu($query)
    {
        $mingguType = self::determineGanjilGenap(now()); // Ambil tanggal sekarang
        return $query->where('ganjil_genap', $mingguType);
    }
}

