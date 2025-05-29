<?php

namespace App\Http\Controllers;

use App\Models\EquiposUsuarios;
use Illuminate\Http\Request;
use App\Models\Torneos;
use App\Models\Calendario;

class TorneoController extends Controller
{
    public function index()
    {
        abort(404);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!auth()->check() || (!auth()->user()->es_administrador)) {
            return redirect('/');
        }
        return view("torneos.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $torneo = Torneos::create([
        'organizador' => $request->organizador_id,
        'modalidad' => $request->modalidad,
        'nombre' => $request->nombre,
        'hora_comienzo' => $request->hora_comienzo,
    ]);

    Calendario::crearConFecha($torneo->id, $request->fecha);

    return redirect()->route('home');
}


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $torneo = Torneos::findOrFail($id);
    $userId = auth()->id();

    $equipos = EquiposUsuarios::where('idUsuario', $userId)->pluck('idEquipo');

    return view('torneos.show', compact('torneo', 'equipos'));
    }

    public function estado($id)
    {
        $torneo = Torneos::findOrFail($id);
        return response()->json(['estado' => $torneo->estado]);
    }

    public function iniciar($id)
    {
        $torneo = Torneos::findOrFail($id);

        if (auth()->id() !== $torneo->organizador) {
            return redirect()->back()->with('mensaje', 'No estás autorizado para ver esta página.');
        }

        $torneo->estado = 'activo';
        $torneo->save();

        $jugadores = JugadorEnTorneo::where('torneo_id', $torneo->id)->get();
        if ($jugadores->count() < 2) {
            return back()->with('mensaje', 'Necesitas al menos 2 jugadores para iniciar el torneo.');
        }

        $this->generarBracket($torneo, $jugadores);

        return redirect()->back()->with('success', 'Torneo iniciado.');
    }

    private function generarBrackets(Torneos $torneo, $jugadores)
    {
        // sacar el numero de byes
        $totalJugadores = $jugadores->count();
        $siguientePotencia = pow(2, ceil(log($totalJugadores, 2)));
        $numeroDeByes = $siguientePotencia - $totalJugadores;

        //array con usuarios y la cantidad de byes
        $jugadoresIds = $jugadores->pluck('user_id')->toArray();

        for ($i = 0; $i < $numeroDeByes; $i++) {
            $jugadoresIds[] = null;
        }

        shuffle($jugadoresIds);

        //despues del shuffle ha podido darse pares null-null asi que lo reorganizamos agregando 
        $jugadoresFiltrados = [];
        $byeCount = 0;
        foreach ($jugadoresIds as $id) {
            if ($id === null) {
                // Intercalar los byes
                array_splice($jugadoresFiltrados, $byeCount * 2, 0, [$id]);
                $byeCount++;
            } else {
                $jugadoresFiltrados[] = $id;
            }
        }
        

         // Crear módulos base (ronda 1)
        for ($i = 0; $i < count($jugadoresFiltrados); $i += 2) {
            // Evitar módulo con dos nulos

            Modulo::create([
                'torneo_id' => $torneo->id,
                'ronda' => 1,
                'jugador1_id' => $jugadoresFiltrados[$i],
                'jugador2_id' => $jugadoresFiltrados[$i + 1] ?? null,
            ]);
        }

    }




    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Torneo $torneo)
    {
        // return view('usuarios.edit',compact('usuario'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Torneo $torneo)
    {

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Torneo $torneo)
    {

    }
}