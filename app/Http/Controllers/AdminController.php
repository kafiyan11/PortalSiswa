<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Materi;
use App\Models\tugas;
use App\Models\NamaMateri;
use App\Models\Score;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Cache;

class AdminController extends Controller
{
    /**
     * Show the admin dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        // Menghitung jumlah total siswa dengan cache untuk optimasi
        $totalSiswa = Cache::remember('total_siswa_count', 60, function () {
            return User::where('role', 'Siswa')->count();
        });
    
        // Menghitung jumlah total guru dengan cache untuk optimasi
        $totalGuru = Cache::remember('total_guru_count', 60, function () {
            return User::where('role', 'Guru')->count();
        });
    
        // Menghitung jumlah total orang tua dengan cache untuk optimasi
        $totalOrangTua = Cache::remember('total_orangtua_count', 60, function () {
            return User::where('role', 'Orang Tua')->count();
        });
    
        // Menghitung jumlah total admin dengan cache untuk optimasi
        $totalAdmin = Cache::remember('total_admin_count', 60, function () {
            return User::where('role', 'Admin')->count();
        });
        

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
        
        
            return view('admin.dashboard', compact('totalSiswa', 'totalGuru', 'totalOrangTua', 'totalAdmin', 'scores', 'totalUts', 'totalUas'));
    }
    
    //Profil Admin
    public function Profile()
    {
        // Retrieve the currently authenticated user
        $user = Auth::user();

        // Redirect to the 'profil.blade.php' view with user data
        return view('admin.profile.profil', compact('user'));
    }

    /**
     * Show the form for editing the profile.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function editProfile($id)
    {
        $user = Auth::user();
    
        // Cek apakah ID yang sedang login sama dengan ID yang ingin diedit
        if ($user->id != $id) {
            return redirect()->route('admin.profile.index')->with('error', 'Anda tidak memiliki akses untuk mengedit profil ini.');
        }
    
        return view('admin.profile.edit', compact('user'));
    }
    

    /**
     * Update the profile changes in the database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateProfile(Request $request, $id)
    {
        // Find the user by ID or fail
        $user = User::findOrFail($id);

        // Ensure that only the logged-in user can update their own profile
        if (Auth::user()->id != $id) {
            return redirect()->route('admin.profile.index')->with('error', 'Anda tidak memiliki akses untuk mengedit profil ini.');
        }

        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
            'kelas' => 'nullable|string|max:50',
            'alamat' => 'nullable|string|max:255',
            'nohp' => 'nullable|string|max:15',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Update user fields
        $user->name = $request->input('name');
        $user->kelas = $request->input('kelas');
        $user->alamat = $request->input('alamat');
        $user->nohp = $request->input('nohp');

        // Handle profile photo
        if ($request->hasFile('photo')) {
            // Delete the old photo if it exists
            if ($user->photo && Storage::exists('public/' . $user->photo)) {
                Storage::delete('public/' . $user->photo);
            }

            // Save the new photo
            $file = $request->file('photo');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('profile_photos', $filename, 'public');
            $user->photo = $path;
        }

        // Save changes
        $user->save();

        // Redirect back to the profile page with success message
        return redirect()->route('admin.profile.index', $user->id)
                        ->with('success', 'Profile updated successfully');
    }
  
    //TUGAS
    public function tugas(Request $request)
    {
        // Mengambil kata kunci dari input pencarian
        $cari = $request->input('cari');
    
        // Query untuk mencari data berdasarkan kata kunci pada kolom yang relevan
        $siswa = Tugas::with('mapel')
            ->when($cari, function ($query, $cari) {
                return $query->where('nis', 'like', "%{$cari}%") // Sesuaikan nama kolom jika diperlukan
                             ->orWhereHas('mapel', function ($query) use ($cari) {
                                 $query->where('nis', 'like', "%{$cari}%"); // Sesuaikan nama kolom pada relasi mapel
                             });
            })
            ->paginate(4);
    
        // Mengembalikan ke view dan mengirimkan kata kunci pencarian
        return view('admin.tugas.index', ['siswa' => $siswa, 'cari' => $cari]);
    }
    

    public function tambah_tugas()
    {
        $mapel = NamaMateri::all(); // Mengambil semua data dari tabel Mapel
        return view('admin.tugas.create', compact('mapel'));
    }
    public function create(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'kelas' => 'required|string|max:255',
            'id_mapel' => 'required|exists:mapel,id_mapel', // Validasi mapel
            'gambar_tugas' => 'nullable|mimes:jpeg,png,jpg,gif,svg|max:10048', // 2MB max
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Proses upload gambar
        {
            $data = $request->all();
    
            if ($request->file('gambar_tugas')) {
                $fileName = time().'.'.$request->gambar_tugas->extension();
                $request->gambar_tugas->move(public_path('gambar_tugas'), $fileName);
                $data['gambar_tugas'] = $fileName;
            }
            Tugas::create($data);
            return redirect()->route('admin.tugas.index')->with('success', 'Student created successfully.');
        }
        // Simpan data ke database
        Tugas::create([
            'kelas' => $request->input('kelas'),
            'gambar_tugas' => isset($newName) ? $newName : null,
        ]);

        return redirect()->route('admin.tugas.index')->with('success', 'Data berhasil ditambahkan!');
    }

    // hapus tugas
    public function hapus($id)
    {
        $tugas = tugas::find($id);
        if (!$tugas) {
            return redirect()->route('admin.tugas.index')->with('error', 'Data tidak ditemukan!');
        }

        // Hapus gambar jika ada
        if ($tugas->gambar_tugas && file_exists(public_path('gambar_tugas/' . $tugas->gambar_tugas))) {
            unlink(public_path('gambar_tugas/' . $tugas->gambar_tugas));
        }

        $tugas->delete();
        return redirect()->route('admin.tugas.index')->with('success', 'Data berhasil dihapus!');
    }

    
    //edit data siswa
    public function editTugas_Admin($id)
    {
    $siswa = tugas::findOrFail($id);
    $mapel = NamaMateri::all(); // Mengambil semua data mapel dari tabel mapel
    return view('admin.tugas.edit', compact('siswa', 'mapel'));
    }
    


    //update siswa
    public function updateTugass(Request $request, $id) 
{
    $request->validate([
        'kelas' => 'required|string|max:255',
        'id_mapel' => 'required|exists:mapel,id_mapel', // Validasi mapel
        'gambar_tugas' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:10048',
    ]);

    // Temukan tugas berdasarkan ID
    $siswa = Tugas::findOrFail($id);

    // Update field-field yang diinput
    $siswa->kelas = $request->kelas;
    $siswa->id_mapel = $request->id_mapel;

    // Jika ada gambar baru, hapus gambar lama dan upload yang baru
    if ($request->file('gambar_tugas')) {
        // Hapus gambar lama jika ada
        if ($siswa->gambar_tugas && file_exists(public_path('gambar_tugas/' . $siswa->gambar_tugas))) {
            unlink(public_path('gambar_tugas/' . $siswa->gambar_tugas));
        }

        // Simpan gambar baru
        $gambarName = time() . '.' . $request->file('gambar_tugas')->extension();
        $request->file('gambar_tugas')->move(public_path('gambar_tugas'), $gambarName);
        $siswa->gambar_tugas = $gambarName;
    }

    // Simpan perubahan
    $siswa->save();

    return redirect()->route('admin.tugas.index')->with('success', 'Data berhasil diubah!');
}

}
