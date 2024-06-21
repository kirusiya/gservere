<!DOCTYPE html>
<html lang="en">
	<!--begin::Head-->
	<head>
        
		<title><?php echo ConfiguracoesSistema('nome_site'); ?> - Login</title>
		<meta charset="utf-8" />

		<link rel="apple-touch-icon" sizes="57x57" href="<?php echo base_url();?>uploads/favicon.png">
		<link rel="apple-touch-icon" sizes="60x60" href="<?php echo base_url();?>uploads/favicon.png">
		<link rel="apple-touch-icon" sizes="72x72" href="<?php echo base_url();?>uploads/favicon.png">
		<link rel="apple-touch-icon" sizes="76x76" href="<?php echo base_url();?>uploads/favicon.png">
		<link rel="apple-touch-icon" sizes="114x114" href="<?php echo base_url();?>uploads/favicon.png">
		<link rel="apple-touch-icon" sizes="120x120" href="<?php echo base_url();?>uploads/favicon.png">
		<link rel="apple-touch-icon" sizes="144x144" href="<?php echo base_url();?>uploads/favicon.png">
		<link rel="apple-touch-icon" sizes="152x152" href="<?php echo base_url();?>uploads/favicon.png">
		<link rel="apple-touch-icon" sizes="180x180" href="<?php echo base_url();?>uploads/favicon.png">
		<link rel="icon" type="image/png" sizes="192x192"  href="<?php echo base_url();?>uploads/favicon.png">
		<link rel="icon" type="image/png" sizes="32x32" href="<?php echo base_url();?>uploads/favicon.png">
		<link rel="icon" type="image/png" sizes="96x96" href="<?php echo base_url();?>uploads/favicon.png">
		<link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url();?>uploads/favicon.png">




		<!--begin::Fonts(mandatory for all pages)-->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
		<!--end::Fonts-->
		<!--begin::Global Stylesheets Bundle(mandatory for all pages)-->
		<link href="<?php echo base_url(); ?>assets2/assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
		<link href="<?php echo base_url(); ?>assets2/assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
		<!--end::Global Stylesheets Bundle-->
		<script>// Frame-busting to prevent site from being loaded within a frame without permission (click-jacking) if (window.top != window.self) { window.top.location.replace(window.self.location.href); }</script>
	</head>
	<!--end::Head-->
	<!--begin::Body-->
	<body id="kt_body" class="app-blank app-blank">
		<!--begin::Theme mode setup on page load-->
		<script>var defaultThemeMode = "light"; var themeMode; if ( document.documentElement ) { if ( document.documentElement.hasAttribute("data-bs-theme-mode")) { themeMode = document.documentElement.getAttribute("data-bs-theme-mode"); } else { if ( localStorage.getItem("data-bs-theme") !== null ) { themeMode = localStorage.getItem("data-bs-theme"); } else { themeMode = defaultThemeMode; } } if (themeMode === "system") { themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light"; } document.documentElement.setAttribute("data-bs-theme", themeMode); }</script>
		<!--end::Theme mode setup on page load-->
		<!--begin::Root-->
		<div class="d-flex flex-column flex-root" id="kt_app_root">
			<!--begin::Authentication - Sign-in -->
			<div class="d-flex flex-column flex-lg-row flex-column-fluid">
				<!--begin::Aside-->
				<div class="d-flex flex-lg-row-fluid w-lg-50 bgi-size-cover bgi-position-center" style="background-image: url(<?php echo base_url(); ?>assets2/assets/media/misc/auth-bg.png)">
					<!--begin::Content-->
					<div class="d-flex flex-column flex-center p-6 p-lg-10 w-100">
						<!--begin::Logo-->
						<a href="index.html" class="mb-0 mb-lg-20">
							<img alt="Logo" src="<?php echo base_url(); ?>assets2/assets/media/logos/default-white.svg" class="h-40px h-lg-50px" />
						</a>
						<!--end::Logo-->
						<!--begin::Image-->
						<img class="d-none d-lg-block mx-auto w-300px w-lg-75 w-xl-500px mb-10 mb-lg-20" src="<?php echo base_url(); ?>assets2/assets/media/misc/auth-screens.png" alt="" />
						<!--end::Image-->
						<!--begin::Title-->
						<h1 class="d-none d-lg-block text-white fs-2qx fw-bold text-center mb-7">Fast, Efficient and Productive</h1>
						<!--end::Title-->
						<!--begin::Text-->
						<div class="d-none d-lg-block text-white fs-base text-center">In this kind of post, 
						<a href="#" class="opacity-75-hover text-warning fw-semibold me-1">the blogger</a>introduces a person they’ve interviewed 
						<br />and provides some background information about 
						<a href="#" class="opacity-75-hover text-warning fw-semibold me-1">the interviewee</a>and their 
						<br />work following this is a transcript of the interview.</div>
						<!--end::Text-->
					</div>
					<!--end::Content-->
				</div>
				<!--begin::Aside-->
				<!--begin::Body-->
				<div class="d-flex flex-column flex-lg-row-fluid w-lg-50 p-10">
					<!--begin::Form-->
					<div class="d-flex flex-center flex-column flex-lg-row-fluid">
						<!--begin::Wrapper-->
						<div class="w-lg-500px p-10">
							<!--begin::Form-->
							<form id="formMetabiz" class="form w-100" method="post" role="form" action="<?php echo base_url('login'); ?>">

							
								<!--begin::Heading-->
								<div class="text-center mb-11">
                                    <img src="<?php echo base_url(); ?>uploads/<?php echo ConfiguracoesSistema('logo'); ?>" alt="flecha" class=" img-fluid" width="200">
								</div>
								<!--begin::Heading-->

                                <!--begin::Heading-->
								<div class="text-center mb-11">
                                    
									<!--begin::Title-->
									<h1 class="text-gray-900 fw-bolder mb-3">Login</h1>
									<!--end::Title-->

									<?php 
									if(isset($message) && isset($_GET['cod'])) {
										echo $message;
									};
									?>
								</div>
								<!--begin::Heading-->
								
								<!--begin::Input group=-->
								<div class="fv-row mb-8">
									<!--begin::Username-->
                                    <label for="">Username</label>
									<input type="text" placeholder="Username" name="login" id="nombre" required autocomplete="off" class="form-control bg-transparent" value="<?php echo set_value('login'); ?>"/>
									<!--end::Username-->
								</div>
								<!--end::Input group=-->

                                <!--begin::Input group=-->
								<div class="fv-row mb-3">
									<!--begin::Password-->
									<label for="">Password</label>
									<input type="password" placeholder="Password" name="senha" id="pass" required autocomplete="off" class="form-control bg-transparent" />
									<!--end::Password-->
								</div>
								<!--end::Input group=-->

								<!--begin::Wrapper-->
								<div class="d-flex flex-stack flex-wrap gap-3 fs-base fw-semibold mb-8">
									<div></div>
									<!--begin::Link-->
									<a href="<?php echo base_url('recover'); ?>" class="link-primary">Forgot Password ?</a>
									<!--end::Link-->
								</div>
								<!--end::Wrapper-->


                                <!--begin::Input group=-->
								<div class="fv-row mb-4">
                                    <div class="g-recaptcha" data-sitekey="<?php echo $this->config->item('google_key') ?>"></div>
								</div>
								<!--end::Input group=-->

								<!--begin::Submit button-->
								<div class="d-grid mb-10">
									<button type="submit" name="submit" value="submit" class="btn btn-primary">
										<!--begin::Indicator label-->
										<span class="indicator-label">Sign In</span>
										<!--begin::Indicator progress-->
										<span class="indicator-progress">Please wait... 
										<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
										<!--end::Indicator progress-->
									</button>
								</div>
								<!--end::Submit button-->
								
								
							</form>
							<!--end::Form-->
						</div>
						<!--end::Wrapper-->
					</div>
					<!--end::Form-->
					
					
				</div>
				<!--end::Body-->
			</div>
			<!--end::Authentication - Sign-in-->
		</div>
		<!--end::Root-->
		<!--begin::Javascript-->
		<script>var hostUrl = "<?php echo base_url(); ?>assets2/assets/";</script>
		<!--begin::Global Javascript Bundle(mandatory for all pages)-->
		<script src="<?php echo base_url(); ?>assets2/assets/plugins/global/plugins.bundle.js"></script>
		<script src="<?php echo base_url(); ?>assets2/assets/js/scripts.bundle.js"></script>
		<!--end::Global Javascript Bundle-->
		
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
        
		<!--end::Custom Javascript-->
		<!--end::Javascript-->


		<?php 
		if(isset($message) && !isset($_GET['cod'])) {
			echo $message;
		};
		?>

 


	</body>
	<!--end::Body-->
</html>