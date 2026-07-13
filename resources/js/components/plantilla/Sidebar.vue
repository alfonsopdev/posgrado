<template>
	<!--begin::sidebar-->
	<div id="kt_app_sidebar" class="app-sidebar flex-column" data-kt-drawer="true" data-kt-drawer-name="app-sidebar"
		data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="225px"
		data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_app_sidebar_mobile_toggle">
		<!--begin::Logo-->
		<div class="app-sidebar-logo px-6" id="kt_app_sidebar_logo">
			<!--begin::Logo image-->
			<a :href="$parent.NombreRuta + '/inicio'">
				<!-- <img alt="Logo" src="assets/media/logos/default-dark.svg" class="h-25px app-sidebar-logo-default" />
					<img alt="Logo" src="assets/media/logos/default-small.svg" class="h-20px app-sidebar-logo-minimize" /> -->
				<div class="app-sidebar-logo-default" style="font-size: 25px; color: white; font-family: sans-serif;">
					ADMISIÓN EPG
				</div>
				<div class="app-sidebar-logo-minimize" style="font-size: 10px; color: white; font-family: sans-serif;">
					UNDC
				</div>
			</a>
			<!--end::Logo image-->
			<!--begin::Sidebar toggle-->
			<div id="kt_app_sidebar_toggle"
				class="app-sidebar-toggle btn btn-icon btn-shadow btn-sm btn-color-muted btn-active-color-primary body-bg h-30px w-30px position-absolute top-50 start-100 translate-middle rotate"
				data-kt-toggle="true" data-kt-toggle-state="active" data-kt-toggle-target="body"
				data-kt-toggle-name="app-sidebar-minimize">
				<!--begin::Svg Icon | path: icons/duotune/arrows/arr079.svg-->
				<span class="svg-icon svg-icon-2 rotate-180">
					<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path opacity="0.5"
							d="M14.2657 11.4343L18.45 7.25C18.8642 6.83579 18.8642 6.16421 18.45 5.75C18.0358 5.33579 17.3642 5.33579 16.95 5.75L11.4071 11.2929C11.0166 11.6834 11.0166 12.3166 11.4071 12.7071L16.95 18.25C17.3642 18.6642 18.0358 18.6642 18.45 18.25C18.8642 17.8358 18.8642 17.1642 18.45 16.75L14.2657 12.5657C13.9533 12.2533 13.9533 11.7467 14.2657 11.4343Z"
							fill="currentColor" />
						<path
							d="M8.2657 11.4343L12.45 7.25C12.8642 6.83579 12.8642 6.16421 12.45 5.75C12.0358 5.33579 11.3642 5.33579 10.95 5.75L5.40712 11.2929C5.01659 11.6834 5.01659 12.3166 5.40712 12.7071L10.95 18.25C11.3642 18.6642 12.0358 18.6642 12.45 18.25C12.8642 17.8358 12.8642 17.1642 12.45 16.75L8.2657 12.5657C7.95328 12.2533 7.95328 11.7467 8.2657 11.4343Z"
							fill="currentColor" />
					</svg>
				</span>
				<!--end::Svg Icon-->
			</div>
			<!--end::Sidebar toggle-->
		</div>
		<!--end::Logo-->
		<!--begin::sidebar menu-->
		<div class="app-sidebar-menu overflow-hidden flex-column-fluid">
			<!--begin::Menu wrapper-->
			<div id="kt_app_sidebar_menu_wrapper" class="app-sidebar-wrapper hover-scroll-overlay-y my-5"
				data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-height="auto"
				data-kt-scroll-dependencies="#kt_app_sidebar_logo, #kt_app_sidebar_footer"
				data-kt-scroll-wrappers="#kt_app_sidebar_menu" data-kt-scroll-offset="5px" data-kt-scroll-save-state="true">
				<!--begin::Menu-->
				<div class="menu menu-column menu-rounded menu-sub-indention px-3" id="#kt_app_sidebar_menu"
					data-kt-menu="true" data-kt-menu-expand="false">
					<!--begin:Menu item-->
					<div class="menu-item" v-if="is('Administrador') || is('Asesor') || is('Colaborador')">
						<!--begin:Menu link-->
						<router-link class="menu-link" to="/dashboard" exact-active-class="active">
							<span class="menu-icon">
								<!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
								<span class="svg-icon svg-icon-2">
									<svg width="24" height="24" viewBox="0 0 24 24" fill="none"
										xmlns="http://www.w3.org/2000/svg">
										<rect x="2" y="2" width="9" height="9" rx="2" fill="currentColor" />
										<rect opacity="0.3" x="13" y="2" width="9" height="9" rx="2" fill="currentColor" />
										<rect opacity="0.3" x="13" y="13" width="9" height="9" rx="2" fill="currentColor" />
										<rect opacity="0.3" x="2" y="13" width="9" height="9" rx="2" fill="currentColor" />
									</svg>
								</span>
								<!--end::Svg Icon-->
							</span>
							<span class="menu-title">Dashboards</span>
						</router-link>
						<!--end:Menu link-->
					</div>
					<!--end:Menu item-->
					<div class="menu-item pt-5">
 						<div class="menu-content">
							<span class="menu-heading fw-bold text-uppercase fs-7">Configuración</span>
						</div>
 					</div>
					<div data-kt-menu-trigger="click" class="menu-item menu-accordion" v-if="is('Comision')">
 						<span class="menu-link">
							<span class="menu-icon">
 								<span class="svg-icon svg-icon-muted svg-icon-2"><svg width="25" height="28"
										viewBox="0 0 25 28" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path
											d="M24.0259 11.4401H1.97259C1.69436 11.4505 1.43123 11.5693 1.2394 11.7711C1.04757 11.9729 0.942247 12.2417 0.945922 12.5201V20.0801C0.933592 21.0248 1.10836 21.9627 1.46016 22.8395C1.81196 23.7164 2.33382 24.515 2.99568 25.1892C3.65754 25.8635 4.4463 26.4001 5.3165 26.7681C6.1867 27.1361 7.12112 27.3282 8.06592 27.3334H17.9993C19.8855 27.288 21.6778 26.5012 22.988 25.1436C24.2983 23.7859 25.0208 21.9667 24.9993 20.0801V12.5201C25.0037 12.2504 24.9057 11.989 24.7251 11.7886C24.5445 11.5882 24.2947 11.4637 24.0259 11.4401ZM8.73259 21.8401C8.51017 21.84 8.29271 21.7744 8.1073 21.6515C7.92189 21.5287 7.77672 21.354 7.68989 21.1492C7.60306 20.9444 7.5784 20.7186 7.61899 20.5C7.65957 20.2813 7.76361 20.0794 7.91813 19.9194C8.07266 19.7594 8.27084 19.6484 8.48798 19.6003C8.70513 19.5522 8.93164 19.569 9.1393 19.6487C9.34695 19.7283 9.52658 19.8673 9.65578 20.0484C9.78499 20.2294 9.85807 20.4445 9.86592 20.6668C9.86241 20.965 9.74146 21.2499 9.5293 21.4595C9.31714 21.6692 9.03087 21.7868 8.73259 21.7868V21.8401ZM8.73259 17.5868C8.50844 17.5868 8.28932 17.5203 8.10294 17.3958C7.91657 17.2712 7.77131 17.0942 7.68553 16.8871C7.59975 16.6801 7.5773 16.4522 7.62103 16.2323C7.66476 16.0125 7.7727 15.8105 7.9312 15.652C8.0897 15.4935 8.29164 15.3856 8.51149 15.3419C8.73133 15.2981 8.95921 15.3206 9.1663 15.4064C9.37339 15.4921 9.55039 15.6374 9.67492 15.8238C9.79945 16.0102 9.86592 16.2293 9.86592 16.4534C9.86771 16.6028 9.83962 16.7509 9.7833 16.8892C9.72697 17.0276 9.64356 17.1532 9.53796 17.2588C9.43236 17.3644 9.30672 17.4478 9.1684 17.5041C9.03009 17.5605 8.88192 17.5886 8.73259 17.5868ZM12.9993 21.8401C12.701 21.8331 12.4175 21.7088 12.2104 21.4941C12.0032 21.2794 11.889 20.9917 11.8926 20.6934C11.8926 20.3964 12.0106 20.1115 12.2206 19.9015C12.4307 19.6914 12.7155 19.5734 13.0126 19.5734C13.3096 19.5734 13.5945 19.6914 13.8045 19.9015C14.0146 20.1115 14.1326 20.3964 14.1326 20.6934C14.1291 20.9917 14.0081 21.2765 13.796 21.4862C13.5838 21.6959 13.2975 21.8135 12.9993 21.8134V21.8401ZM12.9993 17.5868C12.701 17.5798 12.4175 17.4555 12.2104 17.2408C12.0032 17.0261 11.889 16.7384 11.8926 16.4401C11.8926 16.1431 12.0106 15.8582 12.2206 15.6481C12.4307 15.4381 12.7155 15.3201 13.0126 15.3201C13.3096 15.3201 13.5945 15.4381 13.8045 15.6481C14.0146 15.8582 14.1326 16.1431 14.1326 16.4401C14.1326 16.7384 14.015 17.0246 13.8054 17.2368C13.5957 17.449 13.3109 17.5699 13.0126 17.5734L12.9993 17.5868ZM17.2393 21.8401C16.9387 21.8401 16.6504 21.7207 16.4379 21.5082C16.2253 21.2956 16.1059 21.0073 16.1059 20.7068C16.1059 20.4062 16.2253 20.1179 16.4379 19.9054C16.6504 19.6928 16.9387 19.5734 17.2393 19.5734C17.5398 19.5734 17.8281 19.6928 18.0406 19.9054C18.2532 20.1179 18.3726 20.4062 18.3726 20.7068C18.3726 21.0073 18.2532 21.2956 18.0406 21.5082C17.8281 21.7207 17.5398 21.8401 17.2393 21.8401ZM17.2393 17.5868C16.9387 17.5868 16.6504 17.4674 16.4379 17.2548C16.2253 17.0423 16.1059 16.754 16.1059 16.4534C16.1059 16.1529 16.2253 15.8646 16.4379 15.652C16.6504 15.4395 16.9387 15.3201 17.2393 15.3201C17.5398 15.3201 17.8281 15.4395 18.0406 15.652C18.2532 15.8646 18.3726 16.1529 18.3726 16.4534C18.3726 16.754 18.2532 17.0423 18.0406 17.2548C17.8281 17.4674 17.5398 17.5868 17.2393 17.5868ZM24.6393 8.13343C24.7349 8.40774 24.7203 8.7085 24.5984 8.9722C24.4765 9.2359 24.2569 9.44192 23.9859 9.54677C23.8703 9.58813 23.7487 9.61063 23.6259 9.61343H2.62592C2.2723 9.61343 1.93316 9.47296 1.68311 9.22291C1.43306 8.97286 1.29259 8.63372 1.29259 8.2801C1.28883 8.11525 1.32066 7.95153 1.38592 7.8001C1.77683 6.84295 2.37003 5.98161 3.12487 5.27509C3.87972 4.56858 4.77837 4.03358 5.75926 3.70677V1.62677C5.75926 1.3863 5.85478 1.15569 6.02481 0.985655C6.19485 0.815622 6.42546 0.720099 6.66592 0.720099C6.90639 0.720099 7.137 0.815622 7.30703 0.985655C7.47707 1.15569 7.57259 1.3863 7.57259 1.62677V3.33343H12.3059V1.62677C12.2904 1.49938 12.3021 1.37015 12.3402 1.24761C12.3783 1.12508 12.442 1.01204 12.5271 0.915961C12.6122 0.819883 12.7167 0.74296 12.8337 0.690277C12.9507 0.637594 13.0776 0.610352 13.2059 0.610352C13.3343 0.610352 13.4611 0.637594 13.5781 0.690277C13.6952 0.74296 13.7997 0.819883 13.8847 0.915961C13.9698 1.01204 14.0335 1.12508 14.0716 1.24761C14.1098 1.37015 14.1215 1.49938 14.1059 1.62677V3.33343H18.3326V1.62677C18.3171 1.49938 18.3287 1.37015 18.3669 1.24761C18.405 1.12508 18.4687 1.01204 18.5538 0.915961C18.6389 0.819883 18.7434 0.74296 18.8604 0.690277C18.9774 0.637594 19.1043 0.610352 19.2326 0.610352C19.3609 0.610352 19.4878 0.637594 19.6048 0.690277C19.7218 0.74296 19.8263 0.819883 19.9114 0.915961C19.9965 1.01204 20.0602 1.12508 20.0983 1.24761C20.1364 1.37015 20.1481 1.49938 20.1326 1.62677V3.70677C21.1713 4.05261 22.1173 4.63121 22.8984 5.39839C23.6794 6.16557 24.2749 7.10105 24.6393 8.13343Z"
											fill="currentColor"></path>
									</svg>
								</span>
 							</span>
							<span class="menu-title">Proceso de Admisión</span>
							<span class="menu-arrow"></span>
						</span>
					 
						<div class="menu-sub menu-sub-accordion">
							<div class="menu-item" v-if="is('Comision')">
 								<router-link class="menu-link" to="/reportes-dashboard" exact-active-class="active">
									<span class="menu-bullet">
										<span class="bullet bullet-dot"></span>
									</span>
									<span class="menu-title">Dashboard de proceso</span>
								</router-link>
 							</div>
							<div class="menu-item" v-if="is('Comision')">
 								<router-link class="menu-link" to="/proceso-admision" exact-active-class="active">
									<span class="menu-bullet">
										<span class="bullet bullet-dot"></span>
									</span>
									<span class="menu-title">Gestión de proceso</span>
								</router-link>
 							</div>
							<div class="menu-item" v-if="is('Comision')">
 								<router-link class="menu-link" to="/gestion-local" exact-active-class="active">
									<span class="menu-bullet">
										<span class="bullet bullet-dot"></span>
									</span>
									<span class="menu-title">Gestión de local</span>
								</router-link>
 							</div> 
							<div class="menu-item" v-if="is('Comision')">
 								<router-link class="menu-link" to="/gestion-programa" exact-active-class="active">
									<span class="menu-bullet">
										<span class="bullet bullet-dot"></span>
									</span>
									<span class="menu-title">Gestión de programa</span>
								</router-link>
 							</div> 
						</div>
 					</div>
					<!--begin:Menu item-->
					<div class="menu-item pt-5">
						<!--begin:Menu content-->
						<div class="menu-content">
							<span class="menu-heading fw-bold text-uppercase fs-7">Páginas</span>
						</div>
						<!--end:Menu content-->
					</div>
					<!--end:Menu item-->
					<!--begin:Menu item-->
					<div class="menu-item" v-if="is('Postulante')">
						<!--begin:Menu link-->
						<router-link class="menu-link" to="/pagos" exact-active-class="active">
							<span class="menu-icon">
								<!--begin::Svg Icon | path: icons/duotune/files/fil003.svg-->
								<span class="svg-icon svg-icon-2">
									<svg width="24" height="24" viewBox="0 0 24 24" fill="none"
										xmlns="http://www.w3.org/2000/svg">
										<path opacity="0.3"
											d="M3.20001 5.91897L16.9 3.01895C17.4 2.91895 18 3.219 18.1 3.819L19.2 9.01895L3.20001 5.91897Z"
											fill="currentColor" />
										<path opacity="0.3"
											d="M13 13.9189C13 12.2189 14.3 10.9189 16 10.9189H21C21.6 10.9189 22 11.3189 22 11.9189V15.9189C22 16.5189 21.6 16.9189 21 16.9189H16C14.3 16.9189 13 15.6189 13 13.9189ZM16 12.4189C15.2 12.4189 14.5 13.1189 14.5 13.9189C14.5 14.7189 15.2 15.4189 16 15.4189C16.8 15.4189 17.5 14.7189 17.5 13.9189C17.5 13.1189 16.8 12.4189 16 12.4189Z"
											fill="currentColor" />
										<path
											d="M13 13.9189C13 12.2189 14.3 10.9189 16 10.9189H21V7.91895C21 6.81895 20.1 5.91895 19 5.91895H3C2.4 5.91895 2 6.31895 2 6.91895V20.9189C2 21.5189 2.4 21.9189 3 21.9189H19C20.1 21.9189 21 21.0189 21 19.9189V16.9189H16C14.3 16.9189 13 15.6189 13 13.9189Z"
											fill="currentColor" />
									</svg>
								</span>
								<!--end::Svg Icon-->
							</span>
							<span class="menu-title">Pagos</span>
						</router-link>
						<!--end:Menu link-->
					</div>
					<!--end:Menu item-->
					<!--begin:Menu item-->
					<div class="menu-item" v-if="is('Postulante')">
						<!--begin:Menu link-->
						<router-link class="menu-link" to="/prospecto" exact-active-class="active">
							<span class="menu-icon">

								<span class="svg-icon svg-icon-2">
									<svg width="24" height="24" viewBox="0 0 24 24" fill="none"
										xmlns="http://www.w3.org/2000/svg">
										<path
											d="M20 14H18V10H20C20.6 10 21 10.4 21 11V13C21 13.6 20.6 14 20 14ZM21 19V17C21 16.4 20.6 16 20 16H18V20H20C20.6 20 21 19.6 21 19ZM21 7V5C21 4.4 20.6 4 20 4H18V8H20C20.6 8 21 7.6 21 7Z"
											fill="currentColor" />
										<path opacity="0.3"
											d="M17 22H3C2.4 22 2 21.6 2 21V3C2 2.4 2.4 2 3 2H17C17.6 2 18 2.4 18 3V21C18 21.6 17.6 22 17 22ZM10 7C8.9 7 8 7.9 8 9C8 10.1 8.9 11 10 11C11.1 11 12 10.1 12 9C12 7.9 11.1 7 10 7ZM13.3 16C14 16 14.5 15.3 14.3 14.7C13.7 13.2 12 12 10.1 12C8.10001 12 6.49999 13.1 5.89999 14.7C5.59999 15.3 6.19999 16 7.39999 16H13.3Z"
											fill="currentColor" />
									</svg>
								</span>

							</span>
							<span class="menu-title">Prospecto</span>
						</router-link>
						<!--end:Menu link-->
					</div>
					<!--end:Menu item-->
					<!--begin:Menu item-->
					<div class="menu-item" v-if="is('Postulante')">
						<!--begin:Menu link-->
						<router-link class="menu-link" to="/inscripcion" exact-active-class="active">
							<span class="menu-icon">
								<!--begin::Svg Icon | path: icons/duotune/communication/com013.svg-->
								<span class="svg-icon svg-icon-2">
									<svg width="24" height="24" viewBox="0 0 24 24" fill="none"
										xmlns="http://www.w3.org/2000/svg">
										<path opacity="0.3" fill-rule="evenodd" clip-rule="evenodd"
											d="M2 4.63158C2 3.1782 3.1782 2 4.63158 2H13.47C14.0155 2 14.278 2.66919 13.8778 3.04006L12.4556 4.35821C11.9009 4.87228 11.1726 5.15789 10.4163 5.15789H7.1579C6.05333 5.15789 5.15789 6.05333 5.15789 7.1579V16.8421C5.15789 17.9467 6.05333 18.8421 7.1579 18.8421H16.8421C17.9467 18.8421 18.8421 17.9467 18.8421 16.8421V13.7518C18.8421 12.927 19.1817 12.1387 19.7809 11.572L20.9878 10.4308C21.3703 10.0691 22 10.3403 22 10.8668V19.3684C22 20.8218 20.8218 22 19.3684 22H4.63158C3.1782 22 2 20.8218 2 19.3684V4.63158Z"
											fill="currentColor" />
										<path
											d="M10.9256 11.1882C10.5351 10.7977 10.5351 10.1645 10.9256 9.77397L18.0669 2.6327C18.8479 1.85165 20.1143 1.85165 20.8953 2.6327L21.3665 3.10391C22.1476 3.88496 22.1476 5.15129 21.3665 5.93234L14.2252 13.0736C13.8347 13.4641 13.2016 13.4641 12.811 13.0736L10.9256 11.1882Z"
											fill="currentColor" />
										<path
											d="M8.82343 12.0064L8.08852 14.3348C7.8655 15.0414 8.46151 15.7366 9.19388 15.6242L11.8974 15.2092C12.4642 15.1222 12.6916 14.4278 12.2861 14.0223L9.98595 11.7221C9.61452 11.3507 8.98154 11.5055 8.82343 12.0064Z"
											fill="currentColor" />
									</svg>
								</span>
								<!--end::Svg Icon-->
							</span>
							<span class="menu-title">Inscripción</span>
						</router-link>
						<!--end:Menu link-->
					</div>
					<!--end:Menu item-->
					<div class="menu-item" v-if="is('Postulante')">
						<!--begin:Menu link-->
						<!-- <router-link class="menu-link" to="/carnet-postulante" exact-active-class="active">
								<span class="menu-icon">
									<span class="svg-icon svg-icon-2"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path opacity="0.3" d="M19 22H5C4.4 22 4 21.6 4 21V3C4 2.4 4.4 2 5 2H14L20 8V21C20 21.6 19.6 22 19 22ZM12.5 18C12.5 17.4 12.6 17.5 12 17.5H8.5C7.9 17.5 8 17.4 8 18C8 18.6 7.9 18.5 8.5 18.5L12 18C12.6 18 12.5 18.6 12.5 18ZM16.5 13C16.5 12.4 16.6 12.5 16 12.5H8.5C7.9 12.5 8 12.4 8 13C8 13.6 7.9 13.5 8.5 13.5H15.5C16.1 13.5 16.5 13.6 16.5 13ZM12.5 8C12.5 7.4 12.6 7.5 12 7.5H8C7.4 7.5 7.5 7.4 7.5 8C7.5 8.6 7.4 8.5 8 8.5H12C12.6 8.5 12.5 8.6 12.5 8Z" fill="currentColor"/>
									<rect x="7" y="17" width="6" height="2" rx="1" fill="currentColor"/>
									<rect x="7" y="12" width="10" height="2" rx="1" fill="currentColor"/>
									<rect x="7" y="7" width="6" height="2" rx="1" fill="currentColor"/>
									<path d="M15 8H20L14 2V7C14 7.6 14.4 8 15 8Z" fill="currentColor"/>
									</svg>
									</span>
								</span>
								<span class="menu-title">Carné de postulante</span>
							</router-link> -->
						<!--end:Menu link-->
					</div>
					<!--end:Menu item-->
					<!--end:Menu item-->
					<div class="menu-item" v-if="is('Postulante')">
						<!--begin:Menu link-->
						<!--<router-link class="menu-link" to="/simulacros-admision" exact-active-class="active">
								<span class="menu-icon">
									<span class="svg-icon svg-icon-2">
										<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
										<rect x="2" y="2" width="9" height="9" rx="2" fill="currentColor"></rect> 
										<rect opacity="0.3" x="13" y="2" width="9" height="9" rx="2" fill="currentColor"></rect>
										<rect opacity="0.3" x="13" y="13" width="9" height="9" rx="2" fill="currentColor"></rect>
										<rect opacity="0.3" x="2" y="13" width="9" height="9" rx="2" fill="currentColor"></rect>
										</svg>
									</span>
								</span>
								<span class="menu-title">Simulacro</span>
							</router-link>-->
						<!--end:Menu link-->
					</div>
					<!--end:Menu item-->
					<!-- <div class="menu-item" v-if="is('Postulante')">
							<router-link class="menu-link" to="/simulacros-admision" exact-active-class="active">
								<span class="menu-icon">
									<span class="svg-icon svg-icon-2">
										<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
										<rect x="2" y="2" width="9" height="9" rx="2" fill="currentColor"></rect> 
										<rect opacity="0.3" x="13" y="2" width="9" height="9" rx="2" fill="currentColor"></rect>
										<rect opacity="0.3" x="13" y="13" width="9" height="9" rx="2" fill="currentColor"></rect>
										<rect opacity="0.3" x="2" y="13" width="9" height="9" rx="2" fill="currentColor"></rect>
										</svg>
									</span>
								</span>
								<span class="menu-title">Simulacro</span>
							</router-link>
						</div> -->

					<!--begin:Menu item-->
					<div data-kt-menu-trigger="click" class="menu-item menu-accordion"
						v-if="is('Administrador') || is('Asesor') || is('Colaborador') || is('Tesoreria')">
						<!--begin:Menu link-->
						<span class="menu-link">
							<span class="menu-icon">
								<!--begin::Svg Icon | path: icons/duotune/layouts/lay008.svg-->
								<span class="svg-icon svg-icon-2">
									<svg width="24" height="24" viewBox="0 0 24 24" fill="none"
										xmlns="http://www.w3.org/2000/svg">
										<path opacity="0.3"
											d="M3.20001 5.91897L16.9 3.01895C17.4 2.91895 18 3.219 18.1 3.819L19.2 9.01895L3.20001 5.91897Z"
											fill="currentColor" />
										<path opacity="0.3"
											d="M13 13.9189C13 12.2189 14.3 10.9189 16 10.9189H21C21.6 10.9189 22 11.3189 22 11.9189V15.9189C22 16.5189 21.6 16.9189 21 16.9189H16C14.3 16.9189 13 15.6189 13 13.9189ZM16 12.4189C15.2 12.4189 14.5 13.1189 14.5 13.9189C14.5 14.7189 15.2 15.4189 16 15.4189C16.8 15.4189 17.5 14.7189 17.5 13.9189C17.5 13.1189 16.8 12.4189 16 12.4189Z"
											fill="currentColor" />
										<path
											d="M13 13.9189C13 12.2189 14.3 10.9189 16 10.9189H21V7.91895C21 6.81895 20.1 5.91895 19 5.91895H3C2.4 5.91895 2 6.31895 2 6.91895V20.9189C2 21.5189 2.4 21.9189 3 21.9189H19C20.1 21.9189 21 21.0189 21 19.9189V16.9189H16C14.3 16.9189 13 15.6189 13 13.9189Z"
											fill="currentColor" />
									</svg>
								</span>
								<!--end::Svg Icon-->
							</span>
							<span class="menu-title">Pagos</span>
							<span class="menu-arrow"></span>
						</span>
						<!--end:Menu link-->
						<!--begin:Menu sub-->
						<div class="menu-sub menu-sub-accordion">
							<!--begin:Menu item-->

							<!--end:Menu item-->
							<!--begin:Menu item-->

							<!--end:Menu item-->
							<!--begin:Menu item-->
							<div class="menu-item">
								<!--begin:Menu link-->
								<router-link class="menu-link" to="/pagos-ambos" exact-active-class="active">
									<span class="menu-bullet">
										<span class="bullet bullet-dot"></span>
									</span>
									<span class="menu-title">D. examen y prospecto</span>
								</router-link>
								<!--end:Menu link-->
							</div>
							<!--end:Menu item-->
							<!--begin:Menu item-->
							<div class="menu-item">
								<!--begin:Menu link-->
								<!-- <router-link class="menu-link" to="/pagos-extemporaneo" exact-active-class="active">
										<span class="menu-bullet">
											<span class="bullet bullet-dot"></span>
										</span>
										<span class="menu-title">Recargo (S/ 50.00)</span>
									</router-link> -->
								<!--end:Menu link-->
							</div>
							<!--end:Menu item-->
						</div>
						<!--end:Menu sub-->
					</div>
					<!--end:Menu item-->
					<!--begin:Menu item-->
					<div data-kt-menu-trigger="click" class="menu-item menu-accordion"
						v-if="is('Administrador') || is('Asesor') || is('Colaborador')">
						<!--begin:Menu link-->
						<span class="menu-link">
							<span class="menu-icon">
								<!--begin::Svg Icon | path: /var/www/preview.keenthemes.com/kt-products/docs/metronic/html/releases/2022-11-24-050857/core/html/src/media/icons/duotune/art/art005.svg-->
								<span class="svg-icon svg-icon-2"><svg width="24" height="24" viewBox="0 0 24 24"
										fill="none" xmlns="http://www.w3.org/2000/svg">
										<path opacity="0.3"
											d="M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z"
											fill="currentColor" />
										<path
											d="M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z"
											fill="currentColor" />
									</svg>
								</span>
								<!--end::Svg Icon-->
							</span>
							<span class="menu-title">Inscripción</span>
							<span class="menu-arrow"></span>
						</span>
						<!--end:Menu link-->
						<!--begin:Menu sub-->
						<div class="menu-sub menu-sub-accordion">
							<!--begin:Menu item-->
							<div class="menu-item">
								<!--begin:Menu link-->
								<router-link class="menu-link" to="/inscribir" exact-active-class="active">
									<span class="menu-bullet">
										<span class="bullet bullet-dot"></span>
									</span>
									<span class="menu-title">Inscribir</span>
								</router-link>
								<!--end:Menu link-->
							</div>
							<div class="menu-item">
								<!--begin:Menu link-->
								<router-link class="menu-link" to="/descarga-carnet" exact-active-class="active">
									<span class="menu-bullet">
										<span class="bullet bullet-dot"></span>
									</span>
									<span class="menu-title">Descarga de carnet</span>
								</router-link>
								<!--end:Menu link-->
							</div>
							<!-- <div class="menu-item"> -->
								<!--begin:Menu link-->
								<!-- <router-link class="menu-link" to="/constancia-ingreso" exact-active-class="active">
									<span class="menu-bullet">
										<span class="bullet bullet-dot"></span>
									</span>
									<span class="menu-title">Constancia de Ingreso</span>
								</router-link> -->
								<!--end:Menu link-->
							<!-- </div> -->
							<!--end:Menu item-->
							<!--begin:Menu item-->
							<!-- <div class="menu-item">
									<a class="menu-link" href="#" exact-active-class="active">
										<span class="menu-bullet">
											<span class="bullet bullet-dot"></span>
										</span>
										<span class="menu-title">Inscritos</span>
									</a>
								</div> -->
							<!--end:Menu item-->
						</div>
						<!--end:Menu sub-->
					</div>
					<!--end:Menu item-->
					<!--begin:Menu item-->
					<div data-kt-menu-trigger="click" class="menu-item menu-accordion" v-if="is('Administrador')">
						<!--begin:Menu link-->
						<span class="menu-link">
							<span class="menu-icon">
								<!--begin::Svg Icon | path: /var/www/preview.keenthemes.com/kt-products/docs/metronic/html/releases/2022-11-24-050857/core/html/src/media/icons/duotune/art/art005.svg-->
								<span class="svg-icon svg-icon-muted svg-icon-2"><svg width="25" height="28"
										viewBox="0 0 25 28" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path
											d="M24.0259 11.4401H1.97259C1.69436 11.4505 1.43123 11.5693 1.2394 11.7711C1.04757 11.9729 0.942247 12.2417 0.945922 12.5201V20.0801C0.933592 21.0248 1.10836 21.9627 1.46016 22.8395C1.81196 23.7164 2.33382 24.515 2.99568 25.1892C3.65754 25.8635 4.4463 26.4001 5.3165 26.7681C6.1867 27.1361 7.12112 27.3282 8.06592 27.3334H17.9993C19.8855 27.288 21.6778 26.5012 22.988 25.1436C24.2983 23.7859 25.0208 21.9667 24.9993 20.0801V12.5201C25.0037 12.2504 24.9057 11.989 24.7251 11.7886C24.5445 11.5882 24.2947 11.4637 24.0259 11.4401ZM8.73259 21.8401C8.51017 21.84 8.29271 21.7744 8.1073 21.6515C7.92189 21.5287 7.77672 21.354 7.68989 21.1492C7.60306 20.9444 7.5784 20.7186 7.61899 20.5C7.65957 20.2813 7.76361 20.0794 7.91813 19.9194C8.07266 19.7594 8.27084 19.6484 8.48798 19.6003C8.70513 19.5522 8.93164 19.569 9.1393 19.6487C9.34695 19.7283 9.52658 19.8673 9.65578 20.0484C9.78499 20.2294 9.85807 20.4445 9.86592 20.6668C9.86241 20.965 9.74146 21.2499 9.5293 21.4595C9.31714 21.6692 9.03087 21.7868 8.73259 21.7868V21.8401ZM8.73259 17.5868C8.50844 17.5868 8.28932 17.5203 8.10294 17.3958C7.91657 17.2712 7.77131 17.0942 7.68553 16.8871C7.59975 16.6801 7.5773 16.4522 7.62103 16.2323C7.66476 16.0125 7.7727 15.8105 7.9312 15.652C8.0897 15.4935 8.29164 15.3856 8.51149 15.3419C8.73133 15.2981 8.95921 15.3206 9.1663 15.4064C9.37339 15.4921 9.55039 15.6374 9.67492 15.8238C9.79945 16.0102 9.86592 16.2293 9.86592 16.4534C9.86771 16.6028 9.83962 16.7509 9.7833 16.8892C9.72697 17.0276 9.64356 17.1532 9.53796 17.2588C9.43236 17.3644 9.30672 17.4478 9.1684 17.5041C9.03009 17.5605 8.88192 17.5886 8.73259 17.5868ZM12.9993 21.8401C12.701 21.8331 12.4175 21.7088 12.2104 21.4941C12.0032 21.2794 11.889 20.9917 11.8926 20.6934C11.8926 20.3964 12.0106 20.1115 12.2206 19.9015C12.4307 19.6914 12.7155 19.5734 13.0126 19.5734C13.3096 19.5734 13.5945 19.6914 13.8045 19.9015C14.0146 20.1115 14.1326 20.3964 14.1326 20.6934C14.1291 20.9917 14.0081 21.2765 13.796 21.4862C13.5838 21.6959 13.2975 21.8135 12.9993 21.8134V21.8401ZM12.9993 17.5868C12.701 17.5798 12.4175 17.4555 12.2104 17.2408C12.0032 17.0261 11.889 16.7384 11.8926 16.4401C11.8926 16.1431 12.0106 15.8582 12.2206 15.6481C12.4307 15.4381 12.7155 15.3201 13.0126 15.3201C13.3096 15.3201 13.5945 15.4381 13.8045 15.6481C14.0146 15.8582 14.1326 16.1431 14.1326 16.4401C14.1326 16.7384 14.015 17.0246 13.8054 17.2368C13.5957 17.449 13.3109 17.5699 13.0126 17.5734L12.9993 17.5868ZM17.2393 21.8401C16.9387 21.8401 16.6504 21.7207 16.4379 21.5082C16.2253 21.2956 16.1059 21.0073 16.1059 20.7068C16.1059 20.4062 16.2253 20.1179 16.4379 19.9054C16.6504 19.6928 16.9387 19.5734 17.2393 19.5734C17.5398 19.5734 17.8281 19.6928 18.0406 19.9054C18.2532 20.1179 18.3726 20.4062 18.3726 20.7068C18.3726 21.0073 18.2532 21.2956 18.0406 21.5082C17.8281 21.7207 17.5398 21.8401 17.2393 21.8401ZM17.2393 17.5868C16.9387 17.5868 16.6504 17.4674 16.4379 17.2548C16.2253 17.0423 16.1059 16.754 16.1059 16.4534C16.1059 16.1529 16.2253 15.8646 16.4379 15.652C16.6504 15.4395 16.9387 15.3201 17.2393 15.3201C17.5398 15.3201 17.8281 15.4395 18.0406 15.652C18.2532 15.8646 18.3726 16.1529 18.3726 16.4534C18.3726 16.754 18.2532 17.0423 18.0406 17.2548C17.8281 17.4674 17.5398 17.5868 17.2393 17.5868ZM24.6393 8.13343C24.7349 8.40774 24.7203 8.7085 24.5984 8.9722C24.4765 9.2359 24.2569 9.44192 23.9859 9.54677C23.8703 9.58813 23.7487 9.61063 23.6259 9.61343H2.62592C2.2723 9.61343 1.93316 9.47296 1.68311 9.22291C1.43306 8.97286 1.29259 8.63372 1.29259 8.2801C1.28883 8.11525 1.32066 7.95153 1.38592 7.8001C1.77683 6.84295 2.37003 5.98161 3.12487 5.27509C3.87972 4.56858 4.77837 4.03358 5.75926 3.70677V1.62677C5.75926 1.3863 5.85478 1.15569 6.02481 0.985655C6.19485 0.815622 6.42546 0.720099 6.66592 0.720099C6.90639 0.720099 7.137 0.815622 7.30703 0.985655C7.47707 1.15569 7.57259 1.3863 7.57259 1.62677V3.33343H12.3059V1.62677C12.2904 1.49938 12.3021 1.37015 12.3402 1.24761C12.3783 1.12508 12.442 1.01204 12.5271 0.915961C12.6122 0.819883 12.7167 0.74296 12.8337 0.690277C12.9507 0.637594 13.0776 0.610352 13.2059 0.610352C13.3343 0.610352 13.4611 0.637594 13.5781 0.690277C13.6952 0.74296 13.7997 0.819883 13.8847 0.915961C13.9698 1.01204 14.0335 1.12508 14.0716 1.24761C14.1098 1.37015 14.1215 1.49938 14.1059 1.62677V3.33343H18.3326V1.62677C18.3171 1.49938 18.3287 1.37015 18.3669 1.24761C18.405 1.12508 18.4687 1.01204 18.5538 0.915961C18.6389 0.819883 18.7434 0.74296 18.8604 0.690277C18.9774 0.637594 19.1043 0.610352 19.2326 0.610352C19.3609 0.610352 19.4878 0.637594 19.6048 0.690277C19.7218 0.74296 19.8263 0.819883 19.9114 0.915961C19.9965 1.01204 20.0602 1.12508 20.0983 1.24761C20.1364 1.37015 20.1481 1.49938 20.1326 1.62677V3.70677C21.1713 4.05261 22.1173 4.63121 22.8984 5.39839C23.6794 6.16557 24.2749 7.10105 24.6393 8.13343Z"
											fill="currentColor"></path>
									</svg>
								</span>
								<!--end::Svg Icon-->
							</span>
							<span class="menu-title">Examen</span>
							<span class="menu-arrow"></span>
						</span>
						<!--end:Menu link-->
						<!--begin:Menu sub-->
						<div class="menu-sub menu-sub-accordion">
							<!--begin:Menu item-->
							<!-- <div class="menu-item">
									<router-link class="menu-link" to="/verificar-carnet" exact-active-class="active">
										<span class="menu-bullet">
											<span class="bullet bullet-dot"></span>
										</span>
										<span class="menu-title">Verificar carné</span>
									</router-link>
								</div> -->
							<div class="menu-item" v-if="is('Administrador')">
								<!--begin:Menu link-->
								<router-link class="menu-link" to="/lista-aulas" exact-active-class="active">
									<span class="menu-bullet">
										<span class="bullet bullet-dot"></span>
									</span>
									<span class="menu-title">Lista de aulas</span>
								</router-link>
								<!--end:Menu link-->
							</div>
							<!--end:Menu item-->
							<!--begin:Menu item-->
							<!-- <div class="menu-item">
									<a class="menu-link" href="#" exact-active-class="active">
										<span class="menu-bullet">
											<span class="bullet bullet-dot"></span>
										</span>
										<span class="menu-title">Inscritos</span>
									</a>
								</div> -->
							<!--end:Menu item-->
						</div>
						<!--end:Menu sub-->
					</div>
					<div data-kt-menu-trigger="click" class="menu-item menu-accordion" v-if="is('Administrador')">
						<!--begin:Menu link-->
						<span class="menu-link">
							<span class="menu-icon">
								<!--begin::Svg Icon | path: /var/www/preview.keenthemes.com/kt-products/docs/metronic/html/releases/2022-11-24-050857/core/html/src/media/icons/duotune/art/art005.svg-->
								<span class="svg-icon svg-icon-muted svg-icon-2"><svg width="25" height="28"
										viewBox="0 0 25 28" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path
											d="M17.8254 27.3337H4.17203C3.1536 27.3337 2.17688 26.9291 1.45674 26.2089C0.736602 25.4888 0.332031 24.5121 0.332031 23.4937V4.50699C0.332031 3.48856 0.736602 2.51184 1.45674 1.7917C2.17688 1.07156 3.1536 0.666992 4.17203 0.666992H17.8254C18.8438 0.666992 19.8205 1.07156 20.5407 1.7917C21.2608 2.51184 21.6654 3.48856 21.6654 4.50699V23.4937C21.6654 24.5121 21.2608 25.4888 20.5407 26.2089C19.8205 26.9291 18.8438 27.3337 17.8254 27.3337ZM10.9987 7.33366C10.4713 7.33366 9.95571 7.49006 9.51718 7.78307C9.07865 8.07609 8.73685 8.49257 8.53502 8.97984C8.33319 9.46711 8.28038 10.0033 8.38327 10.5206C8.48616 11.0378 8.74014 11.513 9.11308 11.8859C9.48602 12.2589 9.96117 12.5129 10.4785 12.6158C10.9957 12.7186 11.5319 12.6658 12.0192 12.464C12.5065 12.2622 12.9229 11.9204 13.216 11.4818C13.509 11.0433 13.6654 10.5277 13.6654 10.0003C13.6654 9.29308 13.3844 8.6148 12.8843 8.11471C12.3842 7.61461 11.7059 7.33366 10.9987 7.33366ZM15.3587 19.3337C15.5794 19.347 15.8 19.3052 16.0005 19.2121C16.2011 19.1189 16.3753 18.9774 16.5076 18.8002C16.6398 18.623 16.7259 18.4157 16.7581 18.1969C16.7903 17.9781 16.7676 17.7548 16.692 17.547C16.2027 16.4571 15.3998 15.5378 14.3858 14.9061C13.3718 14.2744 12.1926 13.9591 10.9987 14.0003C9.81328 13.9677 8.64459 14.2856 7.63898 14.9141C6.63337 15.5426 5.83553 16.4538 5.34537 17.5337C4.9987 18.4003 5.70536 19.3337 7.38536 19.3337H15.3587ZM24.332 12.667H22.9987V18.0003H24.332C24.6857 18.0003 25.0248 17.8598 25.2748 17.6098C25.5249 17.3598 25.6654 17.0206 25.6654 16.667V14.0003C25.6654 13.6467 25.5249 13.3076 25.2748 13.0575C25.0248 12.8075 24.6857 12.667 24.332 12.667ZM24.332 4.66699H22.9987V10.0003H24.332C24.6857 10.0003 25.0248 9.85985 25.2748 9.6098C25.5249 9.35975 25.6654 9.02061 25.6654 8.66699V6.00033C25.6654 5.6467 25.5249 5.30756 25.2748 5.05752C25.0248 4.80747 24.6857 4.66699 24.332 4.66699Z"
											fill="currentColor" />
									</svg>
								</span>
								<!--end::Svg Icon-->
							</span>
							<span class="menu-title">Asistencia</span>
							<span class="menu-arrow"></span>
						</span>
						<div class="menu-sub menu-sub-accordion">
							<div class="menu-item" v-if="is('Administrador') || is('Asesor')">
								<!--begin:Menu link-->
								<router-link class="menu-link" to="/reporte-asistencia-qr" exact-active-class="active">
									<span class="menu-bullet">
										<span class="bullet bullet-dot"></span>
									</span>
									<span class="menu-title">Asistencia QR</span>
								</router-link>
								<!--end:Menu link-->
							</div>
							<div class="menu-item" v-if="is('Administrador') || is('Asesor')">
								<!--begin:Menu link-->
								<router-link class="menu-link" to="/lista-asistencia" exact-active-class="active">
									<span class="menu-bullet">
										<span class="bullet bullet-dot"></span>
									</span>
									<span class="menu-title">Lista Asistencia</span>
								</router-link>
							</div>
								<!--end:Menu link-->
								<div class="menu-item" v-if="is('Administrador')">
								<!--begin:Menu link-->
									<router-link class="menu-link" to="/asistencia-qr" exact-active-class="active">
										<span class="menu-bullet">
											<span class="bullet bullet-dot"></span>
										</span>
										<span class="menu-title">Registrar Asistencia</span>
									</router-link>
									<!--end:Menu link-->
								</div>
 						</div>
					</div>
					<!--end:Menu item-->
					<!--begin:Menu item-->
					<div data-kt-menu-trigger="click" class="menu-item menu-accordion"
						v-if="is('Administrador') || is('Asesor') || is('Colaborador')">
						<!--begin:Menu link-->
						<span class="menu-link">
							<span class="menu-icon">
								<!--begin::Svg Icon | path: /var/www/preview.keenthemes.com/kt-products/docs/metronic/html/releases/2022-11-24-050857/core/html/src/media/icons/duotune/art/art005.svg-->
								<!-- <span class="svg-icon svg-icon-2"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path opacity="0.3" d="M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z" fill="currentColor"/>
									<path d="M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z" fill="currentColor"/>
									</svg> 
									</span>-->
								<!--end::Svg Icon-->
								<span class="svg-icon svg-icon-2"><svg width="24" height="24" viewBox="0 0 24 24"
										fill="none" xmlns="http://www.w3.org/2000/svg">
										<path opacity="0.3"
											d="M22.1 11.5V12.6C22.1 13.2 21.7 13.6 21.2 13.7L19.9 13.9C19.7 14.7 19.4 15.5 18.9 16.2L19.7 17.2999C20 17.6999 20 18.3999 19.6 18.7999L18.8 19.6C18.4 20 17.8 20 17.3 19.7L16.2 18.9C15.5 19.3 14.7 19.7 13.9 19.9L13.7 21.2C13.6 21.7 13.1 22.1 12.6 22.1H11.5C10.9 22.1 10.5 21.7 10.4 21.2L10.2 19.9C9.4 19.7 8.6 19.4 7.9 18.9L6.8 19.7C6.4 20 5.7 20 5.3 19.6L4.5 18.7999C4.1 18.3999 4.1 17.7999 4.4 17.2999L5.2 16.2C4.8 15.5 4.4 14.7 4.2 13.9L2.9 13.7C2.4 13.6 2 13.1 2 12.6V11.5C2 10.9 2.4 10.5 2.9 10.4L4.2 10.2C4.4 9.39995 4.7 8.60002 5.2 7.90002L4.4 6.79993C4.1 6.39993 4.1 5.69993 4.5 5.29993L5.3 4.5C5.7 4.1 6.3 4.10002 6.8 4.40002L7.9 5.19995C8.6 4.79995 9.4 4.39995 10.2 4.19995L10.4 2.90002C10.5 2.40002 11 2 11.5 2H12.6C13.2 2 13.6 2.40002 13.7 2.90002L13.9 4.19995C14.7 4.39995 15.5 4.69995 16.2 5.19995L17.3 4.40002C17.7 4.10002 18.4 4.1 18.8 4.5L19.6 5.29993C20 5.69993 20 6.29993 19.7 6.79993L18.9 7.90002C19.3 8.60002 19.7 9.39995 19.9 10.2L21.2 10.4C21.7 10.5 22.1 11 22.1 11.5ZM12.1 8.59998C10.2 8.59998 8.6 10.2 8.6 12.1C8.6 14 10.2 15.6 12.1 15.6C14 15.6 15.6 14 15.6 12.1C15.6 10.2 14 8.59998 12.1 8.59998Z"
											fill="currentColor" />
										<path
											d="M17.1 12.1C17.1 14.9 14.9 17.1 12.1 17.1C9.30001 17.1 7.10001 14.9 7.10001 12.1C7.10001 9.29998 9.30001 7.09998 12.1 7.09998C14.9 7.09998 17.1 9.29998 17.1 12.1ZM12.1 10.1C11 10.1 10.1 11 10.1 12.1C10.1 13.2 11 14.1 12.1 14.1C13.2 14.1 14.1 13.2 14.1 12.1C14.1 11 13.2 10.1 12.1 10.1Z"
											fill="currentColor" />
									</svg>
								</span>
							</span>
							<span class="menu-title">Gestión</span>
							<span class="menu-arrow"></span>
						</span>
						<!--end:Menu link-->
						<!--begin:Menu sub-->
						<div class="menu-sub menu-sub-accordion">
							<!--begin:Menu item-->
							<div class="menu-item" v-if="is('Administrador') || is('Asesor') || is('Colaborador')">
								<!--begin:Menu link-->
								<router-link class="menu-link" to="/usuarios" exact-active-class="active">
									<span class="menu-bullet">
										<span class="bullet bullet-dot"></span>
									</span>
									<span class="menu-title">Usuarios</span>
								</router-link>
								<!--end:Menu link-->
							</div>
							<!--end:Menu item-->
							<!--begin:Menu item-->
							<div class="menu-item" v-if="is('Administrador')">
								<!--begin:Menu link-->
								<router-link class="menu-link" to="/usuarios-roles" exact-active-class="active">
									<span class="menu-bullet">
										<span class="bullet bullet-dot"></span>
									</span>
									<span class="menu-title">Usuarios roles</span>
								</router-link>
								<!--end:Menu link-->
							</div>
							<!--end:Menu item-->
							<!--begin:Menu item-->
							<div class="menu-item" v-if="is('Administrador') || is('Asesor') || is('Colaborador')">
								<!--begin:Menu link-->
								<!-- <router-link class="menu-link" to="/colegios" exact-active-class="active">
									<span class="menu-bullet">
										<span class="bullet bullet-dot"></span>
									</span>
									<span class="menu-title">Colegios</span>
								</router-link> -->
								<!--end:Menu link-->
							</div>
							<!--end:Menu item-->
							<!--begin:Menu item-->
							<div class="menu-item" v-if="is('Administrador')">
								<!--begin:Menu link-->
								 <router-link class="menu-link" to="/calidad" exact-active-class="active">
									<span class="menu-bullet">
										<span class="bullet bullet-dot"></span>
									</span>
									<span class="menu-title">Calidad</span>
								</router-link>
								<!--end:Menu link-->
							</div>
							<!--end:Menu item-->
							<!--begin:Menu item-->
							 <!--<div class="menu-item">
									<a class="menu-link" href="#" exact-active-class="active">
										<span class="menu-bullet">
											<span class="bullet bullet-dot"></span>
										</span>
										<span class="menu-title">Inscritos</span>
									</a>
								</div>-->
							<!--end:Menu item-->
						</div>
						<!--end:Menu sub-->
					</div>
					<!--end:Menu item-->
					<!--begin:Menu item-->
					<div data-kt-menu-trigger="click" class="menu-item menu-accordion"
						v-if="is('Administrador') || is('Tesoreria') || is('Comision') || is('Colaborador')">
						<!--begin:Menu link-->
						  <span class="menu-link">
							<span class="menu-icon">
								<!--begin::Svg Icon | path: /var/www/preview.keenthemes.com/kt-products/docs/metronic/html/releases/2022-11-24-050857/core/html/src/media/icons/duotune/art/art005.svg-->
								<!-- <span class="svg-icon svg-icon-2"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path opacity="0.3" d="M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z" fill="currentColor"/>
									<path d="M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z" fill="currentColor"/>
									</svg> 
									</span>-->
								<!--end::Svg Icon-->
								<span class="svg-icon svg-icon-2"><svg width="24" height="24" viewBox="0 0 24 24"
										fill="none" xmlns="http://www.w3.org/2000/svg">
										<path
											d="M13.0021 10.9128V3.01281C13.0021 2.41281 13.5021 1.91281 14.1021 2.01281C16.1021 2.21281 17.9021 3.11284 19.3021 4.61284C20.7021 6.01284 21.6021 7.91285 21.9021 9.81285C22.0021 10.4129 21.5021 10.9128 20.9021 10.9128H13.0021Z"
											fill="currentColor" />
										<path opacity="0.3"
											d="M11.0021 13.7128V4.91283C11.0021 4.31283 10.5021 3.81283 9.90208 3.91283C5.40208 4.51283 1.90209 8.41284 2.00209 13.1128C2.10209 18.0128 6.40208 22.0128 11.3021 21.9128C13.1021 21.8128 14.7021 21.3128 16.0021 20.4128C16.5021 20.1128 16.6021 19.3128 16.1021 18.9128L11.0021 13.7128Z"
											fill="currentColor" />
										<path opacity="0.3"
											d="M21.9021 14.0128C21.7021 15.6128 21.1021 17.1128 20.1021 18.4128C19.7021 18.9128 19.0021 18.9128 18.6021 18.5128L13.0021 12.9128H20.9021C21.5021 12.9128 22.0021 13.4128 21.9021 14.0128Z"
											fill="currentColor" />
									</svg>
								</span>
							</span>
							<!-- ++ -->
							<span class="menu-title">Reportes</span>
							<span class="menu-arrow"></span>
							<!-- ++ -->
						</span>
						<!--end:Menu link-->
						<!--begin:Menu sub-->
						<div class="menu-sub menu-sub-accordion">
							<!--begin:Menu item-->
							<div class="menu-item" v-if="is('Administrador') || is('Comision') || is('Colaborador')">
								<router-link class="menu-link" to="/reporte-asistencia-qr" exact-active-class="active">
									<span class="menu-bullet">
										<span class="bullet bullet-dot"></span>
									</span>
									<span class="menu-title">Reporte AsistenciaQR</span>
								</router-link>
							</div>
							<!--begin:Menu item-->
							<div class="menu-item" v-if="is('Administrador') || is('Comision') || is('Colaborador')">
								<!--begin:Menu link-->
								<router-link class="menu-link" to="/reporte-general" exact-active-class="active">
									<span class="menu-bullet">
										<span class="bullet bullet-dot"></span>
									</span>
									<span class="menu-title">General</span>
								</router-link>
								<!--end:Menu link-->
							</div>
							<!--end:Menu item-->
							<!--begin:Menu item-->
							<div class="menu-item" v-if="is('Administrador') || is('Comision') || is('Colaborador')">
								<!--begin:Menu link-->
								<router-link class="menu-link" to="/reporte-fecha" exact-active-class="active">
									<span class="menu-bullet">
										<span class="bullet bullet-dot"></span>
									</span>
									<span class="menu-title">Fechas</span>
								</router-link>
								<!--end:Menu link-->
							</div>
							<!--end:Menu item-->
							<!--begin:Menu item-->
							<div class="menu-item" v-if="is('Administrador') || is('Comision') || is('Colaborador')">
								<!--begin:Menu link-->
								<router-link class="menu-link" to="/reporte-carreras" exact-active-class="active">
									<span class="menu-bullet">
										<span class="bullet bullet-dot"></span>
									</span>
									<span class="menu-title">Programa de Estudio</span>
								</router-link>
								<!--end:Menu link-->
							</div>
							<!--end:Menu item-->
							<!--begin:Menu item-->
							<div class="menu-item" v-if="is('Administrador') || is('Comision') || is('Colaborador')">
								<!--begin:Menu link-->
								<router-link class="menu-link" to="/reporte-modalidades" exact-active-class="active">
									<span class="menu-bullet">
										<span class="bullet bullet-dot"></span>
									</span>
									<span class="menu-title">Modalidad</span>
								</router-link>
								<!--end:Menu link-->
							</div>
							<!--end:Menu item-->
							<div class="menu-item" v-if="is('Administrador') || is('Comision') || is('Colaborador')">
								<!--begin:Menu link-->
								<router-link class="menu-link" to="/reporte-colegios" exact-active-class="active">
									<span class="menu-bullet">
										<span class="bullet bullet-dot"></span>
									</span>
									<span class="menu-title">Universidades</span>
								</router-link>
								<!--end:Menu link-->
							</div>
							<!--begin:Menu item-->
							<div class="menu-item" v-if="is('Administrador') || is('Comision') || is('Colaborador')">
								<!--begin:Menu link-->
								<router-link class="menu-link" to="/reporte-distritos" exact-active-class="active">
									<span class="menu-bullet">
										<span class="bullet bullet-dot"></span>
									</span>
									<span class="menu-title">Distrito</span>
								</router-link> 
								<!--end:Menu link-->
							</div>
							<!--end:Menu item-->
							<!--begin:Menu item-->
							<div class="menu-item" v-if="is('Administrador') || is('Comision') || is('Colaborador')">
								<!--begin:Menu link-->
								<!-- <router-link class="menu-link" to="/reporte-publicidades" exact-active-class="active">
									<span class="menu-bullet">
										<span class="bullet bullet-dot"></span>
									</span>
									<span class="menu-title">Publicidad</span>
								</router-link> ++-->
								<!--end:Menu link-->
							</div>
							<!--end:Menu item-->
							<!--begin:Menu item-->
							<div class="menu-item" v-if="is('Administrador') || is('Tesoreria')">
								<!--begin:Menu link-->
								<router-link class="menu-link" to="/reporte-pagos-tesoreria" exact-active-class="active">
									<span class="menu-bullet">
										<span class="bullet bullet-dot"></span>
									</span>
									<span class="menu-title">Pagos</span>
								</router-link> 
								<!--end:Menu link-->
							</div>
							<!--end:Menu item-->
							<!--begin:Menu item-->
							<!--<div class="menu-item">
									<a class="menu-link" href="#" exact-active-class="active">
										<span class="menu-bullet">
											<span class="bullet bullet-dot"></span>
										</span>
										<span class="menu-title">Inscritos</span>
									</a>
								</div>--> 
							<!--end:Menu item-->
						</div>
						<!--end:Menu sub-->
					</div>
					<!--end:Menu item-->
					<!--begin:Menu item-->
					<!-- <div class="menu-item pt-5">
							<div class="menu-content">
								<span class="menu-heading fw-bold text-uppercase fs-7">Ajustes</span>
							</div>
						</div>
						<div data-kt-menu-trigger="click" class="menu-item menu-accordion">
							<span class="menu-link">
								<span class="menu-icon">
									<span class="svg-icon svg-icon-2">
										<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path d="M6.28548 15.0861C7.34369 13.1814 9.35142 12 11.5304 12H12.4696C14.6486 12 16.6563 13.1814 17.7145 15.0861L19.3493 18.0287C20.0899 19.3618 19.1259 21 17.601 21H6.39903C4.87406 21 3.91012 19.3618 4.65071 18.0287L6.28548 15.0861Z" fill="currentColor"/>
										<rect opacity="0.3" x="8" y="3" width="8" height="8" rx="4" fill="currentColor"/>
										</svg>
									</span>
								</span>
								<span class="menu-title">Cuenta</span>
								<span class="menu-arrow"></span>
							</span>
							<div class="menu-sub menu-sub-accordion">
								<div class="menu-item">
									<a class="menu-link" href="../../demo1/dist/layouts/light-sidebar.html">
										<span class="menu-bullet">
											<span class="bullet bullet-dot"></span>
										</span>
										<span class="menu-title">Light Sidebar</span>
									</a>
								</div>
							</div>
						</div> -->
				<!--end:Menu item-->
				<!--begin:Menu item-->
				<!-- <div class="menu-item pt-5">
							<div class="menu-content">
								<span class="menu-heading fw-bold text-uppercase fs-7">Ayuda</span>
							</div>
						</div> -->
				<!--end:Menu item-->
				<!--begin:Menu item-->
				<!-- <div class="menu-item">
							<a class="menu-link" href="#">
								<span class="menu-icon">
									<span class="svg-icon svg-icon-2">
										<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
											<path opacity="0.3" d="M4.05424 15.1982C8.34524 7.76818 13.5782 3.26318 20.9282 2.01418C21.0729 1.98837 21.2216 1.99789 21.3618 2.04193C21.502 2.08597 21.6294 2.16323 21.7333 2.26712C21.8372 2.37101 21.9144 2.49846 21.9585 2.63863C22.0025 2.7788 22.012 2.92754 21.9862 3.07218C20.7372 10.4222 16.2322 15.6552 8.80224 19.9462L4.05424 15.1982ZM3.81924 17.3372L2.63324 20.4482C2.58427 20.5765 2.5735 20.7163 2.6022 20.8507C2.63091 20.9851 2.69788 21.1082 2.79503 21.2054C2.89218 21.3025 3.01536 21.3695 3.14972 21.3982C3.28408 21.4269 3.42387 21.4161 3.55224 21.3672L6.66524 20.1802L3.81924 17.3372ZM16.5002 5.99818C16.2036 5.99818 15.9136 6.08615 15.6669 6.25097C15.4202 6.41579 15.228 6.65006 15.1144 6.92415C15.0009 7.19824 14.9712 7.49984 15.0291 7.79081C15.0869 8.08178 15.2298 8.34906 15.4396 8.55884C15.6494 8.76862 15.9166 8.91148 16.2076 8.96935C16.4986 9.02723 16.8002 8.99753 17.0743 8.884C17.3484 8.77046 17.5826 8.5782 17.7474 8.33153C17.9123 8.08486 18.0002 7.79485 18.0002 7.49818C18.0002 7.10035 17.8422 6.71882 17.5609 6.43752C17.2796 6.15621 16.8981 5.99818 16.5002 5.99818Z" fill="currentColor" />
											<path d="M4.05423 15.1982L2.24723 13.3912C2.15505 13.299 2.08547 13.1867 2.04395 13.0632C2.00243 12.9396 1.9901 12.8081 2.00793 12.679C2.02575 12.5498 2.07325 12.4266 2.14669 12.3189C2.22013 12.2112 2.31752 12.1219 2.43123 12.0582L9.15323 8.28918C7.17353 10.3717 5.4607 12.6926 4.05423 15.1982ZM8.80023 19.9442L10.6072 21.7512C10.6994 21.8434 10.8117 21.9129 10.9352 21.9545C11.0588 21.996 11.1903 22.0083 11.3195 21.9905C11.4486 21.9727 11.5718 21.9252 11.6795 21.8517C11.7872 21.7783 11.8765 21.6809 11.9402 21.5672L15.7092 14.8442C13.6269 16.8245 11.3061 18.5377 8.80023 19.9442ZM7.04023 18.1832L12.5832 12.6402C12.7381 12.4759 12.8228 12.2577 12.8195 12.032C12.8161 11.8063 12.725 11.5907 12.5653 11.4311C12.4057 11.2714 12.1901 11.1803 11.9644 11.1769C11.7387 11.1736 11.5205 11.2583 11.3562 11.4132L5.81323 16.9562L7.04023 18.1832Z" fill="currentColor" />
										</svg>
									</span>
								</span>
								<span class="menu-title">Components</span>
							</a>
						</div> -->
			</div>
			<!--end::Menu-->
		</div>
		<!--end::Menu wrapper-->
	</div>
	<!--end::sidebar menu-->
	<!--begin::Footer-->
	<!-- <div class="app-sidebar-footer flex-column-auto pt-2 pb-6 px-6" id="kt_app_sidebar_footer">
				<a href="../../demo1/dist/documentation/getting-started.html" class="btn btn-flex flex-center btn-custom btn-primary overflow-hidden text-nowrap px-0 h-40px w-100" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss-="click" title="200+ in-house components and 3rd-party plugins">
					<span class="btn-label">Otros</span>
					<span class="svg-icon btn-icon svg-icon-2 m-0">
						<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path opacity="0.3" d="M19 22H5C4.4 22 4 21.6 4 21V3C4 2.4 4.4 2 5 2H14L20 8V21C20 21.6 19.6 22 19 22ZM12.5 18C12.5 17.4 12.6 17.5 12 17.5H8.5C7.9 17.5 8 17.4 8 18C8 18.6 7.9 18.5 8.5 18.5L12 18C12.6 18 12.5 18.6 12.5 18ZM16.5 13C16.5 12.4 16.6 12.5 16 12.5H8.5C7.9 12.5 8 12.4 8 13C8 13.6 7.9 13.5 8.5 13.5H15.5C16.1 13.5 16.5 13.6 16.5 13ZM12.5 8C12.5 7.4 12.6 7.5 12 7.5H8C7.4 7.5 7.5 7.4 7.5 8C7.5 8.6 7.4 8.5 8 8.5H12C12.6 8.5 12.5 8.6 12.5 8Z" fill="currentColor" />
							<rect x="7" y="17" width="6" height="2" rx="1" fill="currentColor" />
							<rect x="7" y="12" width="10" height="2" rx="1" fill="currentColor" />
							<rect x="7" y="7" width="6" height="2" rx="1" fill="currentColor" />
							<path d="M15 8H20L14 2V7C14 7.6 14.4 8 15 8Z" fill="currentColor" />
						</svg>
					</span>
				</a>
			</div> -->
	<!--end::Footer-->
</div>
<!--end::sidebar--></template>
<script>
export default {

}
</script>