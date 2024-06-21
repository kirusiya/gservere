<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- <link rel="shortcut icon" type="image/png" href="/imgs/favicon.png" /> -->
        <title><?php echo ConfiguracoesSistema('nome_site');?> - Login</title>

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
        <!-- recaptcha DIEGO  -->
        <script src='https://www.google.com/recaptcha/api.js'></script>
    </head>
    <body>

        <div class="sign-in-wrapper">
            <div class="sign-container">
                <div class="text-center">
                    <h2 class="logo"><img src="<?php echo base_url();?>uploads/<?php echo ConfiguracoesSistema('logo');?>" width="130px" alt=""/></h2>
                    <h4>Login - Admin</h4>
                </div>

                <?php if(isset($message)) echo $message;?>

                <form class="sign-in-form" method="post" role="form" action="<?php echo base_url('admin/login');?>">
                    <div class="form-group">
                        <input type="text" name="login" class="form-control" value="<?php echo set_value('login');?>" placeholder="Login">
                    </div>
                    <div class="form-group">
                        <input type="password" name="senha" class="form-control" value="" placeholder="Password" autocomplete="">
                    </div>
                    <div class="form-group">
                            <!--<div class="g-recaptcha" id="recaptcha" name="recaptcha" data-sitekey="6LeFAr8gAAAAAA2iOGC_fkzkkRxIS47ety0mKnY_"></div>--> <!--AGREGAR KEY SITIO WEB RECAPTCHAT LOCAL -->

                            <div class="g-recaptcha" id="recaptcha" name="recaptcha" data-sitekey="<?php echo $this->config->item('google_key') ?>"></div> <!--AGREGAR KEY SITIO WEB RECAPTCHAT PRODUCCION -->

                        </div>
                    <button type="submit" name="submit" value="submit" class="btn btn-info btn-block">Login</button>
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