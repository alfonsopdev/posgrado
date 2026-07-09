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
</head>
<style>
    th, td{
        border: 1px solid
    }
</style>
<body>
    <div style="text-align:center">
        <h4 style="margin: 0;">REGISTRO DE POSTULANTES DEL EXAMEN @isset($modalidad) {{ $modalidad == 1 ? 'ORDINARIO' : ($modalidad == 2 ? 'EXTRAORDINARIO' : $modalidad) }} @endisset 2026</h4>
        <h4 style="margin: 0;">
            EXAMEN @isset($modalidad) {{ $modalidad == 1 ? 'ORDINARIO' : ($modalidad == 2 ? 'EXTRAORDINARIO' : $modalidad) }} @endisset 2026
        </h4>
        <h4 style="margin: 0;">
            DOMINGO 26 DE ABRIL
        </h4>
        @if($id_aula)
            <h4 style="margin: 0;">
                AULA {{$aula}}
            </h4>
        @else
        <h4 style="margin: 0;">
            LISTADO GENERAL
        </h4>
        @endif
        
    </div>
    <br>
    <div style="">
        <table class="table" style="border-collapse: collapse;font-size: 13px;margin: 0 auto;">
            <thead>
                <tr style="background: rgb(205, 200, 200)">
                    <th scope="col" style="width: 20px; text-align:center">N°</th>
                    <th scope="col" style="width: 65px; text-align:center">CÓDIGO</th>
                    <th scope="col" style="width: 350px">APELLIDOS Y NOMBRES</th>
                    <th scope="col" style="width: 75px; text-align:center">DNI</th>
                    <th scope="col" style="width: 140px; text-align:center">CARRERA</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $postulante)
                    <tr>
                        <th scope="row">{{ $loop->index+1}}</th>
                        <td style="text-align:center">{{$postulante->codigo_p}}</td>
                        <td>{{$postulante->dp_apellido_p.' '.$postulante->dp_apellido_m.' '.$postulante->dp_nombre}}</td>
                        <td style="text-align:center">{{$postulante->numero_documento}}</td>
                        <td style="text-align:center">{{$postulante->nom_corto}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
    
    
      {{-- <h1>{{$data}}</h1> --}}
</body>
</html>
