<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Torneos;
use App\Models\Calendario;
use Illuminate\Database\Seeder;

class TorneosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $torneo1 = Torneos::create([
            'organizador' => 1,
            'modalidad' => 'VGC',
            'nombre' => 'test',
        ]);

        $torneo2 =Torneos::create([
            'organizador' => 2,
            'modalidad' => 'VGC',
            'nombre' => 'test2',
        ]);

        $torneo3 = Torneos::create([
            'organizador' => 1,
            'modalidad' => 'VGC',
            'nombre' => 'test3',
        ]);

        Calendario::crearConFecha($torneo1->id, '29/05/2025');
        Calendario::crearConFecha($torneo2->id, '5/06/2025');
        Calendario::crearConFecha($torneo3->id, '13/06/2025');
    }
}
