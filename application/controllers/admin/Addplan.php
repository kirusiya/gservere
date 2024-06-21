<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Addplan extends CI_Controller {

    public function __construct(){
        parent::__construct();
        CheckUserIsAdmin();

        $this->load->model('admin/addplanmodel', 'Addplanmodel');
        $this->load->helper('bancos');
        $this->load->helper('permisos_helper');
    }

    public function index(){

        $idUsuario = $this->session->userdata('uid_admin');
        $valorOpcionBD = 22;
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

            $data['usuarios'] = $this->Addplanmodel->TodosUsuarios();
            //recuperar roles desde la variable de session DIEGO
            $data['rolescero'] = $this->session->userdata('rolescero');
            $data['roles']     = $this->session->userdata('roles');
            $this->template->load('admin/templates/template', 'admin/addplan/usuariosadd', $data);
        }
        else
        {
            redirect('admin/dashboard');
        }
    }


    public function adicionarPlan($id){

        $idUsuario = $this->session->userdata('uid_admin');
        $valorOpcionBD = 21;
        $valorPermisoBD = 3;
        $permiso = verificarPermisosUsuario($idUsuario,$valorOpcionBD,$valorPermisoBD);
        if($permiso)
        {
            if($this->input->post('submit')){

                $data['message'] = $this->Addplanmodel->guardarAsingacion();
            }

            $data['datoUser'] = $this->Addplanmodel->getUsuarioId($id);
            $data['datoPlanes'] = $this->Addplanmodel->getPlanes();            
            //recuperar roles desde la variable de session DIEGO
            $data['rolescero'] = $this->session->userdata('rolescero');
            $data['roles']     = $this->session->userdata('roles');
            $this->template->load('admin/templates/template', 'admin/addplan/adcionarplan', $data);
        }
        else
        {
            redirect('admin/addplan');
        }
    }
    

}