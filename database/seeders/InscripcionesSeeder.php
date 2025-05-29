<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Inscripciones;
use Illuminate\Database\Seeder;

class InscripcionesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Inscripciones::create([
            'idUsuario' => 2,
            'idTorneo' => 1,
        ]);

        Inscripciones::create([
            'idUsuario' => 3,
            'idTorneo' => 1,
        ]);

        Inscripciones::create([
            'idUsuario' => 4,
            'idTorneo' => 1,
        ]);

        Inscripciones::create([
            'idUsuario' => 2,
            'idTorneo' => 2,
        ]);

        Inscripciones::create([
            'idUsuario' => 3,
            'idTorneo' => 2,
        ]);

        Inscripciones::create([
            'idUsuario' => 4,
            'idTorneo' => 2,
        ]);

        Inscripciones::create([
            'idUsuario' => 2,
            'idTorneo' => 3,
        ]);

        Inscripciones::create([
            'idUsuario' => 3,
            'idTorneo' => 3,
        ]);

        Inscripciones::create([
            'idUsuario' => 4,
            'idTorneo' => 3,
        ]);

        
    }
}
