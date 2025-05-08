<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class torneo extends Model
{
    public $fillable=["organizador","modalidad"];
    public function equipo(){
        return $this->belongsTo(EquipoPokemon::class, 'idEquipo');
    }
    public function usuario(){
        return $this->belongsTo(User::class, 'idUsuario');
    }
}
