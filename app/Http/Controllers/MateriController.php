<?php

namespace App\Http\Controllers;
use App\Models\Materi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MateriController extends Controller
{
    public function materi()
    {
        $materi = Materi::paginate(2); // Mengambil semua data materi
        return view ('guru.materi.materi',  ['materi' => $materi]); // Mengarahkan ke view untuk menampilkan daftar materi
    }

    public function create()
    {
        return view('guru.materi.addMateri');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'kelas' => 'required|string|max:255',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:3048',
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
            'tipe' => 'required|string',
            'kelas' => 'required|string|max:255',
            'gambar' => 'nullable|image', // jika tipe gambar
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

        return redirect()->route('guru.materi.materi')->with('success', 'Materi berhasil diperbarui.');
    }

    // Menghapus materi
    public function destroy($id)
    {
        $materi = Materi::findOrFail($id); // Mengambil data berdasarkan ID
        $materi->delete(); // Menghapus data

        return redirect()->route('guru.materi.materi')->with('success', 'Materi berhasil dihapus.');
    }
    public function cari(Request $request)
{
    $cari = $request->input('cari');
    $materi = Materi::when($cari, function ($query, $cari) {
        return $query->where('judul', 'like', '%' . $cari . '%');
    })->paginate(2); // Pastikan paginate() digunakan di sini
    return view('guru.materi.materi', compact('materi'));
}
    public function lihatMateri_siswa(Request $request)
    {
        $user = Auth::user();

        // Mengambil kelas dari user
        $kelas = $user->kelas;

        // Mengambil materi yang berhubungan dengan 'Matematika' dan sesuai kelas
        $materi = Materi::where('judul', 'Matematika')
                        ->where('kelas', $kelas)
                        ->get();

        // Mengirimkan variabel 'materi' dan 'kelas' ke view
        return view('siswa.materisiswa.lihatmateri', compact('materi', 'kelas'));
    }  
    public function pkn(Request $request)
    {
        $user = Auth::user();

        // Mengambil kelas dari user
        $kelas = $user->kelas;

        // Mengambil materi yang berhubungan dengan 'Matematika' dan sesuai kelas
        $materi = Materi::where('judul', 'Materi Pendidikan Kewarganegaraan')
                        ->where('kelas', $kelas)
                        ->get();

        // Mengirimkan variabel 'materi' dan 'kelas' ke view
        return view('siswa.materisiswa.pkn', compact('materi', 'kelas'));
    }  
    public function bindo(Request $request)
    {
        $user = Auth::user();

        // Mengambil kelas dari user
        $kelas = $user->kelas;

        // Mengambil materi yang berhubungan dengan 'Matematika' dan sesuai kelas
        $materi = Materi::where('judul', 'Bahasa Indonesia')
                        ->where('kelas', $kelas)
                        ->get();

        // Mengirimkan variabel 'materi' dan 'kelas' ke view
        return view('siswa.materisiswa.bindo', compact('materi', 'kelas'));
    }  
    public function sunda(Request $request)
    {
        $user = Auth::user();

        // Mengambil kelas dari user
        $kelas = $user->kelas;

        // Mengambil materi yang berhubungan dengan 'Matematika' dan sesuai kelas
        $materi = Materi::where('judul', 'Bahasa Sunda')
                        ->where('kelas', $kelas)
                        ->get();

        // Mengirimkan variabel 'materi' dan 'kelas' ke view
        return view('siswa.materisiswa.sunda', compact('materi', 'kelas'));
    }  
}
