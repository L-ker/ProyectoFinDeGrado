<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ej extends Model
{
    use HasFactory;
    public $fillable=["nombre","usuario","email","password"];

    public function puntuaciones(){
        return $this->hasMany(Puntuaciones::class);
    }
    // use HasFactory;
    // public $fillable=["puntuacion", 'usuarios_id'];
    // public function usuario(){
    //     return $this->belongsTo(Usuarios::class, 'usuarios_id');
    // }
}