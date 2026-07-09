<template>
    <div class="card mb-5 mb-xl-8">
        <!--begin::Header-->
        <div class="card-header border-0 pt-5">
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label fw-bold fs-3 mb-1">Inscripción</span>
                <span class="text-muted mt-1 fw-semibold fs-7">Realiza las 3 secciones</span>
            </h3>
        </div>
        <!--end::Header-->
        <!--begin::Body-->
        <div class="card-body py-3">
            <div>
                <ul class="nav nav-pills mb-8 mt-8 nav-fill" id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill"
                            data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home"
                            aria-selected="true">Ficha de inscripción (1)</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill"
                            data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile"
                            aria-selected="false">Subir requisitos y fotografia (2)</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pills-carne-tab" data-bs-toggle="pill" data-bs-target="#pills-carne"
                            type="button" role="tab" aria-controls="pills-carne" aria-selected="false">Carné de postulante
                            (3)</button>
                    </li>
                </ul>
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                        <div class="row" style="justify-content: center">
                            <div v-if="loadingData" class="text-center">
                                <div class="spinner-border text-primary" role="status">
                                    <span class="sr-only">Loading...</span>
                                </div>
                            </div>
                            <div v-if="!loadingData && ficha == 0" class="col-sm-10 col-md-10 col-lg-12 col-xl-10">
                                <div class="m-portlet m-portlet--head-sm m-portlet--collapse" data-portlet="true"
                                    id="m_portlet_tools_5">
                                    <div class="m-portlet__head">
                                        <div class="m-portlet__head-caption">
                                            <div class="m-portlet__head-title">
                                                <span class="m-portlet__head-icon">
                                                </span>
                                                <h3 class="m-portlet__head-text">
                                                    FICHA DE INSCRIPCIÓN DEL POSTULANTE
                                                </h3>
                                            </div>
                                        </div>
                                    </div>

                                    <form @submit.prevent="guardarFicha"
                                        class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed">
                                        <div class="m-portlet__body">
                                            <!-- DATOS PERSONALES -->
                                            <div class="form-group m-form__group">
                                                <div class="alert alert-warning" role="alert">
                                                    <strong>
                                                        Importante!
                                                    </strong>
                                                    Revisar que sus datos sean los correctos al momento de completar el
                                                    formulario.
                                                </div>
                                                <div class="m-form__heading">
                                                    <h6 class="m-form__heading-title row">
                                                        <div class="col-lg-6">
                                                            1. DATOS PERSONALES
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <span class="badge badge-warning float-right">Rellenar datos
                                                                correctos.</span>

                                                        </div>
                                                    </h6>
                                                </div>
                                                <div class="row mb-5">
                                                    <div class="col-lg-3">
                                                        <label>
                                                            APELLIDO PATERNO:
                                                        </label>
                                                        <input type="text" class="form-control m-input" maxlength="50"
                                                            v-model="nuevoRegistro.apellidoPaterno"
                                                            placeholder="Ingrese sus apellidos" required autocomplete="off">
                                                    </div>

                                                    <div class="col-lg-3">
                                                        <label>
                                                            APELLIDO MATERNO:
                                                        </label>
                                                        <input type="text" class="form-control m-input" maxlength="50"
                                                            v-model="nuevoRegistro.apellidoMaterno"
                                                            placeholder="Ingrese sus apellidos" required autocomplete="off">
                                                    </div>

                                                    <div class="col-lg-6">
                                                        <label class="">
                                                            NOMBRES:
                                                        </label>
                                                        <input type="text" class="form-control m-input" maxlength="30"
                                                            v-model="nuevoRegistro.nombres" placeholder="ingrese su nombre"
                                                            required autocomplete="off">
                                                    </div>

                                                </div>
                                                <div class="row mb-5">
                                                    <div class="col-lg-2">
                                                        <label for="selectSexo">
                                                            TIPO DOC.
                                                        </label>
                                                        <select class="form-control m-input"
                                                            :value="this.$parent.UserData.id_tipo_documento"
                                                            placeholder="Seleccione" required disabled>
                                                            <option value="1">
                                                                DNI
                                                            </option>
                                                            <option value="2">
                                                                C.E.
                                                            </option>
                                                        </select>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <label class="">
                                                            DOCUMENTO DE IDENTIDAD
                                                        </label>
                                                        <input type="text" class="form-control m-input"
                                                            :value="this.$parent.UserData.numero_documento" required=""
                                                            minlength="8" maxlength="9" pattern="[0-9]+"
                                                            title="Solo Nº DNI." placeholder="Ingrese número de documento"
                                                            autocomplete="off" disabled>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <label>
                                                            FECHA DE NACIMIENTO
                                                        </label>
                                                        <div class="input-group date">
                                                            <input type="date" class="form-control m-input col-lg-10"
                                                                v-model="nuevoRegistro.fechaNacimiento"
                                                                @change="calcularEdad()" placeholder="Seleccione fecha"
                                                                required autocomplete="off">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2">
                                                        <label class="">
                                                            EDAD
                                                        </label>
                                                        <input type="text" class="form-control m-input"
                                                            v-model="nuevoRegistro.edad" required="" size="2" maxlength="2"
                                                            pattern="[0-9]+" title="Solo números. Tamaño max: 2 dígitos."
                                                            placeholder="Ingrese edad" autocomplete="off" disabled>
                                                    </div>

                                                </div>
                                                <label>
                                                    LUGAR DE NACIMIENTO
                                                </label>
                                                <div class="row mb-5">
                                                    <div class="col-lg-12">
                                                        <label for="inputNombresIE" class="">
                                                            Pais de nacimiento:
                                                        </label>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio"
                                                                v-model="nuevoRegistro.nacimientoPeru"
                                                                name="inlineRadioOptions" id="inlineRadio1" value="1"
                                                                required>
                                                            <label class="form-check-label" for="inlineRadio1">Perú</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio"
                                                                v-model="nuevoRegistro.nacimientoPeru"
                                                                name="inlineRadioOptions" id="inlineRadio2" value="0">
                                                            <label class="form-check-label"
                                                                for="inlineRadio2">Extranjero</label>
                                                        </div>
                                                    </div>
                                                    <div v-if="nuevoRegistro.nacimientoPeru == 0" class="col-lg-3">
                                                        <label for="nombresPadre" class="">
                                                            Pais
                                                        </label>
                                                        <input type="text" class="form-control m-input"
                                                            v-model="nuevoRegistro.paisNacimiento" size="100"
                                                            maxlength="100" placeholder="Pais" required autocomplete="off">
                                                    </div>
                                                    <div v-if="nuevoRegistro.nacimientoPeru == 0" class="col-lg-3">
                                                        <label for="nombresPadre" class="">
                                                            Departamento
                                                        </label>
                                                        <input type="text" class="form-control m-input"
                                                            v-model="nuevoRegistro.depNacimientoExt" size="100"
                                                            maxlength="100" placeholder="Departamento" required
                                                            autocomplete="off">
                                                    </div>
                                                    <div v-if="nuevoRegistro.nacimientoPeru == 0" class="col-lg-3">
                                                        <label for="nombresPadre" class="">
                                                            Provincia
                                                        </label>
                                                        <input type="text" class="form-control m-input"
                                                            v-model="nuevoRegistro.provNacimientoExt" size="100"
                                                            maxlength="100" placeholder="Provincia" required
                                                            autocomplete="off">
                                                    </div>
                                                    <div v-if="nuevoRegistro.nacimientoPeru == 0" class="col-lg-3">
                                                        <label for="nombresPadre" class="">
                                                            Distrito
                                                        </label>
                                                        <input type="text" class="form-control m-input"
                                                            v-model="nuevoRegistro.disNacimientoExt" size="100"
                                                            maxlength="100" placeholder="Distrito" required
                                                            autocomplete="off">
                                                    </div>
                                                    <div v-if="nuevoRegistro.nacimientoPeru == 1" class="col-lg-2">
                                                        <label class="">
                                                            Departamento
                                                        </label>
                                                        <select class="form-select" @change="obtenerProvincia(1)"
                                                            v-model="nuevoRegistro.depNacimiento" required="">
                                                            <option value="" hidden>Seleccione departamento</option>
                                                            <option v-for="item in depNac" :key="item.id" :value="item.id">
                                                                {{ item.nombre }}</option>
                                                        </select>
                                                    </div>
                                                    <div v-if="nuevoRegistro.nacimientoPeru == 1" class="col-lg-2">
                                                        <label class="">
                                                            Provincia
                                                        </label>
                                                        <select class="form-select" @change="obtenerDistrito(1)"
                                                            v-model="nuevoRegistro.provNacimiento" required="">
                                                            <option value="" hidden>Seleccione Provincia</option>
                                                            <option v-for="item in provNac" :key="item.id" :value="item.id">
                                                                {{ item.nombre }}</option>
                                                        </select>

                                                    </div>
                                                    <div v-if="nuevoRegistro.nacimientoPeru == 1" class="col-lg-2">
                                                        <label class="">
                                                            Distrito
                                                        </label>
                                                        <select class="form-select" v-model="nuevoRegistro.disNacimiento"
                                                            required="">
                                                            <option value="" hidden>Seleccione Provincia</option>
                                                            <option v-for="item in disNac" :key="item.id" :value="item.id">
                                                                {{ item.nombre }}</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <label for="selectSexo">
                                                            Sexo
                                                        </label>
                                                        <select class="form-select" v-model="nuevoRegistro.sexo"
                                                            placeholder="Seleccione" required>
                                                            <option value="" hidden>Selecione sexo</option>
                                                            <option>
                                                                MASCULINO
                                                            </option>
                                                            <option>
                                                                FEMENINO
                                                            </option>
                                                        </select>
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <label for="selectEstadoCivil">
                                                            Estado Civil
                                                        </label>
                                                        <select class="form-select" v-model="nuevoRegistro.estadoCivil"
                                                            required>
                                                            <option value="" hidden>Selecione estado</option>
                                                            <option>
                                                                SOLTERO
                                                            </option>
                                                            <option>
                                                                CASADO
                                                            </option>
                                                            <option>
                                                                DIVORCIADO
                                                            </option>
                                                            <option>
                                                                CONVIVIENTE
                                                            </option>
                                                            <option>
                                                                VIUDO
                                                            </option>
                                                        </select>
                                                    </div>

                                                </div>
                                            </div>
                                            <!-- DATOS PERSONALES -->
                                            <div class="form-group m-form__group">
                                                <div class="m-form__heading">
                                                    <h6 class="m-form__heading-title">
                                                        2. DOMICILIO ACTUAL
                                                    </h6>
                                                </div>
                                                <div class="row mb-5">
                                                    <div class="col-lg-12">
                                                        <label>
                                                            Direccion (Jr/Av/Pje/Calle/Mz/Urb)
                                                        </label>
                                                        <div class="m-input-icon m-input-icon--right">
                                                            <input type="text" class="form-control m-input"
                                                                v-model="nuevoRegistro.direccion" maxlength="200"
                                                                placeholder="Ingrese su dirección" required
                                                                autocomplete="off">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mb-5" style="justify-content: normal">
                                                    <div class="col-lg-2">
                                                        <label class="">
                                                            Departamento
                                                        </label>
                                                        <select class="form-select" @change="obtenerProvincia(2)"
                                                            v-model="nuevoRegistro.depActual" required="">
                                                            <option value="" hidden>Seleccione departamento</option>
                                                            <option v-for="item in depNac" :key="item.id" :value="item.id">
                                                                {{ item.nombre }}</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-lg-2">
                                                        <label class="">
                                                            Provincia
                                                        </label>
                                                        <select class="form-select" @change="obtenerDistrito(2)"
                                                            v-model="nuevoRegistro.provActual" required="">
                                                            <option value="" hidden>Seleccione Provincia</option>
                                                            <option v-for="item in provActu" :key="item.id"
                                                                :value="item.id">{{ item.nombre }}</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-lg-2">
                                                        <label class="">
                                                            Distrito
                                                        </label>
                                                        <select class="form-select" v-model="nuevoRegistro.disActual"
                                                            required="">
                                                            <option value="" hidden>Seleccione Provincia</option>
                                                            <option v-for="item in disActu" :key="item.id" :value="item.id">
                                                                {{ item.nombre }}</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-lg-6">

                                                    </div>
                                                </div>
                                                <div class="row mb-5">
                                                    <div class="col-lg-3">
                                                        <label class="">
                                                            Celular
                                                        </label>
                                                        <div class="m-input-icon m-input-icon--right">
                                                            <input type="text" class="form-control m-input"
                                                                v-model="nuevoRegistro.telefonoCelular" minlength="9"
                                                                maxlength="9" pattern="[0-9]+"
                                                                title="Solo números. Tamaño max: 9 dígitos."
                                                                placeholder="Ingrese celular" required autocomplete="off">
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-3">
                                                        <label class="">
                                                            Teléfono fijo
                                                        </label>
                                                        <div class="m-input-icon m-input-icon--right">
                                                            <input type="text" class="form-control m-input"
                                                                v-model="nuevoRegistro.telefonoFijo" size="10"
                                                                maxlength="10" title="Solo números. Tamaño max: 10 dígitos."
                                                                placeholder="Ingrese telefono" autocomplete="off">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <label class="">
                                                            Email
                                                        </label>
                                                        <input type="Email" class="form-control m-input"
                                                            :value="this.$parent.UserData.email" size="50" maxlength="50"
                                                            placeholder="Ingrese su correo" required autocomplete="off"
                                                            disabled>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- DATOS FAMILIARES -->
                                            <div class="form-group m-form__group">
                                                <div class="m-form__heading">
                                                    <h6 class="m-form__heading-title">
                                                        3. CONTACTO ADICIONAL
                                                    </h6>
                                                </div>
                                                <div class="row mb-5">
                                                    <div class="col-lg-6">
                                                        <label class="">
                                                            Datos del contacto
                                                        </label>
                                                        <input type="text" class="form-control m-input"
                                                            v-model="nuevoRegistro.datosApoderado" size="100"
                                                            maxlength="100" placeholder="Nombres y Apellidos" required
                                                            autocomplete="off">

                                                    </div>
                                                    <div v-if="nuevoRegistro.edad < 18" class="col-lg-3">
                                                        <label class="">
                                                            DNI del contacto de referencia
                                                        </label>
                                                        <input type="text" class="form-control m-input"
                                                            v-model="nuevoRegistro.dniApoderado" required="" minlength="8"
                                                            maxlength="9" pattern="[0-9]+" title="Solo Nº DNI."
                                                            placeholder="Ingrese DNI" autocomplete="off">
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <label class="">
                                                            Celular del contacto de referencia
                                                        </label>
                                                        <div class="m-input-icon m-input-icon--right">
                                                            <input type="text" class="form-control m-input"
                                                                v-model="nuevoRegistro.celularApoderado" minlength="9"
                                                                maxlength="9" pattern="[0-9]+"
                                                                title="Solo números. Tamaño max: 9 dígitos."
                                                                placeholder="Ingrese celular" required autocomplete="off">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- DATOS DE LA UNIVERSIDAD DE PROCEDENCIA -->
                                            <div class="form-group m-form__group">
                                                <div class="m-form__heading">
                                                    <h6 class="m-form__heading-title">
                                                        5. DATOS DE LA UNIVERSIDAD DE PROCEDENCIA
                                                    </h6>
                                                </div>
                                                <div class="row mb-5">
                                                    <div class="col-lg-6">
                                                        <label for="inputNombresIE" class="">
                                                            Departamento
                                                        </label>
                                                        <select class="form-select" @change="obtenerProvincia(3)"
                                                            v-model="nuevoRegistro.depColegio" required="">
                                                            <option value="" hidden>Seleccione departamento</option>
                                                            <option v-for="item in depNac" :key="item.id" :value="item.id">
                                                                {{ item.nombre }}</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <label class="">
                                                            Provincia
                                                        </label>
                                                        <select class="form-select" @change="obtenerColegio()"
                                                            v-model="nuevoRegistro.provColegio" required="">
                                                            <option value="" hidden>Seleccione Provincia</option>
                                                            <option v-for="item in provCole" :key="item.id"
                                                                :value="item.nombre">{{ item.nombre }}</option>
                                                        </select>
                                                    </div>

                                                </div>
                                                <div class="row mb-5">
                                                    <div class="col-lg-12 mb-3">
                                                        <label class="">
                                                            Universidad
                                                        </label>
                                                        <v-select :options="colegios" :reduce="colegios => colegios.id"
                                                            label="nombre" class="vs-select-custom"
                                                            v-model="nuevoRegistro.colegio">
                                                            <template #search="{ attributes, events }">
                                                                <input class="vs__search" :required="!nuevoRegistro.colegio"
                                                                    v-bind="attributes" v-on="events" />
                                                            </template>
                                                        </v-select>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <label for="inputFinEstudio" class="">
                                                            Año que concluyó sus estudios
                                                        </label>
                                                        <select class="form-select" v-model="nuevoRegistro.fechaConcluyoIE"
                                                            required="">
                                                            <option value="" hidden>Especifique un año</option>
                                                            <option value="0000">
                                                                Aún no he culminado
                                                            </option>
<option>
                                                                2025
                                                            </option>
<option>
                                                                2024
                                                            </option>

                                                            <option>
                                                                2023
                                                            </option>
                                                            <option>
                                                                2022
                                                            </option>
                                                            <option>
                                                                2021
                                                            </option>
                                                            <option>
                                                                2020
                                                            </option>
                                                            <option>
                                                                2019
                                                            </option>
                                                            <option>
                                                                2018
                                                            </option>
                                                            <option>
                                                                2017
                                                            </option>
                                                            <option>
                                                                2016
                                                            </option>
                                                            <option>
                                                                2015
                                                            </option>
                                                            <option>
                                                                2014
                                                            </option>
                                                            <option>
                                                                2013
                                                            </option>
                                                            <option>
                                                                2012
                                                            </option>
                                                            <option>
                                                                2011
                                                            </option>
                                                            <option>
                                                                2010
                                                            </option>
                                                            <option>
                                                                2009
                                                            </option>
                                                            <option>
                                                                2008
                                                            </option>
                                                            <option>
                                                                2007
                                                            </option>
                                                            <option>
                                                                2006
                                                            </option>
                                                            <option>
                                                                2005
                                                            </option>
                                                            <option>
                                                                2004
                                                            </option>
                                                            <option>
                                                                2003
                                                            </option>
                                                            <option>
                                                                2002
                                                            </option>
                                                            <option>
                                                                2001
                                                            </option>
                                                            <option>
                                                                2000
                                                            </option>
                                                            <option>
                                                                1999
                                                            </option>
                                                            <option>
                                                                1998
                                                            </option>
                                                            <option>
                                                                1997
                                                            </option>
                                                            <option>
                                                                1996
                                                            </option>
                                                            <option>
                                                                1995
                                                            </option>
                                                            <option>
                                                                1994
                                                            </option>
                                                            <option>
                                                                1993
                                                            </option>
                                                            <option>
                                                                1992
                                                            </option>
                                                            <option>
                                                                1991
                                                            </option>
                                                            <option>
                                                                1990
                                                            </option>
                                                            <option>
                                                                1989
                                                            </option>
                                                            <option>
                                                                1988
                                                            </option>
                                                            <option>
                                                                1987
                                                            </option>
                                                            <option>
                                                                1986
                                                            </option>
                                                            <option>
                                                                1985
                                                            </option>
                                                            <option>
                                                                1984
                                                            </option>
                                                            <option>
                                                                1983
                                                            </option>
                                                            <option>
                                                                1982
                                                            </option>
                                                            <option>
                                                                1981
                                                            </option>
                                                            <option>
                                                                1980
                                                            </option>
                                                            <option>
                                                                1979
                                                            </option>
                                                            <option>
                                                                1978
                                                            </option>
                                                            <option>
                                                                1977
                                                            </option>
                                                            <option>
                                                                1976
                                                            </option>
                                                            <option>
                                                                1975
                                                            </option>
                                                            <option>
                                                                1974
                                                            </option>
                                                            <option>
                                                                1973
                                                            </option>
                                                            <option>
                                                                1972
                                                            </option>
                                                            <option>
                                                                1971
                                                            </option>
                                                            <option>
                                                                1970
                                                            </option>
                                                        </select>
                                                        <span v-if="nuevoRegistro.fechaConcluyoIE == '0000'"
                                                            class="badge badge-warning float-right">
                                                            La universidad no reserva vacantes para postulantes que no han
                                                            culminado secundaria
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- MODALIDAD Y CARRERA PROFESIONAL -->
                                            <div class="form-group m-form__group">
                                                <div class="m-form__heading">
                                                    <h6 class="m-form__heading-title">
                                                        5. Programa de Estudio
                                                    </h6>
                                                </div>
                                                <div class="row mb-5">
                                                    <!-- Selección de Carrera Ficha 1 -->
                                                    <div class="col-lg-6">
                                                        <label for="nombresMadre" class="">
                                                            5.1 PROGRAMA DE ESTUDIO
                                                        </label>
                                                        <select class="form-select" v-model.number="nuevoRegistro.carrera"
                                                            required>
                                                            <option value="" hidden>Seleccione la carrera</option>
                                                            <option value="1" hidden>
                                                                Maestría en Gestión Pública
                                                            </option>
                                                            <option value="2">
                                                                Maestría en Docencia Superior e Investigación
                                                            </option>
							    <option value="3" hidden>
                                                                Doctorado en Administración
                                                            </option>

                                                        </select>
                                                    </div><br>
                                                </div>
                                            </div>
                                            <!-- Publicidad examen de admisión -->
                                            <div class="form-group m-form__group">
                                                <div class="m-form__heading">
                                                    <h6 class="m-form__heading-title">
                                                        6. Sobre el exámen de admisión
                                                    </h6>
                                                </div>
                                                <div class="row mb-10">
                                                    <div class="col-lg-6">
                                                        <label class="">
                                                            6.1 Cómo se enteró del examen de admisión?
                                                        </label>
                                                        <select class="form-select" v-model.number="nuevoRegistro.entero"
                                                            required>
                                                            <option value="" hidden>Seleccione una opción</option>
                                                            <option value="Televisión">
                                                                Televisión
                                                            </option>
                                                            <option value="Radio">
                                                                Radio
                                                            </option>
                                                            <option value="Facebook">
                                                                Facebook
                                                            </option>
                                                            <option value="Pagina Web">
                                                                Pagina Web
                                                            </option>
                                                            <option value="Volante">
                                                                Volante
                                                            </option>
                                                            <option value="Familiares">
                                                                Familiares
                                                            </option>
                                                            <option value="Amigos">
                                                                Amigos
                                                            </option>
                                                            <option value="VisitaColegio">
                                                                Visita Colegio
                                                            </option>
                                                            <option value="Otros">
                                                                Otros
                                                            </option>

                                                        </select>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                                            <div class="m-form__actions m-form__actions--solid">
                                                <div class="row">
                                                    <div class="col-lg-12 text-center">
                                                        <button class="btn btn-success btn-block" type="submit"
                                                            :disabled='botonGuardarFicha'>
                                                            Enviar
                                                        </button>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div v-if="!loadingData && ficha != 0" v-for="item in ficha" :key="item.id" class="col-md-10">
                                <div class="m-portlet m-portlet--head-sm m-portlet--collapse" data-portlet="true"
                                    id="m_portlet_tools_5">
                                    <div class="m-portlet__head">
                                        <div class="m-portlet__head-caption">
                                            <div class="m-portlet__head-title">
                                                <h3 class="m-portlet__head-text">
                                                    FICHA DE INSCRIPCIÓN DEL POSTULANTE
                                                </h3>
                                                <span v-if="item.dj_todos == 1" class="badge badge-success badge-lg">
                                                    Validado
                                                </span>
                                                <span v-else class="badge badge-warning badge-lg">
                                                    Pendiente
                                                </span>
                                            </div>
                                        </div>
                                        <div class="m-portlet__head-tools">
                                            <ul class="m-portlet__nav">
                                                <!-- <li class="m-portlet__nav-item">
                                                            <a href="#" data-portlet-tool="remove" class="m-portlet__nav-link m-portlet__nav-link--icon" title="" data-original-title="Remove">
                                                                <i class="la la-power-off"></i>
                                                            </a>
                                                        </li>
                                                        <li class="m-portlet__nav-item">
                                                            <a href="" data-portlet-tool="reload" class="m-portlet__nav-link m-portlet__nav-link--icon" title="" data-original-title="Reload">
                                                                <i class="la la-circle"></i>
                                                            </a>
                                                        </li>
                                                        <li class="m-portlet__nav-item">
                                                            <a href="#" data-portlet-tool="fullscreen" class="m-portlet__nav-link m-portlet__nav-link--icon" title="" data-original-title="Fullscreen">
                                                                <i class="la la-expand"></i>
                                                            </a>
                                                        </li> -->
                                                <!-- <li class="m-portlet__nav-item">
                                                    <span v-if="item.id_estado==1" class="badge badge-warning badge-lg">
                                                        Pendiente
                                                    </span>
                                                    <span v-if="item.id_estado==3" class="badge badge-success badge-lg">
                                                        Validado
                                                    </span>
                                                </li> -->
                                                <!-- <li class="m-portlet__nav-item">
                                                    <a href="" data-portlet-tool="toggle" class="m-portlet__nav-link m-portlet__nav-link--icon" title="" data-original-title="Collapse" aria-describedby="tooltip248578">
                                                        <i class="la la-angle-down"></i>
                                                    </a>
                                                </li> -->
                                            </ul>
                                        </div>
                                    </div>
                                    <!-- <form method="POST" action="" class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed"> -->
                                    <div class="m-portlet__body">
                                        <div class="form-group m-form__group row">
                                            <div class="col-lg-6">
                                                <a v-bind:href="$parent.NombreRuta + '/inscripcion/ficha?i=' + encodeid(item.id) + '&ver=si'"
                                                    class="ms-1 link-primary" target="_blank"><img
                                                        :src="$parent.NombreRuta + '/assets/media/images/ficha.png'" alt=""
                                                        style="width: 100%;height: 460px;"></a>
                                            </div>
                                            <div class="col-lg-6">
                                                <form
                                                    @submit.prevent="confirmar_dj(item.id, item.dj_ficha_inscripcion, item.dj_apologia_t, item.dj_reglamento, item.dj_ingresante)">
                                                    <div class="row mt-10">
                                                        <!-- Declaración Jurada-->
                                                        <div class="col-12">
                                                            <div class="form-check form-check-custom form-check-solid mb-5">
                                                                <input class="form-check-input" type="checkbox" value="1"
                                                                    :disabled="item.dj_todos == 1" id="flexCheckDefault"
                                                                    v-model="item.dj_ficha_inscripcion" required />
                                                                <label class="form-check-label" for="flexCheckDefault">
                                                                    Declaro bajo juramento que la informacion consignada es
                                                                    verdadera <a
                                                                        v-bind:href="$parent.NombreRuta + '/inscripcion/ficha?i=' + encodeid(item.id) + '&ver=si'"
                                                                        class="ms-1 link-primary" target="_blank">(ficha de
                                                                        inscripción)</a>
                                                                </label>
                                                            </div>
                                                            <label
                                                                class="form-check form-check-custom form-check-solid mb-5">
                                                                <input class="form-check-input" type="checkbox" value="1"
                                                                    :disabled="item.dj_todos == 1"
                                                                    v-model="item.dj_apologia_t" required />
                                                                <span class="form-check-label">
                                                                    Declaro bajo juramento no haber sido condenado por
                                                                    delito de terrorismo o apologia al terrorismo en
                                                                    situacion de consentida y ejecutoriada.
                                                                </span>
                                                            </label>
                                                            <!-- <label v-if="item.mcp_id_modalidad==1 || item.mcp_id_modalidad == 8" class="form-check form-check-custom form-check-solid mb-5"> -->
                                                            <label
                                                                class="form-check form-check-custom form-check-solid mb-5">
                                                                <input class="form-check-input" type="checkbox" value="1"
                                                                    :disabled="item.dj_todos == 1"
                                                                    v-model="item.dj_ingresante" required />
                                                                <span class="form-check-label">
                                                                    Declaro bajo juramento que al ingresar debo presentar el
                                                                    voucher de pago por derecho de constancia de ingreso(S/.
                                                                    50.00).
                                                                </span>
                                                            </label>
                                                            <div class="form-check form-check-custom form-check-solid mb-5">
                                                                <input class="form-check-input" type="checkbox" value="1"
                                                                    :disabled="item.dj_todos == 1"
                                                                    v-model="item.dj_reglamento" id="flexCheckChecked"
                                                                    required />
                                                                <label class="form-check-label" for="flexCheckChecked">
                                                                    Declaro bajo juramento conocer el reglamento, los
                                                                    requisitos y condiciones establecidos en el proceso de
                                                                    admision 2026. <a target="_blank" 
                                                                        :href="'https://drive.google.com/file/d/1cix_QZm4-qnPVXLVGIY0dURSA5-DBpl0/view?usp=drivesdk'">(Reglameto
                                                                        de admisión 2026)</a>
                                                                </label>
                                                            </div>
                                                            <div class="form-check form-check-custom form-check-solid mb-5">
                                                                <!-- <input class="form-check-input" type="checkbox" value="1"
                                                                    :disabled="item.dj_todos == 1"
                                                                    v-model="item.dj_reglamento" id="flexCheckChecked"
                                                                    required /> -->
                                                                <label class="form-check-label" for="flexCheckChecked">
                                                                   <a target="_blank" href="https://drive.google.com/drive/folders/1WMDp4TpoCgviuLvqETqZr4MFwePEuKKS?usp=drive_link">Descargue aqui los formatos respectivos</a> : Solicitud de inscripcion, hoja de vida y propuesta de proyecto de investigacion 
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-12 text-center mb-5">
                                                            <button type="submit" :disabled="item.dj_todos == 1"
                                                                class="btn btn-primary">Aceptar</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <!-- Botón para cuando el postulante ha dado su examen anteriormente y quiera generar una segunda ficha -->
                                            <form v-if="item.condicion !== null && item.postulacion === 1"
                                                @submit.prevent="guardarSegundaFicha()">
                                                <div class="col-lg-12 row">
                                                    <div class="col-lg-4">
                                                        <label for="nombresMadre">
                                                            MODALIDAD
                                                        </label>
                                                        <select class="form-select" v-model.number="nuevoRegistro.modalidad"
                                                            required>
                                                            <option value="" hidden>Seleccione la modalidad</option>
                                                            <option value="1">
                                                                Ordinario
                                                            </option>
                                                            <!-- <option value="2">
                                                                    Primeros Puestos
                                                                </option>
                                                                <option value="3">
                                                                    Graduados y Titulados
                                                                </option>
                                                                <option value="4">
                                                                    Traslado Externo
                                                                </option>
                                                                <option value="5">
                                                                    Discapacidad
                                                                </option>
                                                                <option value="6">
                                                                    Deportistas Calificados
                                                                </option>
                                                                <option value="7">
                                                                    Victimas de Terrorismo
                                                                </option> -->
                                                            <option value="8">
                                                                Centro PRE
                                                            </option>
                                                            <!-- <option value="10">
                                                                    Traslado Interno
                                                                </option> -->
                                                        </select>
                                                    </div>
                                                    <div v-if="nuevoRegistro.modalidad == 9 || nuevoRegistro.modalidad == 3 || nuevoRegistro.modalidad == 4"
                                                        class="col-lg-6">
                                                        <label for="nombresPadre">
                                                            Universidad de procedencia
                                                        </label>
                                                        <input type="text" class="form-control m-input"
                                                            v-model="nuevoRegistro.universidad" size="100" maxlength="100"
                                                            placeholder="Universidad de procedencia" autocomplete="off"
                                                            required>

                                                    </div>
                                                    <div v-if="nuevoRegistro.modalidad == 9 || nuevoRegistro.modalidad == 3 || nuevoRegistro.modalidad == 4 || nuevoRegistro.modalidad == 10"
                                                        class="col-lg-6">
                                                        <label for="nombresMadre">
                                                            Creditos aprobados
                                                        </label>
                                                        <input type="text" class="form-control m-input"
                                                            v-model="nuevoRegistro.creditos" size="3" maxlength="3"
                                                            title="Solo números. Tamaño max: 3 dígitos."
                                                            placeholder="Creditos aprobados" autocomplete="off" required>
                                                    </div>
                                                    <div v-if="nuevoRegistro.modalidad == 7" class="col-lg-6">
                                                        <label>
                                                            Código RUV
                                                        </label>
                                                        <input type="text" class="form-control m-input"
                                                            v-model="nuevoRegistro.codigo_ruv" required=""
                                                            title="Solo código RUV" placeholder="Ingrese código RUV"
                                                            autocomplete="off">
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <label for="nombresMadre">
                                                            CARRERA PROFESIONAL
                                                        </label>
                                                        <select class="form-select" v-model.number="nuevoRegistro.carrera"
                                                            required>
                                                            <option value="" hidden>Seleccione la carrera</option>
                                                            <option value="1">
                                                                Administración
                                                            </option>
                                                            <option value="2">
                                                                Contabilidad
                                                            </option>
                                                            <option value="3">
                                                                Administración de Turismo y Hotelería
                                                            </option>
                                                            <option value="4">
                                                                Ingenierias de Sistemas
                                                            </option>
                                                            <option value="5">
                                                                Agronomia
                                                            </option>
                                                        </select>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <button class="btn btn-success btn-block mt-6" type="submit">
                                                            REGISTRAR SEGUNDA FICHA
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                            <!-- Botón para cuando el postulante ha dado su examen anteriormente y quiera generar una tercera ficha -->
                                            <form v-if="item.condicion !== null && item.postulacion === 2"
                                                @submit.prevent="guardarTerceraFicha()">
                                                <div class="col-lg-12 row">
                                                    <div class="col-lg-4">
                                                        <label for="nombresMadre">
                                                            MODALIDAD
                                                        </label>
                                                        <select class="form-select" v-model.number="nuevoRegistro.modalidad"
                                                            required>
                                                            <option value="" hidden>Seleccione la modalidad</option>
                                                            <option value="1">
                                                                Ordinario
                                                            </option>
                                                            <option value="8">
                                                                Centro PRE
                                                            </option>
                                                        </select>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <label for="nombresMadre">
                                                            CARRERA PROFESIONAL
                                                        </label>
                                                        <select class="form-select" v-model.number="nuevoRegistro.carrera"
                                                            required>
                                                            <option value="" hidden>Seleccione la carrera</option>
                                                            <option value="1">
                                                                Administración
                                                            </option>
                                                            <option value="2">
                                                                Contabilidad
                                                            </option>
                                                            <option value="3">
                                                                Administración de Turismo y Hotelería
                                                            </option>
                                                            <option value="4">
                                                                Ingenierias de Sistemas
                                                            </option>
                                                            <option value="5">
                                                                Agronomia
                                                            </option>
                                                        </select>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <button class="btn btn-success btn-block mt-6" type="submit">
                                                            REGISTRAR TERCERA FICHA
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                        <div v-if="0" class="alert alert-dismissible bg-danger d-flex flex-column flex-sm-row p-5 mb-10">
                            <span class="svg-icon svg-icon-2hx svg-icon-light me-4 mb-5 mb-sm-0">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path opacity="0.3"
                                        d="M2 4V16C2 16.6 2.4 17 3 17H13L16.6 20.6C17.1 21.1 18 20.8 18 20V17H21C21.6 17 22 16.6 22 16V4C22 3.4 21.6 3 21 3H3C2.4 3 2 3.4 2 4Z"
                                        fill="currentColor"></path>
                                    <path
                                        d="M18 9H6C5.4 9 5 8.6 5 8C5 7.4 5.4 7 6 7H18C18.6 7 19 7.4 19 8C19 8.6 18.6 9 18 9ZM16 12C16 11.4 15.6 11 15 11H6C5.4 11 5 11.4 5 12C5 12.6 5.4 13 6 13H15C15.6 13 16 12.6 16 12Z"
                                        fill="currentColor"></path>
                                </svg>
                            </span>
                            <div class="d-flex flex-column text-light pe-0 pe-sm-10">
                                <h4 class="mb-2 light">Módulo proximamente</h4>
                            </div>
                        </div>

                        <div v-else-if="ficha != 0 && ficha[0].dj_todos == 1" class="table-responsive">
                            <div class="row">
                                <!-- <td class="col-md-6">
                                    <div class="alert alert-primary" role="alert">
                                        MODALIDAD:
                                        <span v-if="ficha[0].mcp_id_modalidad == 1">
                                            ORDINARIO
                                        </span>
                                        <span v-else-if="ficha[0].mcp_id_modalidad == 2">
                                            PRIMEROS PUESTOS
                                        </span>
                                        <span v-else-if="ficha[0].mcp_id_modalidad == 3">
                                            GRADUADOS Y TITULADOS
                                        </span>
                                        <span v-else-if="ficha[0].mcp_id_modalidad == 4">
                                            TRASLADO EXTERNO
                                        </span>
                                        <span v-else-if="ficha[0].mcp_id_modalidad == 5">
                                            DISCAPACIDAD
                                        </span>
                                        <span v-else-if="ficha[0].mcp_id_modalidad == 6">
                                            DEPORTISTAS CALIFICADOS
                                        </span>
                                        <span v-else-if="ficha[0].mcp_id_modalidad == 7">
                                            VICTIMAS DE TERRORISMO
                                        </span>
                                        <span v-else-if="ficha[0].mcp_id_modalidad == 8">
                                            CEPRE (ingresante)
                                        </span>
                                        <span v-else-if="ficha[0].mcp_id_modalidad == 10">
                                            TRASLADO INTERNO
                                        </span>
                                        <span v-else-if="ficha[0].mcp_id_modalidad == 11">
                                            QUINTO DE SECUNDARIA
                                        </span>
                                    </div>
                                </td> -->
                                <td class="col-md-6">
                                    <div class="alert alert-primary" role="alert">
                                        Programa de Estudio:
                                        <span v-if="ficha[0].mcp_id_carrera == 1">
                                            <b>Maestría en Gestión Pública</b>
                                        </span>
                                        <span v-else-if="ficha[0].mcp_id_carrera == 2">
                                            <b>Maestría en Docencia Superior e Investigación</b>
                                        </span>
                                    </div>
                                </td>
                            </div>
                            <!--begin::Table-->
                            <table class="table align-middle gs-0 gy-4">
                                <thead>
                                    <tr class="fw-bold text-muted bg-light">
                                        <th class="ps-4 rounded-start">Documento</th>
                                        <th class="min-w-125px">Subir archivo</th>
                                        <th class="min-w-125px text-center">Archivo enviado</th>
                                        <th class="min-w-125px">Estado</th>
                                        <th class="text-center rounded-end">Observación</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="item in documentos" :key="item.id">
                                        <td class="ps-4">
                                            <span>{{ item.nombre }}</span>
                                        </td>

                                        <td>
                                            <div class="input-group">
                                                <button type="button" class="btn btn-primary" @click="editarDocumento(item)"
                                                    data-bs-toggle="modal" data-bs-target="#kt_modal_1">Subir</button>
                                            </div>
                                        </td>

                                        <td class="text-center">
                                            <a v-if="item.enlace" :href="'storage/documentos/' + item.enlace"
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
                                            <span v-if="item == 0" class="badge badge-danger badge-lg">
                                                No disponible
                                            </span>
                                            <span v-if="item.id_estado_revision == 0" class="badge badge-danger badge-lg">
                                                Sin enviar
                                            </span>
                                            <span v-if="item.id_estado_revision == 1" class="badge badge-warning badge-lg">
                                                Pendiente de validación
                                            </span>
                                            <span v-if="item.id_estado_revision == 2" class="badge badge-danger badge-lg">
                                                Rechazado
                                            </span>
                                            <span v-if="item.id_estado_revision == 3" class="badge badge-success badge-lg">
                                                Validado
                                            </span>
                                        </td>
                                        <td class="text-init">
                                            <span>{{ item.observacion }}</span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="modal fade" tabindex="-1" id="kt_modal_1" v-if="verModalVaucher" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h3 class="modal-title">{{ subirDocumento.nombre }}</h3>
                                            <div class="btn btn-icon btn-sm btn-active-light-primary ms-2"
                                                data-bs-dismiss="modal" aria-label="Close">
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
                                        <form id="requisitos-modalidad"
                                            @submit.prevent="guardarArchivo(subirDocumento.id, subirDocumento.tipo_documento_id)">
                                            <div class="modal-body">
                                                <div v-if="subirDocumento.tipo_documento_id == 1">
                                                    <div class="form-group m-form__group m--margin-top-10">
                                                        <div class="alert m-alert m-alert--default" role="alert">
                                                            El archivo debe contener los siguientes documentos(los formatos
                                                            impresos en la sección N°1). <br>
                                                            - Ficha de inscripción. <br>
                                                            - Solicitud de inscripción. <br>
                                                            - Declaraciones juradas. <br>
                                                        </div>
                                                        <div class="form-group m-form__group">
                                                            <label for="exampleInputEmail1">
                                                                File Browser
                                                            </label>
                                                            <div class="input-group mb-3">
                                                                <input
                                                                    v-if="subirDocumento.id_estado_revision == 0 || subirDocumento.id_estado_revision == 1 || subirDocumento.id_estado_revision == 2"
                                                                    type="file" class="form-control" id="file1" ref="file1"
                                                                    v-on:change="handleFileUpload(1)">
                                                                <input
                                                                    v-if="subirDocumento.id_estado_revision == 3 || subirDocumento == 0"
                                                                    type="file" class="form-control" id="file1" ref="file1"
                                                                    v-on:change="handleFileUpload(1)" disabled>
                                                            </div>
                                                            <label for="exampleFormControlFile1">Formato admitido: PDF,
                                                                RAR.</label>
                                                        </div>
                                                    </div>

                                                </div>

                                                <div v-else-if="subirDocumento.tipo_documento_id == 2">
                                                    <div class="form-group m-form__group m--margin-top-10">
                                                        <div class="alert alert-warning" role="alert">
                                                            <p>Se deben adjuntar los siguientes documentos en un solo archivo formato PDF.</p>
                                                            <ol style="color:#3c3b3b;">
                                                                <li>Solicitud dirigida al Director de la Escuela de Posgrado</li>
                                                                <li>Resumen de hoja de vida del postulante (No documentado) </li>
                                                                <li>Constancia de inscripción en línea del grado de Bachiller (para maestría) o del grado de Maestro (para doctorado), <a href="https://enlinea.sunedu.gob.pe/constanciadeinscripcion" target="_blank">(emitida por SUNEDU)</a>  </li>
                                                                <li>Copia Simple del documento de identidad (DNI, carné de extranjería o pasaporte)</li>
                                                                <li>Ficha de inscripción en el <a href="https://posgrado.undc.edu.pe/inscripciones/public/login" target="_blank"> sistema virtual de la Universidad Nacional de Cañete </a> </li>
                                                                <li>Copia del grado de Bachiller (para maestría) o del grado de Maestro (para doctorado), autenticada por la universidad de origen o legalizada ante notario público</li>
                                                                <li>Propuesta de investigación (Anexo N.° 02 para maestría o Anexo N.° 03 para doctorado), concordante con las líneas de investigación del programa al que postula. </li>
                                                
                                                            </ol>

                                                        </div>
                                                    </div>
                                                    <div class="form-group m-form__group">
                                                        <label for="exampleInputEmail1">
                                                            File Browser
                                                        </label>
                                                        <div class="input-group mb-3">
                                                            <input
                                                                v-if="subirDocumento.id_estado_revision == 0 || subirDocumento.id_estado_revision == 1 || subirDocumento.id_estado_revision == 2"
                                                                type="file" class="form-control" id="file2" ref="file2"
                                                                v-on:change="handleFileUpload(2)">
                                                            <input
                                                                v-if="subirDocumento.id_estado_revision == 3 || subirDocumento == 0"
                                                                type="file" class="form-control" id="file2" ref="file2"
                                                                v-on:change="handleFileUpload(2)" disabled>
                                                        </div>
                                                        <label for="exampleFormControlFile1">Formato admitido: PDF,
                                                            RAR.</label>
                                                    </div>
                                                </div>
                                                <div v-else-if="subirDocumento.tipo_documento_id == 3">
                                                    <div class="form-group m-form__group m--margin-top-10">
                                                        <div class="alert alert-warning" role="alert">
                                                            <h5>Documento de identidad actualizado/vigente</h5>
                                                            Consideraciones (enviar en un solo archivo).<br>
                                                            - Debe vizualizarse los datos.<br>
                                                            - Debe estar ambas caras del DNI o C.E. <br>
                                                            - En caso de perdida subir el C4 (certificado de inscripción).
                                                            <br>
                                                        </div>
                                                    </div>
                                                    <div class="form-group m-form__group">
                                                        <label for="exampleInputEmail1">
                                                            File Browser
                                                        </label>
                                                        <div class="input-group mb-3">
                                                            <input
                                                                v-if="subirDocumento.id_estado_revision == 0 || subirDocumento.id_estado_revision == 1 || subirDocumento.id_estado_revision == 2"
                                                                type="file" class="form-control" id="file3" ref="file3"
                                                                v-on:change="handleFileUpload(3)">
                                                            <input
                                                                v-if="subirDocumento.id_estado_revision == 3 || subirDocumento == 0"
                                                                type="file" class="form-control" id="file3" ref="file3"
                                                                v-on:change="handleFileUpload(3)" disabled>
                                                        </div>
                                                        <label for="exampleFormControlFile1">Formato admitido: PDF, JPG,
                                                            PNG, JPEG.</label>
                                                    </div>
                                                </div>
                                                <div v-else-if="subirDocumento.tipo_documento_id == 4" class="row">
                                                    <div class="form-group m-form__group m--margin-top-10 col-md-6">
                                                        <div class="alert alert-warning" role="alert">
                                                            Subir una fotografía reciente.<br>
                                                            - Sin gafas ni prendas en la cabeza.<br>
                                                            - Tamaño recomendado: 240x288.<br>
                                                            - Peso máximo: 500 KB.<br>
                                                            - Formato JPG o PNG.<br>
                                                            - Fondo blanco.<br>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <img width="200px" height="250px"
                                                            :src="enlacefoto(subirDocumento.enlace)"
                                                            style="border: 2px solid #3c3b3b;" />
                                                    </div>
                                                    <div class="form-group m-form__group">
                                                        <label for="exampleInputEmail1">
                                                            File Browser
                                                        </label>
                                                        <div class="input-group mb-3">
                                                            <input
                                                                v-if="subirDocumento.id_estado_revision == 0 || subirDocumento.id_estado_revision == 1 || subirDocumento.id_estado_revision == 2"
                                                                type="file" class="form-control" id="file4" ref="file4"
                                                                v-on:change="handleFileUpload(4)">
                                                            <input
                                                                v-if="subirDocumento.id_estado_revision == 3 || subirDocumento == 0"
                                                                type="file" class="form-control" id="file4" ref="file4"
                                                                v-on:change="handleFileUpload(4)" disabled>
                                                        </div>
                                                        <label for="exampleFormControlFile1">Formato admitido: PNG, JPG,
                                                            JPEG.</label>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="m-form__actions">
                                                    <button type="submit" class="btn btn-primary">
                                                        Subir archivo
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="modal-footer justify-content-start">
                                                <button type="button" id="btnCerrarModal" class="btn btn-light"
                                                    data-bs-dismiss="modal">Cerrar</button>

                                                <button v-if="id_modalidad_usu == 8" type="submit" class="btn btn-primary"
                                                    :disabled='subirDocumento.id_estado_revision == 3 || subirDocumento == 0'>Enviar</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div v-else class="alert alert-dismissible bg-danger d-flex flex-column flex-sm-row p-5 mb-10">
                            <span class="svg-icon svg-icon-2hx svg-icon-light me-4 mb-5 mb-sm-0">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path opacity="0.3"
                                        d="M2 4V16C2 16.6 2.4 17 3 17H13L16.6 20.6C17.1 21.1 18 20.8 18 20V17H21C21.6 17 22 16.6 22 16V4C22 3.4 21.6 3 21 3H3C2.4 3 2 3.4 2 4Z"
                                        fill="currentColor"></path>
                                    <path
                                        d="M18 9H6C5.4 9 5 8.6 5 8C5 7.4 5.4 7 6 7H18C18.6 7 19 7.4 19 8C19 8.6 18.6 9 18 9ZM16 12C16 11.4 15.6 11 15 11H6C5.4 11 5 11.4 5 12C5 12.6 5.4 13 6 13H15C15.6 13 16 12.6 16 12Z"
                                        fill="currentColor"></path>
                                </svg>
                            </span>
                            <div class="d-flex flex-column text-light pe-0 pe-sm-10">
                                <h4 class="mb-2 light">Completar la Ficha de inscripción</h4>
                            </div>
                        </div><br>

                        <div v-if="msgRevision != ''" class="alert alert-warning" role="alert" v-html="msgRevision">
                            <strong>
                                Alerta!
                            </strong>
                        </div>

                        <div v-if="ficha != 0 && ficha[0].id_estado_revision == 1 && ficha[0].dj_todos == 1"
                            class="alert alert-warning" role="alert">
                            <strong>
                                Pendiente!
                            </strong>
                            Su incripcion estará finalizada despues de validado sus documentos (24 horas máximo).
                        </div>
                        <div v-if="ficha != 0 && ficha[0].id_estado_revision == 2 && ficha[0].dj_todos == 1"
                            class="alert alert-danger" role="alert">
                            <strong>
                                Rechazado!
                            </strong>
                            Revise sus documentos y vuelvalos a enviar.
                        </div>
                        <div v-if="ficha != 0 && ficha[0].id_estado_revision == 3 && ficha[0].dj_todos == 1"
                            class="alert alert-success" role="alert">
                            <strong>
                                Validado!
                            </strong>
                            Sus documentos han sido verificado exitosamente.
                        </div>
                        <!-- <div v-if="ficha!=0 && ficha[0].id_estado_revision==3 && ficha[0].dj_todos==1" class="alert alert-danger" role="alert">
                            <strong>
                                Nota!
                            </strong>
                            Puede descargar su carné de postulante solo dentro de las 48 horas posteriores a la validación de sus documentos.
                        </div> -->
                        <div v-if="ficha != 0 && ficha[0].dj_todos == 1" align="center">
                            <button type="button" class="btn btn-success" @click.prevent="solicitarRevicion"
                                :disabled="btnRevision">
                                Solicitar revisión
                            </button>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="pills-carne" role="tabpanel" aria-labelledby="pills-carne-tab">
                        <div class="text-center">
                            <div class="row" style="justify-content: center">
                                <div class="text-center col-md-10" v-if="ficha != 0 && ficha[0].id_estado_revision == 3">
                                    <div
                                        class="alert alert-dismissible bg-success d-flex flex-column flex-sm-row p-5 mb-10">
                                        <span class="svg-icon svg-icon-2hx svg-icon-light me-4 mb-5 mb-sm-0"><svg width="24"
                                                height="24" viewBox="0 0 24 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path opacity="0.3"
                                                    d="M2 4V16C2 16.6 2.4 17 3 17H13L16.6 20.6C17.1 21.1 18 20.8 18 20V17H21C21.6 17 22 16.6 22 16V4C22 3.4 21.6 3 21 3H3C2.4 3 2 3.4 2 4Z"
                                                    fill="currentColor"></path>
                                                <path
                                                    d="M18 9H6C5.4 9 5 8.6 5 8C5 7.4 5.4 7 6 7H18C18.6 7 19 7.4 19 8C19 8.6 18.6 9 18 9ZM16 12C16 11.4 15.6 11 15 11H6C5.4 11 5 11.4 5 12C5 12.6 5.4 13 6 13H15C15.6 13 16 12.6 16 12Z"
                                                    fill="currentColor"></path>
                                            </svg></span>
                                        <div class="d-flex flex-column text-light pe-0 pe-sm-10">
                                            <h4 class="mb-2 light">Felicitaciones has completado tu inscripción!</h4>

                                        </div>
                                    </div>
                                    <!-- <div v-if="ficha[0].mcp_id_modalidad == 8"
                                        class="alert alert-dismissible bg-warning d-flex flex-column flex-sm-row p-5 mb-10">
                                        <span class="svg-icon svg-icon-2hx svg-icon-light me-4 mb-5 mb-sm-0"><svg width="24"
                                                height="24" viewBox="0 0 24 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path opacity="0.3"
                                                    d="M2 4V16C2 16.6 2.4 17 3 17H13L16.6 20.6C17.1 21.1 18 20.8 18 20V17H21C21.6 17 22 16.6 22 16V4C22 3.4 21.6 3 21 3H3C2.4 3 2 3.4 2 4Z"
                                                    fill="currentColor"></path>
                                                <path
                                                    d="M18 9H6C5.4 9 5 8.6 5 8C5 7.4 5.4 7 6 7H18C18.6 7 19 7.4 19 8C19 8.6 18.6 9 18 9ZM16 12C16 11.4 15.6 11 15 11H6C5.4 11 5 11.4 5 12C5 12.6 5.4 13 6 13H15C15.6 13 16 12.6 16 12Z"
                                                    fill="currentColor"></path>
                                            </svg></span>
                                        <div class="d-flex flex-column text-light pe-0 pe-sm-10">
                                            <h4 class="mb-2 light">Los ingresantes por modalidad CEPRE no descargan carné de
                                                postulante</h4>
                                        </div>
                                    </div> -->
                                </div>
                                <div class="text-center col-md-10" v-else>
                                    <div class="alert alert-dismissible bg-danger d-flex flex-column flex-sm-row p-5 mb-10">
                                        <span class="svg-icon svg-icon-2hx svg-icon-light me-4 mb-5 mb-sm-0"><svg width="24"
                                                height="24" viewBox="0 0 24 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path opacity="0.3"
                                                    d="M2 4V16C2 16.6 2.4 17 3 17H13L16.6 20.6C17.1 21.1 18 20.8 18 20V17H21C21.6 17 22 16.6 22 16V4C22 3.4 21.6 3 21 3H3C2.4 3 2 3.4 2 4Z"
                                                    fill="currentColor"></path>
                                                <path
                                                    d="M18 9H6C5.4 9 5 8.6 5 8C5 7.4 5.4 7 6 7H18C18.6 7 19 7.4 19 8C19 8.6 18.6 9 18 9ZM16 12C16 11.4 15.6 11 15 11H6C5.4 11 5 11.4 5 12C5 12.6 5.4 13 6 13H15C15.6 13 16 12.6 16 12Z"
                                                    fill="currentColor"></path>
                                            </svg></span>
                                        <div class="d-flex flex-column text-light pe-0 pe-sm-10">
                                            <h4 class="mb-2 light">Complete el paso anterior!</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div v-if="1" class="row" style="justify-content: center;">
                                <div v-if="ficha != 0 && ficha[0].mcp_id_modalidad != 8 && ficha[0].id_estado_revision == 3"
                                    class="col-md-10">
                                    <!-- <div  v-if="ficha!=0 && ficha[0] && ficha[0].id_estado_revision==3" class="col-md-10"> -->
                                    <div class="m-portlet__body mb-10">
                                        <div class="form-group m-form__group row">
                                            <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">
                                                <span>
                                                    <a v-bind:href="'#'" target="_blank"><img
                                                            :src="$parent.NombreRuta + '/assets/media/images/carne_postulante_modelo_2023.jpg'"
                                                            alt="" style="width: 100%;height: 360px;"></a>
                                                </span>
                                            </div>
                                            <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
                                                <div class="card text-right">
                                                    <div class="card-header bg-primary pt-7">
                                                        <h3 class="card-title align-items-center w-100 text-center"><span
                                                                class="card-label fw-bold text-white">Indicaciones</span>
                                                        </h3>
                                                    </div>
                                                    <div class="card-body" style="text-align: left">
                                                        <ul>
                                                            <b>LOCAL DE EXAMEN</b><br>
                                                            <!-- Se cambió para que los dos mcp_tipo estén en un mismo local -->
                                                            <div v-if="ficha[0].mcp_tipo === 1 || ficha[0].mcp_tipo === 2">
                                                                <!-- <div v-if="ficha[0].mcp_tipo === 2">     -->
                                                                <b>SEDE ACADÉMICO FUNDO DON LUIS:</b>
                                                                <p class="mb-0"> - Dirección: Pan. Sur- Km 139 Mz A Lte. 1 FDO. Don Luis Distrito San Luis - Cañete</p>
                                                                <p class="mb-0"> - Ref: Al lado del hospital Regional de Cañete Resola</p>
                                                                <a :href="'https://maps.app.goo.gl/6L4GMPkoEcP3r6Dm7'"
                                                                    target="_blank">Ver en google maps</a>
                                                                <br><br>
                                                            </div>
                                                            <!-- <div v-if="ficha[0].mcp_tipo==1">
                                                            <b>I.E. 20188 "CENTRO DE MUJERES":</b>
                                                            <p class="mb-0"> - Dirección: Prolongación José Gálvez S/N - SAN VICENTE DE CAÑETE</p>
                                                            <p class="mb-0"> - Ref: Frente al camal</p>
                                                            <a :href="'https://goo.gl/maps/22qBAA7cBnDHnf116'" target="_blank">Ver en google maps</a>
                                                            <br><br>
                                                            </div>  -->

                                                            <li>Descargar postulante.</li>
                                                            <li>IMPRIMIR en hoja completa (A4) a COLOR.</li>
                                                            <li>Llevar el carné completo el día del examen junto a su
                                                                documento de indentidad(DNI).</li>
                                                            <li>Las impresiones dactilares y firma en el carné se colocarán
                                                                el día del examen en el aula.</li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 m--align-right">
                                                    <a v-bind:href="'proceso/fichaspdf/carnepdf.php?d=' + encodeid(ficha[0].id_ficha)"
                                                        target="_blank"><i class="flaticon-profile"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                                        <div class="m-form__actions m-form__actions--solid">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <!-- Para el boton desactivado se puede agregar a lado de .id_aula un && false -->
                                                    <div class="mb-2">
                                                        <a v-if="ficha[0].id_estado_revision == 3 && ficha[0].id_aula"
                                                            v-bind:href="$parent.NombreRuta + '/inscripcion/carne3?download=si&token=' + encodeid(ficha[0].id)"
                                                            class="btn btn-success btn-block w-100"
                                                            target="_blank">Descargar carnét
                                                        </a>

                                                        <a v-else href="" class="btn btn-primary btn-block disabled w-100"
                                                            target="_blank" disabled>Proximamente
                                                        </a>
                                                    </div>
                                                    <br>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <br>
                            <br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    name: 'inscripcion',
    data() {
        return {
            botonRevision: true,
            botonEnviar: false,
            botonGuardarFicha: false,
            loadingData: true,

            verModalVaucher: true,

            msgRevision: '',
            //FICHA
            listaExtraordinario: true,
            ficha: [],
            depNac: [],

            provNac: [],
            disNac: [],
            depActu: [],
            provActu: [],
            disActu: [],

            provCole: [],
            colegios: [],
            nuevoRegistro: {
                apellidoPaterno: '',
                apellidoMaterno: '',
                nombres: '',
                tipoDoc: '',
                dni: '',
                edad: '',
                fechaNacimiento: '',
                nacimientoPeru: 2,
                paisNacimiento: '',
                depNacimiento: '',
                provNacimiento: '',
                disNacimiento: '',

                paisNacimientoExt: '',
                depNacimientoExt: '',
                provNacimientoExt: '',
                disNacimientoExt: '',

                sexo: '',
                estadoCivil: '',
                direccion: '',
                depActual: '',
                provActual: '',
                disActual: '',
                telefonoCelular: '',
                telefonoFijo: '',
                correo: '',
                datosPadre: '',
                datosMadre: '',
                datosApoderado: '',
                dniApoderado: '',
                celularApoderado: '',

                depColegio: '',
                provColegio: '',

                universidad: '',
                creditos: '',
                codigo_ruv: '',

                colegio: '',
                concluyoIE: '',
                fechaConcluyoIE: '',
                modalidad: '',
                modalidad2: '',
                carrera: '',
                entero: '',
            },
            subirDocumento: {
                ficha_id: '',
                tipo_documento_id: '',
                id_estado_revision: '',
                id_tipo_enlace: '',
                id_estado: '',
                nombre: '',
            },

            txtenconde: '',

            //SUBIR DOCUMENTOS
            archivos: [],
            pagos: [],
            documentos: [],
            requisitos: [],
            dni: [],
            foto: [],
            voucher_examen: [],
            codigo_pago: '',
            objetoDoc: {
                documentos: '',
                requisitos: '',
                dni: '',
                foto: '',
                voucher_examen: '',
            },
            urlfoto: 'https://via.placeholder.com/240x288',
            id_modalidad_usu: '',
            id_ficha_usu: '',
            id_estado_usu: '',
            horas_carne: ''
        }
    },
    mounted() {
        this.obtenerDepartamentos()
        this.obtenerFicha()
        this.obtenerPagos()
        setTimeout(this.asignarDatos, 2000);
    },
    methods: {
        async obtenerFicha() {
            this.botonGuardarFicha = true,
                this.loadingData = true
            await axios
                .get(this.$parent.NombreRuta + "/api/fichas")
                .then((response) => {
                    this.loadingData = false
                    this.botonGuardarFicha = false
                    this.ficha = response.data
                    if (this.ficha != 0) {
                        this.id_modalidad_usu = this.ficha[0].mcp_id_modalidad
                        this.id_ficha_usu = this.ficha[0].id
                        this.id_estado_usu = this.ficha[0].id_estado
                        this.obtenerDocumentos()
                    }
                })
                .catch(function (error) {
                    this.loadingData = false
                    this.ficha = [];
                });
        },
        async obtenerDocumentos() {
            let id_ficha = this.id_ficha_usu
            await axios
                .get(this.$parent.NombreRuta + "/api/documentos?id_ficha=" + id_ficha)
                .then((response) => {
                    this.documentos = response.data;
                })
                .catch(function (error) {
                    this.documentos = [];
                });
        },
        async obtenerPagos() {
            await axios
                .get(this.$parent.NombreRuta + "/api/pagos")
                .then((response) => {
                    this.pagos = response.data;
                })
                .catch(function (error) {
                    this.pagos = [];
                });
        },
        async obtenerDepartamentos() {
            await axios
                .get(this.$parent.NombreRuta + "/api/departamentos")
                .then((response) => {
                    this.depNac = response.data;
                })
                .catch(function (error) {
                    this.depNac = [];
                });
        },
        //FICHA
        async obtenerProvincias(tipo, codigoDep) {
            await axios.put(this.$parent.NombreRuta + "/api/provincias", {
                opcion: 4,
                codigoDep: codigoDep,
            })
                .then(response => {
                    if (tipo == 1) {
                        this.provNac = response.data;
                    }
                    if (tipo == 2) {
                        this.provActu = response.data;
                    }
                    if (tipo == 3) {
                        this.provCole = response.data;
                    }
                })
        },
        async obtenerDistritos(tipo, codigoProv) {
            await axios.put(this.$parent.NombreRuta + "/api/distritos", {
                opcion: 5,
                codigoProv: codigoProv,
            })
                .then(response => {
                    if (tipo == 1) {
                        this.disNac = response.data;
                    }
                    if (tipo == 2) {
                        this.disActu = response.data;
                    }
                })
        },
        async obtenerColegios(provColegio) {
            await axios.put(this.$parent.NombreRuta + "/api/colegios", {
                provColegio: provColegio,
            })
                .then(response => {
                    this.colegios = response.data;
                })
        },
        registrarFicha: function (postulacion,
            apellidoPaterno,
            apellidoMaterno,
            nombres,
            tipoDoc,
            dni,
            edad,
            fechaNacimiento,
            nacimientoPeru,
            paisNacimiento,
            depNacimiento,
            provNacimiento,
            disNacimiento,
            depNacimientoExt,
            provNacimientoExt,
            disNacimientoExt,
            sexo,
            estadoCivil,
            direccion,
            depActual,
            provActual,
            disActual,
            telefonoCelular,
            telefonoFijo,
            correo,
            datosPadre,
            datosMadre,
            datosApoderado,
            dniApoderado,
            celularApoderado,
            colegio,
            fechaConcluyoIE,
            universidad,
            creditos,
            codigo_ruv,
            modalidad,
            carrera,
            entero) {
            axios.post(this.$parent.NombreRuta + "/api/fichas", {
                postulacion: postulacion,
                apellidoPaterno: apellidoPaterno,
                apellidoMaterno: apellidoMaterno,
                nombres: nombres,
                tipoDoc: tipoDoc,
                dni: dni,
                edad: edad,
                fechaNacimiento: fechaNacimiento,
                nacimientoPeru: nacimientoPeru,
                paisNacimiento: paisNacimiento,
                depNacimiento: depNacimiento,
                provNacimiento: provNacimiento,
                disNacimiento: disNacimiento,
                depNacimientoExt: depNacimientoExt,
                provNacimientoExt: provNacimientoExt,
                disNacimientoExt: disNacimientoExt,
                sexo: sexo,
                estadoCivil: estadoCivil,
                direccion: direccion,
                depActual: depActual,
                provActual: provActual,
                disActual: disActual,
                telefonoCelular: telefonoCelular,
                telefonoFijo: telefonoFijo,
                correo: correo,
                datosPadre: datosPadre,
                datosMadre: datosMadre,
                datosApoderado: datosApoderado,
                dniApoderado: dniApoderado,
                celularApoderado: celularApoderado,
                colegio: colegio,
                fechaConcluyoIE: fechaConcluyoIE,
                universidad: universidad,
                creditos: creditos,
                codigo_ruv: codigo_ruv,
                modalidad: modalidad,
                carrera: carrera,
                entero: entero
            }).then(response => {
                this.obtenerFicha()
                this.obtenerDocumentos()
                this.botonGuardarFicha = false

                if (response.data == 1) {
                    toastr.options = {
                        "positionClass": "toastr-bottom-right",
                        "timeOut": "5000"
                    };
                    toastr.success('Ficha registrada');
                }
                if (response.data == 2) {
                    toastr.options = {
                        "positionClass": "toastr-bottom-right",
                        "timeOut": "5000"
                    };
                    toastr.error('Ficha no registrada');
                }
            }).catch((error) => {
                toastr.options = {
                    "positionClass": "toastr-bottom-right",
                    "timeOut": "5000"
                };
                toastr.error('Error al registrar');
            });
            this.botonGuardarFicha = false
        },

        guardar_dj: function (id_ficha, dj_ficha_inscripcion, dj_apologia_t, dj_reglamento, dj_ingresante) {
            axios.post(this.$parent.NombreRuta + '/api/fichas/dj', {
                id_ficha: id_ficha,
                dj_ficha_inscripcion: dj_ficha_inscripcion,
                dj_apologia_t: dj_apologia_t,
                dj_reglamento: dj_reglamento,
                dj_ingresante: dj_ingresante,

            }).then(response => {
                this.obtenerFicha()
                if (response.data.success) {
                    toastr.options = {
                        "positionClass": "toastr-bottom-right",
                        "timeOut": "5000"
                    };
                    toastr.success('Registrado');
                }
                if (response.data == 2) {
                    toastr.options = {
                        "positionClass": "toastr-bottom-right",
                        "timeOut": "5000"
                    };
                    toastr.error('No registrada');
                }
            })
        },

        registrarRevicion: function (id_ficha) {
            axios.post(this.$parent.NombreRuta + '/api/fichas/revision', {
                id_ficha: id_ficha
            }).then(response => {
                this.obtenerFicha()
                if (response.data.success) {
                    toastr.options = {
                        "positionClass": "toastr-bottom-right",
                        "timeOut": "5000"
                    };
                    toastr.success('Solicitud registrada');
                }
                if (response.data == 2) {
                    toastr.options = {
                        "positionClass": "toastr-bottom-right",
                        "timeOut": "5000"
                    };
                    toastr.error('Solicitud no registrada');
                }
            })
        },

        guardarConforCarne: function (id_ficha) {
            axios.post(this.$parent.NombreRuta + 'api/fichas/concarnet', {
                id_ficha: id_ficha
            }).then(response => {
                this.obtenerFicha()
                if (response.data == 1) {
                    this.$toast.open({
                        message: "Conformidad registrada",
                        position: "top-right",
                        type: "success",
                        duration: 4000,
                        dismissible: true
                    })
                }
                if (response.data == 2) {
                    this.$toast.open({
                        message: "Conformidad no registrada",
                        position: "top-right",
                        type: "error",
                        duration: 4000,
                        dismissible: true
                    })
                }
            })
        },
        obtenerProvincia(tipo) {
            let codigoDep
            if (tipo == 1) {
                this.disNac = []
                codigoDep = this.nuevoRegistro.depNacimiento
            } if (tipo == 2) {
                this.disActu = []
                codigoDep = this.nuevoRegistro.depActual
            } if (tipo == 3) {
                this.colegios = []
                codigoDep = this.nuevoRegistro.depColegio
            }
            this.obtenerProvincias(tipo, codigoDep)

        },
        obtenerDistrito(tipo) {
            let codigoProv
            if (tipo == 1) {
                codigoProv = this.nuevoRegistro.provNacimiento
            } else {
                codigoProv = this.nuevoRegistro.provActual
            }
            this.obtenerDistritos(tipo, codigoProv)

        },
        obtenerColegio() {
            let provColegio = 0
            provColegio = this.nuevoRegistro.provColegio
            this.obtenerColegios(provColegio)
        },
        guardarFicha() {
            this.postulacion = '1'

            if (this.nuevoRegistro.modalidad == 11 || this.nuevoRegistro.modalidad == 1) {
                this.modalidad = this.nuevoRegistro.modalidad
            } else {
                this.modalidad = this.nuevoRegistro.modalidad2
            }

            this.fechaConcluyoIE = this.nuevoRegistro.fechaConcluyoIE

            //lugar de nacimiento
            this.nacimientoPeru = this.nuevoRegistro.nacimientoPeru
            if (this.nuevoRegistro.nacimientoPeru == 1) {
                this.paisNacimiento = 'PERU',
                    this.depNacimiento = this.nuevoRegistro.depNacimiento,
                    this.provNacimiento = this.nuevoRegistro.provNacimiento,
                    this.disNacimiento = this.nuevoRegistro.disNacimiento,

                    this.paisNacimientoExt = '',
                    this.depNacimientoExt = '',
                    this.provNacimientoExt = '',
                    this.disNacimientoExt = ''
            } else {
                this.paisNacimiento = this.nuevoRegistro.paisNacimiento,
                    this.depNacimientoExt = this.nuevoRegistro.depNacimientoExt,
                    this.provNacimientoExt = this.nuevoRegistro.provNacimientoExt,
                    this.disNacimientoExt = this.nuevoRegistro.disNacimientoExt

                this.paisNacimientoExt = '',
                    this.depNacimiento = 0,
                    this.provNacimiento = 0,
                    this.disNacimiento = 0

            }
            this.botonGuardarFicha = true,
                this.apellidoPaterno = this.nuevoRegistro.apellidoPaterno,
                this.apellidoMaterno = this.nuevoRegistro.apellidoMaterno,
                this.nombres = this.nuevoRegistro.nombres,
                this.tipoDoc = this.nuevoRegistro.tipoDoc,
                this.dni = this.nuevoRegistro.dni,
                this.edad = this.nuevoRegistro.edad,
                this.fechaNacimiento = this.nuevoRegistro.fechaNacimiento,

                this.sexo = this.nuevoRegistro.sexo,
                this.estadoCivil = this.nuevoRegistro.estadoCivil,
                this.direccion = this.nuevoRegistro.direccion,
                this.depActual = this.nuevoRegistro.depActual,
                this.provActual = this.nuevoRegistro.provActual,
                this.disActual = this.nuevoRegistro.disActual,
                this.telefonoCelular = this.nuevoRegistro.telefonoCelular,
                this.telefonoFijo = this.nuevoRegistro.telefonoFijo,
                this.correo = this.nuevoRegistro.correo,
                this.datosPadre = this.nuevoRegistro.datosPadre,
                this.datosMadre = this.nuevoRegistro.datosMadre,
                this.datosApoderado = this.nuevoRegistro.datosApoderado,
                this.dniApoderado = this.nuevoRegistro.dniApoderado,
                this.celularApoderado = this.nuevoRegistro.celularApoderado,
                this.colegio = this.nuevoRegistro.colegio,

                this.universidad = this.nuevoRegistro.universidad,
                this.creditos = this.nuevoRegistro.creditos,
                this.codigo_ruv = this.nuevoRegistro.codigo_ruv,

                this.carrera = this.nuevoRegistro.carrera,
                this.entero = this.nuevoRegistro.entero

            this.registrarFicha(this.postulacion,
                this.apellidoPaterno,
                this.apellidoMaterno,
                this.nombres,
                this.tipoDoc,
                this.dni,
                this.edad,
                this.fechaNacimiento,
                this.nacimientoPeru,
                this.paisNacimiento,
                this.depNacimiento,
                this.provNacimiento,
                this.disNacimiento,
                this.depNacimientoExt,
                this.provNacimientoExt,
                this.disNacimientoExt,
                this.sexo,
                this.estadoCivil,
                this.direccion,
                this.depActual,
                this.provActual,
                this.disActual,
                this.telefonoCelular,
                this.telefonoFijo,
                this.correo,
                this.datosPadre,
                this.datosMadre,
                this.datosApoderado,
                this.dniApoderado,
                this.celularApoderado,
                this.colegio,
                this.fechaConcluyoIE,
                this.universidad,
                this.creditos,
                this.codigo_ruv,
                this.modalidad,
                this.carrera,
                this.entero)
        },
        guardarSegundaFicha() {
            this.postulacion = '2'
            this.modalidad = this.nuevoRegistro.modalidad,
                this.carrera = this.nuevoRegistro.carrera,

                this.universidad = this.nuevoRegistro.universidad,
                this.creditos = this.nuevoRegistro.creditos,
                this.codigo_ruv = this.nuevoRegistro.codigo_ruv,

                this.nuevoRegistro = Object.assign({}, this.ficha[0]);

            this.fechaConcluyoIE = this.nuevoRegistro.diep_ace

            this.nacimientoPeru = this.nuevoRegistro.dp_ln_peru
            if (this.nacimientoPeru == 1) {
                this.paisNacimiento = 'PERU',
                    this.depNacimiento = this.nuevoRegistro.dp_ln_dep,
                    this.provNacimiento = this.nuevoRegistro.dp_ln_prov,
                    this.disNacimiento = this.nuevoRegistro.dp_ln_dis,

                    this.paisNacimientoExt = '',
                    this.depNacimientoExt = '',
                    this.provNacimientoExt = '',
                    this.disNacimientoExt = ''
            } else {
                this.paisNacimiento = this.nuevoRegistro.dp_ln_pais,
                    this.depNacimientoExt = this.nuevoRegistro.dp_ln_dep_ext,
                    this.provNacimientoExt = this.nuevoRegistro.dp_ln_prov_ext,
                    this.disNacimientoExt = this.nuevoRegistro.dp_ln_dis_ext

                this.paisNacimientoExt = '',
                    this.depNacimiento = 0,
                    this.provNacimiento = 0,
                    this.disNacimiento = 0

            }

            this.apellidoPaterno = this.nuevoRegistro.dp_apellido_p,
                this.apellidoMaterno = this.nuevoRegistro.dp_apellido_m,
                this.nombres = this.nuevoRegistro.dp_nombre,
                this.tipoDoc = this.nuevoRegistro.id_tipo_documento,
                this.dni = this.nuevoRegistro.numero_documento,
                this.edad = this.nuevoRegistro.dp_edad,
                this.fechaNacimiento = this.nuevoRegistro.dp_fecha_n,

                this.sexo = this.nuevoRegistro.dp_sexo,
                this.estadoCivil = this.nuevoRegistro.dp_estado_c,
                this.direccion = this.nuevoRegistro.da_direccion,
                this.depActual = this.nuevoRegistro.da_dep,
                this.provActual = this.nuevoRegistro.da_prov,
                this.disActual = this.nuevoRegistro.da_dis,
                this.telefonoCelular = this.nuevoRegistro.da_numero_celular,
                this.telefonoFijo = this.nuevoRegistro.da_numero_telefono,
                this.correo = this.nuevoRegistro.da_email,
                this.datosPadre = this.nuevoRegistro.df_nombres_padre,
                this.datosMadre = this.nuevoRegistro.df_nombres_madre,
                this.datosApoderado = this.nuevoRegistro.df_nombres_apoderado,
                this.dniApoderado = this.nuevoRegistro.df_dni_apoderado,
                this.celularApoderado = this.nuevoRegistro.df_celular_apoderado,
                this.colegio = this.nuevoRegistro.diep_id_colegio,

                this.entero = this.nuevoRegistro.dd_publicidad

            console.log('guardarSegundaFicha')

            this.registrarFicha(this.postulacion,
                this.apellidoPaterno,
                this.apellidoMaterno,
                this.nombres,
                this.tipoDoc,
                this.dni,
                this.edad,
                this.fechaNacimiento,
                this.nacimientoPeru,
                this.paisNacimiento,
                this.depNacimiento,
                this.provNacimiento,
                this.disNacimiento,
                this.depNacimientoExt,
                this.provNacimientoExt,
                this.disNacimientoExt,
                this.sexo,
                this.estadoCivil,
                this.direccion,
                this.depActual,
                this.provActual,
                this.disActual,
                this.telefonoCelular,
                this.telefonoFijo,
                this.correo,
                this.datosPadre,
                this.datosMadre,
                this.datosApoderado,
                this.dniApoderado,
                this.celularApoderado,
                this.colegio,
                this.fechaConcluyoIE,
                this.universidad,
                this.creditos,
                this.codigo_ruv,
                this.modalidad,
                this.carrera,
                this.entero)
        },
        handleFileUpload(tipo) {
            if (tipo == 1) {
                this.objetoDoc.documentos = this.$refs.file1.files[0];
            }
            if (tipo == 2) {
                this.objetoDoc.requisitos = this.$refs.file2.files[0];
            }
            if (tipo == 3) {
                this.objetoDoc.dni = this.$refs.file3.files[0];
            }
            if (tipo == 4) {
                this.objetoDoc.foto = this.$refs.file4.files[0];
                this.urlfoto = URL.createObjectURL(this.objetoDoc.foto);
            }
        },
        encodeid(id) {

            let codigo = btoa(id);
            return codigo;
        },

        asignarDatos() {
            this.nuevoRegistro.apellidoPaterno = this.$parent.UserData.apellido_paterno
            this.nuevoRegistro.apellidoMaterno = this.$parent.UserData.apellido_materno
            this.nuevoRegistro.nombres = this.$parent.UserData.nombre
        },

        calcularEdad() {
            var today = new Date();
            var birthDate = new Date(this.nuevoRegistro.fechaNacimiento);
            var age = today.getFullYear() - birthDate.getFullYear();
            var m = today.getMonth() - birthDate.getMonth();
            if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
                age--;
            }
            this.nuevoRegistro.edad = age
        },
        guardarTerceraFicha() {
            this.postulacion = '3'
            this.modalidad = this.nuevoRegistro.modalidad,
                this.carrera = this.nuevoRegistro.carrera,

                this.universidad = this.nuevoRegistro.universidad,
                this.creditos = this.nuevoRegistro.creditos,
                this.codigo_ruv = this.nuevoRegistro.codigo_ruv,

                this.nuevoRegistro = Object.assign({}, this.ficha[0]);

            this.fechaConcluyoIE = this.nuevoRegistro.diep_ace

            this.nacimientoPeru = this.nuevoRegistro.dp_ln_peru
            if (this.nacimientoPeru == 1) {
                this.paisNacimiento = 'PERU',
                    this.depNacimiento = this.nuevoRegistro.dp_ln_dep,
                    this.provNacimiento = this.nuevoRegistro.dp_ln_prov,
                    this.disNacimiento = this.nuevoRegistro.dp_ln_dis,

                    this.paisNacimientoExt = '',
                    this.depNacimientoExt = '',
                    this.provNacimientoExt = '',
                    this.disNacimientoExt = ''
            } else {
                this.paisNacimiento = this.nuevoRegistro.dp_ln_pais,
                    this.depNacimientoExt = this.nuevoRegistro.dp_ln_dep_ext,
                    this.provNacimientoExt = this.nuevoRegistro.dp_ln_prov_ext,
                    this.disNacimientoExt = this.nuevoRegistro.dp_ln_dis_ext

                this.paisNacimientoExt = '',
                    this.depNacimiento = 0,
                    this.provNacimiento = 0,
                    this.disNacimiento = 0
            }

            this.apellidoPaterno = this.nuevoRegistro.dp_apellido_p,
                this.apellidoMaterno = this.nuevoRegistro.dp_apellido_m,
                this.nombres = this.nuevoRegistro.dp_nombre,
                this.tipoDoc = this.nuevoRegistro.id_tipo_documento,
                this.dni = this.nuevoRegistro.numero_documento,
                this.edad = this.nuevoRegistro.dp_edad,
                this.fechaNacimiento = this.nuevoRegistro.dp_fecha_n,

                this.sexo = this.nuevoRegistro.dp_sexo,
                this.estadoCivil = this.nuevoRegistro.dp_estado_c,
                this.direccion = this.nuevoRegistro.da_direccion,
                this.depActual = this.nuevoRegistro.da_dep,
                this.provActual = this.nuevoRegistro.da_prov,
                this.disActual = this.nuevoRegistro.da_dis,
                this.telefonoCelular = this.nuevoRegistro.da_numero_celular,
                this.telefonoFijo = this.nuevoRegistro.da_numero_telefono,
                this.correo = this.nuevoRegistro.da_email,
                this.datosPadre = this.nuevoRegistro.df_nombres_padre,
                this.datosMadre = this.nuevoRegistro.df_nombres_madre,
                this.datosApoderado = this.nuevoRegistro.df_nombres_apoderado,
                this.dniApoderado = this.nuevoRegistro.df_dni_apoderado,
                this.celularApoderado = this.nuevoRegistro.df_celular_apoderado,
                this.colegio = this.nuevoRegistro.diep_id_colegio,

                this.entero = this.nuevoRegistro.dd_publicidad

            console.log('guardarTerceraFicha')

            this.registrarFicha(this.postulacion,
                this.apellidoPaterno,
                this.apellidoMaterno,
                this.nombres,
                this.tipoDoc,
                this.dni,
                this.edad,
                this.fechaNacimiento,
                this.nacimientoPeru,
                this.paisNacimiento,
                this.depNacimiento,
                this.provNacimiento,
                this.disNacimiento,
                this.depNacimientoExt,
                this.provNacimientoExt,
                this.disNacimientoExt,
                this.sexo,
                this.estadoCivil,
                this.direccion,
                this.depActual,
                this.provActual,
                this.disActual,
                this.telefonoCelular,
                this.telefonoFijo,
                this.correo,
                this.datosPadre,
                this.datosMadre,
                this.datosApoderado,
                this.dniApoderado,
                this.celularApoderado,
                this.colegio,
                this.fechaConcluyoIE,
                this.universidad,
                this.creditos,
                this.codigo_ruv,
                this.modalidad,
                this.carrera,
                this.entero)
        },

        //SUBIR DOCUMENTOS
        async subirArchivo(id_documento, archivo, tipo) {

            this.botonEnviar = true;
            var formData = new FormData();
            formData.append("opcion", 2);
            formData.append("id_documento", id_documento);
            formData.append("tipo", tipo);
            formData.append("archivo", archivo);

            this.axios.post(this.$parent.NombreRuta + `/api/documentos/` + id_documento + `?_method=PUT`, formData)
                .then((response) => {
                    this.obtenerDocumentos()
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
                    //location.href ="/login";
                })
                .catch((error) => {
                    this.errors = error.response.data.errors;
                    console.log(error);
                });
        },
        subirArchivo12123: function (id_documento, archivo, tipo, codigo_pago) {
            this.botonEnviar = true;
            var formData = new FormData();
            formData.append("opcion", 2);
            formData.append("id_documento", id_documento);
            formData.append("tipo", tipo);
            formData.append("archivo", archivo);
            formData.append("codigo_pago", codigo_pago);
            axios.post(url3, formData, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                },
            }).then(response => {
                this.obtenerDatos()
                if (response.data == 1) {
                    this.$toast.open({
                        message: "Archivo enviado",
                        position: "top-right",
                        type: "success",
                        duration: 4000,
                        dismissible: true
                    })
                }
                if (response.data == 2) {
                    this.$toast.open({
                        message: "Archivo no enviado",
                        position: "top-right",
                        type: "error",
                        duration: 4000,
                        dismissible: true
                    })
                }
                if (response.data == 3) {
                    this.$toast.open({
                        message: "Extensión incorrecta",
                        position: "top-right",
                        type: "error",
                        duration: 4000,
                        dismissible: true
                    })
                }
            })
                .finally(() => this.botonEnviar = false)
        },

        confirmar_dj(id, dj_ficha_inscripcion, dj_apologia_t, dj_reglamento, dj_ingresante) {
            console.log(dj_ficha_inscripcion)
            this.guardar_dj(id, dj_ficha_inscripcion, dj_apologia_t, dj_reglamento, dj_ingresante)
        },

        enlacefoto(enlace) {
            if (enlace != null) {
                this.urlfoto = 'storage/documentos/' + enlace
            }
            return this.urlfoto
        },
        editarDocumento(datos) {
            this.subirDocumento = Object.assign({}, datos)
        },

        guardarArchivo(id_documento, tipo) {
            if (tipo == 1) {
                this.archivo = this.objetoDoc.documentos
            }
            if (tipo == 2) {
                this.archivo = this.objetoDoc.requisitos
            }
            if (tipo == 3) {
                this.archivo = this.objetoDoc.dni
            }
            if (tipo == 4) {
                this.archivo = this.objetoDoc.foto
            }

            if (this.archivo == '') {
                toastr.options = {
                    "positionClass": "toastr-bottom-right",
                    "timeOut": "5000"
                };
                toastr.error('Seleccione un archivo');
            }
            else {
                this.subirArchivo(id_documento, this.archivo, tipo)
            }
        },


        solicitarRevicion() {

            this.id_ficha = this.ficha[0].id

            this.registrarRevicion(this.id_ficha)
        },

        conforCarne(id_ficha) {
            //console.log(id_ficha)
            this.guardarConforCarne(id_ficha)
        },
        cerrarModal() {
            document.getElementById('btnCerrarModal').click();
        },
    },
    computed: {
        opcionCarne() {
            let estado
            let fecha_car = this.ficha[0].fecha_carne

            var fecha = new Date();
            var fecha_carne = new Date(fecha_car);
            console.log(fecha_carne > fecha);

            let resta = fecha_carne.getTime() - fecha.getTime()
            console.log(resta)
            this.horas_carne = parseInt(resta / (1000 * 60 * 60))
            /* let restante = new Date(resta);
            console.log(restante)
            ;
            test=moment(resta).tz('Atlantic/Madeira').format("DD HH:mm")
            console.log(test)*/

            if (fecha_carne >= fecha) {
                estado = true
            } else {
                estado = false
            }
            return estado
        },
        listaModalidad() {
            if (this.nuevoRegistro.modalidad == 1 || this.nuevoRegistro.modalidad == 11) {
                this.listaExtraordinario = true
                this.nuevoRegistro.modalidad2 = ''
            } else {
                this.listaExtraordinario = false
            }
            return this.listaExtraordinario
        },
        btnRevision: function () {
            let estado = false
            let mensaje = ''
            let monto_pagar = 1000
            let monto_pagado = 0

            let prospectoPendiente = false
            let examenPendiente = false
            let ambosPendiente = false

            let pagosSinEnviar = true
            if (this.ficha == 0) {
                estado = true
                mensaje += "<li>Completar la ficha de inscripción.</li> "
            }
            for (var i = 0; i < this.documentos.length; i++) {
                if (this.documentos[i].id_estado_revision == 0 || this.documentos[i].id_estado_revision == 2) {
                    estado = true;
                    if (this.documentos[i].tipo_documento_id == 1) {
                        mensaje += "<li>Subir las fichas de inscripción.</li> "
                    }
                    if (this.documentos[i].tipo_documento_id == 2) {
                        mensaje += "<li>Subir los requisitos.</li> "
                    }
                    if (this.documentos[i].tipo_documento_id == 3) {
                        mensaje += "<li>Subir DNI escaneado.</li> "
                    }
                    if (this.documentos[i].tipo_documento_id == 4) {
                        mensaje += "<li>Subir Foto del postulante.</li> "
                    }
                }
            };

            for (var i = 0; i < this.pagos.length; i++) {
                if (this.pagos[i].id_estado_revision == 0 || this.pagos[i].id_estado_revision == 2 || this.pagos[i].id_estado_revision == 1) {
                    //estado = true;
                    //console.log('documentos for dentro if')
                    /* if (this.pagos[i].id_tipo_pago == 1) {
                        mensaje += "<li>Prospecto no comprado.</li> "
                    }else if(this.pagos[i].id_tipo_pago == 2 && (!this.id_modalidad_usu==7 || !this.id_modalidad_usu==8)) {
                        mensaje += "<li>Voucher derecho de examen no validado.</li> "
                    } */
                    //mensaje += "<li>Completar pagos.</li> "
                }
                if ((this.pagos[i].id_estado_revision == 1 || this.pagos[i].id_estado_revision == 3) && this.pagos[i].id_tipo_pago == 1) {
                    prospectoPendiente = true
                }
                if ((this.pagos[i].id_estado_revision == 1 || this.pagos[i].id_estado_revision == 3) && this.pagos[i].id_tipo_pago == 2) {
                    examenPendiente = true
                }
                if ((this.pagos[i].id_estado_revision == 1 || this.pagos[i].id_estado_revision == 3) && this.pagos[i].id_tipo_pago == 3) {
                    ambosPendiente = true
                }
                if (this.pagos[i].id_estado_revision == 3) {
                    monto_pagado = this.pagos[i].monto_pago + monto_pagado
                }
            };

            /* console.log('prospectoPendiente', prospectoPendiente)
            console.log('examenPendiente', examenPendiente)
            console.log('ambosPendiente', ambosPendiente) */
            if (this.id_modalidad_usu == 1 || this.id_modalidad_usu == 2 || this.id_modalidad_usu == 3 || this.id_modalidad_usu == 4 || this.id_modalidad_usu == 5 || this.id_modalidad_usu == 6 || this.id_modalidad_usu == 10) {
                if ((examenPendiente && prospectoPendiente) || ambosPendiente) {
                    pagosSinEnviar = false
                }
            } else if (this.id_modalidad_usu == 7) {
                pagosSinEnviar = false
            } else if (this.id_modalidad_usu == 8) {
                if (prospectoPendiente) {
                    pagosSinEnviar = false
                }
            }
            /* if(this.id_modalidad_usu==7){
                monto_pagado = 0
            } */

            //verificar monto a pagar de pregrado
            // if (this.id_modalidad_usu == 1 || this.id_modalidad_usu == 2 || this.id_modalidad_usu == 5 || this.id_modalidad_usu == 6 || this.id_modalidad_usu == 11) {
            //     if (this.ficha[0].gestion_colegio == 1 || this.ficha[0].gestion_colegio == 2) {
            //         monto_pagar = 250
            //     } else {
            //         monto_pagar = 300
            //     }
            // } else if (this.id_modalidad_usu == 3) {
            //     monto_pagar = 550
            // } else if (this.id_modalidad_usu == 4) {
            //     monto_pagar = 350
            // } else if (this.id_modalidad_usu == 7) {
            //     monto_pagar = 0
            // } else if (this.id_modalidad_usu == 8) {
            //     monto_pagar = 50
            // } else if (this.id_modalidad_usu == 10) {
            //     monto_pagar = 150
            // }
            // Monto a pagar posgrado
            monto_pagar = 250
            /*if(this.ficha[0].extemporaneo==1){
                monto_pagar = monto_pagar + 50
            }*/

            if ((pagosSinEnviar && monto_pagado < monto_pagar)) {
                estado = true
                mensaje += "<li>Completar pagos incripciones.</li> "
            }
            /* else if(monto_pagado<monto_pagar){
                mensaje += "<li>Pago no completado.</li> "
            } */

            /* if((monto_pagado<monto_pagar) || pagosSinEnviar){
                estado=true
                mensaje += "<li>Completar pagos.</li> "
            } */


            if (this.ficha == 0 || this.ficha[0].id_estado_revision == 1 || this.ficha[0].id_estado_revision == 3) {
                estado = true
            }
            this.msgRevision = mensaje
            this.botonRevision = estado
            return estado
        }
    }
}
</script>
<style>
.vs-select-custom {
    --vs-controls-color: var(--kt-form-select-color);
    --vs-border-color: var(--kt-form-select-border-color);

    --vs-dropdown-bg: var(--kt-form-select-bg);
    --vs-dropdown-color: var(--kt-form-select-color);
    --vs-dropdown-option-color: var(--kt-form-select-color);

    --vs-selected-bg: #664cc3;
    --vs-selected-color: var(--kt-form-select-color);

    --vs-search-input-color: var(--kt-input-color);
    --vs-search-input-bg: var(--kt-form-select-bg);

    --vs-dropdown-option--active-bg: #664cc3;
    --vs-dropdown-option--active-color: #eeeeee;

    --vs-font-size: 1.1rem;
    --vs-line-height: 1.5;

    --vs-dropdown-option-padding: .775rem 3rem .775rem 1rem;
}</style>
