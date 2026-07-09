

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Ficha de inscripción</title>
</head>
<style>
    body {
        width: 100%;
        height: 100%;
        margin: 0;
        padding: 0;
        background-color: #FAFAFA;
        font: 12pt "Tahoma";
    }

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
        <div class="page">
            <div class="subpage">
                
                <div style="font-size: 13px; text-align: center; font-family: arial black !important">UNIVERSIDAD NACIONAL DE CAÑETE</div>
                <div style="font-size: 12px; text-align: center;">LEY DE CREACIÓN Nº 29488 <br> FICHA DE INSCRIPCIÓN - ADMISIÓN 2026 I</div><br><br>
                <!--<div>FECHA DE INSCRIPCIÓN &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;CÓDIGO DEL POSTULANTE</div> -->
                <div>FECHA DE INSCRIPCIÓN &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
                <div class="thumbnail">
                    <table width="560" height="31" border="1" style="border: 1px">
                        <tbody>
                            <tr>
                                <th width="200" scope="col" id='fecha'><span id="fecha_ficha"></span></th>
                                <td style="border: 10px"></td>
                                <th width="250" scope="col" style="display: none;">&nbsp;</th>
                            </tr>
                        </tbody>
                    </table>
                    <br>
                    <div><b>1. DATOS PERSONALES</b> <br> APELLIDOS &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;NOMBRES</div>

                    <table width="560" height="31" border="1" style="border: 1px">
                        <tbody>
                            <tr>
                                <th width="200" scope="col" id="apellidos">
                                </th>
                                <th style="border: 10px">&nbsp;</th>
                                <th width="248" id="nombres" scope="col"></th>
                            </tr>
                        </tbody>
                    </table><br>

                    <div>DOCUMENTO DE IDENTIDAD (<?php
                                                    echo '';
                                                    ?>) &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;EDAD&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;FECHA DE NACIMIENTO</div>

                    <table width="560" height="31" border="1" style="border: 1px">
                        <tbody>
                            <tr>
                                <th width="200" id="numero_documento" scope="col">
                                <th>
                                <th style="border: 10px">&nbsp;</th>
                                <th width="85" id="edad" scope="col"></th>
                                <th style="border: 10px">&nbsp;</th>
                                <th width="248" scope="col" id="fecha_nacimiento"></th>
                            </tr>
                        </tbody>
                    </table><br>

                    <div>LUGAR DE NACIMIENTO - <span> <b id="dp_ln_pais" style="font-size: 12px;"></b></span> 
                        <br> DEPARTAMENTO &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;PROVINCIA&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;DISTRITO&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;SEXO&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ESTADO CIVIL</div>

                    <table width="560" height="31" border="1" style="border: 1px">
                        <tbody>
                            <tr>
                                <th width="120" id="dep_nac" scope="col"></th>
                                <th width="120" id="prov_nac" scope="col"></th>
                                <th width="120" id="dis_nac" scope="col"></th>
                                <th width="100" id="genero" scope="col"></th>
                                <th width="100" id="estado_civil" scope="col"></th>
                            </tr>
                        </tbody>
                    </table><br>

                    <div><b>2. DOMICILIO ACTUAL</b> <br> DEPARTAMENTO &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;PROVINCIA&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;DISTRITO&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Jr/Av/Pje/Calle/Mz&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>

                    <table width="560" height="31" border="1" style="border: 1px">
                        <tbody>
                            <tr>
                                <th width="120" id="dep_act" scope="col"></th>
                                <th width="120" id="prov_act" scope="col"></th>
                                <th width="120" id="dis_act" scope="col"></th>
                                <th width="240" id="direccion" scope="col"></th>
                            </tr>
                        </tbody>
                    </table><br>

                    <div>TELEFONO CELULAR &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;TELEFONO FIJO&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;CORREO ELECTRONICO&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>

                    <table width="560" height="31" border="1" style="border: 1px">
                        <tbody>
                            <tr>
                                <th width="190" id="celular" scope="col"></th>
                                <th style="border: 5px">&nbsp;</th>
                                <th width="190" id="fijo" scope="col"></th>
                                <th style="border: 5px">&nbsp;</th>
                                <th width="300" scope="col" id="correo"></th>
                            </tr>
                        </tbody>
                    </table><br>

                    <div><b>3. CONTACTO DE REFERENCIA </b><br> Apellidos y Nombres del Contacto de Referencia &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;N° de Celular&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>

                    <table width="560" height="31" border="1" style="border: 1px">
                        <tbody>
                            <tr>
                                <th width="320" id="nombre_padre" scope="col"></th>
                                <th style="border: 1px">&nbsp;</th>
                                <th width="320" id="nombre_madre" scope="col"></th>
                            </tr>
                        </tbody>
                    </table><br>

                    <div><b>4. DATOS DE LA UNIVERSIDAD DE PROCEDENCIA</b> <br> Nombre de la Universidad &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Año que concluyó sus estudios&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>

                    <table width="560" height="31" border="1" style="border: 1px">
                        <tbody>
                            <tr>
                                <th width="320" id="colegio_postu" scope="col"></th>
                                <th style="border: 5px">&nbsp;</th>
                                <th width="320" id="diep_ace" scope="col"></th>
                            </tr>
                        </tbody>
                    </table><br>

                    <div>Ubicación de la Universidad &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Régimen de la Universidad</div>

                    <table width="560" height="31" border="1" style="border: 1px">
                        <tbody>
                            <tr>
                                <th width="320" id="colegio_ubicacion" scope="col"></th>
                                <th style="border: 5px">&nbsp;</th>
                                <th width="320" id="colegio_gestion" scope="col"></th>
                            </tr>
                        </tbody>
                    </table><br>

                    <div><b>5. PROGRAMA DE ESTUDIO</b> <br> CARRERA PROFESIONAL</div>

                    <table width="560" height="31" border="1" style="border: 1px">
                        <tbody>
                            <tr>
                                <th width="320" id="carrera" scope="col"></th>
                                <!-- <th width="320" id="modalidad" scope="col"></th>
                                <th style="border: 5px">&nbsp;</th> -->
                                
                            </tr>
                        </tbody>
                    </table><br>
                    
                    <!-- <div style="display: block;"><b>6. DECLARACIÓN JURADA</b> <br> Declaro bajo juramento que la información consignada es verdadera.</div>
                    <table width="560" height="150" border="" style="border: 1px; display: block;">
                        <tbody>
                            <tr>
                                <th width="320" scope="col">
                                    <div style="padding-top: 100px">
                                        ___________________________ <br>
                                        Firma del postulante
                                    </div>
                                </th>
                                <td width="230" style="border: 10px"></td>
                                <th width="150" scope="col">
                                    <div style="padding-top: 100px">
                                        ---------------------------<br>
                                        Huella digital <br>
                                        ---------------------------
                                    </div>
                                </th>
                            </tr>
                        </tbody>
                    </table> -->


                </div>

            </div>

        </div>


        <style>
            p {
                font-family: helvica;
            }
        </style>

        <div class="page" style="display: none;">
            <div class="subpage">
                <div style="font-size: 13px; text-align: center; font-family: helvica, arial black !important">UNIVERSIDAD NACIONAL DE CAÑETE</div>
                <div style="font-size: 13px; margin-top: 5px; text-align: center;">LEY DE CREACIÓN Nº 29488</div> <br><br>
                <div style="font-family: arial black , helvica !important; text-align: center; font-size: 16px !important">
                SOLICITUD DE INSCRIPCIÓN
                </div> <br><br>

                <p style="font-size: 12px">
                SEÑOR PRESIDENTE DE LA COMSIÓN ORGANIZADORA DE LA UNIVERSIDAD NACIONAL DE CAÑETE (UNDC):
                </p>
                <br>

                <div style="padding-left: 100px; ">
                <p style="font-size: 13px">
                    Apellidos: <b id="nombres_h2"></b>
                </p>
                <p style="font-size: 13px">
                    Nombres: <b id="apellidos_h2"></b>
                </p>
                </div> <br>

                <p style="font-size: 13px">
                Ante Usted respetuosamente me presento y digo:
                </p>

                <p style="font-size: 13px; text-align: justify;">
                Que, deseando ingresar como <?php echo ""; ?> a la Universidad Nacional de Cañete y reuniendo los requisitos exigidos, solicito se digne disponer se me inscriba como postulante al Concurso de Admisión 2023, en la modalidad de:
                </p>
                <br>
                <p style="font-size: 13px">
                Examen de Admisión extraordinario...............................................( <b id="modalidad_extraordinario_h2"></b> )*
                </p>
                <p style="font-size: 13px">
                Examen de Admisión ordinario.......................................................( <b id="modalidad_ordinario_h2"></b> )*
                </p>
                <br>

                <p style="font-size: 13px; text-align: justify;">
                Para el efecto, acompaño los documentos señalados para el proceso de Admisión, cuya relación se detalla en la ficha documentaria.
                </p>
                <br>
                <br>

                <!-- <p style="font-size: 13px">
                <?php echo '' ?> <b> <?php echo "" ?> </b> de <b> <?php echo ""; ?> </b> del <b> <?php echo ""; ?> </b>
                </p> -->
                <p style="font-size: 13px">
                <b id="h2_distrito"></b>, <b id="h2_dia_hoy"></b> de <b id="h2_mes_actual"></b> del <b id="h2_year_actual"></b>
                </p>

                <table width="560" height="150" border="" style="border: 1px">
                <tbody>
                    <tr>
                    <th width="320" scope="col">
                        <div style="padding-top: 100px" >
                        ___________________________ <br>
                        Firma del postulante <br>
                        <b><span id="h2_firma_tipodoc"></span></b> Nº <b id="h2_firma_numdoc"></b>
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
                <br>

                <p style="font-size: 13px">
                ( * ) Marcar con ( X ) la modalidad a la que postula.
                </p>

            </div>
        </div>

        <div class="page" style="display: none;">
            <div class="subpage">
                <div style="font-size: 13px; text-align: center; font-family: helvica, arial black !important">UNIVERSIDAD NACIONAL DE CAÑETE</div>
                <div style="font-size: 13px; margin-top: 5px; text-align: center;">LEY DE CREACIÓN Nº 29488</div> <br><br>
                <div style="font-size: 25px; text-align: center; font-family: helvica !important">DECLARACIÓN JURADA</div>
                <!-- <p style="font-size: 20px; margin-top: 20px; text-align: center;">Ley Nº 29988</p><br> -->
                <br><br>
                <p id="mayor_datos_h3" style="font-size: 13px">
                    Yo, <b id="nombres_h3"></b> identificado con <b id="nomDocumento"></b> N° <b id="dni_h3"></b> con domicilio en <b id="direccion_h3"></b>, en plenitud de mis facultades físicas y mentales en libre ejercicio de mi ciudadanía y de conformidad con lo dispuesto en la LEY DEL PROCEDIMIENTO ADMINISTRATIVO GENERAL Nº 27444
                </p>
                <p id="menor_datos_h3" style="font-size: 13px">
                    Yo <b id="menor_apoderado_h3"></b>
                    identidicado(a) con DNI Nº <b id="menor_doc_apo"></b>, en calidad de Padre o Apoderado <span id="menor_pronombre_h3" style="font-size: 13px"></span>
                    postulante <b id="menor_nombres_h3"></b>, con <b id="menor_nomDocumento_h3"></b>: <b id="menor_dni_h3"></b> y domicilio en <b id="menor_direccion_h3"></b>, postulante a la escuela profesional <b id="menor_carrera_h3"></b></b>, en plenitud de mis facultades físicas y mentales en libre ejercicio de mi ciudadanía y de conformidad con lo dispuesto en la LEY DEL PROCEDIMIENTO ADMINISTRATIVO GENERAL Nº 27444
                </p>
                <br>

                
                <p id="h3_mayor_declaro_que" style="font-size: 13px"><b>DECLARO BAJO JURAMENTO </b> lo siguiente:</p>
                
                <p id="h3_menor_declaro_que" style="font-size: 13px"><b>DECLARO BAJO JURAMENTO </b> que <span id="h3_menor_pronombre" style="font-size: 13px"></span> menor bajo mi tutela:</p>
                
                <br>
                
                <ul id="h3_mayor_dj">
                    <li style="font-size: 13px;">No tener antecedentes policiales, penales ni judiciales.</li>
                    <li style="font-size: 13px;">Conocer y estar de acuerdo con el Reglamento de Admisión 2023 de la Universidad Nacional de Cañete.</li>
                </ul>
                <ul id="h3_menor_dj">
                    <li style="font-size: 13px;">No tiene antecedentes policiales, penales ni judiciales.</li>
                    <li style="font-size: 13px;">Conoce y está de acuerdo con el Reglamento de Admisión 2023 de la Universidad Nacional de Cañete.</li>
                </ul>



                <p style="font-size: 13px; text-align: justify;">
                Este documento expresa la verdad, por lo que me someto a las responsabilidades a que hubiera lugar en caso de consignar información falsa, por lo que suscribo el presente documento en honor a la verdad.
                </p>
                <br>

                <p style="font-size: 13px">
                <b id="h3_distrito"></b>, <b id="h3_dia_hoy"></b> de <b id="h3_mes_actual"></b> del <b id="h3_year_actual"></b>
                </p>
                <br>
                <br>
                <br>
                <center>
                <table height="150" border="" style="border: 1px;">
                    <tbody>
                    <tr>
                        
                        <th width="320" id="h3_mayor_firma" scope="col">
                            <div style="padding-top: 100px">
                            ___________________________ <br>
                            Firma del postulante <br>
                            <span id="h3_mayor_letradoc"></span> Nº <b id="h3_mayor_firma_dni"></b>
                            </div>
                        </th>
                        
                        <th width="320" id="h3_menor_firma" scope="col">
                            <div style="padding-top: 100px">
                            ___________________________ <br>
                            Firma del apoderado <br>
                            <span id="">DNI</span> Nº <b id="h3_menor_firma_dni"></b>
                            </div>
                        </th>
                        
                    </tr>
                    </tbody>
                </table>
                </center><br><br><br><br><br><br><br>

                <p style="font-size: 13px; text-align: justify;">
                Numeral 34.3 del Art. 34º - del TUO de la Ley 27444. En caso de comprobar fraude o falsedad en la declaración, información o en la documentación presentada por el administrado, la entidad considerará no satisfecha la exigencia respectiva para todos sus efectos, procediendo a declarar la nulidad del acto administrativo sustentado en dicha declaración, información o documento; e imponer a quien haya empleado esa declaración, información o documento una multa en favor de la entidad de entre cinco (5) y diez (10) Unidades Impositivas Tributarias vigentes a la fecha de pago; y, además, si la conducta se adecua a los supuestos previstos en el Título XIX Delitos contra la Fe Pública del Código Penal, ésta deberá ser comunicada al Ministerio Público para que interponga la acción penal correspondiente.
                </p>

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

    window.onload;

    const url = window.location.search;
    const urlParametro = new URLSearchParams(url);
    const parametro = urlParametro.get("i");
    const parametro2 = urlParametro.get("ver");
    //console.log(parametro2)
    var id = decodeid(parametro)
    var ficha = []
    var departamento = []
    var provincia = []
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

    /* fetch('api/departamentos/' + ficha.dp_ln_dep)
        .then((response) => {
            return response.json();

        })
        .then((myJson) => {
            departamento = myJson.departamento
            asignardepartamento()
        }); */
    async function obtenerdepartamento(id){
        let resultado = []
        await fetch('../api/departamentos/' + id)
        .then((response) => {
            return response.json();
        })
        .then((myJson) => {
            resultado = myJson.departamento
        }); 
        return resultado
    }

    async function obtenerprovincia(id){
        let resultado = []
        await fetch('../api/provincias/' + id)
        .then((response) => {
            return response.json();
        })
        .then((myJson) => {
            resultado = myJson.provincia
        }); 
        return resultado
    }

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

    async function obtenercolegio(id){
        let resultado = []
        await fetch('../api/colegios/' + id)
        .then((response) => {
            return response.json();
        })
        .then((myJson) => {
            resultado = myJson.colegio
        }); 
        return resultado
    }
   
    /* async function request(url) {
  const response = await fetch(url);
  if (!response.ok)
    throw new Error("WARN", response.status);
  const data = await response.json();
  return data.ficha;
} */

    //const ficha = await request('../api/fichas/'+id);

    

    //FECHA
    var fecha = document.getElementById('fecha');
    const date = new Date();
    const d = new Date();

    let day = new Intl.DateTimeFormat('en', {
        day: '2-digit'
    }).format(d);
    let month = new Intl.DateTimeFormat('en', {
        month: 'numeric'
    }).format(d);
    let year = new Intl.DateTimeFormat('en', {
        year: 'numeric'
    }).format(d);

    //console.log(`${day} ${month} ${year}`);
    fecha.innerHTML = `${day}-${month}-${year}`;

    //FUNCION PARA ASIGNAR DATOS A LA FICHA
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


        //DATOS PERSONALES

        //FECHA
        

        /* let date = new Date(ficha.created_at)

        let day1 = date.getDate()
        let month1 = date.getMonth() + 1
        let year1 = date.getFullYear()

        if(month < 10){
        console.log(`${day1}-0${month1}-${year1}`)
        }else{
        console.log(`${day1}-${month1}-${year1}`)
        } */

        var fecha_ficha = new Date(ficha.created_at);
        var dd = fecha_ficha.getDate();
        var mm = fecha_ficha.getMonth() + 1;
  
        var yyyy = fecha_ficha.getFullYear();
        if (dd < 10) {
            dd = '0' + dd;
        }
        if (mm < 10) {
            mm = '0' + mm;
        }
        var fecha_ficha1 = dd + '-' + mm + '-' + yyyy;

        document.getElementById('fecha').innerHTML = fecha_ficha1;
        //APELLIDOS
        document.getElementById('apellidos').innerHTML = ficha.dp_apellido_p + ' ' + ficha.dp_apellido_m;

        //NOMBRES
        document.getElementById('nombres').innerHTML = ficha.dp_nombre;

        //DOCUMENTO DE IDENTIDAD
        document.getElementById('numero_documento').innerHTML = ficha.numero_documento;

        //EDAD
        document.getElementById('edad').innerHTML = ficha.dp_edad;

        //FECHA DE NACIMIENTO

        document.getElementById('fecha_nacimiento').innerHTML = ficha.dp_fecha_n;

        document.getElementById('dp_ln_pais').innerHTML = ficha.dp_ln_pais;


        

        //DEPARTAMENTO
        //PROVINCIA
        //DISTRITO

        if(ficha.dp_ln_peru==1){
            var departamento_nacimiento = await obtenerdepartamento(ficha.dp_ln_dep)
            document.getElementById('dep_nac').innerHTML = departamento_nacimiento.departamento;

            var provincia_nacimiento = await obtenerprovincia(ficha.dp_ln_prov)
            document.getElementById('prov_nac').innerHTML = provincia_nacimiento.provincia;

            var distrito_nacimiento = await obtenerdistrito(ficha.dp_ln_dis)
            document.getElementById('dis_nac').innerHTML = distrito_nacimiento.distrito;
        }else{
            document.getElementById('dep_nac').innerHTML = ficha.dp_ln_dep_ext;
            document.getElementById('prov_nac').innerHTML = ficha.dp_ln_pro_ext;
            document.getElementById('dis_nac').innerHTML = ficha.dp_ln_dis_ext;
        }
        
        




        document.getElementById('genero').innerHTML = ficha.dp_sexo;

        document.getElementById('estado_civil').innerHTML = ficha.dp_estado_c;

        var departamento_actual = await obtenerdepartamento(ficha.da_dep)
        document.getElementById('dep_act').innerHTML = departamento_actual.departamento;

        var provincia_actual = await obtenerprovincia(ficha.da_prov)
        document.getElementById('prov_act').innerHTML = provincia_actual.provincia;

        var distrito_actual = await obtenerdistrito(ficha.da_dis)
        document.getElementById('dis_act').innerHTML = distrito_actual.distrito;
        
        //DIRECCION
        document.getElementById('direccion').innerHTML = ficha.da_direccion;

        document.getElementById('celular').innerHTML = ficha.da_numero_celular;

        document.getElementById('fijo').innerHTML = ficha.da_numero_telefono;

        document.getElementById('correo').innerHTML = ficha.da_email;

        document.getElementById('nombre_padre').innerHTML = ficha.df_nombres_apoderado;

        document.getElementById('nombre_madre').innerHTML = ficha.df_celular_apoderado;

        //COLEGIO
        var colegio_postulante = await obtenercolegio(ficha.diep_id_colegio)
        document.getElementById('colegio_postu').innerHTML = colegio_postulante.nombre;

        document.getElementById('colegio_ubicacion').innerHTML = colegio_postulante.provincia+" - "+colegio_postulante.departamento;

        document.getElementById('colegio_gestion').innerHTML = colegio_postulante.tipo;


        //CONCLUYO ESTUDIOS
        document.getElementById('diep_ace').innerHTML = ficha.diep_ace;
        //SEXO

        //ESTADO CIVIL


        // document.getElementById('modalidad').innerHTML = ficha.modalidad;

        document.getElementById('carrera').innerHTML = ficha.carrera;

        //HOJA 2 
        //APELLIDOS
        document.getElementById('apellidos_h2').innerHTML = ficha.dp_apellido_p + ' ' + ficha.dp_apellido_m;

        //NOMBRES
        document.getElementById('nombres_h2').innerHTML = ficha.dp_nombre;

        if(ficha.mcp_id_modalidad==1){
            document.getElementById('modalidad_ordinario_h2').innerHTML = 'X';
        }else{
            document.getElementById('modalidad_extraordinario_h2').innerHTML = 'X';
        }

        if(ficha.id_tipo_documento==2){
            var NombreDocumento = 'C.E'
        }else if(ficha.id_tipo_documento==1){
            var NombreDocumento = 'DNI'
        }

        document.getElementById("h2_distrito").innerHTML = distrito_actual.distrito;

        document.getElementById("h2_dia_hoy").innerHTML = dia_hoy;

        document.getElementById("h2_mes_actual").innerHTML = mes_actual;

        document.getElementById("h2_year_actual").innerHTML = year_actual;

        document.getElementById("h2_firma_tipodoc").innerHTML = NombreDocumento;

        document.getElementById("h2_firma_numdoc").innerHTML = ficha.numero_documento;

        
        document.getElementById("h3_distrito").innerHTML = distrito_actual.distrito;

        document.getElementById("h3_dia_hoy").innerHTML = dia_hoy;

        document.getElementById("h3_mes_actual").innerHTML = mes_actual;

        document.getElementById("h3_year_actual").innerHTML = year_actual;


        if(ficha.dp_edad>17){
            document.getElementById("menor_datos_h3").style.display = "none";

            document.getElementById("nombres_h3").innerHTML = ficha.dp_nombre + ' ' + ficha.dp_apellido_p + ' ' + ficha.dp_apellido_m;

            document.getElementById('nomDocumento').innerHTML = NombreDocumento;

            document.getElementById('dni_h3').innerHTML = ficha.numero_documento;

            document.getElementById('direccion_h3').innerHTML = ficha.da_direccion;

            document.getElementById("h3_menor_declaro_que").style.display = "none";

            document.getElementById("h3_menor_dj").style.display = "none";

            document.getElementById("h3_menor_dj").style.display = "none";

            document.getElementById("h3_menor_firma").style.display = "none";

            document.getElementById('h3_mayor_letradoc').innerHTML = NombreDocumento;

            document.getElementById('h3_mayor_firma_dni').innerHTML = ficha.numero_documento;



        }else{
            document.getElementById("mayor_datos_h3").style.display = "none";

            document.getElementById('menor_apoderado_h3').innerHTML = ficha.df_nombres_apoderado;

            document.getElementById('menor_doc_apo').innerHTML = ficha.df_dni_apoderado;

            document.getElementById('menor_pronombre_h3').innerHTML = d;

            document.getElementById("menor_nombres_h3").innerHTML = ficha.dp_nombre + ' ' + ficha.dp_apellido_p + ' ' + ficha.dp_apellido_m;
            
            document.getElementById('menor_nomDocumento_h3').innerHTML = NombreDocumento;

            document.getElementById('menor_dni_h3').innerHTML = ficha.numero_documento;

            document.getElementById('menor_direccion_h3').innerHTML = ficha.da_direccion + ' - ' + distrito_actual.distrito;

            document.getElementById('menor_carrera_h3').innerHTML = ficha.carrera;
            
            document.getElementById("h3_mayor_declaro_que").style.display = "none";

            document.getElementById('h3_menor_pronombre').innerHTML = a;

            document.getElementById("h3_mayor_dj").style.display = "none";

            document.getElementById("h3_mayor_firma").style.display = "none";

            document.getElementById('h3_menor_firma_dni').innerHTML = ficha.df_dni_apoderado;

        }
        
        //console.log(ficha)
        if(parametro2!='si'){
            window.print();
        }
        

    }

    function asignardepartamento() {
        var dep_nac = document.getElementById('dep_nac');
        dep_nac.innerHTML = departamento.departamento;
    }
    //
</script>