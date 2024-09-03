<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->role == 'Admin') {
            return $next($request);
        }

        return redirect('/login')->withErrors(['role' => 'Anda tidak memiliki akses ke halaman ini.']);
    }
}
