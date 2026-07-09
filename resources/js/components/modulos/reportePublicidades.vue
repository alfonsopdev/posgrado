<template>
    <div>
        <div class="card mb-5 mb-xl-8">
            <div class="card-header border-0 pt-5">
                <h3 class="card-title align-items-start flex-column">
                <span class="card-label fw-bold fs-3 mb-1">Reporte de publicidad</span>
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
                                <option value="1">Ordinario</option>
                                <option value="2">
                                    Extraordinario
                                </option>
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
                                <option value="11">
                                    Quinto de Secundaria
                                </option>-->
                            </select> 
                        </div>
                    </div>
                <div class="table-responsive">
                    <table class="table table-row-bordered">
                        <thead>
                        <tr class="fw-bold fs-6 text-gray-800 text-muted bg-light">
                            <th class="ps-4 rounded-start">N°</th>
                            <th class="text-center">Publicidad</th>
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
                        <tr v-else v-for="(dato, index) in data" :index="index" :key="index">
                            <td class="ps-4">{{ index + 1 }}</td>
                            <td class="text-center">{{ dato.x }}</td>
                            <td class="text-center">
                            {{ dato.y }}
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="card card-bordered mb-5">
        <div class="card-header border-0 pt-5">
            <h3 class="card-title align-items-start flex-column">            
                <span class="card-label fw-bold text-dark">Reporte de publicidad</span>
            </h3>
        </div>
        <div class="card-body">
            <div id="kt_apexcharts_1" style="height: 350px;"></div>
        </div>
        </div>
    </div>
</template>
<script>
export default {
    data() {
        return {
            data: [],
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
                    height: 350
                },
                xaxis: {
                    labels: {
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
                carrera: '',
                modalidad: 1,
                estado: 1,
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
    },
    methods: {
        async mostrarDatos() {
            let modalidad = this.filtros.modalidad
            let carrera = this.filtros.carrera
            this.botonCargando= true,
            await axios
                .get(this.$parent.NombreRuta + "/api/reporte/publicidad?modalidad="+modalidad)
                .then((response) => {
                this.data = response.data.publicidad;
                this.chart.updateSeries([{
                    data: response.data.publicidad
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
  }
}
</script>