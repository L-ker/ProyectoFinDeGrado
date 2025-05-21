<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;

class EquiposController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {    
        $equipos = auth()->user()?->equiposPokemon ?? collect(); 

        return view('equipos.index', [
            'equipos' => $equipos,
        ]);
        
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        function getPokemonIdFromUrl($url){
            return (int) rtrim(substr($url, strrpos(rtrim($url, '/'), '/') + 1), '/');
        }

        function getMoves($name){
            $pokemonDataResponse = Http::get("https://pokeapi.co/api/v2/pokemon/{$name}");
            $pokemonData = $pokemonDataResponse->json();

            return collect($pokemonData['moves'])->map(fn($move) => $move['move']['name'])->toArray();
        }
        
        $pokemonResponse = Http::get('https://pokeapi.co/api/v2/pokedex/paldea');
        $pokemonList = collect($pokemonResponse->json('pokemon_entries'))
            ->map(fn ($entry) => [
                'name' => ucfirst($entry['pokemon_species']['name']),
                'moves' => getMoves($entry['pokemon_species']['name']),
                'sprite' => "https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/" .
                            getPokemonIdFromUrl($entry['pokemon_species']['url']) . ".png",
            ]);

        // $pokemonList = collect($pokemonResponse->json('pokemon_entries'))
        //     ->map(fn ($entry) => [
        //         'name' => ucfirst($entry['pokemon_species']['name']),
        //         'url' => "https://pokeapi.co/api/v2/pokemon/" . strtolower($entry['pokemon_species']['name']),
        //         'sprite' => "https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/" .
        //                     getPokemonIdFromUrl($entry['pokemon_species']['url']) . ".png",
        //     ]);

        $itemResponse = Http::get('https://pokeapi.co/api/v2/item?limit=1000');
        $itemList = collect($itemResponse->json('results'))
            ->map(fn ($item) => [
                'name' => ucfirst($item['name']),
                'url' => $item['url'],
            ]);

        return view('equipos.create', [
            'pokemonList' => $pokemonList,
            'itemList' => $itemList,
        ]);
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
