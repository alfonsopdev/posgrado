<style>
    .zoom {
        transition: transform 0.2s;
    }

    .zoom:hover {
        transform: scale(5.5);
    }
</style>
<template>
    <div class="card mb-5 mb-xl-8">
		<!--begin::Header-->
		<div class="card-header border-0 pt-5">
			<h3 class="card-title align-items-start flex-column">
				<span class="card-label fw-bold fs-3 mb-1">Pagos admisión</span>
				<span class="text-muted mt-1 fw-semibold fs-7">Valida los pagos por concepto de derecho de examen</span>
			</h3>
		</div>
		<!--end::Header-->
		<!--begin::Body-->
		<div class="card-body py-3">
            <div class="input-group mb-5" style="display: block">
                <div class="row">
                    <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                        <label>
                            Estados
                        </label>
                        <select class="form-select" @change="buscar(1)" aria-label="Select example" v-model.number="filtros.estado">
                            <option value="">TODOS</option>
                            <!-- <option value="0">SIN ENVIAR</option>  -->
                            <option value="1">PENDIENTE</option> 
                            <option value="2">RECHAZADO</option> 
                            <option value="3">VALIDADO</option>
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
                                <th>Concepto</th>
                                <!-- <th>Modalidad</th> -->
                                <th>Postulante</th>
                                <th>N. Documento</th>
                                <th>Celular</th>
                                <th>Regimen IE</th>
                                <th>Archivo</th>
                                <th>Cuenta pago</th>
                                <th>Codigo pago</th>
                                <th>Fecha pago</th>
                                <th>Monto pago</th>
                                <th>Estado</th>
                                <th>Validar</th>
                                <th class="max-w-125px text-center rounded-end" style="width: 200px;">Rechazar</th>
                            </tr>
                        </thead>
                        <!--end::Table head-->
                        <!--begin::Table body-->
                        <tbody>
                            <tr v-if="botonCargando">
                                <td colspan="14" class="text-center">
                                    <div class="spinner-border text-primary" role="status">
                                        <span class="sr-only">Loading...</span>
                                    </div>
                                </td>
                            </tr>
                            <tr v-else v-for="(dato, index) in datos" :index="index" :key="dato.id"> 
                                <td class="ps-4">
                                   {{index+1}} 
                                </td>
                                <td>
                                    <span v-if="dato.id_tipo_pago==1">PROSPECTO</span>
                                    <span v-if="dato.id_tipo_pago==2">D. EXAMEN</span>
                                    <span v-if="dato.id_tipo_pago==3">PROSPECTO Y D. EXAMEN</span>
                                    <span v-if="dato.id_tipo_pago==5">SEGUNDO D. EXAMEN</span>
                                    <span v-if="dato.id_tipo_pago==6">TERCERO D. EXAMEN</span>

                                </td>
                                <td>
                                    <span v-if="dato.mcp_id_modalidad==1 || dato.mcp_id_modalidad==2 || dato.mcp_id_modalidad==5 || dato.mcp_id_modalidad==6 || dato.mcp_id_modalidad==7">
                                        {{dato.modalidad + ' - ' + dato.D_GESTION}}  
                                    </span>
                                    <span v-else>
                                        {{dato.modalidad}}
                                    </span>
                                </td>
                                <td>
                                    {{dato.nombre + ' ' + dato.apellido_paterno + ' ' + dato.apellido_materno}}
                                </td>
                                <td>
                                    {{dato.numero_documento}}
                                </td>
                                <td>
                                    {{dato.numero_celular}}
                                </td>
                                <td>
                                    {{dato.D_GESTION}}
                                </td>
                                <td>
                                    <div id="preview" align="center">
                                        <!-- <embed :src="'../archivos/'+item.enlace" width="500" height="400" /> -->
                                        <!-- <a v-if="!extension(item.enlace)" :href="'../archivos/'+item.enlace" target="_blank"><i class="fa fa-file-pdf-o fa-2x" style="font-size: 24px;"></i></a> -->
                                        <img v-if="extension(dato.enlace)" class='zoom' :src="$parent.NombreRuta + '/storage/pagos/'+dato.enlace" width='100' height='70' />
                                        <a v-else :href="$parent.NombreRuta + '/storage/pagos/'+dato.enlace" target="_blank">
                                            <span class="menu-icon">
                                                <span class="svg-icon svg-icon-2">
                                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M20 14H18V10H20C20.6 10 21 10.4 21 11V13C21 13.6 20.6 14 20 14ZM21 19V17C21 16.4 20.6 16 20 16H18V20H20C20.6 20 21 19.6 21 19ZM21 7V5C21 4.4 20.6 4 20 4H18V8H20C20.6 8 21 7.6 21 7Z" fill="currentColor"></path> 
                                                        <path opacity="0.3" d="M17 22H3C2.4 22 2 21.6 2 21V3C2 2.4 2.4 2 3 2H17C17.6 2 18 2.4 18 3V21C18 21.6 17.6 22 17 22ZM10 7C8.9 7 8 7.9 8 9C8 10.1 8.9 11 10 11C11.1 11 12 10.1 12 9C12 7.9 11.1 7 10 7ZM13.3 16C14 16 14.5 15.3 14.3 14.7C13.7 13.2 12 12 10.1 12C8.10001 12 6.49999 13.1 5.89999 14.7C5.59999 15.3 6.19999 16 7.39999 16H13.3Z" fill="currentColor">
                                                        </path>
                                                    </svg>
                                                </span>
                                            </span>
                                        </a>
                                    </div>
                                </td>
                                <td>
                                    <span v-if="dato.cuenta_pago==1" class="badge badge-success">Interbank</span>
                                    <span v-else-if="dato.cuenta_pago==2" class="badge badge-danger">Banco de la Nación</span>
                                    <span v-else-if="dato.cuenta_pago==3" class="badge badge-warning">UNDC</span>
                                </td>
                                <td>
                                    <input v-if="dato.id_estado_revision==1" class="" v-model="dato.codigo_pago" type="text" required style="width:100px"/>
                                    <span v-else>{{dato.codigo_pago}}</span><!--  -->
                                </td>
                                <td>
                                    {{dato.fecha_pago}}
                                </td>
                                <td>
                                    <span class="badge badge-primary badge-lg">{{dato.monto_pago}}</span>
                                </td>
                                <td>
                                    <span v-if="dato.id_estado_revision==1" class="badge badge-circle badge-warning"></span>
                                    <span v-if="dato.id_estado_revision==2" class="badge badge-circle badge-danger"></span>
                                    <span v-if="dato.id_estado_revision==3" class="badge badge-circle badge-success"></span>
                                </td>
                                <td class="text-center">
                                    
                                    <form v-if="dato.id_estado_revision==1" @submit.prevent="verificar(3,dato.id, dato.monto_pago, dato.codigo_pago)">
                                        <div>
                                            <!-- <input type="date" class="form-control m-input" v-model="dato.fecha_pago" placeholder="Seleccione fecha" autocomplete="off" required> -->
                                            <input type="number" class="form-control" id="exampleInputEmail1" v-model="dato.monto_pago" aria-describedby="emailHelp" placeholder="Ingrese monto">
                                            <button type="submit" class='btn btn-primary'>
                                                <i class="bi bi-check-circle fs-2"></i>
                                            </button>
                                        </div>
                                    </form>
                                </td>
                                <td class="text-center">
                                    <div v-if="dato.id_estado_revision==1">
                                        <form @submit.prevent="verificar(2,dato.id, dato.observacion, dato.codigo_pago)">
                                            <div>
                                                <input class="form-control" v-model="dato.observacion" type="text" required list="opciones_pago" />
                                                <datalist id="opciones_pago">
                                                    <option>Error en código de pago</option>
                                                    <option>Enviar voucher en el concepto correcto:</option>
                                                    <option>No se visualiza todos los datos</option>
                                                    <option>Pago incompleto</option>
                                                    <option>Voucher incorrecto</option>
                                                </datalist>
                                                <button type="submit" class='btn btn-danger'>
                                                    <i class="bi bi-x-circle fs-2"></i>
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                    <div v-else-if="dato.id_estado_revision==2">
                                        {{dato.observacion}}
                                    </div>
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
    name:'ventaProspecto',
	data() {
		return {
			datos:[],
            botonCargando: false,
			//MODAL REGISTER:1 MODAL EDIT:0
			tipoModal:1,
			csrfToken: null,
			datosRegistro:{
				name:"Criss A",
				email:"cristian.ap.123@gmail.com", 
				password:"password"
			},
            filtros: {
                estado: 1,
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
            let estado = this.filtros.estado
			await axios
				.get(this.$parent.NombreRuta + "/api/pagos/vouchers?tipo=2&estado="+estado)
				.then((response) => {
				this.datos = response.data;
                this.botonCargando = false
                //this.asignar(response.data)
				})
				.catch(function (error) {
				this.datos = [];
                this.botonCargando = false
				});
				},
        async registrarEstado(id_estado_revision, id, dato, codigo_pago) {
			await axios
				.post(this.$parent.NombreRuta + "/api/pagos/verificar", {
                    'id_estado_revision':id_estado_revision,  
			        'id':id,
                    'dato':dato,
                    'codigo_pago': codigo_pago
                })
				.then((response) => {
                    if(response.data.success==1){
                        this.mostrarDatos()
                        toastr.options = {
                            "positionClass": "toastr-bottom-right",
                            "timeOut": "5000"
                        };
                        toastr.success('Pago verificado');
                    }else if(response.data.code==1){
                        toastr.options = {
                            "positionClass": "toastr-bottom-right",
                            "timeOut": "5000"
                        };
                        toastr.error('Error código de pago');
                    }else{
                        toastr.options = {
                            "positionClass": "toastr-bottom-right",
                            "timeOut": "5000"
                        };
                        toastr.error('Pago no verificado');
                    }
				
                //this.asignar(response.data)
				})
				.catch(function (error) {
                    this.errors=error.response.data.errors;
                    console.log(error);
				});
				},
        verificar(id_estado_revision, id, dato, codigo_pago){
            this.registrarEstado(id_estado_revision, id, dato, codigo_pago)
        },
        extension(enlace) {
            let extension = enlace.split('.').pop();
            if (extension == 'jpg' || extension == 'png' || extension == 'jpeg') {
                return true
            } else {
                return false
            }
            //console.log(extension)
        },
        buscar(opcion) {
            switch (opcion) {
                case 0:

                    this.filtros.estado = ''
                    break;
                case 1:
                    //this.filtros.dato = ''
                    break;
                case 2:
                    //this.filtros.modalidad = '',
                    //this.filtros.carrera = '',
                    //this.filtros.estado = ''
                    break;
            }
            this.mostrarDatos()
        },
    },
}
</script>