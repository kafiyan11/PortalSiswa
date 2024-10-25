<?php 

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Jadwal;
use App\Models\NamaMateri;
use App\Models\User;
use App\Models\Siswa;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    public function index()
    {
        $jadwals = Jadwal::with(['guru', 'materi'])->get(); // Pastikan memuat relasi guru dan materi
        
    
        // Mengelompokkan jadwal berdasarkan kelas dan ganjil/genap
        $jadwals = $jadwals->groupBy(function($item) {
            return $item->kelas . '-' . $item->ganjil_genap; 
        });
    
        return view('admin.jadwal.index', compact('jadwals'));
    }
    
    

    // Menampilkan formulir untuk membuat jadwal baru
    public function create()
    {
        $mapel = NamaMateri::all();
        $gurus = User::withRole('Guru')->get();

        return view('admin.jadwal.create',compact('mapel','gurus'));
    }

    // Menyimpan jadwal baru ke database
    public function store(Request $request)
    {
        $this->validateJadwal($request);

        $hari = $this->getHariFromTanggal($request->tanggal);
        $ganjilGenap = $this->getGanjilGenapFromTanggal($request->tanggal); // Menentukan ganjil/genap

        // Menyimpan data ke database
        Jadwal::create([
            'kelas' => $request->kelas,
            'mata_pelajaran' => $request->mata_pelajaran,
            'guru' => $request->guru,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
            'tanggal' => $request->tanggal,
            'hari' => $hari,
            'ganjil_genap' => $ganjilGenap, // Simpan ganjil/genap
        ]);

        return redirect()->route('admin.jadwal.index')->with('success', 'Jadwal berhasil ditambahkan');
    }

    // Menampilkan formulir untuk mengedit jadwal
    public function edit($id)
    {
        $jadwal = Jadwal::findOrFail($id);
        $mapel = NamaMateri::all();
        $gurus = User::withRole('Guru')->get();


        return view('admin.jadwal.edit', compact('jadwal','mapel','gurus'));
    }

    // Memperbarui jadwal yang ada di database
    public function update(Request $request, $id)
    {
        $this->validateJadwal($request);

        $jadwal = Jadwal::findOrFail($id);
        $hari = $this->getHariFromTanggal($request->tanggal);
        $ganjilGenap = $this->getGanjilGenapFromTanggal($request->tanggal); // Menentukan ganjil/genap

        // Mengupdate data di database
        $jadwal->update([
            'kelas' => $request->kelas,
            'mata_pelajaran' => $request->mata_pelajaran,
            'guru' => $request->guru,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
            'tanggal' => $request->tanggal,
            'hari' => $hari,
            'ganjil_genap' => $ganjilGenap, // Update ganjil/genap
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

    // Menampilkan jadwal berdasarkan hari saat ini dan minggu ganjil/genap untuk siswa
    public function tampil()
    {
        // Mendapatkan hari saat ini dalam bahasa Indonesia
        $hariIni = Carbon::now()->locale('id')->translatedFormat('l');
        
        // Tentukan jenis minggu (ganjil/genap)
        $minggu = $this->getGanjilGenapFromTanggal(now()); // Menggunakan tanggal sekarang
        
        // Ambil ID kelas dari pengguna yang sedang login
        $kelasSiswa = auth()->user()->kelas; // Pastikan 'kelas' adalah atribut yang ada di tabel users
    
        // Mendapatkan semua jadwal yang sesuai dengan hari ini dan minggu (ganjil/genap) serta kelas
        $jadwals = Jadwal::with('guru')->where('hari', $hariIni)
                        ->where('ganjil_genap', $minggu) // Gunakan ganjil_genap
                        ->where('kelas', $kelasSiswa) // Filter berdasarkan kelas
                        ->get();
        
        // Kirimkan jadwal ke view siswa
        return view('siswa.dashboard', compact('jadwals', 'hariIni', 'minggu'));
    }
    

    // Menampilkan jadwal untuk guru
    public function tingali()
    {
        $jadwals = Jadwal::orderBy('tanggal', 'asc')->get(); // Urutkan berdasarkan tanggal
        return view('guru.jadwal', compact('jadwals'));
    }

    // Method untuk validasi input jadwal
    protected function validateJadwal(Request $request)
    {
        $request->validate([
            'kelas' => 'required|string|max:255',
            'mata_pelajaran' => 'required|string|max:255',
            'guru' => 'required|string|max:255',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i',
            'tanggal' => 'required|date',
            // Hapus validasi ganjil_genap
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
