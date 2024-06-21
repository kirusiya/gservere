<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

?>



<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- <link rel="shortcut icon" type="image/png" href="/imgs/favicon.png" /> -->

        <title><?php echo ConfiguracoesSistema('nome_site');?> - Reset my password</title>
        
        <link rel="apple-touch-icon" sizes="57x57" href="<?php echo base_url();?>uploads/<?php ConfiguracoesSistema('favicon');?>">
        <link rel="apple-touch-icon" sizes="60x60" href="<?php echo base_url();?>uploads/<?php ConfiguracoesSistema('favicon');?>">
        <link rel="apple-touch-icon" sizes="72x72" href="<?php echo base_url();?>uploads/<?php ConfiguracoesSistema('favicon');?>">
        <link rel="apple-touch-icon" sizes="76x76" href="<?php echo base_url();?>uploads/<?php ConfiguracoesSistema('favicon');?>">
        <link rel="apple-touch-icon" sizes="114x114" href="<?php echo base_url();?>uploads/<?php ConfiguracoesSistema('favicon');?>">
        <link rel="apple-touch-icon" sizes="120x120" href="<?php echo base_url();?>uploads/<?php ConfiguracoesSistema('favicon');?>">
        <link rel="apple-touch-icon" sizes="144x144" href="<?php echo base_url();?>uploads/<?php ConfiguracoesSistema('favicon');?>">
        <link rel="apple-touch-icon" sizes="152x152" href="<?php echo base_url();?>uploads/<?php ConfiguracoesSistema('favicon');?>">
        <link rel="apple-touch-icon" sizes="180x180" href="<?php echo base_url();?>uploads/<?php ConfiguracoesSistema('favicon');?>">
        <link rel="icon" type="image/png" sizes="192x192"  href="<?php echo base_url();?>uploads/<?php ConfiguracoesSistema('favicon');?>">
        <link rel="icon" type="image/png" sizes="32x32" href="<?php echo base_url();?>uploads/<?php ConfiguracoesSistema('favicon');?>">
        <link rel="icon" type="image/png" sizes="96x96" href="<?php echo base_url();?>uploads/<?php ConfiguracoesSistema('favicon');?>">
        <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url();?>uploads/<?php ConfiguracoesSistema('favicon');?>">

        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;700&display=swap" rel="stylesheet" />
		<link href="https://fonts.googleapis.com/css2?family=Istok+Web&display=swap" rel="stylesheet" />

		<!--  * Instalando css de rd navbar -->
		<link rel="stylesheet" href="<?php echo base_url();?>assets/template/libs/rd-navbar/dist/css/rd-navbar.css" />

		<!-- * iconos fontawesome 5 -->
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@mdi/font@6.1.95/css/materialdesignicons.min.css">
		<link rel="stylesheet" href="<?php echo base_url();?>assets/template/css/materialdesignicons.min.css">
		<link rel="stylesheet" href="<?php echo base_url();?>assets/template/libs/aos/aos.css">

		<link rel="stylesheet" href="<?php echo base_url();?>assets/template/css/estilos.css" />
    </head>
    <body>
		
		<section id="login" class="min-vh-100 d-flex justify-content-center align-items-center">
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-10 col-lg-8 col-xl-6 p-3">
                    <div class="content py-4 px-4 position-relative">

                        <div class="detalle position-relative w-100">
                            <h1 class="h2 py-3 text-white fw-bold">Reset my password</h1>

                            <div class="row px-3">

                                <form role="form" action="" method="post" class="p-0 m-0 row" autocomplete="off">
                                     
                                    <?php if(isset($message['mensagem'])) echo $message['mensagem'];?>
									
									<?php
									if(
                                        !$this->input->post('email') && !$this->input->post('codigo') && 
                                        (!isset($codigo) || empty($codigo) ) ||  $message['status'] == 0
                                        
                                        ){
									?>
                                    <div class="col-12">
                                        <div class="mb-4 inputsito">
                                            <input type="text" class="form-control"  required
                                                autocomplete="off"
												name="email" value=""   
												   >
                                            <label for="correo" class="form-label">Login/Username</label>
                                        </div>
                                    </div>
                                    
                                    <div class="col-12">
                                        <div class="col-md-8 col-lg-6 mx-auto">
											<button class="btn btn-primario" type="submit" name="submit">
												Reset Password
											</button>
                                        </div>
                                    </div>
									
									<?php
									}elseif($this->input->post('email') && !$this->input->post('codigo') && $message['status'] == 1){
									?>
									
									<div class="col-12">
									
										<small>Didn't you receive the Code? <a href="<?php echo base_url('recover');?>">Enter a new code here</a></small>
									</div>
									
									<div class="col-12">
                                        <div class="mb-4 inputsito">
                                            <input type="text" class="form-control"  required
                                                autocomplete="off"
												name="codigo" value=""   
												   >
                                            <label for="correo" class="form-label">Code</label>
                                        </div>
                                    </div>
                                    
                                    <div class="col-12">
                                        <div class="col-md-8 col-lg-6 mx-auto">
											<button class="btn btn-primario" type="submit" name="submit">
												Reset Password
											</button>
                                        </div>
                                    </div>
									
									<?php
									}

									if(isset($codigo) && !empty($codigo) && $codigo !== false){
										echo $this->ContaModel->ResetarSenha($codigo);
									}
									?>
									
                                </form>
								
								<p class="pt-2 p-0 small">Do you already have an account?</p>
                                <div class="col-12">
                                    <div class="col-md-8 col-lg-6 mx-auto"><button class="btn btn-secundario mx-auto"><a
                                                href="<?php echo base_url('login');?>"
                                                class="text-decoration-none text-white">Login</a></button></div>
                               

                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
        
    </section>
		


        <script src="<?php echo base_url();?>assets/template/libs/jquery/jquery-3.4.1.min.js"></script>
		<script src="<?php echo base_url();?>assets/template/libs/popper.js/popper.min.js"></script>

		<script src="<?php echo base_url();?>assets/template/libs/bootstrap/dist/js/bootstrap.min.js"></script>
		<script src="<?php echo base_url();?>assets/template/libs/rd-navbar/dist/js/jquery.rd-navbar.min.js"></script>

		<!--<script src="<?php //echo base_url();?>libs/swiper/swiper-bundle.min.js"></script>-->

		<script src="<?php echo base_url();?>assets/template/libs/aos/aos.js"></script>

		<script src="<?php echo base_url();?>assets/template/js/mis-scripts.js"></script>

    </body>
</html>
