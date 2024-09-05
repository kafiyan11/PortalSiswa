<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    /**
     * Show the admin dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('admin.dashboard');
    }
    public function materi()
    {
        return view('admin.materi');
    }
    public function jadwal()
    {
        return view('admin.jadwal');
    }
    public function profil()
    {
        return view('admin.profil');
    }
    public function addMateri()
    {
        return view('admin.addMateri');
    }
    public function tugas()
    {
        return view('admin.tugas');
    }

    
}
