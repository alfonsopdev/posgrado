<!DOCTYPE html>
<html lang="en">
<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"> -->

<head>
  <meta charset="UTF-8" />
  <meta name="csrf-token" id="csrf-token" content="{{ csrf_token() }}" />
  <title>Carné de postulante</title>
</head>
<style>
  @page { margin:0px; }
  body {
    /* background: rgb(204, 204, 204); */
    font-family: sans-serif
  }

  page {
    /* background: white;
    display: block;
    margin: 0 auto;
    margin-bottom: 1cm; */

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
    /* background-color: #F4F1F0; */
    float: left;
    border: 3px black solid;
  }

  .derecha {
    width: 14cm;
    height: 19cm;
    /* background-color: #F4F1F0; */
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
              <img src="{{ public_path('assets/media/logos/icono.png') }}" width="50" height="59" alt="" style="margin-left: 20px;top: 30px;">
              @isset($enlace)
                <img width="120px" height="150px" id="image1" src="{{ public_path('storage/documentos/'.$enlace) }}" style="margin-left: 360px;margin-top: 90px;border: 2px solid #3c3b3b;">
              @endisset
              <div style="font-size: 17px; text-align: center; font-family: arial black; padding-top: 5px"><b>UNIVERSIDAD NACIONAL DE CAÑETE</b></div>             
              <div style="font-size: 15px; text-align: center; font-family: arial black; padding-top: 5px"><b>ADMISIÓN 2023</b></div><br>
              <div style="font-size: 18px; text-align: center;"><b>CARNÉ DE POSTULANTE - DECLARACIÓN JURADA 2023</b></div>
    
              <div style="padding: 10px">
                <label for="">FECHA DE EXAMEN: <b>11 DE MARZO</b></label><br>
                <label for="">HORA DE INGRESO: <b>7:30 AM</b></label><br>
                <label for="">LOCAL: <b>CASA DE LA CULTURA</b></label><br>
                <label for="">AULA: <b>01</b></label><br>
                <label for="">CÓDIGO DEL POSTULANTE: 
                  <b>
                    @isset($codigo_p)
                    {{$codigo_p}}
                    @endisset
                  </b>
                </label><br>
                <label for="">APELLIDO PATERNO: <b>
                  @isset($dp_apellido_p)
                  {{$dp_apellido_p}}
                  @endisset
                </b></label><br>
                <label for="">APELLIDO MATERNO: <b>
                  @isset($dp_apellido_m)
                  {{$dp_apellido_m}}
                  @endisset  
                </b></label><br>
                <label for="">NOMBRES: <b>
                  @isset($dp_nombre)
                  {{$dp_nombre}}
                  @endisset    
                </b></label><br>
                <label for="">MODALIDAD: <b>
                  @isset($modalidad)
                  {{$modalidad}}
                  @endisset 
                </b></label><br>
                <br>
                <b>DECLARACIÓN JURADA</b>
                <p style="font-size: 10px;font-weight: bold;margin-top:0">
                  - La información consignada al momento de inscribirme es verdadera y de mi entera responsabilidad.
                  <br>
                  - Conozco y acepto todas las disposiciones del Reglamento General de Admisión 2023 al cual me someto.
                  <br>
                  - En caso de alcanzar una vacante, me comprometo a cumplir con lo dispuesto en los artículos del 
                    Reglamento General de Admisión 2023.
                </p>
                <b>DÍA DEL EXAMEN</b>
                <p style="font-size: 10px;font-weight: bold; margin-top:0">
                  - Presentarse con este carné en el local que le corresponda rendir su Examen de Admisión
                  <br>
                  - Portar el DNI original. Los extranjeros presentarán su pasaporte o carné de extranjería.
                  <br>
                  - La firma e impresión dactilar se realizará en el aula asignada.
                  <br>
                  - Esta prohibido el ingreso de cuadernos, libros, calculadoras, radio receptor, transmisores, relojes,
                  celulares u otros equipos electrónicos, así mismo prendas como capuchas, gorras; estos serán
                  confiscados e incautados sin lugar a reclamos.
                  <br>
                  - El postulante perderá su derecho a participar en el proceso si es suplantado por otra persona o suplanta
                  a un postulante en el examen.
                </p>
                
                <div style="/* display: flex; */ float: left;">
                  {{-- <div style="width: 120px;float: left;/* margin-left: 120px; */"><div style="width: 50px; height: 55px; margin-left: 5px;margin-top: 5px;border: 2px solid #3c3b3b;"></div></div> --}}
                  <div style="/*margin-left: 30px;*/float: left; display:none">
                    <div width="50px" height="55px" style="width: 50px; height: 55px; margin-left: 5px;margin-top: 5px;border: 2px solid #3c3b3b;"></div>
                  </div>
                  <div style="text-align: center;float: left; margin-left: 115px; /*margin: 0 0 0 155px; */">
                    <br><br><br><br><br><br><br><b style="font-size: 14px"> _________________________ </b><br><b style="font-size: 14px">FIRMA DEL POSTULANTE</b>
                  {{-- <br><br><br><br><b style="font-size: 14px"> _________________________ </b><br><b style="font-size: 14px">FIRMA DEL DOCENTE</b> --}}
                  </div>
                  <div style="margin-left: 330px;float: left;text-align: center;">
                    <div width="85px" height="150px" style="width: 100px; height:130px; margin-left: 38px;border: 2px solid #3c3b3b;"></div>
                    <div><span style="font-size: 12px">ÍNDICE DERECHO</span></div>
                    {{-- <div width="150px" height="85px" style="width: 150px; height: 85px; margin-left: 10px;margin-top: 5px;border: 2px solid #3c3b3b;"></div>
                    <div><span style="font-size: 12px">MEDIO DERECHO</span></div> --}}
                    {{-- <div width="150px" height="85px" style="width: 150px; height: 85px; margin-left: 5px;margin-top: 5px;border: 2px solid #3c3b3b;"></div> --}}
                    <div>
                      <div style="font-size: 10px">
                        (Las impresiones dactilares se colocarán el día del examen en el aula)
                      </div>
                    </div>
                  </div>
                </div>
                
                <div style="display: flex;">
                  <div>    
                    <br>
                  </div>
                  <div>
                    {{-- <img width="120px" height="150px" id="image1" src="{{ public_path('storage/documentos/12345678-14-0210.jpg') }}" style="margin-left: 350px;margin-top: 115px;border: 2px solid #3c3b3b;"> --}}
                  </div>
                </div>
              </div>
            </div>
            
            <div class="derecha">
              <img src="{{ public_path('assets/media/logos/icono.png') }}" width="50" height="59" alt="" style="margin-left: 20px;top: 30px;">
              @isset($enlace)
                <img width="120px" height="150px" id="image1" src="{{ public_path('storage/documentos/'.$enlace) }}" style="margin-left: 360px;margin-top: 90px;border: 2px solid #3c3b3b;">
              @endisset
              <div style="font-size: 17px; text-align: center; font-family: arial black; padding-top: 5px"><b>UNIVERSIDAD NACIONAL DE CAÑETE</b></div>             
              <div style="font-size: 15px; text-align: center; font-family: arial black; padding-top: 5px"><b>ADMISIÓN 2023</b></div><br>
              <div style="font-size: 18px; text-align: center;"><b>CARNÉ DE POSTULANTE - DECLARACIÓN JURADA 2023</b></div>
    
              <div style="padding: 10px">
                <label for="">LOCAL: <b>CASA DE LA CULTURA</b></label><br>
                <label for="">HORA DE INGRESO: <b>7:30 AM</b></label><br>
                <label for="">CÓDIGO DEL POSTULANTE: 
                  <b>
                    @isset($codigo_p)
                    {{$codigo_p}}
                    @endisset
                  </b>
                </label><br>
                <label for="">APELLIDO PATERNO: <b>
                  @isset($dp_apellido_p)
                  {{$dp_apellido_p}}
                  @endisset
                </b></label><br>
                <label for="">APELLIDO MATERNO: <b>
                  @isset($dp_apellido_m)
                  {{$dp_apellido_m}}
                  @endisset  
                </b></label><br>
                <label for="">NOMBRES: <b>
                  @isset($dp_nombre)
                  {{$dp_nombre}}
                  @endisset    
                </b></label><br>
                <label for="">MODALIDAD: <b>
                  @isset($modalidad)
                  {{$modalidad}}
                  @endisset 
                </b></label><br>
                <label for="">FECHA DE EXAMEN: <b>11 DE MARZO</b></label><br><br>
                <b>DECLARACIÓN JURADA</b>
                <p style="font-size: 10px;font-weight: bold;margin-top:0">
                  - La información consignada al momento de inscribirme es verdadera y de mi entera responsabilidad.
                  <br>
                  - Conozco y acepto todas las disposiciones del Reglamento General de Admisión 2023 al cual me someto.
                  <br>
                  - En caso de alcanzar una vacante, me comprometo a cumplir con lo dispuesto en los artículos del 
                    Reglamento General de Admisión 2023.
                </p>
                <b>DÍA DEL EXAMEN</b>
                <p style="font-size: 10px;font-weight: bold; margin-top:0">
                  - Presentarse con este carné en el local que le corresponda rendir su Examen de Admisión
                  <br>
                  - Portar el DNI original. Los extranjeros presentarán su pasaporte o carné de extranjería.
                  <br>
                  - La firma e impresión dactilar se realizará en el aula asignada.
                  <br>
                  - Esta prohibido el ingreso de cuadernos, libros, calculadoras, radio receptor, transmisores, relojes,
                  celulares u otros equipos electrónicos, así mismo prendas como capuchas, gorras; estos serán
                  confiscados e incautados sin lugar a reclamos.
                  <br>
                  - El postulante perderá su derecho a participar en el proceso si es suplantado por otra persona o suplanta
                  a un postulante en el examen.

                </p>
                
                <div style="/* display: flex; */ float: left;">
                  {{-- <div style="width: 120px;float: left;/* margin-left: 120px; */"><div style="width: 50px; height: 55px; margin-left: 5px;margin-top: 5px;border: 2px solid #3c3b3b;"></div></div> --}}
                  <div style="/*margin-left: 30px;*/float: left; display:none">
                    <div width="50px" height="55px" style="width: 50px; height: 55px; margin-left: 5px;margin-top: 5px;border: 2px solid #3c3b3b;"></div>
                  </div>
                  <div style="text-align: center;float: left; margin-left: 115px; /*margin: 0 0 0 155px; */">
                  <br><br><br><br><b style="font-size: 14px"> _________________________ </b><br><b style="font-size: 14px">FIRMA DEL POSTULANTE</b>
                  <br><br><br><br><b style="font-size: 14px"> _________________________ </b><br><b style="font-size: 14px">FIRMA DEL DOCENTE</b>
                  </div>
                  <div style="margin-left: 330px;float: left;text-align: center;">
                    <div width="150px" height="85px" style="width: 150px; height: 85px; margin-left: 10px;margin-top: 5px;border: 2px solid #3c3b3b;"></div>
                    <div><span style="font-size: 12px">ÍNDICE DERECHO</span></div>
                    <div width="150px" height="85px" style="width: 150px; height: 85px; margin-left: 10px;margin-top: 5px;border: 2px solid #3c3b3b;"></div>
                    <div><span style="font-size: 12px">MEDIO DERECHO</span></div>
                    {{-- <div width="150px" height="85px" style="width: 150px; height: 85px; margin-left: 5px;margin-top: 5px;border: 2px solid #3c3b3b;"></div> --}}
                    <div>
                      <div style="font-size: 10px">
                        (Las impresiones dactilares se colocarán el día del examen en el aula)
                      </div>
                    </div>
                  </div>
                </div>
                
                <div style="display: flex;">
                  <div>    
                    <br>
                  </div>
                  <div>
                    {{-- <img width="120px" height="150px" id="image1" src="{{ public_path('storage/documentos/12345678-14-0210.jpg') }}" style="margin-left: 350px;margin-top: 115px;border: 2px solid #3c3b3b;"> --}}
                  </div>
                </div>
              </div>
            </div>
            <div class="vl" style="/* border-left: 2px solid green; height: 500px; */float: right;margin-right: 14px;">
              <div style="border-left: 2px solid black;height: 725px;">
              </div>
            </div>
          </div>
    
        </div>
    
        </div>
    
      </page>
</body>
</html>