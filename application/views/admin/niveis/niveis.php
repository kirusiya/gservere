<!--main content start-->
<div id="content" class="ui-content">
    <div class="ui-content-body">
        <div class="ui-container">
            <!--page title and breadcrumb start -->
            <div class="row">
                <div class="col-md-8">
                    <h1 class="page-title"> Niveles
                        <small>todos los niveles de indicación del sistema</small>
                    </h1>
                </div>
                <div class="col-md-4">
                    <ul class="breadcrumb pull-right">
                        <li>Home</li>
                        <li>Niveles</li>
                        <li><a href="<?php echo base_url('admin/niveis');?>" class="active">Todos lo Niveles</a></li>
                    </ul>
                </div>
            </div>
            <!--page title and breadcrumb end -->

            <div class="row">
              <div class="col-sm-12">
                  <section class="panel">
                      <div class="panel-body">
                          
                          <a href="<?php echo base_url('admin/niveis/adicionar');?>" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Nuevo Nível</a>
                          <div class="clearfix"></div>

                          <table class="table responsive-data-table table-striped">
                              <thead>
                              <tr>
                                  <th>
                                      Nivel
                                  </th>
                                  <th>
                                      Porcentaje
                                  </th>
                                  <th>&nbsp;
                                      
                                  </th>
                                  
                              </tr>
                              </thead>
                              <tbody>
                              <?php
                              if($niveis !== false){
                                foreach($niveis as $nivel){
                              ?>
                              <tr>
                                  <td>
                                      <?php echo $nivel->nivel;?>º
                                  </td>
                                  <td>
                                      <?php echo $nivel->porcentagem;?>%
                                  </td>
                                  <td>
                                    <a class="btn btn-info" href="<?php echo base_url('admin/niveis/editar/'.$nivel->id);?>"><i class="fa fa-pencil"></i> Editar</a>
                                    <a class="btn btn-danger" href="<?php echo base_url('admin/niveis/excluir/'.$nivel->id);?>"><i class="fa fa-times"></i> Excluir</a>
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