<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TambahGuruController extends Controller
{
    public function index(Request $request)
    {
        // Mengambil kata kunci pencarian dari form
        $search = $request->input('search');
    
        // Query untuk mencari data guru berdasarkan nama atau NIS
        $guru = User::where('role', 'Guru')
                    ->when($search, function ($query, $search) {
                        return $query->where(function ($q) use ($search) {
                            $q->where('name', 'like', '%' . $search . '%')
                              ->orWhere('nis', 'like', '%' . $search . '%');
                        });
                    })
                    ->get();
    
        // Mengirim data guru dan kata kunci pencarian ke view
        return view('admin.tambahguru.dataguru', [
            'guru' => $guru,
            'search' => $search // opsional, jika ingin menampilkan kata kunci pencarian di view
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
            'role' => 'Guru',
            'plain_password' => $request['password'],
        ]);

        return redirect(route('tambahguru'))->with('success','Akun guru berhasil di tambahkan');
    }
    public function create() {
        return view('admin.tambahguru.createguru');
        
    }
    public function edit(User $data,$id) {
        $data = User::findOrFail($id);
        return view('admin.tambahguru.editguru',compact('data'));
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
            'role' => 'Guru',
            'plain_password' => $request['password'],
        ]);
        return redirect('admin-tambahguru')->with('success','Akun guru berhasil di edit');
        }
        public function delet($id){
            $data = User::findOrFail($id);
            $data -> delete(); 
            return redirect('admin-tambahguru')->with('success','Akun guru berhasil di hapus');
        }
}
