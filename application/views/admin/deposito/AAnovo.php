<!--main content start-->
<div id="content" class="ui-content">
    <div class="ui-content-body">
        <div class="ui-container">
            <!--page title and breadcrumb start -->
            <div class="row">
                <div class="col-md-8">
                    <h1 class="page-title"> Adicionar método de pago
                        <small>adicionar una nueva cuenta</small>
                    </h1>
                </div>
                <div class="col-md-4">
                    <ul class="breadcrumb pull-right">
                        <li>Home</li>
                        <li>Financiero</li>
                        <li><a href="<?php echo base_url('admin/carreira/adicionar');?>" class="active">Adicionar cuenta para pago</a></li>
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
                                    <input type="radio" name="tipo" value="1" checked> Cuenta Bancaria
                                    <input type="radio" name="tipo" value="2"> Bitcoin
                              </div>
                          </div>

                          <div id="box_conta_bancaria" style="display:block;">
                            
                            <div class="form-group">
                              <label class="col-sm-3 control-label">Banco</label>
                              <div class="col-sm-6">
                                    <select name="banco" class="form-control">
                                      <?php
                                      foreach(Bancos() as $banco){
                                        echo '<option value="'.$banco['code'].'">'.$banco['code'].' - '.$banco['name'].'</option>';
                                      }
                                      ?>
                                    </select>
                              </div>
                          </div>

                          <div class="form-group">
                              <label class="col-sm-3 control-label">Agencia</label>
                              <div class="col-sm-6">
                                    <input type="text" name="agencia" class="form-control">
                              </div>
                          </div>

                          <div class="form-group">
                              <label class="col-sm-3 control-label">Cuenta</label>
                              <div class="col-sm-6">
                                    <input type="text" name="conta" class="form-control">
                              </div>
                          </div>

                          <div class="form-group">
                              <label class="col-sm-3 control-label">Operación (opcional)</label>
                              <div class="col-sm-6">
                                    <input type="text" name="operacao" class="form-control">
                              </div>
                          </div>

                          <div class="form-group">
                              <label class="col-sm-3 control-label">Tipo de Cuenta</label>
                              <div class="col-sm-6">
                                    <input type="radio" name="tipo_conta" value="1" checked> Cuenta Corriente
                                    <input type="radio" name="tipo_conta" value="2"> Cuenta de Ahorros
                              </div>
                          </div>

                          <div class="form-group">
                              <label class="col-sm-3 control-label">Titular</label>
                              <div class="col-sm-6">
                                    <input type="text" name="titular" class="form-control">
                              </div>
                          </div>

                          <div class="form-group">
                              <label class="col-sm-3 control-label">WALLET/CNPJ</label>
                              <div class="col-sm-6">
                                    <input type="text" name="documento" class="form-control">
                              </div>
                          </div>

                          </div>

                          <div id="box_bitcoin" style="display:none;">
                            
                            <div class="form-group">
                              <label class="col-sm-3 control-label">Cartera</label>
                              <div class="col-sm-6">
                                    <input type="text" name="carteira" class="form-control">
                              </div>
                          </div>

                          </div>

                          <div class="form-group">
                              <label class="col-sm-3 control-label">&nbsp;</label>
                              <div class="col-sm-6">
                                    <input type="submit" name="submit" class="btn btn-success" value="Adicionar Pago">
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