<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- <link rel="shortcut icon" type="image/png" href="/imgs/favicon.png" /> -->
        <title><?php echo ConfiguracoesSistema('nome_site');?> - Login</title>
        
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


        <!-- inject:css -->
        <link rel="stylesheet" href="<?php echo base_url();?>assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo base_url();?>assets/bower_components/font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="<?php echo base_url();?>assets/bower_components/simple-line-icons/css/simple-line-icons.css">
        <link rel="stylesheet" href="<?php echo base_url();?>assets/bower_components/weather-icons/css/weather-icons.min.css">
        <link rel="stylesheet" href="<?php echo base_url();?>assets/bower_components/themify-icons/css/themify-icons.css">
        <!-- endinject -->

        <!-- Main Style  -->
        <link rel="stylesheet" href="<?php echo base_url();?>assets/dist/css/main.css">

        <script src="<?php echo base_url();?>assets/assets/js/modernizr-custom.js"></script>
    </head>
    <body style="background-image:url(<?php echo base_url('assets/imgs/backgrounds/login.jpg');?>);background-size: cover;background-repeat: no-repeat;">

        <div class="sign-in-wrapper">
            <div class="sign-container">
                <div class="text-center">
                    <h2 class="logo"><img src="<?php echo base_url();?>uploads/<?php echo ConfiguracoesSistema('logo');?>" width="130px" alt=""/></h2>
                    <h4>Fazer Login</h4>
                </div>

                <?php if(isset($message)) echo $message;?>

                <form class="sign-in-form" method="post" role="form" action="<?php echo base_url('login');?>">
                    <div class="form-group">
                        <input type="text" name="login" class="form-control" value="<?php echo set_value('login');?>" placeholder="Login">
                    </div>
                    <div class="form-group">
                        <input type="password" name="senha" class="form-control" value="" placeholder="Senha" autocomplete="">
                    </div>
                    <button type="submit" name="submit" value="submit" class="btn btn-success btn-block">Login</button>
                    <div class="text-center help-block">
                        <a href="<?php echo base_url('recuperar');?>"><small>Perdi minha senha</small></a>
                        <p class="text-muted help-block"><small>Quer uma conta?</small></p>
                    </div>
                    <a class="btn btn-md btn-default btn-block" href="<?php echo base_url('cadastrar');?>">Cadastrar-me agora!</a>
                </form>
                <div class="text-center copyright-txt">
                    <small><?php echo ConfiguracoesSistema('nome_site');?> - Copyright © <?php echo date('Y');?></small>
                </div>
            </div>
        </div>

        <!-- inject:js -->
        <script src="<?php echo base_url();?>assets/bower_components/jquery/dist/jquery.min.js"></script>
        <script src="<?php echo base_url();?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url();?>assets/bower_components/jquery.nicescroll/dist/jquery.nicescroll.min.js"></script>
        <script src="<?php echo base_url();?>assets/bower_components/autosize/dist/autosize.min.js"></script>
        <!-- endinject -->

        <!-- Common Script   -->
        <script src="<?php echo base_url();?>assets/dist/js/main.js"></script>

    </body>
</html>