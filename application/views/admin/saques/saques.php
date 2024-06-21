<!--main content start-->

<?php $taxa_saque = ConfiguracoesSistema('taxa_saque');?>
<div id="content" class="ui-content">
    <div class="ui-content-body">
        <div class="ui-container">
            <!--page title and breadcrumb start -->
            <div class="row">
                <div class="col-md-8">
                    <h1 class="page-title"> Retiros
                        <small>Todos los Retiros</small>
                    </h1>
                </div>
                <div class="col-md-4">
                    <ul class="breadcrumb pull-right">
                        <li>Inicio</li>
                        <li>Retiros</li>
                        <li><a href="<?php echo base_url('admin/saques');?>" class="active">Todos los Retiros</a></li>
                    </ul>
                </div>
            </div>
            <!--page title and breadcrumb end -->
<?php $valorBTc = ConfiguracoesSistema('btc');?>
            <div class="row">
			
		    	
				
				
				
              <div class="col-sm-12">
                  <section class="panel">
                      <div class="panel-body">
						  
						  <a href="#0" id="payBlock" onClick="alert('Test mode \r\nWorking test mode block.io correctly')" class="btn btn-success pull-right "><i class="fas fa-dollar-sign"></i> Pagar con Block.io</a>
						  
                          <table class="table responsive-data-table table-striped">
                              <thead>
                              <tr>
                                  <th>
                                      Login  
                                  </th>
								  
								  <th>
                                      Wallet 
                                  </th>
                                  <th>
                                      Recibir en
                                  </th>
                                  <th>
                                      Pagar
                                  </th>
                                  <th>
                                      Solicitado
                                  </th>
								  
								  <th>
                                      USTD
                                  </th>
								  
								   <th>
                                      Tipo Retiro
                                  </th>
								  
                                  <th>
                                      Estado
                                  </th>
								  
								  <th>
                                      Fecha para pagar
                                  </th>
								  
                                  <th>
                                      Fecha de peticion
                                  </th>
                                  <th>&nbsp;
                                      
                                  </th>
                                  
                              </tr>
                              </thead>
                              <tbody>
                              <?php
                              if($saques !== false){
                                foreach($saques as $saque){
                              ?>
                              <tr>
                                  <td>
                                      <?php echo InformacoesUsuario('login', $saque->id_usuario);?>
                                  </td>
								  
								  <td>
									  <?php
										$walletSaque = InformacoesUsuario('cpf', $saque->id_usuario);
									  ?>	
									  
									  
									  <a href="https://etherscan.io/address/<?php echo $walletSaque; ?>" 
										 target="_blank">
										  <?php echo $walletSaque;?>
									  </a>
                                      
                                  </td>
								  
                                  <td>USDT BEP20
                                      <!--<?php echo ($saque->local_recebimento == 1) ? 'Wallet Usuario' : 'Wallet Usuario'; ?>-->
                                  </td>
                                  <td>
                                      USD <?php $val_sol = ($saque->valor_solicitado - ($saque->valor_solicitado * $taxa_saque) / 100); 
									echo number_format($val_sol, 2, ",", ".");	 ?>
                                  </td>
								  <td>
                                      USD <?php echo number_format($saque->valor_solicitado, 2, ",", "."); ?>
                                  </td>
								  
								  <td>
                                      <?php 
										$saqueBTC = $saque->valor;
										$amountBTC = $saque->valor / $valorBTc; 
									    echo round($amountBTC, 8);
									  ?>
                                  </td>
								  <td>
                                      <?php 
									  if($saque->tipo_saque == 1){
										  echo 'Daily Bonus';
									  }elseif($saque->tipo_saque == 3){
										  echo 'Binario';
									  }else{
										  echo ' Referral Bonus';
									  }
									  ?>
                                  </td>
								  
                                  <td>
                                      <?php
                                      if($saque->status == 0){
                                        echo '<span class="text-warning">Pendiente</span>';
                                      }elseif($saque->status == 1){
                                        echo '<span class="text-success">Pagado</span>';
                                      }else{
                                        echo '<span class="text-danger">Revertido</span>';
                                      }
                                      ?>
                                  </td>
								  
								  <td>
									<?php
									$timePay = $saque->time_pay;
									if($timePay==""){
										$timePay="No Data";	
									}
									?>
                                    <?php echo $timePay;?>
                                  </td>
								  
                                  <td>
                                    <?php echo date('d/m/Y H:i:s', strtotime($saque->data_pedido));?>
                                  </td>
                                  <td>
                                    <a href="<?php echo base_url('admin/saques/visualizar/'.$saque->id);?>">Ver Datos</a>
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