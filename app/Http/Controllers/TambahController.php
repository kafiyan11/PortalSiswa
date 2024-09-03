<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TambahController extends Controller
{
    public function index(){
        $data = User::all();
        
        return view('admin.tambah.tambahsiswa', [
            'data' => $data
        ]);
    }
    public function store(Request $request){
        $request -> validate([
            'name' => 'required',
            'nis' => 'required',
            'role' => 'required',
            'password' => 'required',
            'plain_password' 
        ]);
        User::create([
            'name' => $request->name,
            'nis' => $request->nis,
            'password' => Hash::make($request['password']),
            'role' => $request->role,
            'plain_password' => $request['password'],
        ]);

        return redirect('/admin-tambahsiswa');
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
            'role' => 'required',
            'password' => 'required',
            'plain_password' 
        ]);
        $data = User::find($id);
        $data -> update([
            'name' => $request->name,
            'nis' => $request->nis,
            'password' => Hash::make($request['password']),
            'role' => $request->role,
            'plain_password' => $request['password'],
        ]);
        return redirect('/admin-tambahsiswa');
    }
    public function delet($id){
        $data = User::findOrFail($id);
        $data -> delete(); 
        return redirect('admin-tambahsiswa');
    }
}
