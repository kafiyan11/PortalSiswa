<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Jadwal;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    // Menampilkan daftar jadwal di admin
    public function index()
    {
        $jadwals = Jadwal::all();
        return view('admin.jadwal.index', compact('jadwals'));
    }

    // Menampilkan formulir untuk membuat jadwal baru
    public function create()
    {
        return view('admin.jadwal.create');
    }

    // Menyimpan jadwal baru ke database
    public function store(Request $request)
    {
        $request->validate([
            'kelas' => 'required|string|max:255',
            'mata_pelajaran' => 'required|string|max:255',
            'guru' => 'required|string|max:255',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i',
            'tanggal' => 'required|date',
        ]);

        // Mendapatkan hari dari tanggal yang diinput dalam bahasa Indonesia
        $tanggal = Carbon::parse($request->tanggal)->locale('id'); // Set locale ke bahasa Indonesia
        $hari = $tanggal->translatedFormat('l'); // Format 'l' untuk menampilkan nama hari dalam bahasa lokal
    
        // Menambahkan data ke database termasuk hari
        Jadwal::create([
            'kelas' => $request->kelas,
            'mata_pelajaran' => $request->mata_pelajaran,
            'guru' => $request->guru,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
            'tanggal' => $request->tanggal,
            'hari' => $hari, // Menyimpan hari dalam bahasa Indonesia
        ]);

        return redirect()->route('admin.jadwal.index')->with('success', 'Jadwal berhasil ditambahkan');
    }

    // Menampilkan formulir untuk mengedit jadwal
    public function edit($id)
    {
        $jadwal = Jadwal::findOrFail($id);
        return view('admin.jadwal.edit', compact('jadwal'));
    }

    // Memperbarui jadwal yang ada di database
    public function update(Request $request, $id)
    {
        $request->validate([
            'kelas' => 'required|string|max:255',
            'mata_pelajaran' => 'required|string|max:255',
            'guru' => 'required|string|max:255',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i',
            'tanggal' => 'required|date',
        ]);

        $jadwal = Jadwal::findOrFail($id);

        // Mendapatkan hari dari tanggal yang diinput dalam bahasa Indonesia
        $tanggal = Carbon::parse($request->tanggal)->locale('id'); // Set locale ke bahasa Indonesia
        $hari = $tanggal->translatedFormat('l'); // Format 'l' untuk menampilkan nama hari
    
        // Mengupdate data di database
        $jadwal->update([
            'kelas' => $request->kelas,
            'mata_pelajaran' => $request->mata_pelajaran,
            'guru' => $request->guru,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
            'tanggal' => $request->tanggal,
            'hari' => $hari, // Update hari dengan hari baru yang dihitung
        ]);

        return redirect()->route('admin.jadwal.index')->with('success', 'Jadwal berhasil diperbarui');
    }

    // Menghapus jadwal dari database
    public function destroy($id)
    {
        $jadwal = Jadwal::findOrFail($id);
        $jadwal->delete();

        return redirect()->route('admin.jadwal.index')->with('success', 'Jadwal berhasil dihapus');
    }

    // Menampilkan jadwal berdasarkan hari saat ini untuk siswa
    public function tampil()
    {
        // Mendapatkan hari saat ini dalam bahasa Indonesia
        $hariIni = Carbon::now()->locale('id')->translatedFormat('l');

        // Mendapatkan jadwal yang sesuai dengan hari ini
        $jadwals = Jadwal::where('hari', $hariIni)->get();

        // Kirimkan jadwal ke view
        return view('siswa.dashboard', compact('jadwals'));
    }
    public function tingali()
    {
        $jadwals = Jadwal::all();
        return view('guru.jadwal', compact('jadwals'));
    }
}