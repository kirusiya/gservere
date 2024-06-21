<!--main content start-->
<div id="content" class="ui-content">
   <div class="ui-content-body">
      <div class="ui-container">
         <!--page title and breadcrumb start -->
         <div class="row">
            <div class="col-md-8">
               <h1 class="page-title"> Configuraciones Financieras
                  <small>todas las configuraciones financieras</small>
               </h1>
            </div>
            <div class="col-md-4">
               <ul class="breadcrumb pull-right">
                  <li>Inicio</li>
                  <li>Configuraciones</li>
                  <li><a href="<?php echo base_url('admin/configuracoes/site');?>" class="active">configuraciones financieras</a></li>
               </ul>
            </div>
         </div>
         <!--page title and breadcrumb end -->
         <!-- page start-->
         <div class="row">
            <div class="col-sm-12">
               <section class="panel">
                  <div class="panel-body">
                     <form action="" method="post" class="form-horizontal form-variance" enctype="multipart/form-data">
                        <input type="submit" name="submit" class="btn btn-success pull-right" value="Actualizar configuraciones">
                        <div class="clearfix"></div>
                        <ul  class="nav nav-pills">
                           <li class="active">
                              <a  href="#saques" data-toggle="tab">Retirar</a>
                           </li>
                           <!-- <li><a href="#indicacao" data-toggle="tab">Indicação</a>
                           </li> -->
                           <li><a href="#bonificacao" data-toggle="tab">Bonificación</a>
                           </li>
                           </li>
                        </ul>
                        <?php if(isset($message)) echo '<br/>'.$message;?>
                        <div class="tab-content clearfix">
                           <div class="tab-pane active" id="saques">
                              <div class="form-group">
                                 <label class="col-sm-3 control-label">Valor mínimo retirar saldo rendimentos</label>
                                 <div class="col-sm-6">
                                    <input type="text" name="valor_minimo_saque_rendimentos" class="form-control" value="<?php echo ConfiguracoesSistema('valor_minimo_saque_rendimentos');?>" required>
                                 </div>
                              </div>
                              <div class="form-group">
                                 <label class="col-sm-3 control-label">Valor mínimo retirar</label>
                                 <div class="col-sm-6">
                                    <input type="text" name="valor_minimo_saque_indicacoes" class="form-control" value="<?php echo ConfiguracoesSistema('valor_minimo_saque_indicacoes');?>" required>
                                 </div>
                              </div>
                              <div class="form-group">
                                 <label class="col-sm-3 control-label">Tasa de Retiro</label>
                                 <div class="col-sm-6">
                                    <input type="text" name="taxa_saque" class="form-control" value="<?php echo ConfiguracoesSistema('taxa_saque');?>" required>
                                 </div>
                              </div>
							   
							  <div class="form-group">
                                 <label class="col-sm-3 control-label">USDT</label>
                                 <div class="col-sm-6">
                                    <input type="number" name="btc" class="form-control" value="<?php echo ConfiguracoesSistema('btc');?>" required>
                                 </div>
                              </div> 
							   
							   
                              <button type="button" class="btn btn-info pull-right" id="addHorario"><i class="fa fa-plus"></i> Adicionar</button>
                              <div class="clearfix"></div>
                              <table class="table table-striped" id="tabelaPagamentos">
                                 <thead>
                                    <tr>
                                       <th>Dia de retiro</th>
                                       <th>Inicio</th>
                                       <th>Final</th>
                                       <th>&nbsp;</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <?php
                                       if($dias_saque !== false){
                                         foreach($dias_saque as $dias){
                                       ?>
                                    <tr>
                                       <td>
                                          <?php
                                             echo form_dropdown('dias[]', diasSemana(), $dias->dia_pagamento, array('class'=>'form-control'));
                                          ?>
                                       </td>
                                       <td>
                                          <input type="text" name="inicio[]" id="inicio" class="form-control" value="<?php echo $dias->horario_inicio;?>" />
                                       </td>
                                       <td>
                                          <input type="text" name="termino[]" id="termino" class="form-control" value="<?php echo $dias->horario_termino;?>" />
                                       </td>
                                       <td>
                                          <button type="button" id="ExcluirBloco" class="btn btn-danger"><i class="fa fa-times"></i> Excluir</button>
                                       </td>
                                    </tr>
                                    <?php
                                       }
                                       }
                                       ?>
                                 </tbody>
                              </table>
                           </div>
                           <!-- <div class="tab-pane" id="indicacao">
                              <div class="form-group">
                                 <label class="col-sm-3 control-label">Indicação direta <small>(em porcentagem)</small></label>
                                 <div class="col-sm-6">
                                    <input type="text" name="indicacao_direta" class="form-control" value="<?php echo ConfiguracoesSistema('indicacao_direta');?>" required>
                                 </div>
                              </div>
                           </div> -->
                           <div class="tab-pane" id="bonificacao">
                              <div class="form-group">
                                 <label class="col-sm-3 control-label">Porcentaje pagar por día</label>
                                 <div class="col-sm-6">
                                    <input type="number" step="0.01" name="porcentagem_dia" class="form-control" value="<?php echo ConfiguracoesSistema('porcentagem_dia');?>" required>
                                 </div>
                              </div>

                              <div class="form-group">
                                 <label class="col-sm-3 control-label">Cantidad de dias pagar</label>
                                 <div class="col-sm-6">
                                    <input type="text" name="quantidade_dias" class="form-control" value="<?php echo ConfiguracoesSistema('quantidade_dias');?>" required>
                                 </div>
                              </div>

                              <div class="form-group">
                                 <label class="col-sm-3 control-label">Pagar final de semana?</label>
                                 <div class="col-sm-6">
                                    <input type="radio" name="paga_final_semana" value="1" <?php echo (ConfiguracoesSistema('paga_final_semana') == 1) ? 'checked' : '';?>> Si
                                    <input type="radio" name="paga_final_semana" value="0" <?php echo (ConfiguracoesSistema('paga_final_semana') == 0) ? 'checked' : '';?>> No
                                 </div>
                              </div>
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
<!--main content end