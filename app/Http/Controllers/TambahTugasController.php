<?php

namespace App\Http\Controllers;

use App\Models\Tugas;
use App\Models\NamaMateri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class TambahTugasController extends Controller
{
    public function tugas(Request $request)
    {
        $guru = Auth::user();
    
        // Ambil nama mapel dari `mengajar`
        $mapelNames = explode(',', $guru->mengajar);
    
        // Ambil ID mapel yang sesuai dengan nama di dalam `mengajar`
        $mapelIds = NamaMateri::whereIn('nama_mapel', $mapelNames)->pluck('id_mapel')->toArray();
    
        $query = Tugas::with('mapel')->whereIn('id_mapel', $mapelIds);
    
        // Pencarian berdasarkan nama tugas atau nama mapel
        if ($request->has('cari')) {
            $search = $request->get('cari');
            $query->where(function($q) use ($search) {
                $q->where('nama_tugas', 'like', '%' . $search . '%')
                  ->orWhereHas('mapel', function($q) use ($search) {
                      $q->where('nama_mapel', 'like', '%' . $search . '%');
                  });
            });
        }
    
        $siswa = $query->paginate(4);
        return view('guru.tugas.tugas', ['siswa' => $siswa]);
    }
    
    

    public function tambah_tugas()
    {
        $mapel = NamaMateri::all();
        return view('guru.tugas.addTugas', compact('mapel'));
    }
   
    public function create(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'kelas' => 'required|string|max:255',
            'id_mapel' => 'required|exists:mapel,id_mapel', // Validasi mapel
            'gambar_tugas' => 'nullable|mimes:jpeg,png,jpg,gif,svg|max:10048', // Max 10MB
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        // Proses upload gambar
        $data = $request->all();
        if ($request->file('gambar_tugas')) {
            $fileName = time().'.'.$request->gambar_tugas->extension();
            $request->gambar_tugas->move(public_path('gambar_tugas'), $fileName);
            $data['gambar_tugas'] = $fileName;
        }

        // Simpan data ke database
        Tugas::create($data);
        return redirect()->route('guru.tugas.tugas')->with('success', 'Data berhasil ditambahkan!');
    }
    
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
    
    public function edit($id)
    {
        $siswa = Tugas::findOrFail($id);
        $mapel = NamaMateri::all();
        return view('guru.tugas.editTugas', compact('siswa', 'mapel'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'kelas' => 'required|string|max:255',
            'id_mapel' => 'required|exists:mapel,id_mapel', // Validasi mapel
            'gambar_tugas' => 'nullable|image|mimes:jpeg,png,pdf,jpg,gif,svg|max:40048', // Max 40MB
        ]);

        $tugas = Tugas::findOrFail($id);

        // Update field kelas dan id_mapel
        $tugas->kelas = $validatedData['kelas'];
        $tugas->id_mapel = $validatedData['id_mapel'];

        // Jika ada gambar baru, hapus gambar lama dan upload yang baru
        if ($request->file('gambar_tugas')) {
            if ($tugas->gambar_tugas && file_exists(public_path('gambar_tugas/' . $tugas->gambar_tugas))) {
                unlink(public_path('gambar_tugas/' . $tugas->gambar_tugas));
            }

            $gambarName = time() . '.' . $request->file('gambar_tugas')->extension();
            $request->file('gambar_tugas')->move(public_path('gambar_tugas'), $gambarName);
            $tugas->gambar_tugas = $gambarName;
        }

        $tugas->save();
        return redirect()->route('guru.tugas.tugas')->with('success', 'Data berhasil diubah!');
    }
}
