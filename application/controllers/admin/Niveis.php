<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Niveis extends CI_Controller {

    public function __construct(){
        parent::__construct();
        CheckUserIsAdmin();

        $this->load->model('admin/niveismodel', 'NiveisModel');
        $this->load->helper('permisos_helper');
    }

    public function index()
    {
        $idUsuario = $this->session->userdata('uid_admin');
        $valorOpcionBD = 3;
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
                                        'assets/pages/admin/niveis.js'
                                      );

            $data['niveis'] = $this->NiveisModel->TodosNiveis();
            //recuperar roles desde la variable de session DIEGO
            $data['rolescero'] = $this->session->userdata('rolescero');
            $data['roles']     = $this->session->userdata('roles');
            $this->template->load('admin/templates/template', 'admin/niveis/niveis', $data);
        }
        else
        {
            redirect('admin/dashboard');
        }
    }

    public function adicionar()
    {
        $idUsuario = $this->session->userdata('uid_admin');
        $valorOpcionBD = 3;
        $valorPermisoBD = 2;
        $permiso = verificarPermisosUsuario($idUsuario,$valorOpcionBD,$valorPermisoBD);
        if($permiso)
        {
            $data = array();

            if($this->input->post('submit')){

                $data['message'] = $this->NiveisModel->NovoNivel();
            }
            //recuperar roles desde la variable de session DIEGO
            $data['rolescero'] = $this->session->userdata('rolescero');
            $data['roles']     = $this->session->userdata('roles');
            $this->template->load('admin/templates/template', 'admin/niveis/adicionar', $data);        
        }
        else
        {
            redirect('admin/niveis');
        }
    }

    public function editar($id)
    {        
        $idUsuario = $this->session->userdata('uid_admin');
        $valorOpcionBD = 3;
        $valorPermisoBD = 3;
        $permiso = verificarPermisosUsuario($idUsuario,$valorOpcionBD,$valorPermisoBD);
        if($permiso)
        {            
            if($this->input->post('submit')){

                $data['message'] = $this->NiveisModel->EditarNivel($id);
            }

            $data['nivel'] = $this->NiveisModel->InformacoesNiveis($id);
            //recuperar roles desde la variable de session DIEGO
            $data['rolescero'] = $this->session->userdata('rolescero');
            $data['roles']     = $this->session->userdata('roles');
            $this->template->load('admin/templates/template', 'admin/niveis/editar', $data);
        }
        else
        {
            redirect('admin/niveis');
        }
    }

    public function excluir($id)
    {
        $idUsuario = $this->session->userdata('uid_admin');
        $valorOpcionBD = 3;
        $valorPermisoBD = 5;
        $permiso = verificarPermisosUsuario($idUsuario,$valorOpcionBD,$valorPermisoBD);
        if($permiso)
        {
            $this->NiveisModel->ExcluirNivel($id);
        }
        else
        {
            redirect('admin/niveis');
        }
    }
}