<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ficha extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'codigo_p',
        'dp_apellido_p',
        'dp_apellido_m',
        'apellido_materno',
        'dp_nombre',
        'id_tipo_documento',
        'numero_documento',
        'dp_edad',
        'dp_fecha_n',
        'dp_ln_peru',
        'dp_ln_pais',
        'dp_ln_dep',
        'dp_ln_prov',
        'dp_ln_dis',
        'dp_ln_dep_ext',
        'dp_ln_prov_ext',
        'dp_ln_dis_ext',
        'dp_sexo',
        'dp_estado_c',
        'da_direccion',
        'da_lote',
        'da_interior',
        'da_urbanizacion',
        'da_dep',
        'da_prov',
        'da_dis',
        'da_numero_celular',
        'da_numero_telefono',
        'da_email',
        'da_email_institucional',
        'df_nombres_padre',
        'df_nombres_madre',
        'df_nombres_apoderado',
        'df_dni_apoderado',
        'df_celular_apoderado',
        'diep_id_colegio',
        'diep_ace',
        'de_cod_ruv',
        'de_nom_uni',
        'de_cred_uni',
        'mcp_id_modalidad',
        'mcp_id_carrera',
        'mcp_tipo',
        'dd_publicidad',
        'estado_postulante',
        'id_estado_revision',
        'fecha_solicitado',
        'fecha_revisado',
        'id_usu_revisado',
        'fecha_carne',
        'confor_carnet',
        'fecha_confor_carne',
        'id_estado',
        'created_at',
        'updated_at',
        'postulacion',
        'extemporaneo'
    ];
}
