<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\EquiposUsuarios;


class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'es_organizador',   // Nuevo campo
        'es_administrador', // Nuevo campo
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            // Los campos booleanos no necesitan casting especial, pero si quieres ser explícito puedes añadirlos:
            'es_organizador' => 'boolean',
            'es_administrador' => 'boolean',
        ];
    }
    public function equiposUsuarios()
    {
        return $this->hasMany(EquiposUsuarios::class, 'idUsuario');
    }

}
