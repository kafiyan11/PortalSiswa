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
    /**
     * Show the guru dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
         // Mengambil semua data siswa

        return view('guru.dashboard'); // Mengirim data siswa ke view dashboard

        $scores = Score::all();  // Atur data yang akan ditampilkan di halaman guru
        return view('guru.index', compact('scores'));
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

    public function addMateri()
    {
        return view('guru.addMateri');
    }

    public function addTugas(Request $request)
    {
        // Validasi data tugas yang akan ditambahkan
        $validatedData = $request->validate([
            'nis' => 'required|exists:users,nis', // Pastikan NIS valid dan ada di tabel users
            'nama' => 'required|string',
            'kelas' => 'required|string',
            'jurusan' => 'required|string',
            'gambar_tugas' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Jika ada file tugas, simpan file ke dalam folder public/uploads/tugas
        if ($request->hasFile('gambar_tugas')) {
            $file = $request->file('gambar_tugas');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('uploads/tugas', $fileName, 'public');
            $validatedData['gambar_tugas'] = '/storage/' . $filePath;
        }

        // Simpan tugas ke database
        Tugas::create($validatedData);

        return back()->with('success', 'Tugas berhasil ditambahkan!');
    }

    /**
     * Menampilkan daftar tugas siswa.
     *
     * @return \Illuminate\View\View
     */
    public function tugas()
    {
        $siswa = Siswa::all(); // Mengambil semua data siswa dari database

        // Mengirim data siswa ke view 'guru.tugas'
        return view('guru.tugas', compact('siswa'));
    }

    public function storeTugas(Request $request)
    {
        $request->validate([
            'nis' => 'required|exists:siswas,nis',
            'nama' => 'required',
            'kelas' => 'required',
            'jurusan' => 'required',
            'gambar_tugas' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('gambar_tugas')) {
            $file = $request->file('gambar_tugas');
            $namaFile = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads'), $namaFile);
        }

        Tugas::create([
            'nis' => $request->nis,
            'nama' => $request->nama,
            'kelas' => $request->kelas,
            'jurusan' => $request->jurusan,
            'gambar_tugas' => $namaFile,
        ]);

        return redirect()->route('guru.tugas')->with('success', 'Tugas berhasil ditambahkan!');
    }
}
