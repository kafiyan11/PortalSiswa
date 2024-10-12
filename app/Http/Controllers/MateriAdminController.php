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
        $mapel = NamaMateri::all(); // Correctly fetch all Mapel for the dropdown
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
            'id_mapel' => 'required|integer|exists:mapel,id_mapel', // Corrected 'id' to 'id_mapel'
            'kelas' => 'required|string|max:255',
            'tipe' => 'required|string|in:gambar,youtube',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'link_youtube' => 'nullable|url',
        ]);

        // Ensure at least one of gambar or link_youtube is provided
        if (!$request->hasFile('gambar') && !$request->link_youtube) {
            return back()->withErrors(['msg' => 'Anda harus mengunggah gambar atau memasukkan link YouTube.']);
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
    public function editMateri($id) // Corrected method name
    {
        $materi = Materi::findOrFail($id);
        $mapel = NamaMateri::all(); // Correctly fetch all Mapel for the dropdown
        return view('admin.materi.edit', compact('materi', 'mapel'));
    }

    /**
     * Update an existing Materi in storage.
     */
    public function updateMateri(Request $request, $id)
    {
        // Validate the request including id_mapel
        $request->validate([
            'judul' => 'required|string|max:255',
            'id_mapel' => 'required|integer|exists:mapel,id_mapel', // Corrected 'id' to 'id_mapel'
            'kelas' => 'required|string|max:255',
            'tipe' => 'required|string|in:gambar,youtube',
            'gambar' => 'nullable|image|max:2048',
            'link_youtube' => 'nullable|url',
        ]);

        $materi = Materi::findOrFail($id);

        // Update fields
        $materi->judul = $request->judul;
        $materi->id_mapel = $request->id_mapel;
        $materi->kelas = $request->kelas;
        $materi->tipe = $request->tipe;

        // Handle gambar upload
        if ($request->hasFile('gambar')) {
            // Optionally, delete the old image if it exists
            if ($materi->gambar) {
                Storage::disk('public')->delete($materi->gambar);
            }
            $materi->gambar = $request->file('gambar')->store('materi', 'public');
        }

        // Handle link_youtube based on tipe
        if ($request->tipe === 'youtube') {
            $materi->link_youtube = $request->link_youtube;
            $materi->gambar = null; // Clear gambar if tipe is youtube
        } elseif ($request->tipe === 'gambar') {
            $materi->link_youtube = null; // Clear link_youtube if tipe is gambar
        }

        $materi->save();

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
