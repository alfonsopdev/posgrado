<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <title>Ficha de inscripción</title>
</head>
<script>
  //window.print();
</script>
<style>
  body {
    width: 100%;
    height: 100%;
    margin: 0;
    padding: 0;
    background-color: #FAFAFA;
    font: 12pt "Tahoma";
  }

  /* * {
    box-sizing: border-box;
    -moz-box-sizing: border-box;
    font-size: 10px;
    font-family: Arial, Verdana, Helvetica, sans-serif;
  } */

  *,
  p {
    box-sizing: border-box;
    -moz-box-sizing: border-box;
    font-size: 10px;
    font-family: Arial, Verdana, Helvetica, sans-serif !important;
  }

  .page {
    width: 210mm;
    min-height: 297mm;
    padding: 19.5mm;
    margin: 10mm auto;
    border: 1px #D3D3D3 solid;
    border-radius: 5px;
    background: white;
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
  }

  .subpage {
    padding: 1cm;
    border: 2px black solid;
    height: 257mm;
    outline: 2cm #F2F7F3 solid;
  }

  b {
    font-size: 14px;
  }

  @page {
    size: A4;
    margin: 0;
  }

  @media print {

    html,
    body {
      width: 210mm;
      height: 297mm;
    }

    .page {
      margin: 0;
      border: initial;
      border-radius: initial;
      width: initial;
      min-height: initial;
      box-shadow: initial;
      background: initial;
      page-break-after: always;
    }

  }
</style>

<body>
  <div class="book">
    <style>
      p {
        font-family: helvica;
      }
    </style>

    <div class="page">
      <div class="subpage">
        <div style="font-size: 25px; text-align: center; font-family: helvica">DECLARACIÓN JURADA DE CUMPLIMIENTO DE
          REQUISITO DEL INGRESANTE A LA UNIVERSIDAD
          NACIONAL DE CAÑETE</div>
        <br>
        <p id="mayor_datos" style="font-size: 13px; text-align: justify;">
            Para tal efecto, Yo <b id="mayor_nombres"></b>
            identificado(a) con <b id="mayor_tipodoc"></b> Nº <b id="mayor_dni"></b> con domicilio en <b id="mayor_direccion"></b>.
        </p>
        <br>

        <p id="menor_datos" style="font-size: 13px; text-align: justify;">
            Para tal efecto, Yo <b id="menor_nom_apo"></b>
            identificado(a) con DNI Nº <b id="menor_dni_apo"></b>, en calidad de Padre o Apoderado <span id="menor_pro_sec" style="font-size: 13px"></span>
            postulante <b id="menor_nombres"></b>, con <b id="menor_tipodoc"></b>: <b id="menor_dni"></b> y domicilio en <b id="menor_direccion"></b>, postulante a la escuela profesional <b id="menor_carrera"></b>.
        </p>
          <br>

          <p id="mayor_declaro_que" style="font-size: 15px; margin-top: 20px;"><b>DECLARO BAJO JURAMENTO </b> lo siguiente:

          <p id="menor_declaro_que" style="font-size: 15px; margin-top: 20px;"><b>DECLARO BAJO JURAMENTO </b> que <span id="menor_pron_decla" style="font-size: 13px"></span> menor bajo mi tutela:

          </p>
          <br>
          
            <p id="mayor_se_compro" style="font-size: 13px; text-align: justify;">
              Me comprometo de adjuntar como ingresante en el Examen de Admisión 2024, los siguientes
              documentos y enviarlos a travez del correo del correo electrónico del dia 13 al 15 de marzo antes de las 6 pm.
              <br>
            <p id="menor_se_compro" style="font-size: 13px; text-align: justify;">
              Se compromete de adjuntar como ingresante en el Examen de Admisión 2024, los siguientes
              documentos y enviarlos a travez del correo del correo electrónico del dia 13 al 15 de marzo antes de las 6 pm.
              <br>
            <ul>
              <li style="font-size: 13px; text-align: justify;">
                Voucher de pago (digital) por el derecho de la constancia de ingreso.
                Depósito en el Banco de la Nación Nº de Cuenta Corriente: 00-57 1028409, por la suma de S/ 50.70
              </li>
              <li style="font-size: 13px; text-align: justify;">
                Certificados de estudios o Constancia de logros de aprendizaje digital, con las
                alificaciones aprobatorias de todos los cursos de Secundaria de la Educación
                Básica Regular (EBR) o Educación Básica Alternativa (EBA) con nombres y
                apellidos de acuerdo a la Partida de Nacimiento y DNI. Los certificados de
                estudios obtenidos en el extranjero deberán estar legalizados por el Consulado del
                país de origen y visados por el Ministerio de Relaciones Exteriores del Perú, convalidados
                por el Ministerio de Educación y, si fuera necesario, traducidos oficialmente.
              </li>
              <li style="font-size: 13px; text-align: justify;">
                Copia del DNI No Legalizada digital vigente y adicionalmente una declaración jurada indicando la veracidad del mismo.
              </li>
            </ul>
            <br>
              <p id="mayor_inclun" style="font-size: 13px; text-align: justify;">
                En caso de incumplimiento del presente compromiso dentro plazo establecido por
                la Universidad, perderé mi vacante de ingresante sin lugar a reclamos.
                En fe de lo cual firmo la presente.
              </p>
            
              <p id="menor_inclun" style="font-size: 13px; text-align: justify;">
                En caso de incumplimiento del presente compromiso dentro plazo establecido por
                la Universidad, <span id="menor_pron_inclu"></span> postulante bajo mi tultela perderá su vacante de ingresante sin lugar a reclamos.
                En fe de lo cual firmo la presente.
              </p>
            </p>
            <br>
            <br>
            <br>

            <p style="font-size: 13px; text-align: justify;">

              <br>
            

            <p style="font-size: 13px; display: none;">
                <b id="h1_distrito"></b>, <b id="h1_dia_hoy"></b> de <b id="h1_mes_actual"></b> del <b id="h1_year_actual"></b>
            </p>

            <center style="display: none;">
              
              <table width="560" height="150" border="" style="border: 1px">
                <tbody>
                  <tr>
                    
                      <th id="mayor_firma" width="320" scope="col">
                        <div style="padding-top: 100px">
                          ___________________________ <br>
                          Firma del postulante <br>
                          <b id="mayor_firm_tipodoc"></b> Nº <b id="mayor_firma_dni"></b>
                        </div>
                      </th>
                    
                      <th id="menor_firma" width="320" scope="col">
                        <div style="padding-top: 100px">
                          ___________________________ <br>
                          Firma del apoderado <br>
                          <b>DNI</b> Nº <b id="menor_dni_apo"></b>
                        </div>
                      </th>
                    <td width="230" style="border: 1px"></td>
                    <th width="150" scope="col">
                      <div style="padding-top: 100px">
                        ---------------------------<br>
                        Huella digital <br>
                        ---------------------------
                      </div>
                    </th>
                  </tr>
                </tbody>
              </table>
            </center><br><br>

            <!-- <p style="font-size: 13px; text-align: justify;">
          Art. 32º - Ley 27444. En caso de comprobarse fraude, falsedad en la declaración o información presentada por el administrado, la entidad considerará no satisfecha la exigencia para todo sus efectos procediendo a comunicar el hecho para que se declare la nulidad del acto administrativo, imponga a quien haya empleado dicha declaración una multa, y de ser el caso comunicar del hecho al ministerio Público para la denuncia correspondiente.
        </p> -->
      </div>
    </div>

  </div>

</body>

</html>
<script>
    function decodeid(id) {
        let codigo = atob(id);
        return codigo;
    }

    const url = window.location.search;
    const urlParametro = new URLSearchParams(url);
    const parametro = urlParametro.get("i");
    const parametro2 = urlParametro.get("ver");
    //console.log(parametro)
    var id = decodeid(parametro)
    var ficha = []
    var distrito = []

    fetch('../api/fichas/' + id)
        //ficha = await response.json();
        .then((response) => {
            return response.json();

        })
        .then((myJson) => {
            ficha = myJson.ficha
            asignardatos()
        });

    async function obtenerdistrito(id){
        let resultado = []
        await fetch('../api/distritos/' + id)
        .then((response) => {
            return response.json();
        })
        .then((myJson) => {
            resultado = myJson.distrito
        }); 
        return resultado
    }

    async function asignardatos() {

        //ficha.dp_edad=15

        if (ficha.dp_sexo == 'MASCULINO') {
        var a = 'el';
        var b = 'alumno';
        var c = 'identificado';
        var d = 'del';
        } else {
        var a = 'la';
        var b = 'alumna';
        var c = 'identificada';
        var d = 'de la';
        }

        const weekday = ["Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sabado"];

        const dia = new Date();
        var dia_hoy = weekday[dia.getDay()];

        var today = new Date();
 
        // `getDate()` devuelve el día del mes (del 1 al 31)
        var dia_hoy = today.getDate();
 


        const month = ["Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"];

        const mes = new Date();
        var mes_actual = month[mes.getMonth()];

        const year = new Date();
        var year_actual = year.getFullYear();

        var distrito_actual = await obtenerdistrito(ficha.da_dis)

        if(ficha.id_tipo_documento==2){
            var NombreDocumento = 'C.E'
        }else if(ficha.id_tipo_documento==1){
            var NombreDocumento = 'DNI'
        }

        if(ficha.dp_edad>17){
            document.getElementById("menor_datos").style.display = "none";
            document.getElementById("mayor_nombres").innerHTML = ficha.dp_nombre + ' ' + ficha.dp_apellido_p + ' ' + ficha.dp_apellido_m;
            //document.getElementById("mayor_pronombre_ide").innerHTML = c;
            document.getElementById("mayor_tipodoc").innerHTML = NombreDocumento;
            document.getElementById("mayor_dni").innerHTML = ficha.numero_documento;
            document.getElementById("mayor_direccion").innerHTML = ficha.da_direccion;

            document.getElementById("menor_declaro_que").style.display = "none";

            document.getElementById("menor_se_compro").style.display = "none";
            document.getElementById("menor_inclun").style.display = "none";

            document.getElementById("menor_firma").style.display = "none";

            document.getElementById("mayor_firm_tipodoc").innerHTML = NombreDocumento;

            document.getElementById("mayor_firma_dni").innerHTML = ficha.numero_documento;

            

        }else{
            document.getElementById("mayor_datos").style.display = "none";
            document.getElementById("menor_nom_apo").innerHTML = ficha.df_nombres_apoderado;
            document.getElementById("menor_dni_apo").innerHTML = ficha.df_dni_apoderado;
            document.getElementById("menor_pro_sec").innerHTML = d;
            document.getElementById("menor_nombres").innerHTML = ficha.dp_nombre + ' ' + ficha.dp_apellido_p + ' ' + ficha.dp_apellido_m;
            document.getElementById("menor_tipodoc").innerHTML = NombreDocumento;

            document.getElementById("menor_dni").innerHTML = ficha.numero_documento;
            document.getElementById("menor_direccion").innerHTML = ficha.da_direccion + ' - ' + distrito_actual.distrito;

            document.getElementById("menor_carrera").innerHTML = ficha.carrera;

            document.getElementById("mayor_declaro_que").style.display = "none";

            document.getElementById("menor_pron_decla").innerHTML = a;

            document.getElementById("mayor_se_compro").style.display = "none";
            document.getElementById("mayor_inclun").style.display = "none";

            document.getElementById("menor_pron_inclu").innerHTML = a;

            document.getElementById("mayor_firma").style.display = "none";


            document.getElementById("menor_dni_apo").innerHTML = ficha.df_dni_apoderado;
            

        }

        document.getElementById("h1_distrito").innerHTML = distrito_actual.distrito;

        document.getElementById("h1_dia_hoy").innerHTML = dia_hoy;

        document.getElementById("h1_mes_actual").innerHTML = mes_actual;

        document.getElementById("h1_year_actual").innerHTML = year_actual;

        //console.log(ficha)
        if(parametro2!='si'){
            window.print();
        }
    }
    

</script>