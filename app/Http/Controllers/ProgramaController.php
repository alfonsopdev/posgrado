<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Programa;
use Illuminate\Http\Request;

class ProgramaController extends Controller
{
    public function index()
    {
        $programas = Programa::orderBy('id', 'desc')->get();

        return response()->json([
            'status' => 'success',
            'data'   => $programas,
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'codigo_programa' => 'required|string|max:20|unique:programas,codigo_programa',
            'programa'      => 'required|string|max:255|unique:programas,nombre',
            'nombre_corto'  => 'required|string|max:4',
            'nom_corto'  => 'required|string|max:35',
            'id_estado'  => 'required|boolean',
        ]);

        $programa = Programa::create($data);

        return response()->json([
            'status'  => 'success',
            'message' => 'Programa creado correctamente.',
            'data'    => $programa,
        ], 201);
    }

    public function show(Programa $programa)
    {
        return response()->json([
            'status' => 'success',
            'data'   => $programa,
        ]);
    }

    public function update(Request $request, Programa $programa)
    {
 
        $data = $request->validate([
            'codigo_programa' => 'required|string|max:20|unique:programas,codigo_programa,' . $programa->id,
            'programa'      => 'required|string|max:255|unique:programas,programa,' . $programa->id,
            'nombre_corto'  => 'required|string|max:4',
            'nom_corto'  => 'required|string|max:35',
            'id_estado'  => 'required|boolean',
        ]);

        $programa->update($data);

        return response()->json([
            'status'  => 'success',
            'message' => 'Programa actualizado correctamente.',
            'data'    => $programa,
        ]);
    }

    public function destroy(Programa $programa)
    {
        $programa->update(['id_estado' => false]);

        return response()->json([
            'status'  => 'success',
            'message' => 'Programa desactivado correctamente.',
            'data'    => $programa,
        ]);
    }

    
    public function toggleEstado(Programa $programa)
    {
        $programa->update(['id_estado' => ! $programa->id_estado]);

        return response()->json([
            'status'  => 'success',
            'message' => $programa->id_estado ? 'Programa activado correctamente.' : 'Programa desactivado correctamente.',
            'data'    => $programa,
        ]);
    }
}