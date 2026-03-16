<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!session('admin')) {
            return redirect('/admin/login')->with('error', 'Veuillez vous connecter d\'abord !');
        }

        return $next($request);
    }
}