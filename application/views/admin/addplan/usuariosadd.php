<!--main content start-->
<div id="content" class="ui-content">
    <div class="ui-content-body">
        <div class="ui-container">
            <!--page title and breadcrumb start -->
            <div class="row">
                <div class="col-md-8">
                    <h1 class="page-title"> Agregar Plan a usuarios
                        <small>todos los usuarios registrados</small>
                    </h1>
                </div>
                <div class="col-md-4">
                    <ul class="breadcrumb pull-right">
                        <li>Inicio</li>
                        <li>Usuarios</li>
                        <li><a href="<?php echo base_url('admin/addplan');?>" class="active">todos los usuarios</a></li>
                    </ul>
                </div>
            </div>
            <!--page title and breadcrumb end -->

            <div class="row">
              <div class="col-sm-12">
                  <section class="panel">
                      <div class="panel-body">
                          <table class="table responsive-data-table table-striped">
                              <thead>
                              <tr>
                                  <th>
                                      Nombre
                                  </th>
                                  <th>
                                      Login
                                  </th>
                                  <th>
                                      Saldo Rendimentos
                                  </th>
                                  <th>
                                      Saldo Patrocinio
                                  </th>
                                  <th>
                                      Plano de Carrera
                                  </th>
                                  <th>&nbsp;
                                      
                                  </th>
                                  
                              </tr>
                              </thead>
                              <tbody>
                              <?php
                              if($usuarios !== false){
                                foreach($usuarios as $usuario){
                              ?>
                              <tr>
                                  <td>
                                      <?php echo $usuario->nome;?>
                                  </td>
                                  <td>
                                      <?php echo $usuario->login; ?>
                                  </td>
                                  <td>
                                      $us <?php echo number_format($usuario->saldo_rendimentos, 2, ",", "."); ?>
                                  </td>
                                  <td>
                                      $us <?php echo number_format($usuario->saldo_indicacoes, 2, ",", "."); ?>
                                  </td>
                                  <td>
                                      <?php echo PlanoCarreira($usuario->plano_carreira, 'nome'); ?>
                                  </td>
                                  <td>                                   
                                    <a class="btn btn-info" href="<?php echo base_url('admin/addplan/adicionarPlan/'.$usuario->id);?>"><i class="fa fa-pencil"></i> Agregar Plan</a>
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