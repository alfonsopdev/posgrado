<template>
  <div>
    <div v-if="is('Postulante')" class="row g-5 g-xl-8">
      <div class="col-xl-12">
        <div v-if="msgCelular != ''" class="alert alert-warning" role="alert">
          {{ msgCelular }}
        </div>

        <div v-if="cargando" class="text-center p-5">Cargando información del proceso...</div>

        <div v-else-if="errorCarga" class="alert alert-danger">{{ errorCarga }}</div>

        <template v-else>

          <!-- CASO: no hay proceso configurado -->
          <div v-if="estadoProceso === 'sin_proceso'" class="alert bg-secondary text-light p-5 mb-10">
            <h4 class="mb-2 text-light">No hay un proceso de admisión activo</h4>
            <span>Por el momento no hay convocatorias abiertas. Vuelve a revisar más adelante.</span>
          </div>

          <!-- CASO: el plazo ya venció -->
          <div v-else-if="estadoProceso === 'vencido'" class="alert bg-danger d-flex flex-column flex-sm-row w-100 p-5 mb-10">
            <span class="svg-icon svg-icon-2hx svg-icon-light me-4 mb-5 mb-sm-0">
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path opacity="0.3"
                  d="M12 22C6.5 22 2 17.5 2 12S6.5 2 12 2s10 4.5 10 10-4.5 10-10 10z"
                  fill="currentColor" />
                <rect x="11" y="6" width="2" height="8" rx="1" fill="currentColor" />
                <rect x="11" y="15" width="2" height="2" rx="1" fill="currentColor" />
              </svg>
            </span>
            <div class="d-flex flex-column text-light pe-0 pe-sm-10">
              <h4 class="mb-2 text-light">Plazo de inscripción vencido</h4>
              <span>El periodo de inscripción para {{ proceso.nombre }} ha finalizado.</span>
              <span>Cierre de inscripción: {{ formatearFecha(proceso.fecFin_inscripcion) }}</span>
              <span>Si tienes dudas, comunícate con la Escuela de Posgrado.</span>
            </div>
          </div>

          <!-- CASO: aún no inicia -->
          <div v-else-if="estadoProceso === 'no_iniciado'" class="alert bg-info d-flex flex-column flex-sm-row w-100 p-5 mb-10">
            <span class="svg-icon svg-icon-2hx svg-icon-light me-4 mb-5 mb-sm-0">
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path opacity="0.3"
                  d="M19 22H5C4.4 22 4 21.6 4 21V3C4 2.4 4.4 2 5 2H14L20 8V21C20 21.6 19.6 22 19 22ZM12.5 18C12.5 17.4 12.6 17.5 12 17.5H8.5C7.9 17.5 8 17.4 8 18C8 18.6 7.9 18.5 8.5 18.5L12 18C12.6 18 12.5 18.6 12.5 18ZM16.5 13C16.5 12.4 16.6 12.5 16 12.5H8.5C7.9 12.5 8 12.4 8 13C8 13.6 7.9 13.5 8.5 13.5H15.5C16.1 13.5 16.5 13.6 16.5 13ZM12.5 8C12.5 7.4 12.6 7.5 12 7.5H8C7.4 7.5 7.5 7.4 7.5 8C7.5 8.6 7.4 8.5 8 8.5H12C12.6 8.5 12.5 8.6 12.5 8Z"
                  fill="currentColor" />
                <rect x="7" y="17" width="6" height="2" rx="1" fill="currentColor" />
                <rect x="7" y="12" width="10" height="2" rx="1" fill="currentColor" />
                <rect x="7" y="7" width="6" height="2" rx="1" fill="currentColor" />
                <path d="M15 8H20L14 2V7C14 7.6 14.4 8 15 8Z" fill="currentColor" />
              </svg>
            </span>
            <div class="d-flex flex-column text-light pe-0 pe-sm-10">
              <h4 class="mb-2 text-light">Próxima convocatoria: {{ proceso.nombre }}</h4>
              <span>Las inscripciones se abrirán el {{ formatearFecha(proceso.fecIni_inscripcion) }}</span>
              <span>Examen: {{ formatearFecha(proceso.fecha_examen) }}</span>
            </div>
          </div>

          <!-- CASO: vigente -->
          <template v-else-if="estadoProceso === 'vigente'">

            <div>
              <!--begin::Statistics Widget 5-->
              <a href="https://forms.gle/2YPLhwttC4aNTRef8" class="card bg-primary hoverable card-xl-stretch mb-xl-8"
                target="_blank">

              </a>
              <!--end::Statistics Widget 5-->
            </div>

            <!-- Cuadro de aviso Inscripciones abiertas -->
            <div>
              <div class="alert alert-dismissible bg-success d-flex flex-column flex-sm-row w-100 p-5 mb-10">
                <span class="svg-icon svg-icon-2hx svg-icon-light me-4 mb-5 mb-sm-0">
                  <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path opacity="0.3"
                      d="M19 22H5C4.4 22 4 21.6 4 21V3C4 2.4 4.4 2 5 2H14L20 8V21C20 21.6 19.6 22 19 22ZM12.5 18C12.5 17.4 12.6 17.5 12 17.5H8.5C7.9 17.5 8 17.4 8 18C8 18.6 7.9 18.5 8.5 18.5L12 18C12.6 18 12.5 18.6 12.5 18ZM16.5 13C16.5 12.4 16.6 12.5 16 12.5H8.5C7.9 12.5 8 12.4 8 13C8 13.6 7.9 13.5 8.5 13.5H15.5C16.1 13.5 16.5 13.6 16.5 13ZM12.5 8C12.5 7.4 12.6 7.5 12 7.5H8C7.4 7.5 7.5 7.4 7.5 8C7.5 8.6 7.4 8.5 8 8.5H12C12.6 8.5 12.5 8.6 12.5 8Z"
                      fill="currentColor" />
                    <rect x="7" y="17" width="6" height="2" rx="1" fill="currentColor" />
                    <rect x="7" y="12" width="10" height="2" rx="1" fill="currentColor" />
                    <rect x="7" y="7" width="6" height="2" rx="1" fill="currentColor" />
                    <path d="M15 8H20L14 2V7C14 7.6 14.4 8 15 8Z" fill="currentColor" />
                  </svg>
                </span>
                <div class="d-flex flex-column text-light pe-0 pe-sm-10">
                  <h4 class="mb-2 text-light">Inscripciones Abiertas</h4>
                  <span>Examen de admisión de la Escuela de Posgrado: {{ proceso.nombre }}</span>
                  <span>Inscripción: {{ formatearRangoInscripcion(proceso.fecIni_inscripcion, proceso.fecFin_inscripcion) }}</span>
                  <span>Examen: {{ formatearFecha(proceso.fecha_examen) }}</span>
                </div>
                <button type="button"
                  class="position-absolute position-sm-relative m-2 m-sm-0 top-0 end-0 btn btn-icon ms-sm-auto"
                  data-bs-dismiss="alert">

                  <span class="svg-icon svg-icon-2x svg-icon-light">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)"
                        fill="currentColor"></rect>
                      <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)"
                        fill="currentColor"></rect>
                    </svg>
                  </span>
                </button>
              </div>

            </div>

            <div>
              <router-link to="/pagos">
                <div class="alert alert-dismissible bg-warning d-flex flex-column flex-sm-row w-100 p-5 mb-10">
                  <span class="svg-icon svg-icon-2hx svg-icon-light me-4 mb-5 mb-sm-0">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path opacity="0.3"
                        d="M19 22H5C4.4 22 4 21.6 4 21V3C4 2.4 4.4 2 5 2H14L20 8V21C20 21.6 19.6 22 19 22ZM12.5 18C12.5 17.4 12.6 17.5 12 17.5H8.5C7.9 17.5 8 17.4 8 18C8 18.6 7.9 18.5 8.5 18.5L12 18C12.6 18 12.5 18.6 12.5 18ZM16.5 13C16.5 12.4 16.6 12.5 16 12.5H8.5C7.9 12.5 8 12.4 8 13C8 13.6 7.9 13.5 8.5 13.5H15.5C16.1 13.5 16.5 13.6 16.5 13ZM12.5 8C12.5 7.4 12.6 7.5 12 7.5H8C7.4 7.5 7.5 7.4 7.5 8C7.5 8.6 7.4 8.5 8 8.5H12C12.6 8.5 12.5 8.6 12.5 8Z"
                        fill="currentColor" />
                      <rect x="7" y="17" width="6" height="2" rx="1" fill="currentColor" />
                      <rect x="7" y="12" width="10" height="2" rx="1" fill="currentColor" />
                      <rect x="7" y="7" width="6" height="2" rx="1" fill="currentColor" />
                      <path d="M15 8H20L14 2V7C14 7.6 14.4 8 15 8Z" fill="currentColor" />
                    </svg>
                  </span>
                  <div class="d-flex flex-column text-light pe-0 pe-sm-10">
                    <h4 class="mb-2 text-light">Realiza el pago de S/. 350 que incluye:</h4>
                    <ul>
                      <li><strong>Derecho de inscripción al examen de admisión:</strong> S/. 300</li>
                      <li><strong>Prospecto de admisión:</strong> S/. 50</li>
                    </ul>
                    <p>En cualquiera de las cuentas corrientes de la Universidad Nacional de Cañete:</p>
                    <ul>
                      <li><strong>Banco de la Nación:</strong> N° 00571-028409 (agente o ventanilla).</li>
                      <li><strong>Banco Interbank:</strong> N° 401 3004 5278 40 (agente o ventanilla).</li>
                    </ul>
                    <p><em>NOTA: Tomar una fotografía del voucher de pago respectivo.</em></p>

                  </div>
                  <button type="button"
                    class="position-absolute position-sm-relative m-2 m-sm-0 top-0 end-0 btn btn-icon ms-sm-auto"
                    data-bs-dismiss="alert">

                    <span class="svg-icon svg-icon-2x svg-icon-light">
                      <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)"
                          fill="currentColor"></rect>
                        <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)"
                          fill="currentColor"></rect>
                      </svg>
                    </span>
                  </button>
                </div>
              </router-link>
            </div>
            <!-- Cuadro de redirección hacia el modulo de inscripcion -->

          </template>

        </template>

      </div>
      <div v-if="estadoProceso === 'vigente'" class="d-flex justify-content-end">
        <router-link to="/pagos" class="btn btn-primary">Siguiente <i class="bi bi-arrow-right fs-2"></i></router-link>
      </div>
    </div>
    <div v-if="is('Administrador') || is('Comision') || is('Colaborador')" class="row g-5 g-xl-8">
      <div class="row g-5 g-xl-8">
        <div v-if="msgCelular != ''" class="alert alert-warning" role="alert">
          {{ msgCelular }}
        </div>
        <h1>{{ proceso.nombre }}</h1>



      </div>
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      datos: [],
      msgCelular: '',
      proceso: null,
      cargando: true,
      errorCarga: null
    }
  },
  computed: {
    estadoProceso() {
      if (!this.proceso) return 'sin_proceso';

      const hoy = new Date();
      hoy.setHours(0, 0, 0, 0);

      const inicioInscripcion = new Date(this.proceso.fecIni_inscripcion + 'T00:00:00');
      const finInscripcion = new Date(this.proceso.fecFin_inscripcion + 'T00:00:00');

      if (hoy < inicioInscripcion) return 'no_iniciado';
      if (hoy > finInscripcion) return 'vencido';
      return 'vigente';
    }
  },
  mounted() {
    this.verificardispositivo();
    this.cargarProcesoActivo();
  },
  methods: {
    verificardispositivo() {
      let navegador = navigator.userAgent;
      if (navigator.userAgent.match(/Android/i) || navigator.userAgent.match(/webOS/i) || navigator.userAgent.match(/iPhone/i) || navigator.userAgent.match(/iPad/i) || navigator.userAgent.match(/iPod/i) || navigator.userAgent.match(/BlackBerry/i) || navigator.userAgent.match(/Windows Phone/i)) {

        this.msgCelular = 'Para abrir el menú de navegación de click en el icono de la esquina superior izquierda';

      } else {
        console.log("No estás usando un móvil");
      }
    },
    async cargarProcesoActivo() {
      this.cargando = true;
      this.errorCarga = null;
      try {
        const res = await axios.get(this.$parent.NombreRuta + '/api/procesos-admision/activo');
        this.proceso = res.data.data;
      } catch (e) {
        this.errorCarga = e.response?.data?.message || 'Ocurrió un error al conectar con el servidor.';
      } finally {
        this.cargando = false;
      }
    },
    formatearFecha(fecha) {
      if (!fecha) return '';
      const opciones = { day: 'numeric', month: 'long', year: 'numeric' };
      return new Date(fecha + 'T00:00:00').toLocaleDateString('es-PE', opciones);
    },
    formatearRangoInscripcion(inicio, fin) {
      if (!inicio || !fin) return '';
      const d1 = new Date(inicio + 'T00:00:00');
      const d2 = new Date(fin + 'T00:00:00');
      const dia1 = d1.getDate();
      const dia2 = d2.getDate();
      const mesAnio = d2.toLocaleDateString('es-PE', { month: 'long', year: 'numeric' });
      return `Del ${dia1} al ${dia2} de ${mesAnio}`;
    }
  }
};
</script>