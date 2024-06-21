<!--main content start-->
<div id="content" class="ui-content ui-content-aside-overlay">
    <div class="ui-content-body">

        <div class="container">

            <!--page title and breadcrumb start -->
            <div class="row">
                <div class="col-md-8">
                    <h1 class="page-title"> Escritorio
                        <small>resumen de información del sistema</small>
                    </h1>
                </div>
                <div class="col-md-4">
                    <ul class="breadcrumb pull-right">
                        <li>Inicio</li>
                        <li><a href="<?php echo base_url('admin/dashboard');?>" class="active">Escritorio</a></li>
                    </ul>
                </div>
            </div>
            <!--page title and breadcrumb end -->

            <!--states start-->
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <div class="panel short-states">
                        <div class="panel-title">
                            <h4> <span class="label label-danger pull-right">entradas hoy</span></h4>
                        </div>
                        <div class="panel-body">
                            <h1>$us <?php echo $rendimentos_hoje;?></h1>
                            <small>Valores que ingresaron hoy</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="panel short-states">
                        <div class="panel-title">
                            <h4> <span class="label label-info pull-right">Usuarios</span></h4>
                        </div>
                        <div class="panel-body">
                            <h1><?php echo $total_usuarios;?></h1>
                            <small>Usuarios en el sistema</small>
                        </div>
                    </div>
                </div>
				
				
                <div class="col-md-3 col-sm-6">
                    <div class="panel short-states">
                        <div class="panel-title">
                            <h4> <span class="label label-warning pull-right">Planes Comprados</span></h4>
                        </div>
                        <div class="panel-body">
                            <h1><?php echo $planes_pagados;?></h1>
                            <small>Planes pagados y activos</small>
                        </div>
                    </div>
                </div>
				
				<div class="col-md-3 col-sm-6">
                    <div class="panel short-states">
                        <div class="panel-title">
                            <h4> <span class="label label-warning pull-right">Planes Free</span></h4>
                        </div>
                        <div class="panel-body">
                            <h1><?php echo $planes_free;?></h1>
                            <small>Planes Gratis y activos</small>
                        </div>
                    </div>
                </div>
				
				
                <div class="col-md-3 col-sm-6">
                    <div class="panel short-states">
                        <div class="panel-title">
                            <h4> <span class="label label-success pull-right">Retiros Pendientes</span></h4>
                        </div>
                        <div class="panel-body">
                            <h1><?php echo $saques_pendentes;?></h1>
                            <small>Total de Retiros Pendientes</small>
                        </div>
                    </div>
                </div>
            </div>
            <!--states end-->

            <div class="row">
                <div class="col-md-12">
                    <div class="panel">
                        <header class="panel-heading">
                            Ultimas 20 notificaciones para el administrador
                            <span class="tools pull-right">
                                <a class="close-box fa fa-times" href="javascript:;"></a>
                            </span>
                        </header>
                        <div class="panel-body">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Notificacion</th>
                                        <th>Fecha</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if($notificacoes !== false){
                                        foreach($notificacoes as $notificacao){
                                    ?>
                                    <tr>
                                        <td><?php echo $notificacao->mensagem;?></td>
                                        <td><?php echo date('d/m/Y H:i:s', strtotime($notificacao->data));?></td>
                                    </tr>
                                    <?php
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--main content end-->