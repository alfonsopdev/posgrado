<template>
  <div class="gestion-locales">
    <!-- Header -->
    <div class="card border-0 shadow-sm mb-3">
      <div class="card-body d-flex flex-wrap align-items-center justify-content-between gap-3 py-3">
        <div>
          <h3 class="mb-0 fw-semibold">Locales</h3>
          <p class="text-muted small mb-0">Gestiona las sedes disponibles para los procesos de admisión</p>
        </div>
        <button class="btn btn-primary d-inline-flex align-items-center gap-2" @click="nuevo">
          <i class="bi bi-plus-lg"></i> Nuevo local
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
              placeholder="Buscar por nombre o dirección..."
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
          <span>Cargando locales...</span>
        </div>

        <!-- Error -->
        <div v-else-if="errorCarga" key="estado-error" class="d-flex flex-column align-items-center justify-content-center py-5 text-center px-3">
          <i class="bi bi-exclamation-triangle text-danger fs-2 mb-2"></i>
          <p class="mb-2 fw-semibold">No se pudieron cargar los locales</p>
          <p class="text-muted small mb-3">{{ errorCarga }}</p>
          <button class="btn btn-outline-primary btn-sm" @click="cargarLocales">Reintentar</button>
        </div>

        <!-- Vacío -->
        <div v-else-if="localesFiltrados.length === 0" key="estado-vacio" class="d-flex flex-column align-items-center justify-content-center py-5 text-center">
          <i class="bi bi-building text-muted mb-2" style="font-size: 2rem"></i>
          <p class="mb-1 fw-semibold">
            {{ locales.length === 0 ? 'Aún no hay locales registrados' : 'Ningún local coincide con la búsqueda' }}
          </p>
          <p class="text-muted small mb-3">
            {{ locales.length === 0 ? 'Crea el primer local para poder asignarlo a un proceso de admisión.' : 'Prueba con otro término o cambia el filtro.' }}
          </p>
          <button v-if="locales.length === 0" class="btn btn-primary btn-sm" @click="nuevo">Nuevo local</button>
        </div>

        <!-- Tabla con datos -->
        <div v-else key="estado-tabla" class="table-responsive">
          <table class="table align-middle mb-0">
            <thead class="table-light">
              <tr>
                <th>Nombre</th>
                <th>Dirección</th>
                <th>Estado</th>
                <th class="text-end pe-4">Acciones</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="l in localesFiltrados" :key="l.id">
                <td><span class="fw-medium">{{ l.local }}</span></td>
                <td class="text-muted">{{ l.direccion }}</td>
                <td>
                  <span v-if="l.id_estado" class="badge rounded-pill bg-success-subtle text-success-emphasis border border-success-subtle">
                    <i class="bi bi-check-circle me-1"></i>Activo
                  </span>
                  <span v-else class="badge rounded-pill bg-secondary-subtle text-secondary-emphasis border border-secondary-subtle">
                    Inactivo
                  </span>
                </td>
                <td class="text-end pe-4">
                  <div class="btn-group btn-group-sm">
                    <button class="btn btn-outline-secondary" title="Editar" @click="editar(l)">
                      <i class="bi bi-pencil"></i>
                    </button>
                    <button
                      class="btn"
                      :class="l.id_estado ? 'btn-outline-secondary' : 'btn-outline-success'"
                      :title="l.id_estado ? 'Desactivar' : 'Activar'"
                      :disabled="accionEnCurso === l.id"
                      @click="confirmarToggle(l)"
                    >
                      <span v-if="accionEnCurso === l.id" class="spinner-border spinner-border-sm"></span>
                      <i v-else :class="l.id_estado ? 'bi bi-slash-circle' : 'bi bi-check-lg'"></i>
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
    <div class="modal fade" id="modalLocal" tabindex="-1" ref="modal">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title fw-semibold">{{ editando ? 'Editar local' : 'Nuevo local' }}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-md-6 mb-3">
                <label class="form-label">Nombre <span class="text-danger">*</span></label>
                <input
                  class="form-control"
                  :class="{ 'is-invalid': errores.local }"
                  v-model.trim="form.local"
                  placeholder="SEDE FUNDO DON LUIS"
                >
                <div class="invalid-feedback">{{ errores.local }}</div>
              </div>
              <div class="col-md-6 mb-3">
                <label class="form-label">Dirección <span class="text-danger">*</span></label>
                <input
                  class="form-control"
                  :class="{ 'is-invalid': errores.direccion }"
                  v-model.trim="form.direccion"
                  placeholder="Pan. Sur - Km 139 Mz. A Lte. 1 - San Luis"
                >
                <div class="invalid-feedback">{{ errores.direccion }}</div>
              </div>
            </div>
            <div class="form-check form-switch">
              <input
                class="form-check-input"
                type="checkbox"
                role="switch"
                id="switchEstadoLocal"
                v-model="form.id_estado"
              >
              <label class="form-check-label" for="switchEstadoLocal">
                {{ form.id_estado ? 'Activo' : 'Inactivo' }}
              </label>
            </div>
            <div v-if="errorGuardado" class="alert alert-danger d-flex align-items-center gap-2 mt-3 mb-0">
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

    <!-- Modal: Confirmación (eliminar / activar-desactivar) -->
    <div class="modal fade" id="modalConfirmarLocal" tabindex="-1" ref="modalConfirmar">
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
    localesFiltrados() {
      const q = this.busqueda.trim().toLowerCase();
      return this.locales.filter(l => {
        const coincideTexto =
          !q || l.local.toLowerCase().includes(q) || l.direccion.toLowerCase().includes(q);
        const coincideEstado =
          this.filtroEstado === 'todos' ||
          (this.filtroEstado === 'activo' && l.id_estado) ||
          (this.filtroEstado === 'inactivo' && !l.id_estado);
        return coincideTexto && coincideEstado;
      });
    },
  },
  mounted() {
    this.cargarLocales();
    this.modal = new Modal(this.$refs.modal);
    this.modalConfirmar = new Modal(this.$refs.modalConfirmar);
  },
  methods: {
    formVacio() {
      return {
        local: '',
        direccion: '',
        id_estado: true,
      };
    },

    async cargarLocales() {
      this.cargando = true;
      this.errorCarga = null;
      try {
        const res = await axios.get(this.$parent.NombreRuta + '/api/locales');
        this.locales = res.data.data;
      } catch (e) {
        this.errorCarga = e.response?.data?.message || 'Ocurrió un error al conectar con el servidor.';
      } finally {
        this.cargando = false;
      }
    },

    nuevo() {
      this.editando = false;
      this.errores = {};
      this.errorGuardado = null;
      this.form = this.formVacio();
      this.modal.show();
    },

    editar(l) {
      this.editando = true;
      this.errores = {};
      this.errorGuardado = null;
      this.form = { ...l, id_estado: !!l.id_estado };
      this.modal.show();
    },

    validar() {
      const errores = {};
      if (!this.form.local) errores.local = 'El nombre es obligatorio.';
      if (!this.form.direccion) errores.direccion = 'La dirección es obligatoria.';
      this.errores = errores;
      return Object.keys(errores).length === 0;
    },

    async guardar() {
      if (!this.validar()) return;
      this.guardando = true;
      this.errorGuardado = null;
      try {
        if (this.editando) {
          await axios.put(this.$parent.NombreRuta + `/api/locales/${this.form.id}`, this.form);
          this.mostrarToast('Local actualizado correctamente.');
        } else {
          await axios.post(this.$parent.NombreRuta + '/api/locales', this.form);
          this.mostrarToast('Local creado correctamente.');
        }
        this.modal.hide();
        this.cargarLocales();
      } catch (e) {
        this.errorGuardado = e.response?.data?.message || 'No se pudo guardar el local. Intenta nuevamente.';
      } finally {
        this.guardando = false;
      }
    },

    confirmarToggle(l) {
      const activando = !l.id_estado;
      this.confirmacion = {
        icono: activando ? 'bi-check-circle' : 'bi-trash',
        colorIcono: activando ? 'text-success' : 'text-danger',
        colorBoton: activando ? 'btn-success' : 'btn-danger',
        titulo: activando ? 'Activar este local' : 'Desactivar este local',
        mensaje: activando
          ? `Se activará "${l.local}" y estará disponible para asignarlo a procesos de admisión.`
          : `Se desactivará "${l.local}". Dejará de estar disponible para nuevos procesos de admisión.`,
        textoBoton: activando ? 'Activar' : 'Desactivar',
        accion: () => this.toggleEstado(l.id),
      };
      this.modalConfirmar.show();
    },

    async toggleEstado(id) {
      this.modalConfirmar.hide();
      this.accionEnCurso = id;
      try {
        await axios.post(this.$parent.NombreRuta + `/api/locales/${id}/toggle-estado`);
        this.mostrarToast('Estado del local actualizado correctamente.');
        this.cargarLocales();
      } catch (e) {
        this.mostrarToast(e.response?.data?.message || 'No se pudo actualizar el estado del local.', 'error');
      } finally {
        this.accionEnCurso = null;
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
.gestion-locales .table thead th {
  font-size: 0.8rem;
  text-transform: uppercase;
  letter-spacing: 0.03em;
  color: #6c757d;
  font-weight: 600;
  border-bottom-width: 1px;
}

.gestion-locales .btn-group-sm .btn {
  padding: 0.25rem 0.55rem;
}

.toast {
  min-width: 280px;
}
</style>