<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo ConfiguracoesSistema('nome_site');?> - Administrativo</title>
    
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
    <link rel="stylesheet" href="<?php echo base_url();?>assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/bower_components/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/bower_components/simple-line-icons/css/simple-line-icons.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/bower_components/weather-icons/css/weather-icons.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/bower_components/themify-icons/css/themify-icons.css">
    <!-- endinject -->

    <!-- Main Style  -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/dist/css/main.css">

    <!--bootstrap sub menu-->
    <link href="<?php echo base_url();?>assets/assets/js/bootstrap-submenu/css/bootstrap-submenu.css" rel="stylesheet">

    <!--horizontal-timeline-->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/assets/js/horizontal-timeline/css/style.css">


    <script src="<?php echo base_url();?>assets/assets/js/modernizr-custom.js"></script>

    <!-- notify -->
    <link rel="stylesheet" href="<?php echo base_url();?>vendor/needim/noty/lib/noty.css">
    
    <!-- sweet alert 2 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.11.5/sweetalert2.css">
        

    <!-- data table -->
    <link href="<?php echo base_url();?>assets/bower_components/datatables/media/css/jquery.dataTables.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/bower_components/datatables-tabletools/css/dataTables.tableTools.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/bower_components/datatables-colvis/css/dataTables.colVis.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/bower_components/datatables-responsive/css/responsive.dataTables.scss" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/bower_components/datatables-scroller/css/scroller.dataTables.scss" rel="stylesheet">
    
	<!--edward-->
 	<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous">	
	
    <link href="<?php echo base_url();?>assets/pages/admin/custom-admin.css" rel="stylesheet">
    
    <link href="https://rawgithub.com/hayageek/jquery-upload-file/master/css/uploadfile.css" rel="stylesheet">
    

 
    
</head>
<body>

    <div id="ui" class="ui ui-aside-none">

        <!--header start-->
        <header id="header" class="ui-header">
            <div class="row">
                <div class="container">
               
                <div class="col-md-12">
                    <div class="navbar-header">
                            <!--logo start-->

                            <a href="<?php echo base_url('admin');?>" class="navbar-brand">
                                <span class="logo"><img src="<?php echo base_url();?>uploads/<?php echo ConfiguracoesSistema('logo');?>" width="130px" alt=""/></span>
                            </a>
                            <!--logo end-->
                    </div>
                    <div class="navbar-collapse nav-responsive-disabled">

                            <!--notification start-->
                            <ul class="nav navbar-nav navbar-right">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" id="aba_notificacoes_admin" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                        <i class="fas fa-bell"></i>
                                        <?php if($this->UsuarioModel->QuantidadeNotificacoesAdmin() > 0){ echo '<span class="badge" id="quantidade_notificacoes_pendentes_admin">'.$this->UsuarioModel->QuantidadeNotificacoesAdmin().'</span>'; } ?>
                                    </a>
                                    <!--dropdown -->
                                    <ul class="dropdown-menu dropdown-menu--responsive">
                                        <div class="dropdown-header">Notificaciones (<span id="total_notificacoes_pendentes_admin"><?php echo $this->UsuarioModel->QuantidadeNotificacoesAdmin();?></span>)</div>
                                        <ul class="Notification-list Notification-list--small niceScroll list-group">
                                            <?php
                                            if($this->UsuarioModel->MinhasNotificacoesAdmin() !== false){
                                                foreach($this->UsuarioModel->MinhasNotificacoesAdmin() as $notificacao){
                                            ?>
                                            <li class="Notification list-group-item">
                                                <a href="">
                                                    <div class="Notification__avatar Notification__avatar--danger pull-left" href="">
                                                        <i class="Notification__avatar-icon fa fa-exclamation"></i>
                                                    </div>
                                                    <div class="Notification__highlight">
                                                        <p class="Notification__highlight-excerpt"><b><?php echo $notificacao->mensagem;?></b></p>
                                                        <p class="Notification__highlight-time"><?php echo TempoAtras(strtotime($notificacao->data));?></p>
                                                    </div>
                                                </a>
                                            </li>
                                            <?php
                                                }
                                            }
                                            ?>
                                        </ul>
                                        <div class="dropdown-footer"><a href="<?php echo base_url('admin/notificacoes/admin');?>">Ver todas</a></div>
                                    </ul>
                                    <!--/ dropdown -->
                                </li>

                                <li class="dropdown dropdown-usermenu">
                                    <a href="#" class=" dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                                        <span class="hidden-sm hidden-xs"><?php echo InformacoesUsuario('nome', $this->session->userdata('uid_admin'));?></span>
                                        <!--<i class="fa fa-angle-down"></i>-->
                                        <span class="caret hidden-sm hidden-xs"></span>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-usermenu pull-right">
                                        <li><a href="<?php echo base_url('admin/logout');?>"><i class="fa fa-sign-out"></i> Cerrar Sesión</a></li>
                                    </ul>
                                </li>
                            </ul>
                            <!--notification end-->

                        </div>
                </div>
                
                    
                </div>
            </div>

        </header>
        <!--header end-->

        <!--nav start-->
        <nav class="navbar navbar-inverse yamm navbar-default hori-nav " role="navigation">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="navbar-header">

                            <!--toggle bar for responsive star-->
                            <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#main-navigation">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                            <!--toggle bar for responsive end-->

                        </div>

                        <div class="collapse navbar-collapse" id="main-navigation">
                            <ul class="nav navbar-nav">
                                <?php foreach($rolescero as $rol):?>
                                    
                                    <?php if($rol->nivel == 0){ ?>
                                    <li class="dropdown">
                                        <a href="<?php echo site_url($rol->link);?>" class="dropdown-toggle"><?=$rol->opcion?></a>
                                    </li>
                                    <?php }?>

                                    <?php if($rol->nivel == 1){ ?>
                                    <li class="dropdown">

                                        <a class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-submenu>
                                            <?=$rol->opcion?> <span class="fa fa-angle-down"></span>
                                        </a>
                                        <ul class="dropdown-menu">
                                        <?php 
                                        
                                        $rolesUser = opcionesRoles($rol->id,$roles);                                          
                                        foreach($rolesUser as $rolOpcion)
                                        {
                                            if($rolOpcion->rama == 0)
                                            {
                                            ?>                                            
                                                <li><a href="<?php echo site_url($rolOpcion->link);?>" class="dropdown-toggle"><?=$rolOpcion->opcion?></a></li>
                                            <?php 
                                            }
                                            if( $rolOpcion->rama == 1)
                                            {?>
                                                <li class="dropdown-submenu">
                                                    <a tabindex="0"><?=$rolOpcion->opcion?></a>
                                                    <ul class="dropdown-menu">
                                                        <?php $rolesUser2 = opcionesRoles($rolOpcion->id,$roles); 
                                                        foreach($rolesUser2 as $rolOpcion2)
                                                        {
                                                        ?>
                                                        <li><a href="<?php echo site_url($rolOpcion2->link);?>" tabindex="0"><?=$rolOpcion2->opcion?></a></li>
                                                        <?php 
                                                            }
                                                        ?>
                                                    </ul>
                                                </li>                                            
                                            <?php
                                            }
                                             
                                        }
                                        ?>
                                        </ul>
                                    </li>
                                    <?php }?>
                                <?php endforeach?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
        <!--nav end-->
        <?php echo $contents;?>

<!--footer start-->
        <div id="footer" class="ui-footer">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <?php echo date('Y');?> &copy; <?php echo ConfiguracoesSistema('nome_site');?>.
                    </div>
                </div>
            </div>
        </div>
        <!--footer end-->

    </div>

    <script>
    var baseURL = '<?php echo base_url();?>';
    </script>

    <!-- inject:js -->
    <script src="<?php echo base_url();?>assets/bower_components/jquery/dist/jquery.min.js"></script>
    <script src="<?php echo base_url();?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url();?>assets/bower_components/jquery.nicescroll/dist/jquery.nicescroll.min.js"></script>
    <script src="<?php echo base_url();?>assets/bower_components/autosize/dist/autosize.min.js"></script>
    <!-- endinject -->

    <!--bootstrap-submenu & dropdown-->
    <script src="<?php echo base_url();?>assets/assets/js/bootstrap-submenu/js/bootstrap-submenu.js"></script>
    <script src="<?php echo base_url();?>assets/assets/js/bootstrap-hover-dropdown.js"></script>

    <script>
        $(document).ready(function () {

            // yamm mega menu

            $(document).on('click', '.yamm .dropdown-menu', function(e) {
                e.stopPropagation()
            });

            //bootstrap sub menu

            $('[data-submenu]').submenupicker();


        });
    </script>
	
	
<script>

if( $('select.pagarPuntos').length ){
	
	$('select.pagarPuntos').on('change', function() {
		
		let valPagar = parseInt(this.value);
		let idFactura = $(this).attr('data-id');
		
		if(valPagar==1 || valPagar==0){
		
			$("#pagar-"+idFactura).removeClass("btn-info");
			$("#pagar-"+idFactura).addClass("btn-success");
			
			$("#pagar-"+idFactura).attr("href", "<?php echo base_url('admin/faturas/liberar/');?>"+idFactura+'/?pagar='+valPagar)
			
			
		}else{
			
			$("#pagar-"+idFactura).removeClass("btn-success");
			$("#pagar-"+idFactura).addClass("btn-info");
			
			$("#pagar-"+idFactura).removeAttr("href")
		}
		
		
		
		
		
		console.log(idFactura);
		
		
		
	});
	
}	
	
</script>	

    
    <!-- Common Script   -->
    <script src="<?php echo base_url();?>assets/dist/js/main.js"></script>

    <script src="<?php echo base_url();?>assets/pages/geral.js"></script>

    <?php
        if(isset($jsLoader)){

            foreach($jsLoader as $type=>$script){

                $link = ($type === 'external') ? $script : base_urL($script);

                echo '<script src="'.$link.'"></script>';
            }
        }
        ?>
    
<script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>  
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>    
    
    

<script src="https://rawgithub.com/hayageek/jquery-upload-file/master/js/jquery.uploadfile.min.js"></script>          
      
      
<script>
$(document).ready(function() {
    $("#fileuploader").uploadFile({
        url:"<?php echo base_url();?>assets/imgs/upload.php",
        multiple:false,
        dragDrop:true,
        maxFileCount:1,
        allowedTypes: "jpg,jpeg,gif,png",
        fileName:"myfile",
        returnType:"json",
            onLoad:function(obj)
            {
                    //$("#eventsmessage").html($("#eventsmessage").html()+"<br/>Widget Loaded:");
                //$("#eventsmessage").html($("#eventsmessage").html()+"<br/>Success for: "+JSON.stringify(data));
            },
            onSuccess:function(files,data,xhr,pd)
            {

                $("#eventsmessage").html($("#eventsmessage").html()+"<br/><img src='<?php echo base_url();?>assets/imgs/plan/"+data+"' height='100px' width='100px'> ");
                $("#img").val(data);
                $("#img_actual").hide();

            },
            afterUploadAll:function(obj)
            {
                $("#eventsmessage").html($("#eventsmessage").html()+"<br/>File Loaded Correctly");


            },
            onError: function(files,status,errMsg,pd)
            {
                $("#eventsmessage").html($("#eventsmessage").html()+"<br/>File upload failed: "+JSON.stringify(files));
            },
            onCancel:function(files,pd)
            {
                    $("#eventsmessage").html($("#eventsmessage").html()+"<br/>File upload was canceled: "+JSON.stringify(files));
            }
    });
    
        
     
});
	
	
/*jimmy*/
	
	
$("#fileuploader2").uploadFile({
        url:"<?php echo base_url();?>assets/imgs/upload.php",
        multiple:false,
        dragDrop:true,
        maxFileCount:1,
        allowedTypes: "jpg,jpeg,gif,png",
        fileName:"myfile",
        returnType:"json",
            onLoad:function(obj)
            {
                    //$("#eventsmessage2").html($("#eventsmessage2").html()+"<br/>Widget Loaded:");
                //$("#eventsmessage2").html($("#eventsmessage2").html()+"<br/>Success for: "+JSON.stringify(data));
            },
            onSuccess:function(files,data,xhr,pd)
            {

                $("#eventsmessage2").html($("#eventsmessage2").html()+"<br/><img src='<?php echo base_url();?>assets/imgs/plan/"+data+"' height='100px' width='100px'> ");
                $("#img2").val(data);
                $("#img_actual2").hide();

            },
            afterUploadAll:function(obj)
            {
                $("#eventsmessage2").html($("#eventsmessage2").html()+"<br/>File Loaded Correctly");


            },
            onError: function(files,status,errMsg,pd)
            {
                $("#eventsmessage2").html($("#eventsmessage2").html()+"<br/>File upload failed: "+JSON.stringify(files));
            },
            onCancel:function(files,pd)
            {
                    $("#eventsmessage2").html($("#eventsmessage2").html()+"<br/>File upload was canceled: "+JSON.stringify(files));
            }
    });	
	
</script> 
	
	
<script>
	
/*copy function*/
	
function kopiraj() {

  var copyText = document.getElementById("hashtxt");

  copyText.select();

  document.execCommand("Copy");

    

  $('.alert.hash').show();

    

  setTimeout(function() { 

  
    $('.alert.hash').fadeOut(1000);  

  }, 1000);     

    

    

} 	
/*copy function*/	
	
</script>		
    

</body>
</html>
