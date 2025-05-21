<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Torneos extends Model
{
    public $fillable=["organizador","nombre","modalidad","activo","ganador"];
    public function organizador(){
        return $this->belongsTo(User::class, 'organizador');
    }
    public function ganador(){
        return $this->belongsTo(User::class, 'ganador');
    }
}
