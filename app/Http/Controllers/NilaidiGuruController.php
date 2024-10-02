<?php
namespace App\Http\Controllers;

use App\Models\Score;
use Illuminate\Http\Request;

class NIlaidiGuruController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('cari'); // Ambil input pencarian
    
        if ($search) {
            // Jika ada pencarian, cari data yang sesuai dengan 'nama' atau 'nis' dan paginate hasilnya
            $scores = Score::where('nama', 'LIKE', "%{$search}%")
                            ->orWhere('nis', 'LIKE', "%{$search}%")
                            ->paginate(2);
        } else {
            // Jika tidak ada pencarian, ambil semua data dengan pagination
            $scores = Score::paginate(2);
        }
    
        // Mengirim variabel $scores ke view
        return view('guru.scores.index', compact('scores'));
    }
    
    

    public function create()
    {
        return view('guru.scores.create');
    }

    public function store(Request $request)
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

    public function edit(Score $score, $id)
    {
        $score = Score::findOrFail($id);
        return view('guru.scores.edit', compact('score'));
    }

    public function update(Request $request, $id)
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

    public function destroy($id)
    {
        $score = Score::findOrFail($id);
        $score->delete();

        return redirect()->route('guru.scores.index')->with('success', 'Nilai berhasil dihapus!');
    }


    public function wujud()
    {
        // Dapatkan NIS siswa yang login
        $nis = \Illuminate\Support\Facades\Auth::User()->nis; // Pastikan field 'nis' ada di tabel users atau model siswa yang login
        
        // Ambil nilai yang sesuai dengan NIS siswa yang login
        $scores = Score::where('nis', $nis)->get();
    
        // Kirimkan data nilai ke view 'siswa.nilai'

        $scores = Score::paginate(2);
        return view('siswa.nilai', compact('scores'));
    }
    


    public function ortu()
    {
        $scores = Score::all();
        return view('orangtua.nilai', compact('scores'));
    }
}
