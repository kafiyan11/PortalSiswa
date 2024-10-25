<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\User; // Pastikan model User digunakan

class ProfileController extends Controller
{
    /**
     * Display the profile page.
     *
     * @return \Illuminate\View\View
     */
    public function show()
    {
        // Mengambil data user yang sedang login
        $user = Auth::User();

        // Mengarahkan ke view 'profil.blade.php' dengan data user
        return view('siswa.profiles.profil', compact('user'));
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
    
        return view('siswa.profiles.edit', compact('user'));
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
        // Mencari user berdasarkan ID
        $user = User::findOrFail($id);

        // Pastikan hanya user yang sedang login dapat mengedit profil mereka sendiri
        if (Auth::user()->id != $id) {
            return redirect()->route('siswa.profiles.show')->with('error', 'Anda tidak memiliki akses untuk mengedit profil ini.');
        }

        // Validasi data yang dikirim
        $request->validate([
            'name' => 'required|string|max:255',
            'alamat' => 'nullable|string|max:255',
            'nohp' => 'nullable|string|max:15',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Update data user
        $user->name = $request->input('name');
        $user->alamat = $request->input('alamat');
        $user->nohp = $request->input('nohp');

        // Menangani foto profil
        if ($request->hasFile('photo')) {
            // Hapus foto lama jika ada
            if ($user->photo && Storage::exists('public/' . $user->photo)) {
                Storage::delete('public/' . $user->photo);
            }

            // Simpan foto baru
            $file = $request->file('photo');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('profile_photos', $filename, 'public');
            $user->photo = $path;
        }

        // Simpan perubahan
        $user->save();

        // Kembali ke halaman profil dengan pesan sukses
        return redirect()->route('siswa.profiles.show', $user->id)
                        ->with('success', 'Profile updated successfully');
    }
}
