<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Local extends Model
{
    protected $table = 'locales';

    protected $fillable = [
        'local', 'direccion', 'id_estado'
    ];

   /* public function aulas()
    {
        return $this->hasMany(Aula::class, 'local_id');
    }*/

    public function procesosAdmision()
    {
        return $this->hasMany(ProcesoAdmision::class, 'local_id');
    }
}