<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminAuth
{
    public function handle(Request $request, Closure $next)
    {
        // Cek apakah session admin_id ada
        if (!session('admin_id')) {
            return redirect('/admin/login');
        }

        return $next($request);
    }
}
