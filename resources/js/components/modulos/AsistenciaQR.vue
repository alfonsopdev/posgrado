<template>
  <div>
    <div class="card mb-5 mb-xl-8">
      <div class="card-body text-center">
        <div v-if="error" class="alert alert-danger">{{ error }}</div>
        
        <div style="max-width: 500px; margin: 0 auto; border: 1px solid #ccc;">
          <qrcode-stream @init="onInit" @decode="onDecode"></qrcode-stream>
        </div>
      </div>
    </div>

    <div class="card mb-5 mb-xl-8">
      <div class="card-body py-3">
        <div class="table-responsive">
          <table class="table align-middle gs-0 gy-4">
            <thead>
              <tr class="fw-bold text-muted bg-light">
                <th>Código</th>
                <th>Apellidos y Nombres</th>
                <th>Local</th>
                <th>Aula</th>
                <th class="text-center rounded-end">Registrar Asistencia</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="(dato, index) in datos" :key="index">
                <td class="ps-4">{{ dato.codigo_p }}</td>
                <td>
                  <div class="d-flex align-items-center">
                    <p class="text-dark fw-bold mb-1 fs-6">
                      {{ dato.apellido_paterno + ' ' + dato.apellido_materno + ', ' + dato.nombre }}
                    </p>
                  </div>
                </td>
                <td>{{ dato.local }}</td>
                <td>{{ dato.aula }}</td>
                <td class="text-center">
                  <button 
                    type="button" 
                    @click.prevent="registrarAsistencia" 
                    :class="[
                      botonRegistrar ? 'm-loader m-loader--light m-loader--right' : '',
                      'btn', 'w-100',
                      dato.condicion === null ? 'btn-primary' : 'btn-danger'
                    ]"
                    :disabled="botonRegistrar || ['INGRESO', 'NO INGRESO', 'AUSENTE', 'PRESENTE'].includes(dato.condicion) || botonRegistrarDisabled">
                    <span v-if="botonRegistrar">Registrando...</span>
                    <span v-else>
                      {{ ['INGRESO', 'NO INGRESO', 'AUSENTE', 'PRESENTE'].includes(dato.condicion) ? 'Registrado' : 'Registrar' }}
                    </span>
                  </button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { QrcodeStream } from 'vue-qrcode-reader'

export default {
  data() {
    return {
      error: '',
      decodedString: '',
      extractedId: '',
      datos: [],
      botonRegistrar: false,
      botonRegistrarDisabled: false,
    }
  },
  components: {
    QrcodeStream
  },
  methods: {
    async onInit(promise) {
      try {
        const { capabilities } = await promise

        //successfully initalized
      } catch (error) {
        if (error.name === 'NotAllowedError') {
          this.error = "Al usuario se le negó el permiso de acceso a la cámara."
        } else if (error.name === 'NotFoundError') {
          this.error = "no se ha instalado ningún dispositivo de cámara adecuado"
        } else if (error.name == 'NotReadableError') {
          this.error = "la página no es un servidor a través de HTTPS (o localhost)"
        } else if (error.name == 'OverconstrainedError') {
          this.error = "tal vez la cámara ya esté en uso"
        } else if (error.name == 'StreamApiNotSupportedError') {
          this.error = "El navegador parece carecer de funciones"
        }
      } finally {
        //hide loading indicator
      }
    },
    // método que se activa cuando se decodifica el QR
    async onDecode(decodedString) {
      // ver el contenido del qr
      this.decodedString = decodedString;
      // abrir otra ventana con el contenido del qr
      // window.location.replace(decodedString);
      // Verificar si la cadena contiene 'token='
      const tokenIndex = decodedString.indexOf('token=');
      if (tokenIndex !== -1) {
        // Extraer la parte después de 'token='
        const tokenValue = decodedString.substring(tokenIndex + 'token='.length);
        // Decodificar el valor base64 extraído
        try {
          const id = atob(tokenValue);
          this.extractedId = id;
        } catch (error) {
          console.error('Error al decodificar:', error);
          this.extractedId = 'Error al decodificar el ID';
        }
      } else {
        this.extractedId = 'No se encontró ningún token en la cadena';
      };
      // Llamar a obtenerDatosFicha() después de que this.extractedId esté actualizado
      await this.obtenerDatosFicha();
    },
    async obtenerDatosFicha() {
      // Prueba de llamado de extractedId
      console.log('ficha ' + this.extractedId);
      let extracted = this.extractedId;
      await axios
        .get(this.$parent.NombreRuta + "/api/datosficha?extracted=" + extracted)
        // .get(this.$parent.NombreRuta +"/api/datosficha")
        // .get("/api/datosficha?extractedId=" + extractedId)
        .then((response) => {
          // Procesar la respuesta con los datos de la ficha
          this.datos = response.data;
          //console.log(response.data); // Aquí tendrás los datos de la ficha desde Laravel
          // Actualizar tu componente con los datos recibidos
        })
        .catch(function (error) {
          console.error('Error al obtener datos de la ficha:', error);
          // Manejar el error en caso de que ocurra
        });
    },
    async registrarAsistencia() {
      let extracted = this.extractedId;
      this.botonRegistrar = true;
      
      try {
        const response = await axios.put(
          this.$parent.NombreRuta + "/api/registrarasistencia?extracted=" + extracted
        );
        
        toastr.success('Asistencia registrada con éxito');
        
      } catch (error) {
        console.error('Error al registrar asistencia:', error);
        toastr.error('Error al registrar asistencia');
      } finally {
        this.botonRegistrar = false;
        this.obtenerDatosFicha(this.extractedId); 
      }
    }
  },
  mounted() {
    // this.obtenerDatosFicha();
  }
}
</script> 