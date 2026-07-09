<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;
use PHPUnit\TextUI\XmlConfiguration\Group;

class ExamenController extends Controller
{
    //
    public function obtener_data_aula($aula, $id_local_examen){

    }

    public function lista_aula(Request $request){
        $formato = isset($request->formato) ? $request->formato : null;
        $id_examen = isset($request->id_examen) ? $request->id_examen : null;
        $aula = isset($request->aula) ? $request->aula : null;
        $local_id = isset($request->local_id) ? $request->local_id : null;
        $id_aula = isset($request->id_aula) ? $request->id_aula : null;
        $nom_local = isset($request->nom_local) ? $request->nom_local : null;

        // NUEVO: Atrapamos la modalidad
        $modalidad = $request->modalidad ?? null;

/*         $aula = '02';
        $id_local_examen=1; */
        $postulantes = DB::table('fichas')
        ->join('carreras', 'fichas.mcp_id_carrera', '=', 'carreras.id')
        ->join('users', 'fichas.user_id', '=', 'users.id')
        ->join('aulas', 'fichas.id_aula', '=', 'aulas.id')
        ->select(
            'fichas.codigo_p',
            'fichas.dp_apellido_p',     
            'fichas.dp_apellido_m',
            'fichas.dp_nombre',
            'fichas.numero_documento',
            'carreras.carrera',
            'carreras.nom_corto',
            'users.created_at as usuario_registro'
        )
        ->where('fichas.id_estado', 1)
        ->where('fichas.id_estado_revision', 3)
        ->whereNotNull('fichas.id_aula')
        ->where('aulas.local_id', $local_id);
        //->where('fichas.mcp_id_modalidad', 1)
        // NUEVO: Si enviaron modalidad (1 o 2), la filtramos aquí
        if ($modalidad) {
            $postulantes = $postulantes->where('fichas.mcp_id_modalidad', $modalidad);
        }
        if ($id_aula) {
            $postulantes=$postulantes->where('aulas.id', $id_aula)->orderByRaw('fichas.dp_apellido_p, fichas.dp_apellido_m, fichas.dp_nombre');
        }else{
            $postulantes=$postulantes->orderBy('fichas.codigo_p');
        }
        /* ->where('fichas.aula_examen', $aula)
        ->where('fichas.id_local_examen', $id_local_examen) */
        $postulantes=$postulantes
        ->get();

        $data['formato']=$formato;
        $data['aula']=$aula;
        $data['nom_local']=$nom_local;
        $data['id_aula']=$id_aula;
        $data['data']=$postulantes;
        // NUEVO: Pasamos la modalidad a la vista para usarla en el título del PDF
        $data['modalidad'] = $modalidad;

        
        //dd($postulantes);
        $resultado['asd']['data']='asdasd';
        if($formato==1){
            $pdf = PDF::loadView('lista_aula',  $data)->setPaper('a4');  
        }elseif ($formato==2) {
            $pdf = PDF::loadView('lista_aula_calidad',  $data)->setPaper('a4', 'landscape');  
        }else{
            exit();
        }
        
        return $pdf->stream('lista de aula.pdf');
    }

    public function lista_general(Request $request){
        $formato = isset($request->formato) ? $request->formato : null;
        $id_examen = isset($request->id_examen) ? $request->id_examen : null;
        $aula = isset($request->aula) ? $request->aula : null;
        $local_id = isset($request->local_id) ? $request->local_id : null;
        $id_aula = isset($request->id_aula) ? $request->id_aula : null;
        $nom_local = isset($request->nom_local) ? $request->nom_local : null;

        $modalidad = $request->modalidad ?? null;

        $postulantes = DB::table('fichas')
        // ->join('modalidades', 'fichas.mcp_id_modalidad', '=', 'modalidades.id')
        ->join('carreras', 'fichas.mcp_id_carrera', '=', 'carreras.id')
        ->join('users', 'fichas.user_id', '=', 'users.id')
        ->join('aulas', 'fichas.id_aula', '=', 'aulas.id')
        ->select(
            'fichas.*',
            // 'modalidades.modalidad',
            'carreras.carrera',
            'carreras.nom_corto',
            'users.created_at as usuario_registro',
            'aulas.aula as aula_postulante'
        )
        ->where('fichas.id_estado', 1)
        ->where('fichas.id_estado_revision', 3)
        ->whereNotNull('fichas.id_aula')
        ->where('aulas.local_id', $local_id)
        ->where('aulas.id_examen', $id_examen);

        if ($modalidad) {
            $postulantes = $postulantes->where('fichas.mcp_id_modalidad', $modalidad);
        }
        
        $postulantes=$postulantes->orderByRaw('fichas.dp_apellido_p, fichas.dp_apellido_m, fichas.dp_nombre');
        /* ->where('fichas.aula_examen', $aula)
        ->where('fichas.id_local_examen', $id_local_examen) */
        $postulantes=$postulantes->get();

        $data['aula']=$aula;
        $data['formato']=$formato;
        $data['nom_local']=$nom_local;
        $data['local_id']=$local_id;
        $data['id_aula']=$id_aula;
        $data['data']=$postulantes;

        $data['modalidad'] = $modalidad;
        //dd($postulantes);
        $resultado['asd']['data']='asdasd';
        if($formato==1){
            $pdf = PDF::loadView('lista_general',  $data)->setPaper('a4');  
        }elseif ($formato==2) {
            $pdf = PDF::loadView('lista_aula_calidad',  $data)->setPaper('a4', 'landscape');  
        }else{
            exit();
        }

        // Nombre del archivo dinámico (opcional)
        $nombreArchivo = 'lista_general';
        if($modalidad == 1) $nombreArchivo = 'lista_ordinario';
        if($modalidad == 2) $nombreArchivo = 'lista_extraordinario';
        
        return $pdf->stream('lista de aula.pdf');


    }

    public function aulas_postulantes(Request $request){
        $examen = isset($request->examen) ? $request->examen : null;
        $tipo_examen = isset($request->tipo_examen) ? $request->tipo_examen : null;
        $local = isset($request->local) ? $request->local : null;

        $modalidad = $request->modalidad ?? null;
       

        $aulas = DB::table('fichas')
        //->join('modalidades', 'fichas.mcp_id_modalidad', '=', 'modalidades.id')
        ->join('users', 'fichas.user_id', '=', 'users.id')
        ->join('aulas', 'fichas.id_aula', '=', 'aulas.id')
        ->join('locales', 'aulas.local_id', '=', 'locales.id')
        ->select(
            'fichas.*',
            //'modalidades.modalidad',
            'users.created_at as usuario_registro',
            'aulas.id_examen',
            'aulas.aula',
            'aulas.local_id',
            'locales.local',
            DB::raw('count(fichas.id) as cantidad_aula'),
        )
        ->where('fichas.id_estado', 1)
        ->where('fichas.id_estado_revision', 3)
        ->whereNotNull('fichas.id_aula');
        if($tipo_examen){
            $aulas=$aulas->where('fichas.mcp_tipo', $tipo_examen);
        }
        if($examen){
            $aulas=$aulas->where('aulas.id_examen', $examen);
        }
        if($local){
            $aulas=$aulas->where('aulas.local_id', $local);
        }
        if($modalidad){
            $aulas = $aulas->where('fichas.mcp_id_modalidad', $modalidad);
        }
        $aulas=$aulas->orderByRaw('aulas.id')
        ->groupBy('fichas.id_aula', 'aulas.id_examen', 'aulas.aula', 'aulas.local_id', 'locales.local')        
        ->get();
        return response()->json([
            //'ficha'=>$ficha,
            //'status'=>$status,
            //'success'=>$success,
            'aulas'=>$aulas
        ]);

    }

    public function listar_aulas(Request $request){
        $examen = isset($request->examen) ? $request->examen : null;
        // $tipo_examen = isset($request->tipo_examen) ? $request->tipo_examen : null;
        $local = isset($request->local) ? $request->local : null;

        $aulas = DB::table('aulas')
        ->leftjoin('fichas', 'aulas.id', '=', 'fichas.id_aula')
        ->join('locales', 'aulas.local_id', '=', 'locales.id')
        ->select(
            'aulas.*',
            'locales.local',
            DB::raw('count(fichas.id) as cantidad'),
        ) 
        ->where('aulas.id_estado', 1)
        ->where('aulas.id_examen', $examen)
        ->where('aulas.local_id', $local)
        ->orderBy('aulas.id')
        ->groupBy('aulas.id')
        ->get();/*;
        $aulas=$aulas->orderBy('aulas.id')
        ->get();*/
        return response()->json([
            //'ficha'=>$ficha,
            //'status'=>$status,
            //'success'=>$success,
            'aulas'=>$aulas
        ]);
    }

    public function asignar_aulas(Request $request){
        $local = isset($request->local) ? $request->local : null;
        $id_aula = isset($request->id_aula) ? $request->id_aula : null;
        $cantidad = isset($request->cantidad) ? $request->cantidad : null;

        $changes=0;
        if($local && $id_aula && $cantidad){
            if($local==1){
                $affected = DB::table('fichas as f')
                    ->where('f.id_estado_revision', 3)
                    ->where('f.mcp_id_modalidad', 0)
                    // ->where('f.mcp_tipo', 2)
                    ->where(function ($query){
                        $query->where('f.mcp_tipo',1)
                              ->orWhere('f.mcp_tipo',2);
                    })
                    ->whereNull('f.id_aula')
                    // ->orderBy('f.codigo_p')
                    ->orderBy('f.dp_apellido_p')    //ordenar por orden de apellido
                    ->limit($cantidad)
                    ->update([
                            'f.id_aula' => $id_aula
                    ]);
                    $changes=$affected;
                
            }elseif($local==2){
                $affected = DB::table('fichas as f')
                    ->where('f.id_estado_revision', 3)
                    ->where('f.mcp_id_modalidad', 11)
                    ->where('f.mcp_tipo', 1)
                    ->whereNull('f.id_aula')
                    ->orderBy('f.codigo_p')
                    ->limit($cantidad)
                    ->update([
                            'f.id_aula' => $id_aula
                    ]);
                    $changes=$affected;
            }
        }else{
            $changes=0;
            $status="false";
            $success=0;
        }
        return response()->json([
            'changes'=>$changes,
            //'success'=>$success,
        ]);
    }

    public function postulantes_sin_aulas(Request $request){
        $examen = isset($request->examen) ? $request->examen : null;
        

        $postulantes = DB::table('fichas')
        ->select(
            'fichas.mcp_tipo',
            DB::raw('count(fichas.id) as cantidad'),
            DB::raw('count(fichas.id_aula) as cantidad_asignado'),
            DB::raw('count(IF(fichas.id_aula IS NULL,1,NULL)) as no_asignado'),
        )
        ->where('fichas.id_estado_revision', 3);
        //->whereNull('fichas.id_aula')
        if($examen==2){
            $postulantes=$postulantes->where('fichas.mcp_id_modalidad', 11);
        }
        $postulantes=$postulantes->groupBy('fichas.mcp_tipo')
        ->get();
        return response()->json([
            //'ficha'=>$ficha,
            //'status'=>$status,
            //'success'=>$success,
            'postulantes'=>$postulantes
        ]);
    }
    //SE AÑADEN FUNCIONES PARA LISTAR Y ASIGNAR MANUALMENTE
    // Obtener postulantes asignados a un aula específica (Devuelve JSON, no PDF)
    public function ver_asignados_aula(Request $request) {
        $id_aula = $request->id_aula;

        $postulantes = DB::table('fichas')
            ->join('users', 'fichas.user_id', '=', 'users.id')
            ->select('fichas.id', 'fichas.codigo_p', 'fichas.dp_apellido_p', 'fichas.dp_apellido_m', 'fichas.dp_nombre')
            ->where('fichas.id_aula', $id_aula)
            ->where('fichas.id_estado_revision', 3)
            ->orderBy('fichas.dp_apellido_p')
            ->get();

        return response()->json([
            'postulantes' => $postulantes
        ]);
    }

    // Asignar un aula manualmente a un postulante por su código o DNI
    
    // 1. FUNCIÓN PARA LISTAR (Actualizada)
    public function lista_postulantes(Request $request){
        $examen = isset($request->examen) ? $request->examen : null;
        $tipo_examen = isset($request->tipo_examen) ? $request->tipo_examen : null;
        $local = isset($request->local) ? $request->local : null;

        $postulantes = DB::table('fichas')
        ->join('carreras', 'fichas.mcp_id_carrera', '=', 'carreras.id')
        ->join('users', 'fichas.user_id', '=', 'users.id')
        ->join('aulas', 'fichas.id_aula', '=', 'aulas.id')
        ->select(
            'fichas.id as ficha_id', // ¡CRÍTICO! Necesitamos el ID para poder hacer el update
            'fichas.codigo_p',
            'fichas.dp_apellido_p',     
            'fichas.dp_apellido_m',
            'fichas.dp_nombre',
            'fichas.numero_documento',
            'fichas.mcp_id_modalidad as id_modalidad', // Para mostrar la modalidad actual
            'carreras.carrera',
            'aulas.id as id_aula',   // ID del aula para el v-model
            'aulas.aula as nombre_aula' // Nombre del aula
        )
        ->where('fichas.id_estado', 1)
        ->where('fichas.id_estado_revision', 3)
        ->whereNotNull('fichas.id_aula');

        // Filtramos con los datos que manda Vue
        if($examen) { $postulantes = $postulantes->where('aulas.id_examen', $examen); }
        if($tipo_examen) { $postulantes = $postulantes->where('fichas.mcp_tipo', $tipo_examen); }
        if($local) { $postulantes = $postulantes->where('aulas.local_id', $local); }

        $postulantes = $postulantes->orderByRaw('fichas.dp_apellido_p, fichas.dp_apellido_m')->get();

        return response()->json([
            'postulantes' => $postulantes
        ]);
    }

    // 2. NUEVA FUNCIÓN PARA ACTUALIZAR
    public function actualizar_aula_postulante(Request $request){
        $ficha_id = $request->ficha_id;
        $nuevo_id_aula = $request->id_aula;

        DB::table('fichas')->where('id', $ficha_id)->update([
            'id_aula' => $nuevo_id_aula
        ]);

        return response()->json([
            'success' => true, 
            'message' => 'Aula actualizada correctamente'
        ]);
    }

    public function actualizar_modalidad(Request $request){
        $ficha_id = $request->ficha_id;
        $nuevo_id_modalidad = $request->id_modalidad;

        DB::table('fichas')->where('id', $ficha_id)->update([
            'mcp_id_modalidad' => $nuevo_id_modalidad
        ]);

        return response()->json([
            'success' => true, 
            'message' => 'Modalidad actualizada correctamente'
        ]);
    }


}
