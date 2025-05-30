<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Torneos;
use App\Models\Modulo;
use App\Models\User;
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
        // Obtén jugador, torneo, etc (igual que antes)
        $jugador = JugadorEnTorneo::where('torneo_id', $torneoId)
                                ->where('user_id', auth()->id())
                                ->first();

        $torneo = Torneos::findOrFail($torneoId);

        if (!$jugador && !(auth()->id() === $torneo->organizador)) {
            return redirect()->route('torneos.show', $torneoId)->with('mensaje', 'No estás inscrito en este torneo.');
        }

        // Obtener módulos
        $modulos = Modulo::with(['usuario1', 'usuario2'])
                    ->where('torneo_id', $torneoId)
                    ->orderBy('ronda')
                    ->orderBy('id')
                    ->get();

        // Aquí puedes iterar los módulos y actualizar su estado
        $moduloController = app(\App\Http\Controllers\ModuloController::class);
        foreach ($modulos as $modulo) {
            if ($modulo->enlace_definitivo && !$modulo->ganador_id) {
                $moduloController->comprobarEstadoModulo($modulo);
                $modulo->refresh();
            }
            if ($modulo->ganador_id) {
                foreach ($modulos as $modulo) {
                    // Buscamos si este módulo es hijo de algún otro
                    $siguienteModulo = Modulo::where('modulo_hijo1_id', $modulo->id)
                        ->orWhere('modulo_hijo2_id', $modulo->id)
                        ->first();

                    if ($siguienteModulo) {
                        // Aquí asignamos el ganador al siguiente módulo en la posición libre
                        if ($siguienteModulo->user1_id === null) {
                            $siguienteModulo->user1_id = $modulo->ganador_id;
                            $siguienteModulo->save();
                        } elseif ($siguienteModulo->user2_id === null) {
                            $siguienteModulo->user2_id = $modulo->ganador_id;
                            $siguienteModulo->save();
                        }
                    }
                }
            }
            if ($modulo->user1_id === null) {
                $modulo->ganador_id = $modulo->user2_id;
            }
            if ($modulo->user2_id === null) {
                $modulo->ganador_id = $modulo->user1_id;
            }
        }

        $rondaMaxima = Modulo::where('torneo_id', $torneoId)->max('ronda');

        for ($ronda = $rondaMaxima; $ronda > 1; $ronda--) {
            $modulosRonda = Modulo::where('torneo_id', $torneoId)
                ->where('ronda', $ronda)
                ->get();

            $todosOcupados = true;

            foreach ($modulosRonda as $modulo) {
                if (is_null($modulo->user1_id) && is_null($modulo->user2_id)) {
                    $todosOcupados = false;
                    break;
                }
            }

            if ($todosOcupados && $ronda == $rondaMaxima) {
                $torneo->ganador = $modulo->ganador_id;
                $torneo->estado = "cerrado";
                $torneo->save();

                if ($torneo->ganador) {
                    $torneo->ganador = User::find($torneo->ganador);
                }
            } else if ($todosOcupados) {
                foreach ($modulosRonda as $modulo) {
                    $torneo = Torneos::find($torneoId);
                    $torneo->ronda_actual = $ronda; 
                    $torneo->save();
                }
            }
        }


        // Refresca módulos para que estén actualizados
        $modulos = Modulo::with(['usuario1', 'usuario2'])
                    ->where('torneo_id', $torneoId)
                    ->orderBy('ronda')
                    ->orderBy('id')
                    ->get();

        return view('jugador-en-torneo.show', compact('jugador', 'torneo', 'modulos'));
    }



}
