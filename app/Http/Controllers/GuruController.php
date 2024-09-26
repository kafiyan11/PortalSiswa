<?php

namespace App\Http\Controllers;

use App\Models\Score;
use App\Models\Tugas;
use App\Models\Jadwalguru;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Siswa; // Memastikan bahwa model Siswa digunakan

class GuruController extends Controller
{
    public function index(){
        return view('guru.dashboard');
    }
    public function jadwal()
    {
        // Fetch jadwal data, e.g., group by class
        $jadwalguru = Jadwalguru::all()->groupBy('kelas'); // Modify as per your needs

        // Return the view with the data
        return view('guru.jadwal', compact('jadwalguru')); // Make sure the view path is correct
    }

    public function profil()
    {
        return view('guru.profil');
    }


    //NILAI
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

}