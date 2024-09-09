<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Tugas; // Pastikan nama model sesuai
use Illuminate\Http\Request;
use App\Models\User;

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
        return view('siswa.jadwal');
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
        $tugas = Tugas::where('nis', auth()->user()->nis)->get();

        return view('siswa.tugas', compact('tugas'));
    }
}
