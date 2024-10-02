<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Materi;
use App\Models\tugas;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    /**
     * Show the admin dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('admin.dashboard');
    }



    //Profil Admin
    public function Profile()
    {
        // Retrieve the currently authenticated user
        $user = Auth::user();

        // Redirect to the 'profil.blade.php' view with user data
        return view('admin.profile.index', compact('user'));
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


    //Materi
        public function materiAdmin()
        {
            $materi = Materi::paginate(2); // Mengambil semua data materi
            return view('admin.materi.index',  ['materi' => $materi]); // Mengarahkan ke view untuk menampilkan daftar materi
        }
    
        public function createMateri()
        {
            return view('admin.materi.create');
        }
    
        public function storeAdmin(Request $request)
        {
            $request->validate([
                'judul' => 'required|string|max:255',
                'kelas' => 'required|string|max:255',
                'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'link_youtube' => 'nullable|url',
            ]);
    
            if ($request->hasFile('gambar')) {
                // Proses upload gambar
                $gambarPath = $request->file('gambar')->store('materi', 'public');
            }
    
            // Validasi bahwa salah satu harus diisi
            if (!$request->hasFile('gambar') && !$request->link_youtube) {
                return back()->withErrors(['msg' => 'Anda harus mengunggah gambar atau memasukkan link YouTube.']);
            }
    
            // Simpan data ke database
            Materi::create([
                'judul' => $request->judul,
                'kelas' => $request->kelas,
                'gambar' => $gambarPath ?? null,
                'link_youtube' => $request->link_youtube ?? null,
                'tipe' => $request->tipe,
            ]);
    
            return redirect()->route('admin.materi.index')->with('success', 'Materi berhasil diunggah.');
        }
        // Menampilkan form edit
        public function edittMateri($id)
        {
            $materi = Materi::findOrFail($id); // Mengambil data berdasarkan ID
            return view('admin.materi.edit', compact('materi')); // Menampilkan view edit dengan data materi
        }
    
        // Menyimpan perubahan (update data)
        public function updateMateri(Request $request, $id)
        {
            // Validasi input
            $request->validate([
                'judul' => 'required|string|max:255',
                'tipe' => 'required|string',
                'kelas' => 'required|string|max:255',
                'gambar' => 'nullable|image|max:2048', // jika tipe gambar
                'link_youtube' => 'nullable|url' // jika tipe youtube
            ]);
    
            $materi = Materi::findOrFail($id); // Mengambil data berdasarkan ID
    
            // Update data materi
            $materi->judul = $request->judul;
            $materi->kelas = $request->kelas;
            $materi->tipe = $request->tipe;
    
            // Jika mengupload gambar
            if ($request->hasFile('gambar')) {
                $path = $request->file('gambar')->store('materi', 'public');
                $materi->gambar = $path;
            }
    
            // Jika memasukkan link YouTube
            if ($request->tipe == 'youtube') {
                $materi->link_youtube = $request->link_youtube;
            }
    
            $materi->save(); // Simpan perubahan ke database
    
            return redirect()->route('admin.materi.index')->with('success', 'Materi berhasil diperbarui.');
        }
    
        // Menghapus materi
        public function destroyMateri($id)
        {
            $materi = Materi::findOrFail($id); // Mengambil data berdasarkan ID
            $materi->delete(); // Menghapus data
    
            return redirect()->route('admin.materi.index')->with('success', 'Materi berhasil dihapus.');
        }
        public function cariMateri(Request $request)
    {
        $cari = $request->input('cari');
        $materi = Materi::when($cari, function ($query, $cari) {
            return $query->where('judul', 'like', '%' . $cari . '%');
        })->paginate(2); // Pastikan paginate() digunakan di sini
        return view('admin.materi.index', compact('materi'));
    }
    
    //TUGAS
    public function tugas()
    {
        $siswa = Tugas::paginate(2);
        return view('admin.tugas.index', ['siswa' => $siswa]);
    }

    public function tambah_tugas(){
        return view('admin.tugas.create');
    }
   
    public function create(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'nis' => 'required|unique:tugas,nis',
            'nama' => 'required|string|max:255',
            'kelas' => 'required|string|max:255',
            'gambar_tugas' => 'nullable|mimes:jpeg,png,jpg,gif,svg|max:10048', // 2MB max
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        // dd($request->all());
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
            'nis' => $request->input('nis'),
            'nama' => $request->input('nama'),
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
        $tugas->delete();
            return redirect()->route('admin.tugas.index')->with('success', 'Data berhasil dihapus!');
    }

    
    //edit data siswa
    public function editTugas_Admin($id)
    {
    $siswa = tugas::findOrFail($id);
    return view('admin.tugas.edit', compact('siswa'));
    }
    


    //update siswa
    public function updateTugass(Request $request, $id)
    {
    $validatedData = $request->validate([
        'nis' => 'required|string|max:255',
        'nama' => 'required|string|max:255',
        'kelas' => 'required|string|max:255',
        'gambar_tugas' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:10048',
    ]);

    $siswa = Tugas::findOrFail($id);

    // Update field-field yang diinput
    $siswa->nis = $validatedData['nis'];
    $siswa->nama = $validatedData['nama'];
    $siswa->kelas = $validatedData['kelas'];

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

    $siswa->save();

    return redirect()->route('admin.tugas.index')->with('success', 'Data berhasil diubah!');
    }
    public function cari(Request $request){
        $data = $request->input('cari');
        $siswa = tugas::where('nis', 'like', '%'.$data.'%')->paginate(10);

    return view('admin.tugas.index', compact('siswa'));
    }
}
