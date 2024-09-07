<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Score;
use App\Models\Siswa; // Memastikan bahwa model Siswa digunakan
use Illuminate\Http\Request;

class GuruController extends Controller
{
    /**
     * Show the guru dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
         // Mengambil semua data siswa

        return view('guru.dashboard'); // Mengirim data siswa ke view dashboard

        $scores = Score::all();  // Atur data yang akan ditampilkan di halaman guru
        return view('guru.index', compact('scores'));
    }

    public function materi()
    {
        return view('guru.materi');
    }

    public function jadwal()
    {
        return view('guru.jadwal');
    }

    public function profil()
    {
        return view('guru.profil');
    }

    public function addMateri()
    {
        return view('guru.addMateri');
    }

    public function addTugas()
    {
        return view('guru.addTugas');
    }

    /**
     * Menampilkan daftar tugas siswa.
     *
     * @return \Illuminate\View\View
     */
    public function tugas()
    {
        $siswa = Siswa::all(); // Mengambil semua data siswa dari database

        // Mengirim data siswa ke view 'guru.tugas'
        return view('guru.tugas', compact('siswa'));
    }

//     public function index2()
// {
//     $scores = Score::all();  // Atur data yang akan ditampilkan di halaman guru
//     return view('guru.index', compact('scores'));
// }

}
