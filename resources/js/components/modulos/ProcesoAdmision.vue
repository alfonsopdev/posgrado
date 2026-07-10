<template>
  <div class="proceso-admision">
    <!-- Header -->
    <div class="card border-0 shadow-sm mb-3">
      <div class="card-body d-flex flex-wrap align-items-center justify-content-between gap-3 py-3">
        <div>
          <h3 class="mb-0 fw-semibold">Procesos de Admisión</h3>
          <p class="text-muted small mb-0">Gestiona los procesos, sedes y fechas de examen</p>
        </div>
        <button class="btn btn-primary d-inline-flex align-items-center gap-2" @click="nuevo">
          <i class="bi bi-plus-lg"></i> Nuevo proceso
        </button>
      </div>
    </div>

    <!-- Toolbar: búsqueda + filtro -->
    <div class="card border-0 shadow-sm mb-3">
      <div class="card-body d-flex flex-wrap gap-3 py-3">
        <div class="flex-grow-1" style="min-width: 220px">
          <div class="input-group">
            <span class="input-group-text bg-white"><i class="bi bi-search"></i></span>
            <input
              class="form-control"
              v-model="busqueda"
              placeholder="Buscar por código o nombre..."
            >
          </div>
        </div>
        <select class="form-select" style="max-width: 180px" v-model="filtroEstado">
          <option value="todos">Todos los estados</option>
          <option value="activo">Solo activos</option>
          <option value="inactivo">Solo inactivos</option>
        </select>
      </div>
    </div>

    <!-- Tabla -->
    <div class="card border-0 shadow-sm">
      <div class="card-body p-0">

        <!-- Loading -->
        <div v-if="cargando" key="estado-cargando" class="d-flex flex-column align-items-center justify-content-center py-5 text-muted">
          <div class="spinner-border text-primary mb-3" role="status"></div>
          <span>Cargando procesos...</span>
        </div>

        <!-- Error -->
        <div v-else-if="errorCarga" key="estado-error" class="d-flex flex-column align-items-center justify-content-center py-5 text-center px-3">
          <i class="bi bi-exclamation-triangle text-danger fs-2 mb-2"></i>
          <p class="mb-2 fw-semibold">No se pudieron cargar los procesos</p>
          <p class="text-muted small mb-3">{{ errorCarga }}</p>
          <button class="btn btn-outline-primary btn-sm" @click="cargarProcesos">Reintentar</button>
        </div>

        <!-- Vacío -->
        <div v-else-if="procesosFiltrados.length === 0" key="estado-vacio" class="d-flex flex-column align-items-center justify-content-center py-5 text-center">
          <i class="bi bi-inbox fs-2 text-muted mb-2"></i>
          <p class="mb-1 fw-semibold">
            {{ procesos.length === 0 ? 'Aún no hay procesos registrados' : 'Ningún proceso coincide con la búsqueda' }}
          </p>
          <p class="text-muted small mb-3">
            {{ procesos.length === 0 ? 'Crea el primer proceso de admisión para empezar.' : 'Prueba con otro término o cambia el filtro.' }}
          </p>
          <button v-if="procesos.length === 0" class="btn btn-primary btn-sm" @click="nuevo">Nuevo proceso</button>
        </div>

        <!-- Tabla con datos -->
        <div v-else key="estado-tabla" class="table-responsive">
          <table class="table align-middle mb-0">
            <thead class="table-light">
              <tr>
                <th>Código</th>
                <th>Nombre</th>
                <th>Sede</th>
                <th>Fecha examen</th>
                <th>Estado</th>
                <th class="text-end pe-4">Acciones</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="p in procesosFiltrados" :key="p.id">
                <td><span class="fw-medium">{{ p.codigo }}</span></td>
                <td>{{ p.nombre }}</td>
                <td>{{ p.local?.local ?? '—' }}</td>
                <td>{{ formatearFecha(p.fecha_examen) }}</td>
                <td>
                  <span v-if="p.activo" class="badge rounded-pill bg-success-subtle text-success-emphasis border border-success-subtle">
                    <i class="bi bi-check-circle me-1"></i>Activo
                  </span>
                  <span v-else class="badge rounded-pill bg-secondary-subtle text-secondary-emphasis border border-secondary-subtle">
                    Inactivo
                  </span>
                </td>
                <td class="text-end pe-4">
                  <div class="btn-group btn-group-sm">
                    <button class="btn btn-outline-secondary" title="Editar" @click="editar(p)">
                      <i class="bi bi-pencil"></i>
                    </button>
                    <button
                      class="btn btn-outline-success"
                      title="Activar"
                      :disabled="p.activo || accionEnCurso === p.id"
                      @click="confirmarActivar(p)"
                    >
                      <span v-if="accionEnCurso === p.id" class="spinner-border spinner-border-sm"></span>
                      <i v-else class="bi bi-check-lg"></i>
                    </button>
                    <button class="btn btn-outline-danger" title="Eliminar" @click="confirmarEliminar(p)">
                      <i class="bi bi-trash"></i>
                    </button>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <!-- Modal: Nuevo/Editar -->
    <div class="modal fade" id="modalProceso" tabindex="-1" ref="modal">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title fw-semibold">{{ editando ? 'Editar proceso' : 'Nuevo proceso' }}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-md-6 mb-3">
                <label class="form-label">Código <span class="text-danger">*</span></label>
                <input
                  class="form-control"
                  :class="{ 'is-invalid': errores.codigo }"
                  v-model.trim="form.codigo"
                  placeholder="2026-I.B"
                >
                <div class="invalid-feedback">{{ errores.codigo }}</div>
              </div>
              <div class="col-md-6 mb-3">
                <label class="form-label">Nombre <span class="text-danger">*</span></label>
                <input
                  class="form-control"
                  :class="{ 'is-invalid': errores.nombre }"
                  v-model.trim="form.nombre"
                  placeholder="Admisión 2026-I.B"
                >
                <div class="invalid-feedback">{{ errores.nombre }}</div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6 mb-3">
                <label class="form-label">Sede (local) <span class="text-danger">*</span></label>
                <select
                  class="form-select"
                  :class="{ 'is-invalid': errores.local_id }"
                  v-model="form.local_id"
                >
                  <option value="" disabled>Selecciona una sede</option>
                  <option v-for="l in locales" :key="l.id" :value="l.id">{{ l.local }}</option>
                </select>
                <div class="invalid-feedback">{{ errores.local_id }}</div>
              </div>
              <div class="col-md-3 mb-3">
                <label class="form-label">Fecha examen <span class="text-danger">*</span></label>
                <input
                  type="date"
                  class="form-control"
                  :class="{ 'is-invalid': errores.fecha_examen }"
                  v-model="form.fecha_examen"
                >
                <div class="invalid-feedback">{{ errores.fecha_examen }}</div>
              </div>
              <div class="col-md-3 mb-3">
                <label class="form-label">Hora inicio / fin</label>
                <div class="d-flex gap-2">
                  <input class="form-control" v-model="form.hora_inicio" placeholder="08:00 AM">
                  <input class="form-control" v-model="form.hora_fin" placeholder="08:30 AM">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6 mb-3">
                <label class="form-label">Título del carné</label>
                <input class="form-control" v-model="form.carnet_titulo" placeholder="CARNÉ DE POSTULANTE - DECLARACIÓN JURADA">
              </div>
              <div class="col-md-6 mb-3">
                <label class="form-label">URL base QR</label>
                <input class="form-control" v-model="form.qr_base_url" placeholder="https://...">
              </div>
            </div>
            <div v-if="errorGuardado" class="alert alert-danger d-flex align-items-center gap-2 mb-0">
              <i class="bi bi-exclamation-triangle"></i>
              <span>{{ errorGuardado }}</span>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal" :disabled="guardando">Cancelar</button>
            <button type="button" class="btn btn-primary d-inline-flex align-items-center gap-2" @click="guardar" :disabled="guardando">
              <span v-if="guardando" class="spinner-border spinner-border-sm"></span>
              {{ guardando ? 'Guardando...' : 'Guardar' }}
            </button>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal: Confirmación (eliminar / activar) -->
    <div class="modal fade" id="modalConfirmar" tabindex="-1" ref="modalConfirmar">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-body text-center py-4">
            <i :class="['bi', confirmacion.icono, 'fs-1', confirmacion.colorIcono, 'mb-3']"></i>
            <h5 class="fw-semibold mb-2">{{ confirmacion.titulo }}</h5>
            <p class="text-muted mb-0">{{ confirmacion.mensaje }}</p>
          </div>
          <div class="modal-footer justify-content-center border-0 pb-4">
            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
            <button type="button" :class="['btn', confirmacion.colorBoton]" @click="confirmacion.accion">
              {{ confirmacion.textoBoton }}
            </button>
          </div>
        </div>
      </div>
    </div>

    <!-- Toasts -->
    <div class="toast-container position-fixed bottom-0 end-0 p-3" style="z-index: 1080">
      <div
        v-for="t in toasts"
        :key="t.id"
        class="toast show align-items-center border-0 mb-2"
        :class="t.tipo === 'error' ? 'text-bg-danger' : 'text-bg-success'"
      >
        <div class="d-flex">
          <div class="toast-body">{{ t.mensaje }}</div>
          <button class="btn-close btn-close-white me-2 m-auto" @click="cerrarToast(t.id)"></button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { Modal } from 'bootstrap';

export default {
  data() {
    return {
      procesos: [],
      locales: [],
      busqueda: '',
      filtroEstado: 'todos',

      cargando: true,
      errorCarga: null,

      editando: false,
      guardando: false,
      errorGuardado: null,
      errores: {},

      accionEnCurso: null,

      form: this.formVacio(),
      modal: null,
      modalConfirmar: null,
      //confirmacion: {},
      confirmacion: {
        icono: '',
        colorIcono: '',
        colorBoton: '',
        titulo: '',
        mensaje: '',
        textoBoton: '',
        accion: () => {}
      },

      toasts: [],
      toastId: 0,
    };
  },
  computed: {
    procesosFiltrados() {
      const q = this.busqueda.trim().toLowerCase();
      return this.procesos.filter(p => {
        const coincideTexto = !q || p.codigo.toLowerCase().includes(q) || p.nombre.toLowerCase().includes(q);
        const coincideEstado =
          this.filtroEstado === 'todos' ||
          (this.filtroEstado === 'activo' && p.activo) ||
          (this.filtroEstado === 'inactivo' && !p.activo);
        return coincideTexto && coincideEstado;
      });
    },
  },
  mounted() {
    this.cargarProcesos();
    this.cargarLocales();
    this.modal = new Modal(this.$refs.modal);
    this.modalConfirmar = new Modal(this.$refs.modalConfirmar);
  },
  methods: {
    formVacio() {
      return {
        codigo: '',
        nombre: '',
        local_id: '',
        fecha_examen: '',
        hora_inicio: '08:00 AM',
        hora_fin: '08:30 AM',
        carnet_titulo: 'CARNÉ DE POSTULANTE - DECLARACIÓN JURADA',
        qr_base_url: 'https://posgrado.undc.edu.pe/carne_postulante.php?token=',
      };
    },

    formatearFecha(fecha) {
      if (!fecha) return '—';
      const d = new Date(fecha + 'T00:00:00');
      if (Number.isNaN(d.getTime())) return fecha;
      return d.toLocaleDateString('es-PE', { year: 'numeric', month: 'short', day: '2-digit' });
    },

    async cargarProcesos() {
      this.cargando = true;
      this.errorCarga = null;
      try {
        const res = await axios.get(this.$parent.NombreRuta + '/api/procesos-admision');
        this.procesos = res.data.data;
      } catch (e) {
        this.errorCarga = e.response?.data?.message || 'Ocurrió un error al conectar con el servidor.';
      } finally {
        this.cargando = false;
      }
    },

    async cargarLocales() {
        try {
          const res = await axios.get(this.$parent.NombreRuta + '/api/locales');
          this.locales = res.data.data;    
        } catch (e) {
          this.mostrarToast('No se pudieron cargar las sedes.', 'error');
        }
    },

    nuevo() {
      this.editando = false;
      this.errores = {};
      this.errorGuardado = null;
      this.form = this.formVacio();
      this.modal.show();
    },

    editar(p) {
      this.editando = true;
      this.errores = {};
      this.errorGuardado = null;
      this.form = { ...p };
      this.modal.show();
    },

    validar() {
      const errores = {};
      if (!this.form.codigo) errores.codigo = 'El código es obligatorio.';
      if (!this.form.nombre) errores.nombre = 'El nombre es obligatorio.';
      if (!this.form.local_id) errores.local_id = 'Selecciona una sede.';
      if (!this.form.fecha_examen) errores.fecha_examen = 'La fecha de examen es obligatoria.';
      this.errores = errores;
      return Object.keys(errores).length === 0;
    },

    async guardar() {
      if (!this.validar()) return;
      this.guardando = true;
      this.errorGuardado = null;
      try {
        if (this.editando) {
          await axios.put(`/api/procesos-admision/${this.form.id}`, this.form);
          this.mostrarToast('Proceso actualizado correctamente.');
        } else {
          await axios.post('/api/procesos-admision', this.form);
          this.mostrarToast('Proceso creado correctamente.');
        }
        this.modal.hide();
        this.cargarProcesos();
      } catch (e) {
        this.errorGuardado = e.response?.data?.message || 'No se pudo guardar el proceso. Intenta nuevamente.';
      } finally {
        this.guardando = false;
      }
    },

    confirmarActivar(p) {
      this.confirmacion = {
        icono: 'bi-check-circle',
        colorIcono: 'text-success',
        colorBoton: 'btn-success',
        titulo: 'Activar este proceso',
        mensaje: `Se activará "${p.nombre}". Esta acción puede desactivar otros procesos activos, según la configuración del sistema.`,
        textoBoton: 'Activar',
        accion: () => this.activar(p.id),
      };
      this.modalConfirmar.show();
    },

    async activar(id) {
      this.modalConfirmar.hide();
      this.accionEnCurso = id;
      try {
        await axios.post(`/api/procesos-admision/${id}/activar`);
        this.mostrarToast('Proceso activado correctamente.');
        this.cargarProcesos();
      } catch (e) {
        this.mostrarToast(e.response?.data?.message || 'No se pudo activar el proceso.', 'error');
      } finally {
        this.accionEnCurso = null;
      }
    },

    confirmarEliminar(p) {
      this.confirmacion = {
        icono: 'bi-trash',
        colorIcono: 'text-danger',
        colorBoton: 'btn-danger',
        titulo: 'Eliminar proceso',
        mensaje: `¿Seguro que deseas eliminar "${p.nombre}"? Esta acción no se puede deshacer.`,
        textoBoton: 'Eliminar',
        accion: () => this.eliminar(p.id),
      };
      this.modalConfirmar.show();
    },

    async eliminar(id) {
      this.modalConfirmar.hide();
      try {
        await axios.delete(`/api/procesos-admision/${id}`);
        this.mostrarToast('Proceso eliminado correctamente.');
        this.cargarProcesos();
      } catch (e) {
        this.mostrarToast(e.response?.data?.message || 'No se pudo eliminar el proceso.', 'error');
      }
    },

    mostrarToast(mensaje, tipo = 'ok') {
      const id = ++this.toastId;
      this.toasts.push({ id, mensaje, tipo });
      setTimeout(() => this.cerrarToast(id), 4000);
    },

    cerrarToast(id) {
      this.toasts = this.toasts.filter(t => t.id !== id);
    },
  },
};
</script>

<style scoped>
.proceso-admision .table thead th {
  font-size: 0.8rem;
  text-transform: uppercase;
  letter-spacing: 0.03em;
  color: #6c757d;
  font-weight: 600;
  border-bottom-width: 1px;
}

.proceso-admision .btn-group-sm .btn {
  padding: 0.25rem 0.55rem;
}

.toast {
  min-width: 280px;
}
</style>