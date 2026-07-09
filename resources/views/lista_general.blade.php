<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>
        LISTA 
        @if($modalidad == 1) ORDINARIO @elseif($modalidad == 2) EXTRAORDINARIO @else GENERAL @endif
        @isset($local_id)
            @if($local_id == 1) - CASA DE LA CULTURA @elseif($local_id == 2) - CENTRO DE MUJERES @endif
        @endisset
    </title>
</head>
<style>
    body { font-family: sans-serif; }
    th, td { border: 1px solid #000; padding: 4px; }
    .text-center { text-align: center; }
    .bg-gray { background: rgb(205, 200, 200); }
</style>
<body>
    <div class="text-center">
        <h4 style="margin: 0; text-transform: uppercase;">
            REGISTRO DE POSTULANTES DEL EXAMEN DE ADMISIÓN POSGRADO 2026 - 1            
        </h4>
        <h4 style="margin: 0; text-transform: uppercase;">
            MODALIDAD: 
            @if($modalidad == 1) 
                ORDINARIO 
            @elseif($modalidad == 2) 
                EXTRAORDINARIO 
            @else 
                TODAS LAS MODALIDADES 
            @endif
        </h4>
        <h4 style="margin: 0;">DOMINGO 26 DE ABRIL</h4>

        @if($id_aula)
            <h4 style="margin: 5px 0;">AULA: {{$aula}}</h4>
        @else
            <h4 style="margin: 5px 0; text-transform: uppercase;">
                LISTADO GENERAL 
                @isset($local_id)
                    @if($local_id == 1) - CASA DE LA CULTURA @elseif($local_id == 2) - I.E. 20188 "CENTRO DE MUJERES" @endif
                @endisset
            </h4>
        @endif
    </div>

    <br>

    <table class="table" style="border-collapse: collapse; font-size: 12px; margin: 0 auto; width: 100%;">
        <thead>
            <tr class="bg-gray">
                <th style="width: 5%;" class="text-center">N°</th>
                <th style="width: 10%;" class="text-center">CÓDIGO</th>
                <th style="width: 45%;">APELLIDOS Y NOMBRES</th>
                <th style="width: 12%;" class="text-center">DNI</th>
                <th style="width: 20%;" class="text-center">CARRERA</th>
                <th style="width: 8%;" class="text-center">AULA</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $postulante)
                <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td class="text-center">{{ $postulante->codigo_p }}</td>
                    <td>{{ $postulante->dp_apellido_p }} {{ $postulante->dp_apellido_m }} {{ $postulante->dp_nombre }}</td>
                    <td class="text-center">{{ $postulante->numero_documento }}</td>
                    <td class="text-center">{{ $postulante->nom_corto }}</td>
                    <td class="text-center">{{ $postulante->aula_postulante }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>