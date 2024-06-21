<!--main content start-->
<div id="content" class="ui-content">
    <div class="ui-content-body">
        <div class="ui-container">
            <!--page title and breadcrumb start -->
            <div class="row">
                <div class="col-md-8">
                    <h1 class="page-title"> Facturas a Liberar
                        <small>facturas que tienes que liberar</small>
                    </h1>
                </div>
                <div class="col-md-4">
                    <ul class="breadcrumb pull-right">
                        <li>Inicio</li>
                        <li>Facturas</li> 
                        <li><a href="<?php echo base_url('admin/faturas/liberar');?>" class="active">Para Liberar</a></li>
                    </ul>
                </div>
            </div>
            <!--page title and breadcrumb end -->

            <div class="row">
              <div class="col-sm-12">
				  
				  <?php
				  if(isset($_GET['eliminar']) and $_GET['eliminar']!=""){
					  
					  $idFactura = $_GET['eliminar'];
					  
					  $this->db->where('id', $idFactura);
					  $this->db->delete('faturas');
					  
					  $baseUrlFacturas = base_url('admin/faturas/liberar/');
					  
					  ?>
				  
				  		<div class="alert alert-success text-center">Factura eliminada Correctamente</div>
				  
				  		<script>
				  		setTimeout(function(){
							window.location.href = '<?php echo $baseUrlFacturas;?>'
						}, 2000);
				  
				  		</script>
				  	  <?php	
					  
				  }
				  
				  ?>
				  
				  
				  
                  <section class="panel">
                      <div class="panel-body">
                          <?php if(isset($message)) echo $message; ?>
                          
                          <table class="table responsive-data-table table-striped">
                              <thead>
                              <tr>
                                  <th>
                                      Nombre completo
                                  </th>
                                  <th>
                                      Login
                                  </th>
                                  <th>
                                      Plan
                                  </th>
								  
								  <th>
                                      Tipo de Plan
                                  </th>
								  
                                  <th>
                                      Valor
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
                                      <?php 
										$tipoDePlan = $fatura->description;
										$textTipoPlan="";
										
										if($tipoDePlan!=""){
											
											if($tipoDePlan=="Free" || $tipoDePlan=="All Features"){
												
												$textTipoPlan= $tipoDePlan." (By Admin)";
												
											}else{
												$textTipoPlan= $tipoDePlan;
											}
											
										}
									
										echo $textTipoPlan;
									  
									  ?>
                                  </td>
								  
								  
                                  <td>
                                       <?php echo number_format($fatura->valor, 2, ",", "."); ?> USD
                                  </td>
                                  <td style="text-align: right">
									  
									
									  
									  
									  
									<select class="pagarPuntos form-control" data-id="<?php echo $fatura->id;?>" >
									    <option value="2">-- Seleccione una opción --</option>
									  	<option value="1">Pagar Puntos</option>
										<option value="0">No Pagar Puntos</option>
										
									</select>  

                                    
									  
									  
									<a class="btn btn-info" id="pagar-<?php echo $fatura->id;?>" 
									   href="#"><i class="fa fa-check"></i> Liberar</a>
									  
									<a class="btn btn-danger" onclick="return confirm('Esta seguro de eliminar esta factura? Es un proceso irreversible')"  
									   href="<?php echo base_url('admin/faturas/liberar/?eliminar='.$fatura->id);?>"><i class="fa fa-check"></i> Eliminar</a> 
									  
									  
									
									  
									<?php
									
									$hashtxt = $fatura->hashtxt;
									$bill = $fatura->bill;
									$bill2 = $fatura->bill2;
									
										
									if($fatura->coin == 'usdt'){
											
										
									?>
									  
									  
										
										<div style="margin-top: 10px;">
										
										<?php
											if($bill!=""){
										?>	
											
										<a class="btn btn-info" href="<?php echo base_url('uploads/').$bill;?>" target="_blank"><i class="fas fa-eye"></i> Ver Comprobante 1</a> 
									    
										<?php
											}
										?>
											
										<?php
											if($bill2!=""){
										?>	
											
										<a class="btn btn-info" href="<?php echo base_url('uploads/').$bill2;?>" target="_blank"><i class="fas fa-eye"></i> Ver Comprobante 2</a> 
									    
										<?php
											}
										?>	
											
										<?php
											if($hashtxt!=""){
										?>		
											
									  	<a class="btn btn-info" href="https://etherscan.io/tx/<?php echo $hashtxt;?>" target="_blank"><i class="fas fa-eye"></i> Verify on Etherscan</a> 
											
										<input type="text" class="form-control" value="<?php echo $hashtxt;?>" id="hashtxt">
										
										<a class="btn btn-dark" href="#0" onClick="kopiraj()"  >
											<i class="fas fa-copy"></i> Copiar Hash
										</a>
										
										<div class="alert hash alert-success" style="display: none; margin-top: 15px;">Hash Copiado correctamente!</div>
											
										<?php
											}
										?>	
											
										</div> 	
									  
									<?php
											
									}
									?>  
									  
									 
									 
									  
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