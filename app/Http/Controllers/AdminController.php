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
    public function profil()
    {
        $item=Auth::user();
        return view('admin.profil', compact('item'));
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
                'jurusan' => 'required|string|max:255',
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
                'kelas' => $request->input('kelas'),
                'jurusan' => $request->input('jurusan'),
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
                'kelas' => 'required|in:10,11,12',
                'jurusan' => 'required|in:TKR,TKJ,RPL,OTKP,AK,DPIB,SK', // tipe bisa berupa gambar atau youtube
                'gambar' => 'nullable|image|max:2048', // jika tipe gambar
                'link_youtube' => 'nullable|url' // jika tipe youtube
            ]);
    
            $materi = Materi::findOrFail($id); // Mengambil data berdasarkan ID
    
            // Update data materi
            $materi->judul = $request->judul;
            $materi->kelas = $request->kelas;
            $materi->jurusan = $request->jurusan;
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
            'jurusan' => 'required|string|max:255',
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
            'jurusan' => $request->input('jurusan'),
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
    public function editTugas($id)
    {
    $siswa = tugas::findOrFail($id);
    return view('admin.tugas.edit', compact('siswa'));
    }
    


    //update siswa
    public function updateTugas(Request $request, $id)
    {
    $validatedData = $request->validate([
        'nis' => 'required|string|max:255',
        'nama' => 'required|string|max:255',
        'kelas' => 'required|in:10,11,12',
        'jurusan' => 'required|in:TKR,TKJ,RPL,OTKP,AK,SK',
        'gambar_tugas' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:10048',
    ]);

    $siswa = tugas::findOrFail($id);

    $siswa->nis = $validatedData['nis'];
    $siswa->nama = $validatedData['nama'];
    $siswa->kelas = $validatedData['kelas'];
    $siswa->jurusan = $validatedData['jurusan'];

    if ($request->file('gambar_tugas')) {
        $gambar = $request->file('gambar_tugas');
        $gambarName = time() . '.' . $gambar->extension();
        $gambar->move(public_path('gambar_tugas'), $gambarName);
        $siswa->gambar_tugas = $gambarName;
    }

    $siswa->save();

    return redirect()->route('admin.tugas.index')->with('success', 'Data berhasil diubah!');
    }  
    public function cari(Request $request){
        $data = $request->input('cari');
        $siswa = tugas::where('nis', 'like', '%'.$data.'%')->paginate(2);

    return view('admin.tugas.index', compact('siswa'));
    }
}
