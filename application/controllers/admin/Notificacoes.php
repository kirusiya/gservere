<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notificacoes extends CI_Controller {

    public function __construct(){
        parent::__construct();
        CheckUserIsAdmin();

        $this->load->model('admin/notificacoesmodel', 'NotificacoesModel');
        $this->load->helper('permisos_helper');
    }

    public function index()
    {
        $idUsuario = $this->session->userdata('uid_admin');
        $valorOpcionBD = 5;
        $valorPermisoBD = 1;
        $permiso = verificarPermisosUsuario($idUsuario,$valorOpcionBD,$valorPermisoBD);
        if($permiso)
        {
            $data = array();
            if($this->input->post('submit')){
                $data['message'] = $this->NotificacoesModel->EnviarNotificacoes();
            }
            //recuperar roles desde la variable de session DIEGO
            $data['rolescero'] = $this->session->userdata('rolescero');
            $data['roles']     = $this->session->userdata('roles');
            $this->template->load('admin/templates/template', 'admin/notificacoes/notificacoes', $data);
        }
        else
        {
            redirect('admin/dashboard');
        }
    }

    public function admin()
    {
        $idUsuario = $this->session->userdata('uid_admin');
        $valorOpcionBD = 5;
        $valorPermisoBD = 1;
        $permiso = verificarPermisosUsuario($idUsuario,$valorOpcionBD,$valorPermisoBD);
        if($permiso)
        {
            $data['jsLoader'] = array(
                                      'assets/pages/admin/notificacoes.js'
                                    );

            $data['notificacoes'] = $this->NotificacoesModel->NotificacoesAdmin();
            //recuperar roles desde la variable de session DIEGO
            $data['rolescero'] = $this->session->userdata('rolescero');
            $data['roles']     = $this->session->userdata('roles');
            $this->template->load('admin/templates/template', 'admin/notificacoes/admin', $data);
        }
        else
        {
            redirect('admin/dashboard');
        }
    }

}