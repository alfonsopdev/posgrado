<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AsistenciaQRController extends Controller
{
    // Método para buscar datos de la ficha por ID
    public function datosficha(Request $request)
    {
        // Buscar la ficha por ID en la base de datos
        $extracted = isset($request->extracted) ? $request->extracted : null;
        $dato = isset($request->dato) ? $request->dato : null;
        $usuario = DB::table('fichas')
            //->join('modalidades', 'fichas.mcp_id_modalidad', '=', 'modalidades.id')
            ->join('users', 'fichas.user_id', '=', 'users.id')
            ->join('carreras', 'users.id_carrera', '=', 'carreras.id')
            ->join('aulas', 'fichas.id_aula', '=', 'aulas.id')
            ->join('locales', 'aulas.local_id', '=', 'locales.id')
            ->select(
                'fichas.codigo_p',
                'fichas.id',
                //'modalidades.modalidad as MODALIDAD',
                'users.nombre',
                'users.apellido_paterno',
                'users.apellido_materno',
                'carreras.nombre_corto as CARRERA',
                'locales.local',
                'aulas.aula',
                'fichas.condicion'
            );        
        if ($extracted) {
            $usuario = $usuario->where(function($query) use ($extracted){
                $query->orWhere('fichas.id', $extracted); 
            });            
        }
        ;
        if($dato){
            $usuario=$usuario->where(function($query) use ($dato){
                $query->orWhere('fichas.numero_documento', 'like', '%' . $dato . '%');
                $query->orWhere('fichas.codigo_p', 'like', '%' . $dato . '%');
            });
        }
        $usuario = $usuario
            ->get();
        $extracted = null;
        // $dato = null;
    
        if (!$usuario->isEmpty()) {
            return response()->json($usuario);
        } else {
            return response()->json(['message' => 'Ficha no encontrada'], 404);
        }

    }
    
    public function registrarasistencia(Request $request)
    {
        $extracted = isset($request->extracted) ? $request->extracted : null;

        // $fichaId = $request->input('extracted'); // Cambia 'ficha_id' por 'extracted'
        // Verificar si el ID de la ficha está presente
        if (!$extracted) {
            return response()->json(['message' => 'ID de la ficha no proporcionado'], 400);
        }
        // Actualizar la condición a 'PRESENTE'
        DB::table('fichas')
            ->where('id', $extracted)
            ->update(['condicion' => 'PRESENTE']);

        return response()->json(['message' => 'Asistencia registrada con éxito']);

    }
    public function listaasistencia(Request $request){
        // $modalidad = isset($request->modalidad) ? $request->modalidad : null;
        $carrera = isset($request->carrera) ? $request->carrera : null;
        $condicion = isset($request->condicion) ? $request->condicion : null;
        $dato = isset($request->dato) ? $request->dato : null;
        $ficha = DB::table('fichas')
            // ->join('modalidades', 'fichas.mcp_id_modalidad', '=', 'modalidades.id')
            ->join('carreras', 'fichas.mcp_id_carrera', '=', 'carreras.id')
            ->join('users', 'fichas.user_id', '=', 'users.id')
            ->join('aulas', 'fichas.id_aula', '=', 'aulas.id')
            ->join('locales', 'aulas.local_id', '=', 'locales.id')
            ->select(
                'fichas.*',
                // 'modalidades.modalidad',
                'carreras.carrera',
                DB::raw('concat(fichas.dp_apellido_p, " ",fichas.dp_apellido_m) as apellidos'),
                'users.created_at as usuario_registro', 'users.apellido_paterno','users.apellido_materno','users.nombre',
                'aulas.id_examen',
                'aulas.aula',
                'aulas.local_id',
                'locales.local',
            )
            ->where('fichas.id_estado', 1)
            ->whereNotNull('fichas.id_aula');
        if($dato){
            $ficha=$ficha->where(function($query) use ($dato){
                $query->Where('fichas.numero_documento', 'like', '%' . $dato . '%');
                $query->orWhere(DB::raw('concat(fichas.dp_apellido_p, " ",fichas.dp_apellido_m," ", fichas.dp_nombre)'), 'like', '%' . $dato . '%');
                $query->orWhere('fichas.codigo_p', 'like', '%' . $dato . '%');
            });
        }
        // if($modalidad){
        //     $ficha=$ficha->where('fichas.mcp_id_modalidad', $modalidad);
        // }
        // if ($modalidad === 'extraordinario') {
        //     // Si la condición es 'extraordinario', busca los datos de todos los procesos extraordinarios
        //     $ficha->whereIn('fichas.mcp_id_modalidad', [2,3,10,4,5,6,7]);
        // }elseif ($modalidad) {
        //     $ficha = $ficha->where('fichas.mcp_id_modalidad', $modalidad);
        // }  
        if ($carrera) {
            $ficha=$ficha->where('fichas.mcp_id_carrera', $carrera);
        }
        if ($condicion === 'PRESENTE') {
            // Si la condición es 'PRESENTE', busca tanto 'INGRESO','NO INGRESO' O 'COBERTURA'
            $ficha->whereIn('fichas.condicion', ['INGRESO', 'NO INGRESO','PRESENTE','COBERTURA']);
        } elseif ($condicion == 'AUSENTE') {
            // Si no es 'AUSENTE', realiza la búsqueda las casillas null y las casillas AUSENTE
            $ficha->where(function ($query) {
                $query->whereNull('fichas.condicion')->orWhere('fichas.condicion', 'AUSENTE');
            });
        }
         elseif ($condicion) {
            // Si no es 'SE PRESENTO', realiza la búsqueda normal
            $ficha = $ficha->where('fichas.condicion', $condicion);
        }
        $ficha = $ficha->groupBy('fichas.id')
                    ->orderByRaw('FIELD(fichas.id_estado_revision, 1, 2, 3, 0), fichas.fecha_solicitado DESC, fichas.created_at DESC');
        $ficha=$ficha->get();

        if($ficha==null){
            return response()->json(0);
        }else{
            return response()->json($ficha);  
        }
    }
    public function reporteasistenciaqr(Request $request){
        $modalidad = isset($request->modalidad) ? $request->modalidad : null;
        // INDICADORES DE ASISTENCIA
        // Cantidad de Postulantes Total    
        $postulanteTotal = DB::table('fichas')
            ->join('aulas', 'fichas.id_aula', '=', 'aulas.id')
            ->join('locales', 'aulas.local_id', '=', 'locales.id')
            ->where('fichas.id_estado', 1)
            ->where('fichas.id_estado_revision',3);
             if ($modalidad === 2) {
            //     // Si la condición es 'extraordinario', busca los datos de todos los procesos extraordinarios
                    $postulanteTotal->whereIn('fichas.mcp_id_modalidad', [2]);
            }elseif ($modalidad) {
                 $postulanteTotal = $postulanteTotal->where('fichas.mcp_id_modalidad', $modalidad);
            }
            $postulanteTotal = $postulanteTotal
                ->count();  

        // Cantidad de Postulantes Ausentes
        $postulanteAusente = DB::table('fichas')
            ->join('aulas', 'fichas.id_aula', '=', 'aulas.id')
            ->join('locales', 'aulas.local_id', '=', 'locales.id')
            ->where('fichas.id_estado', 1)
            ->where('fichas.id_estado_revision',3)
            ->where(function ($query) {
                $query->whereNull('fichas.condicion')
                      ->orWhere('fichas.condicion', 'AUSENTE');
            });
             if ($modalidad === 2) {
            //     // Si la condición es 'extraordinario', busca los datos de todos los procesos extraordinarios
                    $postulanteAusente->whereIn('fichas.mcp_id_modalidad', [2]);
            }elseif ($modalidad) {
                 $postulanteAusente = $postulanteAusente->where('fichas.mcp_id_modalidad', $modalidad);
            }
            
            $postulanteAusente = $postulanteAusente
                ->select('fichas.código_p')
                ->count();

        // Cantidad de Postulantes Presentes
        $postulantePresente = DB::table('fichas')
            ->join('aulas', 'fichas.id_aula', '=', 'aulas.id')
            ->join('locales', 'aulas.local_id', '=', 'locales.id')
            ->where('fichas.id_estado', 1)
            ->where('fichas.id_estado_revision',3)
            ->whereIn('fichas.condicion', ['PRESENTE', 'INGRESO', 'NO INGRESO', 'COBERTURA']);
             if ($modalidad === 2) {
            //     // Si la condición es 'extraordinario', busca los datos de todos los procesos extraordinarios
                    $postulantePresente->whereIn('fichas.mcp_id_modalidad', [2]);
            }elseif ($modalidad) {
                 $postulantePresente = $postulantePresente->where('fichas.mcp_id_modalidad', $modalidad);
            }
            $postulantePresente = $postulantePresente
                ->select('fichas.código_p')
                ->count();
              
        $tablaaulas = DB::table('fichas')
            ->select(
                // 'modalidades.modalidad AS MODALIDAD', 
            'locales.local AS LOCAL', 'aulas.aula AS AULA',
                DB::raw('COUNT(CASE WHEN fichas.condicion IS NULL OR fichas.condicion = "AUSENTE" THEN 1 END) AS AUSENTES'),
                DB::raw('COUNT(CASE WHEN fichas.condicion IN ("PRESENTE", "INGRESO", "NO INGRESO", "COBERTURA") THEN 1 END) AS PRESENTES'),
                DB::raw('COUNT(*) AS TOTAL'))
            // ->join('modalidades', 'fichas.mcp_id_modalidad', '=', 'modalidades.id')
            ->join('carreras', 'fichas.mcp_id_carrera', '=', 'carreras.id')
            ->join('aulas', 'fichas.id_aula', '=', 'aulas.id')
            ->join('locales', 'aulas.local_id', '=', 'locales.id')
            ->where('fichas.id_estado_revision', 3)
            ->where('fichas.id_estado', 1);
             if ($modalidad === 2) {
            //     // Si la condición es 'extraordinario', busca los datos de todos los procesos extraordinarios
                    $tablaaulas->whereIn('fichas.mcp_id_modalidad', [2]);
            }elseif ($modalidad) {
                 $tablaaulas = $tablaaulas->where('fichas.mcp_id_modalidad', $modalidad);
            }
            $tablaaulas = $tablaaulas
            ->groupBy(
                // 'modalidades.modalidad', 
                'locales.local', 'aulas.aula')
            ->get();
        return response()->json([
            // Llamado a la variable de instancia para que se retorne
            // Variables de Indicadores de Asistencia
            'postulanteTotal' => $postulanteTotal,
            'postulanteAusente' => $postulanteAusente,
            'postulantePresente' => $postulantePresente,
            'tablaaulas' => $tablaaulas,
        ]);  
                  
    }
}