<?php

namespace App\Http\Controllers;

use App\Models\Score;
use Illuminate\Http\Request;

class ScoreController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('cari');
    
        // Fetch scores and calculate total score
        $scoresQuery = Score::selectRaw('*, (daily_test_score + midterm_test_score + final_test_score) as total_score')
                            ->when($search, function ($query, $search) {
                                return $query->where('nama', 'LIKE', "%{$search}%")
                                             ->orWhere('nis', 'LIKE', "%{$search}%");
                            })
                            ->orderByDesc('total_score'); // Order by total score (descending for ranking)
    
        // Paginate the scores
        $scores = $scoresQuery->paginate(5);
    
        // Add rank and average score to each score in the paginated result
        $scores->getCollection()->transform(function ($score, $index) use ($scores) {
            $score->rank = ($scores->currentPage() - 1) * $scores->perPage() + $index + 1; // Calculate rank based on pagination
            $score->average_score = $score->total_score / 3; // Calculate average score
            return $score;
        });
    
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
            'daily_test_score' => 'nullable|numeric', // Allow null
            'midterm_test_score' => 'nullable|numeric', // Allow null
            'final_test_score' => 'nullable|numeric', // Allow null
        ]);
    
        // Set default values for missing scores
        $dailyTestScore = $validated['daily_test_score'] ?? 0;
        $midtermTestScore = $validated['midterm_test_score'] ?? 0;
        $finalTestScore = $validated['final_test_score'] ?? 0;
    
        // Create the Score entry
        Score::create([
            'nama' => $validated['nama'],
            'nis' => $validated['nis'],
            'daily_test_score' => $dailyTestScore,
            'midterm_test_score' => $midtermTestScore,
            'final_test_score' => $finalTestScore,
        ]);
    
        return redirect()->route('admin.scores.index')->with('success', 'Nilai berhasil ditambahkan!');
    }
    

    public function edit(Score $score, $id)
    {
        $score = Score::findOrFail($id);
        return view('admin.scores.edit', compact('score'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama' => 'required|string',
            'nis' => 'required|numeric',
            'daily_test_score' => 'nullable|numeric', // Allow null
            'midterm_test_score' => 'nullable|numeric', // Allow null
            'final_test_score' => 'nullable|numeric', // Allow null
        ]);

        $score = Score::findOrFail($id);
        $score->update($validated); // Use validated data directly

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
        $scores = Score::all();
        return view('siswa.nilai', compact('scores'));
    }
}
