<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\NamaMateri;
use App\Models\Score;
use App\Models\User;
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
        // Ambil semua data siswa
        $siswa = User::where('role', 'Siswa')->get();
        $mapel = NamaMateri::all(); // Ambil semua data mapel (pelajaran)

        return view('guru.scores.create', compact('siswa', 'mapel'));
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_id' => 'required|exists:users,id',
            'id_mapel' => 'required|exists:mapel,id_mapel',
            'daily_test_score' => 'nullable|numeric',
            'midterm_test_score' => 'nullable|numeric',
            'final_test_score' => 'nullable|numeric',
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
    
        return redirect()->route('guru.scores.index')->with('success', 'Nilai berhasil ditambahkan!');
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
    return view('guru.scores.edit', compact('score', 'siswa', 'mapel'));
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
