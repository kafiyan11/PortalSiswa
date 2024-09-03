<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Profiler\Profile;

class ProfilController extends Controller
{
    public function index(){

        return view('admin.profil.profil');
    }
}
