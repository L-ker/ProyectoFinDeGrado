<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Calendario extends Model
{
    public $fillable=["torneo","fecha","fecha_fin_inscripcion"];
    public function torneo(){
        return $this->belongsTo(Torneo::class, 'torneo');
    }

    public static function crearConFecha($torneoId, $fechaOriginal)
    {
        [$dia, $mes, $anio] = explode('/', $fechaOriginal);
        $timestamp = mktime(0, 0, 0, $mes, $dia, $anio);
        $timestampInscripcion = $timestamp - 86400;
        $fechaFinInscripcion = date('d/m/Y', $timestampInscripcion);

        return self::create([
            'torneo' => $torneoId,
            'fecha' => $fechaOriginal,
            'fecha_fin_inscripcion' => $fechaFinInscripcion,
        ]);
    }

}
