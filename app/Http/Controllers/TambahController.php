<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TambahController extends Controller
{
    public function index(Request $request) {
        // Ambil input pencarian dari request (GET parameter)
        $search = $request->get('search');
    
        // Query untuk menampilkan data siswa
        $data = User::where('role', 'Siswa');
    
        // Jika ada input pencarian, tambahkan filter berdasarkan nama atau NIS
        if ($search) {
            $data = $data->where(function($query) use ($search) {
                $query->where('name', 'like', "%{$search}%")
                      ->orWhere('nis', 'like', "%{$search}%");
            });
        }
    
        // Eksekusi query dengan pagination, misal 10 data per halaman
        $data = $data->paginate(5);
    
        // Return data ke view dan tetap sertakan input pencarian ke dalam pagination
        return view('admin.tambah.tambahsiswa', [
            'data' => $data,
            'search' => $search, // Kirim juga input pencarian ke view
        ]);
    }
    
    
    public function store(Request $request){
        $request -> validate([
            'name' => 'required',
            'nis' => 'required',
            'password' => 'required',
            'plain_password' 
        ]);
        User::create([
            'name' => $request->name,
            'nis' => $request->nis,
            'password' => Hash::make($request['password']),
            'role' => 'Siswa',
            'plain_password' => $request['password'],
        ]);

        return redirect('/admin-tambahsiswa')->with('success', 'Akun siswa berhasil di tambahkan');
    }
    public function create() {
        return view('admin.tambah.create');
        
    }
    public function edit(User $data,$id) {
        $data = User::findOrFail($id);
        return view('admin.tambah.edit',compact('data'));
    }
    public function update( $id, Request $request) {

        $request -> validate([
            'name' => 'required',
            'nis' => 'required',
            'password' => 'required',
            'plain_password' 
        ]);
        $data = User::find($id);
        $data -> update([
            'name' => $request->name,
            'nis' => $request->nis,
            'password' => Hash::make($request['password']),
            'role' => 'Siswa',
            'plain_password' => $request['password'],
        ]);
        return redirect('/admin-tambahsiswa')->with('success', 'Akun siswa berhasil di edit');
        }
        public function delet($id)
        {
            // Logika penghapusan data
            $data = User::find($id);

            $data->delete();
           
                return redirect()->back()->with('success','Akun berhasil di hapus');
            
        }

}