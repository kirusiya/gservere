<!--main content start-->
<div id="content" class="ui-content">
    <div class="ui-content-body">
        <div class="ui-container">
            <!--page title and breadcrumb start -->
            <div class="row">
                <div class="col-md-8">
                    <h1 class="page-title"> Usuarios
                        <small>todos los usuarios registrados</small>
                    </h1>
                </div>
                <div class="col-md-4">
                    <ul class="breadcrumb pull-right">
                        <li>Inicio</li>
                        <li>Usuarios</li>
                        <li><a href="<?php echo base_url('admin/usuarios');?>" class="active">Todos los Usuarios</a></li>
                    </ul>
                </div>
            </div>
            <!--page title and breadcrumb end -->

            <div class="row">
              <div class="col-sm-12">
				  
				  
				  
				  
				  
                  <section class="panel">
                      <div class="panel-body">
						  
						  <?php
						  if(isset($_GET['user_id']) and $_GET['user_id']!=""){
							  
							  $user_id = $_GET['user_id'];
							  
							  $this->db->where('id', $user_id);
        					  $this->db->delete('usuarios');
							  
							  $this->db->where('id_usuario', $user_id);
        					  $this->db->delete('rede');
							  
							  $this->db->where('id_usuario', $user_id);
        					  $this->db->delete('rede_pontos_binario');
							  
							  $this->db->where('id_usuario', $user_id);
        					  $this->db->delete('usuarios_plano_carreira');
							  
							  
						  
						  
						  ?>
						  
						  <div class="alert alert-success text-center alert-dismissible" role="alert">
							  Usuario Eliminado Correctamente
							  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							  </button>
						  </div>
						  
						  
						  <?php
						  }
						  ?>
						  
						  
                          <table class="table responsive-data-table table-striped">
                              <thead>
                              <tr>
                                  <th>
                                      Nome
                                  </th>
                                  <th>
                                      Login
                                  </th>
                                  <th>
                                      Saldo Rendimentos
                                  </th>
                                  <th>
                                      Saldo Patrocinio
                                  </th>
                                  <th>
                                      Plano de Carreira
                                  </th>
                                  <th>
                                      Tipo Plan
                                  </th>
                                  <th>
                                      Retira
                                  </th>
                                  <th>&nbsp;
                                      
                                  </th>
                                  
                              </tr>
                              </thead>
                              <tbody>
                              <?php
                              if($usuarios !== false){
                                foreach($usuarios as $usuario){
                              ?>
                              <tr>
                                  <td>
                                      <?php echo $usuario->nome;?>
                                  </td>
                                  <td>
                                      <?php echo $usuario->login; ?>
                                  </td>
                                  <td>
                                      $us <?php echo number_format($usuario->saldo_rendimentos, 2, ",", "."); ?>
                                  </td>
                                  <td>
                                      $us <?php echo number_format($usuario->saldo_indicacoes, 2, ",", "."); ?>
                                  </td>
                                  <td>
                                      <?php echo PlanoCarreira($usuario->plano_carreira, 'nome'); ?>
                                  </td>
                                  <td>
                                     <?php echo usersPlanActive($usuario->id); ?>
                                  </td>
                                  <td>
                                     <?php echo $usuario->retira; ?>
                                  </td>
                                  <td>
                                    <a class="btn btn-success" href="<?php echo base_url('admin/usuarios/visualizar/'.$usuario->id);?>"><i class="fa fa-eye"></i> Visualizar</a>
                                    <a class="btn btn-info" href="<?php echo base_url('admin/usuarios/editar/'.$usuario->id);?>"><i class="fa fa-pencil"></i> Editar</a>

                                    <?php if($usuario->retira == 'SI')
                                    {?>
                                      <a class="btn btn-danger" href="<?php echo base_url('admin/usuarios/bloquear/'.$usuario->id);?>"><i class="fa fa-pencil"></i> Bloquear Retiro</a>                                      
                                    <?php }
                                    else{
                                      ?>
                                      <a class="btn btn-warning" href="<?php echo base_url('admin/usuarios/desbloquear/'.$usuario->id);?>"><i class="fa fa-pencil"></i> Desbloquear Retiro</a>
                                    
                                    <?php
                                    } ?>
									
									  
									<a class="btn btn-danger"  onclick="return confirm('Esta seguro de eliminar al usuario <?php echo $usuario->nome;?>? Ya que si elimina este usuario tiene que ser el ultimo del arbol, sino provocara errores en el posicionamiento del arbol')" 
									   href="<?php echo base_url('/admin/usuarios/?user_id='.$usuario->id);?>"><i class="fas fa-user-times"></i> Eliminar Usuario</a>   
                                    
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