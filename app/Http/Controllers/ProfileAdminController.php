<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\User; // Ensure the User model is used

class ProfileAdminController extends Controller
{
    /**
     * Display the profile page.
     *
     * @return \Illuminate\View\View
     */
    public function show()
    {
        // Retrieve the currently authenticated user
        $user = Auth::user();

        // Redirect to the 'profil.blade.php' view with user data
        return view('admin.profiles.profil', compact('user'));
    }

    /**
     * Show the form for editing the profile.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $user = Auth::user();
    
        // Cek apakah ID yang sedang login sama dengan ID yang ingin diedit
        if ($user->id != $id) {
            return redirect()->route('siswa.profiles.show')->with('error', 'Anda tidak memiliki akses untuk mengedit profil ini.');
        }
    
        return view('admin.profiles.edit', compact('user'));
    }

    /**
     * Update the profile changes in the database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        // Validasi data
        $request->validate([
            'name' => 'required|string|max:255',
            'nip' => 'nullable|string|max:255', // Untuk Guru
            'nis' => 'nullable|string|max:255', // Untuk Siswa
            'nohp' => 'nullable|string|max:20',
            'alamat' => 'nullable|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        // Cari user berdasarkan ID
        $user = User::findOrFail($id);
    
        // Update data
        $user->name = $request->input('name');
        
        if ($user->role === 'Guru') {
            $user->nip = $request->input('nip'); // Update NIP jika role Guru
        } else {
            $user->nis = $request->input('nis'); // Update NIS jika role Siswa
        }
    
        $user->nohp = $request->input('nohp');
        $user->alamat = $request->input('alamat');
    
        // Jika ada file foto yang diunggah
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('profile_photos', 'public');
            $user->photo = $photoPath;
        }
    
        // Simpan perubahan
        $user->save();
    
        // Redirect atau berikan response sesuai kebutuhan
        return redirect()->route('admin.profiles.show', $id)->with('success', 'Profil berhasil diperbarui!');
    }
    
}
