<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Torneos;

class TorneoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("torneo.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //se tiene que crear el calendario a la vez
        //  $request->merge([
        //     'password' => Crypt::encryptString($request->password) 
        // ]);

        // $usuario = new Usuarios($request->input());

        // $usuario->save();
        // session()->flash("mensaje",__('El usuario') .' '. $usuario->nombre .''. __('ha sido registrado'));

        // return redirect()->route('home');
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
    public function edit(Torneo $torneo)
    {
        // return view('usuarios.edit',compact('usuario'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Torneo $torneo)
    {
        // $request->merge([
        //     'password' => Crypt::encryptString($request->password) 
        // ]);

        // $usuario->update($request->input());
        // session()->flash("mensaje",__('El usuario') .' '. $usuario->nombre.''. __('ha sido actualizado'));
        // return redirect()->route('usuarios.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Torneo $torneo)
    {
        // $usuario->delete();
        // session()->flash("mensaje",__('El usuario') .' '. $usuario->nombre .''. __('ha sido eliminado'));
        // return redirect()->route('usuarios.index');
    }
}
