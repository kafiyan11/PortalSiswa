<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        // Validasi data input yang diterima dari form
        $request->validate([
            'alamat' => 'nullable|string|max:255',
            'nohp'   => 'nullable|string|max:15',
        ]);
    
        // Cari pengguna berdasarkan ID yang sedang login
        $user = User::findOrFail($id);
    
        // Memastikan pengguna yang login sesuai dengan profil yang akan di-update
        if (Auth::id() !== $user->id) {
            return redirect()->route('profiles.show')->with('error', 'Anda tidak memiliki izin untuk memperbarui profil ini.');
        }
    
        // Update data profil pengguna
        $user->alamat = $request->input('alamat');
        $user->nohp = $request->input('nohp');
        $user->save(); // Simpan perubahan ke database
    
        // Redirect kembali ke halaman profil dengan pesan sukses
        return redirect()->route('profiles.show')->with('success', 'Profil berhasil diperbarui.');
    }
    
}
