<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EquiposPokemon extends Model
{
    public $fillable=["idPokemon1","idPokemon2","idPokemon3","idPokemon4","idPokemon5","idPokemon6"];

    public function pokemon1(){
        return $this->belongsTo(Pokemon::class, 'idPokemon1');
    }
    public function pokemon2(){
        return $this->belongsTo(Pokemon::class, 'idPokemon2');
    }
    public function pokemon3(){
        return $this->belongsTo(Pokemon::class, 'idPokemon3');
    }
    public function pokemon4(){
        return $this->belongsTo(Pokemon::class, 'idPokemon4');
    }
    public function pokemon5(){
        return $this->belongsTo(Pokemon::class, 'idPokemon5');
    }
    public function pokemon6(){
        return $this->belongsTo(Pokemon::class, 'idPokemon6');
    }
}
