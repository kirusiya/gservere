<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Faturas extends CI_Controller {

    public function __construct(){
        parent::__construct();
        is_logged();

        $this->load->model('cliente/faturasmodel', 'FaturasModel');
        $this->load->helper('bancos');
    }

    public function index(){

        $data['active'] = 'financeiro';
        
        $data['faturas'] = $this->FaturasModel->MinhasFaturas();
        $data['formas_pagamento'] = $this->FaturasModel->FormasPagamento();

        $this->template->load('cliente/templates/template', 'cliente/financeiro/faturas', $data);
    }
}