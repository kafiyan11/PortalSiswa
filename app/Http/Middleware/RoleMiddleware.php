<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * Redirect user to their respective dashboard based on role.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next,...$roles)
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        $role = Auth::user()->role;

        if(!in_array($role, $roles)){
            switch ($role) {
                case 'Admin':
                    return redirect('/admin-dashboard');
                case 'Siswa':
                    return redirect('/siswa-dashboard');
                case 'Guru':
                    return redirect('/guru-dashboard');
                case 'Orang Tua':
                    return redirect('/orangtua-dashboard');
                default:
                    Auth::logout();
                    return redirect('/login')->withErrors(['role' => 'Role tidak valid.']);
            }
        }

        

        return $next($request);
    }
}
