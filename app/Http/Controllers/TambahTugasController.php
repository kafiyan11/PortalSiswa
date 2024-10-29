<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\tugas;
use App\Models\NamaMateri;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;

class TambahTugasController extends Controller
{
    public function tugas(Request $request)
{
    $query = Tugas::with('mapel');

    // Cek jika ada parameter pencarian
    if ($request->has('cari')) {
        $search = $request->get('cari');
        $query->where('nama_tugas', 'like', '%' . $search . '%')
              ->orWhereHas('mapel', function($q) use ($search) {
                  $q->where('nama_mapel', 'like', '%' . $search . '%');
              });
    }

    $siswa = $query->paginate(2);

    return view('guru.tugas.tugas', ['siswa' => $siswa]);
}

    public function tambah_tugas()
    {
        $mapel = NamaMateri::all(); // Mengambil semua data dari tabel Mapel
        return view('guru.tugas.addTugas',compact('mapel'));
    }
   
    public function create(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'nis' => 'required|unique:tugas,nis',
            'nama' => 'required|string|max:255',
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
            return redirect()->route('guru.tugas.tugas')->with('success', 'Student created successfully.');
        }
        // Simpan data ke database
        Tugas::create([
            'nis' => $request->input('nis'),
            'nama' => $request->input('nama'),
            'kelas' => $request->input('kelas'),
            'gambar_tugas' => isset($newName) ? $newName : null,
        ]);

        return redirect()->route('guru.tugas.tugas')->with('success', 'Data berhasil ditambahkan!');
    }
    

    // hapus tugas
    public function destroy($id)
    {
        $tugas = Tugas::find($id);
        if (!$tugas) {
            return redirect()->route('guru.tugas.tugas')->with('error', 'Data tidak ditemukan!');
        }
    
        // Hapus gambar jika ada
        if ($tugas->gambar_tugas && file_exists(public_path('gambar_tugas/' . $tugas->gambar_tugas))) {
            unlink(public_path('gambar_tugas/' . $tugas->gambar_tugas));
        }
    
        // Hapus data dari database
        $tugas->delete();
        return redirect()->route('guru.tugas.tugas')->with('success', 'Data berhasil dihapus!');
    }
    

    //edit data siswa
    public function edit($id)
    {
    $siswa = tugas::findOrFail($id);
    $mapel = NamaMateri::all(); // Mengambil semua data mapel dari tabel mapel
    return view('guru.tugas.editTugas', compact('siswa', 'mapel'));
    }
    


    //update siswa
    public function update(Request $request, $id)
    {
    $validatedData = $request->validate([
        'nis' => 'required|string|max:255',
        'nama' => 'required|string|max:255',
        'kelas' => 'required|string|max:255',
        'id_mapel' => 'required|exists:mapel,id_mapel', // Validasi mapel
        'gambar_tugas' => 'nullable|image|mimes:jpeg,png,pdf,jpg,gif,svg|max:40048',
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

    return redirect()->route('guru.tugas.tugas')->with('success', 'Data berhasil diubah!');
    }
}