<!--main content start-->
<div id="content" class="ui-content">
    <div class="ui-content-body">
        <div class="ui-container">
            <!--page title and breadcrumb start -->
            <div class="row">
                <div class="col-md-8">
                    <h1 class="page-title"> Agregar plan
                        <small>agregar un nuevo plan</small>
                    </h1>
                </div>
                <div class="col-md-4">
                    <ul class="breadcrumb pull-right">
                        <li>Inicio</li>
                        <li>Planes</li>
                        <li><a href="<?php echo base_url('admin/planos/adicionar');?>" class="active">Agregar plan</a></li>
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
                              <label class="col-sm-3 control-label">Nombre del plan</label>
                              <div class="col-sm-6">
                                    <input type="text" name="nome" class="form-control" required>
                              </div>
                          </div>

                          <div class="form-group">
                              <label class="col-sm-3 control-label">Precio del Plan</label>
                              <div class="col-sm-6">
                                    <input type="text" id="valor" name="valor" class="form-control" required>
                              </div>
                          </div>
							
						  <div class="form-group">
                              <label class="col-sm-3 control-label">Calcular Max<br>
								  <small><strong>(Copiar esto al Max 300%)</strong></small>
							  </label>
							  
                              <div class="col-sm-6">
                                    <input type="text" id="calculate" name="calculate" class="form-control">
                              </div>
                          </div>	
							
						  <div class="form-group">
                              <label class="col-sm-3 control-label">Max 300%</label>
                              <div class="col-sm-6">
                                    <input type="text" id="ganhos_maximo" name="ganhos_maximo" class="form-control" required>
                              </div>
                          </div>	

                          <div class="form-group">
                              <label class="col-sm-3 control-label">Porcentaje binario</label>
                              <div class="col-sm-6">
                                    <input type="text" name="binario" class="form-control" required>
                              </div>
                          </div>

                          <div class="form-group">
                              <label class="col-sm-3 control-label">Puntos para el plan de carrera</label>
                              <div class="col-sm-6">
                                    <input type="text" name="pontos" class="form-control" required>
                              </div>
                          </div>

                          <div class="form-group">
                              <label class="col-sm-3 control-label">Red de afiliados</label>
                              <div class="col-sm-6">
                                    <input type="radio" name="rede" value="1" checked> Yes
                                    <input type="radio" name="rede" value="0"> No
                              </div>
                          </div>

                          <div class="form-group">
                              <label class="col-sm-3 control-label">Maximo Binary</label>
                              <div class="col-sm-6">
                                    <input type="text" name="teto_binario" class="form-control" required>
                              </div>
                          </div>

                          <div class="form-group">
                              <label class="col-sm-3 control-label">Ganancias diarias</label>
                              <div class="col-sm-6">
                                    <input type="text" name="ganhos_diarios" class="form-control" required>
                              </div>
                          </div>

                          <div class="form-group">
                              <label class="col-sm-3 control-label">Plan recomendado?</label>
                              <div class="col-sm-6">
                                    <input type="radio" name="recomendado" value="1"> Si
                                    <input type="radio" name="recomendado" value="0" checked> No
                              </div>
                          </div>
							
						  <div class="form-group">
                              <label class="col-sm-3 control-label">Plan Image </label>
                              <div class="col-sm-6">
                                    
                 					<input type="hidden" id="img" name="img_plan" value="" >
                 					<div id="fileuploader">Subir Plan image</div>
									<div id="eventsmessage"></div>
								  
                              </div>
                          </div>		

                          <div class="form-group">
                              <label class="col-sm-3 control-label">&nbsp;</label>
                              <div class="col-sm-6">
                                    <input type="submit" name="submit" class="btn btn-success" value="Registrar Plan">
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