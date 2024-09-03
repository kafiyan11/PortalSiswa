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
}
