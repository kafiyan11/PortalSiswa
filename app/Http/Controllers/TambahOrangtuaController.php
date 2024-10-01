<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cache;

class TambahOrangtuaController extends Controller
{
    /**
     * Menampilkan daftar orang tua dengan opsi pencarian.
     */
    public function index(Request $request)
    {
        // Ambil nilai dari input pencarian (search)
        $search = $request->input('search');

        // Query untuk mendapatkan data orang tua dengan pagination
        // Jika ada pencarian, tambahkan filter where untuk nama atau NIS
        $orang = User::where('role', 'Orang Tua')
                     ->when($search, function ($query, $search) {
                         return $query->where(function($q) use ($search) {
                             $q->where('name', 'like', "%{$search}%")
                               ->orWhere('nis', 'like', "%{$search}%");
                         });
                     })
                     ->paginate(5);

        // Menghitung jumlah total orang tua dengan cache
        $totalOrangTua = Cache::remember('total_orangtua_count', 60, function () {
            return User::where('role', 'Orang Tua')->count();
        });

        // Kirim data orang tua dan nilai pencarian ke view
        return view('admin.tambahortu.ortu', [
            'orang' => $orang,
            'search' => $search,
            'totalOrangTua' => $totalOrangTua
        ]);
    }

    /**
     * Menyimpan data orang tua baru ke database.
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'nis' => 'required|string|max:255|unique:users,nis',
            'password' => 'required|string|min:6|confirmed',
        ]);

        // Simpan data orang tua
        User::create([
            'name' => $request->name,
            'nis' => $request->nis,
            'password' => Hash::make($request->password),
            'plain_password' => $request->password, // Menyimpan plain password jika diperlukan
            'role' => 'Orang Tua',
        ]);

        // Mengosongkan cache jumlah orang tua karena data telah berubah
        Cache::forget('total_orangtua_count');

        // Redirect dengan pesan sukses
        return redirect()->route('ortu')->with('success', 'Akun Orang Tua berhasil ditambahkan');
    }

    /**
     * Menampilkan form untuk membuat orang tua baru.
     */
    public function create()
    {
        return view('admin.tambahortu.createortu');
    }

    /**
     * Menampilkan form edit orang tua.
     */
    public function edit($id)
    {
        $data = User::findOrFail($id);
        return view('admin.tambahortu.editortu', compact('data'));
    }

    /**
     * Memperbarui data orang tua yang sudah ada.
     */
    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'nis' => 'required|string|max:255|unique:users,nis,' . $id,
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        // Cari orang tua yang akan diperbarui
        $data = User::findOrFail($id);

        // Data yang akan diperbarui
        $updateData = [
            'name' => $request->name,
            'nis' => $request->nis,
            'role' => 'Orang Tua',
        ];

        // Cek jika password diisi dan hash
        if ($request->filled('password')) {
            $updateData['password'] = Hash::make($request->password);
            $updateData['plain_password'] = $request->password; // Menyimpan plain password jika diperlukan
        }

        // Perbarui data orang tua
        $data->update($updateData);

        // Mengosongkan cache jumlah orang tua karena data telah berubah
        Cache::forget('total_orangtua_count');

        // Redirect dengan pesan sukses
        return redirect()->route('ortu')->with('success', 'Akun Orang Tua berhasil diedit');
    }

    /**
     * Menghapus akun orang tua.
     */
    public function delet($id)
    {
        $data = User::findOrFail($id);
        $data->delete();

        // Mengosongkan cache jumlah orang tua karena data telah berubah
        Cache::forget('total_orangtua_count');

        // Redirect dengan pesan sukses
        return redirect()->route('ortu')->with('success', 'Akun Orang Tua berhasil dihapus');
    }
}
