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
            return response()->json(['message' => 'Ya estás dentro del torneo'], 200);
        }

        JugadorEnTorneo::create([
            'torneo_id' => $torneoId,
            'user_id' => $userId,
        ]);

        return response()->json(['message' => 'Listo para el torneo'], 201);

    } catch (\Exception $e) {
        return response()->json(['message' => 'Error en el servidor', 'error' => $e->getMessage()], 500);
    }
}

}
