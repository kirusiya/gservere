<!--main content start-->
<div id="content" class="ui-content">
    <div class="ui-content-body">
        <div class="ui-container">
            <!--page title and breadcrumb start -->
            <div class="row">
                <div class="col-md-8">
                    <h1 class="page-title"> Configuración del sitio
                        <small>todas las configuraciones del sitio</small>
                    </h1>
                </div>
                <div class="col-md-4">
                    <ul class="breadcrumb pull-right">
                        <li>Inicio</li>
                        <li>configuraciones</li>
                        <li><a href="<?php echo base_url('admin/configuracoes/site');?>" class="active">configuraciones del sitio</a></li>
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
                              <label class="col-sm-3 control-label">Nombre del sitio</label>
                              <div class="col-sm-6">
                                    <input type="text" name="nome_site" class="form-control" value="<?php echo ConfiguracoesSistema('nome_site');?>" required>
                              </div>
                          </div>

                          <div class="form-group">
                              <label class="col-sm-3 control-label">Logo del sitio</label>
                              <div class="col-sm-6">
                                    <input type="file" name="logo" class="form-control">
                              </div>
                          </div>

                          <div class="form-group">
                              <label class="col-sm-3 control-label">Favicon</label>
                              <div class="col-sm-6">
                                    <input type="file" name="favicon" class="form-control">
                              </div>
                          </div>

                          <div class="form-group">
                              <label class="col-sm-3 control-label">Máximo de Wallets por cuenta</label>
                              <div class="col-sm-6">
                                    <input type="text" name="maximo_cpfs" class="form-control" value="<?php echo ConfiguracoesSistema('maximo_cpfs');?>" required>
                              </div>
                          </div>

                          <div class="form-group">
                              <label class="col-sm-3 control-label">Patrocinador Principal</label>
                              <div class="col-sm-6">
                                    <input type="text" name="login_patrocinador" class="form-control" value="<?php echo ConfiguracoesSistema('login_patrocinador');?>" required>
                              </div>
                          </div>

                          <div class="form-group">
                              <label class="col-sm-3 control-label">&nbsp;</label>
                              <div class="col-sm-6">
                                    <input type="submit" name="submit" class="btn btn-success" value="Actualizar configuración">
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