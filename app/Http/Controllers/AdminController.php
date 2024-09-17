<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
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
    public function jadwal()
    {
        return view('admin.jadwal');
    }
    public function profil()
    {
        $item=Auth::user();
        return view('admin.profil', compact('item'));
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
