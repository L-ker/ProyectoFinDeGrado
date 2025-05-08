<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Calendario extends Model
{
    public $fillable=["torneo","fecha","fecha_fin_inscripcion"];
    public function torneo(){
        return $this->belongsTo(Torneo::class, 'torneo');
    }
}
