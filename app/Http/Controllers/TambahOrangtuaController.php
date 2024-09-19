<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TambahOrangtuaController extends Controller
{
public function index(Request $request)
{
    // Ambil nilai dari input pencarian (search)
    $search = $request->input('search');

    // Query untuk mendapatkan data orang tua
    // Jika ada pencarian, tambahkan filter where untuk nama atau NIS
    $orang = User::where('role', 'Orang Tua')
                 ->when($search, function ($query, $search) {
                     return $query->where(function($q) use ($search) {
                         $q->where('name', 'like', "%{$search}%")
                           ->orWhere('nis', 'like', "%{$search}%");
                     });
                 })
                 ->get();

    // Kirim data orang tua dan nilai pencarian ke view
    return view('admin.tambahortu.ortu', [
        'orang' => $orang,
        'search' => $search
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
            'role' => 'Orang Tua',
            'plain_password' => $request['password'],
        ]);

        return redirect(route('ortu'))->with('success','Akun Orang Tua Berhasil Di tambahkan');
    }
    public function create() {
        return view('admin.tambahortu.createortu');
        
    }
    public function edit(User $data,$id) {
        $data = User::findOrFail($id);
        return view('admin.tambahortu.editortu',compact('data'));
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
            'role' => 'Orang Tua',
            'plain_password' => $request['password'],
        ]);
        return redirect(route('ortu'))->with('success','Akun Orang Tua Berhasil Di Edit');
        }
        public function delet($id){
            $data = User::findOrFail($id);
            $data -> delete(); 
            return redirect(route('ortu'))->with('success','Akun Orang Tua Berhasil Di Hapus');
        }
}
