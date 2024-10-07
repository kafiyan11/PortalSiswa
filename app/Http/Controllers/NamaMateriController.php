<?php

namespace App\Http\Controllers;

use App\Models\NamaMateri;
use Illuminate\Http\Request;

class NamaMateriController extends Controller
{
    // Menampilkan semua data materi (READ)
    public function index()
    {
        $materi = NamaMateri::all();
        return view('admin.namamapel.index', compact('materi'));
    }


    // Menyimpan data materi baru ke database (STORE)
    public function store(Request $request)
    {
        $request->validate([
            'nama_mapel' => 'required|string|max:255', // Ubah nama_materi menjadi nama_mapel
        ]);

        $mapel = NamaMateri::create([
            'nama_mapel' => $request->nama_mapel, // Ubah nama_materi menjadi nama_mapel
        ]);

        return response()->json(['nama_mapel' => $mapel->nama_mapel], 201);
    }
    

    // Menampilkan detail materi berdasarkan ID (SHOW)
    public function show(NamaMateri $materi)
    {
        return view('namamapel.show', compact('materi'));
    }

    // Mengupdate materi
    public function update(Request $request, $id_mapel)
    {
        // Validasi input
        $validatedData = $request->validate([
            'nama_mapel' => 'required|string|max:255',
        ]);

        // Cari materi berdasarkan ID
        $materi = NamaMateri::findOrFail($id_mapel);
        $materi->nama_mapel = $validatedData['nama_mapel'];
        $materi->save();

        // Cek apakah permintaan mengharapkan JSON
        if ($request->expectsJson()) {
            return response()->json(['nama_mapel' => $materi->nama_mapel], 200);
        }

        // Jika tidak mengharapkan JSON, kembalikan redirect biasa
        return redirect()->route('namamapel.index')
                         ->with('success', 'Materi berhasil diperbarui.');
    }
    

    // Menghapus data materi dari database (DELETE)
    public function destroy($id_mapel)
    {
        $mapel = NamaMateri::findOrFail($id_mapel);
        $mapel->delete();

        return redirect()->route('namamapel.index')
                         ->with('success', 'Materi berhasil dihapus.');
    }
}
