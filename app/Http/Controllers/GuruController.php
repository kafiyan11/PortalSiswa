<?php

namespace App\Http\Controllers;

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
        return view('guru.dashboard');
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
    public function tugas()
    {
        return view('guru.tugas');
    }
    public function addMateri()
    {
        return view('guru.addMateri');
    }
    public function addTugas()
    {
        return view('guru.addTugas');
    }

}
