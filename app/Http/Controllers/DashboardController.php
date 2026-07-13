<?php

namespace App\Http\Controllers;

use App\Models\Ficha;
use App\Models\Local;
use App\Models\ProcesoAdmision;

class DashboardController extends Controller
{
    public function index()
    {
        $procesosTotal   = ProcesoAdmision::count();
        $procesosActivos = ProcesoAdmision::where('activo', 1)->count();

        $localesTotal   = Local::count();
        $localesActivos = Local::where('id_estado', 1)->count();

        $postulantesTotal = Ficha::where('id_estado', 1)->count();

        $procesoActivo = ProcesoAdmision::where('activo', 1)->first();

        $postulantesProcesoActivo = $procesoActivo
            ? Ficha::where('proceso_admision_id', $procesoActivo->id)
                ->where('id_estado', 1)
                ->count()
            : 0;

        $inscripcionesPorProceso = ProcesoAdmision::withCount(['fichas' => function ($q) {
                $q->where('id_estado', 1);
            }])
            ->orderBy('id')
            ->get()
            ->map(fn ($p) => [
                'codigo' => $p->codigo,
                'nombre' => $p->nombre,
                'total'  => $p->fichas_count,
            ]);

        $actividadReciente = Ficha::with('procesoAdmision')
            ->where('id_estado', 1)
            ->orderBy('created_at', 'desc')
            ->limit(8)
            ->get()
            ->map(fn ($f) => [
                'codigo_p'          => $f->codigo_p,
                'nombre_completo'   => trim("{$f->dp_nombre} {$f->dp_apellido_p} {$f->dp_apellido_m}"),
                'proceso'           => $f->procesoAdmision->nombre ?? '—',
                'estado_postulante' => $f->estado_postulante,
                'fecha_solicitado'  => $f->fecha_solicitado,
            ]);

        return response()->json([
            'status' => 'success',
            'data'   => [
                'kpis' => [
                    'procesos_activos'           => $procesosActivos,
                    'procesos_total'             => $procesosTotal,
                    'locales_activos'            => $localesActivos,
                    'locales_total'              => $localesTotal,
                    'postulantes_total'          => $postulantesTotal,
                    'postulantes_proceso_activo' => $postulantesProcesoActivo,
                    'proceso_activo_nombre'      => $procesoActivo->nombre ?? null,
                ],
                'inscripciones_por_proceso' => $inscripcionesPorProceso,
                'actividad_reciente'        => $actividadReciente,
            ],
        ]);
    }
}