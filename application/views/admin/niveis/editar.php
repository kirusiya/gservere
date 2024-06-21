<!--main content start-->
<div id="content" class="ui-content">
    <div class="ui-content-body">
        <div class="ui-container">
            <!--page title and breadcrumb start -->
            <div class="row">
                <div class="col-md-8">
                    <h1 class="page-title"> Editar nivel
                        <small>editar un nivel registrado</small>
                    </h1>
                </div>
                <div class="col-md-4">
                    <ul class="breadcrumb pull-right">
                        <li>Inicio</li>
                        <li>Nivel</li>
                        <li><a href="<?php echo base_url('admin/niveis/editar/'.$this->uri->segment(4));?>" class="active">Editar Nível</a></li>
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
                              <label class="col-sm-3 control-label">Posición del Nivel</label>
                              <div class="col-sm-6">
                                    <input type="text" name="nivel" class="form-control" value="<?php echo $nivel->nivel;?>" required>
                              </div>
                          </div>

                          <div class="form-group">
                              <label class="col-sm-3 control-label">Porcentaje</label>
                              <div class="col-sm-6">
                                    <input type="text" name="porcentagem" class="form-control" value="<?php echo $nivel->porcentagem;?>" required>
                              </div>
                          </div>


                          <div class="form-group">
                              <label class="col-sm-3 control-label">&nbsp;</label>
                              <div class="col-sm-6">
                                    <input type="submit" name="submit" class="btn btn-success" value="Editar Plan">
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