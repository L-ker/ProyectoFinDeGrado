<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\EquiposPokemon;

class EquiposUsuarios extends Model
{
    public $fillable=["idUsuario","idEquipo"];
    public function equipo(){
        return $this->belongsTo(EquiposPokemon::class, 'idEquipo');
    }
    public function usuario(){
        return $this->belongsTo(User::class, 'idUsuario');
    }
}