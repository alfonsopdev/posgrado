<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Aula extends Model
{
    protected $table = 'aulas';

    protected $fillable = [
        'local_id', 'codigo_aula', 'aula', 'id_examen', 'id_estado'
    ];

   /* public function aulas()
    {
        return $this->hasMany(Aula::class, 'local_id');
    }*/
    public function local()
    {
        // Asumiendo que tu modelo se llama "Local" y la llave foránea es "local_id"
        return $this->belongsTo(Local::class, 'local_id');
    }

    
}