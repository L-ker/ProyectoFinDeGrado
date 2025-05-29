<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        $this->call(UsuariosSeeder::class);
        $this->call(PokemonSeeder::class);
        $this->call(EquipoPokemonSeeder::class);
        $this->call(EquiposSeeder::class);
        $this->call(TorneosSeeder::class);
        $this->call(InscripcionesSeeder::class);
    }

}
