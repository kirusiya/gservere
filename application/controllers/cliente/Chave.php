<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Chave extends CI_Controller {

    public function __construct(){
        parent::__construct();
        is_logged();
    }

    public function index(){

        $data['active'] = 'rede';

        $data['jsLoader'] = array(
                                  'vendor/needim/noty/lib/noty.min.js',
                                  'assets/pages/cliente/chave.js'
                                  );

        $this->template->load('cliente/templates/template', 'cliente/rede/chave', $data);
    }
}