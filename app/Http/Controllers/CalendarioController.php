<?php

namespace App\Http\Controllers;
use Carbon\Carbon;

use Illuminate\Http\Request;

class CalendarioController extends Controller
{
    public function home()
    {
        $eventos = Calendario::all()->map(function ($evento) {
            return [
                'fecha' => $evento->fecha, // formato dd/mm/yyyy
                'torneo' => $evento->torneo,
            ];
        });

        return view('home', compact('eventos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $fechaOriginal = $request->fecha; // dd/mm/yyyy
        $torneoId = $request->torneo;

        [$dia, $mes, $anio] = explode('/', $fechaOriginal);

        $timestamp = mktime(0, 0, 0, $mes, $dia, $anio);

        $fechaFinInscripcion = date('d/m/Y', $timestampInscripcion);

        Calendario::create([
        'torneo' => $torneoId,
        'fecha' => $fechaOriginal,
        'fecha_fin_inscripcion' => $fechaFinInscripcion,
        ]);

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
