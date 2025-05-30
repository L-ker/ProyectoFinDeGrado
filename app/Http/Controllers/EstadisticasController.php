<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Torneos;
use Illuminate\Support\Facades\Auth;


class EstadisticasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {    
        $userId = auth()->id();
        $torneosGanados = Torneos::where('ganador', $userId)->count();
        return view('estadisticas.index', compact('torneosGanados'));
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        
    }
}

