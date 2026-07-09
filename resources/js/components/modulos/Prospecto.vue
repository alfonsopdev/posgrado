<template>
<div>
    <div class="card mb-5 mb-xl-8">
		<!--begin::Card header-->
		<div class="card-header">
			<h2 class="card-title fw-bold">Prospecto de admisión EPG 2026-1</h2>
			<!-- <div class="card-toolbar">
				<button class="btn btn-flex btn-primary" data-kt-calendar="add">
				<span class="svg-icon svg-icon-2">
					<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
						<rect opacity="0.5" x="11.364" y="20.364" width="16" height="2" rx="1" transform="rotate(-90 11.364 20.364)" fill="currentColor"></rect>
						<rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="currentColor"></rect>
					</svg>
				</span>
				Add Event</button>
			</div> -->
		</div>
		<!--end::Card header-->
		<!--begin::Card body-->
		<div class="card-body">
			<!--begin::Calendar-->
            <div class="row" style="justify-content: center;">
                <div class="col-md-6 col-lg-6 col-xl-4"><img :src="$parent.NombreRuta +'/assets/media/images/prospecto-epg-2026-1.png'" width="100%" alt=""></div>
                <div class="col-md-6 col-sm-12 col-lg-6 col-xl-5 text-justify">
                    <!-- <div class="alert">
                    Postulantes, para descargar el prospecto, antes debes de pagar <b>S/ 50.00</b> al número de cuenta corriente (ventanilla o agente) del <b>Banco de la Nación </b> - <b>00 57 1028409</b> o <b>Banco Interbank</b> - <b>401 3004 5278 40</b>. Al obtener el voucher, debes tomar una foto y subir a la plataforma <b>(formato pdf o imagen)</b> en la seccción <a to="/pagos">Pagos</a> para poder validarlo. <br>
                    Luego de subir el voucher debe esperar <b>12 horas</b> para la validación, luego se le habilitará el botón de descarga (refrescar la página).
                    </div>  -->
                    <!-- <div class="alert">
                    Postulantes, para descargar el prospecto, antes debes de pagar <b>S/ 50.00</b> en el <b>Banco de la Nación(ventanilla o agente) </b> en número de Cuenta Corriente: <b>00-57 1028409</b>. Al obtener el voucher, debes tomar una foto y subir a la plataforma en la seccción <a to="/pagos">Pagos</a> para poder validarlo. <br>
                    Luego de subir el voucher debe esperar <b>48 horas</b> para la validación, luego se le habilitará el botón de descarga(refrescar la página).
                    </div> --> 
                    <!-- <p class="alert" style="color: red; font-family: &quot;arial black&quot;; text-align: center;">
                        La foto del voucher tiene que ser clara y con los datos completos.
                    </p> -->
                     <!----> <!----> <!----> 
                    <div class="alert" align="justify">
                    Postulante, luego de haber subido el voucher en la sección pagos debes esperar <b class="text-info">48 horas como máximo</b> en <b class="text-info">horario de oficina</b> para la validación, posterior a ello se habilitará el botón de descarga (refrescar la página).
                    <br>
                    <br>
                    <b>NOTA: Puede continuar con la inscripción, presionando el botón "Siguiente" previa validación del comprobante de pago.</b>                    </div>
                    <div v-if="!loadingData">
                        <div class="alert alert-success" v-if="comprobanteProspecto.id_estado_revision==3 || (ficha!=0 && ficha[0].id_estado_revision==3)" role="success">
                            <strong>
                                Prospecto adquirido!
                            </strong><br>
                            Ya puede acceder al prospecto
                        </div> 
                        <div class="alert alert-warning" v-else-if="comprobanteProspecto.id_estado_revision==1" role="warning">
                            <strong>
                                Pendiente de revisión!
                            </strong>
                            Comprobante de pago en revisión 
                        </div>
                        <div class="alert alert-danger" v-else-if="comprobanteProspecto.id_estado_revision==2" role="danger">
                            <strong>
                                Rechazado!
                            </strong>
                            Su comprobante de pago ha sido rechazado, revise la observación y envie nuevamente en <router-link to="/pagos">Pagos</router-link>.
                        </div>
                        <div class="alert alert-danger" v-else role="danger">
                            <strong>
                                <!-- Rechazado! -->
                            </strong>
                            Envíe el comprobante de pago en el módulo <router-link  to="/pagos">Pagos</router-link>
                        </div>
                        <div>
                            <a v-if="comprobanteProspecto.id_estado_revision==3 || (ficha!=0 && ficha[0].id_estado_revision==3)" href="https://drive.google.com/file/d/1svjYQycXabVFcxSTYMxsWAhM5iOQ2Bp6/view" target="_blank"><input type="button" value="Descarga de prospecto" class="btn btn-primary btn-block enlace" style="display: inline-block;"></a> <!---->
                            <input type="button" v-else value="Descargar prospecto" disabled class="btn btn-primary btn-block enlace" style="display: inline-block;"> <!---->  
                        </div>
                    </div>
                    <div v-else class="text-center">
                        <div class="spinner-border text-primary" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                    </div>
                </div>
            </div>
			<!--end::Calendar-->
		</div>
		<!--end::Card body-->
	</div>
    <div class="d-flex justify-content-end">
        <router-link to="/inscripcion" class="btn btn-primary">Siguiente <i class="bi bi-arrow-right fs-2"></i></router-link>
    </div>
</div>
</template>
<script>
export default {
    name:'pagos',
	data() {
		return {
			datos:[],
            loadingData:true,
            comprobanteProspecto:{
                codigo_pago:'',
                id_tipo_pago:1,
                created:0,
                archivo: null
            },
            ficha:[],
            disponiblePspecto: false
		}
	},
    mounted() {
        this.mostrarDatos()
        this.obtenerFicha()
    },
    methods: {
        async mostrarDatos() {
            this.loadingData = true,
			await axios
				.get(this.$parent.NombreRuta + "/api/pagos")
				.then((response) => {
				    this.datos = response.data;
                    this.asignar(response.data)
                    this.loadingData = false
				})
				.catch(function (error) {
				    this.datos = [];
                    this.loadingData = false
				});
			},
        async obtenerFicha() {
			await axios
				.get(this.$parent.NombreRuta + "/api/fichas")
				.then((response) => {
                    this.ficha = response.data
				})
				.catch(function (error) {
				    this.ficha = [];
				});
		},
        asignar(datos){

            let prospecto = ''
            let ambos = ''
            let validado = ''
            if(datos!=0){
                datos.forEach(object =>{
                    if(object.id_estado_revision==3 && object.id_tipo_pago != 2){
                        validado = object
                    }else if(object.id_tipo_pago === 1 && (object.id_estado_revision==1 || object.id_estado_revision==2)){
                        //prospecto = Object.assign({archivo: null}, object)
                        prospecto =  object
                    }else if(object.id_tipo_pago === 3 && (object.id_estado_revision==1 || object.id_estado_revision==2)){
                        //ambos = Object.assign({archivo: null}, object)
                        ambos =  object
                    }
                });
                if(validado!=''){
                    this.comprobanteProspecto = Object.assign({archivo: null}, validado)
                }else if(ambos!='' && ambos.id_estado_revision==1){
                    this.comprobanteProspecto = Object.assign({archivo: null}, ambos)
                }else if(prospecto!='' && prospecto.id_estado_revision==1){
                    this.comprobanteProspecto = Object.assign({archivo: null}, prospecto)
                }else if(ambos!='' && ambos.id_estado_revision==2){
                    this.comprobanteProspecto = Object.assign({archivo: null}, ambos)
                }else if(prospecto!='' && prospecto.id_estado_revision==2){
                    this.comprobanteProspecto = Object.assign({archivo: null}, prospecto)
                }
            }
        },
    },
}
</script>
