<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
Use App\Models\Departamento;

class DepartamentoController extends Controller
{
    public function index()
    {
        $departamentos = DB::table('departamentos')->select('id_departamento as id', 'departamento as nombre')->get();
        //dd($pago);
        if($departamentos==null){
            return response()->json(0);
        }else{
            return response()->json($departamentos);  
        }
        
    }
    public function show(Departamento $departamento)
    {
        return response()->json([
            'departamento'=>$departamento
        ]);
    }
}
