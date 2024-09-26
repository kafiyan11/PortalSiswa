<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\tugas;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class TambahTugasController extends Controller
{
    public function tugas()
    {
        $siswa = Tugas::paginate(10);
        return view('guru.tugas.tugas', ['siswa' => $siswa]);
    }

    public function tambah_tugas(){
        return view('guru.tugas.addTugas');
    }
   
    public function create(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'nis' => 'required|unique:tugas,nis',
            'nama' => 'required|string|max:255',
            'kelas' => 'required|string|max:255',
            'jurusan' => 'required|string|max:255',
            'gambar_tugas' => 'nullable|mimes:jpeg,png,jpg,gif,svg|max:10048', // 10MB max
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        // Ambil semua data dari request
        $data = $request->all();
    
        // Proses upload gambar
        if ($request->hasFile('gambar_tugas')) {
            $fileName = time() . '.' . $request->file('gambar_tugas')->extension();
            $request->file('gambar_tugas')->move(public_path('gambar_tugas'), $fileName);
            $data['gambar_tugas'] = $fileName;
        }
    
        // Simpan data ke database
        Tugas::create($data);
    
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
    return view('guru.tugas.editTugas', compact('siswa'));
    }
    


    //update siswa
    public function update(Request $request, $id)
{
    $validatedData = $request->validate([
        'nis' => 'required|string|max:255',
        'nama' => 'required|string|max:255',
        'kelas' => 'required|in:10,11,12',
        'jurusan' => 'required|in:TKR,TKJ,RPL,OTKP,AK,SK',
        'gambar_tugas' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:10048',
    ]);

    $siswa = Tugas::findOrFail($id);

    // Update field-field yang diinput
    $siswa->nis = $validatedData['nis'];
    $siswa->nama = $validatedData['nama'];
    $siswa->kelas = $validatedData['kelas'];
    $siswa->jurusan = $validatedData['jurusan'];

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

    public function cari(Request $request){
        $data = $request->input('cari');
        $siswa = tugas::where('nis', 'like', '%'.$data.'%')->paginate(10);

    return view('guru.tugas.tugas', compact('siswa'));
}
// public function lihatAdmin()
// {
//     $siswa = Tugas::paginate(10);
//     return view('admin.tugas', compact('siswa')); 
// }
public function wujud()
{
    $siswa = tugas::paginate(2);
    return view('admin.tugas', compact('siswa'));
}

}