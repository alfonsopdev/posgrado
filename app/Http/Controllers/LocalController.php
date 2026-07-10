<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Local;
use Illuminate\Http\Request;

class LocalController extends Controller
{
    public function index()
    {
        $locales = Local::orderBy('id', 'desc')->get();

        return response()->json([
            'status' => 'success',
            'data'   => $locales,
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'local'      => 'required|string|max:255|unique:locales,local',
            'direccion'  => 'required|string|max:255',
            'id_estado'  => 'required|boolean',
        ]);

        $local = Local::create($data);

        return response()->json([
            'status'  => 'success',
            'message' => 'Local creado correctamente.',
            'data'    => $local,
        ], 201);
    }

    public function show(Local $local)
    {
        return response()->json([
            'status' => 'success',
            'data'   => $local,
        ]);
    }

    public function update(Request $request, Local $local)
    {
        $data = $request->validate([
            'local'      => 'required|string|max:255|unique:locales,local,' . $local->id,
            'direccion'  => 'required|string|max:255',
            'id_estado'  => 'required|boolean',
        ]);

        $local->update($data);

        return response()->json([
            'status'  => 'success',
            'message' => 'Local actualizado correctamente.',
            'data'    => $local,
        ]);
    }

    public function destroy(Local $local)
    {
        $local->update(['id_estado' => false]);

        return response()->json([
            'status'  => 'success',
            'message' => 'Local desactivado correctamente.',
            'data'    => $local,
        ]);
    }

    /**
     * Alterna el estado (activo/inactivo) de un local.
     * Ruta custom: POST /api/locales/{local}/toggle-estado
     */
    public function toggleEstado(Local $local)
    {
        $local->update(['id_estado' => ! $local->id_estado]);

        return response()->json([
            'status'  => 'success',
            'message' => $local->id_estado ? 'Local activado correctamente.' : 'Local desactivado correctamente.',
            'data'    => $local,
        ]);
    }
}