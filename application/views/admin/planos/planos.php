<!--main content start-->
<div id="content" class="ui-content">
    <div class="ui-content-body">
        <div class="ui-container">
            <!--page title and breadcrumb start -->
            <div class="row">
                <div class="col-md-8">
                    <h1 class="page-title"> Planes
                        <small>planes de compra en el sistema</small>
                    </h1>
                </div>
                <div class="col-md-4">
                    <ul class="breadcrumb pull-right">
                        <li>Inicio</li>
                        <li>Planes</li>
                        <li><a href="<?php echo base_url('admin/planos');?>" class="active">Todos los Planes</a></li>
                    </ul>
                </div>
            </div>
            <!--page title and breadcrumb end -->

            <div class="row">
              <div class="col-sm-12">
                  <section class="panel">
                      <div class="panel-body">
                          
                          <a href="<?php echo base_url('admin/planos/adicionar');?>" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Nuevo Plan</a>
                          <div class="clearfix"></div>

                          <table class="table responsive-data-table table-striped">
                              <thead>
                              <tr>
                                  <th>
                                      Nombre
                                  </th>
                                  <th>
                                      Binário
                                  </th>
                                  <th>
                                      Plan de Carreira
                                  </th>
                                  <th>
                                      Techo binário
                                  </th>
                                  <th>
                                      Ganancias Diarias 
                                  </th>
                                  <th>
                                      Valor
                                  </th>
                                  <th>
                                      Opciones
                                  </th>
                                  
                              </tr>
                              </thead>
                              <tbody>
                              <?php
                              if($planos !== false){
                                foreach($planos as $plano){
                              ?>
                              <tr>
                                  <td>
                                      <?php echo $plano->nome;?>
                                  </td>
                                  <td>
                                      <?php echo $plano->binario;?>%
                                  </td>
                                  <td>
                                      <?php echo $plano->plano_carreira;?> pontos
                                  </td>
                                  <td>
                                      $us <?php echo number_format($plano->teto_binario, 2, ",", ".");?>
                                  </td>
                                  <td>
                                      $us <?php echo number_format($plano->ganhos_diarios, 2, ",", ".");?>
                                  </td>
                                  <td>
                                      $us <?php echo number_format($plano->valor, 2, ",", "."); ?>
                                  </td>
                                  <td>
                                    <a class="btn btn-info" href="<?php echo base_url('admin/planos/editar/'.$plano->id);?>"><i class="fa fa-pencil"></i> Editar</a>
                                    <a class="btn btn-danger" href="<?php echo base_url('admin/planos/excluir/'.$plano->id);?>"><i class="fa fa-times"></i> Excluir</a>
                                  </td>
                              </tr>
                              <?php
                                }
                              }
                              ?>
                              </tbody>
                          </table>
                      </div>
                  </section>
              </div>

          </div>

        </div>

    </div>
</div>
<!--main content end-->