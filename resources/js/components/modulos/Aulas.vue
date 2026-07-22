<template>
  <div class="gestion-aulas">
    <!-- Header -->
    <div class="card border-0 shadow-sm mb-3">
      <div class="card-body d-flex flex-wrap align-items-center justify-content-between gap-3 py-3">
        <div>
          <h3 class="mb-0 fw-semibold">Aulas</h3>
          <p class="text-muted small mb-0">Gestiona las aulas disponibles para el proceso de admisión</p>
        </div>
        <button class="btn btn-primary d-inline-flex align-items-center gap-2" @click="nuevo">
          <i class="bi bi-plus-lg"></i> Nueva aula
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
          <option value="1">Solo activos</option>
          <option value="0">Solo inactivos</option>
        </select>
      </div>
    </div>

    <!-- Tabla -->
    <div class="card border-0 shadow-sm">
      <div class="card-body p-0">

        <!-- Loading -->
        <div v-if="cargando" key="estado-cargando" class="d-flex flex-column align-items-center justify-content-center py-5 text-muted">
          <div class="spinner-border text-primary mb-3" role="status"></div>
          <span>Cargando aulas...</span>
        </div>

        <!-- Error -->
        <div v-else-if="errorCarga" key="estado-error" class="d-flex flex-column align-items-center justify-content-center py-5 text-center px-3">
          <i class="bi bi-exclamation-triangle text-danger fs-2 mb-2"></i>
          <p class="mb-2 fw-semibold">No se pudieron cargar las aulas</p>
          <p class="text-muted small mb-3">{{ errorCarga }}</p>
          <button class="btn btn-outline-primary btn-sm" @click="cargarAulas">Reintentar</button>
        </div>

        <!-- Vacío -->
        <div v-else-if="aulasFiltradas.length === 0" key="estado-vacio" class="d-flex flex-column align-items-center justify-content-center py-5 text-center">
          <i class="bi bi-building text-muted mb-2" style="font-size: 2rem"></i>
          <p class="mb-1 fw-semibold">
            {{ aulas.length === 0 ? 'Aún no hay aulas registradas' : 'Ninguna aula coincide con la búsqueda' }}
          </p>
          <p class="text-muted small mb-3">
            {{ aulas.length === 0 ? 'Crea la primera aula para poder asignarla a un proceso de admisión.' : 'Prueba con otro término o cambia el filtro.' }}
          </p>
          <button v-if="aulas.length === 0" class="btn btn-primary btn-sm" @click="nuevo">Nueva aula</button>
        </div>

        <!-- Tabla con datos -->
        <div v-else key="estado-tabla" class="table-responsive">
          <table class="table align-center mb-0">
            <thead class="table-light">
              <tr>
                <th class="text-center">local</th>
                <th class="text-center">Codigo aula</th>
                <th class="text-center">Aula</th>
                <th class="text-center">Tipo de examen</th>
                <th class="text-center">Estado</th>
                <th class="text-center">Acciones</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="a in aulasFiltradas" :key="a.id">
                <td class="text-center"> {{ a.local ? a.local.local : 'Sin Local' }} </td>
                <td class="text-muted text-center">{{ a.codigo_aula }}</td>
                <td class="text-muted text-center">{{ a.aula }}</td>
                <td class="text-muted text-center">
                    {{ a.id_examen == 1 ? 'Extraordinario' : 'Ordinario' }}
                </td>                
                <td class="text-center">
                  <span v-if="a.id_estado" class="badge rounded-pill bg-success-subtle text-success border border-success-subtle">
                    <i class="bi bi-check-circle me-1"></i>Activo
                  </span>
                  <span v-else class="badge rounded-pill bg-secondary-subtle text-secondary border border-secondary-subtle">
                    Inactivo
                  </span>
                </td>
                <td class="text-center">
                  <div class="btn-group btn-group-sm">
                    <button class="btn btn-outline-primary" title="Editar" @click="editar(a)">
                      <i class="bi bi-pencil"></i>
                    </button>
                    <button
                      class="btn"
                      :class="a.id_estado ? 'btn-outline-danger' : 'btn-outline-success'"
                      :title="a.id_estado ? 'Desactivar' : 'Activar'"
                      :disabled="accionEnCurso === a.id"
                      @click="confirmarToggle(a)"
                    >
                      <span v-if="accionEnCurso === a.id" class="spinner-border spinner-border-sm"></span>
                      <i v-else :class="a.id_estado ? 'bi bi-slash-circle' : 'bi bi-check-lg'"></i>
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
            <h5 class="modal-title fw-semibold">{{ editando ? 'Editar aula' : 'Nueva aula' }}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-md-6 mb-3">
                <label class="form-label">Local <span class="text-danger">*</span></label>
                <select
                class="form-select"
                :class="{ 'is-invalid': errores.local_id }"
                v-model="form.local_id"
                >
                <option value="" disabled selected>Seleccione un local...</option>
                
                <option 
                    v-for="loc in locales" 
                    :key="loc.id" 
                    :value="loc.id"
                >
                    {{ loc.local }}
                </option>
                </select>
                
                <div class="invalid-feedback">{{ errores.local_id }}</div>
            </div>
              <div class="col-md-6 mb-3">
                <label class="form-label">Codigo aula <span class="text-danger">*</span></label>
                <input
                  class="form-control"
                  :class="{ 'is-invalid': errores.codigo_aula }"
                  v-model.trim="form.codigo_aula"
                  placeholder="Código de la aula"
                >
                <div class="invalid-feedback">{{ errores.codigo_aula }}</div>
              </div>
              <div class="col-md-6 mb-3">
                <label class="form-label">Aula <span class="text-danger">*</span></label>
                <input
                  class="form-control"
                  :class="{ 'is-invalid': errores.aula }"
                  v-model.trim="form.aula"
                  placeholder="01"
                >
                <div class="invalid-feedback">{{ errores.aula }}</div>
              </div>
              <div class="col-md-6 mb-3">
                <label class="form-label">Examen <span class="text-danger">*</span></label>
                <select
                class="form-select"
                :class="{ 'is-invalid': errores.id_examen }"
                v-model="form.id_examen"
                >
                <option value="" disabled selected>Seleccione un Tipo de examen...</option>
                
                <option 
                    v-for="examen in examenes" 
                    :key="examen.id" 
                    :value="examen.id"
                >
                    {{ examen.examen }}
                </option>
                </select>
                
                <div class="invalid-feedback">{{ errores.id_examen }}</div>
            </div>
            </div>
            <div class="form-check form-switch">
              <input
                class="form-check-input"
                type="checkbox"
                role="switch"
                id="switchEstadoAula"
                v-model="form.id_estado"
              >
              <label class="form-check-label" for="switchEstadoAula">
                {{ form.id_estado ? 'activo' : 'desactivado' }}
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
      aulas: [],
      locales: [],
      examenes: [
        { id: 1, examen: 'Extraordinario' },
        { id: 2, examen: 'Ordinario' }
      ],
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
    aulasFiltradas() {
      const q = this.busqueda.trim().toLowerCase();
      return this.aulas.filter(a => {
        const coincideTexto =
          !q || a.aula.toLowerCase().includes(q) || a.codigo_aula.toLowerCase().includes(q);
        const coincideEstado =
          this.filtroEstado === 'todos' ||
          (this.filtroEstado === '1' && a.id_estado) ||
          (this.filtroEstado === '0' && !a.id_estado);
        return coincideTexto && coincideEstado;
      });
    },
  },
  mounted() {
    this.cargarAulas();
    this.cargarlocales();
    this.modal = new Modal(this.$refs.modal);
    this.modalConfirmar = new Modal(this.$refs.modalConfirmar);
  },
  methods: {
    formVacio() {
      return {
        local: '',
        codigo_aula: '',
        aula: '',
        id_examen: '',
        id_estado: 1,
      };
    },

    async cargarAulas() {
      this.cargando = true;
      this.errorCarga = null;
      try {
        const res = await axios.get(this.$parent.NombreRuta + '/api/aulas');
        this.aulas = res.data.data;
      } catch (e) {
        this.errorCarga = e.response?.data?.message || 'Ocurrió un error al conectar con el servidor.';
      } finally {
        this.cargando = false;
      }
    },
    async cargarlocales() {
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

    editar(a) {
      this.editando = true;
      this.errores = {};
      this.errorGuardado = null;
      this.form = { ...a, id_estado: !!a.id_estado ? 1 : 0};
      this.modal.show();
    },

    validar() {
      const errores = {};
      if (!this.form.aula) errores.aula = 'El aula es obligatorio.';
      if (!this.form.codigo_aula) errores.codigo_aula = 'El código del aula es obligatorio.';
      this.errores = errores;
      return Object.keys(errores).length === 0;
    },

    async guardar() {
      if (!this.validar()) return;
      this.guardando = true;
      this.errorGuardado = null;
      try {
        if (this.editando) {
          await axios.put(this.$parent.NombreRuta + `/api/aulas/${this.form.id}`, this.form);
          this.mostrarToast('Aula actualizada correctamente.');
        } else {
          await axios.post(this.$parent.NombreRuta + '/api/aulas', this.form);
          this.mostrarToast('Aula creada correctamente.');
        }
        this.modal.hide();
        this.cargarAulas();
      } catch (e) {
        this.errorGuardado = e.response?.data?.message || 'No se pudo guardar el aula. Intenta nuevamente.';
      } finally {
        this.guardando = false;
      }
    },

    confirmarToggle(a) {
      const activando = !a.id_estado;
      this.confirmacion = {
        icono: activando ? 'bi-check-circle' : 'bi-trash',
        colorIcono: activando ? 'text-success' : 'text-danger',
        colorBoton: activando ? 'btn-success' : 'btn-danger',
        titulo: activando ? 'Activar esta aula' : 'Desactivar esta aula',
        mensaje: activando
          ? `Se activará "${a.aula}" y estará disponible para asignarlo a procesos de admisión.`
          : `Se desactivará "${a.aula}". Dejará de estar disponible para nuevos procesos de admisión.`,
        textoBoton: activando ? 'Activar' : 'Desactivar',
        accion: () => this.toggleEstado(a.id),
      };
      this.modalConfirmar.show();
    },

    async toggleEstado(id) {
      this.modalConfirmar.hide();
      this.accionEnCurso = id;
      try {
        await axios.post(this.$parent.NombreRuta + `/api/aulas/${id}/toggle-estado`);
        this.mostrarToast('Estado del aula actualizado correctamente.');
        this.cargarAulas();
      } catch (e) {
        this.mostrarToast(e.response?.data?.message || 'No se pudo actualizar el estado del aula.', 'error');
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
.gestion-aulas .table thead th {
  font-size: 0.8rem;
  text-transform: uppercase;
  letter-spacing: 0.03em;
  color: #6c757d;
  font-weight: 600;
  border-bottom-width: 1px;
}

.gestion-aulas .btn-group-sm .btn {
  padding: 0.25rem 0.55rem;
}

.toast {
  min-width: 280px;
}
</style>