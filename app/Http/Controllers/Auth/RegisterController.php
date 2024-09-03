<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = '/';

    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'nis' => ['required', 'string', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role' => ['required', 'string'],
        ]);
    }

    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'nis' => $data['nis'],
            'password' => Hash::make($data['password']),
            'role' => $data['role'],
        ]);
    }

    protected function registered(Request $request, $user)
    {
        switch ($user->role) {
            case 'Admin':
                return redirect()->route('admin.dashboard');
            case 'Siswa':
                return redirect()->route('siswa.dashboard');
            case 'Guru':
                return redirect()->route('guru.dashboard');
            case 'Orang Tua':
                return redirect()->route('orangtua.dashboard');
            default:
                return redirect()->route('home'); // Mengarahkan ke halaman home jika role tidak cocok
        }
    }
    
    
}
