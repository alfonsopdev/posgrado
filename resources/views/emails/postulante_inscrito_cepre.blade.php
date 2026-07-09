@component('mail::message')
# ¡{{$details['nombres']}}, inscripción completada!

Estimado(a) postulante, mediante el presente se confirma que se ha completado su inscripción en el proceso de admisión EPG 2024.

{{-- @component('mail::button', ['url' => ''])
Button Text
@endcomponent --}}

@component ('mail::panel') 
+ N° de documento de identidad: **{{$details['dni']}}**
+ Programa de Estudio: **{{$details['carrera']}}**

@endcomponent

Gracias,<br>
{{ config('app.name') }}
@endcomponent
