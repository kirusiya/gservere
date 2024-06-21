<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Planos extends CI_Controller {

    public function __construct(){
        parent::__construct();
        CheckUserIsAdmin();

        $this->load->model('admin/planosmodel', 'PlanosModel');
        $this->load->helper('permisos_helper');
    }

    public function index(){

        $idUsuario = $this->session->userdata('uid_admin');
        $valorOpcionBD = 7;
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
                                        'assets/pages/admin/planos.js'
                                      );

            $data['planos'] = $this->PlanosModel->TodosPlanos();
            //recuperar roles desde la variable de session DIEGO
            $data['rolescero'] = $this->session->userdata('rolescero');
            $data['roles']     = $this->session->userdata('roles');
            $this->template->load('admin/templates/template', 'admin/planos/planos', $data);
        }
        else
        {
            redirect('admin/dashboard');
        }
    }

    public function adicionar(){

        $idUsuario = $this->session->userdata('uid_admin');
        $valorOpcionBD = 7;
        $valorPermisoBD = 2;
        $permiso = verificarPermisosUsuario($idUsuario,$valorOpcionBD,$valorPermisoBD);
        if($permiso)
        {
            $data = array();
            if($this->input->post('submit')){

                $data['message'] = $this->PlanosModel->NovoPlano();
            }
			
			
			$data['jsLoader'] = array('assets/pages/admin/planosScript.js');
			
            //recuperar roles desde la variable de session DIEGO
            $data['rolescero'] = $this->session->userdata('rolescero');
            $data['roles']     = $this->session->userdata('roles');
            $this->template->load('admin/templates/template', 'admin/planos/adicionar', $data);
        }
        else
        {
            redirect('admin/planos');
        }
    }

    public function editar($id){

        $idUsuario = $this->session->userdata('uid_admin');
        $valorOpcionBD = 7;
        $valorPermisoBD = 3;
        $permiso = verificarPermisosUsuario($idUsuario,$valorOpcionBD,$valorPermisoBD);
        if($permiso)
        {
            if($this->input->post('submit')){

                $data['message'] = $this->PlanosModel->EditarPlano($id);
            }
			
			$data['jsLoader'] = array('assets/pages/admin/planosScript.js');

            $data['plano'] = $this->PlanosModel->InformacoesPlano($id);
            //recuperar roles desde la variable de session DIEGO
            $data['rolescero'] = $this->session->userdata('rolescero');
            $data['roles']     = $this->session->userdata('roles');
            $this->template->load('admin/templates/template', 'admin/planos/editar', $data);
        }
        else
        {
            redirect('admin/planos');
        }
    }

    public function excluir($id){
        $idUsuario = $this->session->userdata('uid_admin');
        $valorOpcionBD = 7;
        $valorPermisoBD = 5;
        $permiso = verificarPermisosUsuario($idUsuario,$valorOpcionBD,$valorPermisoBD);
        if($permiso)
        {
            $this->PlanosModel->ExcluirPlano($id);
        }
        else
        {
            redirect('admin/planos');
        }
    }
}