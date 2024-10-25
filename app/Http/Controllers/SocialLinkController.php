<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SocialLink;

class SocialLinkController extends Controller
{
    public function index()
    {
        $socialLinks = SocialLink::first();

        // Jika belum ada, buat record baru dengan nilai kosong
        if (!$socialLinks) {
            $socialLinks = SocialLink::create([
                'twitter' => '',
                'facebook' => '',
                'instagram' => '',
                'youtube' => '',
                'alamat' => '',      // Address
                'telepon' => '',     // Phone
                'email' => '',       // Email
                'jam_buka' => '',    // Opening Hours
            ]);
        }

        return view('admin.social-links.index', compact('socialLinks'));
    }

    public function edit()
    {
        $socialLinks = SocialLink::first();

        if (!$socialLinks) {
            $socialLinks = SocialLink::create([
                'twitter' => '',
                'facebook' => '',
                'instagram' => '',
                'youtube' => '',
                'alamat' => '',      // Address
                'telepon' => '',     // Phone
                'email' => '',       // Email
                'jam_buka' => '',    // Opening Hours
            ]);
        }

        return view('admin.social-links.edit', compact('socialLinks'));
    }

    public function update(Request $request)
{
    $request->validate([
        'twitter' => [
            'nullable', 
            'url', 
            'regex:/^(https?:\/\/)?(www\.)?x\.com\/[a-zA-Z0-9_]+$/'
        ],
        'facebook' => [
            'nullable', 
            'url', 
            'regex:/^(https?:\/\/)?(www\.)?facebook\.com\/[a-zA-Z0-9\.]+$/'
        ],
        'instagram' => [
            'nullable', 
            'url', 
            'regex:/^(https?:\/\/)?(www\.)?instagram\.com\/[a-zA-Z0-9_\.]+$/'
        ],
        'youtube' => [
            'nullable', 
            'url', 
            'regex:/^(https?:\/\/)?(www\.)?(youtube\.com|youtu\.be)\/.+$/'
        ],
        'alamat' => 'required|string',
        'telepon' => 'required|string',
        'email' => 'required|email',
        'jam_buka' => 'required|string',
    ]);

    $socialLinks = SocialLink::first();

    if (!$socialLinks) {
        $socialLinks = SocialLink::create($request->all());
    } else {
        $socialLinks->update($request->all());
    }

    return redirect()->route('social-links.index')->with('success', 'Links updated successfully.');
}

    

    public function landing_page()
    {
        $socialLinks = SocialLink::first();

        // Jika belum ada, buat record baru dengan nilai kosong
        if (!$socialLinks) {
            $socialLinks = SocialLink::create([
                'twitter' => '',
                'facebook' => '',
                'instagram' => '',
                'youtube' => '',
                'alamat' => '',      // Address
                'telepon' => '',     // Phone
                'email' => '',       // Email
                'jam_buka' => '',    // Opening Hours
            ]);
        }

        return view('welcome', compact('socialLinks'));
    }
}
