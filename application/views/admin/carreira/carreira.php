<!--main content start-->
<div id="content" class="ui-content">
    <div class="ui-content-body">
        <div class="ui-container">
            <!--page title and breadcrumb start -->
            <div class="row">
                <div class="col-md-8">
                    <h1 class="page-title"> Planes de Carreira
                        <small>planes de carrera del sistema</small>
                    </h1>
                </div>
                <div class="col-md-4">
                    <ul class="breadcrumb pull-right">
                        <li>Inicio</li>
                        <li>Planes</li>
                        <li><a href="<?php echo base_url('admin/carreira');?>" class="active">Todos los Planes de Carrera</a></li>
                    </ul>
                </div>
            </div>
            <!--page title and breadcrumb end -->

            <div class="row">
              <div class="col-sm-12">
                  <section class="panel">
                      <div class="panel-body">
                          
                          <a href="<?php echo base_url('admin/carreira/adicionar');?>" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Nuevo Plan de Carrera</a>
                          <div class="clearfix"></div>

                          <table class="table responsive-data-table table-striped">
                              <thead>
                              <tr>
                                  <th>
                                      Nombre
                                  </th>
                                  <th>
                                      Puntos
                                  </th>
                                  <th>
                                      Descripción
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
                                      <?php
                                      if($plano->id == 1){
                                        echo '<small>(Esse plano é o inicial e por isso não pode ser excluído)</small>';
                                      }
                                      ?>
                                  </td>
                                  <td>
                                      <?php echo $plano->pontos;?>
                                  </td>
                                  <td>
                                      <?php echo $plano->premio;?>
                                  </td>
                                  <td>
                                    <a class="btn btn-info" href="<?php echo base_url('admin/carreira/editar/'.$plano->id);?>"><i class="fa fa-pencil"></i> Editar</a>
                                    
                                    <?php
                                    if($plano->id != 1){
                                    ?>
                                    <a class="btn btn-danger" href="<?php echo base_url('admin/carreira/excluir/'.$plano->id);?>"><i class="fa fa-times"></i> Excluir</a>
                                    <?php
                                    }
                                    ?>
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