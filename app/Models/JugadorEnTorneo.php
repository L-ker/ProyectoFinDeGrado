<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Torneos;
use App\Models\User;

class JugadorEnTorneo extends Model
{
    protected $table = 'jugador_en_torneo';
    public $fillable=["torneo_id","user_id"];
    public function torneo()
    {
        return $this->belongsTo(Torneos::class, 'torneo_id');
    }
    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
