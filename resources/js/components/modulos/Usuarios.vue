<template>
<div>
	<!--begin::Tables Widget 11-->
	<div class="card mb-5 mb-xl-8">
		<!--begin::Header-->
		<div class="card-header border-0 pt-5">
			<h3 class="card-title align-items-start flex-column">
				<span class="card-label fw-bold fs-3 mb-1">Usuarios</span>
				<span class="text-muted mt-1 fw-semibold fs-7">Todos los usuarios</span>
			</h3>
			<!-- <div class="card-toolbar" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-trigger="hover" title="Click to add a user">
				<a href="#" @click.prevent="abrirModal(1)" class="btn btn-sm btn-light btn-active-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_new_address">
				<span class="svg-icon svg-icon-3">
					<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
						<rect opacity="0.5" x="11.364" y="20.364" width="16" height="2" rx="1" transform="rotate(-90 11.364 20.364)" fill="currentColor" />
						<rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="currentColor" />
					</svg>
				</span>
				Nuevo Usuario</a>
			</div> -->
		</div>
		<!--end::Header-->
		<!--begin::Body-->
		<div class="card-body py-3">
			<div class="input-group mb-5" style="display: block">
                <div class="row">
                    <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                        <label>
                            Carreras
                        </label>
                        <select class="form-select" @change="buscar(1)" aria-label="Select example" v-model.number="filtros.carrera">
                            <option value="">TODOS</option>
                            <option value="1">
                                Maestría en Gestión Pública
                            </option>
                            <option value="2">
                                Maestría en Docencia Superior e Investigación
                            </option>
                        </select>
                    </div>

                    <!-- <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                        <label>
                            Modalidades
                        </label>
                        <select class="form-select" @change="buscar(1)" aria-label="Select example" v-model.number="filtros.modalidad">
                            <option value="">TODOS</option>
                            <option value="1">Ordinario</option>
                            <option value="2">
                                Primeros Puestos
                            </option>
                            <option value="3">
                                Graduados y Titulados
                            </option>
                            <option value="10">
                                Traslado Interno
                            </option>
                            <option value="4">
                                Traslado Externo
                            </option>
                            <option value="5">
                                Ley 29973 Personas con Discapacidad
                            </option>
                            <option value="6">
                                Ley 28036 Deportitas Calificados
                            </option>
                            <option value="7">
                                Ley 27277 Victimas del Terrorismo
                            </option>
                            <option value="8">
                                Centro PRE (Ingresantes).
                            </option>
							<option value="11">
                                Quinto Secundaria
                            </option>
                        </select>
                    </div> -->
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>
                            Buscar
                        </label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" v-on:keyup.enter="buscar(2)" placeholder="Buscar por nombres o DNI" v-model="filtros.dato" aria-describedby="button-addon2">
                            <button class="btn btn-primary"  @click.prevent="buscar(0)" type="button" id="button-addon2">Buscar</button>
                        </div>
                    </div>
                    <!-- <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                        <label>
                            Estados
                        </label>
                        <select class="form-select" @change="buscar(1)" aria-label="Select example" v-model.number="filtros.estado">
                            <option value="">TODOS</option>
                            <option value="0">SIN ENVIAR</option>
                            <option value="1">PENDIENTE</option>
                            <option value="2">RECHAZADO</option>
                            <option value="3">VALIDADO</option>
                        </select>
                    </div> -->
					<div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                        <label>
                            Estado de cuenta
                        </label>
                        <select class="form-select" @change="buscar(1)" aria-label="Select example" v-model.number="filtros.estado">
                            <option value="">TODOS</option>
                            <option value="1">
                                Confirmado
                            </option>
                            <option value="2">
                                No confirmado
                            </option>
                        </select>
                    </div>
					<div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                        <label>
                            Interesado
                        </label>
                        <select class="form-select" @change="buscar(1)" aria-label="Select example" v-model.number="filtros.interesado">
                            <option value="">TODOS</option>
                            <option value="1">
                                SI
                            </option>
                            <option value="0">
                                NO
                            </option>
                        </select>
                    </div>
					<div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                        <label>
                            V. Prospecto
                        </label>
                        <select class="form-select" @change="buscar(1)" aria-label="Select example" v-model.number="filtros.prospecto">
                            <option value="">TODOS</option>
                            <option value="0">SIN ENVIAR</option>
                            <option value="1">PENDIENTE</option>
                            <option value="2">RECHAZADO</option>
                            <option value="3">VALIDADO</option>
                        </select>
                    </div>
					<div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                        <label>
                            V. Inscripción
                        </label>
                        <select class="form-select" @change="buscar(1)" aria-label="Select example" v-model.number="filtros.inscripcion">
                            <option value="">TODOS</option>
                            <option value="0">SIN ENVIAR</option>
                            <option value="1">PENDIENTE</option>
                            <option value="2">RECHAZADO</option>
                            <option value="3">VALIDADO</option>
                        </select>
                    </div>
					<div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                        <label>
                            Ficha
                        </label>
                        <select class="form-select" @change="buscar(1)" aria-label="Select example" v-model.number="filtros.ficha">
                            <option value="">TODOS</option>
							<option value="5">SIN COMPLETAR</option>
                            <option value="0">REGISTRADO</option>
                            <option value="1">PENDIENTE</option>
                            <option value="2">RECHAZADO</option>
                            <option value="3">VALIDADO</option>
                        </select>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                        <label>
                            RESETEAR
                        </label>
                        <div class="m-demo-icon__preview">
                            <i @click="buscar(0)" class="bi bi-arrow-repeat fs-3x"></i>
                        </div>
                    </div>
                </div>
            </div>
			<!--begin::Table container-->
			<div class="table-responsive">
				<!--begin::Table-->
				<!-- id="sampleTable" hace llamado de datatable en la tabla que se le de dicho id -->
				<table class="table align-middle gs-0 gy-4" id="sampleTable">
					<!--begin::Table head-->
					<thead>
						<tr class="fw-bold text-muted bg-light">
							<th class="ps-4 rounded-start">N°</th>
							<th>Carrera</th>
							<th>N° Documento</th>
							<th>Usuario</th>
							<th>Celular</th>
							<th>Email</th>
							<th>Fecha Registro</th>
							<th>Verificado</th>
							<th>Interesado</th>
							<th>Pago Prosp</th>
							<th>Pago Examen</th>
							<th>Estado Ficha</th>
							<th class="text-center rounded-end">Acción</th>
						</tr>
					</thead>
					<!--end::Table head-->
					<!--begin::Table body-->
					<tbody>
						<tr v-for="(dato, index) in datos" :index="index" :key="index">
							<td class="ps-4">{{ index+1 }}</td>
							<td>{{ dato.nombre_corto }}</td>
							<td>{{ dato.numero_documento }}</td>
							<td>
								<div class="d-flex align-items-center">
									<p class="text-dark fw-bold mb-1 fs-6">{{ dato.nombre + ' ' +  dato.apellido_paterno + ' ' + dato.apellido_materno}}</p>
								</div>
							</td>
							<td>
								<a :href="'https://api.whatsapp.com/send?phone=51' + dato.numero_celular+'&text=Buenas%20'+dato.nombre+'%2C%20somos%20de%20la%20oficina%20de%20Inscripci%C3%B3n%20para%20el%20Examen%20de%20Admisi%C3%B3n%20de%20la%20UNDC%202024%2C%20espero%20que%20se%20encuentren%20muy%20bien%20%F0%9F%98%81.%20%0AEste%20mensaje%20es%20para%20informarle%20que%20a%C3%BAn%20no%20ha%20completado%20su%20registro%20al%20sistema%20de%20Inscripci%C3%B3n%20%F0%9F%92%BB%20de%20la%20UNDC%2C%20si%20no%20lo%20completas%20hasta%20el%208%20de%20Marzo%2C%20no%20podr%C3%A1s%20dar%20al%20examen%20el%2011%20de%20Marzo%20%F0%9F%99%85%E2%80%8D%E2%99%82%EF%B8%8F.%0APor%20favor%20completar%20todos%20los%20campos%20y%20adjuntar%20todos%20los%20documentos%20requeridos%20al%20sistema%20%F0%9F%93%8E.%20%0ASi%20tienen%20alguna%20duda%20o%20necesitan%20ayuda%20con%20el%20proceso%20de%20subida%2C%20por%20favor%20no%20duden%20en%C2%A0contactarme%C2%A0%F0%9F%93%9E.'" target="_blank">
                                <i class="bi bi-whatsapp text-success"></i>
                                {{dato.numero_celular}}
                                </a>
							</td>
							<td>{{ dato.email }}</td>
							<td>
								{{ dato.created_at }}
							</td>
							<td>
								<span v-if="dato.email_verified_at" class="badge badge-circle badge-success"></span>
                                <span v-else class="badge badge-circle badge-danger"></span>
							</td>
							<td>
								<span v-if="dato.interesado" class="badge badge-circle badge-primary"></span>
                                <span v-else class="badge badge-circle badge-secondary"></span>
							</td>
							<td>
								<span v-if="dato.prospecto==0" class="badge badge-circle badge-secondary"></span>
                                <span v-else-if="dato.prospecto==1" class="badge badge-circle badge-warning"></span>
                                <span v-else-if="dato.prospecto==2" class="badge badge-circle badge-danger"></span>
                                <span v-else-if="dato.prospecto==3" class="badge badge-circle badge-success"></span>
							</td>
							<td>
								<span v-if="dato.inscripcion==0" class="badge badge-circle badge-secondary"></span>
                                <span v-else-if="dato.inscripcion==1" class="badge badge-circle badge-warning"></span>
                                <span v-else-if="dato.inscripcion==2" class="badge badge-circle badge-danger"></span>
                                <span v-else-if="dato.inscripcion==3" class="badge badge-circle badge-success"></span>

							</td>
							<td>
								<span v-if="dato.id_estado_revision==0" class="badge badge-circle badge-secondary"></span>
                                <span v-else-if="dato.id_estado_revision==1" class="badge badge-circle badge-warning"></span>
                                <span v-else-if="dato.id_estado_revision==2" class="badge badge-circle badge-danger"></span>
                                <span v-else-if="dato.id_estado_revision==3" class="badge badge-circle badge-success"></span>
							</td>
							<td class="text-center">
								<!--<a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
									begin::Svg Icon | path: icons/duotune/general/gen019.svg
									<span class="svg-icon svg-icon-3">
										<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
											<path d="M17.5 11H6.5C4 11 2 9 2 6.5C2 4 4 2 6.5 2H17.5C20 2 22 4 22 6.5C22 9 20 11 17.5 11ZM15 6.5C15 7.9 16.1 9 17.5 9C18.9 9 20 7.9 20 6.5C20 5.1 18.9 4 17.5 4C16.1 4 15 5.1 15 6.5Z" fill="currentColor" />
											<path opacity="0.3" d="M17.5 22H6.5C4 22 2 20 2 17.5C2 15 4 13 6.5 13H17.5C20 13 22 15 22 17.5C22 20 20 22 17.5 22ZM4 17.5C4 18.9 5.1 20 6.5 20C7.9 20 9 18.9 9 17.5C9 16.1 7.9 15 6.5 15C5.1 15 4 16.1 4 17.5Z" fill="currentColor" />
										</svg>
									</span>
								</a>-->
								<!-- Modal 0 hace que edite el usuario y el 1 hace que cree nuevo usuario-->
								<a href="#" @click.prevent="abrirModal(0, dato)" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1" data-bs-toggle="modal" data-bs-target="#kt_modal_new_address">
									<span class="svg-icon svg-icon-3">
										<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
											<path opacity="0.3" d="M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z" fill="currentColor" />
											<path d="M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z" fill="currentColor" />
										</svg>
									</span>
								</a>
								<a href="#" @click.prevent="borrarRegistro(dato.id)" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm">
									<span class="svg-icon svg-icon-3">
										<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
											<path d="M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z" fill="currentColor" />
											<path opacity="0.5" d="M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z" fill="currentColor" />
											<path opacity="0.5" d="M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z" fill="currentColor" />
										</svg>
									</span>
								</a>
							</td>
						</tr>
					</tbody>
					<!--end::Table body-->
				</table>
				<!--end::Table-->
			</div>
			<!--end::Table container-->
		</div>
		<!--begin::Body-->
	</div>
	<!--end::Tables Widget 11-->
		<!--begin::Modal - New Address-->
		<div class="modal fade" id="kt_modal_new_address" tabindex="-1" aria-hidden="true">
			<!--begin::Modal dialog-->
			<div class="modal-dialog modal-dialog-centered mw-650px">
				<!--begin::Modal content-->
				<div class="modal-content">
					<!--begin::Form-->
					<form class="form" action="#" id="kt_modal_new_address_form" @submit.prevent="guardar">
						<!--begin::Modal header-->
						<div class="modal-header" id="kt_modal_new_address_header">
							<!--begin::Modal title-->
							<h2 v-if="tipoModal==1">Agregar Nuevo Usuario</h2>
							<h2 v-else>Editar Usuario</h2>
							<!--end::Modal title-->
							<!--begin::Close-->
							<div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal" id="closemodal">
								<!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
								<span class="svg-icon svg-icon-1">
									<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
										<rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor" />
										<rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="currentColor" />
									</svg>
								</span>
								<!--end::Svg Icon-->
							</div>
							<!--end::Close-->
						</div>
						<!--end::Modal header-->
						<!--begin::Modal body-->
						<div class="modal-body py-10 px-lg-17">
							<!--begin::Scroll-->
							<div class="scroll-y me-n7 pe-7" id="kt_modal_new_address_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_new_address_header" data-kt-scroll-wrappers="#kt_modal_new_address_scroll" data-kt-scroll-offset="300px">
								<!--begin::Notice-->
								<!--begin::Notice-->
								<div class="notice d-flex bg-light-warning rounded border-warning border border-dashed mb-9 p-6">
									<!--begin::Icon-->
									<!--begin::Svg Icon | path: icons/duotune/general/gen044.svg-->
									<span class="svg-icon svg-icon-2tx svg-icon-warning me-4">
										<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
											<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor" />
											<rect x="11" y="14" width="7" height="2" rx="1" transform="rotate(-90 11 14)" fill="currentColor" />
											<rect x="11" y="17" width="2" height="2" rx="1" transform="rotate(-90 11 17)" fill="currentColor" />
										</svg>
									</span>
									<!--end::Svg Icon-->
									<!--end::Icon-->
									<!--begin::Wrapper-->
									<div class="d-flex flex-stack flex-grow-1">
										<!--begin::Content-->
										<div class="fw-semibold">
											<h4 class="text-gray-900 fw-bold">Advertencia</h4>
											<div class="fs-6 text-gray-700">Ingrese los datos iguales al DNI
											</div>
										</div>
										<!--end::Content-->
									</div>
									<!--end::Wrapper-->
								</div>
								<!--end::Notice-->
								<!--begin::Input group-->
								<div class="row g-9 mb-5">
									<!--begin::Col-->
									<div class="col-md-4 fv-row">
										<!--begin::Label-->
										<label class="required fs-5 fw-semibold mb-2">TIPO DOCUMENTO</label>
										<!--end::Label-->
										<select class="form-control m-input" v-model="datosRegistro.id_tipo_documento" placeholder="Seleccione" :disabled="datosRegistro.id_estado_revision!=null" required>
                                            <option value="" hidden>Seleccione tipo</option>
                                            <option value="1">
                                                DNI
                                            </option>
                                            <option value="2">
                                                C.E.
                                            </option>
                                        </select>
									</div>
									<!--end::Col-->
									<!--begin::Col-->
									<div class="col-md-4 fv-row">
										<!--begin::Label-->
										<label class="required fs-5 fw-semibold mb-2">N° DOCUMENTO</label>
										<!--end::Label-->
										<!--begin::Input-->
										<input class="form-control form-control-solid" v-model="datosRegistro.numero_documento" placeholder=""  :disabled="datosRegistro.id_estado_revision!=null" name="state" />
										<!--end::Input-->
									</div>
									<!--end::Col-->
									<div class="col-md-4 fv-row">
										<!--begin::Label-->
										<label class="required fs-5 fw-semibold mb-2">INTERESADO</label>
										<!--end::Label-->
										<select class="form-control m-input" v-model="datosRegistro.interesado" placeholder="Seleccione" required>
                                            <option value="" hidden>Selecione tipo</option>
                                            <option value="1">
                                                SI
                                            </option>
                                            <option value="0">
                                                NO
                                            </option>
                                        </select>
									</div>
									<!--begin::Col-->
									<!-- <div class="col-md-4 fv-row">
										<label class="required fs-5 fw-semibold mb-2">Rol</label>
										<select class="form-select" v-model="datosRegistro.rol" required="">
                                            <option value="" hidden>Seleccione rol</option>
                                            <option v-for="item in roles" :key="item.id" :value="item.name">{{item.name}}</option>
                                        </select>
									</div> -->
									<!--end::Col-->
								</div>
								<!--end::Input group-->
								<!--end::Notice-->
								<!--begin::Input group-->
								<div class="row mb-5">
									<!--begin::Col-->
									<div class="col-md-4 fv-row">
										<!--begin::Label-->
										<label class="required fs-5 fw-semibold mb-2">Nombres</label>
										<!--end::Label-->
										<!--begin::Input-->
										<input type="text" v-model="datosRegistro.nombre" class="form-control form-control-solid"  :disabled="datosRegistro.id_estado_revision!=null" placeholder="" name="Nombres" />
										<!--end::Input-->
									</div>
									<!--end::Col-->
									<!--begin::Col-->
									<div class="col-md-4 fv-row">
										<!--end::Label-->
										<label class="required fs-5 fw-semibold mb-2">Apellidos Paterno</label>
										<!--end::Label-->
										<!--end::Input-->
										<input type="text" v-model="datosRegistro.apellido_paterno" class="form-control form-control-solid"  :disabled="datosRegistro.id_estado_revision!=null" placeholder="" name="ApellidoPaterno" />
										<!--end::Input-->
									</div>
									<!--end::Col-->
									<!--begin::Col-->
									<div class="col-md-4 fv-row">
										<!--end::Label-->
										<label class="required fs-5 fw-semibold mb-2">Apellidos Materno</label>
										<!--end::Label-->
										<!--end::Input-->
										<input type="text" v-model="datosRegistro.apellido_materno" class="form-control form-control-solid"  :disabled="datosRegistro.id_estado_revision!=null" placeholder="" name="ApellidosMaterno" />
										<!--end::Input-->
									</div>
									<!--end::Col-->
								</div>
								<!--end::Input group-->
								<div class="row mb-5">
									<!--begin::Col-->
									<div class="col-md-9 fv-row">
									<label class="required fs-5 fw-semibold mb-2">Correo electronico</label>
									<!--end::Label-->
									<!--begin::Input-->
									<input type="email" v-model="datosRegistro.email" class="form-control form-control-solid"  :disabled="datosRegistro.id_estado_revision!=null" placeholder="" name="Email" />
									</div>
									<div class="col-md-3 fv-row">
									<!--begin::Label-->
									<label class="required fs-5 fw-semibold mb-2">Celular</label>
									<!--end::Label-->
									<!--begin::Input-->
									<input type="text" v-model="datosRegistro.numero_celular"  class="form-control form-control-solid" placeholder=""  :disabled="datosRegistro.id_estado_revision!=null" name="Celular" />
									<!--end::Input-->
									</div>
								</div>
								<!--begin::Input group-->
								<!-- <div class="d-flex flex-column mb-5 fv-row">
								</div>
								<div class="d-flex flex-column mb-5 fv-row">
								</div> -->
								<div class="row g-9 mb-5">
									<div class="col-md-9 fv-row">
										<label class="required fs-5 fw-semibold mb-2">Nueva contraseña</label>
										<input v-if="tipoModal==0" type="password" v-model="nuevaContrasena" class="form-control form-control-solid" placeholder="" name="state" />
										<input v-else type="password" v-model="datosRegistro.password" class="form-control form-control-solid" placeholder="" name="state" />
									</div>
									<div class="col-md-3 fv-row">
										<label class="fs-5 fw-semibold mb-2"></label>
										<a v-if="tipoModal==0" href="#" @click="actualizarContrasena()" class="form-control btn btn-danger btn-hover-scale me-5">Actualizar</a>
									</div>
								</div>
								<!--end::Input group-->
							</div>
							<!--end::Scroll-->
						</div>
						<!--end::Modal body-->
						<!--begin::Modal footer-->
						<div class="modal-footer flex-center">
							<!--begin::Button-->
							<button type="reset" id="kt_modal_new_address_cancel" class="btn btn-light me-3" data-bs-dismiss="modal">Cancelar</button>
							<!--end::Button-->
							<!--begin::Button-->
							<button type="submit" id="kt_modal_new_address_submit" class="btn btn-primary"  :disabled="datosRegistro.id_estado_revision==3">
								<span class="indicator-label">Guardar</span>
								<span class="indicator-progress">Please wait...
								<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
							</button>
							<!--end::Button-->
						</div>
						<!--end::Modal footer-->
					</form>
					<!--end::Form-->
				</div>
			</div>
		</div>
		<!--end::Modal - New Address-->
</div>


</template>
<script>
	//data table en la actual versión necesita jquery
	// import $ from 'jquery';
    // import datatable from 'datatables.net-bs5';
    // import 'datatables.net-bs5/css/dataTables.bootstrap5.min.css'; // Estilos base de DataTables para Bootstrap 5
export default {
	name:'usuarios',
	data() {
		return {
			datos:[],
			//MODAL REGISTER:1 MODAL EDIT:0

			roles:[],
			tipoModal:1,
			csrfToken: null,
			nuevaContrasena: '',
			filtros: {
                carrera: '',
                modalidad: '',
                estado: '',
				cuenta: '',
				inscripcion: '',
				prospecto: '',
				ficha: '',
                dato:'',
				interesado:''
            },
			datosRegistro:{
				id_tipo_documento: '',
				numero_documento:"",
				nombre: '',
				apellido_paterno: '',
				apellido_materno: '',
				numero_celular: '',
				email:"",
				password:"",
				rol: '',
				inscripcion: '',
				contrasena: '',
				interesado: ''
			},
			defaulRegistro:{
				id_tipo_documento: '',
				numero_documento:"",
				nombre: '',
				apellido_paterno: '',
				apellido_materno: '',
				numero_celular: '',
				email:"",
				password:"",
				rol: "",
				inscripcion: '',
				contrasena: '',
				interesado: ''
			}
		}
	},
	mounted() {
		this.csrfToken = document.querySelector('meta[name="csrf-token"]').content,
		this.mostrarDatos()
		this.listarRoles()
	},
	methods: {
		//metodo para datatable
		// tabla(){
        //         this.$nextTick(() => {
        //             $('#sampleTable').DataTable();
        //         });
        //     },
		async mostrarDatos() {
			let modalidad = this.filtros.modalidad
            let carrera = this.filtros.carrera
            let estado = this.filtros.estado
			let prospecto = this.filtros.prospecto
			let inscripcion = this.filtros.inscripcion
			let ficha = this.filtros.ficha
            let dato = this.filtros.dato
			let interesado = this.filtros.interesado
			await axios
				.get(this.$parent.NombreRuta + "/api/usuarios?carrera="+carrera+'&estado='+estado+'&dato='+dato+'&prospecto='+prospecto+'&inscripcion='+inscripcion+'&ficha='+ficha+'&interesado='+interesado+'&modalidad='+modalidad)
				.then((response) => {
				this.datos = response.data;
				//llamar datatable
				// this.tabla();
				})
				.catch(function (error) {
				this.datos = [];
				});
		},
		async listarRoles() {
			await axios
				.get(this.$parent.NombreRuta + "/api/roles")
				.then((response) => {
				this.roles = response.data;
				})
				.catch(function (error) {
				this.roles = [];
				});
				},
		async crear(){
			this.axios.post(this.$parent.NombreRuta + `/api/usuarios`, {
            'id_tipo_documento':this.datosRegistro.id_tipo_documento,
			'numero_documento':this.datosRegistro.numero_documento,
			'nombre':this.datosRegistro.nombre,
			'apellido_paterno':this.datosRegistro.apellido_paterno,
			'apellido_materno':this.datosRegistro.apellido_materno,
			'email':this.datosRegistro.email,
			'numero_celular':this.datosRegistro.numero_celular,
			'rol':this.datosRegistro.rol,
			'password': this.datosRegistro.password,
            'password_confirmation': this.datosRegistro.password
			})
            .then((response) => {
				console.log(response.data)
				this.cerrarModal();
				this.datosRegistro = Object.assign({}, this.defaulRegistro)
				this.mostrarDatos();
				//location.href ="/login";
            })
            .catch((error) => {
                this.errors=error.response.data.errors;
                console.log(error);
            });
        },
		async actualizar(){
            await this.axios.put(this.$parent.NombreRuta + `/api/usuarios-roles/`+this.datosRegistro.id, {
            'id':this.datosRegistro.id,
			'id_tipo_documento':this.datosRegistro.id_tipo_documento,
			'numero_documento':this.datosRegistro.numero_documento,
			'nombre':this.datosRegistro.nombre,
			'apellido_paterno':this.datosRegistro.apellido_paterno,
			'apellido_materno':this.datosRegistro.apellido_materno,
			'email':this.datosRegistro.email,
			'numero_celular':this.datosRegistro.numero_celular,
			'rol':this.datosRegistro.rol,
			'interesado':this.datosRegistro.interesado,
			})
            .then(response=>{
                //this.$router.push({name:'mostrarAutos'})
				if(response.data.success==1){
                    toastr.options = {
                        "positionClass": "toastr-bottom-right",
                        "timeOut": "5000"
                    };
                    toastr.success('Datos actualizados');
                }else{
                    toastr.options = {
                        "positionClass": "toastr-bottom-right",
                        "timeOut": "5000"
                    };
                    toastr.error('Datos no actualizados');
                }
				this.mostrarDatos();
				//console.log(response.data)
			})
            .catch(error=>{
                console.log(error)
				toastr.options = {
                    "positionClass": "toastr-bottom-right",
                    "timeOut": "5000"
                };
                toastr.error('Datos no actualizados');
            })
        },
		async registrarContrasena(){
			await this.axios.post(this.$parent.NombreRuta + `/api/usuarios/contrasena`, {
            'id':this.datosRegistro.id,
			'password':this.nuevaContrasena
			})
            .then(response=>{
                //this.$router.push({name:'mostrarAutos'})
				if(response.data.success==1){
					this.nuevaContrasena=''
                    toastr.options = {
                        "positionClass": "toastr-bottom-right",
                        "timeOut": "5000"
                    };
                    toastr.success('Contraseña actualizada');
                }else{
                    toastr.options = {
                        "positionClass": "toastr-bottom-right",
                        "timeOut": "5000"
                    };
                    toastr.error('Contraseña no actualizada');
                }
				//this.mostrarDatos();
				//console.log(response.data)
			})
            .catch(error=>{
                console.log(error)
				toastr.options = {
                    "positionClass": "toastr-bottom-right",
                    "timeOut": "5000"
                };
                toastr.error('Contraseña no actualizada');
            })
		},
		abrirModal(valor, dato){
			this.tipoModal=valor,
			//this.editedIndex = this.datos.indexOf(dato)
			this.datosRegistro = Object.assign({}, dato)
			//this.dialog = true
		},
		cerrarModal(){
			document.getElementById('closemodal').click();
		},
		guardar(){
			if(this.tipoModal==1){
				this.crear()
			}else{
				this.actualizar()
			}
		},
		buscar(opcion) {
            switch (opcion) {
                case 0:
                    this.filtros.dato = '',
                    this.filtros.modalidad = '',
                    this.filtros.carrera = '',
                    this.filtros.estado = ''
                    break;
                case 1:
                    this.filtros.dato = ''
                    break;
                case 2:
                    this.filtros.modalidad = '',
                    this.filtros.carrera = '',
                    this.filtros.estado = ''
                    break;
            }
            this.mostrarDatos()
        },
		borrarRegistro(id) {
			if (confirm("¿Confirma eliminar el registro?")) {
				// 1. Cambiamos .delete() por .post()
				this.axios
					// 2. Le pasamos el _method: 'DELETE' para que Laravel lo reconozca
					.post(this.$parent.NombreRuta +`/api/usuarios-roles/${id}`, { _method: 'DELETE' }) 
					.then((response) => {
						this.mostrarDatos();
					})
					.catch((error) => {
						console.log(error);
					});
			}
		},

		actualizarContrasena(){
			if(this.nuevaContrasena.length<6){
				toastr.options = {
                    "positionClass": "toastr-bottom-right",
                    "timeOut": "5000"
                };
                toastr.error('Contraseña muy corta');
			}else if(this.nuevaContrasena.length<20){
				this.registrarContrasena()
			}
		}
	},
}
</script>
