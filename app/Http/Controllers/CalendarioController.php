<?php

namespace App\Http\Controllers;
use Carbon\Carbon;

use Illuminate\Http\Request;
use App\Models\Calendario;
use App\Models\Torneos;

class CalendarioController extends Controller
{
    public function home()
    {

        $eventos = Calendario::all()->map(function ($evento) {
            $torneo = Torneos::find($evento->torneo);

            return [
                'fecha' => $evento->fecha, // formato dd/mm/yyyy
                'torneo' => $evento->torneo,
                'nombre' => $torneo?->nombre ?? 'Torneo desconocido',
            ];
        });

        return view('home', compact('eventos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    Calendario::crearConFecha($request->torneo, $request->fecha);
    return view('home');
}



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
