<?php

namespace App\Http\Controllers;

use App\Models\Score;
use Illuminate\Http\Request;

class ScoreController extends Controller
{
    public function index()
    {
        $scores = Score::all();
        return view('admin.scores.index', [
            'scores' => $scores
        ]);
    }

    public function create()
    {
        return view('admin.scores.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            // 'student_id' => 'required|exists:students,id',
            'daily_test_score' => 'required|numeric',
            'midterm_test_score' => 'required|numeric',
            'final_test_score' => 'required|numeric',
        ]);

        Score::create($validated);

        return redirect()->route('scores.index');
    }

    public function edit(Score $scores, $id)
    {
        $scores=Score::findOrfail($id);
        return view('admin.scores.edit', compact('scores'));
    }

    public function update(Request $request, Score $scores,$id)
    {
        $validated = $request->validate([
            'daily_test_score' => 'required|numeric',
            'midterm_test_score' => 'required|numeric',
            'final_test_score' => 'required|numeric',
        ]);
        $scores=Score::find($id);
        $scores->update($validated);

        return redirect()->route('scores.index');
    }

    public function destroy(Score $scores, $id)
    {
        $scores=Score::findOrfail($id);
        $scores->delete();
        return redirect()->route('scores.index');
    }
}
