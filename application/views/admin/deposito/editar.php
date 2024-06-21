<!--main content start-->
<div id="content" class="ui-content">
    <div class="ui-content-body">
        <div class="ui-container">
            <!--page title and breadcrumb start -->
            <div class="row">
                <div class="col-md-8">
                    <h1 class="page-title"> Editar método de pago
                        <small>editar una cuenta</small>
                    </h1>
                </div>
                <div class="col-md-4">
                    <ul class="breadcrumb pull-right">
                        <li>Inicio</li>
                        <li>Financeiro</li>
                        <li><a href="<?php echo base_url('admin/deposito/editar/'.$this->uri->segment(4));?>" class="active">Editar cuenta para el pago</a></li>
                    </ul>
                </div>
            </div>
            <!--page title and breadcrumb end -->
            
            <!-- page start-->
            <div class="row">
                <div class="col-sm-12">
                    <section class="panel">
                        <div class="panel-body">

                        <form action="" method="post" class="form-horizontal form-variance">
                          
                          <?php if(isset($message)) echo $message;?>
                          
                          <div class="form-group">
                              <label class="col-sm-3 control-label">Tipo de cuenta</label>
                              <div class="col-sm-6">
                                    <input type="radio" name="tipo" value="1" <?php echo ($conta->categoria_conta == 1) ? 'checked' : '';?>> Conta Bancária
                                    <input type="radio" name="tipo" value="2" <?php echo ($conta->categoria_conta == 2) ? 'checked' : '';?>> Cripto
                              </div>
                          </div>

                          <div id="box_conta_bancaria" style="display:<?php echo ($conta->categoria_conta == 1) ? 'block' : 'none';?>;">
                            
                            <div class="form-group">
                              <label class="col-sm-3 control-label">Banco</label>
                              <div class="col-sm-6">
                                    <select name="banco" class="form-control">
                                      <?php
                                      foreach(Bancos() as $banco){
                                        echo '<option value="'.$banco['code'].'" '.(($conta->banco == $banco['code']) ? 'selected' : '').'>'.$banco['code'].' - '.$banco['name'].'</option>';
                                      }
                                      ?>
                                    </select>
                              </div>
                          </div>

                          <div class="form-group">
                              <label class="col-sm-3 control-label">Agencia</label>
                              <div class="col-sm-6">
                                    <input type="text" name="agencia" class="form-control" value="<?php echo $conta->agencia;?>">
                              </div>
                          </div>

                          <div class="form-group">
                              <label class="col-sm-3 control-label">Cuenta</label>
                              <div class="col-sm-6">
                                    <input type="text" name="conta" class="form-control" value="<?php echo $conta->conta;?>">
                              </div>
                          </div>

                          <div class="form-group">
                              <label class="col-sm-3 control-label">Operación (opcional)</label>
                              <div class="col-sm-6">
                                    <input type="text" name="operacao" class="form-control" value="<?php echo $conta->operacao;?>">
                              </div>
                          </div>

                          <div class="form-group">
                              <label class="col-sm-3 control-label">Tipo de Cuenta</label>
                              <div class="col-sm-6">
                                    <input type="radio" name="tipo_conta" value="1" <?php echo ($conta->tipo == 1) ? 'checked' : '';?>> Conta Corriente
                                    <input type="radio" name="tipo_conta" value="2" <?php echo ($conta->tipo == 2) ? 'checked' : '';?>> Conta de Ahorro
                              </div>
                          </div>

                          <div class="form-group">
                              <label class="col-sm-3 control-label">Titular</label>
                              <div class="col-sm-6">
                                    <input type="text" name="titular" class="form-control" value="<?php echo $conta->titular;?>">
                              </div>
                          </div>

                          <div class="form-group">
                              <label class="col-sm-3 control-label">WALLET/CNPJ</label>
                              <div class="col-sm-6">
                                    <input type="text" name="documento" class="form-control" value="<?php echo $conta->documento;?>">
                              </div>
                          </div>

                          </div>

                          <div id="box_bitcoin" style="display:<?php echo ($conta->categoria_conta == 2) ? 'block' : 'none';?>;">
                            
                            <div class="form-group">
                              <label class="col-sm-3 control-label">Cartera</label>
                              <div class="col-sm-6">
                                    <input type="text" name="carteira" class="form-control" value="<?php echo $conta->carteira_bitcoin;?>">
                              </div>
                          </div>

                          </div>

                          <div class="form-group">
                              <label class="col-sm-3 control-label">&nbsp;</label>
                              <div class="col-sm-6">
                                    <input type="submit" name="submit" class="btn btn-success" value="Editar Cuenta">
                              </div>
                          </div>

                        </form>

                        </div>
                    </section>
                </div>
            </div>

        </div>

    </div>
</div>
<!--main content end-->