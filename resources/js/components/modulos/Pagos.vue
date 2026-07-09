7<template>
    <div>
        <div class="card mb-5 mb-xl-8">
            <div class="card-header border-0 pt-5">
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label fw-bold fs-3 mb-1">Pago de admisión</span>
                    <span class="text-muted mt-1 fw-semibold fs-7">Sube la foto del voucher del pago de S/. 350</span>
                </h3>
            </div>
            <div class="card-body py-3">
                <div>
                    <ul class="nav nav-pills mb-8 mt-8 nav-fill" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="pills-profile-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile"
                                aria-selected="false">SUBIR COMPROBANTE DE PAGO</button>
                        </li>
                        <!--<li class="nav-item" role="presentation">
                        <button class="nav-link" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">PAGO CON TARJETA</button>
                    </li>-->

                    </ul>
                    <div class="tab-content" id="pills-tabContent">
                        <!-- Panel de PAGO CON TARJETA Aqui iva el bloque de pago con tarjeta-->
                        <div class="tab-pane fade  show active" id="pills-profile" role="tabpanel"
                            aria-labelledby="pills-profile-tab">
                            <!-- <div>
                                <h4>
                                    Prospecto           : S/50.00
                                </h4>
                                <h4>
                                    Derecho de examen   : S/200.00
                                </h4>
                                <h4>
                                    Recargo extemporaneo: S/50.00
                                </h4>
                                <h3>
                                    Monto a pagar      : S/ 280.00
                                </h3>
                            </div> -->
                            <div class="table-responsive">
                                <table class="table align-middle gs-0 gy-4">
                                    <thead>
                                        <tr class="fw-bold bg-primary text-inverse-primary">
                                            <th class="ps-4 rounded-start">Concepto</th>
                                            <th class="min-w-125px">Subir archivo</th>
                                            <th>Código Pago</th>
                                            <th style="max-width: 75px">Fecha Pago</th>

                                            <th class="min-w-125px">Archivo enviado</th>
                                            <th class="min-w-125px">Estado</th>
                                            <th class="text-center rounded-end">Detalle</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-if="loadingPagos">
                                            <td colspan="6" class="text-center">
                                                <div class="spinner-border text-primary" role="status">
                                                    <span class="sr-only">Loading...</span>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr v-if="!loadingPagos"
                                            class="bg-active-secondary text-active-inverse-secondary active">
                                            <td colspan="7" class="ps-5">PAGO UNICO</td>
                                        </tr>
                                        <tr v-if="!loadingPagos">
                                            <td class="ps-4">
                                                <span>Prospecto y derecho de examen</span>
                                            </td>
                                            <td>
                                                <!-- <div class="input-group">
                                               <input type="file" @change="select_file_ambos" :disabled="comprobanteAmbos.id_estado_revision==3 || !activarPagos || comprobanteAmbos.id_estado==0" class="form-control" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04" aria-label="Upload">
                                               <button class="btn btn-primary" v-if="comprobanteAmbos.id_estado_revision==3" type="button" disabled id="inputGroupFileAddon04">Subir</button>
                                               <button :disabled="btnEnviandoAmbos || !activarPagos  || comprobanteAmbos.id_estado==0" class="btn btn-primary" @click="guardar(comprobanteAmbos)" v-else type="button" id="inputGroupFileAddon04">
                                                    <span v-show="!btnEnviandoAmbos">Subir</span>
                                                    <span v-show="btnEnviandoAmbos">&nbsp;&nbsp;</span>
                                                    <span v-show="btnEnviandoAmbos" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                                    <span v-show="btnEnviandoAmbos">&nbsp;&nbsp;</span>
                                                </button>
                                           </div> -->
                                                <!-- HABILITA EL BOTÓN DE SUBIR EN PROSPECTO Y DERECHO DE EXAMEN -->
                                                <div class="input-group">
                                                    <button type="button" class="btn btn-primary"
                                                        @click="editarPago(comprobanteAmbos)" data-bs-toggle="modal"
                                                        data-bs-target="#kt_modal_1">Subir</button>
                                                </div>

                                            </td>
                                            <td>
                                                <!-- <input type="text" v-model="comprobanteAmbos.codigo_pago" :disabled="comprobanteAmbos.id_estado_revision==3 || !activarPagos || comprobanteAmbos.id_estado==0" class="form-control"/> -->
                                                {{ comprobanteAmbos.codigo_pago }}
                                            </td>
                                            <td>
                                                {{ comprobanteAmbos.fecha_pago }}
                                            </td>


                                            <td class="text-center">
                                                <a v-if="comprobanteAmbos.enlace && comprobanteAmbos.id_medio_pago == 1"
                                                    :href="'storage/pagos/' + comprobanteAmbos.enlace" target="_blank">
                                                    <span class="menu-icon">
                                                        <span class="svg-icon svg-icon-2">
                                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                                xmlns="http://www.w3.org/2000/svg">
                                                                <path
                                                                    d="M20 14H18V10H20C20.6 10 21 10.4 21 11V13C21 13.6 20.6 14 20 14ZM21 19V17C21 16.4 20.6 16 20 16H18V20H20C20.6 20 21 19.6 21 19ZM21 7V5C21 4.4 20.6 4 20 4H18V8H20C20.6 8 21 7.6 21 7Z"
                                                                    fill="currentColor"></path>
                                                                <path opacity="0.3"
                                                                    d="M17 22H3C2.4 22 2 21.6 2 21V3C2 2.4 2.4 2 3 2H17C17.6 2 18 2.4 18 3V21C18 21.6 17.6 22 17 22ZM10 7C8.9 7 8 7.9 8 9C8 10.1 8.9 11 10 11C11.1 11 12 10.1 12 9C12 7.9 11.1 7 10 7ZM13.3 16C14 16 14.5 15.3 14.3 14.7C13.7 13.2 12 12 10.1 12C8.10001 12 6.49999 13.1 5.89999 14.7C5.59999 15.3 6.19999 16 7.39999 16H13.3Z"
                                                                    fill="currentColor">
                                                                </path>
                                                            </svg>
                                                        </span>
                                                    </span>
                                                </a>
                                            </td>
                                            <td>
                                                <span
                                                    v-if="comprobanteAmbos.id_estado_revision == 1 && comprobanteAmbos.id_medio_pago == 1"
                                                    class="badge badge-light-warning fs-7 fw-bold">Pendiente</span>
                                                <span
                                                    v-if="comprobanteAmbos.id_estado_revision == 2 && comprobanteAmbos.id_medio_pago == 1"
                                                    class="badge badge-light-danger fs-7 fw-bold">Rechazado</span>
                                                <span
                                                    v-if="comprobanteAmbos.id_estado_revision == 3 && comprobanteAmbos.id_medio_pago == 1"
                                                    class="badge badge-light-success fs-7 fw-bold">Validado</span>
                                            </td>
                                            <td class="text-init">
                                                <span>{{ comprobanteAmbos.observacion }}</span>
                                            </td>
                                        </tr>
                                        <!-- Aqui iva el bloque de pagos por separado -->

                                        <!--<tr v-if="!loadingPagos && extemporaneo">-->
                                        <!--<td class="ps-4">
                                           <span>Rezagado(S/50.00)</span>
                                       </td>-->
                                        <!-- <td> -->
                                        <!-- <div class="input-group">
                                               <input type="file" @change="select_file_examen" :disabled="comprobanteDerechoExamen.id_estado_revision==3 || !activarPagos" class="form-control" aria-label="Upload">
                                               <button class="btn btn-primary" v-if="comprobanteDerechoExamen.id_estado_revision==3" type="button" disabled id="inputGroupFileAddon04">Subir</button>
                                               <button class="btn btn-primary" @click="guardar(comprobanteDerechoExamen)" :disabled="!activarPagos" v-else type="button" id="inputGroupFileAddon04">Subir</button>
                                           </div>  -->
                                        <!-- <div class="input-group">
                                                <button type="button" class="btn btn-primary" @click="editarPago(comprobanteExtemporaneo)" data-bs-toggle="" data-bs-target="#kt_modal_1">Subir</button>
                                            </div> -->
                                        <!-- </td> -->
                                        <!--<td>
                                            {{comprobanteExtemporaneo.codigo_pago}}
                                        </td>
                                        <td>
                                            {{comprobanteExtemporaneo.fecha_pago}}
                                        </td>

                                        <td class="text-center">
                                           <a v-if="comprobanteExtemporaneo.enlace && comprobanteExtemporaneo.id_medio_pago==1" :href="'storage/pagos/'+comprobanteDerechoExamen.enlace" target="_blank">
                                               <span class="menu-icon">
                                                   <span class="svg-icon svg-icon-2">
                                                       <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                           <path d="M20 14H18V10H20C20.6 10 21 10.4 21 11V13C21 13.6 20.6 14 20 14ZM21 19V17C21 16.4 20.6 16 20 16H18V20H20C20.6 20 21 19.6 21 19ZM21 7V5C21 4.4 20.6 4 20 4H18V8H20C20.6 8 21 7.6 21 7Z" fill="currentColor"></path> 
                                                           <path opacity="0.3" d="M17 22H3C2.4 22 2 21.6 2 21V3C2 2.4 2.4 2 3 2H17C17.6 2 18 2.4 18 3V21C18 21.6 17.6 22 17 22ZM10 7C8.9 7 8 7.9 8 9C8 10.1 8.9 11 10 11C11.1 11 12 10.1 12 9C12 7.9 11.1 7 10 7ZM13.3 16C14 16 14.5 15.3 14.3 14.7C13.7 13.2 12 12 10.1 12C8.10001 12 6.49999 13.1 5.89999 14.7C5.59999 15.3 6.19999 16 7.39999 16H13.3Z" fill="currentColor">
                                                           </path>
                                                       </svg>
                                                   </span>
                                               </span>
                                           </a>
                                       </td>
                                       <td>
                                           <span v-if="comprobanteExtemporaneo.id_estado_revision==1 && comprobanteExtemporaneo.id_medio_pago==1" class="badge badge-light-warning fs-7 fw-bold">Pendiente</span>
                                           <span v-if="comprobanteExtemporaneo.id_estado_revision==2 && comprobanteExtemporaneo.id_medio_pago==1" class="badge badge-light-danger fs-7 fw-bold">Rechazado</span>
                                           <span v-if="comprobanteExtemporaneo.id_estado_revision==3 && comprobanteExtemporaneo.id_medio_pago==1" class="badge badge-light-success fs-7 fw-bold">Validado</span>
                                       </td>
                                       <td class="text-init">
                                           <span>{{comprobanteExtemporaneo.observacion}}</span>
                                       </td>-->
                                        <!--</tr>-->
                                        <tr v-if="!loadingPagos && ficha != 0 && ficha[0].postulacion == 2"
                                            class="bg-active-secondary text-active-inverse-secondary active">
                                            <td colspan="7" class="ps-5">PAGOS POR SEGUNDA POSTULACIÓN</td>
                                        </tr>
                                        <tr v-if="!loadingPagos && ficha != 0 && ficha[0].postulacion == 2">
                                            <td class="ps-4">
                                                <span>Derecho de examen(SEGUNDA POSTULACIÓN)</span>
                                            </td>
                                            <td>

                                                <div class="input-group">
                                                    <button type="button" class="btn btn-primary"
                                                        @click="editarPago(comprobanteDerechoExamenSegunda)"
                                                        data-bs-toggle="modal" data-bs-target="#kt_modal_1">Subir</button>
                                                </div>
                                            </td>
                                            <td>
                                                {{ comprobanteDerechoExamenSegunda.codigo_pago }}
                                            </td>
                                            <td>
                                                {{ comprobanteDerechoExamenSegunda.fecha_pago }}
                                            </td>

                                            <td class="text-center">
                                                <a v-if="comprobanteDerechoExamenSegunda.enlace"
                                                    :href="'storage/pagos/' + comprobanteDerechoExamenSegunda.enlace"
                                                    target="_blank">
                                                    <span class="menu-icon">
                                                        <span class="svg-icon svg-icon-2">
                                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                                xmlns="http://www.w3.org/2000/svg">
                                                                <path
                                                                    d="M20 14H18V10H20C20.6 10 21 10.4 21 11V13C21 13.6 20.6 14 20 14ZM21 19V17C21 16.4 20.6 16 20 16H18V20H20C20.6 20 21 19.6 21 19ZM21 7V5C21 4.4 20.6 4 20 4H18V8H20C20.6 8 21 7.6 21 7Z"
                                                                    fill="currentColor"></path>
                                                                <path opacity="0.3"
                                                                    d="M17 22H3C2.4 22 2 21.6 2 21V3C2 2.4 2.4 2 3 2H17C17.6 2 18 2.4 18 3V21C18 21.6 17.6 22 17 22ZM10 7C8.9 7 8 7.9 8 9C8 10.1 8.9 11 10 11C11.1 11 12 10.1 12 9C12 7.9 11.1 7 10 7ZM13.3 16C14 16 14.5 15.3 14.3 14.7C13.7 13.2 12 12 10.1 12C8.10001 12 6.49999 13.1 5.89999 14.7C5.59999 15.3 6.19999 16 7.39999 16H13.3Z"
                                                                    fill="currentColor">
                                                                </path>
                                                            </svg>
                                                        </span>
                                                    </span>
                                                </a>
                                            </td>
                                            <td>
                                                <span v-if="comprobanteDerechoExamenSegunda.id_estado_revision == 1"
                                                    class="badge badge-light-warning fs-7 fw-bold">Pendiente</span>
                                                <span v-if="comprobanteDerechoExamenSegunda.id_estado_revision == 2"
                                                    class="badge badge-light-danger fs-7 fw-bold">Rechazado</span>
                                                <span v-if="comprobanteDerechoExamenSegunda.id_estado_revision == 3"
                                                    class="badge badge-light-success fs-7 fw-bold">Validado</span>
                                            </td>
                                            <td class="text-init">
                                                <span>{{ comprobanteDerechoExamenSegunda.observacion }}</span>
                                            </td>
                                        </tr>
                                        <tr v-if="!loadingPagos && ficha != 0 && ficha[0].postulacion == 3"
                                            class="bg-active-secondary text-active-inverse-secondary active">
                                            <td colspan="7" class="ps-5">PAGOS POR TERCERA POSTULACIÓN</td>
                                        </tr>
                                        <tr v-if="!loadingPagos && ficha != 0 && ficha[0].postulacion == 3">
                                            <td class="ps-4">
                                                <span>Derecho de examen(TERCERA POSTULACIÓN)</span>
                                            </td>
                                            <td>

                                                <div class="input-group">
                                                    <button type="button" class="btn btn-primary"
                                                        @click="editarPago(comprobanteDerechoExamenTercero)"
                                                        data-bs-toggle="modal" data-bs-target="#kt_modal_1">Subir</button>
                                                </div>
                                            </td>
                                            <td>
                                                {{ comprobanteDerechoExamenTercero.codigo_pago }}
                                            </td>
                                            <td>
                                                {{ comprobanteDerechoExamenTercero.fecha_pago }}
                                            </td>

                                            <td class="text-center">
                                                <a v-if="comprobanteDerechoExamenTercero.enlace"
                                                    :href="'storage/pagos/' + comprobanteDerechoExamenTercero.enlace"
                                                    target="_blank">
                                                    <span class="menu-icon">
                                                        <span class="svg-icon svg-icon-2">
                                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                                xmlns="http://www.w3.org/2000/svg">
                                                                <path
                                                                    d="M20 14H18V10H20C20.6 10 21 10.4 21 11V13C21 13.6 20.6 14 20 14ZM21 19V17C21 16.4 20.6 16 20 16H18V20H20C20.6 20 21 19.6 21 19ZM21 7V5C21 4.4 20.6 4 20 4H18V8H20C20.6 8 21 7.6 21 7Z"
                                                                    fill="currentColor"></path>
                                                                <path opacity="0.3"
                                                                    d="M17 22H3C2.4 22 2 21.6 2 21V3C2 2.4 2.4 2 3 2H17C17.6 2 18 2.4 18 3V21C18 21.6 17.6 22 17 22ZM10 7C8.9 7 8 7.9 8 9C8 10.1 8.9 11 10 11C11.1 11 12 10.1 12 9C12 7.9 11.1 7 10 7ZM13.3 16C14 16 14.5 15.3 14.3 14.7C13.7 13.2 12 12 10.1 12C8.10001 12 6.49999 13.1 5.89999 14.7C5.59999 15.3 6.19999 16 7.39999 16H13.3Z"
                                                                    fill="currentColor">
                                                                </path>
                                                            </svg>
                                                        </span>
                                                    </span>
                                                </a>
                                            </td>
                                            <td>
                                                <span v-if="comprobanteDerechoExamenTercero.id_estado_revision == 1"
                                                    class="badge badge-light-warning fs-7 fw-bold">Pendiente</span>
                                                <span v-if="comprobanteDerechoExamenTercero.id_estado_revision == 2"
                                                    class="badge badge-light-danger fs-7 fw-bold">Rechazado</span>
                                                <span v-if="comprobanteDerechoExamenTercero.id_estado_revision == 3"
                                                    class="badge badge-light-success fs-7 fw-bold">Validado</span>
                                            </td>
                                            <td class="text-init">
                                                <span>{{ comprobanteDerechoExamenTercero.observacion }}</span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" tabindex="-1" id="kt_modal_1" v-if="verModalVaucher" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h3 v-if="subirPago.id_tipo_pago == 1" class="modal-title">PROSPECTO</h3>
                                    <h3 v-if="subirPago.id_tipo_pago == 2" class="modal-title">D. EXAMEN</h3>
                                    <h3 v-if="subirPago.id_tipo_pago == 3" class="modal-title">PROSPECTO Y D. EXAMEN</h3>
                                    <h3 v-if="subirPago.id_tipo_pago == 4" class="modal-title">RECARGO REZAGADOS (S/ 50.00)
                                    </h3>
                                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                                        aria-label="Close">
                                        <span class="svg-icon svg-icon-1">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1"
                                                    transform="rotate(-45 6 17.3137)" fill="currentColor"></rect>
                                                <rect x="7.41422" y="6" width="16" height="2" rx="1"
                                                    transform="rotate(45 7.41422 6)" fill="currentColor"></rect>
                                            </svg>
                                        </span>
                                    </div>
                                </div>
                                <form id="requisitos-modalidad" @submit.prevent="guardar(subirPago)">
                                    <div class="modal-body">
                                        <div>
                                            <div class="form-group m-form__group m--margin-top-10">
                                                <div>
                                                    <h4 class="mb-3">¿A qué cuenta realizaste el pago?</h4>
                                                    <div class="mb-3">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" value="1"
                                                                id="flexCheckDefault1" v-model="subirPago.cuenta_pago"
                                                                name="radio_banco" required
                                                                :disabled="subirPago.id_estado_revision == 3 || !activarPagos || desactivarPagos">
                                                            <label class="form-check-label" for="flexCheckDefault1">
                                                                Cuenta del Banco Interbank (Agente, Ventanilla o
                                                                tranferencia)
                                                            </label>
                                                        </div>
                                                    </div>

                                                    <div class="mb-3">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" value="2"
                                                                id="flexCheckDefault2" v-model="subirPago.cuenta_pago"
                                                                name="radio_banco"
                                                                :disabled="subirPago.id_estado_revision == 3 || !activarPagos || desactivarPagos">
                                                            <label class="form-check-label" for="flexCheckDefault2">
                                                                Cuenta del Banco de la Nación(Agente, Ventanilla o
                                                                tranferencia)
                                                            </label>
                                                        </div>
                                                    </div>

                                                    <div class="mb-3">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" value="3"
                                                                id="flexCheckDefault3" v-model="subirPago.cuenta_pago"
                                                                name="radio_banco"
                                                                :disabled="subirPago.id_estado_revision == 3 || !activarPagos || desactivarPagos">
                                                            <label class="form-check-label" for="flexCheckDefault3">
                                                                Oficina de tesoreria de la UNDC
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div>
                                                    <label for="">Fecha de pago</label>
                                                    <input type="date" v-model="subirPago.fecha_pago"
                                                        :disabled="subirPago.id_estado_revision == 3 || !activarPagos || desactivarPagos"
                                                        class="form-control m-input" placeholder="Seleccione fecha"
                                                        autocomplete="off" required>
                                                </div>
                                                <div>
                                                    <label for="">Código de pago</label>
                                                    <input type="text" v-model="subirPago.codigo_pago"
                                                        :disabled="subirPago.id_estado_revision == 3 || !activarPagos || desactivarPagos"
                                                        class="form-control" />
                                                </div>

                                                <div class="form-group m-form__group">
                                                    <label for="exampleInputEmail1">
                                                        File Browser
                                                    </label>
                                                    <!-- <div>
                                                    </div>
                                                    <label class="custom-file text-left">
                                                        <input type="file" class="form-control-file" id="file3" ref="file3">
                                                        <label for="exampleFormControlFile1">Formato admitido: PDF, RAR.</label>
                                                    </label> -->
                                                    <div class="input-group mb-3">
                                                        <input type="file" @change="select_file_prospecto"
                                                            :disabled="subirPago.id_estado_revision == 3 || !activarPagos || desactivarPagos"
                                                            class="form-control" id="inputGroupFile04"
                                                            aria-describedby="inputGroupFileAddon04" aria-label="Upload"
                                                            required>
                                                        <!-- <label class="input-group-text" for="inputGroupFile02">Upload</label> -->
                                                    </div>
                                                    <label for="exampleFormControlFile1">Formato admitido: PDF, PNG,
                                                        JPG.</label>
                                                </div>
                                            </div>

                                        </div>
                                        <div v-if="subirPago.id_tipo_pago == 20">
                                            <div class="form-group m-form__group m--margin-top-10">
                                                <div class="alert m-alert m-alert--default" role="alert">
                                                    El archivo debe contener los siguientes documentos. <br>
                                                    <div v-if="id_modalidad_usu == 1">
                                                        - Declaración jurada requisito del ingresante. <br>
                                                    </div>
                                                    <div v-else>
                                                        - Requisito por modalidad. <br>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group m-form__group">
                                                <label for="exampleInputEmail1">
                                                    File Browser
                                                </label>
                                                <div class="input-group mb-3">
                                                    <input
                                                        v-if="subirPago.id_estado_revision == 0 || subirPago.id_estado_revision == 1 || subirPago.id_estado_revision == 2"
                                                        type="file" class="form-control" id="file2" ref="file2"
                                                        v-on:change="handleFileUpload(2)">
                                                    <input v-if="subirPago.id_estado_revision == 3 || subirPago == 0"
                                                        type="file" class="form-control" id="file2" ref="file2"
                                                        v-on:change="handleFileUpload(2)" disabled>
                                                </div>
                                                <label for="exampleFormControlFile1">Formato admitido: PDF, RAR.</label>
                                            </div>
                                        </div>
                                        <div v-else-if="subirPago.id_tipo_pago == 33">
                                            <div class="form-group m-form__group m--margin-top-10">
                                                <div class="alert m-alert m-alert--default" role="alert">
                                                    Consideraciones(enviar en un solo archivo).<br>
                                                    - Debe vizualizarse los datos.<br>
                                                    - Debe estar ambas caras del DNI. <br>
                                                    - En caso de perdida subir el C4(certificado de inscripción). <br>
                                                    <br>
                                                </div>
                                            </div>
                                            <div class="form-group m-form__group">
                                                <label for="exampleInputEmail1">
                                                    File Browser
                                                </label>
                                                <!-- <di
                                                </div>
                                                <label class="custom-file text-left">
                                                    <input type="file" class="form-control-file" id="file3" ref="file3">
                                                    <label for="exampleFormControlFile1">Formato admitido: PDF, RAR.</label>
                                                </label> -->
                                                <div class="input-group mb-3">
                                                    <input
                                                        v-if="subirPago.id_estado_revision == 0 || subirPago.id_estado_revision == 1 || subirPago.id_estado_revision == 2"
                                                        type="file" class="form-control" id="file3" ref="file3"
                                                        v-on:change="handleFileUpload(3)">
                                                    <input v-if="subirPago.id_estado_revision == 3 || subirPago == 0"
                                                        type="file" class="form-control" id="file3" ref="file3"
                                                        v-on:change="handleFileUpload(3)" disabled>
                                                    <!-- <label class="input-group-text" for="inputGroupFile02">Upload</label> -->
                                                </div>
                                                <label for="exampleFormControlFile1">Formato admitido: PDF, JPG, PNG,
                                                    JPEG.</label>
                                            </div>
                                        </div>
                                        <div v-else-if="subirPago.id_tipo_pago == 44" class="row">
                                            <div class="form-group m-form__group m--margin-top-10 col-md-6">
                                                <div class="alert m-alert m-alert--default" role="alert">
                                                    Subir una fotografía reciente.<br>
                                                    - Sin gafas ni prendas en la cabeza.
                                                    - Tamaño: 240x288.<br>
                                                    - Resolución: 300 DPI.<br>
                                                    - Peso: 60 KB.<br>
                                                    - Formato JPG - Fondo blanco.<br>
                                                    <br>
                                                    <br>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <img width="200px" height="250px" :src="enlacefoto(subirPago.enlace)"
                                                    style="border: 2px solid #3c3b3b;" />
                                                <!-- <img v-else width="200px" height="250px" :src="item.enlace" /> -->
                                            </div>
                                            <div class="form-group m-form__group">
                                                <label for="exampleInputEmail1">
                                                    File Browser
                                                </label>
                                                <div class="input-group mb-3">
                                                    <input
                                                        v-if="subirPago.id_estado_revision == 0 || subirPago.id_estado_revision == 1 || subirPago.id_estado_revision == 2"
                                                        type="file" class="form-control" id="file4" ref="file4"
                                                        v-on:change="handleFileUpload(4)">
                                                    <input v-if="subirPago.id_estado_revision == 3 || subirPago == 0"
                                                        type="file" class="form-control" id="file4" ref="file4"
                                                        v-on:change="handleFileUpload(4)" disabled>
                                                </div>
                                                <label for="exampleFormControlFile1">Formato admitido: PNG, JPG,
                                                    JPEG.</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" id="btnCerrarModal" class="btn btn-light"
                                            data-bs-dismiss="modal">Cerrar</button>
                                        <button type="submit" class="btn btn-primary"
                                            :disabled='subirPago.id_estado_revision == 3 || subirPago == 0 || !activarPagos || subirPago.id_estado == 0 || btnEnviando || desactivarPagos'>
                                            <span v-show="!btnEnviando">Enviar</span>
                                            <span v-show="btnEnviando">&nbsp;&nbsp;</span>
                                            <span v-show="btnEnviando" class="spinner-border spinner-border-sm"
                                                role="status" aria-hidden="true"></span>
                                            <span v-show="btnEnviando">&nbsp;&nbsp;</span>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" tabindex="-1" id="kt_modal_2">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h3 class="modal-title">COMPROBANTE DE PAGO - AGENTE</h3>

                                    <!--begin::Close-->
                                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                                        aria-label="Close">
                                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                                        <span class="svg-icon svg-icon-1"><svg width="24" height="24" viewBox="0 0 24 24"
                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1"
                                                    transform="rotate(-45 6 17.3137)" fill="currentColor"></rect>
                                                <rect x="7.41422" y="6" width="16" height="2" rx="1"
                                                    transform="rotate(45 7.41422 6)" fill="currentColor"></rect>
                                            </svg>
                                        </span>
                                        <!--end::Svg Icon-->
                                    </div>
                                    <!--end::Close-->
                                </div>

                                <div class="modal-body">
                                    <img :src="$parent.NombreRuta + '/assets/media/images/pago_agente.jpg'" alt="">
                                </div>

                                <div class="modal-footer" style="margin-inline: auto;">
                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cerrar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" tabindex="-1" id="kt_modal_3">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h3 class="modal-title">COMPROBANTE DE PAGO - VENTANILLA</h3>

                                    <!--begin::Close-->
                                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                                        aria-label="Close">
                                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                                        <span class="svg-icon svg-icon-1"><svg width="24" height="24" viewBox="0 0 24 24"
                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1"
                                                    transform="rotate(-45 6 17.3137)" fill="currentColor"></rect>
                                                <rect x="7.41422" y="6" width="16" height="2" rx="1"
                                                    transform="rotate(45 7.41422 6)" fill="currentColor"></rect>
                                            </svg>
                                        </span>
                                        <!--end::Svg Icon-->
                                    </div>
                                    <!--end::Close-->
                                </div>

                                <div class="modal-body">
                                    <img :src="$parent.NombreRuta + '/assets/media/images/pago_ventanilla.jpg'" alt="">
                                </div>

                                <div class="modal-footer" style="margin-inline: auto;">
                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cerrar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--begin::Body-->
            </div>
        </div>
        <div class="rounded border p-5">
            <h4>EJEMPLOS: CÓDIGO DE PAGO/OPERACIÓN</h4>
            <button data-bs-toggle="modal" data-bs-target="#kt_modal_2" class="btn btn-info me-2 mb-2">Modelo
                Agente</button>
            <button data-bs-toggle="modal" data-bs-target="#kt_modal_3" class="btn btn-info me-2 mb-2">Modelo
                Ventanilla</button>
        </div>
        <div class="d-flex justify-content-end">
            <router-link to="/prospecto" class="btn btn-primary">Siguiente <i
                    class="bi bi-arrow-right fs-2"></i></router-link>
        </div>
    </div>
</template>
<script>

export default {
    name: 'pagos',
    data() {
        return {
            datos: [],
            ficha: [],
            //MODAL REGISTER:1 MODAL EDIT:0
            tipoModal: 1,
            loadingPagos: true,
            btnEnviandoProspecto: false,
            btnEnviandoExamen: false,
            btnEnviandoAmbos: false,
            btnEnviando: false,
            csrfToken: null,
            pagoProspecto: false,
            pagoExamen: false,
            pagoAmbos: false,
            msgPago: '',
            estadoPago: '',
            colegioOrigen: '',
            montoTotal: 0,
            totalSumado: 0,
            comision: 0.045,
            subTotal: 0,
            gastoOpertivo: 0,
            i: 0,
            valor: 0,
            url: '',
            urlPago: '',
            modalidad_pago: 3,

            verModalVaucher: true,

            extemporaneo: true,
            //fecha_cierre_inscripciones: '2023-02-28 11:59:59',
            inicio_extemporaneo: '2023-01-03 00:00:00',
            ////////
            montoPagar: 0,
            opcionesPago: {
                prospecto: false,
                rezagado: false,
                modalidad: '',
                gestionColegio: ''
            },
            ////////////

            datosRegistro: {
                name: "",
                email: "",
                password: ""
            },
            defaulRegistro: {
                name: "",
                email: "",
                password: ""
            },
            comprobanteProspecto: {
                codigo_pago: '',
                id_tipo_pago: 1,
                created: 0,
                archivo: null
            },
            comprobanteDerechoExamen: {
                codigo_pago: '',
                id_tipo_pago: 2,
                created: 0,
                archivo: null
            },
            comprobanteAmbos: {
                codigo_pago: '',
                id_tipo_pago: 3,
                created: 0,
                archivo: null
            },
            comprobanteExtemporaneo: {
                codigo_pago: '',
                id_tipo_pago: 4,
                created: 0,
                archivo: null
            },
            comprobanteDerechoExamenSegunda: {
                codigo_pago: '',
                id_tipo_pago: 5,
                created: 0,
                archivo: null
            },
            comprobanteDerechoExamenTercero: {
                codigo_pago: '',
                id_tipo_pago: 6,
                created: 0,
                archivo: null
            },
            subirPago: {
                user_id: '',
                id_tipo_pago: '',
                id_ficha: '',
                tipo_enlace: '',
                enlace: '',
                id_estado_revision: '',
                codigo_pago: '',
                fecha_pago: '',
                comentario: '',
                cuenta_pago: ''
            },
        }
    },
    mounted() {
        const url = window.location.search;
        const urlParametro = new URLSearchParams(url);
        const parametro = urlParametro.get("pago");



        if (parametro) {
            if (parametro == 'success') {
                this.estadoPago = 3
                this.msgPago = "Pago exitoso"
            } else {
                this.estadoPago = 2
                this.msgPago = "Pago no completado"
            }
        } else {
        }

        /* const inputs = document.getElementsByClassName("form-check-input");
        for (let i = 0; i < inputs.length; i++) {
            inputs[i].checked = false;;
        } */

        //document.getElementById('inputA').checked=true;




        this.mostrarDatos()
        //this.verificarExtemporaneo()
        this.obtenerFicha()
        //document.getElementById('CheckProspecto').checked=false;
        let elementoModalidad = document.getElementById('selectModalidad');
        if (elementoModalidad) {
            elementoModalidad.value = ''
        }
        let elementoGestionColegio = document.getElementById('selectGestionColegio');
        if (elementoGestionColegio) {
            elementoGestionColegio.value = ''
        }
        //this.desactivarCheckProspecto()
        setTimeout(function () {
            document.getElementById('CheckProspecto').checked = false
        }, 500);
    },
    methods: {
        async mostrarDatos() {
            this.loadingPagos = true
            await axios
                .get(this.$parent.NombreRuta + "/api/pagos")
                .then((response) => {
                    this.datos = response.data;
                    this.asignar(response.data)
                    this.loadingPagos = false
                })
                .catch(function (error) {
                    this.loadingPagos = false
                    this.datos = [];
                });
        },
        async obtenerFicha() {
            await axios
                .get(this.$parent.NombreRuta + "/api/fichas")
                .then((response) => {
                    this.ficha = response.data
                    if (response.data[0].extemporaneo == 0) {
                        this.extemporaneo = false
                    } else {
                        this.extemporaneo = true
                    }
                    // mostrar si el postulante es extemporaneo
                    // console.log(response.data[0].extemporaneo)
                })
                .catch(function (error) {
                    this.ficha = [];
                });
        },
        async crear(datos) {
            this.btnEnviando = true
            var formData = new FormData();
            formData.append("archivo", datos.archivo);
            formData.append("cuenta_pago", datos.cuenta_pago);
            formData.append("codigo_pago", datos.codigo_pago);
            formData.append("id_tipo_pago", datos.id_tipo_pago);
            formData.append("fecha_pago", datos.fecha_pago);

            this.axios.post(this.$parent.NombreRuta + `/api/pagos`, formData)
                .then((response) => {
                    this.mostrarDatos()
                    this.btnEnviando = false
                    document.getElementById("inputGroupFile04").value = "";
                    /* if(datos.id_tipo_pago==3){
                        this.$router.push({ name: 'inscripcion' })
                    } */
                    //location.href ="/login";
                    if (response.data.success == 1) {
                        toastr.options = {
                            "positionClass": "toastr-bottom-right",
                            "timeOut": "5000"
                        };
                        toastr.success('archivo enviado');
                        this.cerrarModal()
                    } else {
                        toastr.options = {
                            "positionClass": "toastr-bottom-right",
                            "timeOut": "5000"
                        };
                        toastr.error('archivo no enviado');
                    }
                })
                .catch((error) => {
                    this.btnEnviando = false
                    this.errors = error.response.data.errors;
                    toastr.options = {
                        "positionClass": "toastr-bottom-right",
                        "timeOut": "5000"
                    };
                    toastr.error('Archivo no enviado');
                });
        },
        async enviar(datos) {
            this.btnEnviando = true
            if (datos.id_tipo_pago == 1) {
                this.btnEnviandoProspecto = true
            } if (datos.id_tipo_pago == 2) {
                this.btnEnviandoExamen = true
            } if (datos.id_tipo_pago == 3) {
                this.btnEnviandoAmbos = true
            }

            var formData = new FormData();
            formData.append("archivo", datos.archivo);
            formData.append("cuenta_pago", datos.cuenta_pago);
            formData.append("codigo_pago", datos.codigo_pago);
            formData.append("fecha_pago", datos.fecha_pago);


            this.axios.post(this.$parent.NombreRuta + `/api/pagos/` + datos.id + `?_method=PUT`, formData)
                .then((response) => {
                    this.btnEnviando = false
                    document.getElementById("inputGroupFile04").value = "";
                    this.mostrarDatos()
                    if (response.data.success == 1) {
                        toastr.options = {
                            "positionClass": "toastr-bottom-right",
                            "timeOut": "5000"
                        };
                        toastr.success('archivo enviado');
                        this.cerrarModal()
                    } else {
                        toastr.options = {
                            "positionClass": "toastr-bottom-right",
                            "timeOut": "5000"
                        };
                        toastr.error('archivo no enviado');
                    }
                    if (datos.id_tipo_pago == 1) {
                        this.btnEnviandoProspecto = false
                    } if (datos.id_tipo_pago == 2) {
                        this.btnEnviandoExamen = false
                    } if (datos.id_tipo_pago == 3) {
                        this.btnEnviandoAmbos = false
                    }
                    //location.href ="/login";
                })
                .catch((error) => {
                    this.btnEnviando = false
                    if (datos.id_tipo_pago == 1) {
                        this.btnEnviandoProspecto = false
                    } if (datos.id_tipo_pago == 2) {
                        this.btnEnviandoExamen = false
                    } if (datos.id_tipo_pago == 3) {
                        this.btnEnviandoAmbos = false
                    }
                    this.errors = error.response.data.errors;
                    toastr.options = {
                        "positionClass": "toastr-bottom-right",
                        "timeOut": "5000"
                    };
                    toastr.error('Archivo no enviado');
                });
        },
        guardar(datos) {
            if (datos.created == 0) {
                this.crear(datos)
            } else {
                this.enviar(datos)
            }
            /* if(this.datos==0){
                this.crear(datos)
            }
            if(this.datos!=0  && datos.created){
                this.enviar(datos)
            } */
        },
        asignar(datos) {

            if (datos != 0) {
                datos.forEach(object => {
                    if ((object.id_tipo_pago === 1 && object.id_medio_pago == 1) || (object.id_tipo_pago === 1 && object.id_medio_pago == 2 && object.id_estado_revision != 3)) {
                        //this.comprobanteProspecto=object
                        this.comprobanteProspecto = Object.assign({ archivo: null }, object)
                        //this.comprobanteProspecto = Object.assign(course,grade);
                    }
                    if ((object.id_tipo_pago === 2 && object.id_medio_pago == 1) || (object.id_tipo_pago === 2 && object.id_medio_pago == 2 && object.id_estado_revision != 3)) {
                        this.comprobanteDerechoExamen = Object.assign({ archivo: null }, object)
                        //this.comprobanteDerechoExamen=object
                    }
                    if ((object.id_tipo_pago === 3 && object.id_medio_pago == 1) || (object.id_tipo_pago === 3 && object.id_medio_pago == 2 && object.id_estado_revision != 3)) {
                        this.comprobanteAmbos = Object.assign({ archivo: null }, object)
                        //this.comprobanteDerechoExamen=object
                    }
                    if ((object.id_tipo_pago === 4 && object.id_medio_pago == 1) || (object.id_tipo_pago === 4 && object.id_medio_pago == 2 && object.id_estado_revision != 3)) {
                        this.comprobanteExtemporaneo = Object.assign({ archivo: null }, object)
                        //this.comprobanteDerechoExamen=object
                    }
                    if ((object.id_tipo_pago === 5 && object.id_medio_pago == 1) || (object.id_tipo_pago === 5 && object.id_medio_pago == 2 && object.id_estado_revision != 3)) {
                        this.comprobanteDerechoExamenSegunda = Object.assign({ archivo: null }, object)
                        //this.comprobanteDerechoExamen=object
                    }
                    if ((object.id_tipo_pago === 6 && object.id_medio_pago == 1) || (object.id_tipo_pago === 6 && object.id_medio_pago == 2 && object.id_estado_revision != 3)) {
                        this.comprobanteDerechoExamenTercero = Object.assign({ archivo: null }, object)
                        //this.comprobanteDerechoExamen=object
                    }
                });

            }
        },
        editarPago(datos) {
            //this.subirDocumento = Object.assign({}, datos)
            this.subirPago = Object.assign({}, datos)
            document.getElementById("inputGroupFile04").value = "";
        },
        select_file_prospecto(event) {
            this.subirPago.archivo = event.target.files[0];
        },
        select_file_examen(event) {
            this.comprobanteDerechoExamen.archivo = event.target.files[0];
        },
        select_file_ambos(event) {
            this.comprobanteAmbos.archivo = event.target.files[0];
        },
        cerrarModal() {
            document.getElementById('btnCerrarModal').click();
        },

        pagar() {
            const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
            let token = Math.random().toString(36).substring(3, 13);

            this.urlPago = '/pasarela.php?id=' + btoa(this.$parent.UserData.id) + '&documento=' + btoa(this.$parent.UserData.numero_documento) + '&email=' + this.$parent.UserData.email +
                '&monto=' + btoa(this.montoTotal) + '&token=' + btoa(token)

            this.axios.post(this.$parent.NombreRuta + `/api/pagos/tarjeta`, {
                'prospecto': this.opcionesPago.prospecto,
                'rezagado': this.opcionesPago.rezagado,
                'modalidad': this.opcionesPago.modalidad,
                'gestionColegio': this.opcionesPago.gestionColegio,
                'monto': this.montoTotal,
                'token': token
            })
                .then((response) => {
                    //console.log(response.data)
                    if (response.data.success == 1) {
                        location.href = this.$parent.NombreRuta + this.urlPago;
                    } else {
                        toastr.options = {
                            "positionClass": "toastr-bottom-right",
                            "timeOut": "5000"
                        };
                        toastr.error('Error de pago');
                    }
                })
                .catch((error) => {
                    this.errors = error.response.data.errors;
                    //console.log(error);
                    toastr.options = {
                        "positionClass": "toastr-bottom-right",
                        "timeOut": "5000"
                    };
                    toastr.error('Error');
                });

        },
        desactivarCheckProspecto() {
            if (this.opcionesPago.prospecto) {
            } else {
                document.getElementById('CheckProspecto').checked = false
            }
        },
        verificarExtemporaneo() {
            var fecha = new Date(this.inicio_extemporaneo).toLocaleString();
            var fecha_hoy = new Date().toLocaleString();
            if (fecha > fecha_hoy) {
                this.extemporaneo = false
            } else {
                this.extemporaneo = false
            }
        },
        desactivarRecargo() {
            /* this.opcionesPago.rezagado
            if(this.opcionesPago.modalidad=='' && this.subTotal<85) {
                this.opcionesPago.rezagado==false
                document.getElementById('CheckRezagado').disabled=true
            } */
        }

    },
    computed: {
        mostrarModalidad() {
            //this.calcularTotal()
            //return this.totalSumado
            return this.modalidad_pago
        },
        desactivarPagos() {
            let estado = false
            if (this.subirPago.id_tipo_pago == 1 && (this.pagoProspecto == true || this.pagoAmbos == true)) {
                estado = true
            } else if (this.subirPago.id_tipo_pago == 2 && (this.pagoExamen == true || this.pagoAmbos == true)) {
                estado = true
            } else if (this.subirPago.id_tipo_pago == 3 && (this.pagoExamen == true || this.pagoAmbos == true || this.pagoProspecto == true)) {
                estado = true
            }
            return estado
        },
        activarPagos() {
            let sumatoria = 0
            let activarPagos = false
            for (var i = 0; i < this.datos.length; i++) {
                if (this.datos[i].id_estado_revision == 3 && (this.datos[i].id_tipo_pago == 1 || this.datos[i].id_tipo_pago == 2 || this.datos[i].id_tipo_pago == 3)) {
                    sumatoria = this.datos[i].id_tipo_pago + sumatoria
                }
                if (this.datos[i].id_estado_revision == 3 && this.datos[i].id_tipo_pago == 1) {
                    this.pagoProspecto = true
                }
                if (this.datos[i].id_estado_revision == 3 && this.datos[i].id_tipo_pago == 2) {
                    this.pagoExamen = true
                }
                if (this.datos[i].id_estado_revision == 3 && this.datos[i].id_tipo_pago == 3) {
                    this.pagoAmbos = true
                }
            };
            if (this.subirPago.id_tipo_pago == 1 || this.subirPago.id_tipo_pago == 2 || this.subirPago.id_tipo_pago == 3) {
                if (sumatoria >= 3) {
                    activarPagos = false
                } else {
                    activarPagos = true
                }
            } else if (this.subirPago.id_tipo_pago == 4) {
                activarPagos = true
            } else if (this.subirPago.id_tipo_pago == 5) {
                activarPagos = true
            } else if (this.subirPago.id_tipo_pago == 6) {
                activarPagos = true
            }

            //activarPagos = true
            return activarPagos
        },
        calcularTotalMontoPagar() {
            let montoTotalP = 0
            let comisionPago = 0
            this.subTotal = 0
            this.gastoOpertivo = 0
            if (this.opcionesPago.prospecto) {
                montoTotalP = montoTotalP + 50
            }
            if (this.opcionesPago.rezagado) {
                montoTotalP = montoTotalP + 30
            }
            if (this.opcionesPago.modalidad == 1) {
                if (this.opcionesPago.gestionColegio == 1) {
                    montoTotalP = montoTotalP + 200
                } else if (this.opcionesPago.gestionColegio == 2) {
                    montoTotalP = montoTotalP + 250
                }
            } else if (this.opcionesPago.modalidad == 2) {
                if (this.opcionesPago.gestionColegio == 1) {
                    montoTotalP = montoTotalP + 200
                } else if (this.opcionesPago.gestionColegio == 2) {
                    montoTotalP = montoTotalP + 250
                }
            } else if (this.opcionesPago.modalidad == 3) {
                montoTotalP = montoTotalP + 500
            } else if (this.opcionesPago.modalidad == 4) {
                montoTotalP = montoTotalP + 300
            } else if (this.opcionesPago.modalidad == 5) {
                if (this.opcionesPago.gestionColegio == 1) {
                    montoTotalP = montoTotalP + 200
                } else if (this.opcionesPago.gestionColegio == 2) {
                    montoTotalP = montoTotalP + 250
                }
            } else if (this.opcionesPago.modalidad == 6) {
                if (this.opcionesPago.gestionColegio == 1) {
                    montoTotalP = montoTotalP + 200
                } else if (this.opcionesPago.gestionColegio == 2) {
                    montoTotalP = montoTotalP + 250
                }
            } else if (this.opcionesPago.modalidad == 10) {
                montoTotalP = montoTotalP + 100
            }

            if (montoTotalP > 1) {


                this.subTotal = montoTotalP.toFixed(2)
                comisionPago = (montoTotalP * 0.0344) + ((montoTotalP * 0.0344) * 0.018) + 0.69
                this.gastoOpertivo = comisionPago.toFixed(2)
                montoTotalP = (montoTotalP + ((montoTotalP * 0.0344) + ((montoTotalP * 0.0344) * 0.018))) + 0.69
            }

            /* montoTotalP = montoTotalP+montoTotalP*0.045
            montoTotalP = montoTotalP.toFixed(2) */

            this.montoTotal = montoTotalP.toFixed(2)
            return montoTotalP.toFixed(2)
        }
    }

} 
</script>
