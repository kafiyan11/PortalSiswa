<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
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

        Jadwal::create($request->all());

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
        $jadwal->update($request->all());

        return redirect()->route('admin.jadwal.index')->with('success', 'Jadwal berhasil diperbarui');
    }

    // Menghapus jadwal dari database
    public function destroy($id)
    {
        $jadwal = Jadwal::findOrFail($id);
        $jadwal->delete();

        return redirect()->route('admin.jadwal.index')->with('success', 'Jadwal berhasil dihapus');
    }
    public function tampil(){

        $jadwals = Jadwal::all();
        return view('siswa.jadwal', compact('jadwals'));
    }


}
