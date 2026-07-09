<?php

namespace App\Http\Controllers;

use App\Models\Distrito;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DistritoController extends Controller
{
    public function index(Request $request)
    {
        $distrito = DB::table('distritos')
            ->select('id_distrito as id', 'distrito as nombre')
            ->where('id_provincia', 
            $request->codigoProv)
            ->get();
        //dd($pago);
        if($distrito==null){
            return response()->json(0);
        }else{
            return response()->json($distrito);  
        }
        
    }
    public function show(Distrito $distrito)
    {
        return response()->json([
            'distrito'=>$distrito
        ]);
    }

}
