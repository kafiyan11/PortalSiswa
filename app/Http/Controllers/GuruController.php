<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Jadwalguru;
use App\Models\Materi;
use App\Models\Post;
use App\Models\Score;
use App\Models\Siswa; // Memastikan bahwa model Siswa digunakan
use App\Models\Tugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Import Auth

class GuruController extends Controller
{
    public function index()
    {
        return view('guru.dashboard');
    }

    public function jadwal()
    {
        // Mengambil NIS dari pengguna yang sedang login
        $nis = Auth::user()->nis; // Pastikan pengguna memiliki atribut NIS

        // Mengambil jadwal yang sesuai dengan NIS guru
        $jadwalguru = Jadwalguru::where('nis', $nis)->get()->groupBy('kelas'); // Group by kelas

        // Mengembalikan view dengan data
        return view('guru.jadwal', compact('jadwalguru')); // Pastikan jalur tampilan benar
    }

    public function profil()
    {
        return view('guru.profil');
    }

    // NILAI
    public function nilai(Request $request)
    {
        $search = $request->get('cari'); // Ambil input pencarian
    
        if ($search) {
            // Jika ada pencarian, cari data yang sesuai dengan 'nama' atau 'nis'
            $scores = Score::where('nama', 'LIKE', "%{$search}%")
                            ->orWhere('nis', 'LIKE', "%{$search}%")
                            ->get();
        } else {
            // Jika tidak ada pencarian, ambil semua data
            $scores = Score::all();
        }
    
        // Mengirim variabel $scores ke view
        return view('guru.scores.index', compact('scores'));
    }

    public function tambah_nilai()
    {
        return view('guru.scores.create');
    }

    public function storeNilai(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string',
            'nis' => 'required|numeric',
            'daily_test_score' => 'required|numeric',
            'midterm_test_score' => 'required|numeric',
            'final_test_score' => 'required|numeric',
        ]);

        Score::create($validated);

        return redirect()->route('guru.scores.index')->with('success', 'Nilai berhasil ditambahkan!');
    }

    public function editNilai(Score $score, $id)
    {
        $score = Score::findOrFail($id);
        return view('guru.scores.edit', compact('score'));
    }

    public function updateNilai(Request $request, $id)
    {
        $validated = $request->validate([
            'nama' => 'required|string',
            'nis' => 'required|numeric',
            'daily_test_score' => 'required|numeric',
            'midterm_test_score' => 'required|numeric',
            'final_test_score' => 'required|numeric',
        ]);

        $score = Score::findOrFail($id);
        $score->update($validated);

        return redirect()->route('guru.scores.index')->with('success', 'Nilai berhasil diperbarui!');
    }

    public function destroyNilai($id)
    {
        $score = Score::findOrFail($id);
        $score->delete();

        return redirect()->route('guru.scores.index')->with('success', 'Nilai berhasil dihapus!');
    }

    public function materi()
    {
        $materi = Materi::paginate(10); // Mengambil semua data materi
        return view('guru.materi.materi',  ['materi' => $materi]); // Mengarahkan ke view untuk menampilkan daftar materi
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
            'jurusan' => 'required|string|max:255',
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
            'kelas' => $request->input('kelas'),
            'jurusan' => $request->input('jurusan'),
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
            'kelas' => 'required|in:10,11,12',
            'jurusan' => 'required|in:TKR,TKJ,RPL,OTKP,AK,DPIB,SK', // tipe bisa berupa gambar atau youtube
            'gambar' => 'nullable|image|max:2048', // jika tipe gambar
            'link_youtube' => 'nullable|url' // jika tipe youtube
        ]);

        $materi = Materi::findOrFail($id); // Mengambil data berdasarkan ID

        // Update data materi
        $materi->judul = $request->judul;
        $materi->kelas = $request->kelas;
        $materi->jurusan = $request->jurusan;
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
    public function lihatMateri_siswa()
    {
        $kelas = \Illuminate\Support\Facades\Auth::User()->kelas;
        $materi = Materi::where('kelas', $kelas)->get();
        $materi = Materi::all(); // Mengambil semua data materi
        return view('siswa.lihatmateri', compact('materi')); // Mengarahkan ke view untuk menampilkan daftar materi
    }
    
public function tugas()
{
    $siswa = Tugas::paginate(10); // Mengambil data dari model Tugas
    return view('guru.tugas.tugas', ['siswa' => $siswa]); // Mengirim variabel $siswa ke view
}
public function forum()
{
    $posts = Post::with(['user', 'comments.replies.user'])->latest()->get();
    return view('guru.forumdiskusi', compact('posts'));
}


}
