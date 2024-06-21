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

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <link rel="shortcut icon" type="image/png" href="/imgs/favicon.png" /> -->
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

    <!-- inject:css -->
   
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/simple-line-icons/css/simple-line-icons.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/weather-icons/css/weather-icons.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/themify-icons/css/themify-icons.css">
    <!-- endinject -->

    <!-- Main Style  -->


    <!--mega dropdown menu-->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/assets/js/mega-dropdown/css/reset.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/assets/js/mega-dropdown/css/style.css">

    <!--horizontal-timeline-->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/assets/js/horizontal-timeline/css/style.css">

    <!-- notify -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>vendor/needim/noty/lib/noty.css">

    <!-- sweet alert 2 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.11.5/sweetalert2.css">

    <!-- orgchart -->
    <link href="<?php echo base_url(); ?>assets/plugins/orgchart/jquery.orgchart.css" rel="stylesheet" type="text/css">

    <!-- tooltipster -->
    <link href="<?php echo base_url(); ?>assets/plugins/tooltipster/css/tooltipster.bundle.min.css" rel="stylesheet" type="text/css">

    <!-- data table -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.dataTables.min.css">
    <link href="<?php echo base_url(); ?>assets/bower_components/datatables-tabletools/css/dataTables.tableTools.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/bower_components/datatables-colvis/css/dataTables.colVis.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/bower_components/datatables-responsive/css/responsive.dataTables.scss" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/bower_components/datatables-scroller/css/scroller.dataTables.scss" rel="stylesheet">



    <!-- TEMPLATE START -->
    <link href="<?php echo base_url(); ?>assets/template/libs/rd-navbar/dist/css/rd-navbar.css" rel="stylesheet">
    
	
	
    <link href="https://cdn.jsdelivr.net/npm/@mdi/font@6.1.95/css/materialdesignicons.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/template/css/materialdesignicons.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/template/libs/swiper/swiper-bundle.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/template/libs/animate.css/animate.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/template/libs/aos/aos.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/template/css/estilos.css" rel="stylesheet">
    <!-- TEMPLATE END -->
	
	<!--edward-->
 	<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous">	

	<link href="<?php echo base_url(); ?>assets/template/css/custom.css" rel="stylesheet">





    <script src="<?php echo base_url(); ?>assets/assets/js/modernizr-custom.js"></script>
    <script src="<?php echo base_url(); ?>assets/assets/js/mega-dropdown/js/modernizr.js"></script>
    
    <div id="fb-root"></div>
    <script>
        (function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s);
            js.id = id;
            js.src = 'https://connect.facebook.net/pt_BR/sdk.js#xfbml=1&version=v2.11&appId=1864723207107336';
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    </script>
	
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

<body style="height: 100vh;">

    <header class="sliderss">

        <div class="rd-navbar-wrap">
            <nav class="rd-navbar">
                <div class="encabezado">

                </div> <!-- header -->
                <!-- * Tag navbar -->
                <div class="rd-navbar-outer">
                    <div class="rd-navbar-inner">
                        <div class="rd-navbar-panel-canvas"></div>
                        <div class="container">
                            <div class="row justify-content-between align-items-center">
                                <div class="col-1">
                                    <a href="<?php echo base_url('dashboard'); ?>">
                                        <img src="<?php echo base_url(); ?>uploads/<?php echo ConfiguracoesSistema('logo'); ?>" alt="Logo" class="img-fluid rd-navbar-brand" width="180">
                                    </a>
                                </div>
                                <div class="col-10">
                                    <div class="rd-navbar-menu-wrap">
                                        <div class="rd-navbar-nav-wrap">
                                            <ul class="rd-navbar-nav list-unstyled mb-0">

                                                <li><a href="<?php echo base_url('dashboard'); ?>"><?php echo lang('menu_item1')?></a></li>
                                                <li><a href="<?php echo base_url('plans'); ?>" class="<?php echo (isset($active) && $active == 'planos') ? 'bg-linear-active' : ''; ?>"><?php echo lang('menu_item2')?></a></li>



                                                <li><a href="#about"><?php echo lang('menu_item3')?></a>

                                                    <!-- RD Navbar Dropdown -->
                                                    <ul class="rd-navbar-dropdown twodrop list-unstyled">
                                                        <!--<li><a href="<?php //echo base_url('pending'); ?>"><?php //echo lang('menu_item4')?></a></li>-->
                                                        <!-- <li><a href="<?php //echo base_url('rede'); ?>">Binary Network</a></li> -->
                                                        <li><a href="<?php echo base_url('network'); ?>"><?php echo lang('menu_item5')?></a></li>
                                                        <!--<li><a href="<?php //echo base_url('pontos'); ?>">Points</a></li>
                                                        <li><a href="<?php //echo base_url('chave'); ?>">Chave Binária</a></li>-->
                                                        <li><a href="<?php echo base_url('career'); ?>"><?php echo lang('menu_item6')?></a></li>
														
														
                                                    </ul>
                                                    <!-- END RD Navbar Dropdown -->

                                                </li>
                                                <li>
                                                    <!-- submenu -->
                                                    <a href="#" class="<?php echo (isset($active) && $active == 'financeiro') ? 'bg-linear-active' : ''; ?>"><?php echo lang('menu_item7')?></a>
                                                    <ul class="rd-navbar-dropdown list-unstyled">
                                                    	<li><a href="<?php echo base_url('packages'); ?>">My Packages</a></li>
														<li><a href="<?php echo base_url('invoices'); ?>">Invoices</a></li>


                                         
                                                        <li><a href="<?php echo base_url('reports'); ?>">Reports</a></li>
														
														<li><a href="<?php echo base_url('withdraw'); ?>">Withdrawals</a></li>

														
                                                    </ul>
                                                </li>
                                                <li><a href="<?php echo base_url('ticket'); ?>"><?php echo lang('menu_item8')?></a></li>
												<!--<li><a href="#about"><i class="fa-solid fa-globe"></i></a>
                                                
                                                    <ul class="rd-navbar-dropdown list-unstyled">
                                                        <li><a href="<?php //echo base_url('CambiarIdioma/lenguaje')?>/english"><img src="<?php //echo base_url(); ?>assets/imgs/flags/united_kingdom.png"> English</a></li>

                                                        <li><a href="<?php //echo base_url('CambiarIdioma/lenguaje')?>/chinese"><img src="<?php //echo base_url(); ?>assets/imgs/flags/china_flags.png"> Chinese</a></li>
														
                                                        <li><a href="<?php //echo base_url('CambiarIdioma/lenguaje')?>/korean"><img src="<?php //echo base_url(); ?>assets/imgs/flags/korean_flags.png"> Korean</a></li>
														
                                                        <li><a href="<?php //echo base_url('CambiarIdioma/lenguaje')?>/spanish"><img src="<?php //echo base_url(); ?>assets/imgs/flags/spain_flags.png"> Spanish</a></li>
                                                        <li><a href="<?php //echo base_url('CambiarIdioma/lenguaje')?>/portuguese"><img src="<?php //echo base_url(); ?>assets/imgs/flags/brazil_flags.png"> Portuguese</a></li>
                                                    </ul>
                                                </li>-->
												
												
												<li><a href="#about"><i class="fa-solid fa-globe"></i></a>
                                                
                                                    <ul class="rd-navbar-dropdown list-unstyled translation-link">
                                                        <li><a href="#" onclick="doGTranslate('en|en');return false;" title="English" class=" nturl"><img src="<?php echo base_url(); ?>assets/imgs/flags/united_kingdom.png"> English</a></li>

                                                        <li><a href="#" onclick="doGTranslate('en|es');return false;" title="Spanish" class=" nturl"><img src="<?php echo base_url(); ?>assets/imgs/flags/spain_flags.png"> Spanish</a></li>
														
                                                        <li><a href="#" onclick="doGTranslate('en|pt');return false;" title="Portuguese" class=" nturl"><img src="<?php echo base_url(); ?>assets/imgs/flags/brazil_flags.png"> Portuguese</a></li>
														
														
                                                    </ul>
													
                                                </li>
												<div id="google_translate_element2"></div>
												
												 
												
												
                                                <li>
                                                    <!-- submenu -->
                                                    <a href="#">
                                                            <span class="mdi mdi-account">
                                                            <?php echo InformacoesUsuario('login') ?>
                                                        </span>
                                                    </a>
                                                    <ul class="rd-navbar-dropdown list-unstyled">
                                                        <li><a href="<?php echo base_url('settings'); ?>"><?php echo lang('menu_item9')?></a>
                                                        </li>
                                                        <li>
                                                            <a href="<?php echo base_url('logout'); ?>">
                                                                <?php echo lang('menu_item10')?>
                                                            </a>
                                                        </li>

                                                    </ul>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-3">


                                    <div class="rd-navbar-inner px-0">
                                        <div class="rd-navbar-panel py-0">
                                            <button class="rd-navbar-toggle toggle-original" data-rd-navbar-toggle=".rd-navbar-nav-wrap">
                                                <span></span>
                                            </button>






                                        </div> <!-- rd-navbar-inner -->
                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
        </div>

    </header>
    <!--header end-->

    <!--main content start-->
<div class="container">
<?php echo $contents; ?>
</div>
    <!--main content end-->

    <!--footer start-->
    <div id="footer" class="ui-footer">
        <!-- <?php echo date('Y'); ?> &copy; <?php echo ConfiguracoesSistema('nome_site'); ?> -->
    </div>
    <!--footer end-->

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
    <!-- inject:js -->
     <script src="<?php echo base_url(); ?>assets/bower_components/jquery/dist/jquery.min.js"></script> 
	
<script>
	
/*change table color*/
if( $('table.marketTable').length ){	
	setInterval(function() {

		/**/
		if ( $('#td1 span').hasClass("txtMarkGreen") ) { 	
			$('#td4 span').addClass("txtMarkGreen"); 

		}

		if( $('#td1 span').hasClass("txtMarkRed") ){
			$('#td4 span').addClass("txtMarkRed");
		}
		/**/
		
		/**/
		if ( $('#td6 span').hasClass("txtMarkGreen") ) { 	
			$('#td9 span').addClass("txtMarkGreen"); 

		}

		if( $('#td6 span').hasClass("txtMarkRed") ){
			$('#td9 span').addClass("txtMarkRed");
		}
		/**/
		
		/**/
		if ( $('#td11 span').hasClass("txtMarkGreen") ) { 	
			$('#td14 span').addClass("txtMarkGreen"); 

		}

		if( $('#td11 span').hasClass("txtMarkRed") ){
			$('#td14 span').addClass("txtMarkRed");
		}
		/**/
		
		/**/
		if ( $('#td16 span').hasClass("txtMarkGreen") ) { 	
			$('#td19 span').addClass("txtMarkGreen"); 

		}

		if( $('#td16 span').hasClass("txtMarkRed") ){
			$('#td19 span').addClass("txtMarkRed");
		}
		/**/
		
		/**/
		if ( $('#td21 span').hasClass("txtMarkGreen") ) { 	
			$('#td24 span').addClass("txtMarkGreen"); 

		}

		if( $('#td21 span').hasClass("txtMarkRed") ){
			$('#td24 span').addClass("txtMarkRed");
		}
		/**/


	}, 100);	
	
}	
	
	
	
	
/*change table color*/		
</script>	
	
	
    <script src="<?php echo base_url(); ?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/bower_components/jquery.nicescroll/dist/jquery.nicescroll.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/bower_components/autosize/dist/autosize.min.js"></script>
    <!-- endinject -->

    <!--horizontal-timeline-->
    <script src="<?php echo base_url(); ?>assets/assets/js/horizontal-timeline/js/jquery.mobile.custom.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/assets/js/horizontal-timeline/js/main.js"></script>

    <script src="<?php echo base_url(); ?>assets/assets/js/modernizr-custom.js"></script>

    <!-- Common Script   -->
    <script src="<?php echo base_url(); ?>assets/dist/js/main.js"></script>

    <!--Mega Dropdown Menu js-->
    <script src="<?php echo base_url(); ?>assets/assets/js/mega-dropdown/js/jquery.menu-aim.js"></script> <!-- menu aim -->
    <script src="<?php echo base_url(); ?>assets/assets/js/mega-dropdown/js/main.js"></script>

    <script src="<?php echo base_url(); ?>assets/pages/geral.js"></script>




    <!--TEMPLATE SCRIPT START-->
    <script src="<?php echo base_url(); ?>assets/template/libs/popper.js/popper.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/template/libs/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/template/libs/rd-navbar/dist/js/jquery.rd-navbar.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/template/libs/swiper/swiper-bundle.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/template/libs/aos/aos.js"></script>
    <script src="<?php echo base_url(); ?>assets/template/libs/purecounter/purecounter.js"></script>
    <script src="<?php echo base_url(); ?>assets/pages/cliente/jquery.easypiechart.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/pages/cliente/chartProfit.js"></script>
    <script src="https://kit.fontawesome.com/eac9696490.js" crossorigin="anonymous"></script>
	
	
	
    <script src="<?php echo base_url(); ?>assets/template/js/mis-scripts.js"></script>
	    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>
    <!--TEMPLATE SCRIPT END-->
	
	
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
			$('.tableUSers').dataTable( {
			  "lengthMenu": [ [5, 10, 25, 50, -1], [5, 10, 25, 50, "All"] ]
			} );
        });
    </script>




</body>

</html>