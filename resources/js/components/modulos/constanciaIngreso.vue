<template>
    <div class="card mb-5 mb-xl-8">
		<div class="card-header border-0 pt-5">
			<h3 class="card-title align-items-start flex-column">
				<span class="card-label fw-bold fs-3 mb-1">Constancia de Ingreso</span>
				<span class="text-muted mt-1 fw-semibold fs-7">Constancia de ingresantes</span>
			</h3>
		</div>
		<div class="card-body py-3">
            <div class="input-group mb-5" style="display: block">
                <div class="row">
                    <!-- Filtro de busqueda por Carreras  -->
                    <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                        <label>
                            Carreras
                        </label>
                        <select class="form-select" @change="buscar(1)" aria-label="Select example" v-model.number="filtros.carrera">
                            <option value="">TODOS</option>
                            <option value="1">
                                Maestría en Gestión Pública
                            </option>
                            <option value="2">
                                Maestría en Docencia Superior e Investigación
                            </option>
                        </select> 
                    </div>
                    <!-- Filtro de busqueda de Modalidades  -->
                    <!-- <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                        <label>
                            Modalidades
                        </label>
                        <select class="form-select" @change="buscar(1)" aria-label="Select example" v-model.number="filtros.modalidad">
                            <option value="">TODOS</option>
                            <option value="1">Ordinario</option>
                            <option value="2">
                                Primeros Puestos
                            </option>
                            <option value="3">
                                Graduados y Titulados
                            </option>
                            <option value="10">
                                Traslado Interno
                            </option>
                            <option value="4">
                                Traslado Externo
                            </option>
                            <option value="5">
                                Ley 29973 Personas con Discapacidad
                            </option>
                            <option value="6">
                                Ley 28036 Deportitas Calificados
                            </option>
                            <option value="7">
                                Ley 27277 Victimas del Terrorismo
                            </option>
                            <option value="8">
                                Centro PRE (Ingresantes).
                            </option>
                            <option value="11">Quinto de Secundaria</option>
                        </select> 
                    </div> -->
                    <!-- Filtro de busqueda por DNI o código -->
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>
                            Buscar
                        </label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" v-on:keyup.enter="buscar(2)" placeholder="Buscar por nombres o DNI o código" v-model="filtros.dato" aria-describedby="button-addon2">
                            <button class="btn btn-primary"  @click.prevent="buscar(2)" type="button" id="button-addon2">Buscar</button>
                        </div>
                    </div>
                    <!-- Filtro por Condición  -->
                    <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                        <label>
                            Condición
                        </label>
                        <select class="form-select" @change="buscar(1)" aria-label="Select example" v-model="filtros.condicion">
                            <option value="">TODOS</option>
                            <option value="INGRESO">INGRESÓ</option> 
                            <option value="COBERTURA">COBERTURA</option>
                            <option value="NO INGRESO">NO INGRESÓ</option> 
                            <option value="AUSENTE">AUSENTE</option>
                        </select> 
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                        <label>
                            RESETEAR
                        </label> 
                        <div class="m-demo-icon__preview">
                            <i @click="buscar(0)" class="bi bi-arrow-repeat fs-3x"></i>
                        </div>
                    </div>
                </div>
            </div>
            <!--begin::Table container-->
            <div class="table-responsive">
                <!--begin::Table-->
                <table class="table align-middle gs-0 gy-4">
                        <!--begin::Table head-->
                        <thead>
                            <tr class="fw-bold text-muted bg-light">
                                <th class="ps-4 rounded-start">N°</th>
                                <!-- <th>Modalidad</th> -->
                                <th>CARRERA</th>
                                <th>CODIGO</th>
                                <th>DNI</th>
                                <th>APELLIDOS</th>
                                <th>NOMBRES</th>
                                <th>CELULAR</th>
                                <th>CONDICION</th>                                
                                <th class="text-center rounded-end" style="width: 200px;">ACCION</th>
                            </tr>
                        </thead>
                        <!--end::Table head-->
                        <!--begin::Table body-->
                        <tbody>
                            <tr v-if="botonCargando">
                                <td colspan="12" class="text-center">
                                    <div class="spinner-border text-primary" role="status">
                                        <span class="sr-only">Loading...</span>
                                    </div>
                                </td>
                            </tr>
                            <tr v-else v-for="(dato, index) in datos" :index="index" :key="dato.id"> 
                                <td class="ps-4">
                                   {{index+1}} 
                                </td>
                                <!-- <td>
                                    {{dato.modalidad}}
                                </td> -->
                                <td>
                                    {{dato.carrera}}
                                </td>
                                <td>
                                    {{dato.codigo_p}}
                                </td>
                                <td>
                                    {{dato.numero_documento}}
                                </td>
                                <td>
                                    {{dato.apellidos}}
                                </td>
                                <td>
                                    {{dato.dp_nombre}}
                                </td>
                                
                                <td>
                                    <a v-if="dato.condicion" :href="'https://wa.me/51' + dato.da_numero_celular" target="_blank">
                                    <i class="bi bi-whatsapp text-success"></i>
                                    {{dato.da_numero_celular}}
                                    </a>
                                    <a v-else :href="'https://api.whatsapp.com/send?phone=51'+dato.da_numero_celular+'&text=%F0%9F%93%8C%20*EXAMEN%20ORDINARIO%20-%2011%20DE%20MARZO*%0A%0ALos%20postulantes%20inscritos%20al%20*Examen%20Ordinario*%20ya%20pueden%20*descargar%20su%20carnet%20de%20postulante*%20ingresando%20al%20sistema%3A%20https%3A%2F%2Fposgrado.undc.edu.pe%2Finscripciones.%0AOpci%C3%B3n%20%22Carn%C3%A9%20de%20postulante%22%0A%F0%9F%93%9D%20En%20su%20carnet%20de%20postulante%20se%20indica%20*la%20sede*%20y%20*el%20n%C3%BAmero%20de%20aula*%20donde%20rendir%C3%A1n%20su%20examen%20de%20admisi%C3%B3n.%0A%0A*%C2%A1Es%20requisito%20indispensable%20traer%20el%20d%C3%ADa%20del%20examen%20su%20carnet%20de%20postulante%20impreso(tama%C3%B1o%20A4)%20a%20full%20color%20y%20su%20DNI!*%0A%0A%20%20%20%20%20%20%20%20%20%E2%9A%A0%20En%20caso%20tu%20DNI%20se%20encuentre%20*vencido*%20debes%20traer%20tu%20DNI%20vencido%20junto%20al%20ticket%20que%20te%20otorgo%20la%20RENIEC.%0A%20%20%20%20%20%20%20%20%20%E2%9A%A0%20En%20caso%20tu%20DNI%20se%20encuentre%20*extraviado*%20debes%20traer%20tu%20ficha%20C4%2C%20lo%20puedes%20pedir%20en%20la%20RENIEC.%0A%0A%F0%9F%93%84%20Toda%20la%20dem%C3%A1s%20informaci%C3%B3n%20la%20encuentra%20en%20el%20prospecto%20de%20admisi%C3%B3n%20desde%20el%20*art%C3%ADculo%2042*%20(informaci%C3%B3n%20sobre%20la%20hora%20de%20ingreso%2C%20la%20vestimenta%2C%20accesorios%20no%20permitidos%2C%C2%A0etc%C2%A0).'" target="_blank">
                                    <i class="bi bi-whatsapp text-success"></i>
                                    {{dato.df_celular_apoderado}}
                                    </a>                                    
                                </td>
                                
                                <td>
                                    {{dato.condicion}}
                                </td>
                                <td class="text-center" v-if="dato.condicion == 'INGRESO'||dato.condicion == 'COBERTURA'">
                                    <a v-bind:href="$parent.NombreRuta + '/inscripcion/constanciaingreso?token=' + encodeid(dato.id)" target="_blank" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                        <span class="svg-icon svg-icon-3"><i class="bi bi-eye fs-2"></i></span>
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                        <!--end::Table body-->
                </table>
                <!--end::Table-->
            </div>
            <!--end::Table container-->
		<!--begin::Body-->
		</div>
    </div>
</template>
<script>
export default {
    data() {
        return {
            datos:[],
            botonCargando: false,
            filtros: {
                carrera: '',
                modalidad: 1,
                condicion: '',
                dato:''
            },
        }
    },
    mounted() {
        this.buscar(1)
    },
    methods: {
        async mostrarDatos() {

            this.botonCargando = true 

            let modalidad = this.filtros.modalidad
            let carrera = this.filtros.carrera
            let condicion = this.filtros.condicion
            let dato = this.filtros.dato            
			await axios
				.get(this.$parent.NombreRuta + "/api/fichas/descarga_constancia_ingreso?modalidad="+modalidad +'&carrera='+carrera+'&condicion='+condicion+'&dato='+dato)
				.then((response) => {
				    this.datos = response.data;
                    this.botonCargando = false 
				})
				.catch(function (error) {
				    this.datos = [];
                    this.botonCargando = false 
				});
				},
        buscar(opcion) {
            switch (opcion) {
                case 0:
                    this.filtros.dato = '',
                    this.filtros.modalidad = '',
                    this.filtros.carrera = '',
                    this.filtros.condicion = ''
                    break;
                case 1:
                    this.filtros.dato = ''
                    break;
                case 2:
                    this.filtros.modalidad = '',
                    this.filtros.carrera = '',
                    this.filtros.condicion = ''
                    break;
            }
            this.mostrarDatos()
        },
        encodeid(id) {
            let codigo = btoa(id);
            return codigo;
        },


    },
}
</script>