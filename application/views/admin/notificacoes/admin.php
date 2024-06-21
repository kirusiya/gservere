<!--main content start-->
<div id="content" class="ui-content">
    <div class="ui-content-body">
        <div class="ui-container">
            <!--page title and breadcrumb start -->
            <div class="row">
                <div class="col-md-8">
                    <h1 class="page-title"> Notificaciones para el administrador
                        <small>todas las notificaciones para los administradores</small>
                    </h1>
                </div>
                <div class="col-md-4">
                    <ul class="breadcrumb pull-right">
                        <li>Inicio</li>
                        <li>Notificaciones</li>
                        <li><a href="<?php echo base_url('admin/notificacoes/admin');?>" class="active">Notificaciones para administrador</a></li>
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
                                      Notificaciones
                                  </th>
                                  <th>
                                      Fecha
                                  </th>
                                  
                              </tr>
                              </thead>
                              <tbody>
                              <?php
                              if($notificacoes !== false){
                                foreach($notificacoes as $notificacao){
                              ?>
                              <tr>
                                  <td>
                                      <?php echo $notificacao->mensagem;?>
                                  </td>
                                  <td>
                                      <?php echo date('d/m/Y H:i:s', strtotime($notificacao->data)); ?>
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