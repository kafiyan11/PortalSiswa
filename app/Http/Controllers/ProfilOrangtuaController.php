<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\User; // Pastikan model User digunakan

class ProfilOrangtuaController extends Controller
{
    /**
     * Menampilkan halaman profil.
     *
     * @return \Illuminate\View\View
     */
    public function show()
    {
        // Mengambil pengguna yang sedang terautentikasi
        $user = Auth::user();

        // Mengambil siswa yang terkait dengan orang tua ini
        $students = $user->children; // Mengambil siswa yang terhubung dengan orang tua ini

        // Mengarahkan ke tampilan 'profil.blade.php' dengan data pengguna dan siswa
        return view('orangtua.profiles.profil', compact('user', 'students'));
    }

    /**
     * Menampilkan formulir untuk mengedit profil.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $user = Auth::user();

        // Memeriksa apakah ID pengguna yang sedang login sama dengan ID yang ingin diedit
        if ($user->id != $id) {
            return redirect()->route('orangtua.profiles.show')->with('error', 'Anda tidak memiliki akses untuk mengedit profil ini.');
        }

        // Mengambil semua siswa untuk pilihan
        $students = User::where('role', 'Siswa')->get();

        return view('orangtua.profiles.edit', compact('user', 'students'));
    }

    /**
     * Memperbarui perubahan profil di database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        // Mencari pengguna berdasarkan ID atau gagal
        $user = User::findOrFail($id);
    
        // Memastikan hanya pengguna yang sedang login yang dapat memperbarui profil mereka sendiri
        if (Auth::user()->id != $id) {
            return redirect()->route('orangtua.profiles.show')->with('error', 'Anda tidak memiliki akses untuk mengedit profil ini.');
        }
    
        // Validasi data yang diminta
        $request->validate([
            'name' => 'required|string|max:255',
            'kelas' => 'nullable|string|max:50',
            'alamat' => 'nullable|string|max:255',
            'nohp' => 'nullable|string|max:15',
            'students' => 'nullable|array|max:2', // Limit to 2 students
            'students.*' => 'exists:users,id', // Validasi setiap siswa yang dipilih
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'students.max' => 'Anda dapat memilih maksimal 2 siswa.',
        ]);
    
        // Memperbarui bidang pengguna
        $user->name = $request->input('name');
        $user->kelas = $request->input('kelas');
        $user->alamat = $request->input('alamat');
        $user->nohp = $request->input('nohp');
    
        // Menangani foto profil
        if ($request->hasFile('photo')) {
            // Menghapus foto lama jika ada
            if ($user->photo && Storage::exists('public/' . $user->photo)) {
                Storage::delete('public/' . $user->photo);
            }
    
            // Menyimpan foto baru
            $file = $request->file('photo');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('profile_photos', $filename, 'public');
            $user->photo = $path;
        }
    
        // Menyimpan perubahan sebelum mengatur hubungan
        $user->save();
    
        // Menyinkronkan siswa yang terkait (jika ada)
        $user->children()->sync($request->input('students', [])); // Sync siswa yang dipilih
    
        // Mengarahkan kembali ke halaman profil dengan pesan sukses
        return redirect()->route('orangtua.profiles.show', $user->id)
                         ->with('success', 'Profil berhasil diperbarui');
    }
    
    
}
