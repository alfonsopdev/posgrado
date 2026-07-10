<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Local;


class ProcesoAdmision extends Model
{
    protected $table = 'procesos_admision';

    protected $fillable = [
        'codigo', 'nombre', 'local_id', 'fecha_examen', 'hora_inicio', 'hora_fin',
        'carnet_titulo', 'qr_base_url', 'activo'
    ];

    protected $casts = [
        'fecha_examen' => 'date',
        'activo' => 'boolean',
    ];

    public function local()
    {
        return $this->belongsTo(Local::class);
    }

    public function fichas()
    {
        return $this->hasMany(Ficha::class);
    }

    public static function getActivo()
    {
        return self::where('activo', true)->with('local')->first();
    }
}