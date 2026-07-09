<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>
        @isset($formato)
            @if($formato==1)
                LISTA 
                @isset($id_aula)
                    AULA {{$aula}} - {{$nom_local}}
                @endisset
            @elseif($formato==2)
                F4 
                @isset($id_aula)
                    AULA {{$aula}} - {{$nom_local}}
                @endisset
            @endif
        @endisset
    </title>
    <style>
        /* @page {
        size:29.7cm 21cm ;
        margin: 4em 1em 4em 1em;
        } */
        th, td{
            border: 1px solid
        } 
        footer {
            position: fixed; 
                bottom: -60px; 
                left: 0px; 
                right: 0px;
                height: 80px;
                margin-bottom: 0px 
         }
    </style>
</head>

<body style="font-family: sans-serif;">
    {{-- <header>header on each page</header>--}}
    <footer>
        <div style="margin-left:25px">
           <p style="font-size: 10px; margin: 0"><b>¹Reporte de plataforma de evaluación virtual, en caso aplique la modalidad virtual</b></p>
           <p style="font-size: 10px; margin: 0"><b>²Postulantes que hayan rendido examen de manera presencial</b><b style="font-size: 10px; margin: 0; margin-left:348px">Toda copia de este documento, sea del entorno virtual o del documento</b></p> 
            <p style="font-size: 10px; margin: 0">F-M01.02-AD-004 / Rev. 2 <b style="font-size: 10px; margin: 0; margin-left:608px">original en físico es considerada “copia no controlada</b></p> 
        </div>
        
    </footer> 
    <img src="{{ public_path('assets/media/images/logo_ancho_undc.png') }}" width="232" height="72" alt="" style="margin-left: 0px;top: -20px;position: absolute;">
    <main>
        <div style="text-align:center">
            <div>
                {{-- <div style="margin: 0 auto;width: 400px; height:40px;border: 2px solid #3c3b3b; background-color: rgb(197, 224, 179)">
                    <span style="font-size: 10px; margin: 0;">Código: F-M01.02-AD-004 / Rev. 2</span><br>
                    <span style="font-size: 10px; margin: 0;">Fecha de Aprobación: 15-03-2022</span>
                </div> --}}
                <table style="margin: 0 auto;border-collapse: collapse; background-color: rgb(197, 224, 179)">
                    <thead>
                        <th style="width: 400px; text-align:left">
                            <p style="font-size: 12px; margin: 0;">Código: F-M01.02-AD-004 / Rev. 2</p>
                            <p style="font-size: 12px; margin: 0;">Fecha de Aprobación: 15-03-2022</p>
                        </th>
                        <th style="width: 100px">
                            <p style="font-size: 12px; margin: 0;">Revisión: 02</p>
                        </th>
                    </thead>
                </table>
            </div>
            <br>
            <h2 style="margin: 0;">Asistencia de Postulantes a Examen de Admisión Virtual / Presencial
            </h2>
            <br>
            <div style="">
                <div>
                    <table style="border-collapse: collapse; margin-left:25px">
                        <tbody>
                            <tr>
                                <td colspan="1" style="width: 975px; text-align:left">
                                    <b>PROCESO DE ADMISIÓN:   2024</b>
                                </td>
                                <td style="width: 500px; border:none">

                                </td>
                            </tr>
                            <tr>
                                <td colspan="1" style="width: 975px; text-align:left">
                                    <b>MODALIDAD: EXAMEN DE QUINTO DE SECUNDARIA</b>
                                </td>
                                <td style="width: 500px; border:none">

                                </td>
                                <!-- <td style="width: 500px; border:none; text-align:center">
                                    <b>__________________________</b>
                                </td> -->
                            </tr>
                            <tr>
                                <td colspan="1" style="width: 975px; text-align:left">
                                    <b>LUGAR:   
                                        @isset($nom_local)
                                            {{$nom_local}}
                                        @endisset
                                    </b>
                                </td>
                                <td style="width: 500px; border:none">

                                </td>
                                
                                <!-- <td style="width: 100px; text-align:left">
                                    <b>AULA:   
                                        @if(isset($id_aula))
                                            {{$aula}}
                                        @endif 
                                    </b>
                                </td> -->
                                <!-- <td style="width: 500px; border:none; text-align:center">
                                    <b>FIRMA DEL APLICADOR:</b> 
                                </td> -->
                            </tr>
                            <tr>
                                <td colspan="1" style="width: 975px; text-align:left">
                                    <b>FECHA:   26/11/2023</b>
                                </td>
                                <td style="width: 500px; border:none">

                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                {{-- <div>
                    asdasd
                </div> --}}
                
            </div>
            {{-- @if(isset($id_aula))
                <h4 style="margin: 0;">
                    AULA {{$aula}}
                </h4>
            @else 
                <h4 style="margin: 0;">
                    LISTADO GENERAL
                </h4>
            @endif --}}
            {{-- @isset($id_aula)
                <h4 style="margin: 0;">
                    AULA {{$aula}}
                </h4>
            @else
            @endisset
            <h4 style="margin: 0;">
                LISTADO GENERAL
            </h4>
            @endif --}}
            
        </div>
        <br>
        <div style="">
            
            <table class="table" style="border-collapse: collapse;font-size: 15px;margin: 0 auto;">
                <!-- Encabezado "Aula/Sala" -->
                <tr style="background-color: rgb(197, 224, 179);">
                    <th colspan="7" style="text-align: left;">AULA / SALA: 
                        @if(isset($id_aula))
                        {{$aula}}
                        @endif 
                    </th>
                </tr>
                <thead>
                    <tr style="background-color: rgb(197, 224, 179); height:50px">
                        <th scope="col" style="width: 20px; text-align:center;">N°</th>
                        <th scope="col" style="width: 65px; text-align:center;">Código</th>
                        <th scope="col" style="width: 150px;">Apellido Paterno</th>
                        <th scope="col" style="width: 150px;">Apellido Materno</th>
                        <th scope="col" style="width: 150px;">Nombre(s)</th>
                        <th scope="col" style="width: 140px; text-align:center;">Carrera profesional</th>
                        <th scope="col" style="width: 280px; text-align:center;">Link¹ / Firma y huella²</th>
                        <!-- <th scope="col" style="width: 140px; text-align:center; color: white;">Firma</th>
                        <th scope="col" style="width: 140px; text-align:center; color: white;">Huella</th> -->
                    </tr>
                </thead>
                <tbody>
                    @isset($data)
                        @foreach($data as $postulante)
                            <tr style="height:50px; min-height:50px;">
                                <th scope="row" style="height:50px; min-height 50px;">{{ $loop->index+1}}</th>
                                <td style="text-align:center">{{$postulante->codigo_p}}</td>
                                <td>{{$postulante->dp_apellido_p}}</td>
                                <td>{{$postulante->dp_apellido_m}}</td>
                                <td>{{$postulante->dp_nombre}}</td>
                                <td style="text-align:center">{{$postulante->carrera}}</td>
                                <td style="text-align:center"></td>
                                <!-- <td style="text-align:center"></td> -->
                            </tr>
                        @endforeach
                    @endisset
                    {{-- <tr style="height:35x; min-height:35px;">
                        <th scope="row" style="height:35px; min-height:35px;">1</th>
                        <td style="text-align:center">656515151</td>
                        <td>JOSE MARIA GONZADLES RAMOS</td>
                        <td style="text-align:center">88888888</td>
                        <td style="text-align:center">ADMINSITRACIÓN DE TURMSI Y HOTELERIAS</td>
                        <td style="text-align:center">ADMINISTRACIÓN DE TURISMO Y HOTELERIA</td>
                    </tr>
                     --}}
                </tbody>
            </table>
            <table style="width: 100%; text-align: center;">
                <tr>
                    <td style="width: 1000px; border:none; text-align:center; padding-top: 60px;">
                        <!-- Espacio grande para firma -->
                    </td>
                </tr>
                <tr>
                    <td style="width: 1000px;  border:none; text-align:center">
                        <b>__________________________</b>
                    </td>
                </tr>
                <tr>
                    <td style="width: 500px;  border:none; text-align:center;">
                        <b>Asesor / Apoyo Informático / Aplicador:</b> 
                    </td>
                </tr>
            </table>

        </div>
    </main>
    
    
    
    
      {{-- <h1>{{$data}}</h1> --}}
      
</body>
</html>
