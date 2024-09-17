<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function Laravel\Prompts\error;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected function authenticated(Request $request, $user)
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
    
    public function login(Request $request)
    {
        $credentials = $request->only('nis', 'password');
    
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            
            switch ($user->role) {
                case 'Admin':
                    return redirect()->intended('admin-dashboard')->with('success', 'Login Berhasil');
                case 'Siswa':
                    return redirect()->intended('siswa-dashboard')->with('success', 'Login Berhasil');
                case 'Guru':
                    return redirect()->intended('guru-dashboard')->with('success', 'Login Berhasil');
                case 'Orang Tua':
                    return redirect()->intended('orangtua-dashboard')->with('success', 'Login Berhasil');
                default:
                    Auth::logout();
                    return redirect()->route('login')->withErrors(['role' => 'Role tidak valid.']);
            }
        }
    
        // Login gagal
        return redirect()->back()->with('error', 'Login gagal');
    }
    

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
