<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\tugas;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class TambahTugasController extends Controller
{
    public function tugas(){
        $siswa = tugas::paginate(2);
        return view('guru.tugas', ['siswa' => $siswa]);
    }

    public function tambah_tugas(){
        return view('guru.addTugas');
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
        
            return redirect()->route('guru.tugas')->with('success', 'Student created successfully.');

        }
        

        // Simpan data ke database
        Tugas::create([
            'nis' => $request->input('nis'),
            'nama' => $request->input('nama'),
            'kelas' => $request->input('kelas'),
            'jurusan' => $request->input('jurusan'),
            'gambar_tugas' => isset($newName) ? $newName : null,
        ]);

        return redirect()->route('guru.tugas')->with('success', 'Data berhasil ditambahkan!');
    }

    // hapus tugas
    public function destroy($id)
    {
        $tugas = tugas::find($id);
        if (!$tugas) {
            return redirect()->route('guru.tugas')->with('error', 'Data tidak ditemukan!');
        }
        $tugas->delete();
            return redirect()->route('guru.tugas')->with('success', 'Data berhasil dihapus!');
    }

    //edit data siswa
    public function edit($id)
    {
    $siswa = tugas::findOrFail($id);
    return view('guru.editTugas', compact('siswa'));
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

    return redirect()->route('guru.tugas')->with('success', 'Data berhasil diubah!');
}  
    public function cari(Request $request){
        $data = $request->input('cari');
        $siswa = tugas::where('nama', 'like', '%'.$data.'%')->paginate(2);

    return view('guru.tugas', compact('siswa'));
}

}