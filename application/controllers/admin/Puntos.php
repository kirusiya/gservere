<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Puntos extends CI_Controller {

    public function __construct(){
        parent::__construct();
        CheckUserIsAdmin();

        $this->load->model('admin/Permisosmodel','PermisosModel');
        $this->load->model('admin/usuariosmodel', 'UsuariosModel');     
        $this->load->helper('permisos_helper');
        $this->load->helper('usuarios_helper');
    }

    public function index()
    {
        $idUsuario = $this->session->userdata('uid_admin');
        $valorOpcionBD = 24;
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
            $data['usuarios'] = $this->PermisosModel->puntosIsquierdaDerecha();
            //recuperar roles desde la variable de session DIEGO
            $data['rolescero'] = $this->session->userdata('rolescero');
            $data['roles']     = $this->session->userdata('roles');
            $this->template->load('admin/templates/template', 'admin/usuarios/puntosusuarios', $data);
        }
        else
        {
            redirect('admin/dashboard');
        }
    }
    function verPuntosUsuario($id)
    {
        $idUsuario = $this->session->userdata('uid_admin');
        $valorOpcionBD = 24;
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
            $ladoinscripcion = $this->UsuariosModel->getLadoInscripcionId($id);            
            $data['ladoinscripcion'] = $this->UsuariosModel->getLadoInscripcionId($id);
            $data['puntosizquierdo'] = $this->UsuariosModel->getPuntosUsuarioId($id,1);
            $data['puntosderecho'] = $this->UsuariosModel->getPuntosUsuarioId($id,2); 

            $data['patrocinadosizquierdo'] = $this->UsuariosModel->patrocinadosDirectos($id,1);
            $data['patrocinadosderecho']   = $this->UsuariosModel->patrocinadosDirectos($id,2); 
            //recuperar roles desde la variable de session DIEGO
            $data['rolescero'] = $this->session->userdata('rolescero');
            $data['roles']     = $this->session->userdata('roles');

            $this->template->load('admin/templates/template', 'admin/usuarios/verdetallepuntosusuarios', $data);
        }
        else
        {
            redirect('admin/dashboard');
        }
    }
}
