<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\NamaMateri;
use App\Models\Score;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $scores = $scoresQuery->paginate(10);
    
        // Add rank and average score to each score in the paginated result
        $scores->getCollection()->transform(function ($score, $index) use ($scores) {
            $score->rank = ($scores->currentPage() - 1) * $scores->perPage() + $index + 1; // Calculate rank based on pagination
            $score->average_score = $score->total_score / 3; // Calculate average score
            return $score;
        });
        $totalUts = Score::sum('midterm_test_score'); // Sesuaikan nama kolom jika diperlukan
        $totalUas = Score::sum('final_test_score'); // Sesuaikan nama kolom jika diperlukan
    
        return view('admin.scores.index', compact('scores', 'totalUts', 'totalUas'));    }


    public function create()
    {
        // Ambil semua data siswa
        $siswa = User::where('role', 'Siswa')->get();
        $mapel = NamaMateri::all(); // Ambil semua data mapel (pelajaran)

        return view('admin.scores.create', compact('siswa', 'mapel'));  
    }
    public function store(Request $request)
{
    $validated = $request->validate([
        'student_id' => 'required|exists:users,id',
        'id_mapel' => 'required|exists:mapel,id_mapel',
        'daily_test_score' => 'nullable|numeric',
        'midterm_test_score' => 'nullable|numeric',
        'final_test_score' => 'nullable|n umeric',
    ]);

    // Ambil data siswa berdasarkan student_id
    $student = User::find($validated['student_id']);

    // Set default values for missing scores
    $validated['daily_test_score'] = $validated['daily_test_score'] ?? 0;
    $validated['midterm_test_score'] = $validated['midterm_test_score'] ?? 0;
    $validated['final_test_score'] = $validated['final_test_score'] ?? 0;

    // Create the Score entry
    Score::create([
        'student_id' => $validated['student_id'],
        'nama' => $student->name, // Ambil nama siswa dari model User
        'nis' => $student->nis, // Ambil NIS dari model User
        'id_mapel' => $validated['id_mapel'],
        'daily_test_score' => $validated['daily_test_score'],
        'midterm_test_score' => $validated['midterm_test_score'],
        'final_test_score' => $validated['final_test_score'],
    ]);

    return redirect()->route('admin.scores.index')->with('success', 'Nilai berhasil ditambahkan!');
}


    

public function edit($id)
{
    // Ambil data nilai berdasarkan ID
    $score = Score::findOrFail($id);

    // Ambil data semua siswa dengan role 'Siswa'
    $siswa = User::where('role', 'Siswa')->get();

    // Ambil data mapel (mata pelajaran)
    $mapel = NamaMateri::all();

    // Kirim data ke view
    return view('admin.scores.edit', compact('score', 'siswa', 'mapel'));
}

public function update(Request $request, $id)
{
    // Validasi data yang diterima
    $validated = $request->validate([
        'student_id' => 'required|exists:users,id',
        'id_mapel' => 'required|exists:mapel,id_mapel',
        'daily_test_score' => 'nullable|numeric',
        'midterm_test_score' => 'nullable|numeric',
        'final_test_score' => 'nullable|numeric',
    ]);

    // Cari data Score dan update
    $score = Score::findOrFail($id);

    // Update data dengan field yang divalidasi
    $score->update([
        'student_id' => $validated['student_id'],
        'id_mapel' => $validated['id_mapel'],
        'daily_test_score' => $validated['daily_test_score'] ?? 0,
        'midterm_test_score' => $validated['midterm_test_score'] ?? 0,
        'final_test_score' => $validated['final_test_score'] ?? 0,
    ]);

    $score->save();

    return redirect()->route('admin.scores.index')->with('success', 'Nilai berhasil diperbarui!');
}

    public function destroy($id)
    {
        $score = Score::findOrFail($id);
        $score->delete();

        return redirect()->route('admin.scores.index')->with('success', 'Nilai berhasil dihapus!');
    }

    public function ortu(Request $request)
    {
        // Ambil pencarian dari request
        $search = $request->get('cari');
    
        // Ambil id_mapel dari query string
        $id_mapel = $request->get('id_mapel'); // Pastikan id_mapel dikirim sebagai query string
    
        // Ambil semua materi
        $materi = NamaMateri::all(); // Daftar semua materi
    
        // Fetch scores and calculate total score
        $scoresQuery = Score::with('mapel')
                            ->where('id_mapel', $id_mapel) // Filter berdasarkan id_mapel
                            ->selectRaw('*, (daily_test_score + midterm_test_score + final_test_score) as total_score')
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
    
        // Kembalikan view dengan data scores dan materi
        return view('orangtua.nilai', compact('scores', 'materi'));
        }
    

    public function wujud()
    {
        // Mendapatkan NIS dari user yang sedang login
        $nis = Auth::user()->nis;
    
        // Mendapatkan skor berdasarkan NIS
        $scores = Score::where('nis', $nis)->get();
    
        // Mendapatkan materi berdasarkan NIS (atau metode lain untuk mendapatkan materi)
        $materi = NamaMateri::all();
    
        // Mengirim data skor dan materi ke view siswa.nilai
        return view('siswa.nilai', compact('scores', 'materi'));
    }
    public function lihatNilai(Request $request)
    {
    // Ambil pencarian dari request
    $search = $request->get('cari');

    // Ambil id_mapel dari query string
    $id_mapel = $request->get('id_mapel'); // Pastikan id_mapel dikirim sebagai query string

    // Ambil semua materi
    $materi = NamaMateri::all(); // Daftar semua materi

    // Fetch scores and calculate total score
    $scoresQuery = Score::with('mapel')
                        ->where('id_mapel', $id_mapel) // Filter berdasarkan id_mapel
                        ->selectRaw('*, (daily_test_score + midterm_test_score + final_test_score) as total_score')
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

    // Kembalikan view dengan data scores dan materi
    return view('siswa.lihatNilai', compact('scores', 'materi'));
    }
    public function BoxNilai(Request $request)
    {
        $nis = Auth::user()->nis;
    
        // Mendapatkan skor berdasarkan NIS
        $scores = Score::where('nis', $nis)->get();
    
        // Mendapatkan materi berdasarkan NIS (atau metode lain untuk mendapatkan materi)
        $materi = NamaMateri::all();
    
        // Mengirim data skor dan materi ke view siswa.nilai
        return view('orangtua.BoxNilai', compact('scores', 'materi'));
    }
    
}
