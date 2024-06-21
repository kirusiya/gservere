<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios extends CI_Controller {

    public function __construct(){
        parent::__construct();
        CheckUserIsAdmin();

        $this->load->model('admin/usuariosmodel', 'UsuariosModel');
        $this->load->helper('bancos');
        $this->load->helper('permisos_helper');
        $this->load->helper('usuarios_helper');
    }

    public function index(){

        $idUsuario = $this->session->userdata('uid_admin');       
        $valorOpcionBD = 2;
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
                                        'assets/bower_components/datatables-scroller/js/dataTables.scroller.js',
                                        'assets/pages/admin/usuarios.js'
                                      );

            $data['usuarios'] = $this->UsuariosModel->TodosUsuarios();
            //recuperar roles desde la variable de session DIEGO
            $data['rolescero'] = $this->session->userdata('rolescero');
            $data['roles']     = $this->session->userdata('roles');
            $this->template->load('admin/templates/template', 'admin/usuarios/usuarios', $data);
        }
        else
        {
            redirect('admin/dashboard');
        }
    }

    public function visualizar($id){

        $idUsuario = $this->session->userdata('uid_admin');
        $valorOpcionBD = 2;
        $valorPermisoBD = 4;
        $permiso = verificarPermisosUsuario($idUsuario,$valorOpcionBD,$valorPermisoBD);        
        if($permiso)
        {
            $data['jsLoader'] = array(
                                        'assets/bower_components/datatables.net/js/jquery.dataTables.min.js',
                                        'assets/bower_components/datatables-tabletools/js/dataTables.tableTools.js',
                                        'assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js',
                                        'assets/bower_components/datatables-colvis/js/dataTables.colVis.js',
                                        'assets/bower_components/datatables-responsive/js/dataTables.responsive.js',
                                        'assets/bower_components/datatables-scroller/js/dataTables.scroller.js',
                                        'assets/pages/admin/usuarios.js'
                                      );

            $data['usuario'] = $this->UsuariosModel->DadosUsuario($id);
			$data['redes'] = $this->UsuariosModel->getRede($id);
            $data['gananciasNiveles'] = $this->UsuariosModel->GananciasNiveles($id);
            $data['puntosizquierdo'] = $this->UsuariosModel->getPuntosUsuarioId($id,1);
            $data['puntosderecho'] = $this->UsuariosModel->getPuntosUsuarioId($id,2);            
            //recuperar roles desde la variable de session DIEGO
            $data['rolescero'] = $this->session->userdata('rolescero');
            $data['roles']     = $this->session->userdata('roles');
            $this->template->load('admin/templates/template', 'admin/usuarios/visualizar', $data);
        }
        else
        {
            redirect('admin/usuarios');
        }
    }

    public function editar($id){

        $idUsuario = $this->session->userdata('uid_admin');
        $data['isAdmin'] = $this->session->userdata('is_admin');  //DIEGO      
        $valorOpcionBD = 2;
        $valorPermisoBD = 3;
        $permiso = verificarPermisosUsuario($idUsuario,$valorOpcionBD,$valorPermisoBD);
        if($permiso)
        {
            $data['jsLoader'] = array(
                                        'assets/plugins/maskedinput/jquery.maskedinput.min.js',
                                        'assets/pages/admin/usuarios.js'
                                      );

            if($this->input->post('submit')){

                $data['message'] = $this->UsuariosModel->AtualizarUsuario($id);
            }

            $data['usuario'] = $this->UsuariosModel->DadosUsuario($id);
            //recuperar roles desde la variable de session DIEGO
            $data['rolescero'] = $this->session->userdata('rolescero');
            $data['roles']     = $this->session->userdata('roles');
            $this->template->load('admin/templates/template', 'admin/usuarios/editar', $data);
        }
        else
        {
            redirect('admin/usuarios');
        }
    }

    public function bloquear($id)
    {

        $idUsuario = $this->session->userdata('uid_admin');
        $data['isAdmin'] = $this->session->userdata('is_admin'); 
        $valorOpcionBD = 2;
        $valorPermisoBD = 3;
        $permiso = verificarPermisosUsuario($idUsuario,$valorOpcionBD,$valorPermisoBD);
        if($permiso)
        {            
            $valor = 'NO';
            $data['message'] = $this->UsuariosModel->actualizarRetiro($id,$valor); 
        }
        else
        {
            redirect('admin/usuarios');
        }
    }
    public function desbloquear($id){

        $idUsuario = $this->session->userdata('uid_admin');
        $data['isAdmin'] = $this->session->userdata('is_admin');  //DIEGO      
        $valorOpcionBD = 2;
        $valorPermisoBD = 3;
        $permiso = verificarPermisosUsuario($idUsuario,$valorOpcionBD,$valorPermisoBD);
        if($permiso)
        {            
            $valor = 'SI';
            $data['message'] = $this->UsuariosModel->actualizarRetiro($id,$valor); 
        }
        else
        {
            redirect('admin/usuarios');
        }
    }
    function editarPuntosUsuario()
    {
        $idUsuario = $this->session->userdata('uid_admin');
        $data['isAdmin'] = $this->session->userdata('is_admin');  //DIEGO      
        $valorOpcionBD = 2;
        $valorPermisoBD = 3;
        $permiso = verificarPermisosUsuario($idUsuario,$valorOpcionBD,$valorPermisoBD);
        if($permiso)
        {            
            $idpunto     = $this->input->post('txtDato');
            $puntos     = $this->input->post('txtPunto');
            $data = array(
                'pontos' => $puntos
                );
            $updatePuntos = $this->UsuariosModel->updatePuntosUser($idpunto, $data);
            $resul = 1;
            $mensaje = "Points were updated successfully"; 
        
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
    function editarVerPuntosUsuario()
    {
        $idUsuario = $this->session->userdata('uid_admin');
        $data['isAdmin'] = $this->session->userdata('is_admin');  //DIEGO      
        $valorOpcionBD = 24;
        $valorPermisoBD = 1;
        $permiso = verificarPermisosUsuario($idUsuario,$valorOpcionBD,$valorPermisoBD);
        if($permiso)
        {            
            $idUser   = $this->input->post('idUser');
            $tipo     = $this->input->post('ti');
            if($tipo == 1)
            { 
                $tipo = "NO";
            }
            else
            {
                $tipo = "SI";
            }
            
            $data = array(
                'ver_puntos' => $tipo
                );
            $updatePuntos = $this->UsuariosModel->updateVerPuntosUser($idUser, $data);
            
            $resul = 1;
            $mensaje = "Data updated successfully !!!";         
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