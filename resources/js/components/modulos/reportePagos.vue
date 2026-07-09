<template>
    <div class="card mb-5 mb-xl-8">
		<!--begin::Header-->
		<div class="card-header border-0 pt-5">
			<h3 class="card-title align-items-start flex-column">
				<span class="card-label fw-bold fs-3 mb-1">Pagos admisión</span>
				<span class="text-muted mt-1 fw-semibold fs-7">Valida los pagos por concepto de prospecto</span>
			</h3>
		</div>
		<!--end::Header-->
		<!--begin::Body-->
		<div class="card-body py-3">
            <div class="input-group mb-5" style="display: block">
                <div class="row">
                    <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                        <label>
                            Filtros por:
                        </label>
                        <select class="form-select" @change="buscar(1)" aria-label="Select example" v-model.number="filtros.tipo">
                            <option value="1">FECHA VALIDADO</option>
                            <option value="2">FECHA PAGO</option>
                        </select> 
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                        <label>
                            FECHA
                        </label>
                        <input type="date" class="form-control m-input col-lg-10" @change="buscar(1)" v-model="filtros.fecha" placeholder="Seleccione fecha" autocomplete="off">
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <label>
                            Buscar
                        </label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Buscar por DNI" v-model="filtros.dato" aria-describedby="button-addon2">
                            <button class="btn btn-primary"  @click.prevent="buscar(2)" type="button" id="button-addon2">Buscar</button>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                        <label>
                            FECHA INICIO
                        </label>
                        <input type="date" class="form-control m-input col-lg-10" @change="buscar(3)" v-model="filtros.desde" placeholder="Seleccione fecha" autocomplete="off">
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                        <label>
                            FECHA FINAL
                        </label>
                        <input type="date" class="form-control m-input col-lg-10" @change="buscar(3)" v-model="filtros.hasta" placeholder="Seleccione fecha" autocomplete="off">
                    </div>
                    <div class="col-lg-1 col-md-1 col-sm-1 col-xs-6">
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
                                <th>N. Documento</th>
                                <th>Postulante</th>
                                <th>Celular</th>
                                <th>Modalidad de examen</th>
                                <th>Concepto</th>
                                <th class="max-w-100px">Cuenta pago</th>
                                <th>Codigo Pago</th>
                                <th>Fecha pago </th>
                                <th>Monto pago </th>
                                <th>Archivo</th>
                                <th class="max-w-125px text-center rounded-end" style="width: 200px;">Fecha validado</th>
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
                                <td>
                                    {{dato.numero_documento}}
                                </td>
                                <td>
                                    {{dato.nombre + ' ' + dato.apellido_paterno + ' ' + dato.apellido_materno}}
                                </td>
                                <td>
                                    {{dato.numero_celular}}
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
                                    <span v-if="dato.id_tipo_pago==1">PROSPECTO</span>
                                    <span v-if="dato.id_tipo_pago==2">D. INSCRIPCIÓN</span>
                                    <span v-if="dato.id_tipo_pago==3">PROSPECTO Y D. INSCRIPCIÓN</span>
                                    <span v-if="dato.id_tipo_pago==4">RECARGO REZAGADOS</span>
                                    <span v-if="dato.id_tipo_pago==5">D. INSCRIPCIÓN</span>
                                    <span v-if="dato.id_tipo_pago==6">D. INSCRIPCIÓN</span>
                                </td>
                                <td>
                                    <span v-if="dato.cuenta_pago==1" class="badge badge-success">Interbank</span>
                                    <span v-else-if="dato.cuenta_pago==2" class="badge badge-danger">Banco de la Nación</span>
                                    <span v-else-if="dato.cuenta_pago==3" class="badge badge-warning">UNDC</span>
                                </td>
                                <td>
                                    {{dato.codigo_pago}}
                                </td>
                                <td>
                                    {{dato.fecha_pago}}
                                </td>
                                <td>
                                    {{dato.monto_pago}}
                                </td>
                                <td class="text-center">
                                    <span v-if="dato.tipo_enlace==3" class="badge badge-danger">IZZIPAY</span>
                                    
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
                                </td>
                                <td>
                                    {{dato.fecha_revisado}}
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
                fecha: '',
                dato: '',
                desde: '',
                hasta: '',
                tipo:1
            },
            botonEnviar: false,
        }
    },
    mounted() {
        this.asignarFecha()
        this.buscar(1)
        
    },
    methods: {
     
        async mostrarDatosfiltro() {

            this.botonCargando = true 

            let fecha = this.filtros.fecha
            let dato = this.filtros.dato
            let desde = this.filtros.desde
            let hasta = this.filtros.hasta
            let tipo = this.filtros.tipo
			await axios
				.get(this.$parent.NombreRuta + "/api/pagos/reporte?tipo="+tipo +'&fecha='+fecha+'&dato='+dato+'&desde='+desde+'&hasta='+hasta)
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
                    this.filtros.fecha = '',
                    this.filtros.dato = '',
                    this.filtros.desde = '',
                    this.filtros.hasta = ''
                    break;
                case 1:
                    this.filtros.dato = ''
                    break;
                case 2:
                    this.filtros.fecha = '',
                    this.filtros.desde = '',
                    this.filtros.hasta = ''
                    break;

            }
            this.mostrarDatosfiltro()
        },
        asignarFecha(){
            /* let date= new Date();
            this.filtros.fecha=date.toLocaleDateString()*/

            let date = new Date() 

            let day = date.getDate()
            let month = date.getMonth() + 1
            let year = date.getFullYear()

            if(month < 10){
                month= '0'+month
            }
            if(day < 10){
                day= '0'+day
            }
            this.filtros.fecha= `${year}-${month}-${day}`;
        }
    },
}
</script>