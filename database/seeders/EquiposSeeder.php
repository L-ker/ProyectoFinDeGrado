<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\EquiposUsuarios;
use Illuminate\Database\Seeder;

class EquiposSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        EquiposUsuarios::create([
            'idUsuario' => 1,
            'idEquipo' => 1,
        ]);
        EquiposUsuarios::create([
            'idUsuario' => 2,
            'idEquipo' => 2,
        ]);
        EquiposUsuarios::create([
            'idUsuario' => 3,
            'idEquipo' => 3,
        ]);
        EquiposUsuarios::create([
            'idUsuario' => 4,
            'idEquipo' => 4,
        ]);
    }
}
