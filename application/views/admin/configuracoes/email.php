<!--main content start-->
<div id="content" class="ui-content">
    <div class="ui-content-body">
        <div class="ui-container">
            <!--page title and breadcrumb start -->
            <div class="row">
                <div class="col-md-8">
                    <h1 class="page-title"> Configuraciones de email
                        <small>todas las configuraciones de email</small>
                    </h1>
                </div>
                <div class="col-md-4">
                    <ul class="breadcrumb pull-right">
                        <li>Inicio</li>
                        <li>configuraciones email</li>
                        <li><a href="<?php echo base_url('admin/configuracoes/site');?>" class="active">configuraciones de email</a></li>
                    </ul>
                </div>
            </div>
            <!--page title and breadcrumb end -->
            
            <!-- page start-->
            <div class="row">
                <div class="col-sm-12">
                    <section class="panel">
                        <div class="panel-body">

                        <form action="" method="post" class="form-horizontal form-variance" enctype="multipart/form-data">
                          
                          <?php if(isset($message)) echo $message;?>
                          
                          <div class="form-group">
                              <label class="col-sm-3 control-label">Correo electrónico del remitente</label>
                              <div class="col-sm-6">
                                    <input type="text" name="email_remetente" class="form-control" value="<?php echo ConfiguracoesSistema('email_remetente');?>" required>
                              </div>
                          </div>

                          <div class="form-group">
                              <label class="col-sm-3 control-label">¿Usar SMTP?</label>
                              <div class="col-sm-6">
                                    <input type="radio" name="smtp" value="1" <?php echo (ConfiguracoesSistema('smtp_enabled') == 1) ? 'checked' : '';?>> Si
                                    <input type="radio" name="smtp" value="0" <?php echo (ConfiguracoesSistema('smtp_enabled') == 0) ? 'checked' : '';?>> No
                              </div>
                          </div>

                          <div id="configuracoes_smtp" style="display:<?php echo (ConfiguracoesSistema('smtp_enabled') == 1) ? 'block' : 'none';?>">

                            <div class="form-group">
                                <label class="col-sm-3 control-label">SMTP Host</label>
                                <div class="col-sm-6">
                                      <input type="text" name="smtp_host" class="form-control" value="<?php echo ConfiguracoesSistema('smtp_host');?>">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">SMTP User</label>
                                <div class="col-sm-6">
                                      <input type="text" name="smtp_user" class="form-control" value="<?php echo ConfiguracoesSistema('smtp_user');?>">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">SMTP Password</label>
                                <div class="col-sm-6">
                                      <input type="password" name="smtp_pass" class="form-control" value="<?php echo ConfiguracoesSistema('smtp_pass');?>">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">SMTP Port</label>
                                <div class="col-sm-6">
                                      <input type="text" name="smtp_port" class="form-control" value="<?php echo ConfiguracoesSistema('smtp_port');?>">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">SMTP Encrypt</label>
                                <div class="col-sm-6">
                                      <input type="text" name="smtp_encrypt" class="form-control" value="<?php echo ConfiguracoesSistema('smtp_encrypt');?>">
                                </div>
                            </div>

                          </div>

                          <div class="form-group">
                              <label class="col-sm-3 control-label">&nbsp;</label>
                              <div class="col-sm-6">
                                    <input type="submit" name="submit" class="btn btn-success" value="Actualizar configuraciones">
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