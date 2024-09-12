<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TambahOrangtuaController extends Controller
{
    public function index(){
        $orang = User::where('role', 'Orang Tua')->get();
        
        return view('admin.tambahortu.ortu', [
            'orang' => $orang
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

        return redirect(route('ortu'));
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
        return redirect(route('ortu'));
        }
        public function delet($id){
            $data = User::findOrFail($id);
            $data -> delete(); 
            return redirect(route('ortu'));
        }
}
