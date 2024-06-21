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
                        <li>Finance</li>
                        <li><a href="<?php echo base_url('faturas');?>" class="active">Faturas</a></li>
                    </ul>
                </div>
            </div>
            <!--page title and breadcrumb end -->
            
            <div class="row">
              <div class="col-md-6 col-sm-6">
                  <div class="panel short-states bg-danger">
                      <div class="pull-right state-icon">
                          <i class="fa fa-dollar"></i>
                      </div>
                      <div class="panel-body">
                          <h1 class="light-txt">$us <?php echo number_format(InformacoesUsuario('saldo_rendimentos'), 2, ",", ".");?></h1>
                          <strong class="text-uppercase">Profits</strong>
                      </div>
                  </div>
              </div>
              <div class="col-md-6 col-sm-6">
                  <div class="panel short-states bg-info">
                      <div class="pull-right state-icon">
                          <i class="fa fa-arrow-right"></i>
                      </div>
                      <div class="panel-body">
                          <h1 class="light-txt">$us <?php echo number_format(InformacoesUsuario('saldo_indicacoes'), 2, ",", ".");?></h1>
                          <strong class="text-uppercase">Indicação</strong>
                      </div>
                  </div>
              </div>
            </div>
            <!-- page start-->
            <div class="row">
                <div class="col-sm-12">
                    <section class="panel">
                        <div class="panel-body">

                        <form class="form-horizontal form-variance">

                          <div class="form-group">
                                <label class="col-sm-3 control-label">ID Invoice</label>
                                <div class="col-sm-6">
                                    <div class="col-sm-10">
                                      <input class="form-control u-rounded" id="id_fatura" type="text" style="margin-bottom:0">
                                      <span class="help-block">Enter the invoice ID you want to pay</span>
                                    </div>
                                    <div class="col-sm-2">
                                      <a href="javascript:void(0);" class="btn btn-success" id="searchInvoice"><i class="fa fa-search"></i> Buscar Fatura</a>
                                    </div>
                                </div>
                          </div>
                    
                          <div id="bloco_confirmacao" style="display:none;">

                            <div class="form-group">
                                  <label class="col-sm-3 control-label">Valor</label>
                                  <div class="col-sm-6">
                                      $us <span id="valor_fatura"></span>
                                  </div>
                            </div>

                            <div class="form-group">
                                  <label class="col-sm-3 control-label">Pay with</label>
                                  <div class="col-sm-6">

                                      <label class="radio-inline i-checks">
                                          <input name="forma_pagamento" id="forma_pagamento" value="1" type="radio" checked>
                                          <i></i> Profits
                                      </label>
                                      <label class="radio-inline i-checks">
                                          <input name="forma_pagamento" id="forma_pagamento" value="2" type="radio">
                                          <i></i> Referral Bonus
                                      </label>

                                  </div>
                            </div>

                            <div class="form-group">
                                  <label class="col-sm-3 control-label">&nbsp;</label>
                                  <div class="col-sm-6">
                                      <button type="button" id="finalizar_pagamento" class="btn btn-success"><i class="fa fa-check"></i> Fazer Pagamento</button>
                                  </div>
                            </div>

                          </div>
                          <input type="hidden" id="id_pay" value="" />
                        </form>

                        </div>
                    </section>
                </div>
            </div>

        </div>

    </div>
</div>
<!--main content end-->