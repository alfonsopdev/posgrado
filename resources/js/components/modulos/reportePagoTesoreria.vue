<style>

    .previewImg{
        overflow: hidden;
        position: relative;
        display: flex;
        justify-content: center;
        /* width: 100%;
        height: 407px;*/
    }
    .previewImg img{
        /*position: absolute;
         width: 100%;
        left: 50%;
        top: 50%; */

        transform: translate(0%, 0%);
        z-index: 10;
        pointer-events: none;
    }
    .zoom {
        /* transition: transform 0.2s; */
    }

    .zoom:hover {
        /* transform: scale(5.5); */
    }
</style>
<style>
.switch {
    position: relative;
    display: inline-block;
    width: 50px;
    height: 24px;
    text-align: center;
  }

  .switch input {
    opacity: 0;
    width: 0;
    height: 0;
  }

  .slider {
    position: absolute;
    cursor: pointer;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: #ccc;
    -webkit-transition: .4s;
    transition: .4s;
  }

  .slider:before {
    position: absolute;
    content: "";
    height: 16px;
    width: 16px;
    left: 4px;
    bottom: 4px;
    background-color: white;
    -webkit-transition: .4s;
    transition: .4s;
  }

  input:checked + .slider {
    background-color: #0B1D6F;
  }

  input:focus + .slider {
    box-shadow: 0 0 1px #0B1D6F;
  }

  input:checked + .slider:before {
    -webkit-transform: translateX(26px);
    -ms-transform: translateX(26px);
    transform: translateX(26px);
  }

  /* Rounded sliders */
  .slider.round {
    border-radius: 34px;
  }

  .slider.round:before {
    border-radius: 50%;
  }
</style>
<template>
    <div class="card mb-5 mb-xl-8">
		<div class="card-header border-0 pt-5">
			<h3 class="card-title align-items-start flex-column">
				<span class="card-label fw-bold fs-3 mb-1">Pagos admisión</span>
				<span class="text-muted mt-1 fw-semibold fs-7">Valida los pagos por ambos conceptos</span>
			</h3>
		</div>
		<div class="card-body py-3">
            <div class="input-group mb-5" style="display: block">
                <div class="row">
                    <!-- <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                        <label>
                            Filtro Fecha
                        </label>
                        <input type="date" class="form-control m-input col-lg-10" @change="buscar(0)"
                            v-model="filtros.fecha"
                            >
                    </div> -->
                    <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                        <label>
                            Estados
                        </label>
                        <select class="form-select" @change="buscar(1)" aria-label="Select example" v-model.number="filtros.estado">
                            <option value="">TODOS</option>
                            <option value="0">SIN ENVIAR</option> 
                            <option value="1">PENDIENTE</option> 
                            <option value="2">RECHAZADO</option> 
                            <option value="3">VALIDADO</option>
                        </select> 
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                        <label>
                            Actualizar
                        </label><br>
                        <button class="btn btn-sm btn-warning btn-icon" @click="buscar(0)">
                            <i class="fa-solid fa-arrows-rotate"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table align-middle gs-0 gy-4">
                    <thead>
                        <tr class="fw-bold text-muted bg-light">
                            <th class="ps-4 rounded-start">N°</th>
                            <th>Fecha Enviado</th>
                            <th>Postulante</th>
                            <th>Cuenta pago</th>
                            <th>Fecha pago</th>
                            <th>Monto pago</th>
                            <th>Codigo pago</th>
                            <th>Comentar</th>
                            <th>Voucher</th>
                            <th>Revisado</th>
                        </tr>
                    </thead>
                    <tbody v-if="datos.length > 0">
                        <tr v-for = "(dato, index) in datos" :index="index" :key="dato.id">
                            <td class="ps-4">
                                {{index+1}}
                            </td>
                            <td class="ps-4">
                                {{ dato.fecha_enviado }}
                            </td>
                            <td>
                                {{dato.nombre + ' ' + dato.apellido_paterno + ' ' + dato.apellido_materno}}
                            </td>
                            <td>
                                <span v-if="dato.cuenta_pago==1" class="badge badge-success">Banco Interbank</span>
                                <span v-else-if="dato.cuenta_pago==2" class="badge badge-danger">Banco de la Nación</span>
                                <span v-else-if="dato.cuenta_pago==3" class="badge badge-warning">Tesoreria UNDC</span>
                            </td>
                            <td>
                                {{formato_fecha(dato.fecha_pago)}}
                            </td>
                            <td>
                                {{dato.monto_pago}}
                            </td>
                            <td>
                                <input v-if="dato.id_estado_revision==1" class="" v-model="dato.codigo_pago" type="text" required style="width:100px"/>
                                <span v-else>{{dato.codigo_pago}}</span>
                            </td>
                            <td>
                                <a v-if="dato.comentario == 0"  class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1" @click.prevent="abrirModal(dato)"
                                data-bs-toggle="modal" data-bs-target="#mdl_add_comen">
									<i class="fa fa-comment"></i>
								</a>
                                <a v-else class="btn btn-icon btn-bg-danger btn-text-color-white btn-color-white btn-active-color-primary btn-sm me-1" @click.prevent="abrirModal(dato)"
                                data-bs-toggle="modal" data-bs-target="#mdl_add_comen">
                                    <i class="fa-solid fa-comments"></i>
								</a>
                            </td>
                            <td>
                                <a if :href="$parent.NombreRuta + '/storage/pagos/'+dato.enlace" target="_blank"
                                    class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
									<i class="fa fa-file-pdf"></i>
								</a>
                            </td>
                            <td class="text-center">
                                <label class="switch" v-if="dato.teso_rev == 1" @click.prevent="teso_verificar(dato.id,'0')">
                                    <input type="checkbox" checked >
                                    <span class="slider round"></span>
                                </label>
                                <label v-else class="switch" @click.prevent="teso_verificar(dato.id,'1')">
                                    <input type="checkbox" >
                                    <span class="slider round"></span>
                                </label>
                            </td>
                        </tr>
                    </tbody>
                    <tbody v-else>
                        <tr>
                            <td colspan="11" class="text-center">No se encontraron datos</td>
                        </tr>
                    </tbody>
                </table>
            </div>
		</div>
        <!-- MODAL: AGREGAR COMENTARIO -->
        <div class="modal fade" tabindex="-1" id="mdl_add_comen">
            <div class="modal-dialog modal-md">
                <form class="modal-content" action="#" @submit.prevent="guardarComentario()">
                    <div class="modal-header">
                        <h3 class="modal-title">Comentario</h3>
                        <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                            <span class="svg-icon svg-icon-1"></span>
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Comentario</label>
                            <!-- <input class="form-control" v-model="mdComent.observacion"> -->
                            <textarea class="form-control" rows="4" cols="10" v-model="mdComent.observacion">{{ mdComent.observacion }}</textarea>
                            <input hidden v-model="mdComent.id">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    name:'ventaProspecto',
	data() {
        var toDay = new Date();
        let yy = toDay.getFullYear();
        let mm = toDay.getMonth()>9 ? `` :`0`+parseInt(toDay.getMonth()+1);
        let dd = toDay.getDate();
        var hoy =  `${yy}-${mm}-${dd}`;
		return {
			datos:[],
            botonCargando: false,
			//MODAL REGISTER:1 MODAL EDIT:0
			tipoModal:1,
			csrfToken: null,
            filtros: {
                estado: 1,
                fecha:hoy,
                dato:''
            },
            mdComent:{
                id :'',
                observacion:''
            }
		}
	},
    methods: {
        async mostrarDatos() {
            // this.botonCargando=true
            let estado = this.filtros.estado
            let fecha = this.filtros.fecha
			await axios
				.get(this.$parent.NombreRuta + "/api/pagos/vouchers?tipo=3&estado="+estado)
				// .get(this.$parent.NombreRuta + "/api/pagos/vouchers?tipo=3&estado="+estado+"&fecha="+fecha)
				.then((response) => {
				    this.datos = response.data;
				})
				.catch(function (error) {
				    this.datos = [];
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
        ver(id){
            const found = this.datos.find(element => element.id == id);
            /* this.id_ficha = found.id
            this.id_usu = found.user_id */
            this.verRegistro = Object.assign({}, found);
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
        formato_fecha(fecha){
            if (fecha.length != 10) {
                return 'Fecha no valida';
            }
            let frmt_fec = fecha.split("-")
            return frmt_fec[2]+'/'+frmt_fec[1]+'/'+frmt_fec[0];
        },
        abrirModal(dato){
			// this.mdComent = Object.assign({}, dato)
            this.mdComent.id = dato.id
            this.mdComent.observacion = dato.observacion
        },
        async guardarComentario(){
            await axios.put(this.$parent.NombreRuta + "/api/pagos/tesoreria/comentar", {
                    'id_pago':this.mdComent.id,
			        'observacion':this.mdComent.observacion
            }).then((response) => {
                if(response.data.success == 1){
                    toastr.options = {
                        "positionClass": "toastr-bottom-right",
                        "timeOut": "5000"
                    };
                    this.buscar(0)
                    toastr.success('Comentario registrado correctamente');
                }else if(response.data.success == 0){
                    toastr.options = {
                        "positionClass": "toastr-bottom-right",
                        "timeOut": "5000"
                    };
                    toastr.error('Error comentario no registrdo');
                }
            });
        },
        async teso_verificar(id_pago,accion){
            await axios.post(this.$parent.NombreRuta + "/api/pagos/tesoreria/revisar", {
                    'id_pago':id_pago,
			        'teso_rev':accion,
            }).then((response) => {
                if(response.data.success == 1){
                    toastr.options = {
                        "positionClass": "toastr-bottom-right",
                        "timeOut": "5000"
                    };
                    this.buscar(0)
                    toastr.success('Registrado correctamente');
                }else if(response.data.success == 0){
                    toastr.options = {
                        "positionClass": "toastr-bottom-right",
                        "timeOut": "5000"
                    };
                    toastr.error('Error no registrdo');
                }
            });
        },
    },
    mounted : function(){
        this.buscar(0)
    }
}
</script>
