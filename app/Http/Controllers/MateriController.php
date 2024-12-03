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
    
        // // Mengambil semua data materi yang sesuai dengan mata pelajaran yang diajar
        // $materi = Materi::whereHas('mapel', function ($query) use ($mengajar) {
        //     $query->where('nama_mapel', $mengajar); // Sesuaikan dengan field nama mapel pada tabel mapel
        // })->with('mapel')->paginate(3);

        $materi = Materi::with('mapel')->paginate(3);
    
        // Mengarahkan ke view untuk menampilkan daftar materi yang sesuai
        return view('guru.materi.materi', ['materi' => $materi]);
    }
    

    /**
     * Show the form to create new Materi.
     */
    public function create()
{
    // Pastikan NamaMateri sudah sesuai
    $mapel = NamaMateri::all(); // Menggunakan model yang benar untuk mapel
    return view('guru.materi.addMateri', compact('mapel'));
}

/**
 * Store a new Materi in storage.
 */
public function store(Request $request)
{
    // Validasi input termasuk id_mapel
    $request->validate([
        'judul' => 'required|string|max:255',
        'id_mapel' => 'required|integer|exists:mapel,id_mapel',
        'kelas' => 'required|string|max:255',
        'tipe' => 'required|string|in:gambar,youtube',
        'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'link_youtube' => [
            'nullable',
            'url',
            'regex:/^(https?\:\/\/)?(www\.)?(youtube\.com|youtu\.?be)\/.+$/',
        ],
    ], [
        'link_youtube.regex' => 'Hanya link dari YouTube yang diizinkan.',
    ]);

    // Pastikan tipe dan input sesuai
    if ($request->tipe === 'gambar' && !$request->hasFile('gambar')) {
        return back()->withErrors(['gambar' => 'Anda harus mengunggah gambar untuk tipe gambar.']);
    }

    if ($request->tipe === 'youtube' && empty($request->link_youtube)) {
        return back()->withErrors(['link_youtube' => 'Anda harus memasukkan link YouTube untuk tipe YouTube.']);
    }

    // Proses unggah gambar jika ada
    $gambarPath = null;
    if ($request->hasFile('gambar')) {
        // Simpan gambar ke direktori 'public/materi'
        $gambarPath = $request->file('gambar')->store('materi', 'public');
    }

    // Buat data materi
    Materi::create([
        'judul' => $request->judul,
        'id_mapel' => $request->id_mapel,
        'kelas' => $request->kelas,
        'gambar' => $gambarPath,
        'link_youtube' => $request->link_youtube,
        'tipe' => $request->tipe,
    ]);

    // Redirect ke halaman index materi
    return redirect()->route('guru.materi')->with('success', 'Materi berhasil diunggah.');
}


    /**
     * Show the form to edit existing Materi.
     */
    public function edit($id)
    {
        $materi = Materi::findOrFail($id);
        $mapel = NamaMateri::all(); // Menggunakan Mapel::all() yang benar
        return view('guru.materi.edit', compact('materi', 'mapel'));
    }

    /**
     * Update an existing Materi in storage.
     */
    public function update(Request $request, $id)
{
    $request->validate([
        'judul' => 'required|string|max:255',
        'id_mapel' => 'required|integer|exists:mapel,id_mapel',
        'kelas' => 'required|string|max:255',
        'tipe' => 'required|string|in:gambar,youtube',
        'gambar' => 'nullable|image|max:2048',
        'link_youtube' => [
            'nullable',
            'url',
            function ($attribute, $value, $fail) {
                if (!preg_match('/^(https?:\/\/)?(www\.)?(youtube\.com|youtu\.be)\//', $value)) {
                    $fail('Link YouTube harus berasal dari domain youtube.com atau youtu.be.');
                }
            },
        ],
    ]);

    $materi = Materi::findOrFail($id);
    $materi->judul = $request->judul;
    $materi->id_mapel = $request->id_mapel;
    $materi->kelas = $request->kelas;
    $materi->tipe = $request->tipe;

    // Upload gambar
    if ($request->hasFile('gambar')) {
        if ($materi->gambar) {
            Storage::disk('public')->delete($materi->gambar);
        }
        $materi->gambar = $request->file('gambar')->store('materi', 'public');
    }

    if ($request->tipe === 'youtube') {
        $materi->link_youtube = $request->link_youtube;
        $materi->gambar = null;
    } elseif ($request->tipe === 'gambar') {
        $materi->link_youtube = null;
    }

    $materi->save();

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
