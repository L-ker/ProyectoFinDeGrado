<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Pokemon;
use Illuminate\Database\Seeder;

class PokemonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Pokemon::create([
            'nombre'           => 'Sprigatito',
            'terastallization' => 'acero',
            'objeto'           => 'Master-ball',
            'movimiento1'      => 'acrobatics',
            'movimiento2'      => 'agility',
            'movimiento3'      => 'bite',
            'movimiento4'      => 'charm',
            'sprite'           => 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/906.png',
        ]);

        Pokemon::create([
            'nombre'           => 'Kricketot',
            'terastallization' => 'veneno',
            'objeto'           => 'Coba-berry',
            'movimiento1'      => 'absorb',
            'movimiento2'      => 'bide',
            'movimiento3'      => 'endeavor',
            'movimiento4'      => 'growl',
            'sprite'           => 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/401.png',
        ]);

        Pokemon::create([
            'nombre'           => 'Chansey',
            'terastallization' => 'tierra',
            'objeto'           => 'Choice-scarf',
            'movimiento1'      => 'attract',
            'movimiento2'      => 'bestow',
            'movimiento3'      => 'bide',
            'movimiento4'      => 'bulldoce',
            'sprite'           => 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/113.png',
        ]);

        Pokemon::create([
            'nombre'           => 'Corviknight',
            'terastallization' => 'planta',
            'objeto'           => 'Assault-vest',
            'movimiento1'      => 'curse',
            'movimiento2'      => 'defog',
            'movimiento3'      => 'endure',
            'movimiento4'      => 'facade',
            'sprite'           => 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/823.png',
        ]);

        Pokemon::create([
            'nombre'           => 'Sunflora',
            'terastallization' => 'acero',
            'objeto'           => 'Master-ball',
            'movimiento1'      => 'acrobatics',
            'movimiento2'      => 'agility',
            'movimiento3'      => 'bite',
            'movimiento4'      => 'charm',
            'sprite'           => 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/192.png',
        ]);

        Pokemon::create([
            'nombre'           => 'Pawmot',
            'terastallization' => 'acero',
            'objeto'           => 'Master-ball',
            'movimiento1'      => 'acrobatics',
            'movimiento2'      => 'agility',
            'movimiento3'      => 'bite',
            'movimiento4'      => 'charm',
            'sprite'           => 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/923.png',
        ]);


        Pokemon::create([
            'nombre'           => 'Spidops',
            'terastallization' => 'roca',
            'objeto'           => 'Potion',
            'movimiento1'      => 'aerial-ace',
            'movimiento2'      => 'block',
            'movimiento3'      => 'brick-break',
            'movimiento4'      => 'assurance',
            'sprite'           => 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/918.png',
        ]);

        Pokemon::create([
            'nombre'           => 'Lokix',
            'terastallization' => 'acero',
            'objeto'           => 'Master-ball',
            'movimiento1'      => 'acrobatics',
            'movimiento2'      => 'agility',
            'movimiento3'      => 'bite',
            'movimiento4'      => 'charm',
            'sprite'           => 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/906.png',
        ]);
    }
}
