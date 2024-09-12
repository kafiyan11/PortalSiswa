<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\Materi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MateriController extends Controller
{
    public function materi()
    {
        $materi = Materi::all(); // Mengambil semua data materi
        return view('guru.materi.materi', compact('materi')); // Mengarahkan ke view untuk menampilkan daftar materi
    }

    public function create()
    {
        return view('guru.materi.addMateri');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
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
            'gambar' => $gambarPath ?? null,
            'link_youtube' => $request->link_youtube ?? null,
            'tipe' => $request->tipe,
        ]);

        return redirect()->route('guru.materi.materi')->with('success', 'Materi berhasil diunggah.');
    }
    // Menampilkan form edit
    public function edit($id)
    {
        $materi = Materi::findOrFail($id); // Mengambil data berdasarkan ID
        return view('guru.materi.edit', compact('materi')); // Menampilkan view edit dengan data materi
    }

    // Menyimpan perubahan (update data)
    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'judul' => 'required|string|max:255',
            'tipe' => 'required|string', // tipe bisa berupa gambar atau youtube
            'gambar' => 'nullable|image|max:2048', // jika tipe gambar
            'link_youtube' => 'nullable|url' // jika tipe youtube
        ]);

        $materi = Materi::findOrFail($id); // Mengambil data berdasarkan ID

        // Update data materi
        $materi->judul = $request->judul;
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

        return redirect()->route('guru.materi.materi')->with('success', 'Materi berhasil diperbarui.');
    }

    // Menghapus materi
    public function destroy($id)
    {
        $materi = Materi::findOrFail($id); // Mengambil data berdasarkan ID
        $materi->delete(); // Menghapus data

        return redirect()->route('guru.materi.materi')->with('success', 'Materi berhasil dihapus.');
    }
}
