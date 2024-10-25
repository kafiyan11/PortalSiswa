<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Siswa;
use App\Models\Tugas;
use App\Models\Jadwal;
use App\Models\Materi;
use App\Models\NamaMateri;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
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
        // Mendapatkan kelas dari user yang sedang login
        $kelas = Auth::user()->kelas;
    
        // Mengambil data materi berdasarkan kelas user
        $materi = Materi::where('kelas', $kelas)->get();
    
        // Mengirimkan data materi ke view
        return view('siswa.materi', ['materi' => $materi]);
    }
    public function jadwal()
    {
        // Mendapatkan hari ini dalam bahasa Indonesia
        $hariIni = Carbon::now()->locale('id')->translatedFormat('l');
        
        // Mendapatkan status minggu ganjil/genap
        $minggu = $this->getGanjilGenapFromTanggal(now());
    
        // Mengambil ID kelas dari user yang sedang login
        $kelasSiswa = Auth::user()->kelas;
    
        // Mendapatkan tanggal awal dan akhir minggu
        $awalMinggu = Carbon::now()->startOfWeek(); // Awal minggu (Senin)
        $akhirMinggu = Carbon::now()->endOfWeek(); // Akhir minggu (Minggu)
    
        // Mengambil semua jadwal sesuai rentang tanggal, minggu ganjil/genap, dan kelas siswa
        $jadwals = Jadwal::where('ganjil_genap', $minggu)
                        ->where('kelas', $kelasSiswa)
                        ->whereBetween('tanggal', [$awalMinggu, $akhirMinggu]) // Pastikan ada kolom tanggal di tabel jadwal
                        ->get();
    
        // Menampilkan jadwal di view
        return view('siswa.jadwal', compact('jadwals', 'hariIni', 'minggu'));
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

    public function forum()
    {
        $posts = Post::with(['user', 'comments.replies.user'])->latest()->get();
        return view('siswa.forumdiskusi', compact('posts'));
    }

    public function materii(){

            $materi = NamaMateri::all(); // Mengambil semua data materi
            return view('siswa.materi', compact('materi')); // Mengembalikan view dengan data materi
            
    }
}