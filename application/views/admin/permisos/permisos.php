<!--main content start-->
<script src="<?php echo  base_url() ?>assets/permisos/jquery.js"></script>
<script type="text/javascript" src="<?php echo  base_url() ?>assets/permisos/permisos.js"></script>
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
                          <table id="tablaUsuarios" class="table responsive-data-table table-striped">
                              <thead>
                              <tr>
                                  <th>
                                      Nro.
                                  </th>
                                  <th>
                                      Nombre
                                  </th>
                                  <th>
                                      Correo
                                  </th>
                                  <th>
                                      Celular
                                  </th>
                                  <th>
                                      Login
                                  </th>
                                  <th>
                                      Opciones
                                  </th>
                                  
                              </tr>
                              </thead>
                              
                          </table>
                      </div>
                  </section>
              </div>

          </div>

        </div>

    </div>
</div>


<div class="modal fade" id="editarRoles" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header navbar-inverse">
                <h4 class="modal-title" id="exampleModalLabel">EDITAR PERMISOS DE USUARIOS</h4>
            </div>
            <div class="modal-body">
              <h4 class="modal-title" id="exampleModalLabel"><strong> EDITAR PERMISOS DE USUARIOS </strong></h4>
                <form id="formularioPermisos">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <input type="hidden" class="form-control" id="txtDato" name="txtDato">
                                <label>LISTADO DE ROLES</label>
                                <div id="listadoPermisos"></div>  
                            </div>
                        </div>
                    </div> 
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cerrar</button>
                <button id="rechazar" type="button" class="btn btn-primary" onclick="guardarDAtos();"><span class="glyphicon glyphicon-floppy-disk"></span> Guardar Cambios</button>
            </div>
        </div>
    </div>
</div>
<!--main content end-->
<!--main content end-->
<script type="text/javascript">
    $(document).ready(function(){
        var enlace = "<?php echo  base_url() ?>";
        baseurl(enlace);
        cargaFunciones();        
    });

</script>