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


    

    public function edit(Score $score, $id)
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
        $validated = $request->validate([
            'nama' => 'required|string',
            'nis' => 'required|numeric',
            'id_mapel' => 'required|exists:mapel,id_mapel', // Validasi mapel
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
        $parent = Auth::user();
    
        // Pastikan hanya orang tua yang dapat mengakses fungsi ini
        if ($parent->role !== 'Orang Tua') {
            return redirect()->route('home')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
        }
    
        // Mengambil siswa yang terkait dengan orang tua ini
        $students = $parent->children;
    
        if ($students->isEmpty()) {
            // Jika tidak ada siswa yang terkait
            $scores = collect(); // Menghasilkan koleksi kosong
        } else {
            // Mengambil skor untuk siswa-siswa yang terkait menggunakan 'nis'
            $scores = Score::whereIn('nis', $students->pluck('nis'))
                           ->with(['user']) // Pastikan relasi 'mapel' sudah didefinisikan di model Score
                           ->get();
        }
    
        return view('orangtua.nilai', compact('scores', 'students'));
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
    
        return view('siswa.lihatNilai', compact('scores'));
    }

    
}
