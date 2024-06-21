<!--main content start-->
<div id="content" class="ui-content">
    <div class="ui-content-body">
        <div class="ui-container">
            <!--page title and breadcrumb start -->
            <div class="row">
                <div class="col-md-8">
                    <h1 class="page-title"> Ver usuario calificado
                        <small>Ver puntos Usuario Calificado</small>
                    </h1>
                </div>
                <div class="col-md-4">
                    <ul class="breadcrumb pull-right">
                        <li>Inicio</li>
                        <li>Ver puntos Usuario</li>
                        <li><a href="<?php echo base_url('admin/usuarios');?>" class="active">Ver puntos Usuario</a></li>
                    </ul>
                </div>
            </div>
            <!--page title and breadcrumb end -->

            <div class="row">
              <div class="col-sm-12">
                  <section class="panel">
                      <div class="panel-body">
						  <?php
						  
						  $ladoCal = "None";
						  if($usuarioscal[0]->chave_binaria == 1){
							  
							  $ladoCal = "Registrado en la Posición Izquierda";
							  
						  }
						  
						  if($usuarioscal[0]->chave_binaria == 2){
							  
							  $ladoCal = "Registrado en la Posición Derecha";
							  
						  }
						  
						  ?>
						  <h2 style="text-align: center"><strong><?php echo $ladoCal;?></strong></h2>
						  
                          <table class="table responsive-data-table table-striped">
                              <thead>
                              <tr>
                                  <th>
                                      Puntos de donante de usuario
                                  </th>
								  
								  <th>
                                      Nombre
                                  </th>
								  
                                  <th>
                                      Puntos totales
                                  </th>
								  
								  <th>
                                      Binario
                                  </th>
                                  
                                  <th>
                                      Calificado
                                  </th>
								  
								  <th>
                                      Fecha calificado
                                  </th>
                                   
                                   
                                  
                                  
                              </tr>
                              </thead>
                              <tbody>
                              <?php
								  
							  	  
								  
                              if($usuarios !== false){
								  
								  $pointsLeft = 0;
								  $pointsRight = 0;
								  $pointsTotal = 0;
                                foreach($usuarios as $user){
									
									$pointsTotal += $user->puntos;
									
                              ?>
                              <tr>
                                  <td>
                                      <?php echo InformacoesUsuario('login', $user->id_user_giver); ?>
                                  </td>
                                  <td>
                                      <?php echo InformacoesUsuario('login', $user->id_usuario); ?>
                                  </td>
								  
								  
                                  <td>
                                      <?php echo $user->puntos;?>
                                  </td>
								  
								  <td>
                                      <?php 
									
										
									
										if($user->clave_binaria == 1){
											$textoChave ="Left";
										}
									
										if($user->clave_binaria == 2){
											$textoChave ="Right";
										}
									
										echo $user->clave_binaria." | ".$textoChave;
									  
									  ?>
                                  </td>
								  
								  <td>
                                      <?php echo $user->calificador;?>
                                  </td>
								   
								  
                                  <td>
                                      <?php echo $user->date;?>
                                  </td>
                                   
                                  
                              </tr>
                              <?php
                                }
								  
								 $totalPoints =  $pointsTotal;
								?>
								<tr>
								
									<td colspan="6" style="text-align: center"><strong>Total de puntos finales: <?php echo $totalPoints;?></strong></td>
										
								  
								</tr>  
								<?php  
								  
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