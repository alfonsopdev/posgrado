import Home from './components/modulos/Home.vue'
import Inicio from './components/modulos/Inicio.vue'
import ExampleComponent from './components/ExampleComponent.vue'

//GENERAL
import Login from './components/Login.vue'
import Register from './components/Register.vue'

//ADMINISTRADOR
import usuariosRoles from './components/modulos/usuariosRoles.vue'
import voucherProspecto from './components/modulos/voucherProspecto.vue'
import voucherExamen from './components/modulos/voucherExamen.vue'
import voucherAmbos from './components/modulos/voucherAmbos.vue'
import reportePagosTesoreria from './components/modulos/reportePagoTesoreria.vue'
import voucherExtemporaneo from './components/modulos/voucherExtemporaneo.vue'
import inscribir from './components/modulos/inscribir.vue'
import Reportes from './components/modulos/Reportes.vue'
import ReporteFecha from './components/modulos/ReporteFecha.vue'
import reporteCarreras from './components/modulos/reporteCarreras.vue'
import reporteModalidades from './components/modulos/reporteModalidades.vue'
import reporteColegios from './components/modulos/reporteColegios.vue'
import reporteDistritos from './components/modulos/reporteDistritos.vue'
import reportePublicidades from './components/modulos/reportePublicidades.vue'
import reportePagos from './components/modulos/reportePagos.vue'

//GESTION PROCESO 
import GestionProceso from './components/modulos/ProcesoAdmision.vue'
import GestionLocal from './components/modulos/Local.vue'

import Colegios from './components/modulos/Colegios.vue'
import Usuarios from './components/modulos/Usuarios.vue'
import Calidad from './components/modulos/Calidad.vue'
import ReporteAsistenciaQR from './components/modulos/ReporteAsistenciaQR.vue'
import AsistenciaQR from './components/modulos/AsistenciaQR.vue'
import ListaAsistencia from './components/modulos/ListaAsistencia.vue'

import descargaCarne  from './components/modulos/descargaCarne.vue'
import constanciaIngreso from './components/modulos/constanciaIngreso.vue'
import carnePostulante from './components/modulos/carnePostulante.vue'

import listaAulas from './components/modulos/listaAulas.vue'

//POSTULANTES
import Prospecto from './components/modulos/Prospecto.vue'
import Inscripcion from './components/modulos/Inscripcion.vue'
import Pagos from './components/modulos/Pagos.vue'
import Simulacro from './components/modulos/Simulacro.vue'
// import { component } from 'vue/types/umd'

function can(value){
    return window.Laravel.jsPermissions.permissions.includes(value);
}

function is(value){
    return window.Laravel.jsPermissions.roles.includes(value);
}


export const routes = [
    {
        name: 'Home',
        path: '/dashboard',
        component: Home
    },
    {
        name: 'Inicio',
        path: '/inicio',
        component: Inicio,
        meta: {
            requiresAuth: true
          }
    },
    //GENERAL
    {
        name: 'login',
        path: '/login',
        component: Login
    },
    {
        name: 'register',
        path: '/register',
        component: Register
    },
    {
        name: 'testVocacional',
        path: '/test_vocacional',
        component: ExampleComponent,
        beforeEnter: (to, from, next) => {
            if (is('Postulante')) next();
            else next('/inicio');
        }
    },

    //POSTULANTES
    {
        name: 'prospecto',
        path: '/prospecto',
        component: Prospecto,
        beforeEnter: (to, from, next) => {
            if (is('Postulante')) next();
            else next('/inicio');
        }
    },
    {
        name: 'inscripcion',
        path: '/inscripcion',
        component: Inscripcion,
        beforeEnter: (to, from, next) => {
            if (is('Postulante')) next();
            else next('/inicio');
        }
    },
    {
        name: 'pagos',
        path: '/pagos',
        component: Pagos,
        beforeEnter: (to, from, next) => {
            if (is('Postulante')) next();
            else next('/inicio');
        }
    },

    {
        name: 'carnePostulante',
        path: '/carnet-postulante',
        component: carnePostulante,
        beforeEnter: (to, from, next) => {
            if (is('Postulante')) next();
            else next('/inicio');
            
        }
    },

    {
        name: 'simulacrosAdmision',
        path: '/simulacros-admision',
        component: Simulacro,
        beforeEnter: (to, from, next) => {
            if (is('Postulante')) next();
            else next('/inicio');
        }
    },
    
    //ADMINSITRADOR
    {
        name: 'usuariosRoles',
        path: '/usuarios-roles',
        component: usuariosRoles,
        beforeEnter: (to, from, next) => {
            if (is('Administrador')) next();
            else next('/inicio');
        }
    },
    // {
    //     name: 'voucherProspecto',
    //     path: '/pagos-prospecto',
    //     component: voucherProspecto,
    //     beforeEnter: (to, from, next) => {
    //         if (is('Administrador') || is('Asesor') || is('Colaborador')) next();
    //         else next('/inicio');
    //     }
    // },
    // {
    //     name: 'voucherExamen',
    //     path: '/pagos-examen',
    //     component: voucherExamen,
    //     beforeEnter: (to, from, next) => {
    //         if (is('Administrador') || is('Asesor') || is('Colaborador')) next();
    //         else next('/inicio');
    //     }
    // },
    {
        name: 'voucherAmbos',
        path: '/pagos-ambos',
        component: voucherAmbos,
        beforeEnter: (to, from, next) => {
            if (is('Administrador') || is('Asesor') || is('Colaborador') || is('Tesoreria')) next();
            else next('/inicio');
        }
    },
    {
        name: 'voucherExtemporaneo',
        path: '/pagos-extemporaneo',
        component: voucherExtemporaneo,
        beforeEnter: (to, from, next) => {
            if (is('Administrador') || is('Asesor') || is('Colaborador')) next();
            else next('/inicio');
        }
    },
    
    {
        name: 'inscribir',
        path: '/inscribir',
        component: inscribir,
        beforeEnter: (to, from, next) => {
            if (is('Administrador') || is('Asesor') || is('Colaborador')) next();
            else next('/inicio');
        }
    },
    //GESTION
    {
        name: 'procesoAdmision',
        path: '/proceso-admision',
        component: GestionProceso,
        beforeEnter: (to, from, next) => {
            if (is('Comision')) next();
            else next('/inicio');
        }
    },
    
    {
        name: 'gestionLocal',
        path: '/gestion-local',
        component: GestionLocal,
        beforeEnter: (to, from, next) => {
            if (is('Comision')) next();
            else next('/inicio');
        }
    },
    {
        name: 'colegios',
        path: '/colegios',
        component: Colegios,
        beforeEnter: (to, from, next) => {
            if (is('Administrador') || is('Asesor') || is('Colaborador')) next();
            else next('/inicio');
        }
    },
    {
        name: 'usuarios',
        path: '/usuarios',
        component: Usuarios,
        beforeEnter: (to, from, next) => {
            if (is('Administrador') || is('Asesor') || is('Colaborador')) next();
            else next('/inicio');
        }
    },

    {
        name: 'descargaCarne',
        path: '/descarga-carnet',
        component: descargaCarne,
        beforeEnter: (to, from, next) => {
            if (is('Administrador') || is('Asesor') || is('Colaborador')) next();
            else next('/inicio');
        }
    },
    {
        name: 'constanciaIngreso',
        path: '/constancia-ingreso',
        component: constanciaIngreso,
        beforeEnter: (to, from, next) => {
            if (is('Administrador') || is('Asesor') || is('Colaborador')) next();
            else next('/inicio');
        }
    },

    {
        name: 'listaAulas',
        path: '/lista-aulas',
        component: listaAulas,
        beforeEnter: (to, from, next) => {
            if (is('Administrador') || is('Asesor') || is('Colaborador')) next();
            else next('/inicio');
        }
    },
    {
        name: 'calidad',
        path: '/calidad',
        component: Calidad,
        beforeEnter: (to, from, next) => {
            if (is('Administrador')) next();
            else next('/inicio');
        }
    },


    //ADMINISTRADOR - REPORTES
    {
        name: 'reportePagosTesoreria',
        path: '/reporte-pagos-tesoreria',
        component: reportePagosTesoreria,
        beforeEnter: (to, from, next) => {
            if (is('Administrador') || is('Tesoreria')) next();
            else next('/inicio');
        }
    },

    {
        name: 'reporteGeneral',
        path: '/reporte-general',
        component: Reportes,
        beforeEnter: (to, from, next) => {
            if (is('Administrador') || is('Comision') || is('Colaborador')) next();
            else next('/inicio');
        }
    },
    {
        name: 'reporteFecha',
        path: '/reporte-fecha',
        component: ReporteFecha,
        beforeEnter: (to, from, next) => {
            if (is('Administrador') || is('Comision') || is('Colaborador')) next();
            else next('/inicio');
        }
    },
    {
        name: 'reporteCarreras',
        path: '/reporte-carreras',
        component: reporteCarreras,
        beforeEnter: (to, from, next) => {
            if (is('Administrador') || is('Comision') || is('Colaborador')) next();
            else next('/inicio');
        }
    },

    {
        name: 'reporteModalidades',
        path: '/reporte-modalidades',
        component: reporteModalidades,
        beforeEnter: (to, from, next) => {
            if (is('Administrador') || is('Comision') || is('Colaborador')) next();
            else next('/inicio');
        }
    },
    {
        name: 'reporteColegios',
        path: '/reporte-colegios',
        component: reporteColegios,
        beforeEnter: (to, from, next) => {
            if (is('Administrador') || is('Comision') || is('Colaborador')) next();
            else next('/inicio');
        }
    },

    {
        name: 'reporteDistritos',
        path: '/reporte-distritos',
        component: reporteDistritos,
        beforeEnter: (to, from, next) => {
            if (is('Administrador') || is('Comision') || is('Colaborador')) next();
            else next('/inicio');
        }
    },

    {
        name: 'reportePublicidades',
        path: '/reporte-publicidades',
        component: reportePublicidades,
        beforeEnter: (to, from, next) => {
            if (is('Administrador') || is('Comision') || is('Colaborador')) next();
            else next('/inicio');
        }
    },
    //Reporte Asistencia QR
    {
        name: 'reporteasistenciaQR',
        path: '/reporte-asistencia-qr',
        component: ReporteAsistenciaQR,
        beforeEnter: (to, from, next) => {
            if (is('Administrador')|| is('Comision') || is('Colaborador')) next();
            else next('/inicio');
        }
    },
    //Asistencia QR
    {
        name: 'asistenciaQR',
         path: '/asistencia-qr',
         component: AsistenciaQR,
         beforeEnter: (to, from, next) => {
             if (is('Administrador')) next();
             else next('/inicio');
         }
     },
    //Lista Asistencia
    {
        name: 'listaasistencia',
        path: '/lista-asistencia',
        component: ListaAsistencia,
        beforeEnter: (to, from, next) => {
            if (is('Administrador')||is('Asesor')) next();
            else next('/inicio');
        }
    },
    /*{
        name: 'crearAuto',
        path: '/crear',
        component: Crear
    }, */
]
/* if(is('Administrador')){
    console.log('administrador')
}else{
    console.log('No administrador')
} */
