<?php 

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Jadwalguru;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JadwalguruController extends Controller
{
    // Menampilkan daftar jadwal di admin
    public function index()
    {
        $jadwalguru = JadwalGuru::all()->groupBy('kelas'); // Pastikan ini sesuai dengan kolom di tabel Anda
        return view('admin.jadwalguru.index', compact('jadwalguru'));
    }
    

    // Menampilkan formulir untuk membuat jadwal baru
    public function create()
    {
        return view('admin.jadwalguru.create');
    }

    // Menyimpan jadwal baru ke database
    public function store(Request $request)
    {
        $this->validateJadwal($request);

        $hari = $this->getHariFromTanggal($request->tanggal);
        $ganjilGenap = $this->getGanjilGenapFromTanggal($request->tanggal); // Menentukan ganjil/genap

        // Menyimpan data ke database
        Jadwalguru::create([
            'kelas' => $request->kelas,
            'guru' => $request->guru,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
            'tanggal' => $request->tanggal,
            'hari' => $hari,
            'ganjil_genap' => $ganjilGenap, // Simpan ganjil/genap
            'nis' => $request->nis, // Simpan NIS
        ]);

        return redirect()->route('admin.jadwalguru.index')->with('success', 'Jadwal berhasil ditambahkan');
    }

    // Menampilkan formulir untuk mengedit jadwal
    public function edit($id)
    {
        $jadwal = Jadwalguru::findOrFail($id);
        return view('admin.jadwalguru.edit', compact('jadwal'));
    }

    // Memperbarui jadwal yang ada di database
    public function update(Request $request, $id)
    {
        $this->validateJadwal($request);

        $jadwal = Jadwalguru::findOrFail($id);
        $hari = $this->getHariFromTanggal($request->tanggal);
        $ganjilGenap = $this->getGanjilGenapFromTanggal($request->tanggal); // Menentukan ganjil/genap

        // Mengupdate data di database
        $jadwal->update([
            'kelas' => $request->kelas,
            'guru' => $request->guru,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
            'tanggal' => $request->tanggal,
            'hari' => $hari,
            'ganjil_genap' => $ganjilGenap, // Update ganjil/genap
            'nis' => $request->nis, // Update NIS
        ]);

        return redirect()->route('admin.jadwalguru.index')->with('success', 'Jadwal berhasil diperbarui');
    }

    // Menghapus jadwal dari database
    public function destroy($id)
    {
        $jadwal = Jadwalguru::findOrFail($id);
        $jadwal->delete();

        return redirect()->route('admin.jadwalguru.index')->with('success', 'Jadwal berhasil dihapus');
    }

    // Method untuk validasi input jadwal
    protected function validateJadwal(Request $request)
    {
        $request->validate([
            'kelas' => 'required|string|max:255',
            'guru' => 'required|string|max:255',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai', // Pastikan jam_selesai setelah jam_mulai
            'tanggal' => 'required|date',
            'nis' => 'required|string|max:255', // Tambahkan validasi untuk NIS
        ]);
    }

    // Method untuk mendapatkan hari dari tanggal dalam bahasa Indonesia
    protected function getHariFromTanggal($tanggal)
    {
        return Carbon::parse($tanggal)->locale('id')->translatedFormat('l');
    }

    // Method untuk menentukan ganjil/genap berdasarkan tanggal
    protected function getGanjilGenapFromTanggal($tanggal)
    {
        $minggu = Carbon::parse($tanggal)->weekOfYear; // Mendapatkan minggu dari tanggal
        return ($minggu % 2 == 0) ? 'genap' : 'ganjil'; // Ganjil atau genap
    }
}
