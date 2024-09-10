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

        public function tambah_materi(){
            return view('guru.materi.addMateri');
        }

    // Method untuk menyimpan data materi
    public function create(Request $request)
    {
        // Validasi input
        $request->validate([
            'kelas' => 'required|string',
            'jurusan' => 'required|string',
            'mapel' => 'required|string',
            'gambar_materi' => 'nullable|mimes:jpeg,png,jpg|max:2048',
            'video_materi' => 'nullable|mimes:mp4,mov,avi|max:20480',
        ]);

        // Menyimpan file gambar jika ada
        $gambarMateri = null;
        if ($request->hasFile('gambar_materi')) {
            $gambarMateri = $request->file('gambar_materi')->store('gambar_materi', 'public');
        }

        // Menyimpan file video jika ada
        $videoMateri = null;
        if ($request->hasFile('video_materi')) {
            $videoMateri = $request->file('video_materi')->store('video_materi', 'public');
        }

        // Menyimpan data ke dalam database
        Materi::create([
            'kelas' => $request->input('kelas'),
            'jurusan' => $request->input('jurusan'),
            'mapel' => $request->input('mapel'),
            'gambar_materi' => isset($gambarMateri) ? $gambarMateri : null,
            'video_materi' => $videoMateri ?? '',
        ]);

        return redirect()->route('guru.materi')->with('success', 'Materi berhasil ditambahkan!');
    }

    public function hapus($id){
        $materi = Materi::find($id);
        if(!$materi){
            return redirect()->route('guru.materi');
        }
        $materi->delete();
        return redirect()->route('guru.materi');
    }

    public function edit($id){
        $materi = Materi::findOrFail($id);
        return view('guru.materi.edit', compact('materi'));
    }

    public function update(Request $request, $id)
{
    // Validasi input
    $request->validate([
        'kelas' => 'required|string',
        'jurusan' => 'required|string',
        'mapel' => 'required|string',
        'gambar_materi' => 'nullable|mimes:jpeg,png,jpg|max:2048',
        'video_materi' => 'nullable|mimes:mp4,mov,avi|max:20480',
    ]);

    $materi = Materi::findOrFail($id);

    // Menyimpan file gambar jika ada
    if ($request->hasFile('gambar_materi')) {
        // Hapus file gambar lama jika ada
        if ($materi->gambar_materi) {
            Storage::disk('public')->delete($materi->gambar_materi);
        }
        $materi->gambar_materi = $request->file('gambar_materi')->store('gambar_materi', 'public');
    }

    // Menyimpan file video jika ada
    if ($request->hasFile('video_materi')) {
        // Hapus file video lama jika ada
        if ($materi->video_materi) {
            Storage::disk('public')->delete($materi->video_materi);
        }
        $materi->video_materi = $request->file('video_materi')->store('video_materi', 'public');
    }

    // Update data materi
    $materi->kelas = $request->input('kelas');
    $materi->jurusan = $request->input('jurusan');
    $materi->mapel = $request->input('mapel');
    $materi->save();

    return redirect()->route('guru.materi')->with('success', 'Materi berhasil diperbarui!');
}

    
}
