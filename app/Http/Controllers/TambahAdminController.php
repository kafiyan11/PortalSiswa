<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cache;

class TambahAdminController extends Controller
{
    /**
     * Menampilkan daftar admin dengan opsi pencarian.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        // Ambil input pencarian dari request (GET parameter)
        $search = $request->get('search');

        // Gunakan scope untuk mendapatkan query pengguna dengan role 'Admin'
        $dataQuery = User::withRole('Admin');

        // Jika ada input pencarian, tambahkan filter berdasarkan nama atau NIS
        if ($search) {
            $dataQuery->where(function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%")
                      ->orWhere('nis', 'like', "%{$search}%");
            });
        }

        // Eksekusi query dengan pagination, misal 5 data per halaman
        $data = $dataQuery->paginate(5);

        // Hitung jumlah total pengguna dengan role 'Admin' menggunakan scope
        // Menggunakan cache untuk meningkatkan performa (opsional)
        $totalAdmin = Cache::remember('total_admin_count', 60, function () {
            return User::withRole('Admin')->count();
        });

        // Return data ke view dan sertakan jumlah total serta input pencarian
        return view('admin.tambahadmin.admin', [
            'data' => $data,
            'search' => $search,
            'totalAdmin' => $totalAdmin,
        ]);
    }

    /**
     * Menyimpan data admin baru ke dalam database.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'nis' => 'required|string|max:255|unique:users,nis',
            'password' => 'required|string|min:6|confirmed',
        ]);

        // Buat pengguna baru menggunakan mass assignment
        User::create([
            'name' => $request->name,
            'nis' => $request->nis,
            'password' => Hash::make($request->password), // Hash password
            'plain_password' => $request->password, // Menyimpan plain password jika diperlukan     
            'role' => 'Admin',
        ]);

        // Mengosongkan cache jumlah admin karena data telah berubah
        Cache::forget('total_admin_count');

        return redirect()->route('tambah.admin')->with('success', 'Akun admin berhasil ditambahkan');
    }

    /**
     * Menampilkan form untuk membuat admin baru.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.tambahadmin.create');
    }

    /**
     * Menampilkan form untuk mengedit data admin.
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $data = User::findOrFail($id);
        return view('admin.tambahadmin.edit', compact('data'));
    }

    /**
     * Memperbarui data admin yang sudah ada.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        // Cari pengguna berdasarkan ID
        $user = User::findOrFail($id);

        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'nis' => 'required|string|max:255|unique:users,nis,' . $id,
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        // Siapkan data yang akan diupdate
        $updateData = [
            'name' => $request->name,
            'nis' => $request->nis,
            'role' => 'Admin',
        ];

        // Jika password diisi, hash dan tambahkan ke data yang diupdate
        if ($request->filled('password')) {
            $updateData['password'] = Hash::make($request->password);
            $updateData['plain_password'] = $request->password;
        }

        // Update data pengguna
        $user->update($updateData);

        // Mengosongkan cache jumlah admin karena data telah berubah
        Cache::forget('total_admin_count');

        return redirect()->route('tambah.admin')->with('success', 'Akun admin berhasil diedit');
    }

    /**
     * Menghapus data admin dari database.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
        // Cari pengguna berdasarkan ID
        $user = User::findOrFail($id);

        // Hapus pengguna
        $user->delete();

        return redirect()->route('tambah.admin')->with('success', 'Akun berhasil dihapus');
    }
}