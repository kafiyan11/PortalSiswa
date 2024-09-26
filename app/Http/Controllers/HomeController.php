<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SocialLink;
class HomeController extends Controller
{
    /**
     * Show the application home page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('home'); // Pastikan file Blade `home.blade.php` ada di `resources/views`
    }

    public function storeSocialLinks(Request $request)
    {
        $socialLinks = SocialLink::all();

        // Kirim data ke view
        return view('welcome', compact('socialLinks'));
    }
}
