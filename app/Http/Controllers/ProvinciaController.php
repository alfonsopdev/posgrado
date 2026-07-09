<?php

namespace App\Http\Controllers;

use App\Models\Provincia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProvinciaController extends Controller
{
    public function index(Request $request)
    {
        $provincia = DB::table('provincias')->select('id_provincia as id', 'provincia as nombre')->where('id_departamento', $request->codigoDep)->get();
        //dd($pago);
        if($provincia==null){
            return response()->json(0);
        }else{
            return response()->json($provincia);  
        }
        
    }
    public function show(Provincia $provincia)
    {
        return response()->json([
            'provincia'=>$provincia
        ]);
    }
}
