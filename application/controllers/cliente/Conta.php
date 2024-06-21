<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Conta extends CI_Controller {

    public function __construct(){
        parent::__construct();

        $this->load->model('cliente/contamodel', 'ContaModel');
    }

    public function logout(){

      $this->ContaModel->Deslogar();
    }

    public function login(){

        $data = array();

        if($this->input->post('submit')){

          $this->form_validation->set_rules('login', 'Login', 'trim|required', array('required' => '<div class="alert alert-danger text-center">report the field %s.</div>'));
          $this->form_validation->set_rules('senha', 'Senha', 'trim|required', array('required' => '<div class="alert alert-danger text-center">Report the field %s.</div>'));

          // $this->form_validation->set_rules('cpf', 'Cpf', 'trim|required', array('required' => '<div class="alert alert-danger text-center">Informe sua %s.</div>'));



          if ($this->form_validation->run() !== FALSE) {

            $data['message'] = $this->ContaModel->FazerLogin();

          }else{

            $data['message'] = validation_errors();
          }
        }

        $this->load->view('cliente/login', $data);
    }

    public function cadastrar($patrocinador = false){

        if($this->input->post('submit')){

          $this->form_validation->set_rules('patrocinador', 'Patrocinador', 'trim|required', array('required' => '<div class="alert alert-danger text-center">Informe um %s.</div>'));
          $this->form_validation->set_rules('nome', 'Nome', 'trim|required', array('required' => '<div class="alert alert-danger text-center">Informe seu %s.</div>'));
          $this->form_validation->set_rules('email', 'Email', 'trim|required', array('required' => '<div class="alert alert-danger text-center">Informe seu %s.</div>'));
          $this->form_validation->set_rules('celular', 'Celular', 'trim|required', array('required' => '<div class="alert alert-danger text-center">Informe seu %s.</div>'));
          $this->form_validation->set_rules('login', 'Login', 'trim|required', array('required' => '<div class="alert alert-danger text-center">Informe seu %s.</div>'));
          $this->form_validation->set_rules('senha', 'Senha', 'trim|required', array('required' => '<div class="alert alert-danger text-center">Informe seu %s.</div>'));
			          $this->form_validation->set_rules('country', 'Country', 'trim|required', array('required' => '<div class="alert alert-danger text-center">Informe seu %s.</div>'));
          
          if ($this->form_validation->run() !== FALSE) {

            $data['message'] = $this->ContaModel->Cadastrar();

          }else{

            $data['message'] = validation_errors();
          }
        }

        $data['patrocinador'] = $patrocinador;

        $this->load->view('cliente/cadastrar', $data);
    }

	
    ##### ACTIVATION #####
  public function activation()
  {
    if (!$this->input->get('cod')) {
      $this->login();
    } else {
      $codigo = $this->input->get('cod');
      $cadena = base64_decode($codigo);
      $cadena = base64_decode($cadena);
      $unidos = explode("|", $cadena);
      $id_user = $unidos[0];
      $email = $unidos[1];
      $senha = $unidos[2];
      $fh = $unidos[3];
      $ahora = date("Y-m-d H:i");

      $date1 = new DateTime($fh);
      $date2 = new DateTime("now");
      $diff = $date1->diff($date2);
      $valor = (($diff->days * 24) * 60) + ($diff->i);
     // echo $id_user." ".$email." ".$senha;
     // exit();
      if ($valor <= 60) {
		  
		  //echo "hola"; 
		  
		$datosMail = array(

			'block' => 0
		  );  
		  
		$this->db->where('id', $id_user);
    	$this->db->update('usuarios', $datosMail); 
		  
		  
        //$get_activa = $this->ContaModel->get_activa($id_user, $email, $senha);
        //$cuanto = count($get_activa);
        
         
        $data['message'] = '<div class="alert alert-success text-center">Registration successful!</div>';
          
        

        $this->load->view('cliente/login', $data);
		 
		  
      }else{
		  
		 $data['message'] = '<div class="alert alert-danger text-center">Something happened, try again!</div>'; 
		 $this->load->view('cliente/cadastrar', $data);
		  
	  }
    }
  }
  ##### ACTIVATION #####	
	
	
	
    public function mostrarcuentas()
    {
      $data = $_POST['wallet'];
      $this->ContaModel->walletCuentas($data);
      // echo $data;
    }
  

    public function recuperar_senha($codigo = false){

        $data['codigo'] = $codigo;

        if($this->input->post('email')){

          $data['message'] = $this->ContaModel->EnviarEmailRecuperacao($this->input->post('email'));
        
        }

        if($this->input->post('codigo')){

          $data['message'] = $this->ContaModel->RedirecionaLink($this->input->post('codigo'));
        }

        $this->load->view('cliente/recuperar', $data);
    }
}