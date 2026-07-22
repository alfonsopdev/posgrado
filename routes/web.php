<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('api/verificardoc', [App\Http\Controllers\DocumentoController::class, 'verificardocumento']);

//Route::post('api/pago/exitoso', [App\Http\Controllers\PagoController::class, 'registrar_pago_tarjeta']);
Route::post('api/pago/exitoso/{id}/{documento}/{monto}/{token}', [App\Http\Controllers\PagoController::class, 'registrar_pago_tarjeta']);
//Route::match(['get', 'post'],'api/pago/exitoso/{id}/{documento}/{monto}/{token}', [App\Http\Controllers\PagoController::class, 'registrar_pago_tarjeta']);

Route::get('/', function () {
    return redirect()->route('login');;
})->middleware(['auth:sanctum']);

Route::get('/{optional?}', function () {
    return view('app');
})->name('basepath')->middleware([/*'auth:sanctum',*/'verified']);

Route::get('/login/index', function () {
    return view('auth.login3');
})->name('basepath');

Route::get('/inscripcion/carne2', function () {
    return view('carnepdf2');
})->name('basepath');

Route::get('/inscripcion/carne3', [App\Http\Controllers\FichaController::class, 'generar_carnet']);

Route::get('/inscripcion/constanciaingreso', [App\Http\Controllers\FichaController::class, 'generar_constancia_ingreso']);

Route::group(['middleware' => ['auth:sanctum','verified']], function() {

    Route::get('/pagos/prospecto', function () {
        return view('app');
    })->name('basepath');

    Route::get('/pagos/examen', function () {
        return view('app');
    })->name('basepath');

    Route::get('/pagos/ambos', function () {
        return view('app');
    })->name('basepath');

    Route::get('/inscripcion/inscribir', function () {
        return view('app');
    })->name('basepath');

    Route::get('/inscripcion/ficha', function () {
        return view('ficha_inscripcion');
    })->name('basepath');

    Route::get('/inscripcion/dj_ingreso', function () {
        return view('dj_ingreso');
    })->name('basepath');

    Route::get('/inscripcion/carne', function () {
        return view('carnepdf');
    })->name('basepath');

    Route::get('/reporte/pagos', function () {
        return view('app');
    })->name('basepath');

    Route::get('/examen/lista_aula2', function () {
        return view('lista_aula');
    })->name('basepath');

    Route::get('/examen/lista_aula3', function () {
        return view('lista_aula_calidad');
    })->name('basepath');
    // your routes
    // //ruta de asistenciaqrcontroller
    Route::get('/api/datosficha', [App\Http\Controllers\AsistenciaQRController::class, 'datosficha']);
    Route::put('/api/registrarasistencia', [App\Http\Controllers\AsistenciaQRController::class,'registrarasistencia']);


    Route::get('/api/aulas/sinasignar', [App\Http\Controllers\ExamenController::class, 'postulantes_sin_aulas']);
    Route::post('/api/aulas/asignar', [App\Http\Controllers\ExamenController::class, 'asignar_aulas']);
    Route::get('/api/aulas/listar', [App\Http\Controllers\ExamenController::class, 'listar_aulas']);
    Route::get('/api/aulas', [App\Http\Controllers\ExamenController::class, 'aulas_postulantes']);
    Route::get('/examen/lista_general', [App\Http\Controllers\ExamenController::class, 'lista_general']);
    Route::get('/examen/lista_aula', [App\Http\Controllers\ExamenController::class, 'lista_aula']);
    Route::get('/examen/lista_aula_calidad', [App\Http\Controllers\ExamenController::class, 'lista_aula_calidad']);

    //POSTULANTES LISTADO Y ACTUALIZACION DE DATOS
    Route::post('/api/postulantes/actualizar_aula', [App\Http\Controllers\ExamenController::class, 'actualizar_aula_postulante']);
    Route::post('/api/postulantes/actualizar_modalidad', [App\Http\Controllers\ExamenController::class, 'actualizar_modalidad']);

    // Y asegúrate de que la ruta de listar apunte a la función correcta:
    Route::get('/api/postulantes/listar', [App\Http\Controllers\ExamenController::class, 'lista_postulantes']);

    Route::get('api/carreras', [App\Http\Controllers\ReporteGeneralController::class, 'obtenerCarreras']);


    Route::post('api/usuarios/contrasena', [App\Http\Controllers\Admin\UserController::class, 'actulizar_contrasena'])->middleware('role:Administrador|Asesor|Colaborador');
    Route::resource('api/roles', App\Http\Controllers\Admin\RolController::class)->middleware('role:Administrador');
    Route::get('api/usuarios', [App\Http\Controllers\UsuarioController::class, 'index']);
    Route::resource('api/usuarios-roles', App\Http\Controllers\Admin\UserController::class);
    Route::get('api/{usuario}/rol', [App\Http\Controllers\Admin\UserController::class, 'getRol']);


    //NUEVAS RUTAS
    Route::post('api/usuarios-roles/verificar-manual/{id}', [App\Http\Controllers\Admin\UserController::class, 'verificarManual'])->middleware('role:Administrador|Asesor');
    Route::get('api/universidades/todas', [App\Http\Controllers\ColegioController::class, 'obtenerTodas']);
    //GESTION PROCESO
    Route::get('api/procesos-admision/activo', [App\Http\Controllers\ProcesoAdmisionController::class, 'activo'])->middleware('role:Administrador|Comision|Postulante');
    Route::resource('api/procesos-admision', App\Http\Controllers\ProcesoAdmisionController::class)->middleware('role:Administrador|Comision');
    route::post('api/procesos-admision/{proceso}/activar', [App\Http\Controllers\ProcesoAdmisionController::class, 'activar'])->middleware('role:Administrador|Comision');
    Route::post('api/locales/{local}/toggle-estado', [App\Http\Controllers\LocalController::class, 'toggleEstado'])->middleware('role:Administrador|Comision');
    Route::resource('api/locales', App\Http\Controllers\LocalController::class)->except(['destroy'])->parameters(['locales' => 'local'])->middleware('role:Administrador|Comision');
    Route::resource('api/aulas', App\Http\Controllers\AulaController::class)->except(['destroy'])->parameters(['aulas' => 'aula'])->middleware('role:Administrador|Comision');
    Route::post('api/aulas/{aula}/toggle-estado', [App\Http\Controllers\AulaController::class, 'toggleEstado'])->middleware('role:Administrador|Comision');
    Route::resource('api/programas', App\Http\Controllers\ProgramaController::class)->except(['destroy'])->parameters(['programas' => 'programa'])->middleware('role:Administrador|Comision');
    Route::post('api/programas/{programa}/toggle-estado', [App\Http\Controllers\ProgramaController::class, 'toggleEstado'])->middleware('role:Administrador|Comision');
    Route::get('api/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->middleware('role:Administrador|Comision');
    Route::post('api/fichas/{ficha}/anular', [App\Http\Controllers\FichaController::class, 'anular_inscripcion'])->middleware('role:Administrador|Comision');
   
 
    Route::post('api/pagos/tarjeta', [App\Http\Controllers\PagoController::class, 'pago_tarjeta'])->middleware('role:Postulante');
    Route::post('api/pagos/verificar', [App\Http\Controllers\PagoController::class, 'verificar_pago'])->middleware('role:Administrador|Asesor|Colaborador|Tesoreria');
    Route::get('api/pagos/vouchers', [App\Http\Controllers\PagoController::class, 'datos'])->middleware('role:Administrador|Asesor|Colaborador|Tesoreria');
    Route::get('api/pagos/reporte', [App\Http\Controllers\PagoController::class, 'reporte_pagos'])->middleware('role:Tesoreria|Administrador|Comision');
    Route::post('api/pagos/listar', [App\Http\Controllers\PagoController::class, 'listarpagos'])->middleware('role:Administrador|Asesor|Colaborador|Tesoreria');
    Route::resource('api/pagos', App\Http\Controllers\PagoController::class);

    Route::post('/api/pagos/tesoreria/revisar', [App\Http\Controllers\PagoController::class, 'revisar_tesoreria'])->middleware('role:Administrador|Tesoreria');
    Route::put('/api/pagos/tesoreria/comentar', [App\Http\Controllers\PagoController::class, 'tesoreria_comentario'])->middleware('role:Administrador|Tesoreria');

    Route::post('api/fichas/datos', [App\Http\Controllers\FichaController::class, 'update_datos'])->middleware('role:Administrador|Asesor|Colaborador');
    Route::post('api/fichas/colegio', [App\Http\Controllers\FichaController::class, 'update_colegio'])->middleware('role:Administrador|Asesor|Colaborador');
    Route::post('api/fichas/modalidad', [App\Http\Controllers\FichaController::class, 'update_modalidad'])->middleware('role:Administrador|Asesor|Colaborador');
    Route::post('api/fichas/inscribir', [App\Http\Controllers\FichaController::class, 'inscribir'])->middleware('role:Administrador|Asesor|Colaborador');
    Route::get('api/fichas/descarga_carnet', [App\Http\Controllers\FichaController::class, 'descargacarnet'])->middleware('role:Administrador|Asesor|Colaborador');

    Route::get('api/fichas/descarga_constancia_ingreso',[App\Http\Controllers\FichaController::class, 'descargaconstanciaingreso'])->middleware('role:Administrador|Asesor|Colaborador');
    Route::get('api/fichas/lista_asistencia',[App\Http\Controllers\AsistenciaQRController::class, 'listaasistencia'])->middleware('role:Administrador|Asesor|Colaborador');
    Route::get('api/fichas/reporte_asistencia_qr',[App\Http\Controllers\AsistenciaQRController::class, 'reporteasistenciaqr'])->middleware('role:Administrador|Comision|Colaborador');


    Route::get('api/fichas/listar', [App\Http\Controllers\FichaController::class, 'listarfichas'])->middleware('role:Administrador|Asesor|Colaborador');
    Route::post('api/fichas/dj', [App\Http\Controllers\FichaController::class, 'confirmar_dj'])->middleware('role:Postulante');
    Route::post('api/fichas/revision', [App\Http\Controllers\FichaController::class, 'solicitarrevision'])->middleware('role:Postulante');
    Route::post('api/fichas/concarnet', [App\Http\Controllers\FichaController::class, 'conformidad_carnet'])->middleware('role:Postulante');

    Route::resource('api/fichas', App\Http\Controllers\FichaController::class);
    Route::put('api/documentos/foto', [App\Http\Controllers\DocumentoController::class, 'actualizar_foto']);
    Route::post('api/documentos/verificar', [App\Http\Controllers\DocumentoController::class, 'verificar_documento'])->middleware('role:Administrador|Asesor|Colaborador');
    Route::post('api/documentos/listar', [App\Http\Controllers\DocumentoController::class, 'listardocumentos']);
    Route::resource('api/documentos', App\Http\Controllers\DocumentoController::class);

    Route::get('api/departamentos', [App\Http\Controllers\DepartamentoController::class, 'index']);
    Route::get('api/departamentos/{departamento}', [App\Http\Controllers\DepartamentoController::class, 'show']);
    Route::put('api/provincias', [App\Http\Controllers\ProvinciaController::class, 'index']);
    Route::get('api/provincias/{provincia}', [App\Http\Controllers\ProvinciaController::class, 'show']);
    Route::put('api/distritos', [App\Http\Controllers\DistritoController::class, 'index']);
    Route::get('api/distritos/{distrito}', [App\Http\Controllers\DistritoController::class, 'show']);
    Route::put('api/colegios', [App\Http\Controllers\ColegioController::class, 'index']);
    Route::get('api/colegios/{colegio}', [App\Http\Controllers\ColegioController::class, 'show']);

    //REPORTES
    Route::get('api/reporte', [App\Http\Controllers\ReporteGeneralController::class, 'index']);
    Route::get('api/reporte/carrera', [App\Http\Controllers\ReporteGeneralController::class, 'reporte_carrera']);
    Route::get('api/reporte/modalidad', [App\Http\Controllers\ReporteGeneralController::class, 'reporte_modalidad']);
    Route::get('api/reporte/colegios', [App\Http\Controllers\ReporteGeneralController::class, 'reporte_colegios']);
    Route::get('api/reporte/distrito', [App\Http\Controllers\ReporteGeneralController::class, 'reporte_distrito']);
    Route::get('api/reporte/publicidad', [App\Http\Controllers\ReporteGeneralController::class, 'reporte_publicidad']);
    Route::get('api/reporte/fecha', [App\Http\Controllers\ReporteGeneralController::class, 'reporte_fecha']);

        Route::get('/debug-path', function () {
            dd([
                'uri' => request()->getRequestUri(),
                'path' => request()->getPathInfo(),
                'base' => request()->getBaseUrl(),
                'root' => request()->root(),
                'app_url' => config('app.url'),
            ]);
        });

});

/*Route::get('/home', function () {
    // ...
})->middleware(['verified']); */
/* Route::get('/{optional?}', function () {
    return view('app');
})->name('basepath')
  ->where('optional', '.*'); */
/* Route::get('/', function () {
    return view('app');
})->name('basepath'); */

Route::get('test/send-mail', function () {

    $details = [
        'title' => 'Mail from Nicesnippets.com',
        'body' => 'This is a test email using SMTP'
    ];

    Mail::to('cristian.cap9898@gmail.com')->send(new \App\Mail\DemoMail($details));

    dd("Mail Sent Successfully.");
});
Route::post('/mail/subscribe', [App\Http\Controllers\DemoMailController::class, 'subscribe']);

Route::get('/prueba/test', [App\Http\Controllers\PruebaController::class, 'index']);

Route::view('home', 'home')->middleware(['auth', 'verified']);
