<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pokemon extends Model
{
    public $fillable=["nombre","terastallization","objeto","movimiento1","movimiento2","movimiento3","movimiento4",];
}
