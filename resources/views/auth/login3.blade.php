@extends('layouts.app')

@section('content')
	<!--<div id="app">-->
	<div class="d-flex flex-column flex-lg-row flex-column-fluid">
		<!--begin::Aside-->
		<div class="d-flex flex-lg-row-fluid">
			<!--begin::Content-->
			<div class="d-flex flex-column flex-center pb-0 pb-lg-10 p-10 w-100">
				<!--begin::Image-->
				{{-- <img class="theme-light-show mx-auto mw-100 w-150px w-lg-300px mb-10 mb-lg-20" src="../assets/media/auth/agency.png" alt="" />
				<img class="theme-dark-show mx-auto mw-100 w-150px w-lg-300px mb-10 mb-lg-20" src="../assets/media/auth/agency-dark.png" alt="" /> --}}
				<!--end::Image-->
				<!--begin::Title-->
				<h1 class="text-gray-800 fs-2qx fw-bold text-center mb-7">Sistema de Admisión de la Escuela de Posgrado de la UNDC</h1>
				<!--end::Title-->
				<!--begin::Text-->
				<!-- <div class="text-gray-600 fs-base text-center fw-semibold">In this kind of post,
				<a href="#" class="opacity-75-hover text-primary me-1">the blogger</a>introduces a person they’ve interviewed
				<br />and provides some background information about
				<a href="#" class="opacity-75-hover text-primary me-1">the interviewee</a>and their
				<br />work following this is a transcript of the interview.</div> -->
				<!--end::Text-->
			</div>
			<!--end::Content-->
		</div>
		<!--begin::Aside-->
		<!--begin::Body-->
		<div class="d-flex flex-column-fluid flex-lg-row-auto justify-content-center justify-content-lg-end p-12">
			<!--begin::Wrapper-->
			<div class="bg-body d-flex flex-center rounded-4 w-md-600px p-10">
				<!--begin::Content-->
				<div class="w-md-400px">
					<!--begin::Form-->
					<form class="form w-100" action="{{route('login')}}" novalidate="novalidate" id="kt_sign_in_form" method="POST">
					<!--<form action="/login" class="form w-100" novalidate="novalidate" id="kt_sign_in_form" method="POST">-->
						<!--begin::Heading-->
						@csrf
						<div class="text-center mb-11">
							<!--begin::Title-->
							<h1 class="text-dark fw-bolder mb-3">Iniciar sesión</h1>
							<!--end::Title-->
							<!--begin::Subtitle-->
							<div class="text-gray-500 fw-semibold fs-6">Accede a la plataforma</div>
							<!--end::Subtitle=-->
						</div>
						<!--begin::Heading-->
						<!--begin::Login options-->
						<!-- <div class="row g-3 mb-9">
							<div class="col-md-6">
								<a href="#" class="btn btn-flex btn-outline btn-text-gray-700 btn-active-color-primary bg-state-light flex-center text-nowrap w-100">
								<img alt="Logo" src="assets/media/svg/brand-logos/google-icon.svg" class="h-15px me-3" />Sign in with Google</a>
							</div>
							<div class="col-md-6">
								<a href="#" class="btn btn-flex btn-outline btn-text-gray-700 btn-active-color-primary bg-state-light flex-center text-nowrap w-100">
								<img alt="Logo" src="assets/media/svg/brand-logos/apple-black.svg" class="theme-light-show h-15px me-3" />
								<img alt="Logo" src="assets/media/svg/brand-logos/apple-black-dark.svg" class="theme-dark-show h-15px me-3" />Sign in with Apple</a>
							</div>
						</div> -->
						<!--end::Login options-->
						<!--begin::Separator-->
						<!-- <div class="separator separator-content my-14">
							<span class="w-125px text-gray-500 fw-semibold fs-7">Or with email</span>
						</div> -->
						<!--end::Separator-->
						<!--begin::Input group=-->
						<div class="fv-row mb-8">
							<!--begin::Email-->
							<input type="text" placeholder="Ingrese DNI o Email" name="email" value="{{ old('email') }}" autocomplete="off" class="form-control bg-transparent" />
							<!--end::Email-->
							@error('email') <div>{{$message}}</div>@enderror
						</div>
						<!--end::Input group=-->
						{{-- <div class="fv-row mb-3">
							<input type="password" placeholder="Contraseña"  name="password" autocomplete="off" class="form-control bg-transparent" />
							@error('password') <div>{{$message}}</div>@enderror
						</div> --}}
						<div class="fv-row mb-3" data-kt-password-meter="true">
							<div class="mb-1">
								<div class="position-relative mb-3">
									<input class="form-control bg-transparent" type="password" placeholder="Contraseña" name="password" autocomplete="off" required/>
									<span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2" data-kt-password-meter-control="visibility">
										<i class="bi bi-eye-slash fs-2"></i>
										<i class="bi bi-eye fs-2 d-none"></i>
									</span>
									@error('password') <div>{{$message}}</div>@enderror
								</div>
							</div>
						</div>
						<!--end::Input group=-->
						<!--begin::Wrapper-->
						<div class="d-flex flex-stack flex-wrap gap-3 fs-base fw-semibold mb-8">
							<div></div>
							<!--begin::Link-->
							<a href="forgot-password" class="link-primary">¿Has olvidado tu contraseña?</a>
							<!--end::Link-->
						</div>
						<!--end::Wrapper-->
						<div class="col-md-12">
							<!-- <span v-if="error">
								<div v-for="(e, index) in mensajeError" v-bind:key="index" v-text="e"></div>
							</span> -->

						</div>
						{{-- <div v-if="error" class="alert alert-dismissible bg-danger d-flex flex-column flex-sm-row w-100 p-5 mb-10">
							<span class="svg-icon svg-icon-2hx svg-icon-light me-4 mb-5 mb-sm-0">
								<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path opacity="0.3" d="M2 4V16C2 16.6 2.4 17 3 17H13L16.6 20.6C17.1 21.1 18 20.8 18 20V17H21C21.6 17 22 16.6 22 16V4C22 3.4 21.6 3 21 3H3C2.4 3 2 3.4 2 4Z" fill="currentColor"></path>
									<path d="M18 9H6C5.4 9 5 8.6 5 8C5 7.4 5.4 7 6 7H18C18.6 7 19 7.4 19 8C19 8.6 18.6 9 18 9ZM16 12C16 11.4 15.6 11 15 11H6C5.4 11 5 11.4 5 12C5 12.6 5.4 13 6 13H15C15.6 13 16 12.6 16 12Z" fill="currentColor"></path>
								</svg>
							</span>
							<div class="d-flex flex-column text-light pe-0 pe-sm-10">
								<span v-for="(e, index) in mensajeError" v-bind:key="index" v-text="e">The alert component can be used to highlight certain parts of your page for higher content visibility.</span>
							</div>
						</div> --}}
					
						<!--begin::Submit button-->
						<div class="d-grid mb-5">
							<button type="submit" id="kt_sign_in_submit" value="Login" class="btn btn-primary">
								<!--begin::Indicator label-->
								<span class="indicator-label">Iniciar sesion</span>
								<!--end::Indicator label-->
								<!--begin::Indicator progress-->
								<span class="indicator-progress">Please wait...
								<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
								<!--end::Indicator progress-->
							</button>
							<!-- <input type="submit" value="Login"> -->
						</div>
						<!--end::Submit button-->
						<!--begin::Sign up-->
						<div class="text-gray-500 text-center fw-semibold fs-6 mb-15">¿No tienes una cuenta?
						<a href="register" class="link-primary">Registrarse</a></div>
						<!--end::Sign up-->

						<div class="d-grid mb-2">
						<a href="https://drive.google.com/file/d/11EAPhB-6d0z9y4Hi5hCyo8rTk-_zhrbo/view?usp=sharing" class="btn btn-success" target="_blank">
								<span class="indicator-label">Manual de inscripciones</span>
							</a>
						</div>
					</form>
					<!--end::Form-->
				</div>
				<!--end::Content-->
			</div>
			<!--end::Wrapper-->
		</div>
		<!--end::Body-->
	</div>
@endsection