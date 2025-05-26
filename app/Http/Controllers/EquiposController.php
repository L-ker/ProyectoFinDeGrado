<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use App\Models\Pokemon;
use App\Models\equiposUsuarios;
use App\Models\EquiposPokemon;

class EquiposController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {    
    $usuario = auth()->user();

    $equipos = $usuario->equiposUsuarios->map(function ($eu) {
        return $eu->equipo;
    });

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
        $pokemonResponse = Http::get('https://pokeapi.co/api/v2/pokedex/paldea');
        $pokemonList = collect($pokemonResponse->json('pokemon_entries'))
            ->map(fn ($entry) => [
                'name' => ucfirst($entry['pokemon_species']['name']),
                'url' => "https://pokeapi.co/api/v2/pokemon/" . strtolower($entry['pokemon_species']['name']),
                'sprite' => "https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/" .
                            getPokemonIdFromUrl($entry['pokemon_species']['url']) . ".png",
            ]);

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
        // Para testear qué datos llegan, muestra y para ejecución aquí:
        // dd($request->all());
        $pokemonIds = [];

        for ($i = 1; $i <= 6; $i++) {
            $data = $request->input("pokemon_$i");

            $pokemon = Pokemon::create([
                'nombre'           => $data['name'],
                'terastallization' => $data['terastallization'],
                'objeto'           => $data['item'],
                'movimiento1'      => $data['moves'][0],
                'movimiento2'      => $data['moves'][1],
                'movimiento3'      => $data['moves'][2],
                'movimiento4'      => $data['moves'][3],
                'sprite'           => $data['sprite'],
            ]);

            $pokemonIds[] = $pokemon->id;
        }

        // Crear el equipo Pokémon con los campos correctos en $fillable y base datos
        $equipoPokemon = EquiposPokemon::create([
            'idPokemon1' => $pokemonIds[0],
            'idPokemon2' => $pokemonIds[1],
            'idPokemon3' => $pokemonIds[2],
            'idPokemon4' => $pokemonIds[3],
            'idPokemon5' => $pokemonIds[4],
            'idPokemon6' => $pokemonIds[5],
        ]);

        // Asociar equipo con usuario actual con los campos correctos
        EquiposUsuarios::create([
            'idUsuario' => Auth::id(),
            'idEquipo' => $equipoPokemon->id,
        ]);

        return redirect()->route('equipos.index')->with('success', 'Equipo creado correctamente.');
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
