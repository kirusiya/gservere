<?php
date_default_timezone_set('America/La_Paz');

//echo "<br>hora ".date('w');
//echo "<br>hora ".date('Y-m-d H:i:s');
//echo "<br>";



			/*logica Corte + algoritmo insert/update*/
			$ladoCortar = 0;
			$verCortePatro =  verCorteUser(InformacoesUsuario('id'));
						
			if($verCortePatro){
				/*echo "<br> ID corte ".$idCortePatro = $verCortePatro[0]->id;
				echo "<br> ID usuario corte ".$idCortePatroUsuario = $verCortePatro[0]->id_usuario;
													
				echo "<br> corteIzquierda ".$corteIzquierda = $verCortePatro[0]->corteIzquierda;
				echo "<br> corteDerecha ".$corteDerecha = $verCortePatro[0]->corteDerecha;
				
				echo "<br> fecha corte ".$fechaCorte = $verCortePatro[0]->fecha;*/
				
				$idCortePatro = $verCortePatro[0]->id;
				$idCortePatroUsuario = $verCortePatro[0]->id_usuario;
													
				$corteIzquierda = $verCortePatro[0]->corteIzquierda;
				$corteDerecha = $verCortePatro[0]->corteDerecha;
				
				$fechaCorte = $verCortePatro[0]->fecha;
				
				
				/*puntos para cortar*/
				
				if($corteIzquierda>0){
					$ladoCortar = 2;
					$puntoCortarMax = $corteIzquierda;
				}
				
				if($corteDerecha>0){
					$ladoCortar = 1;
					$puntoCortarMax = $corteDerecha;
				}
				
				/*echo "<hr>";
				echo "<br>lador Cortar".$ladoCortar;*/
				
				$puntosAll =  puntosParaCortar(InformacoesUsuario('id'), $ladoCortar, $fechaCorte);
				
				//print_r($puntosAll);
				$puntoCorte = 0;
				$puntoCorteAll = 0;
				if($puntosAll){
					
					foreach ($puntosAll as $puntosc){
						
						//echo "<br><br> sum puntos ".$puntoCorte += $puntosc->pontos;
						$puntoCorte += $puntosc->pontos;
						
						if($puntoCortarMax <= $puntoCorte){
							
							/*echo "<br>putnos ".$puntosc->pontos;
							echo "<br>restar: ".$setPuntos = $puntosc->pontos - $puntoCortarMax;*/
							
							$puntosc->pontos;
							$setPuntos = $puntosc->pontos - $puntoCortarMax;
							
							if($setPuntos == $puntoCortarMax){
								/*echo "<br>1) puntos ". $puntosc->pontos. " ID puntos ".$puntosc->id;
								echo "<br>1) Setear ".$setear = $puntosc->pontos- $puntoCortarMax ; */
								
								$puntosc->pontos. " ID puntos ".$puntosc->id;
								$setear = $puntosc->pontos - $puntoCortarMax ; 
								
								/*set new points*/
								$setPutosArray = array(                           
														'pontos'=>$setear,								
														);

								$this->db->where('id', $puntosc->id);
    							$this->db->update('rede_pontos_binario', $setPutosArray);
								/*set new points*/
								
								
								break;
							}elseif($setPuntos<0){
								$setearMenor = $puntoCorte - $puntoCortarMax ;
								/*echo "<br>2) puntos ". $puntosc->pontos. " ID puntos ".$puntosc->id;
								echo "<br>2) sumar al resultado putnos ".$setearMenor;								
								echo "<br>2) Cuadrado puntos ". $resultMenor = $puntoCorte - $setearMenor;
								echo "<br>2) Setear por menor: ".$setearMenor = $puntosc->pontos - $setearMenor;*/
								
								$puntosc->pontos. " ID puntos ".$puntosc->id;
								$setearMenor;								
								$resultMenor = $puntoCorte - $setearMenor;
								$setearMenor = $puntosc->pontos - $setearMenor;
								
								/*set new points*/
								$setPutosArrayMenor = array(                           
													'pontos'=>$setearMenor,								
													);

								$this->db->where('id', $puntosc->id);
    							$this->db->update('rede_pontos_binario', $setPutosArrayMenor);
								/*set new points*/
								
								break;
								
							}else{
								
								$setearMayor = $puntosc->pontos - $puntoCortarMax;
								
								/*echo "<br>3) puntos ". $puntosc->pontos. " ID puntos ".$puntosc->id;
								echo "<br>3) setear a ".$setearMayor;*/
								
								$puntosc->pontos. " ID puntos ".$puntosc->id;
								$setearMayor;
								
								/*set new points*/
								$setPutosArrayMayor = array(                           
														'pontos'=>$setearMayor,	
													);

								$this->db->where('id', $puntosc->id);
    							$this->db->update('rede_pontos_binario', $setPutosArrayMayor);
								/*set new points*/
								
								break;
								
								
							}
								
						}else{
							
							///echo "<br>0) puntos ". $puntosc->pontos. " ID puntos ".$puntosc->id;
							
							/*set new points*/
							$setPutosArray0 = array(                           
										'pontos'=>0,								
										);

							$this->db->where('id', $puntosc->id);
    						$this->db->update('rede_pontos_binario', $setPutosArray0);
							/*set new points*/
							
							
							//echo "<br>0) setear a 0";
							
						}
						
					}
				}

				/*puntos para cortar*/
				
				
				/*controlamos para que no corte cada vez*/
				
				$setPutosArray0 = array(                           
										'estado'=>1,								
										);

				$this->db->where('id', $idCortePatro);
    			$this->db->update('cortes', $setPutosArray0);
				
				/*controlamos para que no corte cada vez*/
				
				
				/*actualizamos los datos*/
				
				echo "<script>alert('Updating Data...');window.location.reload()</script>";
				
				/*actualizamos los datos*/
				
				
				
			}
			/*logica Corte + algoritmo insert/update*/

?>

<!DOCTYPE html>
<html>
	<!--begin::Head-->
	<head>

		<meta charset="utf-8" />
		<title><?php echo ConfiguracoesSistema('nome_site'); ?></title>
	
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
		<!--begin::Vendor Stylesheets(used for this page only)-->
		<link href="<?php echo base_url(); ?>assets2/assets/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
		<link href="<?php echo base_url(); ?>assets2/assets/plugins/custom/vis-timeline/vis-timeline.bundle.css" rel="stylesheet" type="text/css" />
		<!--end::Vendor Stylesheets-->
		<!--begin::Global Stylesheets Bundle(mandatory for all pages)-->
		<link href="<?php echo base_url(); ?>assets2/assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
		<link href="<?php echo base_url(); ?>assets2/assets/css/style.bundle.css" rel="stylesheet" type="text/css" />

        <!--edward-->
 	    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous">	

         <link href="<?php echo base_url(); ?>assets2/assets/css/custom.css"  rel="stylesheet" type="text/css" />

		<!--end::Global Stylesheets Bundle-->
		<script>// Frame-busting to prevent site from being loaded within a frame without permission (click-jacking) if (window.top != window.self) { window.top.location.replace(window.self.location.href); }</script>

		<script type="text/javascript">
function googleTranslateElementInit2() {new google.translate.TranslateElement({pageLanguage: 'en',autoDisplay: false}, 'google_translate_element2');}
</script><script type="text/javascript" src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit2"></script>
	
	
<script>
var flags = document.getElementsByClassName('flag_link');


Array.prototype.forEach.call(flags, function(e){
  e.addEventListener('click', function(){
    var lang = e.getAttribute('data-lang'); 
    var languageSelect = document.querySelector("select#googleTrans");
    languageSelect.value = lang; 
    languageSelect.dispatchEvent(new Event("change"));
  }); 
});	
</script>	
	
	
	
	
	
<script type="text/javascript">
/* <![CDATA[ */
eval(function(p,a,c,k,e,r){e=function(c){return(c<a?'':e(parseInt(c/a)))+((c=c%a)>35?String.fromCharCode(c+29):c.toString(36))};if(!''.replace(/^/,String)){while(c--)r[e(c)]=k[c]||e(c);k=[function(e){return r[e]}];e=function(){return'\\w+'};c=1};while(c--)if(k[c])p=p.replace(new RegExp('\\b'+e(c)+'\\b','g'),k[c]);return p}('6 7(a,b){n{4(2.9){3 c=2.9("o");c.p(b,f,f);a.q(c)}g{3 c=2.r();a.s(\'t\'+b,c)}}u(e){}}6 h(a){4(a.8)a=a.8;4(a==\'\')v;3 b=a.w(\'|\')[1];3 c;3 d=2.x(\'y\');z(3 i=0;i<d.5;i++)4(d[i].A==\'B-C-D\')c=d[i];4(2.j(\'k\')==E||2.j(\'k\').l.5==0||c.5==0||c.l.5==0){F(6(){h(a)},G)}g{c.8=b;7(c,\'m\');7(c,\'m\')}}',43,43,'||document|var|if|length|function|GTranslateFireEvent|value|createEvent||||||true|else|doGTranslate||getElementById|google_translate_element2|innerHTML|change|try|HTMLEvents|initEvent|dispatchEvent|createEventObject|fireEvent|on|catch|return|split|getElementsByTagName|select|for|className|goog|te|combo|null|setTimeout|500'.split('|'),0,{}))
/* ]]> */
</script>
	
	
<style type="text/css">
 
a.gflag {vertical-align:middle;font-size:24px;padding:1px 0;background-repeat:no-repeat;background-image:url(//gtranslate.net/flags/24.png);}
a.gflag img {border:0;}
a.gflag:hover {background-image:url(//gtranslate.net/flags/24a.png);}
#goog-gt-tt {display:none !important;}
.goog-te-banner-frame {display:none !important;}
.goog-te-menu-value:hover {text-decoration:none !important;}
body {top:0 !important;}
#google_translate_element2 {display:none!important;}
 
</style>



	</head>
	<!--end::Head-->
	<!--begin::Body-->
	<body id="kt_body" data-kt-app-header-stacked="true" data-kt-app-header-primary-enabled="true" data-kt-app-header-secondary-enabled="true" data-kt-app-toolbar-enabled="true" class="app-default">
		<!--begin::Theme mode setup on page load-->
		<script>var defaultThemeMode = "light"; var themeMode; if ( document.documentElement ) { if ( document.documentElement.hasAttribute("data-bs-theme-mode")) { themeMode = document.documentElement.getAttribute("data-bs-theme-mode"); } else { if ( localStorage.getItem("data-bs-theme") !== null ) { themeMode = localStorage.getItem("data-bs-theme"); } else { themeMode = defaultThemeMode; } } if (themeMode === "system") { themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light"; } document.documentElement.setAttribute("data-bs-theme", themeMode); }</script>
		<!--end::Theme mode setup on page load-->
		<!--begin::App-->
		<div class="d-flex flex-column flex-root app-root" id="kt_app_root">
			<!--begin::Page-->
			<div class="app-page flex-column flex-column-fluid" id="kt_app_page">
				<!--begin::Header-->
				<div id="kt_app_header" class="app-header">
					<!--begin::Header primary-->
					<div class="app-header-primary" data-kt-sticky="true" data-kt-sticky-name="app-header-primary-sticky" data-kt-sticky-offset="{default: 'false', lg: '300px'}">
						<!--begin::Header primary container-->
						<div class="app-container container-xxl d-flex align-items-stretch justify-content-between" id="kt_app_header_primary_container">
							<!--begin::Logo and search-->
							<div class="d-flex flex-grow-1 flex-lg-grow-0">
								<!--begin::Logo wrapper-->
								<div class="d-flex align-items-center me-7" id="kt_app_header_logo_wrapper">
									<!--begin::Header toggle-->
									<button class="d-lg-none btn btn-icon btn-color-white btn-active-color-primary w-35px h-35px ms-n2 me-2" id="kt_app_header_menu_toggle">
										<i class="ki-duotone ki-abstract-14 fs-2">
											<span class="path1"></span>
											<span class="path2"></span>
										</i>
									</button>
									<!--end::Header toggle-->
									<!--begin::Logo-->
									<a href="<?php echo base_url('dashboard'); ?>" class="d-flex align-items-center">
										<img alt="Logo" src="<?php echo base_url(); ?>uploads/<?php echo ConfiguracoesSistema('logo'); ?>" class="h-25px" />
									</a>
									<!--end::Logo-->
								</div>
								<!--end::Logo wrapper-->
								<!--begin::Menu wrapper-->
								<div class="app-header-menu app-header-mobile-drawer align-items-stretch" data-kt-drawer="true" data-kt-drawer-name="app-header-menu" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="250px" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_app_header_menu_toggle" data-kt-swapper="true" data-kt-swapper-mode="{default: 'append', lg: 'prepend'}" data-kt-swapper-parent="{default: '#kt_app_body', lg: '#kt_app_header_wrapper'}">
									<!--begin::Menu-->
									<div class="menu menu-rounded menu-state-primary menu-column menu-lg-row menu-title-gray-700 menu-icon-gray-500 menu-arrow-gray-500 menu-bullet-gray-500 my-5 my-lg-0 align-items-stretch fw-semibold px-2 px-lg-0" id="kt_app_header_menu" data-kt-menu="true">

										<!--begin:Menu item-->
										<a  href="<?php echo base_url('dashboard'); ?>" 
										class="menu-item  menu-here-bg menu-lg-down-accordion me-0 me-lg-2
										<?php echo (isset($active) && $active == 'dashboard') ? 'here show' : '';?>
										">
											<!--begin:Menu link-->
											<span class="menu-link py-3">
												<span class="menu-title"><?php echo lang('menu_item1')?></span>
												<span class="menu-arrow d-lg-none"></span>
											</span>
											<!--end:Menu link-->
											
										</a>
										<!--end:Menu item-->

                                        <!--begin:Menu item-->
										<a  href="<?php echo base_url('plans'); ?>" 
											class="menu-item  menu-here-bg menu-lg-down-accordion me-0 me-lg-2
											<?php echo (isset($active) && $active == 'planos') ? 'here show' : '';?>	
											">
											<!--begin:Menu link-->
											<span class="menu-link py-3">
												<span class="menu-title"><?php echo lang('menu_item2')?></span>
												<span class="menu-arrow d-lg-none"></span>
											</span>
											<!--end:Menu link-->
											
										</a>
										<!--end:Menu item-->
										
										<!--begin:Menu item-->
										<div data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-placement="bottom-start" class="menu-item menu-lg-down-accordion menu-sub-lg-down-indention me-0 me-lg-2
										<?php echo (isset($active) && $active == 'rede') ? 'here show' : '';?>

										">
											<!--begin:Menu link-->
											<span class="menu-link py-3">
												<span class="menu-title"><?php echo lang('menu_item3')?></span>
												<span class="menu-arrow d-lg-none"></span>
											</span>
											<!--end:Menu link-->
											<!--begin:Menu sub-->
											<div class="menu-sub menu-sub-lg-down-accordion menu-sub-lg-dropdown px-lg-2 py-lg-4 w-lg-250px">
												<!--begin:Menu item-->
												<a href="<?php echo base_url('network'); ?>" class="menu-item menu-lg-down-accordion">
													<!--begin:Menu link-->
													<span class="menu-link py-3">
														<!--<span class="menu-icon">
															<i class="ki-duotone ki-rocket fs-2">
																<span class="path1"></span>
																<span class="path2"></span>
															</i>
														</span>-->
														<span class="menu-title"><?php echo lang('menu_item5')?></span>
													</span>
													<!--end:Menu link-->
												</a>
												<!--end:Menu item-->

												<!--begin:Menu item-->
												<a href="<?php echo base_url('career'); ?>" class="menu-item menu-lg-down-accordion">
													<!--begin:Menu link-->
													<span class="menu-link py-3">
														
														<span class="menu-title"><?php echo lang('menu_item6')?></span>
													</span>
													<!--end:Menu link-->
												</a>
												<!--end:Menu item-->

											</div>
											<!--end:Menu sub-->
										</div>
										<!--end:Menu item-->


										<!--begin:Menu item-->
										<div data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-placement="bottom-start" class="menu-item menu-lg-down-accordion menu-sub-lg-down-indention me-0 me-lg-2
										<?php echo (isset($active) && $active == 'financeiro') ? 'here show' : '';?>

										">
											<!--begin:Menu link-->
											<span class="menu-link py-3">
												<span class="menu-title"><?php echo lang('menu_item7')?></span>
												<span class="menu-arrow d-lg-none"></span>
											</span>
											<!--end:Menu link-->
											<!--begin:Menu sub-->
											<div class="menu-sub menu-sub-lg-down-accordion menu-sub-lg-dropdown px-lg-2 py-lg-4 w-lg-250px">
												<!--begin:Menu item-->
												<a href="<?php echo base_url('packages'); ?>" class="menu-item menu-lg-down-accordion">
													<!--begin:Menu link-->
													<span class="menu-link py-3">
														<span class="menu-title">My Packages</span>
													</span>
													<!--end:Menu link-->
												</a>
												<!--end:Menu item-->

												<!--begin:Menu item-->
												<a href="<?php echo base_url('invoices'); ?>" class="menu-item menu-lg-down-accordion">
													<!--begin:Menu link-->
													<span class="menu-link py-3">
														<span class="menu-title">Invoices</span>
													</span>
													<!--end:Menu link-->
												</a>
												<!--end:Menu item-->

												<!--begin:Menu item-->
												<a href="<?php echo base_url('reports'); ?>" class="menu-item menu-lg-down-accordion">
													<!--begin:Menu link-->
													<span class="menu-link py-3">
														<span class="menu-title">Reports</span>
													</span>
													<!--end:Menu link-->
												</a>
												<!--end:Menu item-->

												<!--begin:Menu item-->
												<a href="<?php echo base_url('withdraw'); ?>" class="menu-item menu-lg-down-accordion">
													<!--begin:Menu link-->
													<span class="menu-link py-3">
														<span class="menu-title">Withdrawals</span>
													</span>
													<!--end:Menu link-->
												</a>
												<!--end:Menu item-->

											</div>
											<!--end:Menu sub-->
										</div>
										<!--end:Menu item-->

										<!--begin:Menu item-->
										<a  href="<?php echo base_url('ticket'); ?>" 
											class="menu-item  menu-here-bg menu-lg-down-accordion me-0 me-lg-2
											<?php echo (isset($active) && $active == 'suporte') ? 'here show' : '';?>	
											">
											<!--begin:Menu link-->
											<span class="menu-link py-3">
												<span class="menu-title"><?php echo lang('menu_item8')?></span>
												<span class="menu-arrow d-lg-none"></span>
											</span>
											<!--end:Menu link-->
											
										</a>
										<!--end:Menu item-->

										
									</div>
									<!--end::Menu-->
								</div>
								<!--end::Menu wrapper-->
							</div>
							<!--end::Logo and search-->
							<!--begin::Navbar-->
							<div class="app-navbar flex-shrink-0">
								<!--begin::User menu-->
								<div class="app-navbar-item ms-3" id="kt_header_user_menu_toggle">
									<!--begin:Info-->
									<div class="text-end d-none d-sm-flex flex-column justify-content-center me-3">
										<a href="<?php echo base_url('settings'); ?>" class="text-white text-hover-primary fs-6 fw-bold">
										<?php echo InformacoesUsuario('login') ?>
										</a>
									</div>
									<!--end:Info-->
									<!--begin::Menu wrapper-->
									<div class="cursor-pointer symbol symbol-35px symbol-md-40px" data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">
										<img src="<?php echo base_url(); ?>assets2/assets/media/avatars/300-9.jpg" alt="user" />
									</div>
									<!--begin::User account menu-->
									<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-color fw-semibold py-4 fs-6 w-275px" data-kt-menu="true">
										
										<!--end::Menu item-->
										<!--begin::Menu separator-->
										<div class="separator my-2"></div>
										<!--end::Menu separator-->
										<!--begin::Menu item-->
										<div class="menu-item px-5">
											<a href="<?php echo base_url('settings'); ?>" class="menu-link px-5">My Profile</a>
										</div>
										<!--end::Menu item-->
										
										<!--begin::Menu separator-->
										<div class="separator my-2"></div>
										<!--end::Menu separator-->
										<!--begin::Menu item-->
										<div class="menu-item px-5" data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-placement="left-start" data-kt-menu-offset="-15px, 0">
											<a href="#" class="menu-link px-5">
												<span class="menu-title position-relative">Language</span>
											</a>
											<!--begin::Menu sub-->
											<div class="menu-sub menu-sub-dropdown w-175px py-4">
												<!--begin::Menu item-->
												<div class="menu-item px-3">
													<a href="#" onclick="doGTranslate('en|en');return false;" title="English" class="menu-link d-flex px-5 active">
													<span class="symbol symbol-20px me-4">
														<img class="rounded-1" src="<?php echo base_url(); ?>assets2/assets/media/flags/united-states.svg" alt="" />
													</span>English</a>
												</div>
												<!--end::Menu item-->
												<!--begin::Menu item-->
												<div class="menu-item px-3">
													<a href="#" onclick="doGTranslate('en|es');return false;" title="Spanish" class="menu-link d-flex px-5">
													<span class="symbol symbol-20px me-4">
														<img class="rounded-1" src="<?php echo base_url(); ?>assets2/assets/media/flags/spain.svg" alt="" />
													</span>Spanish</a>
												</div>
												<!--end::Menu item-->
												<!--begin::Menu item-->
												<div class="menu-item px-3">
													<a href="#" onclick="doGTranslate('en|pt');return false;" class="menu-link d-flex px-5">
													<span class="symbol symbol-20px me-4">
														<img class="rounded-1" src="<?php echo base_url(); ?>assets/imgs/flags/brazil_flags.png" alt="" />
													</span>French</a>
												</div>
												<!--end::Menu item-->
												<div id="google_translate_element2"></div>
											</div>
											<!--end::Menu sub-->
										</div>
										<!--end::Menu item-->
										<!--begin::Menu item-->
										<div class="menu-item px-5 my-1">
											<a href="<?php echo base_url('settings'); ?>" class="menu-link px-5">Account Settings</a>
										</div>
										<!--end::Menu item-->
										<!--begin::Menu item-->
										<div class="menu-item px-5">
											<a href="<?php echo base_url('logout'); ?>" class="menu-link px-5">Sign Out</a>
										</div>
										<!--end::Menu item-->
									</div>
									<!--end::User account menu-->
									<!--end::Menu wrapper-->
								</div>
								<!--end::User menu-->
								
								
								<!--begin::Link-->
								<div class="app-navbar-item ms-3">
									<!--begin::Menu- wrapper-->
									<a href="<?php echo base_url('logout'); ?>" class="btn btn-icon btn-icon-white btn-active-color-primary btn-custom w-35px h-35px w-md-40px h-md-40px">
										<i class="ki-duotone ki-entrance-left fs-2">
											<span class="path1"></span>
											<span class="path2"></span>
										</i>
									</a>
									<!--end::Menu wrapper-->
								</div>
								<!--end::Link-->
								<!--begin::Header menu toggle-->
								<!--end::Header menu toggle-->
							</div>
							<!--end::Navbar-->
						</div>
						<!--end::Header primary container-->
					</div>
					<!--end::Header primary-->
					
					
				</div>
				<!--end::Header-->
				<!--begin::Wrapper-->
				<div class="app-wrapper flex-column flex-row-fluid" id="kt_app_wrapper">
					<!--begin::Wrapper container-->
					<div class="app-container container-xxl d-flex flex-row flex-column-fluid">
						<!--begin::Main-->
						<div class="app-main flex-column flex-row-fluid" id="kt_app_main">
							<!--begin::Content wrapper-->
							<div class="d-flex flex-column flex-column-fluid">

								<!--contenido::CONTENIDO-->

                                <?php echo $contents; ?>

								<!--contenido::CONTENIDO-->

							</div>
							<!--end::Content wrapper-->
							<!--begin::Footer-->
							<div id="kt_app_footer" class="app-footer align-items-center justify-content-center justify-content-md-between flex-column flex-md-row py-3 py-lg-6">
								<!--begin::Copyright-->
								<div class="text-gray-900 order-2 order-md-1">
									<span class="text-muted fw-semibold me-1">2024&copy;</span>
									<a href="https://gservere.com/" target="_blank" class="text-gray-800 text-hover-primary">gservere.com</a>
								</div>
								<!--end::Copyright-->
								<!--begin::Menu-->

								<!--<ul class="menu menu-gray-600 menu-hover-primary fw-semibold order-1">
									<li class="menu-item">
										<a href="https://keenthemes.com" target="_blank" class="menu-link px-2">About</a>
									</li>
									<li class="menu-item">
										<a href="https://devs.keenthemes.com" target="_blank" class="menu-link px-2">Support</a>
									</li>
									<li class="menu-item">
										<a href="https://themes.getbootstrap.com/product/keen-the-ultimate-bootstrap-admin-theme/" target="_blank" class="menu-link px-2">Purchase</a>
									</li>
								</ul>-->
								<!--end::Menu-->
							</div>
							<!--end::Footer-->
						</div>
						<!--end:::Main-->
					</div>
					<!--end::Wrapper container-->
				</div>
				<!--end::Wrapper-->
			</div>
			<!--end::Page-->
		</div>
		<!--end::App-->


		<!-- helpers::HELPERS -->

		<!--begin::Scrolltop-->
		<div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">
			<i class="ki-duotone ki-arrow-up">
				<span class="path1"></span>
				<span class="path2"></span>
			</i>
		</div>
		<!--end::Scrolltop-->
		

		<!-- helpers::HELPERS -->

<script>
	var baseURL = '<?php echo base_url(); ?>';

	<?php
	if (isset($active) && $active == 'dashboard') {

		if ($this->DashboardModel->PlanoAtivo() !== false) {

	?>
			var data_inicio = '<?php echo $this->DashboardModel->PlanoAtivo(); ?>';
	<?php
		}
	}
	?>
</script>

		<!--begin::Javascript-->
		
		<!--begin::Global Javascript Bundle(mandatory for all pages)-->
		<script src="<?php echo base_url(); ?>assets2/assets/plugins/global/plugins.bundle.js"></script>
		<script src="<?php echo base_url(); ?>assets2/assets/js/scripts.bundle.js"></script>
		<!--end::Global Javascript Bundle-->

		<!--begin::Vendors Javascript(used for this page only)-->
		<script src="<?php echo base_url(); ?>assets2/assets/plugins/custom/datatables/datatables.bundle.js"></script>
		<script src="<?php echo base_url(); ?>assets2/assets/plugins/custom/vis-timeline/vis-timeline.bundle.js"></script>
		<script src="https://cdn.amcharts.com/lib/5/index.js"></script>
		<script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
		<script src="https://cdn.amcharts.com/lib/5/percent.js"></script>
		<script src="https://cdn.amcharts.com/lib/5/radar.js"></script>
		<script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>
		<!--end::Vendors Javascript-->
		

<!--== chart home progress ==-->

<script>
"use strict";

/*chart home*/
var KTSlidersWidget1 = function() {
    var chart1 = {
        self: null,
        rendered: false
    };

    // Private methods
    var initChart = function(chart, query, data) {
        var element = document.querySelector(query);

        if ( !element) {
            return;
        }              
        
        if ( chart.rendered === true && element.classList.contains("initialized") ) {
            return;
        }

        var height = parseInt(KTUtil.css(element, 'height'));
        var baseColor = KTUtil.getCssVariableValue('--bs-' + 'primary');
        var lightColor = KTUtil.getCssVariableValue('--bs-' + 'primary-light' );         

        var options = {
            series: [data],
            chart: {
                fontFamily: 'inherit',
                height: height,
                type: 'radialBar',
                sparkline: {
                    enabled: true,
                }
            },
            plotOptions: {
                radialBar: {
                    hollow: {
                        margin: 0,
                        size: "45%"
                    },
                    dataLabels: {
                        showOn: "always",
                        name: {
                            show: false                                 
                        },
                        value: {                                 
                            show: false                              
                        }
                    },
                    track: {
                        background: lightColor,
                        strokeWidth: '100%'
                    }
                }
            },
            colors: [baseColor],
            stroke: {
                lineCap: "round",
            },
            labels: ["Progress"]
        };

        chart.self = new ApexCharts(element, options);
        chart.self.render();
        chart.rendered = true;

        element.classList.add('initialized');
    }

    // Public methods
    return {
        init: function () {
            // Init default chart

			let progress = parseInt($('#progressHome').data('progress'))

            initChart(chart1, '#progressHome', progress);
            // Update chart on theme mode change
            KTThemeMode.on("kt.thememode.change", function() {                
                if (chart1.rendered) {
                    chart1.self.destroy();
                    chart1.rendered = false;
                }

                initChart(chart1, '#progressHome', progress);
            });
        }   
    }        
}();


// Webpack support
if (typeof module !== 'undefined') {
    module.exports = KTSlidersWidget1;
}
/*chart home*/


/*datables all*/
var KTAppEcommerceCategories = function () {
    // Shared variables
    var table;
    var datatable;

    // Private functions
    var initDatatable = function () {
        // Init datatable --- more info on datatables: https://datatables.net/manual/
        datatable = $(table).DataTable({
            "info": false,
            'order': [],
            'pageLength': 5,
            // 'columnDefs': [
            //     { orderable: false, targets: 0 }, // Disable ordering on column 0 (checkbox)
            //     { orderable: false, targets: 3 }, // Disable ordering on column 3 (actions)
            // ],
			"lengthMenu": [ [5, 10, 25, 50, -1], [5, 10, 25, 50, "All"] ]
        });

        // Re-init functions on datatable re-draws
        datatable.on('draw', function () {
            handleDeleteRows();
        });
    }

    // Search Datatable --- official docs reference: https://datatables.net/reference/api/search()
    var handleSearchDatatable = () => {
        const filterSearch = document.querySelector('[data-kt-ecommerce-category-filter="search"]');
        filterSearch.addEventListener('keyup', function (e) {
            datatable.search(e.target.value).draw();
        });
    }


    // Public methods
    return {
        init: function () {
            table = document.querySelector('.dataTablesHome');

            if (!table) {
                return;
            }
            initDatatable();
            handleSearchDatatable();
        }
    };
}();


/*datables all*/

// On document ready
KTUtil.onDOMContentLoaded(function() {
    KTSlidersWidget1.init();
	KTAppEcommerceCategories.init();
});
           
</script>

<!--== chart home progress ==-->

<!--== edward ==-->	
<script>
 

/*copy function*/
	
function kopiraj() {

  var copyText = document.getElementById("valueQR");

  copyText.select();

  document.execCommand("Copy");

    

  $('.alert.qrSuccess').show();

    

  setTimeout(function() { 

  
    $('.alert.qrSuccess').fadeOut(1000);  

  }, 1000);     

    

    

} 	
/*copy function*/	
	
	
/*hide notification*/
	
$("#closeNoti").on('click', function () {
    $("#notiSystem").hide(); 
});	
	
/*hide notification*/	
	
	
/*withdrawals*/
if( $('select.timeSaque').length ){
	
	$('select.timeSaque').on('change', function() {
		
		let timeText = $( "select.timeSaque option:selected" ).text();
		$( "#timeText" ).val(timeText);
		console.log(timeText)
	});
	
}
	
/*withdrawals*/	
	
</script>
<!--== edward ==-->	

    <?php
    if (isset($jsLoader)) {

        foreach ($jsLoader as $type => $script) {

            $link = ($type === 'external') ? $script : base_urL($script);

            echo '<script src="' . $link . '"></script>';
        }
    }
    ?>
	

    <script>
        $.extend($.fn.dataTable.defaults, {
            responsive: true
        });

        $(document).ready(function() {
            $('#tblDateEx').DataTable();
			
        });
    </script>


		<!--end::Custom Javascript-->
		<!--end::Javascript-->
	</body>
	<!--end::Body-->

</html>