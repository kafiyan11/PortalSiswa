<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Crypt; // Pastikan Crypt diimpor

class TambahController extends Controller
{
    /**
     * Menampilkan daftar siswa dengan opsi pencarian.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        // Ambil input pencarian dari request (GET parameter)
        $search = $request->get('search');

        // Gunakan scope untuk mendapatkan query pengguna dengan role 'Siswa'
        $dataQuery = User::withRole('Siswa');

        // Jika ada input pencarian, tambahkan filter berdasarkan nama atau NIS
        if ($search) {
            $dataQuery->where(function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%")
                      ->orWhere('nis', 'like', "%{$search}%");
            });
        }

        // Eksekusi query dengan pagination, misal 5 data per halaman
        $data = $dataQuery->paginate(5);

        // Hitung jumlah total pengguna dengan role 'Siswa' menggunakan scope
        // Menggunakan cache untuk meningkatkan performa (opsional)
        $totalSiswa = Cache::remember('total_siswa_count', 60, function () {
            return User::withRole('Siswa')->count();
        });

        // Return data ke view dan sertakan jumlah total serta input pencarian
        return view('admin.tambah.tambahsiswa', [
            'data' => $data,
            'search' => $search,
            'totalSiswa' => $totalSiswa,
        ]);
    }

    /**
     * Menyimpan data siswa baru ke dalam database.
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
            'kelas' => 'nullable|string|max:50', // Tambahkan validasi untuk 'kelas'
            // Tambahkan validasi untuk 'alamat', 'nohp' jika diperlukan
        ]);
    
        // Buat pengguna baru menggunakan mass assignment
        User::create([
            'name' => $request->name,
            'nis' => $request->nis,
            'password' => Hash::make($request->password),
            'plain_password' => $request->password, // Menyimpan plain password jika diperlukan
            'role' => 'Siswa',
            'kelas' => $request->kelas, // Tambahkan kelas jika ada
            // Tambahkan field lain jika ada di form
        ]);
    
        // Mengosongkan cache jumlah siswa karena data telah berubah
        Cache::forget('total_siswa_count');
    
        return redirect()->route('tambah')->with('success', 'Akun siswa berhasil ditambahkan');
    }

    /**
     * Menampilkan form untuk membuat siswa baru.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.tambah.create');
    }

    /**
     * Menampilkan form untuk mengedit data siswa.
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $data = User::findOrFail($id);
        return view('admin.tambah.edit', compact('data'));
    }

    /**
     * Memperbarui data siswa yang sudah ada.
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
            'kelas' => 'nullable|string|max:50', // Tambahkan validasi untuk 'kelas'
            // Tambahkan validasi untuk 'alamat', 'nohp' jika diperlukan
        ]);
    
        // Siapkan data yang akan diupdate
        $updateData = [
            'name' => $request->name,
            'nis' => $request->nis,
            'role' => 'Siswa',
            'kelas' => $request->kelas, // Tambahkan kelas jika ada
            // Tambahkan field lain jika ada di form
        ];
    
        // Jika password diisi, tambahkan ke data yang diupdate
        if ($request->filled('password')) {
            $updateData['password'] = Hash::make($request->password);
            $updateData['plain_password'] = $request->password;
        }
    
        // Update data pengguna
        $user->update($updateData);
    
        // Mengosongkan cache jumlah siswa karena data telah berubah
        Cache::forget('total_siswa_count');
    
        return redirect()->route('tambah')->with('success', 'Akun siswa berhasil diedit');
    }

    /**
     * Menghapus data siswa dari database.
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

        return redirect()->route('tambah')->with('success', 'Akun berhasil dihapus');
    }
}
