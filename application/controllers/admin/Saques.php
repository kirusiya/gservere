<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Saques extends CI_Controller {

    public function __construct(){
        parent::__construct();
        CheckUserIsAdmin();

        $this->load->model('admin/saquesmodel', 'SaquesModel');
        $this->load->helper('bancos');
        $this->load->helper('permisos_helper');
    }

    public function index()
    {
        $idUsuario = $this->session->userdata('uid_admin');
        $valorOpcionBD = 18;
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
                                        'assets/pages/admin/saques.js'
                                      );

            $data['saques'] = $this->SaquesModel->TodosSaques();
            //recuperar roles desde la variable de session DIEGO
            $data['rolescero'] = $this->session->userdata('rolescero');
            $data['roles']     = $this->session->userdata('roles');
            $this->template->load('admin/templates/template', 'admin/saques/saques', $data);
        }
        else
        {
            redirect('admin/dashboard');
        }
    }

    public function visualizar($id)
    {
        $idUsuario = $this->session->userdata('uid_admin');
        $valorOpcionBD = 18;
        $valorPermisoBD = 4;
        $permiso = verificarPermisosUsuario($idUsuario,$valorOpcionBD,$valorPermisoBD);
        if($permiso)
        {
            $data['jsLoader'] = array(
                                        'external'=>'https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.11.5/sweetalert2.min.js',
                                        'assets/pages/admin/saques.js'
                                      );

            $data['saque'] = $this->SaquesModel->Visualizar($id);
            //recuperar roles desde la variable de session DIEGO
            $data['rolescero'] = $this->session->userdata('rolescero');
            $data['roles']     = $this->session->userdata('roles');
            $this->template->load('admin/templates/template', 'admin/saques/visualizar', $data);
        }
        else
        {
            redirect('admin/saques');
        }
    }
}