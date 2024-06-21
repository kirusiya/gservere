<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <link rel="shortcut icon" type="image/png" href="/imgs/favicon.png" /> -->
    <title><?php echo ConfiguracoesSistema('nome_site'); ?> - Login</title>

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

                            <h1 class="h2 py-3 text-white fw-bold">Login</h1>

                            <div class="row px-3">
                                <div class="col-md-12">
                                    <?php if (isset($message)) echo $message; ?>
                                </div>
                                <form id="formMetabiz" method="post" role="form" action="<?php echo base_url('login'); ?>" class="p-0 m-0">
                                    <div class="col-12">
                                        <div class="mb-4 inputsito">
                                            <input type="text" class="form-control" name="login" id="nombre" required autocomplete="off" value="<?php echo set_value('login'); ?>">
                                            <label for="nombre" class="form-label">Username</label>
                                        </div>
                                    </div>
                                    <div class="col-12 pb-4">
                                        <div class="mb-4 inputsito">
                                            <input type="password" class="form-control" name="senha" id="pass" required autocomplete="off">
                                            <label for="pass" class="form-label">Password</label>
                                        </div>
                                    </div>

                                    <div class="col-md-12 d-flex justify-content-center mb-4">
                                        <div class="g-recaptcha" data-sitekey="<?php echo $this->config->item('google_key') ?>"></div>

                                    </div>


                                    <button type="submit" name="submit" value="submit" class="btn btn-primario w-100 mx-auto">Login</button>
                                </form>
                                <p class="pt-2 pb-0 m-0">
                                    <a href="<?php echo base_url('recover'); ?>" class="text-decoration-none text-warning">
                                        Lost your password?
                                    </a>
                                </p>

                                <?php
                                $rec = 1;
                                if ($rec == 0) {
                                ?>

                                    <!--<p class="p-0 small">Do you want an account?</p>
                                <button class="btn btn-secundario w-auto mx-auto"><a href="<?php //echo base_url('cadastrar'); 
                                                                                            ?>" class="text-decoration-none text-white">Sign up</a></button>-->
                                <?php
                                }
                                ?>

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


 <script src="https://www.google.com/recaptcha/api.js" async defer></script>

<script>
	
jQuery(function($){
 
        $( '.g-recaptcha' ).attr( 'data-theme', 'dark' );
 
        });	
	</script>	
	
    <!-- <script>
        async function connectWallet() {
            accounts = await window.ethereum.request({
                method: "eth_requestAccounts"
            }).catch((err) => {

                console.log(err.code);
                console.log(err.message);
                var msj = document.getElementById('msj');
                msj.innerHTML = err.message;
            });
            $('#fake').val(accounts[0]);
			$('#cpf').val(accounts[0]);
			$.cookie('myWallet', wallet);
            // console.log(accounts);
        }
        connectWallet();
        window.onload = function() {
            if (window.ethereum !== "undefined") {
                this.ethereum.on("accountsChanged", handleAccountsChanged)
            }
        }


        let accounts;

        const handleAccountsChanged = (a) => {
            accounts = a;
            $('#fake').val(accounts[0]);
			$('#cpf').val(accounts[0]);
			$.cookie('myWallet', wallet);

        }



        async function mostrarCuentas() {
            accounts = await window.ethereum.request({
                method: "eth_requestAccounts"
            }).catch((err) => {

                console.log(err.code);
                console.log(err.message);
                var msj = document.getElementById('msj');
                msj.innerHTML = err.message;
            });
            var getUrl = window.location;
            // console.log(getUrl['href']);
            $.ajax({
                type: "post",
                url: getUrl['href'] + "/wallet-login",
                data: {
                    "wallet": accounts[0]
                },

                success: function(response) {
                    let users = response.split(',');
                    let contar = users.length;
                    let arrUser = [];
                    for (i = 1; i < contar; i++) {
                        // console.log(users[i]);
                        arrUser.push(users[i]);
                    }


                    arrUser.forEach(btnUsers)

                }
            });
        }

        function btnUsers(usr) {
            // let user = String(usr);
            const btn = document.createElement('button');
            let clck = "logUsr('" + usr + "')";
            btn.setAttribute("class", "btn btn-primario m-2");
            btn.setAttribute('onclick', clck);
            btn.innerHTML = usr;




            var cuentas = document.getElementById('cuentas');
            cuentas.appendChild(btn);
        }
        mostrarCuentas();

        function logUsr(id) {
            $('.walletsUser').addClass('esconder');
            $('#nombre').val(id);



        }
		
function registroCookies(){
	//alert('mi C'+ $.cookie("myWallet"))
	
	let hiddenInput = $.cookie("myWallet");
	
	$("<input>").attr({
                name: "cpf",
                id: "cpf",
                type: "hidden",
                value: hiddenInput
    }).appendTo("form");
	
	//formRegister
	$("#formMetabiz").submit();
	
	
}			 -->

    </script>













</body>

</html>