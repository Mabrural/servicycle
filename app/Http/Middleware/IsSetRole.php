<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsSetRole
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Pastikan user sudah login
        if (auth()->check()) {
            // Jika belum set role
            if (!auth()->user()->is_set_role) {
                return redirect('/pilih-role');
            }
        }

        return $next($request);
    }
}
