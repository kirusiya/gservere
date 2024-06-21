<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Qualified extends CI_Controller {

    public function __construct(){
        parent::__construct();
        CheckUserIsAdmin();

        $this->load->model('admin/qualifiedmodel', 'qualifiedmodel');
        $this->load->helper('bancos');
        $this->load->helper('permisos_helper');
        $this->load->helper('usuarios_helper');
    }

    public function index(){

        $idUsuario = $this->session->userdata('uid_admin');       
        $valorOpcionBD = 25;
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

            
            //recuperar roles desde la variable de session DIEGO
            $data['rolescero'] = $this->session->userdata('rolescero');
            $data['roles']     = $this->session->userdata('roles');

            $data['usuarios'] = $this->qualifiedmodel->TotalUsuarios(); ///datos para la tabla
            $this->template->load('admin/templates/template', 'admin/configuracoes/qualified-binary', $data);
        }
        else
        {
            redirect('admin/dashboard');
        }
    }
     public function editar($id){

        $idUsuario = $this->session->userdata('uid_admin');
        $valorOpcionBD = 25;
        $valorPermisoBD = 1;
        $permiso = verificarPermisosUsuario($idUsuario,$valorOpcionBD,$valorPermisoBD);
        if($permiso)
        {   
            $data['usuarios'] = $this->qualifiedmodel->getQualifiedId($id);
			$data['usuarioscal'] = $this->qualifiedmodel->verLadoPatroDirectoAdmin($id);
			//$data['datoPlanes'] = $this->Addplanmodel->getPlanes();  
            //recuperar roles desde la variable de session DIEGO
            $data['rolescero'] = $this->session->userdata('rolescero');
            $data['roles']     = $this->session->userdata('roles');
            $this->template->load('admin/templates/template', 'admin/configuracoes/edit-qualified', $data);
        }
        else
        {
            redirect('admin/uploadqr');
        }
    }

}