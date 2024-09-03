<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
    public function profil()
    {
        return view('siswa.profil');
    }
    public function add()
    {
        return view('siswa.add');
    }

}
