<!--main content start-->
<div id="content" class="ui-content">
    <div class="ui-content-body">
        <div class="ui-container">
            <!--page title and breadcrumb start -->
            <div class="row">
                <div class="col-md-8">
                    <h1 class="page-title"> Adicionar Plan a Usuarios
                        <small>todos los usuarios registrados</small>
                    </h1>
                </div>
                <div class="col-md-4">
                    <ul class="breadcrumb pull-right">
                        <li>Inicio</li>
                        <li>Usuarios</li>
                        <li><a href="<?php echo base_url('admin/addplan');?>" class="active">Todos los Usuarios</a></li>
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
                              <label class="col-sm-3 control-label">User</label>
                              <div class="col-sm-6">
                                    <input type="hidden" name="iduser" class="form-control" value="<?php echo $datoUser[0]->id;?>" readonly>
                                    <input type="text" name="descripcion" class="form-control" value="<?php echo $datoUser[0]->nome;?>" readonly>
                              </div>
                          </div>

                          <div class="form-group">
                              <label class="col-sm-3 control-label">Seleccione un Plan</label>
                              <div class="col-sm-6">                                    
                                    <select class="form-control" name="opcionPlan" class="opcionPlanAdmin" required>
                                        <option value="0">Seleccione una opción</option>
                                        <?php foreach($datoPlanes as $fila)
                                        {?>
                                            <option data-name="<?php echo $fila->nome; ?>" value="<?php echo $fila->id; ?>"><?php echo $fila->nome;?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
								  
								  
								  	<input type="hidden" id="nombrePlan" value="">
                              </div>
                          </div> 
							
						  <div class="form-group">
                              <label class="col-sm-3 control-label">Tipo de plan</label>
                              <div class="col-sm-6">                                    
                                    <select class="form-control" name="tipoPlan" class="opcionPlanAdmin" required>
                                        <option value="0">Seleccione una opción</option>
										<option value="0">Free</option>
										<option value="1">All Features</option>
                                        
										
                                    </select>
								  
								  
								  	<input type="hidden" id="nombrePlan" value="">
                              </div>
                          </div> 	

                          <div class="form-group">
                              <label class="col-sm-3 control-label">&nbsp;</label>
                              <div class="col-sm-6">                                    
                                    <input type="submit" name="submit" class="btn btn-success" value="Agregar Plan">
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