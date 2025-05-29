<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\EquiposPokemon;
use Illuminate\Database\Seeder;

class EquipoPokemonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        EquiposPokemon::create([
            'idPokemon1' => 1,
            'idPokemon2' => 4,
            'idPokemon3' => 3,
            'idPokemon4' => 7,
            'idPokemon5' => 8,
            'idPokemon6' => 5,
        ]);

        EquiposPokemon::create([
            'idPokemon1' => 2,
            'idPokemon2' => 6,
            'idPokemon3' => 5,
            'idPokemon4' => 7,
            'idPokemon5' => 8,
            'idPokemon6' => 3,
        ]);

        EquiposPokemon::create([
            'idPokemon1' => 8,
            'idPokemon2' => 7,
            'idPokemon3' => 3,
            'idPokemon4' => 2,
            'idPokemon5' => 1,
            'idPokemon6' => 4,
        ]);

        EquiposPokemon::create([
            'idPokemon1' => 4,
            'idPokemon2' => 1,
            'idPokemon3' => 5,
            'idPokemon4' => 3,
            'idPokemon5' => 6,
            'idPokemon6' => 2,
        ]);
        
    }
}
