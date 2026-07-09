<?php

namespace App\Http\Controllers;

use App\Models\Documento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Symfony\Component\VarDumper\VarDumper;

class DocumentoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        /* $documento = DB::table('documentos')
        ->join('fichas', 'fichas.id', '=', 'documentos.ficha_id')
        ->join('users', 'users.id', '=', 'fichas.user_id ')
        ->where('user_id', Auth::user()->id)->get(); */
        $id_ficha = isset($request->id_ficha) ? $request->id_ficha : null;

        $documento = DB::table('users')
        ->join('fichas', 'fichas.user_id', '=', 'users.id')
        ->join('documentos', 'documentos.ficha_id', '=', 'fichas.id')
        ->join('tipo_documentos', 'documentos.tipo_documento_id', '=', 'tipo_documentos.id')
        ->select('documentos.*', 'tipo_documentos.nombre')
        ->where('fichas.id_estado', 1)
        ->where('documentos.id_estado', 1)
        ->where('tipo_documentos.id_estado', 1)
        ->where('users.id', Auth::user()->id)
        ->where('documentos.ficha_id', $id_ficha)
        ->get();
        //dd($pago);
        if($documento==null){
            return response()->json(0);
        }else{
            return response()->json($documento);  
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Documento  $documento
     * @return \Illuminate\Http\Response
     */
    public function show(Documento $documento)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Documento  $documento
     * @return \Illuminate\Http\Response
     */
    public function edit(Documento $documento)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Documento  $documento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $archivoMovido=false;
        $mensajeRespuesta = '';
        $request->validate([
            'archivo'=>['required'],
            'tipo'=>['required'],
            'id_documento'=>['required'],
        ]);

        $documento = Documento::find($id);

        if($request->hasFile('archivo') && $documento->id_estado_revision!=3)
        {
            //echo 'hay archivo';
            $extension=$request->file('archivo')->getClientOriginalExtension();
            $extension=strtolower($extension);

            if($request->tipo==1){
                $extension_correcta = ($extension == 'pdf' or $extension == 'rar' or $extension == 'zip');
            }elseif ($request->tipo==2) {
                $extension_correcta = ($extension == 'pdf' or $extension == 'rar' or $extension == 'zip');
            }elseif ($request->tipo==3) {
                $extension_correcta = ($extension == 'pdf' or $extension == 'jpeg' or $extension == 'jpg' or $extension == 'png');
            }elseif ($request->tipo==4) {
                $extension_correcta = ($extension == 'jpeg' or $extension == 'jpg' or $extension == 'png');
            }

            if ($extension_correcta) {
                //$nameComplete=Auth::user()->numero_documento.'-'.$request->tipo.'-'.Auth::user()->id.'-'.date("md-His").'.'.$extension;
                //$nameComplete=Auth::user()->numero_documento.'-'.$request->tipo.'-'.rand(2000, 2999).'.'.$extension;
                $nameComplete=Auth::user()->numero_documento.'-1'.$request->tipo.'-'.date('md').'.'.$extension;
                
                if($request->file('archivo')->storeAs('public/documentos', $nameComplete)){
                    $archivoMovido=true;
                }else{
                    $archivoMovido=false;
                    $mensajeRespuesta = 'Error al enviar archivo';
                }
            }else {
                $mensajeRespuesta = 'Tipo de archivo incorrecto';
            }
        }else {
            $mensajeRespuesta = 'Error al enviar archivo';
            $status="false";
            $success=0;
        }

        
        if ($archivoMovido) {
            //FALTA MEJORAR SEGURIDAD
            
            if($documento->id){
                $documento->enlace=$nameComplete;
                $documento->id_estado_revision=1;
                $documento->tipo_documento_id=$request->tipo;
                $documento->fecha_solicitado=date("Y-m-d H:i:s");
                $documento->save();
                $status="success";
                $mensajeRespuesta = 'Archivo enviado';
                $success=1;
            }else{
                $status="false";
                $success=0;
            }
        }else{
            $status="false";
            $success=0;
        }
        
        return response()->json([
            'documento'=>$documento,
            'message'=>$mensajeRespuesta,
            'status'=>$status,
            'success'=>$success
        ]);
    }

    public function listardocumentos(Request $request)
    {

        /* $request->validate([
            'id_ficha'=>['required']
        ]); */

        //var_dump($request->id_ficha); 
        $documento = DB::table('documentos')
        ->join('tipo_documentos', 'tipo_documentos.id', '=', 'documentos.tipo_documento_id')
        ->select('documentos.*', 'tipo_documentos.nombre')
        ->where('documentos.id_estado', 1)
        ->where('tipo_documentos.id_estado', 1)
        ->where('documentos.ficha_id', $request->id_ficha)->get();
        //dd($ficha);
        //echo gettype($ficha);
        if($documento==null){
            return response()->json(0);
        }else{
            return response()->json([
                'documentos'=>$documento,
            ]);  
        }

        /* $ficha = DB::table('fichas')->where('id_estado', 1)->get();
        if($ficha==null){
            return response()->json(0);
        }else{
            return response()->json($ficha);  
        } */
    }
    public function verificar_documento(Request $request){

        $request->validate([
            'id'=>['required'],
            'id_estado_revision'=>['required'],
            'dato'=>['required'],
        ]);

        $pago = Documento::find($request->id);
        if($request->id_estado_revision==3){
            if($pago->id_estado_revision==1){
                $pago->id_estado_revision=3;
                //$pago->fecha_pago=$request->dato; 
                $pago->id_usu_revisado=Auth::user()->id;
                $pago->fecha_revisado=date("Y-m-d H:i:s");
                if($pago->save()){
                    $status="success";
                }else{
                    $status="false";
                }
            }else{
                $status="false";
            }
            
        
        }
        if($request->id_estado_revision==2){
            if($pago->id_estado_revision==1){
                $pago->id_estado_revision=2;
                $pago->observacion=$request->dato;
                $pago->id_usu_revisado=Auth::user()->id;
                $pago->fecha_revisado=date("Y-m-d H:i:s");
                if($pago->save()){
                    $status="success";
                }else{
                    $status="false";
                }
            }else{
                $status="false";
            }
        }
        
        

        return response()->json([
            'pago'=>$pago,
            'status'=>$status
        ]);
    }

    public function actualizar_foto(Request $request){
        //dd($request);
        //$esAdmin = Auth::user()->id == 3576;

        $documento = Documento::find($request->id);
        if($request->hasFile('archivo') )
        {
            //echo 'hay archivo';
            $extension=$request->file('archivo')->getClientOriginalExtension();
            $extension=strtolower($extension);

            if($request->tipo_documento_id==1){
                $extension_correcta = ($extension == 'pdf' or $extension == 'rar' or $extension == 'zip');
            }elseif ($request->tipo_documento_id==2) {
                $extension_correcta = ($extension == 'pdf' or $extension == 'rar' or $extension == 'zip');
            }elseif ($request->tipo_documento_id==3) {
                $extension_correcta = ($extension == 'pdf' or $extension == 'jpeg' or $extension == 'jpg' or $extension == 'png');
            }elseif ($request->tipo_documento_id==4) {
                $extension_correcta = ($extension == 'jpeg' or $extension == 'jpg' or $extension == 'png');
            }

            if ($extension_correcta) {
                //$nameComplete=Auth::user()->numero_documento.'-'.$request->tipo.'-'.Auth::user()->id.'-'.date("md-His").'.'.$extension;
                //$nameComplete=Auth::user()->numero_documento.'-'.$request->tipo.'-'.rand(2000, 2999).'.'.$extension;
                //$nameComplete=Auth::user()->numero_documento.'-1'.$request->tipo.'-'.date('md').'.'.$extension;
                
                
                if($request->file('archivo')->storeAs('public/documentos', $request->enlace)){
                    $documento->id_estado_revision=1;
                    $documento->fecha_solicitado=date("Y-m-d H:i:s");
                    $documento->save();
                    
                    $archivoMovido=true;
                    //$mensajeRespuesta = 'Archivo actualizado';
                    $mensajeRespuesta = $request->all();
                    $status="true";
                    $success=1;
                }else{
                    $archivoMovido=false;
                    $mensajeRespuesta = 'Error al enviar archivo';
                    $status="false";
                    $success=0;
                }
            }else {
                $mensajeRespuesta = 'Tipo de archivo incorrecto';
                $status="false";
                $success=0;
            }
        }else {
            $mensajeRespuesta = 'Error al enviar archivo, no llego';
            $status="false";
            $success=0;
        }
        return response()->json([
            //'documento'=>$documento,
            'message'=>"Error",
            'status'=>$status,
            'success'=>$success
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Documento  $documento
     * @return \Illuminate\Http\Response
     */
    public function destroy(Documento $documento)
    {
        //
    }
}
