<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Website extends CI_Controller {

    public function __construct(){
        parent::__construct();
    }

    public function index(){

      redirect('login');
    }
	
	//chistopher Flores
    public function twoFactor($message = FALSE){
      $this->load->helper('authenticator_helper');
      $link = auth();

      $data = new StdClass();
      $data->link = $link;
      if($message){
        $data->message = $message;
      }
      $this->session->set_userdata('tfa', 0);
      $this->load->view('cliente/twofactor',$data);
    }

    //chistopher Flores
    public function validTwoFactor(){
      $this->load->library('session');
      $code = $this->input->post('pass-code');
      $this->load->helper('authenticator_helper');
      if(validartor($code)){
        $this->session->set_userdata('tfa', 1);
        redirect('dashboard');
      }else{
        $this->twoFactor('<div class="alert alert-error text-center">Invalid Code</div>');
      }
    }
}