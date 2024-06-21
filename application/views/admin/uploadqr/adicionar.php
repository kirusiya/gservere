<!--main content start-->
<div id="content" class="ui-content">
    <div class="ui-content-body">
        <div class="ui-container">
            <!--page title and breadcrumb start -->
            <div class="row">
                <div class="col-md-8">
                    <h1 class="page-title"> Añadir imagen Qr
                        
                    </h1>
                </div>
                <div class="col-md-4">
                    <ul class="breadcrumb pull-right">
                        <li>Inicio</li>
                        <li>Subir QR</li>
                        <li><a href="<?php echo base_url('admin/uploadqr/adicionar');?>" class="active">Añadir imagen Qr</a></li>
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
                              <label class="col-sm-3 control-label">Descripcion</label>
                              <div class="col-sm-6">
                                    <input type="text" name="descripcion" class="form-control" required>
                              </div>
                          </div>
							
						  <div class="form-group">
                              <label class="col-sm-3 control-label">QR Imagen </label>
                              <div class="col-sm-6">
                                    
                 					<input type="hidden" id="img" name="img_qr" value="" required>
                 					<div id="fileuploader">Subir Imagen QR</div>
									<div id="eventsmessage"></div>
								  
                              </div>
                          </div>		
                          <div class="form-group">
                              <label class="col-sm-3 control-label">Estado QR</label>
                              <div class="col-sm-6">
                                    <input type="radio" name="estado" value="1" checked> Active
                                    <input type="radio" name="estado" value="0"> Inactive
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-3 control-label">&nbsp;</label>
                              <div class="col-sm-6">
                                    <input type="submit" name="submit" class="btn btn-success" value="Guardar QR">
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