<?php

namespace App\Http\Controllers;

use App\Models\Materi;
use Illuminate\Http\Request;

class MateriAdminController extends Controller
{
    public function materiAdmin()
    {
        $materi = Materi::paginate(2); // Mengambil semua data materi
        return view('admin.materi.index',  ['materi' => $materi]); // Mengarahkan ke view untuk menampilkan daftar materi
    }

    public function createMateri()
    {
        return view('admin.materi.create');
    }

    public function storeAdmin(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'kelas' => 'required|string|max:255',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'link_youtube' => 'nullable|url',
        ]);

        if ($request->hasFile('gambar')) {
            // Proses upload gambar
            $gambarPath = $request->file('gambar')->store('materi', 'public');
        }

        // Validasi bahwa salah satu harus diisi
        if (!$request->hasFile('gambar') && !$request->link_youtube) {
            return back()->withErrors(['msg' => 'Anda harus mengunggah gambar atau memasukkan link YouTube.']);
        }

        // Simpan data ke database
        Materi::create([
            'judul' => $request->judul,
            'kelas' => $request->kelas,
            'gambar' => $gambarPath ?? null,
            'link_youtube' => $request->link_youtube ?? null,
            'tipe' => $request->tipe,
        ]);

        return redirect()->route('admin.materi.index')->with('success', 'Materi berhasil diunggah.');
    }
    // Menampilkan form edit
    public function edittMateri($id)
    {
        $materi = Materi::findOrFail($id); // Mengambil data berdasarkan ID
        return view('admin.materi.edit', compact('materi')); // Menampilkan view edit dengan data materi
    }

    // Menyimpan perubahan (update data)
    public function updateMateri(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'judul' => 'required|string|max:255',
            'tipe' => 'required|string',
            'kelas' => 'required|string|max:255',
            'gambar' => 'nullable|image|max:2048', // jika tipe gambar
            'link_youtube' => 'nullable|url' // jika tipe youtube
        ]);

        $materi = Materi::findOrFail($id); // Mengambil data berdasarkan ID

        // Update data materi
        $materi->judul = $request->judul;
        $materi->kelas = $request->kelas;
        $materi->tipe = $request->tipe;

        // Jika mengupload gambar
        if ($request->hasFile('gambar')) {
            $path = $request->file('gambar')->store('materi', 'public');
            $materi->gambar = $path;
        }

        // Jika memasukkan link YouTube
        if ($request->tipe == 'youtube') {
            $materi->link_youtube = $request->link_youtube;
        }

        $materi->save(); // Simpan perubahan ke database

        return redirect()->route('admin.materi.index')->with('success', 'Materi berhasil diperbarui.');
    }

    // Menghapus materi
    public function destroyMateri($id)
    {
        $materi = Materi::findOrFail($id); // Mengambil data berdasarkan ID
        $materi->delete(); // Menghapus data

        return redirect()->route('admin.materi.index')->with('success', 'Materi berhasil dihapus.');
    }
    public function cariMateri(Request $request)
{
    $cari = $request->input('cari');
    $materi = Materi::when($cari, function ($query, $cari) {
        return $query->where('judul', 'like', '%' . $cari . '%');
    })->paginate(2); // Pastikan paginate() digunakan di sini
    return view('admin.materi.index', compact('materi'));
}

}
