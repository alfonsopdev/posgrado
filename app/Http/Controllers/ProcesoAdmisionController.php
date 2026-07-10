<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ProcesoAdmision;
use App\Models\Local;
use Illuminate\Http\Request;

class ProcesoAdmisionController extends Controller
{
    public function index()
    {
        $procesos = ProcesoAdmision::with('local')->orderBy('id', 'desc')->get();
        return response()->json(['status' => 'success', 'data' => $procesos]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'codigo' => 'required|string|max:20|unique:procesos_admision',
            'nombre' => 'required|string|max:255',
            'local_id' => 'required|exists:locales,id',
            'fecha_examen' => 'required|date',
            'hora_inicio' => 'required|string|max:10',
            'hora_fin' => 'required|string|max:10',
            'carnet_titulo' => 'required|string|max:255',
            'qr_base_url' => 'required|string|max:255',
            'activo' => 'boolean',
        ]);

        $proceso = ProcesoAdmision::create($data);

        return response()->json([
            'status' => 'success',
            'message' => 'Proceso creado correctamente',
            'data' => $proceso->load('local'),
        ]);
    }

    public function show($id)
    {
        $proceso = ProcesoAdmision::with('local')->findOrFail($id);
        return response()->json(['status' => 'success', 'data' => $proceso]);
    }

    public function update(Request $request, $id)
    {
        $proceso = ProcesoAdmision::findOrFail($id);

        $data = $request->validate([
            'codigo' => 'required|string|max:20|unique:procesos_admision,codigo,' . $id,
            'nombre' => 'required|string|max:255',
            'local_id' => 'required|exists:locales,id',
            'fecha_examen' => 'required|date',
            'hora_inicio' => 'required|string|max:10',
            'hora_fin' => 'required|string|max:10',
            'carnet_titulo' => 'required|string|max:255',
            'qr_base_url' => 'required|string|max:255',
            'activo' => 'boolean',
        ]);

        $proceso->update($data);

        return response()->json([
            'status' => 'success',
            'message' => 'Proceso actualizado correctamente',
            'data' => $proceso->load('local'),
        ]);
    }

    public function destroy($id)
    {
        $proceso = ProcesoAdmision::findOrFail($id);
        $proceso->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Proceso eliminado',
        ]);
    }

    public function activar($id)
    {
        ProcesoAdmision::where('activo', true)->update(['activo' => false]);

        $proceso = ProcesoAdmision::findOrFail($id);
        $proceso->update(['activo' => true]);

        return response()->json([
            'status' => 'success',
            'message' => 'Proceso activado correctamente',
            'data' => $proceso->load('local'),
        ]);
    }
}