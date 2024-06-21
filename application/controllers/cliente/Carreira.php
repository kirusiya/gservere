<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Carreira extends CI_Controller {

    public function __construct(){
        parent::__construct();
        is_logged();

        $this->load->model('cliente/carreiramodel', 'CarreiraModel');
    }

    public function index(){

        $data['active'] = 'rede';

        $data['planos'] = $this->CarreiraModel->PlanoCarreira();

        $this->template->load('cliente/templates/template', 'cliente/rede/carreira', $data);
    }
}