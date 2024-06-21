<!--main content start-->
<div id="content" class="ui-content">
    <div class="ui-content-body">
        <div class="ui-container">
            <!--page title and breadcrumb start -->
            <div class="row">
                <div class="col-md-8">
                    <h1 class="page-title"> Cuentas de pago
                        <small>cuentas para recibir pagos</small>
                    </h1>
                </div>
                <div class="col-md-4">
                    <ul class="breadcrumb pull-right">
                        <li>Inicio</li>
                        <li>Financiero</li>
                        <li><a href="<?php echo base_url('admin/deposito');?>" class="active">Nueva cuenta de pago</a></li>
                    </ul>
                </div>
            </div>
            <!--page title and breadcrumb end -->

            <div class="row">
              <div class="col-sm-12">
                  <section class="panel">
                      <div class="panel-body">
                          
                          <a href="<?php echo base_url('admin/deposito/adicionar');?>" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Nueva cuenta para pago</a>
                          <div class="clearfix"></div>

                          <table class="table responsive-data-table table-striped">
                              <thead>
                              <tr>
                                  <th>
                                      Deposito en
                                  </th>
                                  <th>&nbsp;
                                      
                                  </th>
                                  
                              </tr>
                              </thead>
                              <tbody>
                              <?php
                              if($contas !== false){
                                foreach($contas as $conta){
                              ?>
                              <tr>
                                  <td>
                                      <?php
                                      if($conta->categoria_conta == 1){
                                        echo BancoPorID($conta->banco);
                                      }else{
                                        echo 'PIX';
                                      }
                                      ?>
                                  </td>
                                  <td>
                                    <a class="btn btn-info" href="<?php echo base_url('admin/deposito/editar/'.$conta->id);?>"><i class="fa fa-pencil"></i> Editar</a>
                                    <a class="btn btn-danger" href="<?php echo base_url('admin/deposito/excluir/'.$conta->id);?>"><i class="fa fa-times"></i> Eliminar</a>
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