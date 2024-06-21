<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Conta extends CI_Controller {

    public function __construct(){
        parent::__construct();

        $this->load->model('admin/contamodel', 'ContaModel');
        $this->load->helper('permisos_helper');
    }

    public function logout(){

      $this->ContaModel->Deslogar();
    }

    public function login(){

        $data = array();

        if($this->input->post('submit'))
        {

          $this->form_validation->set_rules('login', 'Login', 'trim|required', array('required' => '<div class="alert alert-danger text-center">Informe %s.</div>'));
          $this->form_validation->set_rules('senha', 'Contraseña', 'trim|required', array('required' => '<div class="alert alert-danger text-center">Informe %s.</div>'));
          
          if ($this->form_validation->run() !== FALSE) 
          {
            $ip = $_SERVER["REMOTE_ADDR"];

            $recaptchaResponse = $this->input->post('g-recaptcha-response');            
            
            //$secretKey = '6LeFAr8gAAAAAF5gsOyv_lDgOoAwQrHaiRnKJ55Q'; //KEY SECRET  THE RECAPTCHAT LOCAL
            $secretKey =  $this->config->item('google_secret'); //KEY SECRET  THE RECAPTCHAT PRODUCCION
            $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret={$secretKey}&response={$recaptchaResponse}&remoteip={$ip}");

            $atributos = json_decode($response, TRUE);

            if (!$atributos['success']) {                                
                $data['message'] = '<div class="alert alert-danger text-center">Verifica el captcha!</div>';
            }
            else
            {              
              $data['message'] = $this->ContaModel->FazerLogin();  
            }
            
            

          }else{

            $data['message'] = validation_errors();
          }
        }

        $this->load->view('admin/login', $data);
    }

}