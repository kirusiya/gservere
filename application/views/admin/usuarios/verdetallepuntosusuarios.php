<!--main content start-->
<script src="<?php echo  base_url() ?>assets/permisos/jquery.js"></script>
<script type="text/javascript" src="<?php echo  base_url() ?>assets/permisos/permisos.js"></script>
<div id="content" class="ui-content">
    <div class="ui-content-body">
        <div class="ui-container">
            <!--page title and breadcrumb start -->
            <div class="row">
                <div class="col-md-8">
                    <h1 class="page-title"> Usuarios
                        <small>ver puntos del usuario</small>
                    </h1>
                </div>
                <div class="col-md-4">
                    <ul class="breadcrumb pull-right">
                        <li>Inicio</li>
                        <li>Usuario</li>
                        <li><a href="<?php echo base_url('admin/puntos');?>" class="active">Puntos del Usuario</a></li>
                    </ul>
                </div>
            </div>
            <!--page title and breadcrumb end -->
            <div class="row">
              <div class="col-sm-6">
               <strong>Nombre del Usuario: <?php echo $ladoinscripcion[0]->nome;?></strong>
              </div>
              <div class="col-sm-3">
               <strong>Lado de Inscripcion: <?php echo $ladoinscripcion[0]->lado_inscripcion;?></strong>
              </div>
              <div class="col-sm-3">
               <a class="btn btn-success" href="<?php echo base_url('admin/usuarios/visualizar/'.$ladoinscripcion[0]->id);?>" target= '_black'><i class="fa fa-eye"></i> Ver Datos</a>
              </div>

            </div>
            <BR>
            <div class="row">
              <div class="col-sm-6">               
              </div>
              <div class="col-sm-3">
               <strong>Ver puntos en el escritorio: <?php echo $ladoinscripcion[0]->ver_puntos;?></strong>
              </div>
              <div class="col-sm-3">
                <?php if($ladoinscripcion[0]->ver_puntos == 'SI'){?>  
                      <span class='d-inline-block' tabindex='0' data-toggle='tooltip' title='Disable'>
                        <button class='btn btn-danger' onclick = editarVerPuntos(<?php echo $ladoinscripcion[0]->id?>,1)>DESHABILITAR</button>
                      </span>                  
                
                <?php 
                } else {?>
                   <span class='d-inline-block' tabindex='0' data-toggle='tooltip' title='Disable'>
                        <button class='btn btn-warning' onclick = editarVerPuntos(<?php echo $ladoinscripcion[0]->id?>,2)>HABILITAR</button>
                      </span>  
                <?php } ?>
              </div>

            </div>
            <br>
            <div class="row">
              <div class="col-sm-6">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Patrocinados Izquierda</th>
                      <th>Fecha</th>                                            
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                    $con = 1;
                    foreach($patrocinadosizquierdo as $fila){
                    ?>
                    <tr>
                      <td><?php echo $con++;?></td>
                      <td><?php echo $fila->nome;?></td>
                      <td><?php echo $fila->fecha_factura;?></td>
                      
                    </tr>
                  <?php }?>
                  </tbody>
                </table>  
              </div>
              <div class="col-sm-6">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Patrocinados Derecha</th>
                      <th>Fecha</th>                                            
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                    $con = 1;
                    foreach($patrocinadosderecho as $fila){
                    ?>
                    <tr>
                      <td><?php echo $con++;?></td>
                      <td><?php echo $fila->nome;?></td>
                      <td><?php echo $fila->fecha_factura;?></td>
                      
                    </tr>
                  <?php }?>
                  </tbody>
                </table>  
              </div>  

            </div>

            <br>
            <span>PUNTOS GANADOS </span>
            <div class="row">
              <div class="col-sm-6">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Puntos izquierda</th>
                      <th>Fecha</th>                                            
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                    $con = 1;
                    foreach($puntosizquierdo as $fila){
                    ?>
                    <tr>
                      <td><?php echo $con++;?></td>
                      <td><?php echo $fila->pontos;?></td>
                      <td><?php echo $fila->data;?></td>
                      
                    </tr>
                  <?php }?>
                  </tbody>
                </table>  
              </div>
              <div class="col-sm-6">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Puntos derecha</th>
                      <th>Fecha</th>                                            
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                    $con = 1;
                    foreach($puntosderecho as $fila){
                    ?>
                    <tr>
                      <td><?php echo $con++;?></td>
                      <td><?php echo $fila->pontos;?></td>
                      <td><?php echo $fila->data;?></td>
                      
                    </tr>
                  <?php }?>
                  </tbody>
                </table>  
              </div>  

            </div>

        </div>

    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        var enlace = "<?php echo  base_url() ?>";
        baseurl(enlace);                
    });

</script>
<!--main content end-->