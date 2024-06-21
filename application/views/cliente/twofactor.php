<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <link rel="shortcut icon" type="image/png" href="/imgs/favicon.png" /> -->
    <title><?php echo ConfiguracoesSistema('nome_site'); ?> - Two Factor Authentication</title>

    <link rel="apple-touch-icon" sizes="57x57" href="<?php echo base_url(); ?>uploads/<?php ConfiguracoesSistema('favicon'); ?>">
    <link rel="apple-touch-icon" sizes="60x60" href="<?php echo base_url(); ?>uploads/<?php ConfiguracoesSistema('favicon'); ?>">
    <link rel="apple-touch-icon" sizes="72x72" href="<?php echo base_url(); ?>uploads/<?php ConfiguracoesSistema('favicon'); ?>">
    <link rel="apple-touch-icon" sizes="76x76" href="<?php echo base_url(); ?>uploads/<?php ConfiguracoesSistema('favicon'); ?>">
    <link rel="apple-touch-icon" sizes="114x114" href="<?php echo base_url(); ?>uploads/<?php ConfiguracoesSistema('favicon'); ?>">
    <link rel="apple-touch-icon" sizes="120x120" href="<?php echo base_url(); ?>uploads/<?php ConfiguracoesSistema('favicon'); ?>">
    <link rel="apple-touch-icon" sizes="144x144" href="<?php echo base_url(); ?>uploads/<?php ConfiguracoesSistema('favicon'); ?>">
    <link rel="apple-touch-icon" sizes="152x152" href="<?php echo base_url(); ?>uploads/<?php ConfiguracoesSistema('favicon'); ?>">
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo base_url(); ?>uploads/<?php ConfiguracoesSistema('favicon'); ?>">
    <link rel="icon" type="image/png" sizes="192x192" href="<?php echo base_url(); ?>uploads/<?php ConfiguracoesSistema('favicon'); ?>">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo base_url(); ?>uploads/<?php ConfiguracoesSistema('favicon'); ?>">
    <link rel="icon" type="image/png" sizes="96x96" href="<?php echo base_url(); ?>uploads/<?php ConfiguracoesSistema('favicon'); ?>">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url(); ?>uploads/<?php ConfiguracoesSistema('favicon'); ?>">


    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;700&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Istok+Web&display=swap" rel="stylesheet" />

    <!--  * Instalando css de rd navbar -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/template/libs/rd-navbar/dist/css/rd-navbar.css" />

    <!-- * iconos fontawesome 5 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@mdi/font@6.1.95/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/template/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/template/libs/aos/aos.css">

    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/template/css/estilos.css" />

    <!--edward-->
    <link href="<?php echo base_url(); ?>assets/template/css/custom.css" rel="stylesheet">

</head>

<body>


    <!-- * Para el menu de navegacion e info arriba debe estar dentro de una etiqueta rd-navbar-wrap -->



        <section id="login" class="min-vh-100 d-flex justify-content-center align-items-center">
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-10 col-sm-8 col-md-6 col-lg-5 col-xl-4 p-3">
                    <div class="content py-4 px-4 position-relative">

                        <div class="detalle position-relative w-100">
                            <img src="<?php echo base_url(); ?>uploads/<?php echo ConfiguracoesSistema('logo'); ?>" alt="flecha" class=" img-fluid" width="200">

                            <h1 class="h2 py-3 text-white fw-bold">Two Factor Authentication</h1>
							
                            <?php if($_SERVER['HTTP_REFERER'] === base_url('settings')): ?>
                            <img src="<?php echo $link; ?>">
							<?php endif; ?>
                            <p style="padding-top:15px">
                                Pleace install <strong><a href="https://play.google.com/store/apps/details?id=com.google.android.apps.authenticator2" target="_blank">Google authenticator</a></strong> App in your
                                phone, open it and then scan the above bar code to add this
                                application. After you have added this application enter the code
                                you see in the Google Authenticator App into the below input box to
                                complete login process.
                            </p>
                            
							
                            <div class="row px-3">
                                <div class="col-md-12">
                                    <?php if (isset($message)) echo $message; ?>
                                </div>
                                <form id="formMetabiz" method="post" role="form" action="<?php echo base_url('valid-twofactor'); ?>" class="p-0 m-0">
                                    <div class="col-12">
                                        <div class="mb-4 inputsito">
                                            <input type="text" class="form-control" name="pass-code" id="pass-code" required autocomplete="off">
                                            <label for="nombre" class="form-label">Enter Code</label>
                                        </div>
                                    </div>


                                    <button type="submit" name="submit" value="submit" class="btn btn-primario w-100 mx-auto">Login</button>
                                </form>

                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>

    </section>




    <script src="<?php echo base_url(); ?>assets/template/libs/jquery/jquery-3.4.1.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/template/libs/popper.js/popper.min.js"></script>

    <script src="<?php echo base_url(); ?>assets/template/libs/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/template/libs/rd-navbar/dist/js/jquery.rd-navbar.min.js"></script>

    <!--<script src="<?php //echo base_url();
                        ?>libs/swiper/swiper-bundle.min.js"></script>-->

    <script src="<?php echo base_url(); ?>assets/template/libs/aos/aos.js"></script>

    <script src="<?php echo base_url(); ?>assets/template/js/mis-scripts.js"></script>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>












</body>

</html>