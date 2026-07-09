<template>
    <div class="card mb-5 mb-xl-8">
		<!--begin::Header-->
		<div class="card-header border-0 pt-5">
			<h3 class="card-title align-items-start flex-column">
				<span class="card-label fw-bold fs-3 mb-1">Colegios</span>
				<span class="text-muted mt-1 fw-semibold fs-7">Visualizar datos de colegios</span>
			</h3>
		</div>
		<!--end::Header-->
		<!--begin::Body-->
		<div class="card-body py-3">
            <div class="input-group mb-5" style="display: block">
                <div class="row">
                    <div class="col-md-6">
                        <label for="inputNombresIE" class="">
                            Departamento
                        </label>
                        <select class="form-select" @change="obtenerProvincia()" v-model="colegio.id_deptamento" required="">
                            <option value="" hidden>Seleccione departamento</option>
                            <option v-for="item in departamentos" :key="item.id" :value="item.id">{{item.nombre}}</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="">
                            Provincia
                        </label>
                        <select class="form-select" @change="obtenerColegio()" v-model="colegio.provincia" required="">
                            <option value="" hidden>Seleccione Provincia</option>
                            <option v-for="item in provincias" :key="item.id" :value="item.nombre">{{item.nombre}}</option>
                        </select>
                    </div>
                    <div class="col-lg-12 mb-3">
                        <label class="">
                            Colegio
                        </label>
                        <!-- <select name="CboColegio" id="CboColegio" class="form-control" required="">
                                    <option value="" hidden>Selecione su colegio</option>
                                </select> -->
                        <!-- <v-select label="nombre" :options="colegios" :reduce="usuarios => usuarios.id" v-model="nuevoRegistro.colegio">
                                    <template #search="{attributes, events}">
                                        <input class="vs__search" :required="true" v-bind="attributes" v-on="events" />
                                    </template>
                                </v-select> -->
                        <v-select :options="colegios" :reduce="colegios => colegios.id" @input="datosColegios()" label="nombre" class="vs-select-custom" v-model="colegio.id">
                            <template #search="{attributes, events}">
                                <input class="vs__search" v-bind="attributes" v-on="events" />
                            </template>
                        </v-select>
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
                                <th>ID</th>
                                <th>COD MODULAR</th>
                                <th>NOMBRE</th>
                                <th>NIVEL</th>
                                <th>GÉNERO</th>
                                <th>GÉSTION</th>
                                <th>DIRECIÓN</th>
                                <th class="max-w-125px text-center rounded-end" style="width: 200px;">ESTADO</th>
                            </tr>
                        </thead>
                        <!--end::Table head-->
                        <!--begin::Table body-->
                        <tbody>
                            <tr v-for="(dato, index) in datos" :index="index" :key="dato.ID_COLEGIO"> 
                                <td class="ps-4">
                                   {{index+1}} 
                                </td>
                                <td>
                                    {{dato.ID_COLEGIO}}
                                </td>
                                <td>
                                    {{dato.COD_MOD}}
                                </td>
                                <td>
                                    {{dato.CEN_EDU}}
                                </td>
                                <td>
                                    {{dato.D_NIV_MOD}}
                                </td>
                                <td>
                                    {{dato.D_TIPSSEXO}}
                                </td>
                                <td>
                                    {{dato.D_GESTION}}
                                </td>
                                <td>
                                    {{dato.DIR_CEN}}
                                </td>
                                <td class="text-center">
                                    <span v-if="dato.D_ESTADO=='Activa'" class="badge badge-success">Activa</span>
                                    <span v-else-if="dato.D_ESTADO=='Inactiva'" class="badge badge-danger">Inactiva</span>
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
            botonCargando: false,
            datos: [],
            colegios:[],
            departamentos: [],
            provincias: [],
            colegio: {
                id: '',
                id_deptamento: '',
                provincia: ''
            }

        }
    },
    mounted() {
        this.obtenerDepartamentos()
    },
    methods: {
        async obtenerDepartamentos() {
			await axios
				.get(this.$parent.NombreRuta + "/api/departamentos")
				.then((response) => {
                    this.departamentos = response.data;
                    //this.asignar(response.data)
				})
				.catch(function (error) {
				    this.departamentos = [];
				});
		},
        async obtenerProvincias(codigoDep) {
            await axios.put(this.$parent.NombreRuta + "/api/provincias", {
                codigoDep: codigoDep,
            })
                .then(response => {
                    this.provincias = response.data;
                })
        },
        async obtenerColegios(provColegio) {
            await axios.put(this.$parent.NombreRuta + "/api/colegios", {
                provColegio: provColegio,
            })
                .then(response => {
                    this.colegios = response.data;
                })
        },
        async detallesColegio(id) {
			await axios
				.get(this.$parent.NombreRuta + "/api/colegios/" + id)
				.then((response) => {
                    let respuesta=[]
                    respuesta[0]=response.data.colegio
                    this.datos = respuesta;
                    //this.asignar(response.data)
				})
				.catch(function (error) {
				    this.datos = [];
				});
		},
        

        obtenerProvincia() {
            let codigoDep

            codigoDep = this.colegio.id_deptamento
            this.obtenerProvincias(codigoDep)

        },
        obtenerColegio() {
            let provColegio = 0
            provColegio = this.colegio.provincia
            this.obtenerColegios(provColegio)

        },
        datosColegios(){
            let id_colegio
            id_colegio=this.colegio.id
            console.log(id_colegio)
            this.detallesColegio(id_colegio)
        }
        

    },
}
</script>