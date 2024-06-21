<!--main content start-->
<div id="content" class="ui-content">
    <div class="ui-content-body">
        <div class="ui-container">
            <!--page title and breadcrumb start -->
            <div class="row">
                <div class="col-md-8">
                    <h1 class="page-title"> Editar usuario
                        <small>editar usuario</small>
                    </h1>
                </div>
                <div class="col-md-4">
                    <ul class="breadcrumb pull-right">
                        <li>Inicio</li>
                        <li>Usuario</li>
                        <li><a href="<?php echo base_url('admin/usuarios/editar/'.$this->uri->segment(4));?>" class="active">Editar usuario</a></li>
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
                          
                          <input type="submit" name="submit" class="btn btn-success pull-right" value="Actualizar datos de usuario">
                            <div class="clearfix"></div>

                          <ul  class="nav nav-pills">
                            <li class="active">
                              <a  href="#info" data-toggle="tab">Informacion del usuario</a>
                            </li>
                            <li><a href="#acesso" data-toggle="tab">Acesso</a>
                            </li>
                            <?php
                              if($isAdmin==1)
                              {
                            ?>
                            <li><a href="#financeiro" data-toggle="tab">Financeiro</a>
                            </li>
                            
                            <li><a href="#binario" data-toggle="tab">Binário</a>
                            </li>
                            <?php
                            }
                            ?>
                            </ul>

                            <?php if(isset($message)) echo '<br />'.$message;?>

                            <div class="tab-content clearfix">
                              <div class="tab-pane active" id="info">
                                
                                <div class="row">
                                  <h3 class="text-center">Información de registro</h3>
                                  
                                  <div class="form-group">
                                      <label class="col-sm-3 control-label">Nombre</label>
                                      <div class="col-sm-6">
                                            <input class="form-control u-rounded" name="nome" value="<?php echo $usuario['usuario']->nome;?>" type="text" required>
                                      </div>
                                  </div>

                                  <div class="form-group">
                                      <label class="col-sm-3 control-label">Email</label>
                                      <div class="col-sm-6">
                                            <input class="form-control u-rounded" name="email" value="<?php echo $usuario['usuario']->email;?>" type="email" required>
                                      </div>
                                  </div>

                                  <div class="form-group">
                                      <label class="col-sm-3 control-label">WALLET</label>
                                      <div class="col-sm-6">
                                            <input  class="form-control u-rounded" name="cpf" value="<?php echo $usuario['usuario']->cpf;?>" type="text">
                                      </div>
                                  </div>
									
									

                                  <div class="form-group">
                                      <label class="col-sm-3 control-label">Celular</label>
                                      <div class="col-sm-6">
                                            <input class="form-control u-rounded" name="celular"  value="<?php echo $usuario['usuario']->celular;?>" type="text">
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-3 control-label">Administrador</label>
                                      <div class="col-sm-6">
                                            <input type="radio" name="is_admin" value="2" <?php echo ($usuario['usuario']->is_admin == 2) ? 'checked' : '';?>> Si
                                            <input type="radio" name="is_admin" value="0" <?php echo ($usuario['usuario']->is_admin == 0) ? 'checked' : '';?>> No
                                      </div>
                                  </div>
									
									
								  <div class="form-group">
                                      <label class="col-sm-3 control-label">Lado Binario</label>
                                      <div class="col-sm-6">
										  
										  
										  <?php
											$ladoIzq = "";
										  	$ladoDer = "";
											$ladoBinario = verLadoPatroDirecto($usuario['usuario']->id);
											if($ladoBinario){
												
												$ladoRed = $ladoBinario[0]->chave_binaria;
												
												if($ladoRed==1){
													
													$ladoIzq = "selected";
												}
												
												if($ladoRed==2){
													
													$ladoDer = "selected";
												}
												
												
										   ?>
										  <label>OJO, mucho cuidado puedes mover toda una red al otro lado, tambien puedes superponer a otro usuario que ya ocupa en lado derecho y este usuario no aparecera en la red</label>
										  
										  <select class="form-control u-rounded" name="chave_binaria">
											  
											  
											  
											  <option value="1" <?php echo $ladoIzq;?> >Izquierdo</option>
											  <option value="2"  <?php echo $ladoDer;?> >Derecho</option>
										  
										  </select>
											
											 
										  
										  <?php
											  
											}	
	
										   ?>  
										  
													  
                                            
                                      </div>
                                  </div>	
									
								  <!-- manuel -->
								
								  <div class="form-group">
                                      <label class="col-sm-3 control-label">Two Factor</label>
                                      <div class="col-sm-6">
                                            <input type="checkbox" name="twofactor" value="1" <?php echo ($usuario['usuario']->active_twofactor == 1) ? 'checked' : '';?>> Active
                                      </div>
                                  </div>	
									
								  <!-- manuel --> 	
									
									
                                </div>

                              </div>
                              <div class="tab-pane" id="acesso">
                                <div class="row">
                                  <h3 class="text-center">Acesso</h3>
                                  
                                  <div class="form-group">
                                      <label class="col-sm-3 control-label">Login</label>
                                      <div class="col-sm-6">
                                            <input class="form-control u-rounded" name="login" value="<?php echo $usuario['usuario']->login;?>" type="text" required>
                                      </div>
                                  </div>

                                  <div class="form-group">
                                      <label class="col-sm-3 control-label">Contraseña</label>
                                      <div class="col-sm-6">
                                            <input class="form-control u-rounded" name="senha" type="password" value="" autocomplete="off">
                                      </div>
                                  </div>

                                  <div class="form-group">
                                      <label class="col-sm-3 control-label">Bloqueado</label>
                                      <div class="col-sm-6">

                                            <input type="radio" name="block" value="1" <?php echo ($usuario['usuario']->block == 1) ? 'checked' : '';?>> Sim
                                            <input type="radio" name="block" value="0" <?php echo ($usuario['usuario']->block == 0) ? 'checked' : '';?>> Não
                                      </div>
                                  </div>
                                </div>
                              </div>
                              <div class="tab-pane" id="financeiro">
                                <div class="row">
                                  <h3 class="text-center">Financeiro</h3>
                                  
                                  <div class="form-group">
                                      <label class="col-sm-3 control-label">Bono Binario</label>
                                      <div class="col-sm-6">
                                            <input class="form-control u-rounded" name="binarios_dia" value="<?php echo $usuario['usuario']->binarios_dia;?>" type="text" required>
                                      </div>
                                  </div>
									
									
								  <div class="form-group">
                                      <label class="col-sm-3 control-label">Rendimientos</label>
                                      <div class="col-sm-6">
                                            <input class="form-control u-rounded" name="saldo_rendimentos" value="<?php echo $usuario['usuario']->saldo_rendimentos;?>" type="text" required>
                                      </div>
                                  </div>	

                                  <div class="form-group">
                                      <label class="col-sm-3 control-label">Bono Referido Directo</label>
                                      <div class="col-sm-6">
                                            <input class="form-control u-rounded" name="saldo_indicacoes" value="<?php echo $usuario['usuario']->saldo_indicacoes;?>" type="text" required>
                                      </div>
                                  </div>
									
									
                                </div>
                              </div>
                              <div class="tab-pane" id="binario">
                                <div class="row">
                                  <h3 class="text-center">Binário</h3>
                                  
                                  <div class="form-group">
                                      <label class="col-sm-3 control-label">Cantidad Binário</label>
                                      <div class="col-sm-6">
                                            <input class="form-control u-rounded" name="quantidade_binario" value="<?php echo $usuario['usuario']->quantidade_binario;?>" type="text" required>
                                            <span class="help-text">porcentaje de binario <b>%</b></span>
                                      </div>
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
<!--main content end-->