<template>
    <div>
        <div class="card mb-5 mb-xl-8">
            <div class="card-header border-0 pt-5">
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label fw-bold fs-3 mb-1">Asignar postulantes a aulas</span>
                </h3>
            </div>
            <div class="card-body py-3">
                <div class="input-group mb-5" style="display: block">
                    <div class="row">
                        <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                            <label>
                                Modalidades examen
                            </label>
                            <select class="form-select" @change="buscar(1)" aria-label="Select example" v-model.number="asignar.examen" >
                                <!-- <option value="">TODOS</option> -->
                                <option value="2">
                                    Ordinario
                                </option>
                                <option value="1">
                                    Extraordinario
                                </option>
                                 
                            </select> 
                        </div>

                        <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                            <label>
                                Local examen
                            </label>
                            <select class="form-select" @change="buscar(1), obtenerAulas()" aria-label="Select example" v-model.number="asignar.local">
                                <!-- <option value="">TODOS</option> -->
                                <option value="1">
                                    LOCAL SEDE ACADÉMICO FUNDO DON LUIS
                                </option>
                                <option value="2">
                                    COLEGIO 20188
                                </option>
                            </select> 
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                            <label class="">
                                Aula
                            </label>
                            <select class="form-select" v-model="asignar.id_aula" required="">
                                 <option v-for="item in aulas" :key="item.id" :value="item.id">{{item.aula + ' ('+item.cantidad+')'}}</option>
                            </select>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                            <label class="">
                                CANTIDAD
                            </label>
                            <input type="text" class="form-control m-input" v-model="asignar.cantidad" required="" size="2" maxlength="2" pattern="[0-9]+" title="Solo números. Tamaño max: 2 dígitos." placeholder="Ingrese cantidad" autocomplete="off">
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                            <div class="col-md-3 mt-6">
                                <button type="submit" @click.prevent="asignarPostulantes()" class="btn btn-primary">asignar</button>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                            <div class="mt-6">
                               <label >TOTAL</label><br>
                                <div v-for="(item, index) in sin_asignar" :key="index" >
                                    <span v-if="item.mcp_tipo==1">{{'TIPO A : '+item.cantidad}}</span>
                                    <span v-if="item.mcp_tipo==2">{{'TIPO B : '+item.cantidad}}</span>
                                    <br>
                                </div> 
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                            <div class="mt-6">
                               <label >ASIGNADO</label><br>
                                <div v-for="(item, index) in sin_asignar" :key="index" >
                                    <span v-if="item.mcp_tipo==1">{{'TIPO A : '+item.cantidad_asignado}}</span>
                                    <span v-if="item.mcp_tipo==2">{{'TIPO B : '+item.cantidad_asignado}}</span>
                                    <br>
                                </div> 
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                            <div class="mt-6">
                               <label >SIN ASIGNAR</label><br>
                                <div v-for="(item, index) in sin_asignar" :key="index" >
                                    <span v-if="item.mcp_tipo==1">{{'TIPO A : '+item.no_asignado}}</span>
                                    <span v-if="item.mcp_tipo==2">{{'TIPO B : '+item.no_asignado}}</span>
                                    <br>
                                </div> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        
        <div class="card mb-5 mb-xl-8">
            <!--begin::Header-->
            <div class="card-header border-0 pt-5">
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label fw-bold fs-3 mb-1">Lista de aulas</span>
                    <span class="text-muted mt-1 fw-semibold fs-7">Listado de postulantes por local y aula</span>
                </h3>
            </div>
            <!--end::Header-->
            <!--begin::Body-->
            <div class="card-body py-3">
                <div class="input-group mb-5" style="display: block">
                    <div class="row">
                        
                        
                        <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                            <label>
                                Modalidades examen
                            </label>
                            <select class="form-select" @change="buscar(1)" aria-label="Select example" v-model.number="filtros.modalidad">
                                <option value="0">TODOS</option> 
                                <option value="1">
                                    Ordinario
                                </option>
                                <option value="2">
                                    Extraordinario
                                </option>
                            </select> 
                        </div>
                        
                        <!--<div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                            <label>
                                Tipo de examen
                            </label>
                            <select class="form-select" @change="buscar(1)" aria-label="Select example" v-model.number="filtros.tipo_examen">
                                <option value="0">TODOS</option>
                                <option value="1">
                                    A
                                </option>
                                <option value="2">
                                    B
                                </option>
                            </select> 
                        </div>-->
                        <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                            <label>
                                Local examen
                            </label>
                            <select class="form-select" @change="buscar(1)" aria-label="Select example" v-model.number="filtros.local" :disabled="true">
                                <option value="0">TODOS</option>
                                <option value="1">
                                    LOCAL SEDE ACADÉMICO FUNDO DON LUIS
                                </option>
                                <option value="2">
                                    COLEGIO 20188
                                </option>
                            </select> 
                        </div>
                        <!--<div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                            <div class="col-md-3 mt-6 w-100">
                                <a v-if="filtros.local!=''" v-bind:href="$parent.NombreRuta + '/examen/lista_general?formato=1&id_examen='+filtros.examen+'&local_id='+filtros.local" type="submit" class="btn btn-primary" target="_blank">Lista general</a>
                            </div>
                        </div>-->
                        <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                            <div class="col-md-3 mt-6 w-100">
                                <a v-if="filtros.local != ''" 
                                :href="urlDinamica" 
                                class="btn btn-primary" 
                                target="_blank">
                                {{ textoBoton }}
                                </a>
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
                                    <th>Examen</th>
                                     <th>Local</th>
                                    <th>Aula</th>
                                    <th>Cantidad</th>
                                    <th class="max-w-125px text-center rounded-end" style="width: 200px;">Acción</th>
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
                                    <td class="ps-4">{{index+1}}
                                    </td>
                                    <td>
                                        <span v-if="filtros.modalidad==1">
                                            ORDINARIO
                                        </span>
                                        <span v-if="filtros.modalidad==2">
                                            EXTRAORDINARIO
                                        </span>
                                        
                                    </td>
                                    
                                    <td>{{dato.local}}
                                    </td>
                                    <td>{{dato.aula}}
                                    </td>
                                    <td>
                                        {{dato.cantidad_aula}}    
                                    </td>
                                   <td class="text-center">
                                        <a v-bind:href="$parent.NombreRuta + '/examen/lista_aula?formato=2&id_examen='+dato.id_examen+'&id_aula='+dato.id_aula+'&local_id='+dato.local_id+'&aula='+dato.aula+'&nom_local='+dato.local + '&modalidad=' + filtros.modalidad" 
                                        target="_blank" 
                                        class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                            <span class="svg-icon svg-icon-3"><i class="bi bi-file-bar-graph fs-2"></i></span>
                                        </a>

                                        <a v-bind:href="$parent.NombreRuta + '/examen/lista_aula?formato=1&id_examen='+dato.id_examen+'&id_aula='+dato.id_aula+'&local_id='+dato.local_id+'&aula='+dato.aula+'&nom_local='+dato.local + '&modalidad=' + filtros.modalidad" 
                                        target="_blank" 
                                        class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                            <span class="svg-icon svg-icon-3"><i class="bi bi-file-text-fill fs-2"></i></span>
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

        <div class="card mb-5 mb-xl-8">
            <!--begin::Header-->
            <div class="card-header border-0 pt-5">
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label fw-bold fs-3 mb-1">Lista de Postulantes</span>
                    <span class="text-muted mt-1 fw-semibold fs-7">Listado de postulantes por aula</span>
                </h3>
            </div>
            <!--end::Header-->
            <!--begin::Body-->
              <!--begin::Body-->
            <div class="card-body py-3">
                <div class="input-group mb-5" style="display: block">
                    <div class="row">
                        
                        
                        <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                            <label>
                                Modalidades examen
                            </label>
                            <select class="form-select" @change="buscar(1)" aria-label="Select example"   v-model.number="filtros_postulantes.examen">
                                <!-- <option value="">TODOS</option> -->
                                <option value="2">
                                    Ordinario
                                </option>
                                <option value="1">
                                    Extraordinario
                                </option>
                                 
                            </select> 
                        </div>
                        
                        <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                            <label>
                                Tipo de examen
                            </label>
                            <select class="form-select" @change="buscar(1)" aria-label="Select example"   v-model.number="filtros_postulantes.tipo_examen">
                                <option value="">TODOS</option>
                                <option value="1">
                                    A
                                </option>
                                <option value="2">
                                    B
                                </option>
                            </select> 
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                            <label>
                                Local examen
                            </label>
                            <select class="form-select" @change="buscar(1)" aria-label="Select example" v-model.number="filtros_postulantes.local">
                                <option value="">TODOS</option>
                                <option value="1">
                                LOCAL SEDE ACADÉMICO FUNDO DON LUIS
                                </option>
                                <option value="2">
                                    COLEGIO 20188 dd
                                </option>
                            </select> 
                        </div>
                    </div>
                </div>
            
            <div class="table-responsive">
                <table class="table align-middle gs-0 gy-4 text-nowrap">
                    <thead>
                        <tr class="fw-bold text-muted bg-light">
                            <th class="min-w-50px">N°</th>
                            <th class="min-w-200px">Postulante</th>
                            <th class="min-w-100px">DNI</th>
                            <th class="min-w-150px">Carrera</th>
                            <th class="min-w-200px">Aula Asignada</th> 
                            <th class="min-w-200px">Modalidad</th> 

                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(postulante, index) in postulantes" :key="postulante.ficha_id"> 
                            <td>{{ index + 1 }}</td>
                            <td>{{ postulante.dp_apellido_p }} {{ postulante.dp_apellido_m }}, {{ postulante.dp_nombre }}</td>
                            <td>{{ postulante.numero_documento }}</td>
                            <td>{{ postulante.carrera }}</td>
                            
                            <td>
                                <select class="form-select form-select-sm w-100" v-model="postulante.id_aula" @change="cambiarAula(postulante)">
                                    <option v-for="aula in aulas" :key="aula.id" :value="aula.id">
                                        {{ aula.aula }}
                                    </option>
                                </select>
                            </td>
                            <td>
                                <select class="form-select form-select-sm w-100" 
                                        v-model="postulante.id_modalidad" 
                                        @change="cambiarModalidad(postulante)">
                                    <option :value="0">MODALIDAD NO SELECCIONADA</option>
                                    <option :value="1">ORDINARIO</option>
                                    <option :value="2">EXTRAORDINARIO</option>
                                </select>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            </div>
        </div>
    </div>
    
</template>
<script>
export default {
    data() {
        return {
            datos:[],
            botonCargando: false,
            aulas:[],
            postulantes:[],
            sin_asignar:[],
            filtros: {
                examen: 2,
                tipo_examen:'',
                local: 1,
                modalidad:1
            },
            filtros_postulantes: {
                examen: '2',
                tipo_examen: '1',
                local: '1'
            },
            asignar:{
                examen: '2',
                tipo_examen: '1',
                local: '1',
                id_aula: '',
                cantidad: '',
            },
            //Nuevo objeto para asignación manual
            asignarManual: {
                codigo_p: '',
                id_aula: ''
            },

        }
    },
    mounted() {
        this.mostrarDatos()
        this.listarPostulantes()
        this.postulantesSinAsignar()
        this.obtenerAulas()
    },
    computed: {
        // 1. Calcula la URL con los parámetros actuales
        urlDinamica() {
            let rutaBase = this.$parent.NombreRuta + '/examen/lista_general?formato=1';
            let params = `&id_examen=${this.filtros.examen}&local_id=${this.filtros.local}`;

            // Si seleccionó Ordinario (1) o Extraordinario (2), lo añadimos a la URL
            if (this.filtros.modalidad != '') {
                params += `&modalidad=${this.filtros.modalidad}`;
            }

                return rutaBase + params;
        },
        // 2. Cambia el texto del botón según la selección
        textoBoton() {
            if (this.filtros.modalidad == 1) {
                return 'Lista Ordinario';
            } else if (this.filtros.modalidad == 2) {
                return 'Lista Extraordinario';
            } else {
                return 'Lista General';
            }
        }
    },
    methods: {
        async mostrarDatos() {
			let examen = this.filtros.examen
            let tipo_examen = this.filtros.tipo_examen
            let local = this.filtros.local
            let modalidad = this.filtros.modalidad;
			await axios
				.get(this.$parent.NombreRuta + "/api/aulas?examen="+examen+'&tipo_examen='+tipo_examen+'&local='+local+'&modalidad='+modalidad)
				.then((response) => {
				this.datos = response.data.aulas;
				})
				.catch(function (error) {
				this.datos = [];
				});
			},
        async listarPostulantes() {
                let examen = this.filtros_postulantes.examen;
                let tipo_examen = this.filtros_postulantes.tipo_examen;
                let local = this.filtros_postulantes.local;
                
                // Apuntamos a la ruta correcta que definimos arriba
                await axios
                    .get(this.$parent.NombreRuta + "/api/postulantes/listar?examen="+examen+'&tipo_examen='+tipo_examen+'&local='+local)
                    .then((response) => {
                        // Guardamos en un array de postulantes
                        this.postulantes = response.data.postulantes; 
                    })
                    .catch((error) => {
                        this.postulantes = [];
                    });
            },

        // Nueva función que se dispara al cambiar el select
        async cambiarAula(postulante) {
            await axios
                .post(this.$parent.NombreRuta + "/api/postulantes/actualizar_aula", {
                    ficha_id: postulante.ficha_id, // El ID de la ficha a editar
                    id_aula: postulante.id_aula    // El nuevo ID del aula que seleccionaste
                })
                .then((response) => {
                    if(response.data.success){
                        alert("Aula actualizada correctamente"); // Puedes cambiar esto por un toastr o SweetAlert
                    }
                })
                .catch((error) => {
                    alert("Ocurrió un error al actualizar el aula");
                    console.error(error);
                });
        },

        async cambiarModalidad(postulante) {
            await axios
                .post(this.$parent.NombreRuta + "/api/postulantes/actualizar_modalidad", {
                    ficha_id: postulante.ficha_id, // El ID de la ficha a editar
                    id_modalidad: postulante.id_modalidad    // El nuevo ID de la modalidad que seleccionaste
                })
                .then((response) => {
                    if(response.data.success){
                        alert("Modalidad actualizada correctamente"); // Puedes cambiar esto por un toastr o SweetAlert
                    }
                })
                .catch((error) => {
                    alert("Ocurrió un error al actualizar la modalidad");
                    console.error(error);
                });
        },
        async obtenerAulas() {
			let examen = this.asignar.examen
            let tipo_examen = this.asignar.tipo_examen
            let local = this.asignar.local
			await axios
				.get(this.$parent.NombreRuta + "/api/aulas/listar?examen="+examen+'&tipo_examen='+tipo_examen+'&local='+local)
				.then((response) => {
				this.aulas = response.data.aulas;
				})
				.catch(function (error) {
				this.datos = [];
				});
			},
        async postulantesSinAsignar() {
			let examen = this.asignar.examen
            let tipo_examen = this.asignar.tipo_examen
            let local = this.asignar.local
			await axios
				.get(this.$parent.NombreRuta + "/api/aulas/sinasignar?examen="+examen)
				.then((response) => {
				this.sin_asignar = response.data.postulantes;
				})
				.catch(function (error) {
				this.sin_asignar = [];
				});
			},
        async guardarAulaPostulante(local, id_aula, cantidad) {
			await axios
				.post(this.$parent.NombreRuta + "/api/aulas/asignar", {
                local: local,
                id_aula: id_aula,
                cantidad: cantidad
                })
				.then((response) => {
				    if(response.data.changes>0){
                        toastr.options = {
                        "positionClass": "toastr-bottom-right",
                        "timeOut": "5000"
                    };
                    toastr.success(response.data.changes+' postulantes asignados');
                    }else{
                        toastr.options = {
                        "positionClass": "toastr-bottom-right",
                        "timeOut": "5000"
                        };
                    toastr.error('Postulantes asignados');
                    }
                    this.mostrarDatos()
                    this.obtenerAulas()
                    this.postulantesSinAsignar()
				})
				.catch(function (error) {
                    toastr.options = {
                        "positionClass": "toastr-bottom-right",
                        "timeOut": "5000"
                    };
                toastr.error('Postulantes asignados');
				});
			},
            
        buscar(opcion) {
            switch (opcion) {
                case 0:
                    this.filtros.examen = '1',
                    this.filtros.tipo_examen = '',
                    this.filtros.local = '',
                    this.filtros.modalidad = ''; // <--- Limpiamos modalidad
                    this.dato = ''
                    break;
                case 1:
                    this.filtros.dato = ''
                    break;
                case 2:
                    this.filtros.examen = '1',
                    this.filtros.tipo_examen = '',
                    this.filtros.local = '',
                    this.filtros.modalidad = ''
                    break;
            }
            this.mostrarDatos()
        },
        asignarPostulantes(){
            console.log('asignarPostulantes')
            if(this.asignar.local && this.asignar.id_aula && this.asignar.cantidad){
                this.guardarAulaPostulante(this.asignar.local, this.asignar.id_aula, this.asignar.cantidad)
                    
            }else{
                toastr.options = {
                        "positionClass": "toastr-bottom-right",
                        "timeOut": "5000"
                    };
                toastr.error('Postulantes asignados');
            }
        }
    }
}
</script>