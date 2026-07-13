<template>
  <div class="dashboard-admision">

    <!-- KPIs -->
    <div class="row g-3 mb-3">
      <div class="col-6 col-lg-3" v-for="kpi in kpiCards" :key="kpi.titulo">
        <div class="card border-0 shadow-sm h-100">
          <div class="card-body d-flex align-items-center gap-3 py-3">
            <div
              class="rounded-circle d-flex align-items-center justify-content-center flex-shrink-0"
              :style="`width:48px;height:48px;background-color:${kpi.color}20;`"
            >
              <i :class="['bi', kpi.icono]" :style="`font-size:1.25rem;color:${kpi.color};`"></i>
            </div>
            <div class="min-w-0">
              <div v-if="cargando" class="placeholder-glow">
                <span class="placeholder col-6"></span>
              </div>
              <h4 v-else class="mb-0 fw-bold">{{ kpi.valor }}</h4>
              <p class="text-muted small mb-0 text-truncate">{{ kpi.titulo }}</p>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row g-3 mb-3">
      <!-- Gráfico: inscripciones por proceso -->
      <div class="col-lg-7">
        <div class="card border-0 shadow-sm h-100">
          <div class="card-body">
            <h6 class="fw-semibold mb-3">Postulantes por proceso de admisión</h6>

            <div v-if="cargando" class="d-flex flex-column align-items-center justify-content-center py-5 text-muted">
              <div class="spinner-border text-primary mb-3" role="status"></div>
              <span>Cargando datos...</span>
            </div>

            <div v-else-if="errorCarga" class="d-flex flex-column align-items-center justify-content-center py-5 text-center px-3">
              <i class="bi bi-exclamation-triangle text-danger fs-2 mb-2"></i>
              <p class="mb-2 fw-semibold">No se pudo cargar el dashboard</p>
              <p class="text-muted small mb-3">{{ errorCarga }}</p>
              <button class="btn btn-outline-primary btn-sm" @click="cargarDashboard">Reintentar</button>
            </div>

            <div v-else-if="inscripcionesPorProceso.length === 0" class="d-flex flex-column align-items-center justify-content-center py-5 text-center text-muted">
              <i class="bi bi-bar-chart fs-2 mb-2"></i>
              <p class="mb-0">Aún no hay procesos registrados para graficar.</p>
            </div>

            <!-- Gráfico de barras hecho en SVG puro, sin librerías externas -->
            <svg v-else :viewBox="`0 0 ${chartWidth} ${chartHeight}`" class="w-100" style="max-height:260px">
              <line
                v-for="(g, i) in gridLines"
                :key="'grid-' + i"
                :x1="padding.left"
                :x2="chartWidth - padding.right"
                :y1="g.y"
                :y2="g.y"
                stroke="#e9ecef"
                stroke-width="1"
              />
              <text
                v-for="(g, i) in gridLines"
                :key="'label-' + i"
                :x="padding.left - 10"
                :y="g.y + 4"
                text-anchor="end"
                font-size="11"
                fill="#adb5bd"
              >{{ g.value }}</text>

              <g v-for="(b, i) in barras" :key="'bar-' + i">
                <rect
                  :x="b.x"
                  :y="b.y"
                  :width="b.width"
                  :height="b.height"
                  :fill="b.color"
                  rx="4"
                />
                <text
                  :x="b.x + b.width / 2"
                  :y="b.y - 8"
                  text-anchor="middle"
                  font-size="12"
                  font-weight="600"
                  fill="#495057"
                >{{ b.total }}</text>
                <text
                  :x="b.x + b.width / 2"
                  :y="chartHeight - padding.bottom + 18"
                  text-anchor="middle"
                  font-size="11"
                  fill="#6c757d"
                >{{ b.codigo }}</text>
              </g>
            </svg>
          </div>
        </div>
      </div>

      <!-- Accesos rápidos -->
      <div class="col-lg-5">
        <div class="card border-0 shadow-sm h-100">
          <div class="card-body">
            <h6 class="fw-semibold mb-3">Accesos rápidos</h6>
            <div class="d-flex flex-column gap-2">
              <router-link
                v-for="acceso in accesosRapidos"
                :key="acceso.titulo"
                :to="acceso.ruta"
                class="d-flex align-items-center gap-3 p-2 rounded text-decoration-none acceso-item"
              >
                <div
                  class="rounded d-flex align-items-center justify-content-center flex-shrink-0"
                  :style="`width:40px;height:40px;background-color:${acceso.color}20;`"
                >
                  <i :class="['bi', acceso.icono]" :style="`color:${acceso.color};`"></i>
                </div>
                <div>
                  <div class="fw-medium" style="color:#212529">{{ acceso.titulo }}</div>
                  <div class="text-muted small">{{ acceso.descripcion }}</div>
                </div>
              </router-link>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Actividad reciente -->
    <div class="card border-0 shadow-sm">
      <div class="card-body">
        <h6 class="fw-semibold mb-3">Actividad reciente</h6>

        <div v-if="cargando" class="d-flex justify-content-center py-4">
          <div class="spinner-border text-primary" role="status"></div>
        </div>

        <div v-else-if="!errorCarga && actividadReciente.length === 0" class="text-center text-muted py-4">
          <i class="bi bi-inbox fs-3 d-block mb-2"></i>
          Aún no hay postulantes registrados.
        </div>

        <div v-else-if="!errorCarga" class="table-responsive">
          <table class="table align-middle mb-0">
            <thead>
              <tr>
                <th>Código</th>
                <th>Postulante</th>
                <th>Proceso</th>
                <th>Estado</th>
                <th>Fecha</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="a in actividadReciente" :key="a.codigo_p">
                <td><span class="fw-medium">{{ a.codigo_p }}</span></td>
                <td>{{ a.nombre_completo }}</td>
                <td>{{ a.proceso }}</td>
                <td>
                  <span class="badge rounded-pill" style="background-color:#0d6efd; color:#fff;">
                    {{ a.estado_postulante ?? '—' }}
                  </span>
                </td>
                <td class="text-muted">{{ formatearFecha(a.fecha_solicitado) }}</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      cargando: true,
      errorCarga: null,

      kpis: {
        procesos_activos: 0,
        procesos_total: 0,
        locales_activos: 0,
        locales_total: 0,
        postulantes_total: 0,
        postulantes_proceso_activo: 0,
        proceso_activo_nombre: null,
      },
      inscripcionesPorProceso: [],
      actividadReciente: [],

      chartWidth: 600,
      chartHeight: 260,
      padding: { top: 30, right: 20, bottom: 40, left: 40 },
    };
  },
  computed: {
    kpiCards() {
      return [
        {
          titulo: 'Procesos activos',
          valor: `${this.kpis.procesos_activos} / ${this.kpis.procesos_total}`,
          icono: 'bi-calendar-check',
          color: '#0d6efd',
        },
        {
          titulo: 'Locales activos',
          valor: `${this.kpis.locales_activos} / ${this.kpis.locales_total}`,
          icono: 'bi-building',
          color: '#20c997',
        },
        {
          titulo: 'Total postulantes',
          valor: this.kpis.postulantes_total,
          icono: 'bi-people',
          color: '#6f42c1',
        },
        {
          titulo: this.kpis.proceso_activo_nombre
            ? `Postulantes en "${this.kpis.proceso_activo_nombre}"`
            : 'Postulantes proceso activo',
          valor: this.kpis.postulantes_proceso_activo,
          icono: 'bi-person-check',
          color: '#fd7e14',
        },
      ];
    },

    accesosRapidos() {
      return [
        {
          titulo: 'Procesos de admisión',
          descripcion: 'Crear y gestionar procesos',
          icono: 'bi-calendar-check',
          color: '#0d6efd',
          ruta: '/proceso-admision',
        },
        {
          titulo: 'Locales',
          descripcion: 'Sedes disponibles para exámenes',
          icono: 'bi-building',
          color: '#20c997',
          ruta: '/gestion-local',
        },
      ];
    },

    maxTotal() {
      const max = Math.max(1, ...this.inscripcionesPorProceso.map(p => p.total));
      // redondea hacia arriba a un múltiplo "bonito" para las líneas de referencia
      const paso = Math.ceil(max / 4) || 1;
      return paso * 4;
    },

    gridLines() {
      const lineas = [];
      const alto = this.chartHeight - this.padding.top - this.padding.bottom;
      for (let i = 0; i <= 4; i++) {
        const valor = Math.round((this.maxTotal / 4) * i);
        const y = this.chartHeight - this.padding.bottom - (alto / 4) * i;
        lineas.push({ value: valor, y });
      }
      return lineas;
    },

    barras() {
      const colores = ['#0d6efd', '#20c997', '#6f42c1', '#fd7e14', '#e83e8c', '#6610f2'];
      const n = this.inscripcionesPorProceso.length;
      if (n === 0) return [];

      const anchoDisponible = this.chartWidth - this.padding.left - this.padding.right;
      const anchoBarra = Math.min(70, (anchoDisponible / n) * 0.5);
      const espacio = anchoDisponible / n;
      const altoDisponible = this.chartHeight - this.padding.top - this.padding.bottom;

      return this.inscripcionesPorProceso.map((p, i) => {
        const alturaBarra = this.maxTotal === 0 ? 0 : (p.total / this.maxTotal) * altoDisponible;
        const x = this.padding.left + espacio * i + (espacio - anchoBarra) / 2;
        const y = this.chartHeight - this.padding.bottom - alturaBarra;
        return {
          x,
          y,
          width: anchoBarra,
          height: alturaBarra,
          color: colores[i % colores.length],
          codigo: p.codigo,
          total: p.total,
        };
      });
    },
  },
  mounted() {
    this.cargarDashboard();
  },
  methods: {
    async cargarDashboard() {
      this.cargando = true;
      this.errorCarga = null;
      try {
        const res = await axios.get(this.$parent.NombreRuta + '/api/dashboard');
        const data = res.data.data;
        this.kpis = data.kpis;
        this.inscripcionesPorProceso = data.inscripciones_por_proceso;
        this.actividadReciente = data.actividad_reciente;
      } catch (e) {
        this.errorCarga = e.response?.data?.message || 'Ocurrió un error al conectar con el servidor.';
      } finally {
        this.cargando = false;
      }
    },

    formatearFecha(fecha) {
      if (!fecha) return '—';
      const d = new Date(fecha);
      if (Number.isNaN(d.getTime())) return fecha;
      return d.toLocaleDateString('es-PE', { year: 'numeric', month: 'short', day: '2-digit' });
    },
  },
};
</script>

<style scoped>
.dashboard-admision .table thead th {
  font-size: 0.8rem;
  text-transform: uppercase;
  letter-spacing: 0.03em;
  color: #6c757d;
  font-weight: 600;
  border-bottom-width: 1px;
}

.dashboard-admision .table td,
.dashboard-admision .table th {
  padding: 0.75rem 1rem !important;
}

.acceso-item {
  transition: background-color 0.15s ease;
}

.acceso-item:hover {
  background-color: #f8f9fa;
}
</style>