<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Saque extends CI_Controller {

    public function __construct(){
        parent::__construct();
        is_logged();

        $this->load->model('cliente/saquemodel', 'SaqueModel');
        $this->load->helper('bancos');
    }

    public function index(){

        $data['active'] = 'financeiro';

        $data['jsLoader'] = array(
                                  'external'=>'https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.11.5/sweetalert2.min.js',
                                  'vendor/needim/noty/lib/noty.min.js',
                                  'assets/plugins/maskmoney/jquery.maskMoney.js',
                                  'assets/pages/cliente/saque.js'
                                  );

        $data['contas_bancaria'] = $this->SaqueModel->MinhasContas(1);
        $data['contas_bitcoin'] = $this->SaqueModel->MinhasContas(2);
        $data['saque'] = $this->SaqueModel->SaqueLiberado();
        $data['dias_saques'] = $this->SaqueModel->DiasSaques();

        $this->template->load('cliente/templates/template', 'cliente/financeiro/saque', $data);
    }
}