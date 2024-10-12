<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Jadwalguru;
use App\Models\Materi;
use App\Models\Post;
use App\Models\Score;
use Carbon\Carbon;
use App\Models\Tugas;
use Illuminate\Support\Facades\Storage;
use App\Models\User; 
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
    
        // Mendapatkan hari saat ini dalam bahasa Indonesia
        $hariIni = Carbon::now()->locale('id')->translatedFormat('l'); // Contoh: "Senin"
    
        // Mengambil jadwal yang sesuai dengan NIS guru dan hari ini
        $jadwalguru = Jadwalguru::where('nis', $nis)
                        ->where('hari', $hariIni)
                        ->get()
                        ->groupBy('kelas'); // Group by kelas
    
        // Mengembalikan view dengan data
        return view('guru.jadwal', compact('jadwalguru', 'hariIni')); // Pastikan jalur tampilan benar
    }
    


    //Profil Guruuu
    public function profil()
    {
        // Retrieve the currently authenticated user
        $user = Auth::user();

        // Redirect to the 'profil.blade.php' view with user data
        return view('guru.profiles.profil', compact('user'));
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
