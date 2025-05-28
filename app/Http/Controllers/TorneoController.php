<?php

namespace App\Http\Controllers;

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
        return view('torneos.show', compact('torneo'));
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
            abort(403); // No autorizado
        }

        $torneo->estado = 'activo';
        $torneo->save();

        return redirect()->back()->with('success', 'Torneo iniciado.');
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