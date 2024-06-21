<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Configuracoes extends CI_Controller {

  public function __construct(){
      parent::__construct();
      CheckUserIsAdmin();
      $this->load->model('admin/configuracoesmodel', 'ConfiguracoesModel');
      $this->load->helper('permisos_helper');
      $this->load->library('upload');
  }

  public function site(){

    $idUsuario = $this->session->userdata('uid_admin');
    $valorOpcionBD = 10;
    $valorPermisoBD = 1;
    $permiso = verificarPermisosUsuario($idUsuario,$valorOpcionBD,$valorPermisoBD);
    if($permiso)
    {
      $data = array();
      if($this->input->post('submit')){
        $data['message'] = $this->ConfiguracoesModel->AtualizarConfiguracoesSite();
      }
      //recuperar roles desde la variable de session DIEGO
      $data['rolescero'] = $this->session->userdata('rolescero');
      $data['roles']     = $this->session->userdata('roles');
      $this->template->load('admin/templates/template', 'admin/configuracoes/site', $data);
    }
    else
    {
        redirect('admin/dashboard');
    }

  }

  public function email(){
    $idUsuario = $this->session->userdata('uid_admin');
    $valorOpcionBD = 11;
    $valorPermisoBD = 1;
    $permiso = verificarPermisosUsuario($idUsuario,$valorOpcionBD,$valorPermisoBD);
    if($permiso)
    {
      $data['jsLoader'] = array(
                                'assets/pages/admin/configuracoes.js'
                                );

      if($this->input->post('submit')){

        $data['message'] = $this->ConfiguracoesModel->AtualizarConfiguracoesEmail();
      }
      //recuperar roles desde la variable de session DIEGO
      $data['rolescero'] = $this->session->userdata('rolescero');
      $data['roles']     = $this->session->userdata('roles');
      $this->template->load('admin/templates/template', 'admin/configuracoes/email', $data);
    }
    else
    {
        redirect('admin/dashboard');
    }
  }

  public function financeira()
  {
    $idUsuario = $this->session->userdata('uid_admin');
    $valorOpcionBD = 12;
    $valorPermisoBD = 1;
    $permiso = verificarPermisosUsuario($idUsuario,$valorOpcionBD,$valorPermisoBD);
    if($permiso)
    {
      $data['jsLoader'] = array(
                                'assets/plugins/maskedinput/jquery.maskedinput.min.js',
                                'assets/pages/admin/configuracoes.js'
                                );

      if($this->input->post('submit')){

        $data['message'] = $this->ConfiguracoesModel->AtualizarConfiguracoesFinanceiras();
      }
      $data['dias_saque'] = $this->ConfiguracoesModel->DiasSaques();
      //recuperar roles desde la variable de session DIEGO
      $data['rolescero'] = $this->session->userdata('rolescero');
      $data['roles']     = $this->session->userdata('roles');
      $this->template->load('admin/templates/template', 'admin/configuracoes/financeiras', $data);
    }
    else
    {
        redirect('admin/dashboard');
    }    
  }
}