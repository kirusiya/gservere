<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rede extends CI_Controller {

    protected $userid;

    public function __construct(){
        parent::__construct();
        is_logged();

        $this->userid = InformacoesUsuario('id');

        $this->load->model('cliente/redemodel', 'RedeModel');
    }

    public function index(){

        $data['active'] = 'rede';

        $data['jsLoader'] = array(
                                  'assets/plugins/tooltipster/js/tooltipster.bundle.min.js',
                                  'assets/plugins/orgchart/jquery.orgchart.min.js',
                                  'assets/pages/cliente/rede.js'
                                  );

        if(!$this->input->get('network_id') || $this->input->get('network_id') == ''){
          $userid = $this->userid;
        }else{
          $userid = $this->input->get('network_id');
        }

        $data['matriz'] = $this->RedeModel->Matriz($userid);
        $data['nivel_acima'] = $this->RedeModel->VoltaNivelAcima($userid);

        $this->template->load('cliente/templates/template', 'cliente/rede/rede', $data);
    }
}