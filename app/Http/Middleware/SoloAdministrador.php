<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SoloAdministrador
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check() && auth()->user()->es_administrador) {
            return $next($request);
        }

        return redirect('/'); // Redirige al home
    }
}
