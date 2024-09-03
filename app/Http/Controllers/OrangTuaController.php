<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrangTuaController extends Controller
{
    /**
     * Show the orang tua dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('orangtua.dashboard');
    }
}
