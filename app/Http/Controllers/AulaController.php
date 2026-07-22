<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Aula;
use Illuminate\Http\Request;

class AulaController extends Controller
{
    public function index()
    {
        // Usamos with('local') para traer los datos del local asociado a cada aula
        $aulas = Aula::with('local')->orderBy('id', 'desc')->get();

        return response()->json([
            'status' => 'success',
            'data'   => $aulas,
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'local_id'      => 'required|integer',
            'codigo_aula'  => 'required|integer',
            'aula'  => 'required|string|max:10',
            'id_examen'  => 'required|integer',
            'id_estado'  => 'required|boolean',
        ]);

        $aula = Aula::create($data);

        return response()->json([
            'status'  => 'success',
            'message' => 'Aula creada correctamente.',
            'data'    => $aula,
        ], 201);
    }

    public function show(Aula $aula)
    {
        return response()->json([
            'status' => 'success',
            'data'   => $aula,
        ]);
    }

    public function update(Request $request, Aula $aula)
    {
 
        $data = $request->validate([
            'local_id'      => 'required|integer',
            'codigo_aula'  => 'required|integer',
            'aula'  => 'required|string|max:10',
            'id_examen'  => 'required|integer',
            'id_estado'  => 'required|boolean',
        ]);

        $aula->update($data);

        return response()->json([
            'status'  => 'success',
            'message' => 'Aula actualizada correctamente.',
            'data'    => $aula,
        ]);
    }
    

    public function destroy(Aula $aula)
    {
        $aula->update(['id_estado' => false]);

        return response()->json([
            'status'  => 'success',
            'message' => 'Aula desactivada correctamente.',
            'data'    => $aula,
        ]);
    }

    /**
     * Alterna el estado (activo/inactivo) de un aula.
     * Ruta custom: POST /api/aulas/{aula}/toggle-estado
     */
    public function toggleEstado(Aula $aula)
    {
        $aula->update(['id_estado' => ! $aula->id_estado]);

        return response()->json([
            'status'  => 'success',
            'message' => $aula->id_estado ? 'Aula activada correctamente.' : 'Aula desactivada correctamente.',
            'data'    => $aula,
        ]);
    }
}