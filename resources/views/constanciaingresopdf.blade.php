<!DOCTYPE html>
<html>

<head>
  <title>Constancia de Ingreso</title>
  <style>
    /* Estilos para el tamaño del papel A4 */
    @page {
      size: A4;
      margin: 0cm;
    }

    /* Estilos para los márgenes */
    body {
      margin-top: 1cm;
      margin-bottom: 1cm;
      margin-left: 3cm;
      margin-right: 3cm;
    }

    /* Estilos para el logo */
    .logo {
      float: left;
      /* Alinear la imagen a la izquierda */
      margin-right: 10px;
      /* Espacio entre la imagen y el texto */
      width: 3cm;
      height: 3cm;
    }

    /* Estilos para los textos */
    .header-text {
      font-size: 14pt;
      font-weight: bold;
      text-align: center;
      line-height: 1;
      margin-bottom: 1pt;
      /* Espaciado entre líneas */
    }

    .small-text {
      font-size: 9pt;
      font-style: italic;
      text-align: center;
      margin-bottom: 1pt;
      /* Espaciado entre líneas */
    }

    .sub-header {
      font-size: 10pt;
      text-align: center;
      margin-bottom: 1pt;
      /* Espaciado entre líneas */
    }

    /* Estilos para el título "CONSTANCIA DE INGRESO" */
    .title {
      font-size: 20pt;
      font-weight: bold;
      text-align: center;
      margin-top: 2cm;
      margin-bottom: 1cm;
    }

    /* Estilos para el párrafo*/
    .paragraph {
      font-size: 12pt;
      text-align: justify;
      line-height: 1.15;
      margin-bottom: 1.15em;
    }

    /* Estilos para el nombre del postulante */
    .datopostulante {
      font-size: 12pt;
      font-weight: bold;
      text-align: center;
    }

    /* Estilos para la firma */
    .firma-container {
      text-align: center;
      /* Centra horizontalmente */
      margin-top: 2cm;
      margin-bottom: 1cm;
    }

    .firma {
      width: 20px;
      /* Ancho de la firma */
      height: auto;
      /* Altura ajustada automáticamente */
    }

    /* Estilo para unir 2 textos */
    .text-together {
      display: flex;
      justify-content: space-between;
    }

    /* Estilo para texto a la izquierda */
    .left {
      float: left;
    }

    /* Estilos para texto a la derecha */
    .right {
      float: right; 
    }
  </style>
</head>

<body>
  <img src="{{ public_path('assets/media/logos/icono.png') }}" width="45" height="56" alt="Logo de la Universidad"
    class="logo">
  <div>
    <div class="header-text">UNIVERSIDAD NACIONAL DE CAÑETE</div>
    <div class="small-text">Ley de Creación Nº 29488</div>
    <div class="small-text">Modificatoria de la Ley de Creación Ley Nº 30515</div>
    <div class="sub-header">VICEPRESIDENCIA ACADÉMICA</div>
    <div class="sub-header">COMISIÓN DE ADMISIÓN EPG 2024</div>
  </div>
  <!-- Título "CONSTANCIA DE INGRESO" -->
  <div class="title">CONSTANCIA DE INGRESO</div>
  <!-- Párrafo -->
  <p class="paragraph">
    La Comisión de Admisión EPG UNDC 2024, de conformidad con lo establecido en el Estatuto de la Universidad Nacional de
    Cañete y habiéndose cumplido con los requisitos estipulados en el Reglamento General de Admisión EPG 2024 y en mérito al
    puntaje alcanzado, expide la presente<b> CONSTANCIA DE INGRESO </b> a don (ña):
  </p>
  <!-- Nombre del postulante -->
  <p class="datopostulante">
    <!-- Apellido Paterno -->
    @isset($dp_apellido_p)
    {{$dp_apellido_p}}
    @endisset
    <!-- Apellido Materno -->
    @isset($dp_apellido_m)
    {{$dp_apellido_m}}
    @endisset
    ,
    <!-- Nombres -->
    @isset($dp_nombre)
    {{$dp_nombre}}
    @endisset
  </p>
  <p class="paragraph">
    Con Código:
    <b>
      <!-- Código Postulante -->
      @isset($codigo_p)
      {{$codigo_p}}
      @endisset
    </b>
  </p>
  <p class="paragraph">
    Quien ha ocupado vacante en la Carrera Profesional de:
  </p>
  <p class="datopostulante">
    <!-- Carrera de Postulante-->
    @isset($carrera)
    {{$carrera}}
    @endisset
  </p>
  <p class="paragraph">
    Por la modalidad de Examen de Admisión:
  </p>
  <p class="datopostulante">
    <!-- Modalidad de Examen -->
    @isset($modalidad)
    {{$modalidad}}
    @endisset
  </p>
  <div class="text-together">
    <div class="left">
      Con el Orden de Mérito:
      <b>
        <!-- Orden de Mérito del Postulante -->
        @isset($omc)
        {{$omc}}
        @endisset
      </b>
    </div>
    <div class="right">
      Puntaje Alcanzado:
      <b>
        <!-- Puntaje Alcanzado por el Postulante -->
        @isset($puntaje)
        {{$puntaje}}
        @endisset
      </b>
    </div>
  </div>
  <p></p>
  <p class="paragraph">
    En el Proceso de Admisión 2024.
  </p>
  <p class="paragraph">
    Estando habilitado para iniciar sus estudios en el Semestre 2024 -1; Sede Académica Casa de la Cultura - San Vicente
    de Cañete.
  </p>
  <!-- Fecha -->
  <p class="right">
    San Vicente de Cañete, 21 de Febrero de 2024
  </p>
  <p></p>
  <div class="firma-container">
    <img src="ruta_a_tu_imagen/firma.png" alt="Firma" class="firma">
  </div>
  <!-- Datos de la Firma del Presidente de la Comisión de Admisión -->
  <div style="text-align: center">
    <div>
      <br><b> _______________________________ </b><br>
    </div>
    <div>
      Dr Carlos Alcides Almidon Ortiz
    </div>
    <div>
      Presidente de la Comisión
    </div>
    <div>
      de Admisión EPG UNDC 2024
    </div>
  </div>
</body>

</html>