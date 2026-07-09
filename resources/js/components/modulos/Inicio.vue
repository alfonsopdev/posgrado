<template>
  <div>
    <div v-if="is('Postulante')" class="row g-5 g-xl-8">
      <div class="col-xl-12">
        <div v-if="msgCelular != ''" class="alert alert-warning" role="alert">
          {{ msgCelular }}
        </div>
        <div>
          <!--begin::Statistics Widget 5-->
          <a href="https://forms.gle/2YPLhwttC4aNTRef8" class="card bg-primary hoverable card-xl-stretch mb-xl-8"
            target="_blank">
            <!--begin::Body-->
            <!--<div class="card-body">-->
            <!--begin::Svg Icon | path: icons/duotune/ecommerce/ecm008.svg-->
            <!--<span class="svg-icon svg-icon-white svg-icon-3x ms-n1">
                <svg width="24" height="24"  viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <rect x="8" y="9" width="3" height="10" rx="1.5" fill="currentColor" ></rect>
                  <rect opacity="0.5" x="13" y="5" width="3" height="14" rx="1.5" fill="currentColor" ></rect>
                  <rect x="18" y="11" width="3" height="8" rx="1.5" fill="currentColor" ></rect>
                  <rect x="3" y="13" width="3" height="6" rx="1.5" fill="currentColor" ></rect>
                </svg>
              </span>-->
            <!--end::Svg Icon-->
            <!--<div class="text-white fw-bold fs-2 mb-2 mt-5">
                ENCUESTA: ¿Que nueva carrera te gustaría que tenga la UNDC?
              </div>
              <div class="fw-semibold text-white">
                Ayudanos a saber tu opinión respondiendo la encuesta
              </div>-->
            <!--</div>-->
            <!--end::Body-->
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
              <span>Examen de admision de la Escuela de Posgrado</span>
              <span> Inscripcion: Del 18 al 22 de mayo del 2026</span>
              <span> Examen: Domingo 24 de mayo del 2026 </span>
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
        <!-- Cuadro de aviso sin redirección para aviso de inscripciones Cerradas -->
        <!-- <div>
          <div class="alert alert-dismissible bg-danger d-flex flex-column flex-sm-row w-100 p-5 mb-10">
            
            <span class="svg-icon svg-icon-2hx svg-icon-light me-4 mb-5 mb-sm-0">
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path opacity="0.3" d="M19 22H5C4.4 22 4 21.6 4 21V3C4 2.4 4.4 2 5 2H14L20 8V21C20 21.6 19.6 22 19 22ZM12.5 18C12.5 17.4 12.6 17.5 12 17.5H8.5C7.9 17.5 8 17.4 8 18C8 18.6 7.9 18.5 8.5 18.5L12 18C12.6 18 12.5 18.6 12.5 18ZM16.5 13C16.5 12.4 16.6 12.5 16 12.5H8.5C7.9 12.5 8 12.4 8 13C8 13.6 7.9 13.5 8.5 13.5H15.5C16.1 13.5 16.5 13.6 16.5 13ZM12.5 8C12.5 7.4 12.6 7.5 12 7.5H8C7.4 7.5 7.5 7.4 7.5 8C7.5 8.6 7.4 8.5 8 8.5H12C12.6 8.5 12.5 8.6 12.5 8Z" fill="currentColor"/>
                <rect x="7" y="17" width="6" height="2" rx="1" fill="currentColor"/>
                <rect x="7" y="12" width="10" height="2" rx="1" fill="currentColor"/>
                <rect x="7" y="7" width="6" height="2" rx="1" fill="currentColor"/>
                <path d="M15 8H20L14 2V7C14 7.6 14.4 8 15 8Z" fill="currentColor"/>
              </svg>
            </span>
            
            <div class="d-flex flex-column text-light pe-0 pe-sm-10">
              <h4 class="mb-2 text-light">Inscripciones Cerradas</h4>
              <span>
                Las Inscripciones para el Examen de Quinto de Secundaria han sido cerradas
              </span>
            </div>
            
            <button
              type="button"
              class="position-absolute position-sm-relative m-2 m-sm-0 top-0 end-0 btn btn-icon ms-sm-auto"
              data-bs-dismiss="alert"
            >
              <span class="svg-icon svg-icon-2x svg-icon-light">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor"></rect>
                  <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="currentColor"></rect>
                </svg>
              </span>
            </button>
          </div>
          
        </div> -->
        <!-- Cuadro de aviso sin redirección para postulantes inscritos -->
        <!-- <div>
          <div class="alert alert-dismissible bg-success d-flex flex-column flex-sm-row w-100 p-5 mb-10"> -->
        <!--begin::Icon-->
        <!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
        <!-- <span class="svg-icon svg-icon-2hx svg-icon-light me-4 mb-5 mb-sm-0">
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path opacity="0.3"
                  d="M19 22H5C4.4 22 4 21.6 4 21V3C4 2.4 4.4 2 5 2H14L20 8V21C20 21.6 19.6 22 19 22ZM12.5 18C12.5 17.4 12.6 17.5 12 17.5H8.5C7.9 17.5 8 17.4 8 18C8 18.6 7.9 18.5 8.5 18.5L12 18C12.6 18 12.5 18.6 12.5 18ZM16.5 13C16.5 12.4 16.6 12.5 16 12.5H8.5C7.9 12.5 8 12.4 8 13C8 13.6 7.9 13.5 8.5 13.5H15.5C16.1 13.5 16.5 13.6 16.5 13ZM12.5 8C12.5 7.4 12.6 7.5 12 7.5H8C7.4 7.5 7.5 7.4 7.5 8C7.5 8.6 7.4 8.5 8 8.5H12C12.6 8.5 12.5 8.6 12.5 8Z"
                  fill="currentColor" />
                <rect x="7" y="17" width="6" height="2" rx="1" fill="currentColor" />
                <rect x="7" y="12" width="10" height="2" rx="1" fill="currentColor" />
                <rect x="7" y="7" width="6" height="2" rx="1" fill="currentColor" />
                <path d="M15 8H20L14 2V7C14 7.6 14.4 8 15 8Z" fill="currentColor" />
              </svg>
            </span> -->
        <!--end::Svg Icon-->
        <!--end::Icon-->

        <!--begin::Content-->
        <!--end::Content-->
        <!--begin::Close-->
        <!-- <button type="button"
              class="position-absolute position-sm-relative m-2 m-sm-0 top-0 end-0 btn btn-icon ms-sm-auto"
              data-bs-dismiss="alert"> -->
        <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
        <!-- <span class="svg-icon svg-icon-2x svg-icon-light">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)"
                    fill="currentColor"></rect>
                  <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)"
                    fill="currentColor"></rect>
                </svg>
              </span> -->
        <!--end::Svg Icon-->
        <!-- </button> -->
        <!--end::Close-->
        <!-- </div>

        </div> -->
        <!-- Cuadro de redirección hacia el modulo de pagos -->
        <!-- Cuadro de redirección hacia el modulo de pagos -->
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
                <!-- <span>DERECHO DE EXAMEN</span>
                <span>Colegio Público: S/.250.00</span>
                <span>Colegio Privado: S/.300.00</span> -->
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

      </div>
      <div class="d-flex justify-content-end">
        <router-link to="/pagos" class="btn btn-primary">Siguiente <i class="bi bi-arrow-right fs-2"></i></router-link>
      </div>
    </div>
    <div v-if="is('Administrador') || is('Comision') || is('Colaborador')" class="row g-5 g-xl-8">
      <div class="row g-5 g-xl-8">
        <div v-if="msgCelular != ''" class="alert alert-warning" role="alert">
          {{ msgCelular }}
        </div>
        <h1>Admision Posgrado 2024</h1>
        <!-- Botón de redirección Reporte Modalidades -->
        <!-- <div class="col-xl-6 ">
          <router-link to="/reporte-modalidades" class="card bg-primary hoverable card-xl-stretch mb-xl-8">
            <div class="card-body">
              <span class="svg-icon svg-icon-white svg-icon-3x ms-n1">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path
                    d="M20 14H18V10H20C20.6 10 21 10.4 21 11V13C21 13.6 20.6 14 20 14ZM21 19V17C21 16.4 20.6 16 20 16H18V20H20C20.6 20 21 19.6 21 19ZM21 7V5C21 4.4 20.6 4 20 4H18V8H20C20.6 8 21 7.6 21 7Z"
                    fill="currentColor"></path>
                  <path opacity="0.3"
                    d="M17 22H3C2.4 22 2 21.6 2 21V3C2 2.4 2.4 2 3 2H17C17.6 2 18 2.4 18 3V21C18 21.6 17.6 22 17 22ZM10 7C8.9 7 8 7.9 8 9C8 10.1 8.9 11 10 11C11.1 11 12 10.1 12 9C12 7.9 11.1 7 10 7ZM13.3 16C14 16 14.5 15.3 14.3 14.7C13.7 13.2 12 12 10.1 12C8.10001 12 6.49999 13.1 5.89999 14.7C5.59999 15.3 6.19999 16 7.39999 16H13.3Z"
                    fill="currentColor"></path>
                </svg>
              </span>
              <div class="text-white fw-bold fs-2 mb-2 mt-5">Reporte Modalidades</div>
              <div class="fw-semibold text-white">Reporte por Modalidades</div>
            </div>
          </router-link>
        </div> -->
        <!-- Botón de redirección Reporte General -->
        <!-- <div class="col-xl-6 ">
          <router-link to="/reporte-general" class="card bg-success hoverable card-xl-stretch mb-xl-8">
            <div class="card-body">
              <span class="svg-icon svg-icon-white svg-icon-3x ms-n1">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path
                    d="M20 14H18V10H20C20.6 10 21 10.4 21 11V13C21 13.6 20.6 14 20 14ZM21 19V17C21 16.4 20.6 16 20 16H18V20H20C20.6 20 21 19.6 21 19ZM21 7V5C21 4.4 20.6 4 20 4H18V8H20C20.6 8 21 7.6 21 7Z"
                    fill="currentColor"></path>
                  <path opacity="0.3"
                    d="M17 22H3C2.4 22 2 21.6 2 21V3C2 2.4 2.4 2 3 2H17C17.6 2 18 2.4 18 3V21C18 21.6 17.6 22 17 22ZM10 7C8.9 7 8 7.9 8 9C8 10.1 8.9 11 10 11C11.1 11 12 10.1 12 9C12 7.9 11.1 7 10 7ZM13.3 16C14 16 14.5 15.3 14.3 14.7C13.7 13.2 12 12 10.1 12C8.10001 12 6.49999 13.1 5.89999 14.7C5.59999 15.3 6.19999 16 7.39999 16H13.3Z"
                    fill="currentColor"></path>
                </svg>
              </span>
              <div class="text-white fw-bold fs-2 mb-2 mt-5">Reporte</div>
              <div class="fw-semibold text-white">Reporte General</div>
            </div>
          </router-link>
        </div> -->
        <!-- Botón de redirección Reporte Asistencias -->
        <!-- <div class="col-xl-6 ">
          <router-link to="/reporte-asistencia-qr" class="card bg-primary hoverable card-xl-stretch mb-xl-8">
            <div class="card-body">
              <span class="svg-icon svg-icon-white svg-icon-3x ms-n1">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path
                    d="M20 14H18V10H20C20.6 10 21 10.4 21 11V13C21 13.6 20.6 14 20 14ZM21 19V17C21 16.4 20.6 16 20 16H18V20H20C20.6 20 21 19.6 21 19ZM21 7V5C21 4.4 20.6 4 20 4H18V8H20C20.6 8 21 7.6 21 7Z"
                    fill="currentColor"></path>
                  <path opacity="0.3"
                    d="M17 22H3C2.4 22 2 21.6 2 21V3C2 2.4 2.4 2 3 2H17C17.6 2 18 2.4 18 3V21C18 21.6 17.6 22 17 22ZM10 7C8.9 7 8 7.9 8 9C8 10.1 8.9 11 10 11C11.1 11 12 10.1 12 9C12 7.9 11.1 7 10 7ZM13.3 16C14 16 14.5 15.3 14.3 14.7C13.7 13.2 12 12 10.1 12C8.10001 12 6.49999 13.1 5.89999 14.7C5.59999 15.3 6.19999 16 7.39999 16H13.3Z"
                    fill="currentColor"></path>
                </svg>
              </span>
              <div class="text-white fw-bold fs-2 mb-2 mt-5">Reporte Asistencias</div>
              <div class="fw-semibold text-white">Reporte de Asistencias</div>
            </div>
          </router-link>
        </div> -->
        <!-- Botón de redirección Reporte Fechas -->
        <!-- <div class="col-xl-6 ">
          <router-link to="/reporte-fecha" class="card bg-success hoverable card-xl-stretch mb-xl-8">
            <div class="card-body">
              <span class="svg-icon svg-icon-white svg-icon-3x ms-n1">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path
                    d="M20 14H18V10H20C20.6 10 21 10.4 21 11V13C21 13.6 20.6 14 20 14ZM21 19V17C21 16.4 20.6 16 20 16H18V20H20C20.6 20 21 19.6 21 19ZM21 7V5C21 4.4 20.6 4 20 4H18V8H20C20.6 8 21 7.6 21 7Z"
                    fill="currentColor"></path>
                  <path opacity="0.3"
                    d="M17 22H3C2.4 22 2 21.6 2 21V3C2 2.4 2.4 2 3 2H17C17.6 2 18 2.4 18 3V21C18 21.6 17.6 22 17 22ZM10 7C8.9 7 8 7.9 8 9C8 10.1 8.9 11 10 11C11.1 11 12 10.1 12 9C12 7.9 11.1 7 10 7ZM13.3 16C14 16 14.5 15.3 14.3 14.7C13.7 13.2 12 12 10.1 12C8.10001 12 6.49999 13.1 5.89999 14.7C5.59999 15.3 6.19999 16 7.39999 16H13.3Z"
                    fill="currentColor"></path>
                </svg>
              </span>
              <div class="text-white fw-bold fs-2 mb-2 mt-5">Reporte Fechas</div>
              <div class="fw-semibold text-white">Reporte por Fechas</div>
            </div>
          </router-link>
        </div> -->


      </div>
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      datos: [],
      msgCelular: ''
    }
  },
  mounted() {
    this.verificardispositivo()
  },
  methods: {
    verificardispositivo() {
      let navegador = navigator.userAgent;
      if (navigator.userAgent.match(/Android/i) || navigator.userAgent.match(/webOS/i) || navigator.userAgent.match(/iPhone/i) || navigator.userAgent.match(/iPad/i) || navigator.userAgent.match(/iPod/i) || navigator.userAgent.match(/BlackBerry/i) || navigator.userAgent.match(/Windows Phone/i)) {
        // aviso por consola que se está usando un dispositivo móvil
        // console.log("Estás usando un dispositivo móvil!!");
        this.msgCelular = 'Para abrir el menú de navegación de click en el icono de la esquina superior izquierda';
        /* setTimeout(function(){
            document.getElementById('kt_app_sidebar_mobile_toggle').click();
        }, 500); */
      } else {
        console.log("No estás usando un móvil");
      }
    }
  }
};
</script>
