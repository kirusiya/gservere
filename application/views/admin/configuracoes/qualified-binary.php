<!--main content start-->
<div id="content" class="ui-content">
    <div class="ui-content-body">
        <div class="ui-container">
            <!--page title and breadcrumb start -->
            <div class="row">
                <div class="col-md-8">
                    <h1 class="page-title"> Usuarios calificados
                        <small>Todos los usuarios calificados</small>
                    </h1>
                </div>
                <div class="col-md-4">
                    <ul class="breadcrumb pull-right">
                        <li>Inicio</li>
                        <li>Usuarios</li>
                        <li><a href="<?php echo base_url('admin/usuarios');?>" class="active">Todos los usuarios calificados</a></li>
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
                                      #
                                  </th>
								  
                                  
								  
                                  <th>
                                      Login usuario
                                  </th>
								  
								  <th>
                                      Email usuario
                                  </th>
								  
                                  <th>
                                      Fecha Registro
                                  </th>
                                  <th>&nbsp;
                                      
                                  </th>
                                  
                              </tr>
                              </thead>
                              <tbody>
                              <?php
								  
								$calificadores = getQualifiedUser();
							  	  
                                if($calificadores){
								    $cont = 0;
                                    foreach($calificadores as $calificador){
									
                                        $login_user = InformacoesUsuario('login', $calificador->id_usuario);
                                        $email_user = InformacoesUsuario('email', $calificador->id_usuario);
                                        if(!empty($login_user) || !empty($email_user)){
									
                                        $cont++;
                                        ?>
                                        <tr>
                                            
                                            <td>
                                                <?php echo $cont; ?>
                                            </td>
                                            
                                            
                                            
                                            <td>
                                                <?php echo InformacoesUsuario('login', $calificador->id_usuario); ?>
                                            </td>
                                            
                                            <td>
                                                <?php echo InformacoesUsuario('email', $calificador->id_usuario); ?>
                                            </td>
                                            
                                            <td>
                                                <?php echo $calificador->date; ?>
                                            </td>
                                            
                                            
                                            
                                            <td>
                                                
                                                <a class="btn btn-info" href="<?php echo base_url('admin/qualified/editar/'.$calificador->id_usuario);?>"><i class="fa fa-pencil"></i> Ver usuario</a>                                    
                                                
                                            </td>
                                        </tr>
                                        <?php
                                        }
                                    
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