<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\NamaMateri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cache;

class TambahGuruController extends Controller
{
    /**
     * Menampilkan daftar guru dengan opsi pencarian.
     */
    public function index(Request $request)
    {
        // Mengambil kata kunci pencarian dari form
        $search = $request->input('search');

        // Query untuk mencari data guru berdasarkan nama atau NIS dengan pagination
        $guru = User::where('role', 'Guru')
                    ->when($search, function ($query, $search) {
                        return $query->where(function ($q) use ($search) {
                            $q->where('name', 'like', '%' . $search . '%')
                              ->orWhere('nis', 'like', '%' . $search . '%');
                        });
                    })
                    ->paginate(5); // Menambahkan pagination dengan 5 data per halaman

        // Menghitung jumlah total guru dengan cache
        $totalGuru = Cache::remember('total_guru_count', 60, function () {
            return User::where('role', 'Guru')->count();
        });

        // Mengirim data guru, jumlah guru, dan kata kunci pencarian ke view
        return view('admin.tambahguru.dataguru', [
            'guru' => $guru,
            'search' => $search,
            'totalGuru' => $totalGuru
        ]);
    }

    /**
     * Menyimpan data guru baru ke database.
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'nis' => 'required|string|max:255|unique:users,nis',
            'mengajar' => 'required',
            'password' => 'required|string|min:6|confirmed',
            // Tambahkan validasi untuk 'alamat', 'nohp', 'kelas' jika diperlukan
        ]);

        // Simpan data guru
        User::create([
            'name' => $request->name,
            'nis' => $request->nis,
            'mengajar' => $request->mengajar,
            'password' => Hash::make($request->password),
            'plain_password' => $request->password, // Menyimpan plain password jika diperlukan
            'role' => 'Guru',
            // Tambahkan field lain jika ada di form
        ]);

        // Mengosongkan cache jumlah guru karena data telah berubah
        Cache::forget('total_guru_count');

        // Redirect dengan pesan sukses
        return redirect()->route('tambahguru')->with('success', 'Akun guru berhasil ditambahkan');
    }

    /**
     * Menampilkan form untuk membuat guru baru.
     */
    public function create()
    {
        $mapel = NamaMateri::all(); // Mengambil data dari model Mapel

        return view('admin.tambahguru.createguru',compact(('mapel')));
    }

    /**
     * Menampilkan form edit guru.
     */
    public function edit($id)
    {
        $data = User::findOrFail($id);
        $mapel = NamaMateri::all(); // Mengambil data dari model Mapel

        return view('admin.tambahguru.editguru', compact('data','mapel'));
    }

    /**
     * Memperbarui data guru yang sudah ada.
     */
    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'nis' => 'required|string|max:255|unique:users,nis,' . $id,
            'mengajar' => 'required',
            'password' => 'nullable|string|min:6|confirmed',
            // Tambahkan validasi untuk 'alamat', 'nohp', 'kelas' jika diperlukan
        ]);

        // Cari guru yang akan diperbarui
        $data = User::findOrFail($id);

        // Data yang akan diperbarui
        $updateData = [
            'name' => $request->name,
            'nis' => $request->nis,
            'mengajar' => $request->mengajar,
            'role' => 'Guru',
            // Tambahkan field lain jika ada di form
        ];

        // Cek jika password diisi dan hash
        if ($request->filled('password')) {
            $updateData['password'] = Hash::make($request->password);
            $updateData['plain_password'] = $request->password; // Menyimpan plain password jika diperlukan
        }

        // Perbarui data guru
        $data->update($updateData);

        // Mengosongkan cache jumlah guru karena data telah berubah
        Cache::forget('total_guru_count');

        // Redirect dengan pesan sukses
        return redirect()->route('tambahguru')->with('success', 'Akun guru berhasil diedit');
    }

    /**
     * Menghapus akun guru.
     */
    public function delet($id)
    {
        $data = User::findOrFail($id);
        $data->delete();

        // Mengosongkan cache jumlah guru karena data telah berubah
        Cache::forget('total_guru_count');

        // Redirect dengan pesan sukses
        return redirect()->route('tambahguru')->with('success', 'Akun guru berhasil dihapus');
    }
}