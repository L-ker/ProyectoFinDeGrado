<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Modulo;

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

}
