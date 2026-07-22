<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReporteGeneralController extends Controller
{
    // Función para Reporte General
    public function index(Request $request)
    {
        $modalidad = isset($request->modalidad) ? $request->modalidad : null;
        // INDICADORES DE PROCESO
        // Postulantes Pendientes Validar
        $canPendientes = DB::table('fichas')
            ->where('fichas.id_estado_revision', 1);
        if ($modalidad === 2) {
            // Si la condición es 'extraordinario', busca los datos de todos los procesos extraordinarios
            $canPendientes->whereIn('fichas.mcp_id_modalidad', [2]);
        } elseif ($modalidad) {
            $canPendientes = $canPendientes->where('fichas.mcp_id_modalidad', $modalidad);
        }
        // if($modalidad){
        //     $canPendientes = $canPendientes->where('fichas.mcp_id_modalidad', $modalidad);
        // }
        $canPendientes = $canPendientes
            ->count();
        // Postulantes en Proceso
        $canPreInscritos = DB::table('fichas')
            ->where('fichas.id_estado', 1);
        if ($modalidad === 2) {
            // Si la condición es 'extraordinario', busca los datos de todos los procesos extraordinarios
            $canPreInscritos->whereIn('fichas.mcp_id_modalidad', [2]);
        } elseif ($modalidad) {
            $canPreInscritos = $canPreInscritos->where('fichas.mcp_id_modalidad', $modalidad);
        }
        $canPreInscritos = $canPreInscritos
            ->whereNotIn('fichas.id_estado_revision', [3])
            ->count();
        // Postulantes Inscritos Validados
        $canInscritos = DB::table('fichas')
            ->where('fichas.id_estado_revision', 3);
        if ($modalidad === 2) {
            // Si la condición es 'extraordinario', busca los datos de todos los procesos extraordinarios
            $canInscritos->whereIn('fichas.mcp_id_modalidad', [2]);
        } elseif ($modalidad) {
            $canInscritos = $canInscritos->where('fichas.mcp_id_modalidad', $modalidad);
        }
        // if($modalidad){
        //     $canInscritos = $canInscritos->where('fichas.mcp_id_modalidad', $modalidad);
        // }    
        $canInscritos = $canInscritos
            ->count();
        // Postulantes Totales con fichas entre Validados y en Proceso
       // Postulantes Totales con fichas entre Validados y en Proceso

        $totalProceso = DB::table('fichas'); // SE ELIMINÓ EL JOIN A MODALIDADES
        
        if ($modalidad === 2) {
            $totalProceso->whereIn('fichas.mcp_id_modalidad', [2]);
        } elseif ($modalidad) {
            $totalProceso = $totalProceso->where('fichas.mcp_id_modalidad', $modalidad);
        }
        $totalProceso = $totalProceso->count();

        // INDICADORES DE CANTIDAD
        // Cantidad de Prospectos Vendidos
        $canProspecto = DB::table('pagos')
            ->join('fichas', 'pagos.id_ficha', '=', 'fichas.id')
            ->where('pagos.id_estado_revision', 3);
        if ($modalidad === 2) {
            // Si la condición es 'extraordinario', busca los datos de todos los procesos extraordinarios
            $canProspecto->whereIn('fichas.mcp_id_modalidad', [2]);
        } elseif ($modalidad) {
            $canProspecto = $canProspecto->where('fichas.mcp_id_modalidad', $modalidad);
        }
        // if($modalidad){
        //     $canProspecto = $canProspecto->where('fichas.mcp_id_modalidad', $modalidad);
        // }    
        $canProspecto = $canProspecto
            ->whereIn('pagos.id_tipo_pago', [1, 3])
            ->count();
        // Cantidad de ventas de Derecho de Examen de Postulantes de colegio Público
        $canExamPubl = DB::table('universidades')
            ->join('fichas', 'universidades.id', '=', 'fichas.diep_id_colegio')
            ->join('pagos', 'fichas.id', '=', 'pagos.id_ficha')
            ->where('universidades.tipo', 'PUBLICA')
            ->where('pagos.id_estado_revision', 3)
            ->whereIn('pagos.id_tipo_pago', [2, 3, 5]);
        if ($modalidad === 2) {
            // Si la condición es 'extraordinario', busca los datos de todos los procesos extraordinarios
            $canExamPubl->whereIn('fichas.mcp_id_modalidad', [2]);
        } elseif ($modalidad) {
            $canExamPubl = $canExamPubl->where('fichas.mcp_id_modalidad', $modalidad);
        }
        // if($modalidad){
        //     $canExamPubl = $canExamPubl->where('fichas.mcp_id_modalidad', $modalidad);
        // }    
        $canExamPubl = $canExamPubl
            ->count();
        // Cantidad de ventas de Derecho de Examen de Postulantes de colegio Privado
        $canExamPriv = DB::table('universidades')
            ->join('fichas', 'universidades.id', '=', 'fichas.diep_id_colegio')
            ->join('pagos', 'fichas.id', '=', 'pagos.id_ficha')
            ->where('universidades.tipo', 'PRIVADA')
            ->where('pagos.id_estado_revision', 3)
            ->whereIn('pagos.id_tipo_pago', [2, 3, 5]);
        if ($modalidad === 2) {
            // Si la condición es 'extraordinario', busca los datos de todos los procesos extraordinarios
            $canExamPriv->whereIn('fichas.mcp_id_modalidad', [2]);
        } elseif ($modalidad) {
            $canExamPriv = $canExamPriv->where('fichas.mcp_id_modalidad', $modalidad);
        }
        // if($modalidad){
        //     $canExamPriv = $canExamPriv->where('fichas.mcp_id_modalidad', $modalidad);
        // }    
        $canExamPriv = $canExamPriv
            ->count();
        // Total de Postulantes que han Pagado su Derecho de Examen tanto de colégio Público cómo Privado
        $canPagoInscripcion = DB::table('pagos')
            ->join('fichas', 'pagos.id_ficha', '=', 'fichas.id')
            ->where('pagos.id_estado_revision', 3);
        if ($modalidad === 2) {
            // Si la condición es 'extraordinario', busca los datos de todos los procesos extraordinarios
            $canPagoInscripcion->whereIn('fichas.mcp_id_modalidad', [2, 3, 10, 4, 5, 6, 7]);
        } elseif ($modalidad) {
            $canPagoInscripcion = $canPagoInscripcion->where('fichas.mcp_id_modalidad', $modalidad);
        }
        // if($modalidad){
        //     $canPagoInscripcion= $canPagoInscripcion->where('fichas.mcp_id_modalidad', $modalidad);
        // }    
        $canPagoInscripcion = $canPagoInscripcion
            ->whereIn('pagos.id_tipo_pago', [2, 3, 5])
            ->count();
        // INDICADORES ECONÓMICOS
        // Monto de los Pagos por Prospecto
        $pagoProspectos = DB::table('pagos')
            ->join('fichas', 'pagos.id_ficha', '=', 'fichas.id')
            ->where('pagos.id_estado_revision', 3)
            ->whereIn('pagos.id_tipo_pago', [1, 3]);
        if ($modalidad === 2) {
            // Si la condición es 'extraordinario', busca los datos de todos los procesos extraordinarios
            $pagoProspectos->whereIn('fichas.mcp_id_modalidad', [2]);
        } elseif ($modalidad) {
            $pagoProspectos = $pagoProspectos->where('fichas.mcp_id_modalidad', $modalidad);
        }
        // if($modalidad){
        //     $pagoProspectos = $pagoProspectos->where('fichas.mcp_id_modalidad', $modalidad);
        // }    
        $pagoProspectos = $pagoProspectos
            ->count() * 50;
        $pagoProspectos = number_format($pagoProspectos, 2, '.', ',');
        // Monto de los Pagos por Derecho de Examen de Colegio Público
        $pagoExamPublico = DB::table('universidades')
            ->join('fichas', 'universidades.id', '=', 'fichas.diep_id_colegio')
            ->join('pagos', 'fichas.id', '=', 'pagos.id_ficha')
            ->where('universidades.tipo', 'PUBLICA')
            ->where('pagos.id_estado_revision', 3)
            ->whereIn('pagos.id_tipo_pago', [2, 3, 5]);
        if ($modalidad === 2) {
            // Si la condición es 'extraordinario', busca los datos de todos los procesos extraordinarios
            $pagoExamPublico->whereIn('fichas.mcp_id_modalidad', [2]);
        } elseif ($modalidad) {
            $pagoExamPublico = $pagoExamPublico->where('fichas.mcp_id_modalidad', $modalidad);
        }
        // if($modalidad){
        //     $pagoExamPublico = $pagoExamPublico->where('fichas.mcp_id_modalidad', $modalidad);
        // }   
        $pagoExamPublico = $pagoExamPublico
            ->selectRaw('SUM(
                CASE
                    WHEN pagos.id_tipo_pago = 3 THEN pagos.monto_pago - 50
                    ELSE pagos.monto_pago
                END
            ) as pagoExamPublico')
            ->first();
        $pagoExamPublico = number_format($pagoExamPublico->pagoExamPublico, 2, '.', ',');
        // Monto de los Pagos por Derecho de Examen de Colegio Privado
        $pagoExamPrivado = DB::table('universidades')
            ->join('fichas', 'universidades.id', '=', 'fichas.diep_id_colegio')
            ->join('pagos', 'fichas.id', '=', 'pagos.id_ficha')
            ->where('universidades.tipo', 'PRIVADA')
            ->where('pagos.id_estado_revision', 3)
            ->whereIn('pagos.id_tipo_pago', [2, 3, 5]);
        if ($modalidad === 2) {
            // Si la condición es 'extraordinario', busca los datos de todos los procesos extraordinarios
            $pagoExamPrivado->whereIn('fichas.mcp_id_modalidad', [2]);
        } elseif ($modalidad) {
            $pagoExamPrivado = $pagoExamPrivado->where('fichas.mcp_id_modalidad', $modalidad);
        }
        // if($modalidad){
        //     $pagoExamPrivado = $pagoExamPrivado->where('fichas.mcp_id_modalidad', $modalidad);
        // }    
        $pagoExamPrivado = $pagoExamPrivado
            ->selectRaw('SUM(
                CASE
                    WHEN pagos.id_tipo_pago = 3 THEN pagos.monto_pago - 50
                    ELSE pagos.monto_pago
                END
            ) as pagoExamPrivado')
            ->first();
        $pagoExamPrivado = number_format($pagoExamPrivado->pagoExamPrivado, 2, '.', ',');
        // Monto Total de la venta por Derecho de Examen
        $pagoTotal = DB::table('pagos')
            ->join('fichas', 'pagos.id_ficha', '=', 'fichas.id')
            ->where('pagos.id_estado_revision', 3);
        if ($modalidad === 'extraordinario') {
            // Si la condición es 'extraordinario', busca los datos de todos los procesos extraordinarios
            $pagoTotal->whereIn('fichas.mcp_id_modalidad', [2, 3, 10, 4, 5, 6, 7]);
        } elseif ($modalidad) {
            $pagoTotal = $pagoTotal->where('fichas.mcp_id_modalidad', $modalidad);
        }
        // if($modalidad){
        //     $pagoTotal = $pagoTotal->where('fichas.mcp_id_modalidad', $modalidad);
        // }    
        $pagoTotal = $pagoTotal
            ->sum('pagos.monto_pago');
        $pagoTotal = number_format($pagoTotal, 2, '.', ',');
        // REPORTE GENERAL
        $canUsuarios = DB::table('users')
            ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
            ->where('model_has_roles.role_id', 3)
            ->where('users.interesado', 1)
            ->where('users.id_estado', 1)
            ->count();
        $reporteGeneral[0] = [
            'nombre' => 'USUARIOS REGISTRADOS',
            'cantidad' => $canUsuarios,
            'porcentaje' => (100 / 400) * $canUsuarios
        ];
        $reporteGeneral[1] = [
            'nombre' => 'PROSPECTO VENDIDO',
            'cantidad' => $canProspecto,
            'porcentaje' => (100 / 400) * $canProspecto
        ];
        $reporteGeneral[2] = [
            'nombre' => 'PAGOS POR INSCRIPCIÓN',
            'cantidad' => $canPagoInscripcion,
            'porcentaje' => (100 / 400) * $canPagoInscripcion
        ];
        $reporteGeneral[3] = [
            'nombre' => 'USUARIOS PRE-INSCRITOS',
            'cantidad' => $canPreInscritos,
            'porcentaje' => (100 / 400) * $canPreInscritos
        ];
        $reporteGeneral[4] = [
            'nombre' => 'POSTULANTES INSCRITOS',
            'cantidad' => $canInscritos,
            'porcentaje' => (100 / 400) * $canInscritos
        ];
        $reporteGeneral[5] = [
            'nombre' => 'POSTULANTES PENDIENTE A VALIDACIÓN',
            'cantidad' => $canPendientes,
            'porcentaje' => (100 / 400) * $canPendientes
        ];
        //REPORTE POR FECHA
        $canUsuariosDia = DB::table('users')
            ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
            ->join('fichas', 'users.id', '=', 'fichas.user_id')
            ->where('model_has_roles.role_id', 3)
            ->where('users.id_estado', 1)
            ->whereNotNull('fichas.mcp_id_modalidad')
            ->select(DB::raw("DATE_FORMAT(users.created_at,'%Y-%m-%d') AS x"), DB::raw("COUNT(users.id) AS y"))
            ->groupBy('x')
            ->get();
        $canProspectoDia = DB::table('pagos')
            ->join('fichas', 'pagos.id_ficha', '=', 'fichas.id')
            ->where('pagos.id_estado_revision', 3)
            ->whereNotNull('fichas.mcp_id_modalidad', )
            ->whereIn('pagos.id_tipo_pago', [1, 3])
            ->select(DB::raw("DATE_FORMAT(pagos.fecha_revisado,'%Y-%m-%d') AS x"), DB::raw("COUNT(pagos.id) AS y"))
            ->groupBy('x')
            ->get();
        // $canInscritosDia = [];
        $canInscritosDia = DB::table('fichas')
            ->where('fichas.id_estado_revision', 3)
            ->whereNotNull('fichas.mcp_id_modalidad')
            ->select(DB::raw("DATE_FORMAT(fichas.fecha_revisado,'%Y-%m-%d') AS x"), DB::raw("COUNT(fichas.id) AS y"))
            ->groupBy('x')
            ->get();
        $canUsuariosDia = $this->completar_fechas('2023-09-10', $canUsuariosDia);
        $canProspectoDia = $this->completar_fechas('2023-09-10', $canProspectoDia);
        $canInscritosDia = $this->completar_fechas('2023-09-10', $canInscritosDia);
        $dia['canUsuariosDia'] = $canUsuariosDia;
        $dia['canProspectosDia'] = $canProspectoDia;
        $dia['canInscritosDia'] = $canInscritosDia;
        // REPORTE POR MODALIDADES (Sin join a tabla modalidades)
        $canModalidad_a = DB::table('fichas AS f')
            ->whereNotNull('f.mcp_id_modalidad')
            ->select(
                DB::raw("(SELECT 'TOTAL') AS modalidad"),
                DB::raw("COUNT(f.id) AS total"), // Cambiado m.id por f.id
                DB::raw("COUNT(IF(f.id_estado_revision=3, 1, NULL)) AS inscritos"),
                DB::raw("COUNT(IF(f.id_estado_revision!=3, 1, NULL)) AS proceso")
            );

        $canModalidad = DB::table('fichas AS f')
            ->whereNotNull('f.mcp_id_modalidad')
            ->select(
                'f.mcp_id_modalidad AS modalidad', // Enviaremos el ID en lugar del nombre
                DB::raw("COUNT(f.id) AS total"),
                DB::raw("COUNT(IF(f.id_estado_revision=3, 1, NULL)) AS inscritos"),
                DB::raw("COUNT(IF(f.id_estado_revision!=3, 1, NULL)) AS proceso")
            )
            ->groupBy('f.mcp_id_modalidad') // Agrupamos por el ID en la ficha
            ->union($canModalidad_a)
            ->get();
        if ($canUsuarios == null) {
            return response()->json(0);
        } else {
            return response()->json([
                // Llamado a la variable de instancia para que se retorne
                // Variables de instancia de Indicadores de Proceso
                'modalidades' => $canModalidad,
                'canPendientes' => $canPendientes,
                'canPreInscritos' => $canPreInscritos,
                'canInscritos' => $canInscritos,
                'totalProceso' => $totalProceso,
                'canUsuarios' => $canUsuarios,
                // Variables de instancia de Indicadores de Cantidad
                'canProspecto' => $canProspecto,
                'canExamPubl' => $canExamPubl,
                'canExamPriv' => $canExamPriv,
                'canPagoInscripcion' => $canPagoInscripcion,
                // Variables de instancia de Indicadores Económicos
                'pagoProspectos' => $pagoProspectos,
                'pagoExamPublico' => $pagoExamPublico,
                'pagoExamPrivado' => $pagoExamPrivado,
                'pagoTotal' => $pagoTotal,

                'general' => $reporteGeneral,
                'canUsuariosDia' => $canUsuariosDia,
                'dia' => $dia

            ]);
        }
    }

    function completar_fechas($fecha, $objeto)
    {
        $datos = [];
        $fecha_actual = date('Y-m-d');
        $json = json_encode($objeto);
        $objeto = json_decode($json, true);
        for ($fecha_inicio = date("Y-m-d", strtotime($fecha)); $fecha_inicio <= $fecha_actual; $fecha_inicio = date("Y-m-d", strtotime($fecha_inicio . "+ 1 days"))) {
            $keys = array_column($objeto, 'x');
            $index = array_search($fecha_inicio, $keys);
            if (is_numeric($index)) {
                array_push($datos, $objeto[$index]);
            } else {
                array_push($datos, [
                    'x' => $fecha_inicio,
                    'y' => 0,
                ]);
            }
        }
        return $datos;
    }
    public function reporte_carrera(Request $request)
    {
        $modalidad = isset($request->modalidad) ? $request->modalidad : null;
        $resultado = DB::table('fichas')
            ->where('fichas.id_estado_revision', 3);
        if (!empty($modalidad) && $modalidad != "0") {
            $resultado = $resultado->where('fichas.mcp_id_modalidad', $modalidad);
        }
         
        $resultado = $resultado
            ->join('carreras', 'fichas.mcp_id_carrera', '=', 'carreras.id')
            ->select(DB::raw("carreras.carrera AS x"), DB::raw("COUNT(fichas.id) AS y"))
            ->groupBy('x')
            ->orderBy('fichas.mcp_id_carrera')
            ->get();
        return response()->json([
            'carrera' => $resultado
        ]);
    }
    public function reporte_modalidad(Request $request)
    {
        $carrera = isset($request->carrera) ? $request->carrera : null;
        
        $resultado = DB::table('fichas')
            ->where('fichas.id_estado_revision', 3);
        if ($carrera) {
            $resultado = $resultado->where('fichas.mcp_id_carrera', $carrera);
        }
        $resultado = $resultado
            ->select(DB::raw("fichas.mcp_id_modalidad AS x"), DB::raw("COUNT(fichas.id) AS y"))
            ->groupBy('x')
            ->orderBy('fichas.mcp_id_modalidad')
            ->get();
        $modOrdinario = DB::table('fichas AS f')
            ->where('f.mcp_id_modalidad', 1);
        if ($carrera) {
            $modOrdinario = $modOrdinario->where('f.mcp_id_carrera', $carrera);
        }
        $modOrdinario = $modOrdinario->select(
            DB::raw("'ORDINARIO' AS modalidad"),
            DB::raw("COUNT(f.id) AS total"),
            DB::raw("COUNT(IF(f.id_estado_revision=3, 1, NULL)) AS inscritos"),
            DB::raw("COUNT(IF(f.id_estado_revision!=3, 1, NULL)) AS proceso")
        )->groupBy('f.mcp_id_modalidad')->get();

        $modExtraordinario = DB::table('fichas AS f')
            ->whereIn('f.mcp_id_modalidad', [2, 3, 10, 4, 5, 6, 7]);
        if ($carrera) {
            $modExtraordinario = $modExtraordinario->where('f.mcp_id_carrera', $carrera);
        }
        $modExtraordinario = $modExtraordinario->select(
            DB::raw("(SELECT 'EXTRAORDINARIO') AS modalidad"),
            DB::raw("COUNT(f.id) AS total"),
            DB::raw("COUNT(IF(f.id_estado_revision=3, 1, NULL)) AS inscritos"),
            DB::raw("COUNT(IF(f.id_estado_revision!=3, 1, NULL)) AS proceso")
        )->get();

        $subModalidades = DB::table('fichas AS f')
            ->whereIn('f.mcp_id_modalidad', [2, 3, 10, 4, 5, 6, 7]);
        if ($carrera) {
            $subModalidades = $subModalidades->where('f.mcp_id_carrera', $carrera);
        }
        $subModalidades = $subModalidades->select(
            'f.mcp_id_modalidad AS modalidad', // Enviamos el ID de la submodalidad
            DB::raw("COUNT(f.id) AS total"),
            DB::raw("COUNT(IF(f.id_estado_revision=3, 1, NULL)) AS inscritos"),
            DB::raw("COUNT(IF(f.id_estado_revision!=3, 1, NULL)) AS proceso")
        )->groupBy('f.mcp_id_modalidad')->get();

        return response()->json([
            'modalidad' => $resultado,
            'modOrdinario' => $modOrdinario,
            'modExtraordinario' => $modExtraordinario,
            'subModalidades' => $subModalidades
        ]);
    }
    public function reporte_colegios(Request $request)
    {
        // Captura de parámetros
        $id_provincia = $request->query('id_provincia');
        $modalidad = $request->query('modalidad');
        $carrera = $request->query('carrera');

        $query = DB::table('fichas')
            ->join('distritos', 'fichas.da_dis', '=', 'distritos.id_distrito')
            ->join('provincias', 'fichas.da_prov', '=', 'provincias.id_provincia')
            ->join('departamentos', 'fichas.da_dep', '=', 'departamentos.id_departamento')
            ->join('universidades', 'fichas.diep_id_colegio', '=', 'universidades.id')
            ->where('fichas.id_estado_revision', 3);

        // Filtro Provincia (Solo si no está vacío)
        if (!empty($id_provincia) && $modalidad != "0") {
            $query->where('distritos.id_provincia', $id_provincia);
        }

        // Filtro Modalidad (Ignora si es 0 o vacío)
        if (!empty($modalidad) && $modalidad != "0") {
            $query->where('fichas.mcp_id_modalidad', $modalidad);
        }

        // Filtro Carrera (Ignora si es 0 o vacío)
        if (!empty($carrera) && $carrera != "0") {
            $query->where('fichas.mcp_id_carrera', $carrera);
        }

        $resultado = $query
            ->select(
                'universidades.nombre AS x',            // Nombre del colegio/universidad
                'universidades.provincia AS provincia', // Ubicación del colegio
                'departamentos.departamento AS departamento',   // Departamento del postulante
                DB::raw("COUNT(fichas.id) AS y")       // Cantidad
            )
            // Agregamos todos los campos del select al groupBy para evitar errores en SQL estricto
            ->groupBy('universidades.nombre', 'universidades.provincia', 'departamentos.departamento')
            ->orderBy('y', 'desc') // Ordenar de mayor a menor cantidad de alumnos
            ->get();

        return response()->json([
            'colegios' => $resultado
        ]);
    }
     public function reporte_distrito(Request $request)
    {
        $id_provincia = $request->query('id_provincia');
        $modalidad = $request->query('modalidad'); // Recibe el 0 o el ID
        $carrera = $request->query('carrera');

        $query = DB::table('fichas')
            ->join('distritos', 'fichas.da_dis', '=', 'distritos.id_distrito')
            ->join('provincias', 'distritos.id_provincia', '=', 'provincias.id_provincia')
            ->where('fichas.id_estado_revision', 3);

        // Si id_provincia no es nulo y no es vacío, filtra
        if (!empty($id_provincia)) {
            $query->where('distritos.id_provincia', $id_provincia);
        }

        // CLAVE: Si modalidad es 0, null o vacío, NO entra al filtro y trae todos
        if (!empty($modalidad) && $modalidad != "0") {
            $query->where('fichas.mcp_id_modalidad', $modalidad);
        }

       if (isset($request->carrera) && $request->carrera != 0) {
            $query->where('fichas.mcp_id_carrera', $request->carrera);
        }

        $resultado = $query
            ->select(
                'distritos.distrito AS x', 
                DB::raw("COUNT(fichas.id) AS y")
            )
            ->groupBy('distritos.id_distrito', 'distritos.distrito')
            ->orderBy('y', 'desc')
            ->get();

        return response()->json([
            'distrito' => $resultado
        ]);
    }
    public function reporte_publicidad(Request $request)
    {
        $id_provincia = isset($request->id_provincia) ? $request->id_provincia : null;
        $modalidad = isset($request->modalidad) ? $request->modalidad : null;
        $carrera = isset($request->carrera) ? $request->carrera : null;
        $resultado = DB::table('fichas')
            ->join('distritos', 'fichas.da_dis', '=', 'distritos.id_distrito')
            ->where('fichas.id_estado_revision', 3);
        if ($modalidad) {
            $resultado = $resultado->where('fichas.mcp_id_modalidad', $modalidad);
        }
        $resultado = $resultado
            ->select(DB::raw("fichas.dd_publicidad AS x"), DB::raw("COUNT(fichas.id) AS y"))
            ->groupBy('x')
            ->orderBy('fichas.dd_publicidad')
            ->get();

        return response()->json([
            'publicidad' => $resultado
        ]);
    }
    public function reporte_fecha(Request $request)
{
    $modalidad = $request->query('modalidad');        
    $desde = $request->query('desde');
    $hasta = $request->query('hasta');

    // 1. Preparar el filtro de modalidad para las consultas de Eloquent
    // Si es "0" o vacío, no filtramos (trae todos)
    $filtroModalidad = null;
    if (!empty($modalidad) && $modalidad != "0") {
        $filtroModalidad = $modalidad;
    }

    // 2. Consulta: En Proceso (x, y)
    $queryProceso = DB::table('fichas')
        ->where('id_estado', 1)
        ->whereNotIn('id_estado_revision', [3]);
    
    if ($filtroModalidad) {
        $queryProceso->where('mcp_id_modalidad', $filtroModalidad);
    }

    $canProcesoDia = $queryProceso
        ->when($desde && $hasta, function ($q) use ($desde, $hasta) {
            $fHasta = date('Y-m-d', strtotime($hasta . ' +1 day'));
            return $q->whereBetween('created_at', [$desde, $fHasta]);
        })
        ->select(DB::raw("DATE_FORMAT(created_at,'%Y-%m-%d') AS x"), DB::raw("COUNT(id) AS y"))
        ->groupBy('x')
        ->get();

    // 3. Consulta: Inscritos (x, y)
    $queryInscritos = DB::table('fichas')
        ->where('id_estado_revision', 3);

    if ($filtroModalidad) {
        $queryInscritos->where('mcp_id_modalidad', $filtroModalidad);
    }

    $canInscritosDia = $queryInscritos
        ->when($desde && $hasta, function ($q) use ($desde, $hasta) {
            $fHasta = date('Y-m-d', strtotime($hasta . ' +1 day'));
            return $q->whereBetween('fecha_revisado', [$desde, $fHasta]);
        })
        ->select(DB::raw("DATE_FORMAT(fecha_revisado,'%Y-%m-%d') AS x"), DB::raw("COUNT(id) AS y"))
        ->groupBy('x')
        ->get();

    // 4. Completar fechas para los gráficos
    $fechaInicio = !empty($desde) ? $desde : '2023-10-10';
    $canProcesoDia = $this->completar_fechas($fechaInicio, $canProcesoDia);
    $canInscritosDia = $this->completar_fechas($fechaInicio, $canInscritosDia);

    // 5. Lógica para la Tabla (UNION) - Evitamos errores de string vacío
    $sqlMod = "";
    if ($filtroModalidad) {
        $sqlMod = " AND mcp_id_modalidad = " . intval($filtroModalidad);
    }

    $fHastaFull = $hasta ? date('Y-m-d', strtotime($hasta . ' +1 day')) : null;
    $sqlFecha1 = ($desde && $hasta) ? " AND created_at BETWEEN '$desde' AND '$fHastaFull'" : "";
    $sqlFecha2 = ($desde && $hasta) ? " AND fecha_revisado BETWEEN '$desde' AND '$fHastaFull'" : "";

    $subQuery = "
        (SELECT DATE_FORMAT(created_at, '%Y-%m-%d') AS fecha, COUNT(id) AS proceso, 0 AS inscritos
         FROM fichas WHERE id_estado = 1 AND id_estado_revision != 3 $sqlMod $sqlFecha1
         GROUP BY fecha
         UNION ALL
         SELECT DATE_FORMAT(fecha_revisado, '%Y-%m-%d') AS fecha, 0 AS proceso, COUNT(id) AS inscritos
         FROM fichas WHERE id_estado_revision = 3 $sqlMod $sqlFecha2
         GROUP BY fecha) AS combined
    ";

    $estadisticafecha_a = DB::table(DB::raw($subQuery))
        ->select(DB::raw('"TOTAL" as fecha'), DB::raw('SUM(proceso) as proceso'), DB::raw('SUM(inscritos) AS inscritos'));

    $estadisticafecha = DB::table(DB::raw($subQuery))
        ->select('fecha', DB::raw('SUM(proceso) AS proceso'), DB::raw('SUM(inscritos) AS inscritos'))
        ->groupBy('fecha')
        ->orderBy('fecha')
        ->union($estadisticafecha_a)
        ->get();

    return response()->json([
        'estadisticafecha' => $estadisticafecha,
        'canProcesoDia' => $canProcesoDia,
        'canInscritosDia' => $canInscritosDia,
        'dia' => [
            'canProcesoDia' => $canProcesoDia,
            'canInscritosDia' => $canInscritosDia
        ]
    ]);
}

    public function obtenerCarreras() // No necesitas el $request si solo vas a listar todas
    {
        $carreras = DB::table('carreras')
            ->select('id', 'carrera')
            ->where('estado', 1) // Solo carreras activas
            ->orderBy('carrera', 'asc') // Orden alfabético
            ->get();

        return response()->json([
            'carreras' => $carreras
        ]);
    }

}
