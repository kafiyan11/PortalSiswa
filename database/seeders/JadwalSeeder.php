<?php

namespace Database\Seeders;

use App\Models\Jadwal;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class JadwalSeeder extends Seeder
{
    public function run()
    {
        Jadwal::create([
            'kelas' => '10A',
            'mata_pelajaran' => 'Matematika',
            'guru' => 'Pak Budi',
            'jam_mulai' => '08:00:00',
            'jam_selesai' => '09:30:00',
        ]);
    }
}
