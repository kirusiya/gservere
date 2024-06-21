<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pagamento extends CI_Controller {

    public function __construct(){
        parent::__construct();
        is_logged();
    }

    public function index(){

        $data['active'] = 'financeiro';

        $data['jsLoader'] = array(
                                    'external'=>'https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.11.5/sweetalert2.min.js',
                                    'assets/pages/cliente/pagamento.js'
                                  );

        $this->template->load('cliente/templates/template', 'cliente/financeiro/pagamento', $data);
    }
}