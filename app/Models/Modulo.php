<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Torneos;
use App\Models\EquiposUsuarios;
use App\Models\User;

class Modulo extends Model
{
    protected $table = 'modulos';

    // Añadimos enlace_user1 y enlace_user2 y quitamos enlace (ya no se usa)
    public $fillable = [
        "torneo_id",
        "ronda",
        "enlace_user1",
        "enlace_user2",
        "enlace_definitivo",
        "user1_id",
        "user2_id",
        "ganador_id",
        "modulo_hijo1_id",
        "modulo_hijo2_id"
    ];

    public function modulo1()
    {
        return $this->belongsTo(Modulo::class, 'modulo_hijo1_id');
    }

    public function modulo2()
    {
        return $this->belongsTo(Modulo::class, 'modulo_hijo2_id');
    }

    public function usuario1()
    {
        return $this->belongsTo(User::class, 'user1_id');
    }

    public function usuario2()
    {
        return $this->belongsTo(User::class, 'user2_id');
    }

    public function ganador()
    {
        return $this->belongsTo(User::class, 'ganador_id');
    }

    public function torneo()
    {
        return $this->belongsTo(Torneos::class, 'torneo_id');
    }
}
