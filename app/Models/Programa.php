<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Programa extends Model
{
    use HasFactory;
    protected $table = "programas";
    protected $fillable = [
        'codigo_programa','programa', 'nombre_corto', 'nom_corto', 'id_estado'
    ];
}
