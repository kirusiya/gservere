<!--main content start-->
<div id="content" class="ui-content">
    <div class="ui-content-body">
        <div class="ui-container">
            <!--page title and breadcrumb start -->
            <div class="row">
                <div class="col-md-8">
                    <h1 class="page-title"> Notificaciones
                        <small>enviar notificaciones a los usuarios</small>
                    </h1>
                </div>
                <div class="col-md-4">
                    <ul class="breadcrumb pull-right">
                        <li>Inicio</li>
                        <li>Notificaciones</li>
                        <li><a href="<?php echo base_url('admin/notificacoes');?>" class="active">Enviar Notificaciones</a></li>
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
                              <label class="col-sm-3 control-label">Notificaciones</label>
                              <div class="col-sm-6">
                                    <textarea name="notificacao" class="form-control" cols="30" rows="5" required></textarea>
                              </div>
                          </div>
							
						  <div class="form-group">
                              <label class="col-sm-3 control-label">Notificaciones Imagen </label>
                              <div class="col-sm-6">
                                    
                 					<input type="hidden" id="img" name="icone" value="" >
                 					<div id="fileuploader">Subir una imagen</div>
									<div id="eventsmessage"></div>
								  
                              </div>
                          </div>	
							
							
						  <div class="form-group">
                              <label class="col-sm-3 control-label">Notificaciones Imagen Movil</label>
                              <div class="col-sm-6">
                                    
                 					<input type="hidden" id="img2" name="icone2" value="" >
                 					<div id="fileuploader2">Subir una imagen</div>
									<div id="eventsmessage2"></div>
								  
                              </div>
                          </div>	

                          <div class="form-group">
                              <label class="col-sm-3 control-label">&nbsp;</label>
                              <div class="col-sm-6">
                                    <input type="submit" name="submit" class="btn btn-success" value="Enviar Notificación">
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