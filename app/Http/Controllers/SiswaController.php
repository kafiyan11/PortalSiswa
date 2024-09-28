<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Jadwal;
use App\Models\Siswa;
use App\Models\Tugas;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class SiswaController extends Controller
{
    /**
     * Show the siswa dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('siswa.dashboard');
    }

    public function materi()
    {
        return view('siswa.materi');
    }

    public function jadwal()
    {
        // Mendapatkan hari ini dalam bahasa Indonesia
        $hariIni = Carbon::now()->locale('id')->translatedFormat('l');

        // Mendapatkan status minggu ganjil/genap
        $minggu = $this->getGanjilGenapFromTanggal(now()); // Menggunakan tanggal saat ini

        // Mengambil ID kelas dari user yang sedang login (pastikan kelas tersimpan di tabel users)
        $kelasSiswa = auth()->user()->kelas;

        // Mendapatkan semua jadwal sesuai hari ini, minggu ganjil/genap, dan kelas siswa
        $jadwals = Jadwal::where('hari', $hariIni)
                        ->where('ganjil_genap', $minggu)
                        ->where('kelas', $kelasSiswa)
                        ->get();

        // Menampilkan jadwal di view
        return view('siswa.jadwal', compact('jadwals'));
    }

    // Method untuk menentukan ganjil atau genap berdasarkan tanggal
    protected function getGanjilGenapFromTanggal($tanggal)
    {
        $minggu = Carbon::parse($tanggal)->weekOfYear; // Mendapatkan minggu dalam setahun
        return ($minggu % 2 == 0) ? 'genap' : 'ganjil'; // Mengembalikan ganjil atau genap
    }


    public function add()
    {
        return view('siswa.add');
    }
    public function profil()
    {
        return view('siswa.profiles.profil');
    }

    /**
     * Tampilkan data tugas siswa.
     *
     * @return \Illuminate\View\View
     */
    public function tugas()
    {
        // Ambil tugas berdasarkan NIS siswa yang login
        $tugas = Tugas::where('nis', Auth::user()->nis)->get();
        $tugas = Tugas::where('nis',Auth::user()->nis)->get(); 

        return view('siswa.tugas', compact('tugas'));
    }
}