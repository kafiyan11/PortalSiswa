<?php

namespace App\Http\Controllers;

use App\Models\NamaMateri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NamaMateriController extends Controller
{
    // Menampilkan semua data materi (READ)
    public function index(Request $request)
    {
        // Mengambil input pencarian dari request
        $search = $request->input('search');
    
        // Mengambil data materi dengan opsi pencarian
        $materi = NamaMateri::when($search, function ($query, $search) {
            return $query->where('nama_mapel', 'LIKE', "%{$search}%");
        })->paginate(4); // Mengambil semua data materi yang dipaginate
    
        // Mengembalikan view dengan data materi
        return view('admin.namamapel.index', compact('materi', 'search'));
    }
    

    // Menampilkan halaman form untuk membuat materi baru (CREATE)
    public function create()
    {
        return view('admin.namamapel.create'); // Mengembalikan view untuk form pembuatan materi
    }

    // Menyimpan data materi baru ke database (STORE)
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama_mapel' => 'required|string|max:255',
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi untuk ikon
        ]);
    
        // Menangani upload ikon jika ada
        $iconPath = null; // Inisialisasi untuk menyimpan path ikon
        if ($request->hasFile('icon')) {
            $iconPath = $request->file('icon')->store('icons', 'public'); // Menyimpan ikon ke folder public/icons
        }
    
        // Membuat data materi baru
        $mapel = NamaMateri::create([
            'nama_mapel' => $request->nama_mapel,
            'icon' => $iconPath, // Simpan path ikon
        ]);
    
        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('namamapel.index')->with('success', 'Mata Pelajaran berhasil ditambahkan.');
    }
    

    // Menampilkan detail materi berdasarkan ID (SHOW)
    public function show(NamaMateri $materi)
    {
        return view('admin.namamapel.show', compact('materi')); // Mengembalikan view detail dengan data materi
    }

    // Menampilkan halaman edit materi
    public function edit($id_mapel)
    {
        $materi = NamaMateri::findOrFail($id_mapel); // Mencari materi berdasarkan ID
        return view('admin.namamapel.edit', compact('materi')); // Mengembalikan view edit dengan data materi
    }

    // Mengupdate materi
    public function update(Request $request, NamaMateri $materi)
    {
        // Validate input
        $validatedData = $request->validate([
            'nama_mapel' => 'required|string|max:255',
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Update 'nama_mapel'
        $materi->nama_mapel = $validatedData['nama_mapel'];

        // Handle 'icon' upload if present
        if ($request->hasFile('icon')) {
            // Delete old icon if exists
            if ($materi->icon && Storage::disk('public')->exists($materi->icon)) {
                Storage::disk('public')->delete($materi->icon);
            }

            // Store new icon
            $iconPath = $request->file('icon')->store('icons', 'public');
            $materi->icon = $iconPath;
        }

        // Save updates
        $materi->save();

        // Redirect with success message
        return redirect()->route('namamapel.index')->with('success', 'Mata Pelajaran berhasil diperbarui.');
    }

    

    // Menghapus data materi dari database (DELETE)
    public function destroy($id_mapel)
    {
        // Mencari materi berdasarkan ID
        $materi = NamaMateri::find($id_mapel);
        
        // Jika materi ditemukan, hapus
        if ($materi) {
            $materi->delete();
            return redirect()->route('namamapel.index')->with('success', 'Mata Pelajaran berhasil dihapus.');
        }
        
        return redirect()->route('namamapel.index')->with('error', 'Mata Pelajaran tidak ditemukan.');
    }
}
