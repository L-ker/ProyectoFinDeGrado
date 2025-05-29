<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsuariosSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Administrador',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('12345678'),
            'es_administrador' => true,
            'es_organizador' => false,
        ]);

        User::create([
            'name' => 'Organizador',
            'email' => 'organizador@gmail.com',
            'password' => Hash::make('12345678'),
            'es_administrador' => false,
            'es_organizador' => true,
        ]);

        User::create([
            'name' => 'lucas',
            'email' => 'l@gmail.com',
            'password' => Hash::make('12345678'),
        ]);

        User::create([
            'name' => 'ale',
            'email' => 'a@gmail.com',
            'password' => Hash::make('12345678'),
        ]);
    }
}
