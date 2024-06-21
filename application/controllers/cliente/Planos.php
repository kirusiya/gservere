<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Planos extends CI_Controller {

    public function __construct(){
        parent::__construct();
        is_logged();
        
        $this->load->model('cliente/planosmodel', 'PlanosModel');
    }

    public function index(){

        $data['active'] = 'planos';

        $data['planos'] = $this->PlanosModel->TodosPlanos();

        $this->template->load('cliente/templates/template', 'cliente/planos/planos', $data);
    }

    public function comprar($id_plano = false){

        if($id_plano !== false && !empty($id_plano)){

          $this->PlanosModel->GerarFatura($id_plano);

          redirect('invoices');

        }else{

            $this->session->set_userdata('message_planos', '<div class="alert alert-danger text-center">Choose a valid plan to continue!</div>');
           redirect('plans');
        }
    }
}