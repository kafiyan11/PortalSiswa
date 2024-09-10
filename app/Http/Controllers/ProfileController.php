<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\User; // Pastikan model User digunakan

class ProfileController extends Controller
{
    /**
     * Menampilkan halaman profil.
     *
     * @return \Illuminate\View\View
     */
    public function show()
    {
        // Mengambil pengguna yang sedang login
        $user = Auth::user();

        // Mengarahkan ke view 'profil.blade.php' dengan data pengguna
        return view('siswa.profiles.profil', compact('user'));
    }

    /**
     * Menampilkan form untuk mengedit profil.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        // Memastikan hanya pengguna yang login dapat mengedit profilnya sendiri
        $user = Auth::user();

        if ($user->id != $id) {
            return redirect()->route('siswa.profiles.profil')->with('error', 'Anda tidak memiliki akses untuk mengedit profil ini.');
        }

        // Tampilkan form edit profil dengan data pengguna
        return view('siswa.profiles.edit', compact('user'));
    }

    /**
     * Menyimpan perubahan profil ke database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
{
    $user = User::findOrFail($id);

    // Validasi
    $request->validate([
        'name' => 'required|string|max:255',
        'alamat' => 'nullable|string|max:255',
        'nohp' => 'nullable|string|max:15',
        'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi gambar
    ]);

    // Update nama
    $user->name = $request->input('name');
    $user->alamat = $request->input('alamat');
    $user->nohp = $request->input('nohp');

    // Handle foto profil
    if ($request->hasFile('photo')) {
        // Hapus foto lama jika ada
        if ($user->photo && Storage::exists('public/' . $user->photo)) {
            Storage::delete('public/' . $user->photo);
        }
        
        // Simpan foto baru
        $file = $request->file('photo');
        $path = $file->store('profile_photos', 'public');
        $user->photo = $path;
    }

    $user->save();

    return redirect()->route('profiles.show', $user->id)
                     ->with('success', 'Profile updated successfully');
}

    
    
}
