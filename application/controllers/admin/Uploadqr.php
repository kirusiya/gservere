<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Uploadqr extends CI_Controller {

    public function __construct(){
        parent::__construct();
        CheckUserIsAdmin();

        $this->load->model('admin/Uploadqrmodel', 'Uploadqrmodel');
        $this->load->helper('permisos_helper');
    }

    public function index(){

        $idUsuario = $this->session->userdata('uid_admin');
        $valorOpcionBD = 21;
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
                                        'assets/pages/admin/uploadqr.js'
                                      );

            $data['datoqr'] = $this->Uploadqrmodel->getQrSistema();
            //recuperar roles desde la variable de session DIEGO
            $data['rolescero'] = $this->session->userdata('rolescero');
            $data['roles']     = $this->session->userdata('roles');
            $this->template->load('admin/templates/template', 'admin/uploadqr/qr', $data);
        }
        else
        {
            redirect('admin/dashboard');
        }
    }

    public function adicionar(){

        $idUsuario = $this->session->userdata('uid_admin');
        $valorOpcionBD = 21;
        $valorPermisoBD = 2;
        $permiso = verificarPermisosUsuario($idUsuario,$valorOpcionBD,$valorPermisoBD);
        if($permiso)
        {
            $data = array();
            if($this->input->post('submit')){

                $data['message'] = $this->Uploadqrmodel->guardarQR();
            }
            //recuperar roles desde la variable de session DIEGO
            $data['rolescero'] = $this->session->userdata('rolescero');
            $data['roles']     = $this->session->userdata('roles');
            $this->template->load('admin/templates/template', 'admin/uploadqr/adicionar', $data);
        }
        else
        {
            redirect('admin/uploadqr');
        }
    }

    public function editar($id){

        $idUsuario = $this->session->userdata('uid_admin');
        $valorOpcionBD = 21;
        $valorPermisoBD = 3;
        $permiso = verificarPermisosUsuario($idUsuario,$valorOpcionBD,$valorPermisoBD);
        if($permiso)
        {
            if($this->input->post('submit')){

                $data['message'] = $this->Uploadqrmodel->EditarQR($id);
            }

            $data['datoqr'] = $this->Uploadqrmodel->getQrSistemaId($id);
            //recuperar roles desde la variable de session DIEGO
            $data['rolescero'] = $this->session->userdata('rolescero');
            $data['roles']     = $this->session->userdata('roles');
            $this->template->load('admin/templates/template', 'admin/uploadqr/editar', $data);
        }
        else
        {
            redirect('admin/uploadqr');
        }
    }

    public function excluir($id){
        $idUsuario = $this->session->userdata('uid_admin');
        $valorOpcionBD = 21;
        $valorPermisoBD = 5;
        $permiso = verificarPermisosUsuario($idUsuario,$valorOpcionBD,$valorPermisoBD);
        if($permiso)
        {
            $this->Uploadqrmodel->ExcluirQr($id);
        }
        else
        {
            redirect('admin/uploadqr');
        }
    }
}