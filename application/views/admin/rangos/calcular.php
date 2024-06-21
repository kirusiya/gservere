<!--main content start-->
<script src="<?php echo  base_url() ?>assets/permisos/jquery.js"></script>
<script type="text/javascript" src="<?php echo  base_url() ?>assets/pages/admin/rangos.js"></script>
<div id="content" class="ui-content">
    <div class="ui-content-body">
        <div class="ui-container">
            <!--page title and breadcrumb start -->
            <div class="row">
                <div class="col-md-8">
                    <h1 class="page-title"> CÁLCULOS DE RANGO
                        <small>DATOS DEL DÍA</small>
                    </h1>
                </div>
                <div class="col-md-4">
                    <ul class="breadcrumb pull-right">
                        <li>Inicio</li>
                        <li>Rangos</li>
                        <li><a href="<?php echo base_url('admin/rangos/calcular');?>" class="active">Calculos</a></li>
                    </ul>
                </div>
            </div>
            <!--page title and breadcrumb end -->
            <div class="row">
              <div class="col-md-12">
                <button id="calcular" type="button" class="btn btn-primary" onclick="calcularDatos();"><span class="glyphicon glyphicon-floppy-disk"></span> Calcular Rangos</button>
              </div>  
            </div>
            

            <div class="row">
              <div class="col-sm-12">
                  <section class="panel">
                      <div class="panel-body">
                          <?php
                                  if($calculos){
                                  ?>
                                  <table class="table responsive-data-table tableExtrato table-striped">
                                      <thead>
                                      <tr>
                                          <th>
                                              #
                                          </th>
                                          <th>
                                              Usuario
                                          </th>
                                          <th>
                                              Nivel de ganancia
                                          </th>
                                          <th>
                                              ganancias
                                          </th>
                                          <th>
                                              Fecha
                                          </th>
                                          <th>
                                              Fecha de PAgo
                                          </th>
                                          <th>
                                              Estado
                                          </th>                                          
                                      </tr>
                                      </thead>
                                      <tbody>
                                      <?php
                                        $con = 1;
                                        foreach($calculos as $fila){
                                      ?>
                                      <tr>
                                          <td>
                                              # <?php echo $con++;?>
                                          </td>
                                          <td>
                                              <?php echo $fila->nome;?>
                                          </td>
                                          <td>
                                              <?php echo $fila->nivel_ganancia;?>
                                          </td>
                                          <td>
                                              $ <?php echo $fila->ganancia_diaria;?>
                                          </td>                                          
                                          <td>
                                              <?php echo date('d/m/Y', strtotime($fila->fecha_calculo));?>
                                          </td>
                                          <td>
                                              <?php if(is_null($fila->fecha_pago))
                                                      {$fecha = "";} 
                                                  else{$fecha = date('d/m/Y', strtotime($fila->fecha_pago));} 
                                                    echo $fecha;?>
                                          </td>
                                          <td>
                                              <?php echo $fila->estado;?>
                                          </td>

                                      </tr>
                                      <?php
                                      }
                                      ?>
                                      </tbody>
                                  </table>
                                  <?php
                                  }else{
                                    echo '<div class="alert alert-danger text-center">No hay datos</div>';
                                  }
                                  ?>
                      </div>
                  </section>
              </div>

          </div>

        </div>

    </div>
</div>
<!--main content end-->
<script type="text/javascript">
    $(document).ready(function(){
        var enlace = "<?php echo  base_url() ?>";
        baseurl(enlace);
        //cargaFunciones();        
    });

</script>