<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Permisos extends CI_Controller {

    public function __construct(){
        parent::__construct();
        CheckUserIsAdmin();

        $this->load->model('admin/Permisosmodel','PermisosModel');
        $this->load->helper('bancos');
        $this->load->helper('permisos_helper');
    }

    public function index(){

        $idUsuario = $this->session->userdata('uid_admin');
        $valorOpcionBD = 20;
        $valorPermisoBD = 1;
        $permiso = verificarPermisosUsuario($idUsuario,$valorOpcionBD,$valorPermisoBD);
        if($permiso)
        {
            $data['jsLoader'] = array(
                                        'assets/bower_components/datatables.net/js/jquery.dataTables.min.js',
                                        'assets/bower_components/datatables-tabletools/js/dataTables.tableTools.js',
                                        'assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js',
                                        'assets/bower_components/datatables-colvis/js/dataTables.colVis.js',
                                        'assets/bower_components/datatables-responsive/js/dataTables.responsive.js',
                                        'assets/bower_components/datatables-scroller/js/dataTables.scroller.js'                                        
                                      );
            $data['usuarios'] = $this->PermisosModel->getListaUsuarios();
            //recuperar roles desde la variable de session DIEGO
            $data['rolescero'] = $this->session->userdata('rolescero');
            $data['roles']     = $this->session->userdata('roles');
            $this->template->load('admin/templates/template', 'admin/permisos/permisos', $data);


        }
        else
        {
            redirect('admin/dashboard');
        }
    }

    function cargarUsuarios()
    {
        $draw = intval($this->input->get("draw"));              
        
        $idUsuario = $this->session->userdata('uid_admin');
        $valorOpcionBD = 20;
        $valorPermisoBD = 1;
        $permiso = verificarPermisosUsuario($idUsuario,$valorOpcionBD,$valorPermisoBD);
        if($permiso)
        {
            $filas = $this->PermisosModel->getListaUsuarios();
        }
        else
        {
            $filas = array();
        }

        
        $data = array();
        $num = 1;
        foreach ($filas as $fila)
        {
            $boton = "";            
            $boton ="<span class='d-inline-block' tabindex='0' data-toggle='tooltip' title='Aprobar'>
                            <button class='btn btn-success' onclick=editarRoles(".$fila->id.")>Editar Roles</button>
                        </span>
";
            $data[] = array(
                $num++,
                $fila->nome,
                $fila->email,
                $fila->celular,
                $fila->login,
                $boton
            );
        }
        $output = array(
             "draw" => $draw,
             "recordsTotal" => count($filas),
             "recordsFiltered" => count($filas),
             "data" => $data
        );
        echo json_encode($output);
        exit();
    }

    function permisosUsuarios()
    {
        $idUsuario = $this->session->userdata('uid_admin');
        $valorOpcionBD = 20;
        $valorPermisoBD = 1;
        $permiso = verificarPermisosUsuario($idUsuario,$valorOpcionBD,$valorPermisoBD);
        $formulario = "";
        if($permiso)
        {
            $idUsuario = $this->input->post('idUser');
            $permisosCero  =  $this->PermisosModel->getPermisosCero();
            $permisos  =  $this->PermisosModel->getPermisos();
            $con = 1;
            $formulario= "<div class='col-12 row'>";
            $aux = 0;
            $aux1 = 0;
            $aux2 = 0;
            $aux3 = 0;
            $permisoAnterio = "";
            foreach($permisosCero as $fila)
            {
                $nameId1 = "chPermiso_".$fila->id;
                $valor = $fila->id;
                $checkedCom = verificarUsuarioPermiso($idUsuario,$valor);//"checked";
                if($fila->nivel == 0)
                {                
                    $formulario = $formulario."<div class='col-lg-12 grid-margin grid-margin-lg-0'>";
                    if($aux == 0)
                    { 
                        $formulario = $formulario."<h5>Permisos sin dependencias</h5>";
                        $aux=1;
                    }

                    $formulario = $formulario."     <div class='form-check'>
                                                      <input class='form-check-input' type='checkbox' value='".$valor."' name = '".$nameId1."' id='".$nameId1."' ".$checkedCom.">
                                                      <label class='form-check-label' for='flexCheckDefault'>
                                                       ".$fila->opcion."
                                                      </label>
                                                    </div>
                                                </div><br>";     
                }
            }
            foreach($permisos as $fila)
            {
                $nameId1 = "chPermiso_".$fila->id;
                $valor   = $fila->id;
                $checkedCom = verificarUsuarioPermiso($idUsuario,$valor);//"checked";
                if($fila->nivel == 1)
                {                
                    $formulario = $formulario."<div class='col-lg-12 grid-margin grid-margin-lg-0'>";
                    if($aux1 == 0)
                    { 
                        $formulario = $formulario."<h5>Permisos con dependencias</h5>";
                        $aux1 = 1;
                    }

                    $formulario = $formulario."     <div class='form-check'>
                                                      
                                                      <label class='form-check-label' for='flexCheckDefault'><strong><h3>
                                                       ".$fila->opcion."</h3></strong>
                                                      </label>
                                                    </div>
                                                </div>";     
                }
                if($fila->nivel == 2 && $fila->rama == 0 )
                {
                    //$formulario = $formulario."<div class='col-lg-2 grid-margin grid-margin-lg-0'>";               
                    $permisoAnterior = "";
                    $formulario = $formulario."<div class='col-lg-8 grid-margin grid-margin-lg-0'>
                                                    <div class='form-check'>
                                                      <input class='form-check-input' type='checkbox' value='".$valor."' name = '".$nameId1."' id='".$nameId1."' ".$checkedCom.">
                                                      <label class='form-check-label' for='flexCheckDefault'>
                                                       ".$fila->opcion."
                                                      </label>
                                                    </div>
                                                </div>"; 
                }
                if($fila->nivel == 2 && $fila->rama == 1)
                {
                    $formulario = $formulario."<div class='col-lg-8 grid-margin grid-margin-lg-0'>
                                                     <div class='form-check'>                                                  
                                                      <label class='form-check-label' for='flexCheckDefault'><strong><h4>
                                                       ".$fila->opcion."</h4></strong>
                                                      </label>
                                                    </div>
                                                </div>";
                    $permisoAnterior = $fila->opcion;
                }
                if($fila->nivel == 3 && $fila->rama == 1 )
                {
                    $formulario = $formulario." <div class='col-lg-2 grid-margin grid-margin-lg-0'></div>
                                                <div class='col-lg-8 grid-margin grid-margin-lg-0'>
                                                    <div class='form-check'>
                                                      <input class='form-check-input' type='checkbox' value='".$valor."' name = '".$nameId1."' id='".$nameId1."' ".$checkedCom.">
                                                      <label class='form-check-label' for='flexCheckDefault'>
                                                       ".$permisoAnterior." -> ".$fila->opcion."
                                                      </label>
                                                    </div>
                                                </div>"; 
                }
                
            }
            $formulario= $formulario."</div>";
        }
        echo $formulario;
    }

    function guardarPermisosUsuarios()
    {
        $idUsuario = $this->session->userdata('uid_admin');
        $valorOpcionBD = 20;
        $valorPermisoBD = 1;
        $permiso = verificarPermisosUsuario($idUsuario,$valorOpcionBD,$valorPermisoBD);
        $formulario = "";
        if($permiso)
        {
            $idUsuario = $this->input->post('txtDato');
            $datosUsuario = $this->PermisosModel->getUsuarioId($idUsuario);
            $tipo = $datosUsuario[0]->is_admin;

            if($tipo > 1)
            {
                $permisosCero  =  $this->PermisosModel->getPermisosCero();
                $permisos  =  $this->PermisosModel->getPermisos();
                $permiso   = 0;
                $fechaActual   = date("Y-m-d h:m:s");
                foreach($permisosCero as $fila)
                {
                    $nombreCampo = "chPermiso_".$fila->id;                       
                    $idPermiso   = $fila->id;
                    $permiso     = $this->input->post($nombreCampo);
                    if($permiso > 0)
                    {
                        if(!$this->PermisosModel->check_opciones($idUsuario,$idPermiso))
                        {                
                            $data = array(                    
                                'id_opcion'  => $idPermiso,
                                'id_usuario' => $idUsuario,
                            );
                            $actualizar = $this->PermisosModel->guardarPermisos($data); 
                        }
                    }
                    else
                    {
                        $data = array(
                            'fecha_cambio' => $fechaActual,
                            'estado' => 'AN',
                        );
                        $actualizar = $this->PermisosModel->actualizarPermisos($idUsuario,$idPermiso,$data);
                    }
                }

                foreach($permisos as $fila)
                {
                    $nombreCampo = "chPermiso_".$fila->id;                       
                    $idPermiso   = $fila->id;
                    $permiso     = $this->input->post($nombreCampo);
                    if($permiso > 0)
                    {
                        
                        if($fila->nivel == 2 )
                        {
                            $idPermisoSuperior = $fila->codigo_opciones;
                            if(!$this->PermisosModel->check_opciones($idUsuario,$idPermisoSuperior))
                            {                
                                $data = array(                    
                                    'id_opcion'  => $idPermisoSuperior,
                                    'id_usuario' => $idUsuario,
                                );
                                $actualizar = $this->PermisosModel->guardarPermisos($data); 
                            }
                        }

                        if($fila->nivel == 3)
                        {
                            $idPermisoSuperior = $fila->codigo_opciones;
                            if(!$this->PermisosModel->check_opciones($idUsuario,$idPermisoSuperior))
                            {                
                                $data = array(                    
                                    'id_opcion'  => $idPermisoSuperior,
                                    'id_usuario' => $idUsuario,
                                );
                                $actualizar = $this->PermisosModel->guardarPermisos($data); 
                            }
                            $permisoSuperior = $this->PermisosModel->getPermisosId($idPermisoSuperior);
                            $permisoInicial = $permisoSuperior[0]->codigo_opciones;

                            if(!$this->PermisosModel->check_opciones($idUsuario,$permisoInicial))
                            {                
                                $data = array(                    
                                    'id_opcion'  => $permisoInicial,
                                    'id_usuario' => $idUsuario,
                                );
                                $actualizar = $this->PermisosModel->guardarPermisos($data); 
                            }

                        }


                        if(!$this->PermisosModel->check_opciones($idUsuario,$idPermiso))
                        {                
                            $data = array(                    
                                'id_opcion'  => $idPermiso,
                                'id_usuario' => $idUsuario,
                            );
                            $actualizar = $this->PermisosModel->guardarPermisos($data); 
                        }
                    }
                    else
                    {
                        $data = array(
                            'fecha_cambio' => $fechaActual,
                            'estado' => 'AN',
                        );
                        $actualizar = $this->PermisosModel->actualizarPermisos($idUsuario,$idPermiso,$data);
                    }
                }
                $resul = 1;
                $mensaje = "Los cambios de permisos fueron guardados correctamente ";
            }
            else
            {
                $resul = 0;
                $mensaje = "No es posible cambiar permisos del SUPER ADMINISTRADOR ";
            } 
        }
        else
        {
            $resul = 0;
            $mensaje = "ACCESO DENEGADO";
        }
        $resultado ='[{                 
                    "resultado":"'.$resul.'",
                    "mensaje":"'.$mensaje.'"
                    }]';
        echo $resultado;
        
    }
    
}
