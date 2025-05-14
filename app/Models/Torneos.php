<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Torneos extends Model
{
    public $fillable=["organizador","modalidad","activo","ganador"];
    // pendiente de si hacerlo asi o un atributo sin mas, creo que lo hare asi para ver estadisticas del jugador
    // public function ganador(){
    //     return $this->belongsTo(User::class, 'ganador');
    // }
    public function organizador(){
        return $this->belongsTo(User::class, 'organizador');
    }
    public function ganador(){
        return $this->belongsTo(User::class, 'ganador');
    }
}
