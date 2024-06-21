<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pay extends CI_Controller {

    public function __construct(){
        parent::__construct();

        $this->load->model('cliente/Paymodel', 'PayModel');
    }

public function pay(){

    $hash = $_POST['hash'];
    $this->PayModel->payRegister($hash);
}
}