<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminOOrganizador
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check() && (auth()->user()->es_administrador || auth()->user()->es_organizador)) {
            return $next($request);
        }

        return redirect('/'); // Redirige al home
    }
}
