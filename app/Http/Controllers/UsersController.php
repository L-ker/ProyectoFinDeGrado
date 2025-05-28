<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!auth()->check() || (!auth()->user()->es_administrador)) {
            return redirect('/');
        }

        $users = \App\Models\User::all();
        $columnNames = \Schema::getColumnListing('users');
        
        return view('users.index', compact('users', 'columnNames'));
    }

    public function hacerOrganizador($id)
    {
        if (!auth()->check() || (!auth()->user()->es_administrador)) {
            return redirect('/');
        }

        $user = \App\Models\User::findOrFail($id);
        $user->es_organizador = true;
        $user->save();

        return redirect()->route('users.index')->with('mensaje', 'Usuario actualizado como organizador.');
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
