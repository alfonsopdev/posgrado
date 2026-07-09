<?php

namespace App\Http\Controllers;

use App\Models\Pago;
use DateTime;
use DateTimeZone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PagoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pago = DB::table('pagos')->where('user_id', Auth::user()->id)->get();
        //dd($pago);
        if($pago==null){
            return response()->json(0);
        }else{
            return response()->json($pago);
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

        //VARIABLES DE VERIFICACIÓN

        $archivoMovido=false;
        $verificarPago = false;

        $mensajeRespuesta = '';

        $request->validate([
            'archivo'=>['required'],
            'id_tipo_pago'=>['required'],
            'cuenta_pago'=>['required'],
            'fecha_pago'=>['required'],
            'codigo_pago'=>['required', 'min:4', 'max:15'],
        ]);

        //VERIFICAR SI EXISTE PAGO CON EL MISMO CÓDIGO
        $pagoRepetido = DB::table('pagos')
        ->where('codigo_pago', $request->codigo_pago)
        ->where('id_estado_revision', 3)
        ->get()
        ->count();
        
        if($pagoRepetido>=1){
            $verificarPago = false;
            $mensajeRespuesta = 'Error en el código de pago';
        }else{
            $verificarPago = true;
        }

        //VERIFICAR SI EXISTE FICHA
        $existeFicha = DB::table('fichas')
        ->where('user_id', Auth::user()->id)
        ->where('id_estado', 1)
        ->orderBy('postulacion', 'desc')
        ->get()->first();
        if($existeFicha){

            $idfichainsc = $existeFicha->id;
            //
        }else{
            $idfichainsc = NULL;
        };
        //exit;

        if($request->hasFile('archivo') && $verificarPago)
        {
            $extension=$request->file('archivo')->getClientOriginalExtension();
            $extension=strtolower($extension);

            $extension_correcta = ($extension == 'pdf' or $extension == 'jpeg' or $extension == 'jpg' or $extension == 'png');
            if($extension_correcta){
                //$nameComplete=Auth::user()->numero_documento.'-'.$request->id_tipo_pago.'-'.rand(1000, 1999).'.'.$extension;
                $nameComplete=Auth::user()->numero_documento.'-0'.$request->id_tipo_pago.'-'.date('md').'.'.$extension;
                //var_dump($nameComplete);

                //dd($request->file('archivo'));
                if($request->file('archivo')->storeAs('public/pagos', $nameComplete)){

                    $archivoMovido=true;
                }else{
                    $archivoMovido=false;
                    $mensajeRespuesta = 'Error al enviar archivo';
                }

            }else{
                $mensajeRespuesta = 'Tipo de archivo incorrecto';
            }
        }
        //exit;
        if($archivoMovido && $verificarPago){
            $pago = Pago::create([
                'user_id'=>Auth::user()->id,
                'id_tipo_pago'=>$request->id_tipo_pago,
                'id_ficha'=>$idfichainsc,
                'tipo_enlace'=>1,
                'enlace'=>$nameComplete,
                'id_estado_revision'=>1,
                'cuenta_pago'=>$request->cuenta_pago,
                'fecha_enviado'=>date("Y-m-d H:i:s"),
                'fecha_pago'=>$request->fecha_pago,
                'codigo_pago'=>$request->codigo_pago,
            ]);
            $mensajeRespuesta = 'Archivo enviado';
            $status="success";
            $success=1;

        }else{
            $pago = 0;
            $status="false";
            $success=0;
        }


        return response()->json([
            'pago'=>$pago,
            'message'=>$mensajeRespuesta,
            'status'=>$status,
            'success'=>$success
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //VARIABLES DE VERIFICACIÓN

        $archivoMovido=false;
        $verificarPago = false;

        $mensajeRespuesta = '';

        $request->validate([
            'archivo'=>['required'],
            'fecha_pago'=>['required'],
            'cuenta_pago'=>['required'],
            'codigo_pago'=>['required', 'min:4', 'max:15']
        ]);

        $pago = Pago::find($id);


        //VERIFICAR SI EXISTE
        $pagoRepetido = DB::table('pagos')
        ->where('codigo_pago', $request->codigo_pago)
        ->where('id_estado_revision', 3)
        ->where('id', '!=' , $id)
        ->get()
        ->count();
        if($pagoRepetido>=1){
            $verificarPago = false;
            $mensajeRespuesta = 'Error en el código de pago';
        }else{
            $verificarPago = true;
        }

        if($request->hasFile('archivo') && $pago->id_estado_revision!=3 && $verificarPago)
        {
            $extension=$request->file('archivo')->getClientOriginalExtension();
            $extension=strtolower($extension);

            $extension_correcta = ($extension == 'pdf' or $extension == 'jpeg' or $extension == 'jpg' or $extension == 'png');
            if($extension_correcta){
                //$nameComplete=Auth::user()->numero_documento.'-'.$request->id_tipo_pago.'-'.rand(1000, 1999).'.'.$extension;
                $nameComplete=Auth::user()->numero_documento.'-0'.$pago->id_tipo_pago.'-'.date('md').'.'.$extension;
                if($request->file('archivo')->storeAs('public/pagos', $nameComplete)){
                    $archivoMovido=true;
                }else{
                    $archivoMovido=false;
                    $mensajeRespuesta = 'Error al enviar archivo';
                }
            }else{
                $mensajeRespuesta = 'Tipo de archivo incorrecto';
            }
        }

        if($pago->user_id==Auth::user()->id && $archivoMovido && $verificarPago){
            $pago->id_medio_pago=1;
            $pago->tipo_enlace=1;
            $pago->enlace=$nameComplete;
            $pago->id_estado_revision=1;
            $pago->cuenta_pago=$request->cuenta_pago;
            $pago->codigo_pago=$request->codigo_pago;
            $pago->monto_pago=null;
            $pago->fecha_pago=$request->fecha_pago;
            $pago->fecha_enviado=date("Y-m-d H:i:s");
            $pago->save();
            $status="success";
            $mensajeRespuesta = 'Archivo enviado';
            $success=1;
        }else{
            $status="false";
            $success=0;
        }

        return response()->json([
            'pago'=>$pago,
            'message'=>$mensajeRespuesta,
            'status'=>$status,
            'success'=>$success
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function revisar_tesoreria(Request $request){
        $pago = Pago::find($request->id_pago);
        $pago->teso_rev = $request->teso_rev;
        if ($request->teso_rev=='1') {
            $pago->id_estado_revision=3;
            $pago->fecha_revisado=date('Y-m-d H:i:s');
        }
        if ($request->teso_rev=='0') {
            $pago->id_estado_revision=1;
            $pago->fecha_revisado=null;
        }
        if( $pago->save() ) {
            $status="success";
            $success=1; // ok
        }else{
            $status="false";
            $success=0; // error
        }
        return response()->json([
            'status'=>$status,
            'success'=>$success,
        ]);
    }
    public function tesoreria_comentario(Request $request){
        $pago = Pago::find($request->id_pago);
        $pago->observacion = $request->observacion;
        $val_comen = $request->observacion == null ? 0 : 1;
        $pago->comentario = $val_comen;

        if( $pago->save() ) {
            $status="success";
            $success=1; // ok
        }else{
            $status="false";
            $success=0; // error
        }
        return response()->json([
            'status'=>$status,
            'success'=>$success,
        ]);
    }
    public function datos(Request $request)
    {

        $tipo = isset($request->tipo) ? $request->tipo : null;
        $estado = isset($request->estado) ? $request->estado : null;
        $fecha = isset($request->fecha) ? $request->fecha : null;
        //return response()->json(0);
        $pago = DB::table('pagos')
        ->join('users', 'pagos.user_id', '=', 'users.id')
        ->leftJoin('fichas', 'pagos.id_ficha', '=', 'fichas.id')
        // ->leftJoin('modalidades', 'fichas.mcp_id_modalidad', '=', 'modalidades.id')
        ->leftJoin('universidades', 'fichas.diep_id_colegio', '=', 'universidades.id')
        //->where('fichas.id_estado', 1)
        ->where('pagos.id_estado', 1)
        ->where('pagos.id_medio_pago', 1);

        // if ($tipo==2) {
        //     $pago = $pago->whereIn('pagos.id_tipo_pago', [2, 5, 6]);
        // }else{
        //     $pago = $pago->where('pagos.id_tipo_pago', $tipo);
        // }

        $pago->where('pagos.id_tipo_pago', $tipo);
        if ($fecha) {
            $pago->where('pagos.fecha_pago', $fecha);
        }

        // $pago->select('pagos.*', 'users.nombre', 'users.apellido_paterno', 'users.apellido_materno', 'users.email', 'users.numero_documento', 'users.numero_celular', 'colegios.D_GESTION', 'modalidades.modalidad', 'fichas.mcp_id_modalidad')
        $pago->select('pagos.*', 'users.nombre', 'users.apellido_paterno', 'users.apellido_materno', 'users.email', 'users.numero_documento', 'users.numero_celular', 'universidades.tipo')

        // //->orderBy('id_estado_revision', 'desc')
        ;

        if (is_numeric($estado)) {
            $pago = $pago->where('pagos.id_estado_revision', $estado);
        }
        $pago=$pago->orderByRaw('FIELD(pagos.id_estado_revision, 1, 3, 2, 0), fecha_revisado DESC, fecha_enviado ASC')->get();
        //$pago=$pago->get();
        if($pago==null){
            return response()->json(0);
        }else{
            return response()->json($pago);
        }
    }
    public function listarpagos(Request $request)
    {
        //return response()->json(0);
        $pago = DB::table('pagos')
        ->join('users', 'pagos.user_id', '=', 'users.id')
        ->where('pagos.id_estado', 1)
        ->where('pagos.id_ficha', $request->id_ficha)
        ->select('pagos.*', 'users.nombre', 'users.email')
        ->get();
        if($pago->count()==0){
            return response()->json([
                'pagos'=>0,
            ]);
        }else{
            return response()->json([
                'pagos'=>$pago,
            ]);
        }
    }



    public function verificar_pago(Request $request){

        $request->validate([
            'id'=>['required'],
            'id_estado_revision'=>['required'],
            'dato'=>['required'],
            'codigo_pago'=>['required'],
        ]);

        $code=0;
        $pago = Pago::find($request->id);
        if($request->id_estado_revision==3){

            //VERIFICAR SI EXISTE PAGO CON EL MISMO CÓDIGO
            $pagoRepetido = DB::table('pagos')
            ->where('codigo_pago', $request->codigo_pago)
            ->where('id_estado_revision', 3)
            ->get()
            ->count();

            if($pagoRepetido>=1){
                $verificarPago = false;
                $mensajeRespuesta = 'Error en el código de pago';
                $code=1;
            }else{
                $verificarPago = true;
            }

            if($verificarPago){
                $pago->id_estado_revision=3;
                $pago->monto_pago=$request->dato;
                $pago->codigo_pago=$request->codigo_pago;
                $pago->observacion=NULL;

                if($pago->id_tipo_pago==3){

                    $affected = DB::table('pagos')
                    ->where('id_estado_revision', '!=' , 3)
                    ->where('id_tipo_pago', '=' , 2)
                    ->where('user_id', $pago->user_id)
                    ->update([
                            'id_estado' => 0,
                            'id_usuario_revisado' => Auth::user()->id,
                            'fecha_revisado' => date("Y-m-d H:i:s"),
                        ]);
                    $affected2 = DB::table('pagos')
                    ->where('id_estado_revision', '!=' , 3)
                    ->where('id_tipo_pago', '=' , 1)
                    ->where('user_id', $pago->user_id)
                    ->update([
                            'id_estado' => 0,
                            'id_usuario_revisado' => Auth::user()->id,
                            'fecha_revisado' => date("Y-m-d H:i:s"),
                        ]);
                    //if($affected){
                    //   $status="success";
                    //}
                }
                if($pago->id_tipo_pago==1 || $pago->id_tipo_pago==2){

                    $affected = DB::table('pagos')
                    ->where('id_estado_revision', '!=' , 3)
                    ->where('id_tipo_pago', '=' , 3)
                    ->where('user_id', $pago->user_id)
                    ->update([
                            'id_estado' => 0,
                            'id_usuario_revisado' => Auth::user()->id,
                            'fecha_revisado' => date("Y-m-d H:i:s"),
                        ]);
                }

                $pago->id_usuario_revisado=Auth::user()->id;
                $pago->fecha_revisado=date("Y-m-d H:i:s");
                if($pago->save()){
                    $status="success";
                    $success=1;
                }else{
                    $status="false";
                    $success=0;
                }
            }else{
                $status="false";
                $success=0;
            }
        }
        if($request->id_estado_revision==2){
            $pago->id_estado_revision=2;
            $pago->observacion=$request->dato;

            $pago->id_usuario_revisado=Auth::user()->id;
            $pago->fecha_revisado=date("Y-m-d H:i:s");
            if($pago->save()){
                $status="success";
                $success=1;
            }else{
                $status="false";
                $success=0;
            }
        }

        /* if($pago->save()){
            $status="success";
            $success=1;
        }else{
            $status="false";
            $success=0;
        } */

        return response()->json([
            'pago'=>$pago,
            'status'=>$status,
            'success'=>$success,
            'code'=>$code
        ]);
    }

    public function reporte_pagos(Request $request){


        //dd($request->tipo);
        $tipo = isset($request->tipo) ? $request->tipo : null;
        $fecha = isset($request->fecha) ? $request->fecha : null;
        $dato = isset($request->dato) ? $request->dato : null;
        $desde = isset($request->desde) ? $request->desde : null;
        $hasta = isset($request->hasta) ? $request->hasta : null;


        $pago = DB::table('pagos')
        ->join('users', 'pagos.user_id', '=', 'users.id')
        ->leftJoin('fichas', 'pagos.id_ficha', '=', 'fichas.id')
        // ->leftJoin('modalidades', 'fichas.mcp_id_modalidad', '=', 'modalidades.id')
        ->leftJoin('universidades', 'fichas.diep_id_colegio', '=', 'universidades.id')
        ->where('pagos.id_estado', 1)
        ->where('pagos.id_estado_revision', 3)
        //->where('pagos.id_tipo_pago', $tipo)
        ->select('pagos.*', 'users.nombre', 'users.apellido_paterno', 'users.apellido_materno', 'users.email', 'users.numero_documento', 'users.numero_celular', 'universidades.TIPO');
        //->orderBy('id_estado_revision', 'desc')
        //->orderByRaw('FIELD(pagos.id_estado_revision, 1, 3, 2, 0)')
        //$pago=$pago->get();
        if($dato){
            $pago=$pago->Where('users.numero_documento', 'like', '%' . $dato . '%')
            ->orWhere('pagos.codigo_pago', 'like', '%' . $dato . '%');

            /* $pago=$pago->where(function($query, $dato) {
                $query->where('users.numero_documento', 'like', '%' . $dato . '%')
                    ->orWhere('pagos.codigo_pago', 'like', '%' . $dato . '%');
                }); */
        }else if($tipo==1){
            if($fecha){
               $pago=$pago->where(DB::raw("(DATE_FORMAT(pagos.fecha_revisado,'%Y-%m-%d'))"),$fecha);
            }
            if ($desde) {
                $pago=$pago->where(DB::raw("(DATE_FORMAT(pagos.fecha_revisado,'%Y-%m-%d'))"), '>=',$desde);
            }
            if ($hasta) {
                $pago=$pago->where(DB::raw("(DATE_FORMAT(pagos.fecha_revisado,'%Y-%m-%d'))"), '<=',$hasta);
            }
            $pago=$pago->orderBy('pagos.fecha_revisado', 'desc');
        } else {
            if ($fecha) {
                $pago=$pago->where(DB::raw("(DATE_FORMAT(pagos.fecha_pago,'%Y-%m-%d'))"),$fecha);
            }
            if ($desde) {
                $pago=$pago->where(DB::raw("(DATE_FORMAT(pagos.fecha_pago,'%Y-%m-%d'))"), '>=',$desde);
            }
            if ($hasta) {
                $pago=$pago->where(DB::raw("(DATE_FORMAT(pagos.fecha_pago,'%Y-%m-%d'))"), '<=',$hasta);
            }
            $pago = $pago->orderBy('pagos.fecha_pago', 'desc');
        }
        $pago=$pago->get();

        if($pago==null){
            return response()->json(0);
        }else{
            return response()->json($pago);
        }
    }

    public function pago_tarjeta(Request $request){

        $tipoPago=0;
        $prospecto = isset($request->prospecto) ? $request->prospecto : null;
        $rezagado = isset($request->rezagado) ? $request->rezagado : null;
        $modalidad = isset($request->modalidad) ? $request->modalidad : null;
        $gestionColegio = isset($request->gestionColegio) ? $request->gestionColegio : null;
        $token = isset($request->token) ? $request->token : null;

        //DETECTAR TIPO DE PAGO
        if($prospecto && $modalidad){
            $tipoPago=3;
        }elseif ($prospecto && !$modalidad) {
            $tipoPago=1;
        }elseif (!$prospecto && $modalidad) {
            $tipoPago=2;
        }elseif ($rezagado && !$prospecto && !$modalidad){
            $tipoPago=4;
        }

        //VERIFICAR SI EXISTE FICHA
        $existeFicha = DB::table('fichas')
        ->where('user_id', Auth::user()->id)
        ->where('id_estado', 1)
        ->get()->first();
        if($existeFicha){
            $idfichainsc = $existeFicha->id;
        }else{
            $idfichainsc = NULL;
        };

        $montoConComision=0;
        $montoTotalP=0;
        if($request->prospecto) {
            $montoTotalP = 50;
        }
        if ($request->rezagado) {
            $montoTotalP = $montoTotalP + 30;
        }

        if($request->modalidad==1){
            if($request->gestionColegio==1){
                $montoTotalP = $montoTotalP+200;
            }elseif($request->gestionColegio==2){
                $montoTotalP = $montoTotalP+250;
            }
        }elseif($request->modalidad==2){
            if($request->gestionColegio==1){
                $montoTotalP = $montoTotalP+200;
            }elseif($request->gestionColegio==2){
                $montoTotalP = $montoTotalP+250;
            }
        }elseif($request->modalidad==3){
            $montoTotalP = $montoTotalP+500;
        }elseif($request->modalidad==4){
            $montoTotalP = $montoTotalP+300;
        }elseif($request->modalidad==5){
            if($request->gestionColegio==1){
                $montoTotalP = $montoTotalP+200;
            }elseif($request->gestionColegio==2){
                $montoTotalP = $montoTotalP+250;
            }
        }elseif($request->modalidad==6){
            if($request->gestionColegio==1){
                $montoTotalP = $montoTotalP+200;
            }elseif($request->gestionColegio==2){
                $montoTotalP = $montoTotalP+250;
            }
        }elseif($request->modalidad==10){
            $montoTotalP = $montoTotalP+100;
        }

        $montoConComision=$montoTotalP+$montoTotalP*0.045;
        /* if($montoConComision==$request->monto){
        } */

        //VERIFICAR SI EXISTE PAGO DEL MISMO TIPO
        $existePago = DB::table('pagos')
        ->where('user_id', Auth::user()->id)
        ->where('id_tipo_pago', $tipoPago)
        //->where('id_estado_revision', '!=', 3)
        ->get()->first();
        if($existePago && ($existePago->id_estado_revision==3 || $existePago->id_estado_revision==1) && $existePago->id_medio_pago==1){
            exit();
        }elseif($existePago){
            $idfichainsc = $existePago->id;
            $pago = Pago::find($existePago->id);
            $pago->id_medio_pago=2;
            $pago->id_tipo_pago=$tipoPago;
            $pago->tipo_enlace=3;
            $pago->enlace='-';
            $pago->id_estado_revision=2;
            $pago->cuenta_pago=1;
            $pago->monto_pago=$montoTotalP;
            $pago->codigo_pago=null;
            $pago->fecha_pago=null;
            $pago->fecha_enviado=date("Y-m-d H:i:s");
            $pago->token=$token;
            $pago->save();

            $status='success';
            $success=1;
        }else{
            //$idfichainsc = NULL;
            //echo 'no existe';
            $pago = Pago::create([
                'user_id'=>Auth::user()->id,
                'id_medio_pago'=>2,
                'id_tipo_pago'=>$tipoPago,
                'id_ficha'=>$idfichainsc,
                'tipo_enlace'=>3,
                'enlace'=>'-',
                'id_estado_revision'=>2,
                'cuenta_pago'=>1,
                'monto_pago'=>$montoTotalP,
                'fecha_enviado'=>date("Y-m-d H:i:s"),
                //'fecha_pago'=>$request->fecha_pago,
                'token'=>$token,
                //'codigo_pago'=>$request->codigo_pago,
            ]);
            $status='success';
            $success=1;
        };
        return response()->json([
            //'message'=>$mensajeRespuesta,
            'status'=>$status,
            'success'=>$success
        ]);
    }

    public function registrar_pago_tarjeta(Request $request, $id, $documento, $monto, $token){

        /* dd($request);
        exit(); */

        $id = isset($id) ? $id : null;
        $documento = isset($documento) ? $documento : null;
        $correo = isset($request->correo) ? $request->correo : null;
        $monto = isset($monto) ? $monto: null;
        $token = isset($token) ? $token : null;
        $kranswer = isset($request->{"kr-answer"}) ? $request->{"kr-answer"} : null;
        $kranswer = json_decode($kranswer);

        $montoInicial=0;
        //exit();

        $krtransactions = $kranswer->transactions[0];
        //dd($kranswer);
        $codigo_transaccion = $krtransactions->transactionDetails->paymentMethodDetails->legacyTransId;
        $fecha_pagado = $krtransactions->transactionDetails->paymentMethodDetails->legacyTransDate;
        $fecha_pagado = new DateTime($fecha_pagado);
        $fecha_pagado->setTimezone(new DateTimeZone('America/Lima'));
        $fecha_pagado = $fecha_pagado->format('Y-m-d H:i:s');

        $monto_pagado = $krtransactions->transactionDetails->effectiveAmount;
        $monto_pagado= $monto_pagado/100;
        $monto_pagado= number_format($monto_pagado, 2);
        /* if(base64_decode($monto)==$monto_pagado){
            dd('montos_iguales');
        } */

        //echo $fecha_pagado;
        //dd($fecha_pagado);
        //dd($krtransactions->transactionDetails);

        if($id && $documento && $monto && $token){
            $id = base64_decode($id);
            $documento = base64_decode($documento);
            $monto = base64_decode($monto);
            $token = base64_decode($token);


            $montoInicial= ($monto/104.5)*100;
            //echo $monto.'<br>';
            //echo $montoInicial.'<br>';
            $affected = DB::table('pagos')
                ->where('id_estado_revision', '!=' , 3)
                ->where('user_id', $id)
                ->where('token', $token)
                //->where('monto_pago', $montoInicial)
                ->update([
                        'id_estado' => 1,
                        //'id_usuario_revisado' => Auth::user()->id,
                        'codigo_pago'=>$codigo_transaccion,
                        'id_estado_revision' => 3,
                        'fecha_revisado' => $fecha_pagado,
                        'observacion' => $monto_pagado,
                        'fecha_pago' => date("Y-m-d"),
                    ]);
                if($affected){
                    $status="success";
                    //VERIFICAR SI EXISTE PAGO DEL MISMO TIPO
                    $existePago = DB::table('pagos')
                    ->where('user_id', Auth::user()->id)
                    //->where('id_tipo_pago', $tipoPago)
                    ->where('user_id', $id)
                    ->where('token', $token)
                    ->get()->first();
                    if($existePago->id_tipo_pago==3){

                        $affected = DB::table('pagos')
                        ->where('id_estado_revision', '!=' , 3)
                        ->where('id_tipo_pago', '=' , 2)
                        ->where('user_id', $existePago->user_id)
                        ->update([
                                'id_estado' => 0,
                                'id_usuario_revisado' => Auth::user()->id,
                                'fecha_revisado' => date("Y-m-d H:i:s"),
                            ]);
                        $affected2 = DB::table('pagos')
                        ->where('id_estado_revision', '!=' , 3)
                        ->where('id_tipo_pago', '=' , 1)
                        ->where('user_id', $existePago->user_id)
                        ->update([
                                'id_estado' => 0,
                                'id_usuario_revisado' => Auth::user()->id,
                                'fecha_revisado' => date("Y-m-d H:i:s"),
                            ]);
                        //if($affected){
                        //   $status="success";
                        //}
                    }
                    if($existePago->id_tipo_pago==1 || $existePago->id_tipo_pago==2){
                        $affected = DB::table('pagos')
                        ->where('id_estado_revision', '!=' , 3)
                        ->where('id_tipo_pago', '=' , 3)
                        ->where('user_id', $existePago->user_id)
                        ->update([
                                'id_estado' => 0,
                                'id_usuario_revisado' => Auth::user()->id,
                                'fecha_revisado' => date("Y-m-d H:i:s"),
                            ]);
                    }
                    return redirect('pagos?pago=success');
                }else{
                    $status="false";
                    //return redirect('pagos?pago=error');
                }
        }else{
            //return redirect('pagos?pago=error');
        }

    }

}
