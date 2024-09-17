<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TambahGuruController extends Controller
{
    public function index(){
        $guru = User::where('role', 'Guru')->get();
        
        return view('admin.tambahguru.dataguru', [
            'guru' => $guru
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
