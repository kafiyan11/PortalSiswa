<?php

namespace App\Http\Controllers;

use App\Models\Mapel;
use App\Models\Materi;
use App\Models\NamaMateri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MateriAdminController extends Controller
{
    /**
     * Display a paginated list of Materi.
     */
    public function materiAdmin()
    {
        // Eager load 'mapel' relationships to optimize queries
        $materi = Materi::with('mapel')->paginate(4);
        return view('admin.materi.index', ['materi' => $materi]);
    }

    /**
     * Show the form to create new Materi.
     */
    public function createMateri()
    {
        $mapel = NamaMateri::all(); // Menggunakan Mapel::all() yang benar
        return view('admin.materi.create', compact('mapel'));
    }

    /**
     * Store a new Materi in storage.
     */
    public function storeAdmin(Request $request)
    {
        // Validate the request including id_mapel
        $request->validate([
            'judul' => 'required|string|max:255',
            'id_mapel' => 'required|integer|exists:mapel,id_mapel', // Pastikan ini benar
            'kelas' => 'required|string|max:255',
            'tipe' => 'required|string|in:gambar,youtube',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'link_youtube' => 'nullable|url',
        ]);

        // Ensure that the 'tipe' matches the provided data
        if ($request->tipe === 'gambar' && !$request->hasFile('gambar')) {
            return back()->withErrors(['gambar' => 'Anda harus mengunggah gambar untuk tipe gambar.']);
        }

        if ($request->tipe === 'youtube' && !$request->link_youtube) {
            return back()->withErrors(['link_youtube' => 'Anda harus memasukkan link YouTube untuk tipe YouTube.']);
        }

        // Handle file upload if present
        $gambarPath = null;
        if ($request->hasFile('gambar')) {
            // Store the image in 'public/materi' directory
            $gambarPath = $request->file('gambar')->store('materi', 'public');
        }

        // Create the Materi record
        Materi::create([
            'judul' => $request->judul,
            'id_mapel' => $request->id_mapel,
            'kelas' => $request->kelas,
            'gambar' => $gambarPath,
            'link_youtube' => $request->link_youtube,
            'tipe' => $request->tipe,
        ]);

        return redirect()->route('admin.materi.index')->with('success', 'Materi berhasil diunggah.');
    }

    /**
     * Show the form to edit existing Materi.
     */
    public function editMateri($id)
    {
        $materi = Materi::findOrFail($id);
        $mapel = NamaMateri::all(); // Menggunakan Mapel::all() yang benar
        return view('admin.materi.edit', compact('materi', 'mapel'));
    }

    /**
     * Update an existing Materi in storage.
     */
    public function updateMateri(Request $request, $id)
    {

        $request->validate([
            'judul' => 'required|string|max:255',
            'id_mapel' => 'required|integer|exists:mapel,id_mapel',
            'kelas' => 'required|string|max:255',
            'tipe' => 'required|string|in:gambar,youtube',
            'gambar' => 'nullable|image|max:2048',
            'link_youtube' => 'nullable|url',
        ]);
    
        $materi = Materi::findOrFail($id);
        $materi->judul = $request->judul;
        $materi->id_mapel = $request->id_mapel;
        $materi->kelas = $request->kelas;
        $materi->tipe = $request->tipe;
    
        // Upload gambar
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($materi->gambar) {
                Storage::disk('public')->delete($materi->gambar);
            }
            $materi->gambar = $request->file('gambar')->store('materi', 'public');
        }
    
        // Update link youtube sesuai tipe
        if ($request->tipe === 'youtube') {
            $materi->link_youtube = $request->link_youtube;
            $materi->gambar = null; // Kosongkan gambar jika tipe adalah youtube
        } elseif ($request->tipe === 'gambar') {
            $materi->link_youtube = null; // Kosongkan link youtube jika tipe adalah gambar
        }
    
        $materi->save(); // Simpan perubahan
    
        return redirect()->route('admin.materi.index')->with('success', 'Materi berhasil diperbarui.');
    }
    

    /**
     * Delete a Materi from storage.
     */
    public function destroyMateri($id)
    {
        $materi = Materi::findOrFail($id);

        // Optionally, delete the associated gambar if it exists
        if ($materi->gambar) {
            Storage::disk('public')->delete($materi->gambar);
        }

        $materi->delete();

        return redirect()->route('admin.materi.index')->with('success', 'Materi berhasil dihapus.');
    }

    /**
     * Search for Materi based on the 'cari' input.
     */
    public function cariMateri(Request $request)
    {
        $cari = $request->input('cari');
        $materi = Materi::where('judul', 'like', '%' . $cari . '%')->paginate(2);
        return view('admin.materi.index', compact('materi'));
    }
}
