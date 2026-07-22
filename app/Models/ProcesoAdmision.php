<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Local;


class ProcesoAdmision extends Model
{
    protected $table = 'procesos_admision';

    protected $fillable = [
        'codigo', 'nombre', 'local_id', 'fecha_examen', 'hora_inicio', 'hora_fin', 'fecIni_inscripcion', 'fecFin_inscripcion', 'prospecto_url', 'qr_base_url', 'activo'
    ];

    protected $casts = [
        'fecha_examen' => 'date:Y-m-d',
        'fecIni_inscripcion' => 'date:Y-m-d',
        'fecFin_inscripcion' => 'date:Y-m-d',
        'activo' => 'boolean',
    ];

    public function local()
    {
        return $this->belongsTo(Local::class);
    }

    public function fichas()
    {
        return $this->hasMany(Ficha::class, 'proceso_admision_id');
    }

    public static function getActivo()
    {
        return self::where('activo', true)->with('local')->first();
    }

    public function setProcesoAdmisionAttribute($value)
    {
        $this->attributes['proceso_admision'] = mb_strtoupper($value, 'UTF-8');
    }
}