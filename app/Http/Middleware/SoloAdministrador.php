<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SoloAdministrador
{
    public function handle(Request $request, Closure $next)
    {
        // Comprobar si el usuario está autenticado y es administrador
        if (auth()->check() && auth()->user()->es_administrador) {
            return $next($request);
        }

        // Si no es admin, redirige o aborta con 403
        abort(403, 'No autorizado');
    }
}
