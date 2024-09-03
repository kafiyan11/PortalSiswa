<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tugas;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class TambahTugasController extends Controller
{
    public function index(){
        $siswa = tugas::all();
        return view('guru.tugas', ['siswa' => $siswa]);
    }

    public function tambah_siswa(){
        return view('guru.tambah-tugas');
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
        
            return redirect()->route('index')->with('success', 'Student created successfully.');

        }
        

        // Simpan data ke database
        Tugas::create([
            'nis' => $request->input('nis'),
            'nama' => $request->input('nama'),
            'kelas' => $request->input('kelas'),
            'jurusan' => $request->input('jurusan'),
            'gambar_tugas' => isset($newName) ? $newName : null,
        ]);

        return redirect()->route('index')->with('success', 'Data berhasil ditambahkan!');
    }
    //hapus data siswa
    public function destroy($id)
    {
        $tugas = tugas::find($id);
        if (!$tugas) {
            return redirect()->route('index')->with('error', 'Data tidak ditemukan!');
        }
        $tugas->delete();
            return redirect()->route('index')->with('success', 'Data berhasil dihapus!');
    }
    
    

    //edit data siswa
    public function edit($id)
    {
    $siswa = tugas::findOrFail($id);
    return view('guru.edit-tugas', compact('siswa'));
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

    return redirect()->route('index')->with('success', 'Data berhasil diubah!');
}

}
