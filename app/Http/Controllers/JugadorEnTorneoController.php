<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JugadorEnTorneo;

class JugadorEnTorneoController extends Controller
{
    public function marcarPreparado(Request $request, $torneoId)
    {
        try {
            $userId = auth()->id();

            $existe = JugadorEnTorneo::where('torneo_id', $torneoId)
                ->where('user_id', $userId)
                ->first();

            if ($existe) {
                return redirect()->route('torneos.show', $torneoId)->with('mensaje', 'Ya estás dentro del torneo');
            }

            JugadorEnTorneo::create([
                'torneo_id' => $torneoId,
                'user_id' => $userId,
                'equipo_id' => $request->equipo_id,
            ]);

            return redirect()->route('torneos.show', $torneoId)->with('mensaje', 'Listo para el torneo');

        } catch (\Exception $e) {
            return redirect()->route('torneos.show', $torneoId)->with('mensaje', 'Error en el servidor');
        }
    }

    public function show($torneoId)
    {
        // Obtener datos para mostrar, por ejemplo:
        $jugador = JugadorEnTorneo::where('torneo_id', $torneoId)
                                ->where('user_id', auth()->id())
                                ->first();

        $torneo = Torneos::findOrFail($torneoId);

        if (!$jugador && !(auth()->id() === $torneo->organizador)) {
            return redirect()->route('torneos.show', $torneoId)->with('mensaje', 'No estás inscrito en este torneo.');
        }

        $modulos = Modulo::with(['usuario1', 'usuario2'])
        ->where('torneo_id', $torneoId)
        ->orderBy('ronda')
        ->orderBy('id')
        ->get();

        // Retornar una vista con la info del jugador en el torneo
        return view('jugador-en-torneo.show', compact('jugador', 'torneo', 'modulos'));
    }



}
