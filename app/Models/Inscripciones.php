<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inscripciones extends Model
{
    public $fillable=["idUsuario","idTorneo"];
    public function torneo(){
        return $this->belongsTo(Torneos::class, 'idTorneo');
    }
    public function usuario(){
        return $this->belongsTo(User::class, 'idUsuario');
    }
}
