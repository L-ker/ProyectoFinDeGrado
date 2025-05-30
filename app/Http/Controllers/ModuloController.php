<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Modulo;
;

class ModuloController extends Controller
{
    public function updateLink(Request $request, Modulo $modulo)
    {
        $request->validate([
            'enlace' => 'required|url',
        ]);

        $usuarioId = auth()->id();

        if ($modulo->user1_id !== $usuarioId && $modulo->user2_id !== $usuarioId) {
            abort(403, 'No autorizado');
        }

        if ($usuarioId == $modulo->user1_id) {
            $modulo->enlace_user1 = $request->input('enlace');
        } else {
            $modulo->enlace_user2 = $request->input('enlace');
        }

        $modulo->save();

        if ($modulo->enlace_user1 && $modulo->enlace_user2) {
            if ($modulo->enlace_user1 === $modulo->enlace_user2) {
                // Combate confirmado
                $modulo->enlace_definitivo = $modulo->enlace_user1;
                $modulo->save();
                session()->flash('success', 'Enlace confirmado por ambos jugadores.');
            } else {
                // Enlaces diferentes
                session()->flash('warning', 'Los enlaces no coinciden. Esperando confirmación del otro jugador.');
            }
        } else {
            session()->flash('info', 'Enlace enviado, esperando al otro jugador.');
        }

        return back();
    }

    public function comprobarEstadoModulo(Modulo $modulo)
    {
        
        $enlaceReplay = $this->ajusteEnlace($modulo->enlace_definitivo);
        try {
        $response = Http::get($enlaceReplay);

        if ($response->successful()) {
            $contenido = $response->body(); // Aquí tienes el contenido del .log
            // Puedes procesar $contenido para buscar al ganador
        } else {
            // Manejar error HTTP (como 404 si no existe)
            $contenido = null;
            session()->flash('error', 'No se pudo obtener el log del combate. Código: ' . $response->status());
        }
        } catch (\Exception $e) {
            session()->flash('error', 'Error al hacer la petición al replay: ' . $e->getMessage());
            $contenido = null;
        }

        $contenido = $this->procesarContenido($contenido);

        if ($contenido != null) {
            $nombreUsuario1 = $modulo->usuario1->nombre ?? null;
            if ($contenido === $nombreUsuario1) {
                $modulo->ganador_id = $modulo->usuario1->id;
            } else {
                $modulo->ganador_id = $modulo->usuario2->id;
            }

            $modulo->save();
        }

        return response()->json([
            'modulo' => $modulo,
        ]);
    }

    private function ajusteEnlace($enlace) {
        $parte = str_replace('https://play.pokemonshowdown.com/battle-', '', $enlace);
        return 'https://replay.pokemonshowdown.com/' . $parte . '.log';
    }

    // Método de utilidad (puedes mejorarlo según cómo Showdown devuelva resultados)
    private function procesarContenido($contenido)
    {
        $lineas = explode("\n", $contenido);

        foreach ($lineas as $linea) {
            if (str_starts_with(trim($linea), '|win|')) {
                return trim(substr($linea, strlen('|win|')));
            }
        }

        return null;
    }


}
