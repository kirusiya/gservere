<!--main content start-->
            <div id="content" class="ui-content">
                <div class="ui-content-body">
                    <div class="ui-container">
                        <!--page title and breadcrumb start -->
                        <div class="row">
                            <div class="col-md-8">
                                <h1 class="page-title"> Faturas
                                </h1>
                            </div>
                            <div class="col-md-4">
                                <ul class="breadcrumb pull-right">
                                    <li>Home</li>
                                    <li>Financeiro</li>
                                    <li><a href="<?php echo base_url('faturas');?>" class="active">Faturas</a></li>
                                </ul>
                            </div>
                        </div>
                        <!--page title and breadcrumb end -->

                        <!-- page start-->
                        <div class="row">
                            <div class="col-sm-12">
                                <section class="panel">
                                    <div class="panel-body">
                                        <table class="table  table-hover general-table">
                                            <thead>
                                                <tr>
                                                    <th>ID Fatura</th>
                                                    <th>Plano</th>
                                                    <th>Valor</th>
                                                    <th>Status</th>
                                                    <th>&nbsp;</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                if($faturas !== false){

                                                    foreach($faturas as $fatura){
                                                ?>
                                                <tr>
                                                    <td>#<?php echo $fatura->id_fatura;?></td>
                                                    <td><?php echo $fatura->nome;?></td>
                                                    <td>R$ <?php echo number_format($fatura->valor, 2, ",", ".");?></td>
                                                    <td><span class="label <?php echo ($fatura->status == 0) ? 'label-warning' : 'label-success';?> label-mini"><?php echo ($fatura->status == 0) ? 'Pendente' : 'Pago';?></span></td>
                                                    <td>
                                                    <?php echo ($fatura->status == 0) ? '<a href="javascript:void(0);" data-toggle="modal" data-target="#pagamento" class="btn btn-success">EFETUAR PAGAMENTO</a>' : '&nbsp;';?>
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

            <!-- Modal -->
            <div class="modal fade" id="pagamento" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Pagamento da sua fatura</h4>
                  </div>
                  <div class="modal-body">
                    <?php
                    if($formas_pagamento !== false){
                    ?>

                    <p>Após o pagamento, envie-nos o comprovante com a <b>data do pagamento</b> e <b>ID da fatura</b> <u>escrita a caneta</u> para ativarmos o seu plano. Caso seja transferência online ou via bitcoin, escreva em um editor de imagem. Para enviar, clique no menu <b>Financeiro</b> e clique no link <b>Enviar Comprovante</b></p>

                    <!-- start accordion -->
                    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                      
                      <?php
                      foreach($formas_pagamento as $pagamento){
                      ?>
                      <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="heading_<?php echo $pagamento->id;?>">
                          <h4 class="panel-title">
                            <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse_<?php echo $pagamento->id;?>" aria-expanded="false" aria-controls="collapse_<?php echo $pagamento->id;?>">
                              <?php
                              if($pagamento->categoria_conta == 1){
                                echo BancoPorID($pagamento->banco);
                              }else{
                                echo 'Depósito via Bitcoin';
                              }
                              ?>
                            </a>
                          </h4>
                        </div>
                        <div id="collapse_<?php echo $pagamento->id;?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading_<?php echo $pagamento->id;?>">
                          <div class="panel-body">
                            <?php
                              if($pagamento->categoria_conta == 1){
                                echo 'Banco: '.BancoPorID($pagamento->banco).'<br />';
                                echo 'Agência: '.$pagamento->agencia.'<br />';
                                echo 'Conta: '.$pagamento->conta.'<br />';
                                if(!empty($pagamento->operacao) && !is_null($pagamento->operacao)){
                                    echo 'Op: '.$pagamento->operacao.'<br />';
                                }
                                
                                echo 'Tipo de conta: ';
                                echo ($pagamento->tipo == 1) ? 'Conta Corrente <br />' : 'Poupança <br />';

                                echo 'Documento: '.$pagamento->documento.'<br />';
                                echo 'Titular: '.$pagamento->titular.'<br />';
                              }else{
                                echo 'Endereço Bitcoin: '.$pagamento->carteira_bitcoin;
                              }
                              ?>
                          </div>
                        </div>
                      </div>
                      <?php
                      }
                      ?>
                    </div>
                    <!-- .end-accordion-->
                    <?php
                    }else{
                        echo '<div class="alert alert-danger text-center">Nenhuma forma de pagamento disponível no momento. Por favor, volte mais tarde.</div>';
                    }
                    ?>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                  </div>
                </div>
              </div>
            </div>