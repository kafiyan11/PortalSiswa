<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Siswa;
use App\Models\tugas;
use App\Models\Jadwal;
use App\Models\Materi;
use App\Models\NamaMateri;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SiswaController extends Controller
{
    /**
     * Show the siswa dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('siswa.dashboard');
    }

    public function materi()
    {
        // Mendapatkan kelas dari user yang sedang login
        $kelas = Auth::user()->kelas;
    
        // Mengambil data materi berdasarkan kelas user
        $materi = Materi::where('kelas', $kelas)->get();
    
        // Mengirimkan data materi ke view
        return view('siswa.materi', ['materi' => $materi]);
    }
    public function jadwal()
    {
        // Mendapatkan hari ini dalam bahasa Indonesia
        $hariIni = Carbon::now()->locale('id')->translatedFormat('l');
        
        // Mendapatkan status minggu ganjil/genap
        $minggu = $this->getGanjilGenapFromTanggal(now());
    
        // Mengambil ID kelas dari user yang sedang login
        $kelasSiswa = Auth::user()->kelas;
    
        // Mendapatkan tanggal awal dan akhir minggu
        $awalMinggu = Carbon::now()->startOfWeek(); // Awal minggu (Senin)
        $akhirMinggu = Carbon::now()->endOfWeek(); // Akhir minggu (Minggu)
    
        // Mengambil semua jadwal sesuai rentang tanggal, minggu ganjil/genap, dan kelas siswa
        $jadwals = Jadwal::where('ganjil_genap', $minggu)
                        ->where('kelas', $kelasSiswa)
                        ->whereBetween('tanggal', [$awalMinggu, $akhirMinggu]) // Pastikan ada kolom tanggal di tabel jadwal
                        ->get();
    
        // Menampilkan jadwal di view
        return view('siswa.jadwal', compact('jadwals', 'hariIni', 'minggu'));
    }
    
    

    // Method untuk menentukan ganjil atau genap berdasarkan tanggal
    protected function getGanjilGenapFromTanggal($tanggal)
    {
        $minggu = Carbon::parse($tanggal)->weekOfYear; // Mendapatkan minggu dalam setahun
        return ($minggu % 2 == 0) ? 'genap' : 'ganjil'; // Mengembalikan ganjil atau genap
    }


    public function add()
    {
        return view('siswa.add');
    }
    public function profil()
    {
        return view('siswa.profiles.profil');
    }

    /**
     * Tampilkan data tugas siswa.
     *
     * @return \Illuminate\View\View
     */

    public function tugass(){
        $tugas = NamaMateri::all(); // Mengambil semua data materi
        return view('siswa.boxTugas', compact('tugas')); // Mengembalikan view dengan data materi
        
    }
    public function lihatTugasSiswa($id_mapel)
    {
        $user = Auth::user();
    
        // Pastikan pengguna terautentikasi
        if (!$user) {
            return redirect()->route('login')->with('error', 'Silakan login untuk mengakses halaman ini.');
        }
    
        // Ambil kelas dari pengguna yang terautentikasi
        $kelas = $user->kelas;
    
        // Ambil input pencarian dari request
        $search = request('search');
    
        // Ambil materi yang sesuai dengan kelas pengguna dan id_mapel yang diberikan, serta filter pencarian berdasarkan judul saja
        $tugasQuery = tugas::where('kelas', $kelas)
                            ->where('id_mapel', $id_mapel)
                            ->when($search, function ($query) use ($search) {
                                // Filter berdasarkan judul saja
                                return $query->where('judul', 'like', '%' . $search . '%');
                            });
    
        // Paginasi dengan 5 item per halaman
        $tugas = $tugasQuery->paginate(4)->appends(['search' => $search]);
    
        // Kirim variabel 'materi', 'kelas', 'search', dan 'id_mapel' ke view
        return view('siswa.tugas', compact('tugas', 'kelas', 'search', 'id_mapel'));
    }
    

    public function forum()
    {
        $posts = Post::with(['user', 'comments.replies.user'])->latest()->get();
        return view('siswa.forumdiskusi', compact('posts'));
    }

    public function materii(){

            $materi = NamaMateri::all(); // Mengambil semua data materi
            return view('siswa.materi', compact('materi')); // Mengembalikan view dengan data materi
            
    }
}