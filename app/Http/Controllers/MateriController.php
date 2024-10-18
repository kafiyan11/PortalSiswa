<?php

namespace App\Http\Controllers;

use App\Models\Materi;
use App\Models\NamaMateri; // Pastikan NamaMateri digunakan jika diperlukan
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MateriController extends Controller
{
    /**
     * Display a paginated list of Materi.
     */
    public function materi()
    {
        // Mendapatkan mata pelajaran yang diajar oleh guru yang sedang login
        $mengajar = Auth::user()->mengajar;
    
        // Mengambil semua data materi yang sesuai dengan mata pelajaran yang diajar
        $materi = Materi::whereHas('mapel', function ($query) use ($mengajar) {
            $query->where('nama_mapel', $mengajar); // Sesuaikan dengan field nama mapel pada tabel mapel
        })->with('mapel')->paginate(3);
    
        // Mengarahkan ke view untuk menampilkan daftar materi yang sesuai
        return view('guru.materi.materi', ['materi' => $materi]);
    }
    

    /**
     * Show the form to create new Materi.
     */
    public function create()
{
    $mapel = NamaMateri::all(); // Mengambil data dari model Mapel
    return view('guru.materi.addMateri', compact('mapel'));
}

    /**
     * Store a new Materi in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'id_mapel' => 'required|integer|exists:mapel,id_mapel', // Validasi id_mapel
            'kelas' => 'required|string|max:255',
            'tipe' => 'required|string|in:gambar,youtube',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'link_youtube' => 'nullable|url',
        ]);

        // Validasi bahwa salah satu harus diisi
        if (!$request->hasFile('gambar') && !$request->link_youtube) {
            return back()->withErrors(['msg' => 'Anda harus mengunggah gambar atau memasukkan link YouTube.']);
        }

        // Proses upload gambar jika ada
        $gambarPath = null;
        if ($request->hasFile('gambar')) {
            $gambarPath = $request->file('gambar')->store('materi', 'public');
        }

        // Simpan data ke database
        Materi::create([
            'judul' => $request->judul,
            'id_mapel' => $request->id_mapel,
            'kelas' => $request->kelas,
            'gambar' => $gambarPath,
            'link_youtube' => $request->link_youtube,
            'tipe' => $request->tipe,
        ]);

        return redirect()->route('guru.materi')->with('success', 'Materi berhasil diunggah.');
    }

    /**
     * Show the form to edit existing Materi.
     */
    public function edit($id)
    {
        $materi = Materi::findOrFail($id); // Get Materi data by ID
        $mapel = NamaMateri::all(); // Fetch all subjects for the dropdown
        return view('guru.materi.edit', compact('materi', 'mapel')); // Show edit view with Materi data
    }
    
    /**
     * Update an existing Materi in storage.
     */
    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'judul' => 'required|string|max:255',
            'id_mapel' => 'required|integer|exists:mapel,id_mapel', // Validasi id_mapel
            'kelas' => 'required|string|max:255',
            'tipe' => 'required|string|in:gambar,youtube',
            'gambar' => 'nullable|image|max:2048',
            'link_youtube' => 'nullable|url',
        ]);
        
    
        $materi = Materi::findOrFail($id); // Mengambil data berdasarkan ID

        // Update data materi
        $materi->judul = $request->judul;
        $materi->id_mapel = $request->id_mapel;
        $materi->kelas = $request->kelas;
        $materi->tipe = $request->tipe;

        // Jika mengupload gambar baru
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($materi->gambar) {
                Storage::disk('public')->delete($materi->gambar);
            }
            $materi->gambar = $request->file('gambar')->store('materi', 'public');
        }

        // Mengatur link YouTube berdasarkan tipe
        if ($request->tipe === 'youtube') {
            $materi->link_youtube = $request->link_youtube;
            $materi->gambar = null; // Clear gambar jika tipe adalah youtube
        } elseif ($request->tipe === 'gambar') {
            $materi->link_youtube = null; // Clear link_youtube jika tipe adalah gambar
        }

        $materi->save(); // Simpan perubahan ke database

    return redirect()->route('guru.materi')->with('success', 'Materi berhasil diperbarui.');
    }

    /**
     * Delete a Materi from storage.
     */
    public function destroy($id)
    {
        $materi = Materi::findOrFail($id); // Mengambil data berdasarkan ID

        // Hapus gambar jika ada
        if ($materi->gambar) {
            Storage::disk('public')->delete($materi->gambar);
        }

        $materi->delete(); // Menghapus data

        return redirect()->route('guru.materi')->with('success', 'Materi berhasil dihapus.');
    }

    /**
     * Search for Materi based on the 'cari' input.
     */
    public function cari(Request $request)
    {
        $cari = $request->input('cari');
        $materi = Materi::when($cari, function ($query, $cari) {
            return $query->where('judul', 'like', '%' . $cari . '%');
        })->paginate(2); // Pastikan paginate() digunakan di sini
        return view('guru.materi.materi', compact('materi'));
    }

    /**
     * Display materials for a specific subject based on the user's class.
     */
    public function lihatMateriSiswa($id_mapel)
    {
        $user = Auth::user();
    
        // Pastikan pengguna terautentikasi
        if (!$user) {
            return redirect()->route('login')->with('error', 'Silakan login untuk mengakses halaman ini.');
        }
    
        // Ambil kelas dari pengguna yang terautentikasi
        $kelas = $user->kelas;
    
        // Ambil input pencarian dari request
        $search = request('search');
    
        // Ambil materi yang sesuai dengan kelas pengguna dan id_mapel yang diberikan, serta filter pencarian berdasarkan judul saja
        $materiQuery = Materi::where('kelas', $kelas)
                            ->where('id_mapel', $id_mapel)
                            ->when($search, function ($query) use ($search) {
                                // Filter berdasarkan judul saja
                                return $query->where('judul', 'like', '%' . $search . '%');
                            });
    
        // Paginasi dengan 5 item per halaman
        $materi = $materiQuery->paginate(4)->appends(['search' => $search]);
    
        // Kirim variabel 'materi', 'kelas', 'search', dan 'id_mapel' ke view
        return view('siswa.lihatmateri', compact('materi', 'kelas', 'search', 'id_mapel'));
    }
    
}
