<template>
    <div>
        <div class="card mb-5 mb-xl-8">
            <div class="card-header border-0 pt-5">
                <h3 class="card-title align-items-start flex-column">
                <span class="card-label fw-bold fs-3 mb-1">Reporte por distritos</span>
                </h3>
            </div>
            <div class="card-body py-3">
                <div class="input-group mb-5">
                    
                </div>
                <div class="row">
                     
                    <div class="col-md-4 mb-5">
                            <label>
                                Modalidades
                            </label>
                            <select class="form-select" @change="buscar(1)" aria-label="Select example" v-model.number="filtros.modalidad" style="width: 100%;">
                                <option value="0">TODOS</option>
                                <option value="1">ORDINARIO</option>
                                <option value="2">EXTRAORDINARIO</option>
                                <!--<option value="3">
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
                                <option value="11">Quinto de Secundaria</option>-->
                            </select> 
                        </div>
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
                    </div>
                <div class="table-responsive">
                    <table class="table table-row-bordered">
                        <thead>
                        <tr class="fw-bold fs-6 text-gray-800 text-muted bg-light">
                            <th class="ps-4 rounded-start">N°</th>
                            <!-- <th class="text-center">Modalidad</th> -->
                            <th class="text-center">Distrito</th>
                            <th class="text-center rounded-end">Cantidad</th>
                            
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-if="botonCargando">
                            <td colspan="4" class="text-center">
                                <div class="spinner-border text-primary" role="status">
                                    <span class="sr-only">Loading...</span>
                                </div>
                            </td>
                        </tr>
                        <tr v-else-if="data.length === 0">
                            <td colspan="4" class="text-center text-muted">
                                No se encontraron registros con los filtros seleccionados.
                            </td>
                        </tr>
                        <tr v-else v-for="(dato, index) in data" :index="index" :key="index">
                            <td class="text-center">{{ index + 1 }}</td>
                             <td class="text-center">{{ dato.x }}</td>
                            <td class="text-center">{{ dato.y }}</td>
                        </tr>
                        </tbody>
                        <tfoot>
                            <tr class="fw-bold bg-light">
                                <td colspan="3" class="text-center">TOTAL GENERAL:</td>
                                <td class="text-center">{{ totalRegistros }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
        <div class="card card-bordered mb-5">
        <div class="card-header border-0 pt-5">
            <!--begin::Title-->
            <h3 class="card-title align-items-start flex-column">            
                <span class="card-label fw-bold text-dark">Reporte por distritos</span>
                <!-- <span class="text-gray-400 mt-1 fw-semibold fs-6">1,046 Inbound Calls today</span> -->
            </h3>
            <!--end::Title-->  
        </div>
        <div class="card-body">
            <div id="kt_apexcharts_1" style="height: 1200px;"></div>
        </div>
        </div>
    </div>
</template>
<script>
export default {
    data() {
        return {
            data: [],
            carreras: [],
            name: '',
            botonCargando: false,
            themeMode: '',
            chart: '',
            options : {
                series: [{
                    name: 'POSTULANTES',
                    data: []
                }],
                chart: {
                    type: 'bar',
                    height: 1200
                },
                plotOptions: {
                bar: {
                    horizontal: true,
                    columnWidth: '55%',
                    endingShape: 'rounded'
                },
                },
                xaxis: {
                    labels: {
                        /**/ 
                        rotate: 0,
                        trim: true,
                        style: {
                            fontSize: '9spx',
                        } 
                    } 
                }, 
                yaxis: {
                title: {
                    text: 'CANTIDAD'
                }
                },
            },
            filtros: {
                carrera: 0,
                modalidad: 0,
                estado: 1,
                provincia:'',
                dato:''
            },

        }
    },
    mounted() {
        if (localStorage.kt_metronic_theme_mode_value) {
        this.themeMode = localStorage.kt_metronic_theme_mode_value;
        }
        this.mostrarDatos();
        this.mostrarGrafico();
        this.obtnerCarreras();
        
    },
    computed: {
        totalRegistros() {
            // Usamos reduce para sumar todos los valores de 'y' en el array data
            return this.data.reduce((sum, dato) => sum + parseInt(dato.y), 0);
        }
    },
    methods: {
        async mostrarDatos() {
            let modalidad = this.filtros.modalidad
            let carrera = this.filtros.carrera
            let provincia = this.filtros.provincia
            this.botonCargando= true,
            await axios
                .get(this.$parent.NombreRuta + "/api/reporte/distrito?id_provincia="+provincia+"&carrera="+carrera+"&modalidad="+modalidad)
                .then((response) => {
                this.data = response.data.distrito;
                this.chart.updateSeries([{
                    data: response.data.distrito
                }])
                this.chart.updateOptions({
                    theme: {
                    mode: this.themeMode, 
                    palette: 'palette1', 
                    monochrome: {
                        shadeTo: this.themeMode,
                    },
                    },
                })
                
                this.botonCargando= false
                })
                .catch(function (error) {
                this.datos = [];
                this.botonCargando= false
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
        mostrarGrafico(){
            this.chart = new ApexCharts(document.getElementById('kt_apexcharts_1'), this.options);
            this.chart.render();
        },
        buscar(opcion) {
            switch (opcion) {
                case 0:
                    this.filtros.dato = '',
                    this.filtros.modalidad = '',
                    this.filtros.carrera = '',
                    this.filtros.estado = ''
                    break;
                case 1:
                    this.filtros.dato = ''
                    break;
                case 2:
                    this.filtros.modalidad = '',
                    this.filtros.carrera = '',
                    this.filtros.estado = ''
                    break;
            }
            this.mostrarDatos()
        },
    },
    beforeMount() {
    this.$root.$on('send', data => {
      this.themeMode = data;
      this.chart.updateOptions({
      theme: {
        mode: data, 
        palette: 'palette1', 
        monochrome: {
            shadeTo: data,
          },
        },
      })
    });
  },
   
}
</script>