<?php
namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Score;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ScoreController extends Controller
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
        return view('admin.scores.index', compact('scores'));
    }
    
    public function create()
    {
        return view('admin.scores.create');
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

        return redirect()->route('admin.scores.index')->with('success', 'Nilai berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $score = Score::findOrFail($id);
        return view('admin.scores.edit', compact('score'));
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

        return redirect()->route('admin.scores.index')->with('success', 'Nilai berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $score = Score::findOrFail($id);
        $score->delete();

        return redirect()->route('admin.scores.index')->with('success', 'Nilai berhasil dihapus!');
    }

    public function ortu()
    {
        $scores = Score::all();
        return view('orangtua.nilai', compact('scores'));
    }

    public function wujud()
    {
        // Mendapatkan NIS dari user yang sedang login
        $nis = Auth::user()->nis;

        // Mendapatkan skor berdasarkan NIS
        $scores = Score::where('nis', $nis)->get();

        // Mengirim data skor ke view siswa.nilai
        return view('siswa.nilai', compact('scores'));
    }
}
