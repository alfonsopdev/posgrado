<template>
    <div class="card mb-5 mb-xl-8">
    <div class="card-header border-0 pt-5">
      <h3 class="card-title align-items-start flex-column">
        <span class="card-label fw-bold fs-3 mb-1"
          >Carné de postulantes</span
        >
      </h3>
    </div>
    <div class="card-body py-3">
        <div class="text-center">
            <div class="row" style="justify-content: center">
                <div class="text-center col-md-10" v-if="ficha!=0 && ficha[0].id_estado_revision==3">
                    <!--begin::Alert-->
                    <div class="alert alert-dismissible bg-success d-flex flex-column flex-sm-row p-5 mb-10">
                        <!--begin::Icon-->
                        <span class="svg-icon svg-icon-2hx svg-icon-light me-4 mb-5 mb-sm-0"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
				    		<path opacity="0.3" d="M2 4V16C2 16.6 2.4 17 3 17H13L16.6 20.6C17.1 21.1 18 20.8 18 20V17H21C21.6 17 22 16.6 22 16V4C22 3.4 21.6 3 21 3H3C2.4 3 2 3.4 2 4Z" fill="currentColor"></path>
				    		<path d="M18 9H6C5.4 9 5 8.6 5 8C5 7.4 5.4 7 6 7H18C18.6 7 19 7.4 19 8C19 8.6 18.6 9 18 9ZM16 12C16 11.4 15.6 11 15 11H6C5.4 11 5 11.4 5 12C5 12.6 5.4 13 6 13H15C15.6 13 16 12.6 16 12Z" fill="currentColor"></path>
				    	</svg></span>
                        <!--end::Icon-->
                        <!--begin::Wrapper-->
                        <div class="d-flex flex-column text-light pe-0 pe-sm-10">
                            <!--begin::Title-->
                            <h4 class="mb-2 light">Felicitaciones has completado tu inscripción!</h4>
                            <!--end::Title-->
                            <!--begin::Content-->
                            <!-- <span>Felicitaciones has completado tu inscripción!.</span> -->
                            <!--end::Content-->
                        </div>
                        <!--end::Wrapper-->
                        <!--begin::Close-->
                        <!-- <button type="button" class="position-absolute position-sm-relative m-2 m-sm-0 top-0 end-0 btn btn-icon ms-sm-auto" data-bs-dismiss="alert">
                            <span class="svg-icon svg-icon-2x svg-icon-light">...</span>
                        </button> -->
                        <!--end::Close-->
                    </div>
                    <!-- <div v-if="ficha[0].mcp_id_modalidad!=8 && ficha[0].mcp_id_modalidad==1" class="alert alert-dismissible bg-warning d-flex flex-column flex-sm-row p-5 mb-10">
                        <span class="svg-icon svg-icon-2hx svg-icon-light me-4 mb-5 mb-sm-0"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
				    		<path opacity="0.3" d="M2 4V16C2 16.6 2.4 17 3 17H13L16.6 20.6C17.1 21.1 18 20.8 18 20V17H21C21.6 17 22 16.6 22 16V4C22 3.4 21.6 3 21 3H3C2.4 3 2 3.4 2 4Z" fill="currentColor"></path>
				    		<path d="M18 9H6C5.4 9 5 8.6 5 8C5 7.4 5.4 7 6 7H18C18.6 7 19 7.4 19 8C19 8.6 18.6 9 18 9ZM16 12C16 11.4 15.6 11 15 11H6C5.4 11 5 11.4 5 12C5 12.6 5.4 13 6 13H15C15.6 13 16 12.6 16 12Z" fill="currentColor"></path>
				    	</svg></span>
                        <div class="d-flex flex-column text-light pe-0 pe-sm-10">
                            <h4 class="mb-2 light">El carné de postulante lo podrá decargar 02 días antes del examen!</h4>
                        </div>
                    </div> -->
                    <div v-if="ficha[0].mcp_id_modalidad==8" class="alert alert-dismissible bg-warning d-flex flex-column flex-sm-row p-5 mb-10">
                        <!--begin::Icon-->
                        <span class="svg-icon svg-icon-2hx svg-icon-light me-4 mb-5 mb-sm-0"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
				    		<path opacity="0.3" d="M2 4V16C2 16.6 2.4 17 3 17H13L16.6 20.6C17.1 21.1 18 20.8 18 20V17H21C21.6 17 22 16.6 22 16V4C22 3.4 21.6 3 21 3H3C2.4 3 2 3.4 2 4Z" fill="currentColor"></path>
				    		<path d="M18 9H6C5.4 9 5 8.6 5 8C5 7.4 5.4 7 6 7H18C18.6 7 19 7.4 19 8C19 8.6 18.6 9 18 9ZM16 12C16 11.4 15.6 11 15 11H6C5.4 11 5 11.4 5 12C5 12.6 5.4 13 6 13H15C15.6 13 16 12.6 16 12Z" fill="currentColor"></path>
				    	</svg></span>
                        <!--end::Icon-->
                        <!--begin::Wrapper-->
                        <div class="d-flex flex-column text-light pe-0 pe-sm-10">
                            <!--begin::Title-->
                            <h4 class="mb-2 light">Los ingresantes por modalidad CEPRE no descargan carné de postulante</h4>
                            <!--end::Title-->
                            <!--begin::Content-->
                            <!-- <span>Felicitaciones has completado tu inscripción!.</span> -->
                            <!--end::Content-->
                        </div>
                        <!--end::Wrapper-->
                    </div>
                    <!--end::Alert-->
                    <!-- <div class="alert alert-success" role="alert">
                            <strong>
                                Felicitaciones has completado tu inscripción
                            </strong>
                        </div> -->
                    <!-- <div class="m-alert m-alert--icon m-alert--air alert alert-success alert-dismissible fade show" role="alert">
                        <div class="m-alert__icon">
                            <i class="la la-warning"></i>
                        </div>
                        <div class="m-alert__text">
                            <strong>
                                Felicitaciones has completado tu inscripción!
                            </strong>
                        </div>
                        <div class="m-alert__close">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div> -->
                </div> 
                <div class="text-center col-md-10" v-else>
                    <div class="alert alert-dismissible bg-danger d-flex flex-column flex-sm-row p-5 mb-10">
                        <!--begin::Icon-->
                        <span class="svg-icon svg-icon-2hx svg-icon-light me-4 mb-5 mb-sm-0"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
				    		<path opacity="0.3" d="M2 4V16C2 16.6 2.4 17 3 17H13L16.6 20.6C17.1 21.1 18 20.8 18 20V17H21C21.6 17 22 16.6 22 16V4C22 3.4 21.6 3 21 3H3C2.4 3 2 3.4 2 4Z" fill="currentColor"></path>
				    		<path d="M18 9H6C5.4 9 5 8.6 5 8C5 7.4 5.4 7 6 7H18C18.6 7 19 7.4 19 8C19 8.6 18.6 9 18 9ZM16 12C16 11.4 15.6 11 15 11H6C5.4 11 5 11.4 5 12C5 12.6 5.4 13 6 13H15C15.6 13 16 12.6 16 12Z" fill="currentColor"></path>
				    	</svg></span>
                        <!--end::Icon-->
                        <!--begin::Wrapper-->
                        <div class="d-flex flex-column text-light pe-0 pe-sm-10">
                            <!--begin::Title-->
                            <h4 class="mb-2 light">Complete el paso anterior!</h4>
                            <!--end::Title-->
                            <!--begin::Content-->
                            <!-- <span>Felicitaciones has completado tu inscripción!.</span> -->
                            <!--end::Content-->
                        </div>
                        <!--end::Wrapper-->
                    </div>
                </div>
            </div>
            <!-- <div v-for="item in ficha" class="row" :key="item.id" style="justify-content: center;"> -->
            <div v-if="1" class="row" style="justify-content: center;">
                <div  v-if="ficha!=0 && ficha[0].mcp_id_modalidad!=8 && ficha[0].id_estado_revision==3" class="col-md-10">
                    <div class="m-portlet__body mb-10">
                        <div class="form-group m-form__group row">
                            <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">
                                <span>
                                    <!-- <a v-bind:href="$parent.NombreRuta + '/inscripcion/carne3?download=si&token=' + encodeid(ficha[0].id)" target="_blank"><img src="/assets/media/images/carne_postulante_modelo_2023.jpg" alt="" style="width: 100%;height: 360px;"></a> -->
                                    <a v-bind:href="'#'" target="_blank"><img :src="$parent.NombreRuta +'/assets/media/images/carne_postulante_modelo_2023.jpg'" alt="" style="width: 100%;height: 360px;"></a>
                                </span>
                            </div>
                            <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
                                <!-- <div class="card text-right">
                                    <div class="card-header bg-primary pt-7">
                                        <h3 class="card-title align-items-center w-100 text-center"><span class="card-label fw-bold text-white">Indicaciones</span></h3>
                                    </div>
                                    <div class="card-body" style="text-align: left">
                                        <ul>
                                            <b>LOCALES DE EXAMEN</b><br>
                                            <b>Casa de la cultura:</b>
                                            <p class="mb-0"> - Dirección: Av. Mariscal Benavides, 1370 - SAN VICENTE DE CAÑETE</p>
                                            <p> - Ref: Coliseo Lolo Fernandez</p>
                                            <b>I.E. 20188 "CENTRO DE MUJERES":</b>
                                            <p class="mb-0"> - Prolongación José Gálvez S/N - SAN VICENTE DE CAÑETE</p>
                                            <p> - Ref: Frente al camal</p>
                                        </ul>
                                    </div>
                                </div> -->
                                <div class="card text-right">
                                    <div class="card-header bg-primary pt-7">
                                        <h3 class="card-title align-items-center w-100 text-center"><span class="card-label fw-bold text-white">Indicaciones</span></h3>
                                    </div>
                                    <div class="card-body" style="text-align: left">
                                        <ul>
                                            <!-- <b>LOCAL DE EXAMEN</b><br>
                                            <div v-if="ficha[0].mcp_tipo==2">
                                                <b>CASA DE LA CULTURA:</b>
                                                <p class="mb-0"> - Dirección: Av. Mariscal Benavides, 1370 - SAN VICENTE DE CAÑETE</p>
                                                <p class="mb-0"> - Ref: Coliseo Lolo Fernandez</p>
                                                <a :href="'https://goo.gl/maps/a2zi2UUJHyqksgX96'" target="_blank">Ver en google maps</a>
                                                <br><br>
                                            </div>
                                            <div v-if="ficha[0].mcp_tipo==1">
                                                <b>I.E. 20188 "CENTRO DE MUJERES":</b>
                                                <p class="mb-0"> - Dirección: Prolongación José Gálvez S/N - SAN VICENTE DE CAÑETE</p>
                                                <p class="mb-0"> - Ref: Frente al camal</p>
                                                <a :href="'https://goo.gl/maps/22qBAA7cBnDHnf116'" target="_blank">Ver en google maps</a>
                                                <br><br>
                                            </div>
                                             -->
                                            <li>Descargar postulante.</li>
                                            <li>IMPRIMIR en hoja completa (A4) a COLOR.</li>
                                            <li>Llevar el carné completo el día del examen junto a su documento de indentidad(DNI).</li>
                                            <li>Las impresiones dactilares y firma en el carné se colocarán el día del examen en el aula.</li>
                                            <!-- <li>Firma y poner huella donde corresponda</li>
                                        <li>Subir el carné escaneado y esperar la verificación</li> -->
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-lg-12 m--align-right">
                                    <a v-bind:href="'proceso/fichaspdf/carnepdf.php?d=' + encodeid(item.ID_FICHA)" class="btn btn-primary btn-block" target="_blank">Imprimir Fichas
                                </a> 
                                    <a v-bind:href="'proceso/fichaspdf/carnepdf.php?d=' + encodeid(ficha[0].id_ficha)" target="_blank"><i class="flaticon-profile"></i>
                                </a> 
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                        <div class="m-form__actions m-form__actions--solid">
                            <div class="row">
                                <!-- <div class="col-lg-6">
                                </div> -->
                                <!-- <div class="col-lg-12 m--align-right"> -->
                                <div class="col-lg-12">
                                    <!-- <div v-if="id_estado_usu==3 && opcionCarne" class="alert alert-danger" role="alert">
                                        <strong>
                                            Alerta!
                                        </strong>
                                        Tiene <b> {{horas_carne}} </b> horas para imprimir el carné
                                    </div> -->
                                    <!-- <div v-if="item.id_estado_revision==3 && opcionCarne" class="m-alert m-alert--outline m-alert--outline-2x alert alert-danger alert-dismissible fade show" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
                                        <strong>
                                            Alerta!
                                        </strong>
                                        Tiene <b> {{horas_carne}} </b> horas para imprimir el carné.
                                    </div> -->
                                    <!--begin::Alert-->
                                    <!-- <div v-if="ficha[0].id_estado_revision==3 && opcionCarne" class="alert alert-dismissible bg-light-primary border border-primary d-flex flex-column flex-sm-row p-5 mb-10 text-left" style="text-align: left">
                                        <span class="svg-icon svg-icon-2hx svg-icon-primary me-4 mb-5 mb-sm-0">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
											<path opacity="0.3" d="M2 4V16C2 16.6 2.4 17 3 17H13L16.6 20.6C17.1 21.1 18 20.8 18 20V17H21C21.6 17 22 16.6 22 16V4C22 3.4 21.6 3 21 3H3C2.4 3 2 3.4 2 4Z" fill="currentColor"></path>
											<path d="M18 9H6C5.4 9 5 8.6 5 8C5 7.4 5.4 7 6 7H18C18.6 7 19 7.4 19 8C19 8.6 18.6 9 18 9ZM16 12C16 11.4 15.6 11 15 11H6C5.4 11 5 11.4 5 12C5 12.6 5.4 13 6 13H15C15.6 13 16 12.6 16 12Z" fill="currentColor"></path>
										</svg>
                                        </span>
                                        <div class="d-flex flex-column pe-0 pe-sm-10">
                                            <h5 class="mb-1">Alerta!</h5>
                                            <span>Tiene <b> {{horas_carne}} </b> horas para imprimir el carné.</span>
                                        </div>
                                    </div> -->
                                    <!--end::Alert-->
                                    <!-- <a v-bind:href="'proceso/fichaspdf/fichapdf.php?i='" class="btn btn-primary btn-block" target="_blank">Imprimir Fichas
                                </a> -->
                                <div class="mb-2">
                                    <a v-if="ficha[0].id_estado_revision==3 && ficha[0].id_aula" v-bind:href="$parent.NombreRuta + '/inscripcion/carne3?download=si&token=' + encodeid(ficha[0].id)" class="btn btn-success btn-block w-100" target="_blank">Descargar carné
                                    </a>
                                    
                                    <a v-else href="" class="btn btn-primary btn-block disabled w-100" target="_blank" disabled>Proximamente
                                    </a>
                                </div>
                                    
                                    <br>
                                    <!-- <a class="btn btn-primary btn-block">Estoy conforme con el carné
                                    </a> -->
                                    <!-- <button v-if="ficha[0].id_estado_revision==3" @click.prevent="conforCarne(ficha[0].id)" type="button" class="btn btn-info w-100" :disabled="ficha[0].confor_carnet==1">
                                        He impreso el carné
                                    </button> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <div v-if="ficha[0].mcp_id_modalidad==8 && ficha[0].id_estado_revision==3" class="col-md-8">
                    <div class="alert alert-danger" role="alert">
                        <strong>
                            No disponible para ingresantes CEPRE!
                        </strong>
                    </div>
                </div> -->
                <!-- <div v-if="ficha[0].mcp_id_modalidad!=8 && ficha[0].id_estado_revision!=3" class="col-md-8">
                    <div class="alert alert-danger" role="alert">
                        <strong>
                            Complete el paso anterior!
                        </strong>
                    </div>
                </div> -->
                <!-- <div v-if="ficha[0].mcp_id_modalidad==8 && ficha[0].id_estado_revision!=3" class="col-md-8">
                    <div class="alert alert-danger" role="alert">
                        <strong>
                            No disponible para ingresantes CEPRE!
                        </strong>
                    </div>
                </div> -->
                <!-- </form> -->
            </div>
            <br>
            <br>
            <br>
            <!-- <div class="text-center" v-if="id_estado_usu==3 && id_modalidad_usu!=8" class="col-md-8">
                <div class="m-alert m-alert--icon m-alert--air alert alert-success alert-dismissible fade show" role="alert">
                    <div class="m-alert__icon">
                        <i class="la la-warning"></i>
                    </div>
                    <div class="m-alert__text">
                        <strong>
                            Felicitaciones has completado tu inscripción!
                        </strong>
                    </div>
                    <div class="m-alert__close">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            </div> -->
            </div>
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {
        ficha: [],
        botonRevision: true,
        botonEnviar: false,
        botonGuardarFicha: false,
        loadingData:true,

        id_modalidad_usu: '',
        id_ficha_usu: '',
        id_estado_usu:''
    };
  },
  mounted() {
    this.obtenerFicha()
  },
  methods: {
    async obtenerFicha() {
            this.botonGuardarFicha=true,
            this.loadingData = true
			await axios
				.get(this.$parent.NombreRuta + "/api/fichas")
				.then((response) => {
                    this.loadingData = false
                    this.botonGuardarFicha=false
                    this.ficha = response.data
                    if(this.ficha != 0){
                        this.id_modalidad_usu=this.ficha[0].mcp_id_modalidad
                        this.id_ficha_usu=this.ficha[0].id
                        this.id_estado_usu=this.ficha[0].id_estado
                    }
                    //this.asignar(response.data)
				})
				.catch(function (error) {
                    this.loadingData = false
				    this.ficha = [];
				});
		},
        encodeid(id) {
        let codigo = btoa(id);
        return codigo;
    },
    },
    
};
</script>