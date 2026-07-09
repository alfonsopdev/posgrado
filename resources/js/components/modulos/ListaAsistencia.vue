<template>
    <div class="card mb-5 mb-xl-8">
		<div class="card-header border-0 pt-5">
			<h3 class="card-title align-items-start flex-column">
				<span class="card-label fw-bold fs-3 mb-1">Lista de Asistencia</span>
				<span class="text-muted mt-1 fw-semibold fs-7">Lista de Asistencia</span>
			</h3>
		</div>
		<div class="card-body py-3">
            <div class="input-group mb-5" style="display: block">
                <div class="row">
                    <!-- Filtro de busqueda por Carreras  -->
                     <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12 mb-5">
                            <label>
                                Programas de Estudio
                            </label>
                            <select 
                                class="form-select" 
                                @change="buscar(1)" 
                                v-model.number="filtros.carrera"
                            >
                                <option :value="0">TODOS</option>
                                
                                <option v-for="c in carreras" :key="c.id" :value="c.id">
                                    {{ c.carrera }}
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
                            <!-- <option value="INGRESO">INGRESÓ</option> 
                            <option value="NO INGRESO">NO INGRESÓ</option>  -->
                            <option value="PRESENTE">PRESENTE</option>
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
                                <!-- <th class="ps-4 rounded-start">N° Ficha</th> -->
                                <!-- <th>Modalidad</th> -->
                                <th>Apellidos y Nombres</th>
                                <th>Carrera</th>
                                <th>Local</th>
                                <th>Aula</th>            
                                <th class="text-center rounded-end">Asistencia</th>
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
                                <!-- <td class="ps-4">
                                   {{ dato.id}} 
                                </td> -->
                                <!-- <td>
                                    {{dato.modalidad}}
                                </td>                                 -->
                                <td>
                                    <div class="d-flex align-items-center">
                                        <p class="text-dark fw-bold mb-1 fs-6">{{ dato.apellidos+ ', '+ dato.nombre}}</p>
                                    </div>
                                </td>
                                <td>{{ dato.carrera }}</td>
                                <td>
                                    {{dato.local}}
                                </td>
                                <td> {{ dato.aula }}</td>
                                <td>
                                    {{mostrarCondicion(dato.condicion)}}
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
            carreras: [],
            botonCargando: false,
            filtros: {
                carrera: 0,
                modalidad: 1,
                condicion: '',
                dato:''
            },
        }
    },
    mounted() {
        this.buscar(1),
        this.obtnerCarreras()
    },
    methods: {
        async mostrarDatos() {

            this.botonCargando = true 

            let modalidad = this.filtros.modalidad
            let carrera = this.filtros.carrera
            let condicion = this.filtros.condicion
            let dato = this.filtros.dato            
			await axios
				.get(this.$parent.NombreRuta + "/api/fichas/lista_asistencia?modalidad="+modalidad +'&carrera='+carrera+'&condicion='+condicion+'&dato='+dato)
				.then((response) => {
				    this.datos = response.data;
                    this.botonCargando = false 
				})
				.catch(function (error) {
				    this.datos = [];
                    this.botonCargando = false 
				});
				},
        async obtnerCarreras() {
            axios
            .get(this.$parent.NombreRuta + "/api/carreras")
            .then((response) => {
                this.carreras = response.data.carreras;
            })
            .catch(function (error) {
                this.carreras = [];
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
        mostrarCondicion(condicion) {
            if (condicion === 'INGRESO' || condicion === 'NO INGRESO' || condicion == 'COBERTURA') {
                return 'PRESENTE';
            }
            return condicion;
        },
    },
}
</script>