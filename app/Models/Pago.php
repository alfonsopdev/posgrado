<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    use HasFactory;


    protected $fillable = [
        'user_id',
        'id_tipo_pago',
        'id_ficha',
        'enlace',
        'tipo_enlace',
        'id_estado_revision',
        'codigo_pago',
        'fecha_pago',
        'cuenta_pago',
        'fecha_enviado',
        'id_medio_pago',
        'token',
        'monto_pago'
    ];
}
