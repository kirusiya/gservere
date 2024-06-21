<!--main content start-->
<div id="content" class="ui-content">
    <div class="ui-content-body">
        <div class="ui-container">
            <!--page title and breadcrumb start -->
            <div class="row">
                <div class="col-md-8">
                    <h1 class="page-title"> Facturas Liberadas
                        <small>facturas que ya han sido liberadas</small>
                    </h1>
                </div>
                <div class="col-md-4">
                    <ul class="breadcrumb pull-right">
                        <li>Inicio</li>
                        <li>Facturas</li>
                        <li><a href="<?php echo base_url('admin/faturas/liberadas');?>" class="active">Facturas Liberadas</a></li>
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
                                      Nombre Completo
                                  </th>
                                  <th>
                                      Login
                                  </th>
                                  <th>
                                      Plan
                                  </th>
                                  <th>
                                      Valor
                                  </th>
								  <th>
                                      Fecha <!--DIEGO-->
                                  </th>
                                  <th>&nbsp;
                                      
                                  </th>
                                  
                              </tr>
                              </thead>
                              <tbody>
                              <?php
                              if($faturas !== false){
                                foreach($faturas as $fatura){
                              ?>
                              <tr>
                                  <td>
                                      <?php echo InformacoesUsuario('nome', $fatura->id_usuario);?>
                                  </td>
                                  <td>
                                      <?php echo InformacoesUsuario('login', $fatura->id_usuario);?>
                                  </td>
                                  <td>
                                      <?php echo $fatura->nome; ?>
                                  </td>
                                  <td>
                                      <?php echo number_format($fatura->valor, 2, ",", "."); ?> USD
                                  </td>
								  <td>
                                      <?php echo $fatura->data_pagamento;//DIEGO?>
                                  </td>
                                  <td>
                                  <a class="btn btn-info" href="https://etherscan.io/tx/<?php echo $fatura->comprovante;?>" target="_blank"><i class="fa fa-picture"></i> Comprobante</a>

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