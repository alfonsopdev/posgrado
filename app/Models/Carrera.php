<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carrera extends Model
{
    use HasFactory;
    protected $table = "carreras";
    protected $fillable = [
        'codigo_carrera','carrera', 'nombre_corto', 'nom_corto', 'id_estado'
    ];
}
