<!DOCTYPE html>
<html lang="en">
<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"> -->

<head>
  <meta charset="UTF-8" />
  <meta name="csrf-token" id="csrf-token" content="{{ csrf_token() }}" />
  <title>Carné de postulante</title>
</head>
<style>
  body {
    background: rgb(204, 204, 204);
  }

  page {
    background: white;
    display: block;
    margin: 0 auto;
    margin-bottom: 1cm;

  }

  page[size="A4"][layout="landscape"] {
    width: 29.7cm;
    height: 20cm;
  }

  .page {
    padding: 3mm;
    margin: 3mm auto;
    background: white;

  }

  .izquierda {
    width: 14cm;
    height: 19cm;
    background-color: #F4F1F0;
    float: left;
    border: 3px black solid;
  }

  .derecha {
    width: 14cm;
    height: 19cm;
    background-color: #F4F1F0;
    float: right;
    border: 3px black solid;
  }

  .linea {

    height: 19cm;
    margin-left: 40.5%;
    position: absolute;
    border: 1px dotted red;
    width: 1px;
  }

  img {
    position: absolute;
    margin-left: 48px;
    top: 38px;
  }

  .imgcar {
    position: absolute;
    margin-left: 22px;
    top: 60px;
  }

  .foto {
    margin-left: 25%;
    background-color: #fff;
    position: absolute;
    border: 1px black solid;
    width: 3.5cm;
    height: 4cm;
  }

  .topimg {
    top: 130%;
  }

  .row {
    margin-right: -15px;
    margin-left: -15px;
  }

  .col-md-8 {
    width: 66.66666667%;
  }

  .col-md-4 {
    width: 33.33333333%;
  }

  .col-md-7 {
    width: 58.33333333%;
  }

  .col-lg-5 {
    width: 41.66666667%;
  }

  .col-lg-1,
  .col-lg-10,
  .col-lg-11,
  .col-lg-12,
  .col-lg-2,
  .col-lg-3,
  .col-lg-4,
  .col-lg-5,
  .col-lg-6,
  .col-lg-7,
  .col-lg-8,
  .col-lg-9,
  .col-md-1,
  .col-md-10,
  .col-md-11,
  .col-md-12,
  .col-md-2,
  .col-md-3,
  .col-md-4,
  .col-md-5,
  .col-md-6,
  .col-md-7,
  .col-md-8,
  .col-md-9,
  .col-sm-1,
  .col-sm-10,
  .col-sm-11,
  .col-sm-12,
  .col-sm-2,
  .col-sm-3,
  .col-sm-4,
  .col-sm-5,
  .col-sm-6,
  .col-sm-7,
  .col-sm-8,
  .col-sm-9,
  .col-xs-1,
  .col-xs-10,
  .col-xs-11,
  .col-xs-12,
  .col-xs-2,
  .col-xs-3,
  .col-xs-4,
  .col-xs-5,
  .col-xs-6,
  .col-xs-7,
  .col-xs-8,
  .col-xs-9 {
    position: relative;
    min-height: 1px;
    padding-right: 15px;
    padding-left: 15px;
  }

  .col-md-1,
  .col-md-10,
  .col-md-11,
  .col-md-12,
  .col-md-2,
  .col-md-3,
  .col-md-4,
  .col-md-5,
  .col-md-6,
  .col-md-7,
  .col-md-8,
  .col-md-9 {
    float: left;
  }


  @page {
    size: A4 landscape;

  }

  @media print {

    body,
    page {
      margin: 0 auto;
      box-shadow: 0;
    }

    .linea {
      margin-left: 48.9%;
      border: 0.5px dotted gray;

    }

    .foto {
      margin-left: 31%;

    }

    .topimg {
      top: 105%;
    }

    .salto {
      margin-top: 20px;
    }

  }
</style>
<body>
    <page size="A4" layout="landscape">
        <div class="page">
          <div class="subpage">
            <div class="izquierda">
              <img src="../assets/media/logos/icono.png" width="60" height="69" alt="" style="margin-left: 2px;top: 30px;">
              <div style="font-size: 17px; text-align: center; font-family: arial black; padding-top: 5px">UNIVERSIDAD NACIONAL DE CAÑETE</div>             
              <div style="font-size: 15px; text-align: center; font-family: arial black; padding-top: 5px">ADMISIÓN 2023</div><br>
              <div style="font-size: 18px; text-align: center;"><b>CARNÉ DE POSTULANTE - DECLARACIÓN JURADA 2023</b></div>
    
              <div style="padding: 10px">
                <label for="">LOCAL: <b>CASA DE LA CULTURA</b></label><br>
                <label for="">HORA DE INGRESO: <b>7:30</b></label><br>
                <label for="">CÓDIGO DEL POSTULANTE: <b>230001</b></label><br>
                <label for="">APELLIDO PATERNO: <b>ANCCO</b></label><br>
                <label for="">APELLIDO MATERNO: <b>PALOMINO</b></label><br>
                <label for="">NOMBRES: <b>CRISTIAN</b></label><br>
                <label for="">MODALIDAD: <b>ORDINARIO</b></label><br>
                <label for="">FECHA DE EXAMEN: <b>11 DE MARZO</b></label><br><br>
                <b>DECLARACIÓN JURADA</b>
                <p style="font-size: 11px;font-weight: bold;margin-top:0">
                  - La información consignada al momento de inscribirme es verdadera y de mi entera responsabilidad.
                  <br>
                  - Conozco y acepto todas las disposiciones del Reglamento General de Admisión 2023-I al cual me someto.
                  <br>
                  - En caso de alcanzar una vacante, me comprometo a cumplir con lo dispuesto en los artículos del 
                    Reglamento General de Admisión 2023-I.
                </p>
                <b>DÍA DEL EXAMEN</b>
                <p style="font-size: 11px;font-weight: bold; margin-top:0">
                  - Presentarse con este carné en el local que le corresponda rendir su Examen de Admisión
                  <br>
                  - Portar el DNI original. Los extranjeros presentarán su pasaporte o carné de extranjería.
                  <br>
                  - La firma e impresión dactilar se realizará en el aula asignada.
                </p>
                <br><br><br>
                <div>
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b style="font-size: 16px"> _________________________ </b><br>
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b style="font-size: 16px">FIRMA DEL POSTULANTE</b>
                </div>
                <br><br><br>
                <div>
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b style="font-size: 16px"> _________________________ </b><br>
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b style="font-size: 16px">FIRMA DEL DOCENTE</b>
                </div>
                <!-- <div class="foto"><p style="text-align: center;">FOTO</p></div> -->
                <!-- <div class="row"> -->
                <div style="display: flex;">
                  <div>    
                    <br>
                  </div>
                  <div>
                    <!-- <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolores doloremque sed omnis ullam iste
                      </p> -->
                    {{-- <img width="120px" height="150px" id="image1" src="" style="position: inherit; margin-left: 20px; border: 2px solid #3c3b3b;" /> --}}
                    <img width="120px" height="150px" id="image1" src="" style="margin-left: 350px;margin-top: 115px;border: 2px solid #3c3b3b;">
                    <img width="150px" height="85px" style="margin-left: 350px;margin-top: 400px;border: 2px solid #3c3b3b;">
                    <img width="150px" height="85px" style="margin-left: 350px;margin-top: 505px;border: 2px solid #3c3b3b;">
                    <img width="150px" height="85px" style="margin-left: 350px;margin-top: 610px;border: 2px solid #3c3b3b;">
                  </div>
                  <!-- </div> -->
                </div>
              </div>
                
            </div>
    
            <!-- <div class="linea"> </div> 
              -->
            <div class="derecha">
              <img class="imgcar" src="../assets/media/logos/icono.png" width="75" height="89" alt="">
              <div style="font-size: 15px; text-align: center; font-family: arial black; padding-top: 36px">UNIVERSIDAD NACIONAL DE CAÑETE<br>
                UNDC</div><br>
              <div style="font-size: 20px; text-align: center;"><b>ADMISIÓN 2023 <br> CARNÉ DE POSTULANTE</b></div><br>
    
              <div style="padding: 10px">
                <div>CÓDIGO DE POSTULANTE</div>
                <!-- 
                <div class="foto">
                  <p style="text-align: center;">FOTO</p>
                </div>
    
                <table width="200" height="31" border="1" style="border: 1px">
                  <tbody>
                    <tr>
                      <th scope="col"><?php echo "codigo"; ?></th>
                    </tr>
                  </tbody>
                </table><br>
    
                <div>APELLIDOS Y NOMBRES</div>
    
                <table width="320" height="31" border="1" style="border: 1px;">
                  <tbody>
                    <tr>
                      <th scope="col">Apellidos Paterno:</th>
                      <th scope="col" width="160"><?php echo "apaterno"; ?></th>
                    </tr>
                  </tbody>
                </table><br>
                <table width="320" height="31" border="1" style="border: 1px;">
                  <tbody>
                    <tr>
                      <th scope="col">Apellidos Materno:</th>
                      <th scope="col" width="160"><?php echo "amaterno"; ?></th>
                    </tr>
                  </tbody>
                </table><br> -->
                <div style="display: flex;">
    
                  <div>
                    <table width="200" height="31" border="1" style="border: 1px">
                      <tbody>
                        <tr>
                          <th scope="col"><span id="codigo2"></span></th>
                        </tr>
                      </tbody>
                    </table><br>
    
                    <div>APELLIDOS Y NOMBRES</div>
    
                    <table width="320" height="31" border="1" style="border: 1px;">
                      <tbody>
                        <tr>
                          <th scope="col">Apellidos Paterno:</th>
                          <th scope="col" width="160"><span id="apaterno2"></span></th>
                        </tr>
                      </tbody>
                    </table><br>
                    <table width="320" height="31" border="1" style="border: 1px;">
                      <tbody>
                        <tr>
                          <th scope="col">Apellidos Materno:</th>
                          <th scope="col" width="160"><span id="amaterno2"></span></th>
                        </tr>
                      </tbody>
                    </table><br>
                  </div>
                  <div>
                    <!-- <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolores doloremque sed omnis ullam iste
                      </p> -->
                    <img src="https://posgrado.undc.edu.pe/inscripciones/public/storage/documentos/74381302-14-0205.jpg" width="120px" height="150px" id="image2" style="position: inherit; margin-left: 20px; border: 2px solid #3c3b3b;" />
                  </div>
                  <!-- </div> -->
                </div>
    
                <table width="480" height="31" border="1" style="border: 1px;">
                  <tbody>
                    <tr>
                      <th scope="col">Nombres:</th>
                      <th scope="col" width="320"><span id="nombres2"></span></th>
                    </tr>
                  </tbody>
                </table><br>
    
                <div style="font-size: 20px; text-align: center;">RECOMENDACIONES PARA EL DÍA DEL EXAMEN</div>
    
                <ol style="font-size: 13px; text-align: justify;">
                  <li>
                    Presentarse al lugar asignado, el día del examen.
                  </li>
                  <li>
                    El ingreso de los postulantes solo se realizará de 07:30 a 08:30 horas.
                  </li>
                  <li>
                    Llevar únicamente, <b>Carné de Postulante, lápiz 2B, borrador, tajador y el Documento Nacional de Identidad</b>, en caso de ser extranjero Carné de extranjería o Carné de Identidad en caso de pertenecer a las FF.AA. o Policiales.
                  </li>
                  <!-- <li>
                    El postulante <b>que no lleve los dos cuerpos</b> de su carné de Postulante y declaración Jurada, <b>no podrá rendir el examen.</b>
                  </li> -->
                  <li>
                  Por ningún
                    motivo se permitirá el ingreso de los postulantes que lleguen después de iniciado el examen. <b>Esta prohibido el ingreso al recinto del examen de postulantes portando cuadernos, libros,
                    calculadoras, radio receptor,
                    transmisores, relojes, celulares u otros equipos
                    electrónicos </b>; estos serán confiscados e incautados sin lugar a reclamos por el personal de control del proceso de admisión y se destinarán para fines benéficos o su incineración de ser el caso.
                  </li>
                  <li>
                    El postulante perderá su derecho a participar en el proceso si es suplantado por otra persona o suplanta a un postulante en el examen.
                  </li>
                </ol>
                <p style="font-size: 13px; text-align: right;">
                <span id="distritoa2"></span> <b id="dia_hoy2"></b> de <b id="mes_actual2"></b> del <b id="year_actual2"></b>
              </p>
              </div>
            </div>
          </div>
    
        </div>
    
        </div>
    
      </page>
</body>
</html>