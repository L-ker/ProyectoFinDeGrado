<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class equiposUsuarios extends Model
{
    public $fillable=["idUsuario","idEquipo"];
    public function equipo(){
        return $this->belongsTo(EquipoPokemon::class, 'idEquipo');
    }
    public function usuario(){
        return $this->belongsTo(User::class, 'idUsuario');
    }
}