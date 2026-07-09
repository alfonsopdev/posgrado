<template>
  <div>
    <!-- Filtros -->
    <div class = "row">
      <!-- Botón de filtrado por modalidades -->
      <div class="col-md-4 mb-5">
        <label>
          Modalidades
        </label>
        <select class="form-select" @change="buscar(1)" aria-label="Select example" v-model.number="filtros.modalidad"
          style="width: 100%;">
          <option value="0" style="font-weight: bold;">TODOS</option>
          <option value="1" style="font-weight: bold;">ORDINARIO</option>
          <option value="2" style="font-weight: bold;">EXTRAORDINARIO</option>   
         </select>
      </div>
      <!-- Botón de filtrado por Fechas     -->
      <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
        <label>
          FECHA INICIO
        </label>
        <input type="date" class="form-control m-input col-lg-10" @change="buscar(3)" v-model="filtros.desde"
          placeholder="Seleccione fecha" autocomplete="off">
      </div>
      <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
        <label>
          FECHA FINAL
        </label>
        <input type="date" class="form-control m-input col-lg-10" @change="buscar(3)" v-model="filtros.hasta"
          placeholder="Seleccione fecha" autocomplete="off">
      </div>
    </div>    
    <!-- Cuadro Estadístico por Fecha -->
    <div class="card card-bordered mb-5">
      <div class="card-header border-0 pt-5">
        <h3 class="card-title align-items-start flex-column">
          <span class="card-label fw-bold text-dark">Reporte por fecha</span>
        </h3>
      </div>
      <div class="card-body">
        <div id="kt_apexcharts_3" style="height: 350px"></div>
      </div>
    </div>
    <!-- Tabla de Reporte por Fechas -->
    <div class="card mb-5 mb-xl-8">
      <div class="card-header border-0 pt-5">
        <h3 class="card-title align-items-start flex-column">
          <span class="card-label fw-bold fs-3 mb-1">Reporte por modalidades</span>
        </h3>
      </div>
      <div class="card-body py-3">
        <div class="table-responsive">
          <table class="table table-row-bordered">
            <thead>
              <tr class="fw-bold fs-6 text-gray-800 text-muted bg-light">
                <th class="ps-4 rounded-start">Fecha</th>
                <th class="text-center">En Proceso</th>
                <th class="text-center">Inscritos</th>
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
              <tr v-else v-for="(dato, index) in estadisticafecha" :index="index" :key="index">
                <td class="ps-4">{{ dato.fecha }}</td>
                <td class="text-center">{{ dato.proceso }}</td>
                <td class="text-center">{{ dato.inscritos }}</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import axios from 'axios';
export default {
  data() {
    return {
      data: [],
      name: '',
      botonCargando: false,
      chart: '',
      estadisticafecha: [],
      options: {
        series: [{
          name: 'EN PROCESO',
          data: []
        }],
        chart: {
          height: 350,
          type: 'area',
          locales: [{
            name: 'en',
            options: {
              months: ['enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre'],
              shortMonths: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
              days: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
              shortDays: ['Lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sáb', 'Dom'],
              toolbar: {
                download: 'Download SVG',
                selection: 'Selection',
                selectionZoom: 'Selection Zoom',
                zoomIn: 'Zoom In',
                zoomOut: 'Zoom Out',
                pan: 'Panning',
                reset: 'Reset Zoom',
              }
            }
          }]
        },
        //Estilo de la linea
        dataLabels: {
          enabled: false
        },
        stroke: {
          curve: 'smooth'
        },
        //Estilo de la barra base
        xaxis: {
          type: 'datetime',
        },
        tooltip: {
          x: {
            format: 'dd/MM/yy HH:mm'
          },
        },
        // Leyenda arriba
        legend: {
          position: 'top'
        },
        theme: {
          mode: 'light',
          palette: 'palette1',
          monochrome: {
            enabled: false,
            color: '#255aee',
            shadeTo: themeMode,
            shadeIntensity: 0.65
          },
        },
      },
      filtros: {
        modalidad: 0,
        desde: '',
        hasta: ''
      },
    };
  },
  mounted() {
    //Mostrar datos en el gráfico
    // this.buscar();
    this.mostrarDatos();
    //Mostrar Gráfico
    this.mostrarGrafico();
    if (localStorage.kt_metronic_theme_mode_value) {
      this.themeMode = localStorage.kt_metronic_theme_mode_value;
    }
  },
  methods: {
    async mostrarDatos() {
      let modalidad = this.filtros.modalidad
      let desde = this.filtros.desde
      let hasta = this.filtros.hasta
      this.botonCargando = true,
        await axios
          .get(this.$parent.NombreRuta + "/api/reporte/fecha?modalidad=" + modalidad + '&desde=' + desde + '&hasta=' + hasta)
          .then((response) => {

          this.estadisticafecha = response.data.estadisticafecha;
            // Muestra todos los datos que se tiene en el gráfico
            // this.chart.updateSeries([{
            //   name: 'REGISTRADOS',
            //   data: response.data.canUsuariosDia
            // }])
            // Muestra los Datos de Proceso
            this.chart.updateSeries([{
              data: response.data.canProcesoDia
            }])
            //muestra los datos de inscritos
            this.chart.appendSeries({
              name: 'INSCRITOS',
              data: response.data.dia.canInscritosDia
            })
            //Tema de la paleta
            this.chart.updateOptions({
              theme: {
                mode: this.themeMode,
                palette: 'palette1',
                monochrome: {
                  shadeTo: this.themeMode,
                },
              },
            })
            this.botonCargando = false
          })
          .catch(function (error) {
            this.datos = [];
            this.botonCargando = false
          });
    },
    mostrarGrafico() {
      this.chart = new ApexCharts(document.getElementById('kt_apexcharts_3'), this.options);
      this.chart.render();
    },
    buscar(opcion) {
      switch (opcion) {
        case 0:
          this.filtros.modalidad = '',
          this.filtros.desde = '',
          this.filtros.hasta = ''
          break;
        case 1:
          this.filtros.dato = ''
          break;
        case 2:
          this.filtros.desde = '',
          this.filtros.hasta = ''
          break;
      }
      this.mostrarDatos()
    },
  },
};
</script>