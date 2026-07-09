<?php

namespace App\Http\Controllers;

use App\Models\Ficha;
use App\Http\Requests\StoreFichaRequest;
use App\Http\Requests\UpdateFichaRequest;
use App\Mail\PostulanteInscrito;
use App\Mail\PostulanteInscritoCepre;
use App\Models\Documento;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use PDF;

class FichaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ficha = DB::table('fichas')
            ->join('colegios', 'fichas.diep_id_colegio', '=', 'colegios.ID_COLEGIO')
            ->select('fichas.*', 'colegios.GESTION as gestion_colegio', 'colegios.D_GESTION as gestion_colegio_nom')
            ->where('user_id', Auth::user()->id)
            ->where('id_estado', 1)
            ->orderBy('postulacion', 'desc')
            ->limit(1)
            ->get();
        if ($ficha == null) {
            return response()->json(0);
        } else {
            return response()->json($ficha);
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
     * @param  \App\Http\Requests\StoreFichaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /* $request->validate([
            'apellidoPaterno'=>['required', 'max:50'],
            'apellidoMaterno'=>['required', 'max:50'],

            'nombres'=>['required', 'max:50'],
            'edad'=>['required', 'integer', 'max:50'],

            'email'=>['required', 'email', 'unique:users'],
            'password'=>['required', 'min:6', 'confirmed'],
        ]); */
        //dd(Auth::user());

        //
        $extemporaneo = 0;
        //DESCOMENTAR EN EXTEMPORANEO - ASIGNARÁ UN VALOR DE EXTEMPORANEO A LA FICHA -> "1" 
        /* if($request->postulacion==2){
            $extemporaneo = 0;
        }else{
            $extemporaneo = 1;
        } */

        //VERIFICAR SI EXISTE FICHA
        $existeFicha = DB::table('fichas')
            ->where('user_id', Auth::user()->id)
            ->where('postulacion', $request->postulacion)
            ->where('id_estado', 1)
            ->get()->first();
        if ($existeFicha) {
            //$idfichainsc = $existeFicha->id;
            $status = 'false';
            $success = 0;
        } else {
            //DETECTAR TIPO DE EXAMEN
            if ($request->carrera == 1 || $request->carrera == 2 || $request->carrera == 3) {
                $mcp_tipo = 1;
            } elseif ($request->carrera == 4 || $request->carrera == 5) {
                $mcp_tipo = 2;
            }
            //$idfichainsc = NULL;
            $ficha = Ficha::create([
                'user_id' => Auth::user()->id,

                'dp_apellido_p' => mb_strtoupper($this->limpiar_datos($request->apellidoPaterno)),
                'dp_apellido_m' => mb_strtoupper($this->limpiar_datos($request->apellidoMaterno)),
                'dp_nombre' => mb_strtoupper($this->limpiar_datos($request->nombres)),
                'id_tipo_documento' => Auth::user()->id_tipo_documento,
                'numero_documento' => Auth::user()->numero_documento,
                'dp_edad' => $request->edad,
                'dp_fecha_n' => $request->fechaNacimiento,
                'dp_ln_peru' => $request->nacimientoPeru,
                'dp_ln_pais' => mb_strtoupper($this->limpiar_datos($request->paisNacimiento)),
                'dp_ln_dep' => $request->depNacimiento,
                'dp_ln_prov' => $request->provNacimiento,
                'dp_ln_dis' => $request->disNacimiento,

                'dp_ln_dep_ext' => mb_strtoupper($this->limpiar_datos($request->depNacimientoExt)),
                'dp_ln_prov_ext' => mb_strtoupper($this->limpiar_datos($request->provNacimientoExt)),
                'dp_ln_dis_ext' => mb_strtoupper($this->limpiar_datos($request->disNacimientoExt)),

                'dp_sexo' => $request->sexo,
                'dp_estado_c' => $request->estadoCivil,
                'da_direccion' => mb_strtoupper($this->limpiar_datos($request->direccion)),
                'da_dep' => $request->depActual,
                'da_prov' => $request->provActual,
                'da_dis' => $request->disActual,
                'da_numero_celular' => $request->telefonoCelular,
                'da_numero_telefono' => $request->telefonoFijo,
                'da_email' => Auth::user()->email,
                //'df_nombres_padre'=>mb_strtoupper($this->limpiar_datos($request->datosPadre)),
                //'df_nombres_madre'=>mb_strtoupper($this->limpiar_datos($request->datosMadre)),
                'df_nombres_apoderado' => mb_strtoupper($this->limpiar_datos($request->datosApoderado)),
                'df_dni_apoderado' => $request->dniApoderado,
                'df_celular_apoderado' => $request->celularApoderado,
                'diep_id_colegio' => $request->colegio,
                'diep_ace' => $request->fechaConcluyoIE,
                'de_cod_ruv' => mb_strtoupper($this->limpiar_datos($request->codigo_ruv)),
                'de_nom_uni' => mb_strtoupper($this->limpiar_datos($request->universidad)),
                'de_cred_uni' => $request->creditos,
                // 'mcp_id_modalidad'=>$request->modalidad,
                'mcp_id_carrera' => $request->carrera,
                'mcp_tipo' => $mcp_tipo,
                'dd_publicidad' => $request->entero,
                'postulacion' => $request->postulacion,
                'extemporaneo' => $extemporaneo
            ]);
            $id_ficha_new = $ficha->id;
            //echo $id_ficha_new;
            //dd($ficha);
            // if($request->modalidad==1 || $request->modalidad==11){
            //     for ($i=3; $i <= 4; $i++) { 
            //         $documento = Documento::create([
            //             'tipo_documento_id'=>$i,
            //             'ficha_id'=>$id_ficha_new,
            //         ]);
            //     }
            // }elseif($request->modalidad==8){
            //     for ($i=2; $i <= 3; $i++) { 
            //         $documento = Documento::create([
            //             'tipo_documento_id'=>$i,
            //             'ficha_id'=>$id_ficha_new,
            //         ]);
            //     }
            // }else{
            //     for ($i=2; $i <= 4; $i++) { 
            //         $documento = Documento::create([
            //             'tipo_documento_id'=>$i,
            //             'ficha_id'=>$id_ficha_new,
            //         ]);
            //     }
            // }
            for ($i = 2; $i <= 4; $i++) {
                if ($i != 3) {
                    $documento = Documento::create([
                        'tipo_documento_id' => $i,
                        'ficha_id' => $id_ficha_new,
                    ]);
                }
            }


            $affected = DB::table('pagos as p')
                ->join('fichas as f', 'p.user_id', '=', 'f.user_id')
                ->where('p.user_id', Auth::user()->id)
                ->where('f.id_estado', 1)
                ->whereNull('p.id_ficha')
                ->update([
                    'p.id_ficha' => $ficha->id,
                ]);

            $status = 'success';
            $success = 1;
        };


        //exit;


        return response()->json([
            //'ficha'=>$ficha,
            'success' => $success,
            'status' => $status
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ficha  $ficha
     * @return \Illuminate\Http\Response
     */
    /* public function show(Ficha $ficha)
    {
        return response()->json([
            'ficha'=>$ficha
        ]);
    } */
    public function show($id)
    {
        $ficha = DB::table('fichas')
            // ->join('modalidades', 'fichas.mcp_id_modalidad', '=', 'modalidades.id')
            ->join('carreras', 'fichas.mcp_id_carrera', '=', 'carreras.id')
            // ->select('fichas.*', 'modalidades.modalidad', 'carreras.carrera')
            ->select('fichas.*', "carreras.carrera")
            ->where('fichas.id', $id)
            ->where('id_estado', 1)
            ->get();
        if ($ficha == null) {
            return response()->json(0);
        } else {
            return response()->json(['ficha' => $ficha->first()]);
        }
    }
    public function ver($id)
    {
        $ficha = DB::table('fichas')
            // ->join('modalidades', 'fichas.mcp_id_modalidad', '=', 'modalidades.id')
            ->join('carreras', 'fichas.mcp_id_carrera', '=', 'carreras.id')
            ->leftJoin('aulas', 'fichas.id_aula', '=', 'aulas.id')
            ->leftJoin('locales', 'aulas.local_id', '=', 'locales.id')
            ->select(
                'fichas.*',
                // 'modalidades.modalidad', 
                'carreras.carrera',
                'aulas.aula',
                'locales.local',
                'locales.direccion'
            )
            ->where('fichas.id', $id)
            ->where('fichas.id_estado', 1)
            ->get();
        if ($ficha == null) {
            return response()->json(0);
        } else {
            return response()->json(['ficha' => $ficha->first()]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ficha  $ficha
     * @return \Illuminate\Http\Response
     */
    public function edit(Ficha $ficha)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateFichaRequest  $request
     * @param  \App\Models\Ficha  $ficha
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFichaRequest $request, Ficha $ficha)
    {
        //
    }

    public function update_datos(Request $request)
    {
        $ficha = Ficha::find($request->id);
        $ficha->dp_apellido_p = mb_strtoupper($request->dp_apellido_p);
        $ficha->dp_apellido_m = mb_strtoupper($request->dp_apellido_m);
        $ficha->dp_nombre = mb_strtoupper($request->dp_nombre);
        $ficha->id_tipo_documento = $request->id_tipo_documento;
        $ficha->numero_documento = $request->numero_documento;
        $ficha->dp_edad = $request->dp_edad;
        $ficha->dp_fecha_n = $request->dp_fecha_n;
        $ficha->dp_ln_peru = $request->dp_ln_peru;
        $ficha->dp_ln_pais = $request->dp_ln_pais;
        $ficha->dp_ln_dep = $request->dp_ln_dep;
        $ficha->dp_ln_prov = $request->dp_ln_prov;
        $ficha->dp_ln_dis = $request->dp_ln_dis;
        $ficha->dp_ln_dep_ext = mb_strtoupper($request->dp_ln_dep_ext);
        $ficha->dp_ln_prov_ext = mb_strtoupper($request->dp_ln_prov_ext);
        $ficha->dp_ln_dis_ext = mb_strtoupper($request->dp_ln_dis_ext);
        $ficha->dp_sexo = mb_strtoupper($request->dp_sexo);
        $ficha->dp_estado_c = mb_strtoupper($request->dp_estado_c);
        $ficha->da_direccion = mb_strtoupper($request->da_direccion);
        $ficha->da_dep = $request->da_dep;
        $ficha->da_prov = $request->da_prov;
        $ficha->da_dis = $request->da_dis;
        $ficha->da_numero_celular = $request->da_numero_celular;
        $ficha->da_numero_telefono = $request->da_numero_telefono;
        $ficha->da_email = mb_strtolower($request->da_email);
        $ficha->df_nombres_apoderado = mb_strtoupper($request->df_nombres_apoderado);
        $ficha->df_dni_apoderado = $request->df_dni_apoderado;
        $ficha->df_celular_apoderado = $request->df_celular_apoderado;
        $ficha->diep_id_colegio = $request->diep_id_colegio;
        $ficha->diep_ace = $request->diep_ace;
        $ficha->extemporaneo = $request->extemporaneo;
        $ficha->save();
        if ($ficha->getChanges()) {
            $changes = $ficha->getChanges();
            $status = "success";
            $success = 1;
        } else {
            $changes = 0;
            $status = "false";
            $success = 0;
        };
        return response()->json([
            'status' => $status,
            'success' => $success,
            'changes' => $changes
        ]);
    }
    public function update_colegio(Request $request)
    {
        $ficha = Ficha::find($request->id);
        $ficha->diep_id_colegio = $request->diep_id_colegio;
        $ficha->save();
        if ($ficha->getChanges()) {
            $changes = $ficha->getChanges();
            $status = "success";
            $success = 1;
        } else {
            $changes = 0;
            $status = "false";
            $success = 0;
        };
        return response()->json([
            'status' => $status,
            'success' => $success,
            'changes' => $changes
        ]);
    }
    public function update_modalidad(Request $request)
    {
        $ficha = Ficha::find($request->id);
        $ficha->mcp_id_modalidad = $request->mcp_id_modalidad;
        $ficha->mcp_id_carrera = $request->mcp_id_carrera;
        $ficha->de_nom_uni = mb_strtoupper($request->de_nom_uni);
        $ficha->de_cred_uni = $request->de_cred_uni;
        $ficha->de_cod_ruv = mb_strtoupper($request->de_cod_ruv);
        $ficha->save();
        if ($ficha->getChanges()) {
            $changes = $ficha->getChanges();
            $status = "success";
            $success = 1;
        } else {
            $changes = 0;
            $status = "false";
            $success = 0;
        };
        return response()->json([
            'status' => $status,
            'success' => $success,
            'changes' => $changes
        ]);
    }
    public function listarfichas(Request $request)
    {
        // $modalidad = isset($request->modalidad) ? $request->modalidad : null;
        $carrera = isset($request->carrera) ? $request->carrera : null;
        $estado = isset($request->estado) ? $request->estado : null;
        $dato = isset($request->dato) ? $request->dato : null;

        $ficha = DB::table('fichas')
            ->join('carreras', 'fichas.mcp_id_carrera', '=', 'carreras.id')
            ->join('universidades', 'fichas.diep_id_colegio', '=', 'universidades.id')
            ->join('documentos', 'fichas.id', '=', 'documentos.ficha_id')
            ->join('users', 'fichas.user_id', '=', 'users.id')
            ->select(
                'fichas.*',
                'carreras.carrera',
                DB::raw('concat(fichas.dp_apellido_p, " ",fichas.dp_apellido_m) as apellidos'),
                DB::raw('concat(universidades.nombre, " - ",universidades.tipo) as universidades_tipo'),
                DB::raw('count(IF(documentos.id_estado_revision=0,1,NULL)) as estado_sin_enviar'),
                DB::raw('count(IF(documentos.id_estado_revision=1,1,NULL)) as estado_pendiente'),
                DB::raw('count(IF(documentos.id_estado_revision=2,1,NULL)) as estado_rechazado'),
                DB::raw('count(IF(documentos.id_estado_revision=3,1,NULL)) as estado_validado'),
                'users.created_at as usuario_registro'
            )
            ->where('fichas.id_estado', 1)
            ->where('documentos.id_estado', 1);
        if ($dato) {
            $ficha = $ficha->where(function ($query) use ($dato) {
                $query->Where('fichas.numero_documento', 'like', '%' . $dato . '%');
                $query->orWhere(DB::raw('concat(fichas.dp_apellido_p, " ",fichas.dp_apellido_m," ", fichas.dp_nombre)'), 'like', '%' . $dato . '%');
            });
        }
        // if($modalidad){
        //     $ficha=$ficha->where('fichas.mcp_id_modalidad', $modalidad);
        // }
        if ($carrera) {
            $ficha = $ficha->where('fichas.mcp_id_carrera', $carrera);
        }
        if (is_numeric($estado)) {
            $ficha = $ficha->where('fichas.id_estado_revision', $estado);
        }

        $ficha = $ficha->groupBy('fichas.id')
            ->orderByRaw('FIELD(fichas.id_estado_revision, 1, 2, 3, 0), fichas.fecha_solicitado DESC, fichas.created_at DESC');
        $ficha = $ficha->get();

        if ($ficha == null) {
            return response()->json(0);
        } else {
            return response()->json($ficha);
        }
    }
    public function inscribir(Request $request)
    {
        $success = false;
        $status = null;
        try {

            //NUMERO BASE
            $fecha = date("Y-m-d H:i:s");
            $base = 261001;
            $codigo = '';

            //Fecha carnet
            $fecha_carne = strtotime('+2 day', strtotime($fecha));
            $fecha_carne = date('Y-m-d H:i:s', $fecha_carne);

            $request->validate([
                'id_usu' => ['required'],
                // 'id_modalidad'=>['required'],
                'id_ficha' => ['required'],
                'estado' => ['required'],
                'email' => ['required'],
                'dni' => ['required'],
                'nombres' => ['required'],
                'apellidos' => ['required'],
                'carrera' => ['required'],
                // 'modalidad'=>['required'],
            ]);
            if ($request->id_carrera == 1) {
                $aula_asignada_new = 4;
            }
            if ($request->id_carrera == 2) {
                $aula_asignada_new = 5;
            }
            if ($request->id_carrera == 3) {
                $aula_asignada_new = 6;
            }
            // return $request;
            if ($request->estado == 3) {
                $inscritos = DB::table('fichas')
                    ->whereNotNull('codigo_p')
                    ->Where('codigo_p', 'like', '26%')
                    ->count();
                $codigo = $base + $inscritos;
                if ($request->id_modalidad == 8) {
                    $codigo = '';
                    $affected = DB::table('fichas')
                        ->where('id_estado_revision', '!=', 3)
                        ->where('id', $request->id_ficha)
                        ->where('user_id', $request->id_usu)
                        ->whereNull('codigo_p')
                        ->update([
                            'id_usu_revisado' => Auth::user()->id,
                            'id_estado_revision' => $request->estado,
                            'fecha_revisado' => $fecha,
                            'estado_postulante' => 'INSCRITO',
                            'id_aula' => $aula_asignada_new
                        ]);
                    if ($affected) {
                        $status = "success";
                        $success = true;
                    } else {
                        $status = "false";
                        $success = false;
                    }
                } else {
                    $affected = DB::table('fichas')
                        ->where('id_estado_revision', '!=', 3)
                        ->where('id', $request->id_ficha)
                        ->where('user_id', $request->id_usu)
                        ->whereNull('codigo_p')
                        ->update([
                            'id_usu_revisado' => Auth::user()->id,
                            'id_estado_revision' => $request->estado,
                            'codigo_p' => $codigo,
                            'fecha_carne' => $fecha_carne,
                            'fecha_revisado' => $fecha,
                            'estado_postulante' => 'INSCRITO',
                            'id_aula' => $aula_asignada_new
                        ]);
                    if ($affected) {
                        $status = "success";
                        $success = true;
                    } else {
                        $status = "false";
                        $success = false;
                    }
                }
            } else {
                $affected = DB::table('fichas')
                    ->where('id_estado_revision', '!=', 3)
                    ->where('id', $request->id_ficha)
                    ->where('user_id', $request->id_usu)
                    ->whereNull('codigo_p')
                    ->update([
                        'id_usu_revisado' => Auth::user()->id,
                        'id_estado_revision' => 2,
                        'fecha_revisado' => $fecha,
                    ]);
                if ($affected) {
                    $status = "success";
                    $success = true;
                } else {
                    $status = "false";
                    $success = false;
                }
            }
            if ($status == "success" && $request->estado == 3) {
                $details = [
                    'nombres' => $request->nombres,
                    'email' => $request->email,
                    'codigo' => $codigo,
                    'dni' => $request->dni,
                    'carrera' => $request->carrera,
                    'modalidad' => $request->modalidad,
                ];
                if ($request->id_modalidad == 8) {
                    Mail::to($request->email)->send(new PostulanteInscritoCepre($details));
                } else {
                    Mail::to($request->email)->send(new PostulanteInscrito($details));
                }

                $status = "success";
                $success = true;
            }
            return response()->json([
                'status' => $status,
                'success' => $success,
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => $th->getMessage(),
                'success' => $success,
            ]);
        }
    }

    public function confirmar_dj(Request $request)
    {
        $fecha = date("Y-m-d H:i:s");
        $affected = DB::table('fichas')
            ->where('id_estado_revision', '!=', 3)
            ->where('id', $request->id_ficha)
            ->whereNull('codigo_p')
            ->update([
                'dj_todos' => 1,
                'dj_ficha_inscripcion' => $request->dj_ficha_inscripcion,
                'dj_apologia_t' => $request->dj_apologia_t,
                'dj_reglamento' => $request->dj_reglamento,
                'dj_ingresante' => $request->dj_ingresante,


                'dj_fecha' => $fecha,
            ]);
        if ($affected) {
            $status = "success";
            $success = true;
        } else {
            $status = "false";
            $success = false;
        }
        return response()->json([
            'status' => $status,
            'success' => $success,
        ]);
    }

    public function solicitarrevision(Request $request)
    {
        $fecha = date("Y-m-d H:i:s");
        $affected = DB::table('fichas')
            ->where('id_estado_revision', '!=', 3)
            ->where('id', $request->id_ficha)
            ->whereNull('codigo_p')
            ->update([
                'id_estado_revision' => 1,
                'fecha_solicitado' => $fecha,
            ]);
        if ($affected) {
            $status = "success";
            $success = true;
        } else {
            $status = "false";
            $success = false;
        }
        return response()->json([
            'status' => $status,
            'success' => $success,
        ]);
    }

    public function conformidad_carnet(Request $request)
    {
        $fecha = date("Y-m-d H:i:s");
        $affected = DB::table('fichas')
            ->where('id_estado_revision', '=', 3)
            ->where('id', $request->id_ficha)
            ->whereNotNull('codigo_p')
            ->update([
                'confor_carnet' => 1,
                'fecha_confor_carne' => $fecha,
            ]);
        if ($affected) {
            $status = "success";
            $success = true;
        } else {
            $status = "false";
            $success = false;
        }
        return response()->json([
            'status' => $status,
            'success' => $success,
        ]);
    }

    public function generar_carnet(Request $request)
    {
        /* $qrcode = base64_encode(QrCode::format('svg')->size(200)->errorCorrection('H')->generate('string')); */
        /* $qrcode = QrCode::generate('Welcome to Makitweb'); */
        //$url = 'https://posgrado.undc.edu.pe/inscripciones/public/inscripcion/carne3?token='.$request->token;
        $url = 'https://posgrado.undc.edu.pe/carne_postulante.php?token=' . $request->token;
        $qrcode = base64_encode(QrCode::format('svg')->size(95)->errorCorrection('H')->generate($url));
        $token = isset($request->token) ? $request->token : null;
        $download = isset($request->token) ? $request->download : null;
        $id_ficha = base64_decode($token);

        $resultado = $this->ver($id_ficha);
        $resultado = $resultado->getData('ficha');
        // if( $resultado['ficha']['mcp_id_modalidad']==8 || $resultado['ficha']['id_aula']==null){
        // //if($resultado['ficha']['mcp_id_modalidad']==1 || $resultado['ficha']['mcp_id_modalidad']==8){
        //     exit();
        // }
        if ($download && $download = "si") {
            $fecha = date("Y-m-d H:i:s");
            $affected = DB::table('fichas')
                ->where('id_estado_revision', '=', 3)
                ->where('id', $id_ficha)
                ->where('confor_carnet', 0)
                ->whereNotNull('codigo_p')
                ->update([
                    'confor_carnet' => 1,
                    'fecha_confor_carne' => $fecha,
                ]);
        }
        $documento = DB::table('documentos')
            ->select('documentos.enlace')
            ->where('documentos.tipo_documento_id', 4)
            ->where('documentos.id_estado', 1)
            ->where('documentos.ficha_id', $id_ficha)
            ->get();
        $documento = $documento->first();
        $resultado['ficha']['enlace'] = $documento->enlace;
        $resultado['ficha']['qr'] = $qrcode;

        $pdf = PDF::loadView('carnepdf2',  $resultado['ficha'])->setPaper('a4', 'landscape');
        if ($download && $download = "si") {
            return $pdf->download('carne_postulante.pdf');
        } else {
            return $pdf->stream('carne_postulante.pdf');
        }
    }
    public function descargacarnet(Request $request)
    {
        $modalidad = isset($request->modalidad) ? $request->modalidad : null;
        $carrera = isset($request->carrera) ? $request->carrera : null;
        $estado = isset($request->estado) ? $request->estado : null;
        $dato = isset($request->dato) ? $request->dato : null;
        $ficha = DB::table('fichas')
            // ->join('modalidades', 'fichas.mcp_id_modalidad', '=', 'modalidades.id')
            ->join('carreras', 'fichas.mcp_id_carrera', '=', 'carreras.id')
            ->join('users', 'fichas.user_id', '=', 'users.id')
            ->join('aulas', 'fichas.id_aula', '=', 'aulas.id')
            ->join('locales', 'aulas.local_id', '=', 'locales.id')
            ->select(
                'fichas.*',
                // 'modalidades.modalidad',
                'carreras.carrera',
                DB::raw('concat(fichas.dp_apellido_p, " ",fichas.dp_apellido_m) as apellidos'),
                'users.created_at as usuario_registro',
                'aulas.id_examen',
                'aulas.aula',
                'aulas.local_id',
                'locales.local',
            )
            ->where('fichas.id_estado', 1)
            ->whereNotNull('fichas.id_aula');
        if ($dato) {
            $ficha = $ficha->where(function ($query) use ($dato) {
                $query->Where('fichas.numero_documento', 'like', '%' . $dato . '%');
                $query->orWhere(DB::raw('concat(fichas.dp_apellido_p, " ",fichas.dp_apellido_m," ", fichas.dp_nombre)'), 'like', '%' . $dato . '%');
                $query->orWhere('fichas.codigo_p', 'like', '%' . $dato . '%');
            });
        }
        // if($modalidad){
        //     $ficha=$ficha->where('fichas.mcp_id_modalidad', $modalidad);
        // }
        if ($carrera) {
            $ficha = $ficha->where('fichas.mcp_id_carrera', $carrera);
        }
        if (is_numeric($estado)) {
            $ficha = $ficha->where('fichas.confor_carnet', $estado);
        }
        $ficha = $ficha->groupBy('fichas.id')
            ->orderByRaw('FIELD(fichas.id_estado_revision, 1, 2, 3, 0), fichas.fecha_solicitado DESC, fichas.created_at DESC');
        $ficha = $ficha->get();

        if ($ficha == null) {
            return response()->json(0);
        } else {
            return response()->json($ficha);
        }
    }
    //funcion condición de ingreso de postulante
    public function generar_constancia_ingreso(Request $request)
    {
        $url = 'https://posgrado.undc.edu.pe/inscripciones/public/inscripcion/constanciaingreso?token=' . $request->token;
        $qrcode = base64_encode(QrCode::format('svg')->size(95)->errorCorrection('H')->generate($url));
        $token = isset($request->token) ? $request->token : null;
        $download = isset($request->token) ? $request->download : null;
        $id_ficha = base64_decode($token);

        $resultado = $this->ver($id_ficha);
        $resultado = $resultado->getData('ficha');
        if ($resultado['ficha']['mcp_id_modalidad'] == 8 || $resultado['ficha']['id_aula'] == null) {
            //if($resultado['ficha']['mcp_id_modalidad']==1 || $resultado['ficha']['mcp_id_modalidad']==8){
            exit();
        }
        if ($download && $download = "si") {
            $fecha = date("Y-m-d H:i:s");
            $affected = DB::table('fichas')
                ->where('id_estado_revision', '=', 3)
                ->where('id', $id_ficha)
                ->where('confor_carnet', 0)
                ->whereNotNull('codigo_p')
                ->update([
                    'confor_carnet' => 1,
                    'fecha_confor_carne' => $fecha,
                ]);
        }
        $documento = DB::table('documentos')
            ->select('documentos.enlace')
            ->where('documentos.tipo_documento_id', 4)
            ->where('documentos.id_estado', 1)
            ->where('documentos.ficha_id', $id_ficha)
            ->get();
        $documento = $documento->first();
        $resultado['ficha']['enlace'] = $documento->enlace;
        $resultado['ficha']['qr'] = $qrcode;
        $nombre = DB::table('fichas')
            ->join('carreras', 'fichas.mcp_id_carrera', 'carreras.id')
            ->select('carreras.nombre_corto', 'fichas.dp_apellido_p', 'fichas.dp_apellido_m', 'fichas.dp_nombre')
            ->where('fichas.id', $id_ficha)
            ->first();
        $nombreArchivo = $nombre->nombre_corto . ' 2024 - ' . $nombre->dp_apellido_p . ' ' . $nombre->dp_apellido_m . ' ' . $nombre->dp_nombre . ' Constancia Ingreso.pdf';

        $pdf = PDF::loadView('constanciaingresopdf',  $resultado['ficha'])->setPaper('a4', 'landscape');
        if ($download && $download = "si") {
            return $pdf->download($nombreArchivo);
        } else {
            return $pdf->stream($nombreArchivo);
        }
    }

    public function descargaconstanciaingreso(Request $request)
    {
        // $modalidad = isset($request->modalidad) ? $request->modalidad : null;
        $carrera = isset($request->carrera) ? $request->carrera : null;
        $condicion = isset($request->condicion) ? $request->condicion : null;
        $dato = isset($request->dato) ? $request->dato : null;
        $ficha = DB::table('fichas')
            // ->join('modalidades', 'fichas.mcp_id_modalidad', '=', 'modalidades.id')
            ->join('carreras', 'fichas.mcp_id_carrera', '=', 'carreras.id')
            ->join('users', 'fichas.user_id', '=', 'users.id')
            ->join('aulas', 'fichas.id_aula', '=', 'aulas.id')
            ->join('locales', 'aulas.local_id', '=', 'locales.id')
            ->select(
                'fichas.*',
                // 'modalidades.modalidad',
                'carreras.carrera',
                DB::raw('concat(fichas.dp_apellido_p, " ",fichas.dp_apellido_m) as apellidos'),
                'users.created_at as usuario_registro',
                'aulas.id_examen',
                'aulas.aula',
                'aulas.local_id',
                'locales.local',
            )
            ->where('fichas.id_estado', 1)
            ->whereNotNull('fichas.id_aula');
        if ($dato) {
            $ficha = $ficha->where(function ($query) use ($dato) {
                $query->Where('fichas.numero_documento', 'like', '%' . $dato . '%');
                $query->orWhere(DB::raw('concat(fichas.dp_apellido_p, " ",fichas.dp_apellido_m," ", fichas.dp_nombre)'), 'like', '%' . $dato . '%');
                $query->orWhere('fichas.codigo_p', 'like', '%' . $dato . '%');
            });
        }
        // if($modalidad){
        //     $ficha=$ficha->where('fichas.mcp_id_modalidad', $modalidad);
        // }
        if ($carrera) {
            $ficha = $ficha->where('fichas.mcp_id_carrera', $carrera);
        }
        if ($condicion) {
            $ficha = $ficha->where('fichas.condicion', $condicion);
        }
        $ficha = $ficha->groupBy('fichas.id')
            // ->orderByRaw('FIELD(fichas.id_estado_revision, 1, 2, 3, 0), fichas.fecha_solicitado DESC, fichas.created_at DESC');
            ->orderByRaw('fichas.condicion ASC');
        $ficha = $ficha->get();

        if ($ficha == null) {
            return response()->json(0);
        } else {
            return response()->json($ficha);
        }
    }

    function limpiar_datos($cadena)
    {
        $no_permitidas = array("á", "é", "í", "ó", "ú", "Á", "É", "Í", "Ó", "Ú", "À", "Ã", "Ì", "Ò", "Ù", "Ã™", "Ã ", "Ã¨", "Ã¬", "Ã²", "Ã¹", "ç", "Ç", "Ã¢", "ê", "Ã®", "Ã´", "Ã»", "Ã‚", "ÃŠ", "ÃŽ", "Ã”", "Ã›", "ü", "Ã¶", "Ã–", "Ã¯", "Ã¤", "«", "Ò", "Ã", "Ã„", "Ã‹");
        $permitidas = array("a", "e", "i", "o", "u", "A", "E", "I", "O", "U", "N", "A", "E", "I", "O", "U", "a", "e", "i", "o", "u", "c", "C", "a", "e", "i", "o", "u", "A", "E", "I", "O", "U", "u", "o", "O", "i", "a", "e", "U", "I", "A", "E");
        $texto = str_replace($no_permitidas, $permitidas, $cadena);
        return preg_replace("/\s+/", " ", trim($texto));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ficha  $ficha
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ficha $ficha)
    {
        //
    }
}
