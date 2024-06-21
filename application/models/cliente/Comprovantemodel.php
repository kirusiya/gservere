<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Comprovantemodel extends CI_Model{

    protected $userid;

    public function __construct(){
        parent::__construct();

        $this->userid = InformacoesUsuario('id');

        $this->load->library('upload');
    }

    public function ComprovantePrevio($data) {
        $this->db->insert('faturas', $data);
        return $this->db->insert_id();
    }
    
    public function updateComprovantePrevio($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('faturas', $data);
        return $this->db->affected_rows();
    }

    public function EnviarComprovante(){

        $config['upload_path'] = 'uploads';
        $config['allowed_types'] = 'pdf|jpg|jpeg|gif|png';
        $config['encrypt_name'] = true;

        //$this->upload->initialize($config);
		$subirError = 1;
		
		if(!empty($_FILES['comprovante']['tmp_name'])){

            $this->upload->initialize($config);

            if($this->upload->do_upload('comprovante')){

                $retorno = $this->upload->data();

                $comprovante = $retorno['file_name'];
				$subirError = 0;

            }else{

                return '<div class="alert alert-danger text-center">Error Subiendo Comprobante No 1: '.$this->upload->display_errors().'</div>';
            }
        }
		
		$subirError = 1;
		
		if(!empty($_FILES['comprovante2']['tmp_name'])){

            $this->upload->initialize($config);

            if($this->upload->do_upload('comprovante2')){

                $retorno = $this->upload->data();

                $comprovante2 = $retorno['file_name'];
				$subirError = 0;

            }else{

                return '<div class="alert alert-danger text-center">Error Subiendo Comprobante No 2: '.$this->upload->display_errors().'</div>';
            }
        }
		
		

        //if($this->upload->do_upload('comprovante')){
		if($subirError==0){	

            //$data = $this->upload->data();
			
			/*arreglo edward*/
			$id_plan = $this->input->post('id_plan');
			$coin = $this->input->post('coin');
			$hashtxt = $this->input->post('hashtxt');
			
			$datoPlan = userPlan($id_plan);
	
			$nomePlan = $datoPlan[0]->nome;
			
			$address = InformacoesUsuario('cpf', $this->userid);
			$nombre = InformacoesUsuario('nome', $this->userid);
			$login = InformacoesUsuario('login', $this->userid);
			$email_user = InformacoesUsuario('email', $this->userid);
			
			//$email = ConfiguracoesSistema('email_remetente');
			
			$email = 'smartglobalinvestiment@gmail.com';
			//$email = 'edward.avalos.severiche@gmail.com';
			
			$description = "Purchased by user";	
			//$bill = $data['file_name'];
			$bill = $comprovante;
			$bill2 = $comprovante2;
			
			$baseUrl = base_url('uploads');
			
			$dataIns = array(                           
					   'id_usuario'=>$this->userid,
					   'id_plano'=>$id_plan,
					   'comprovante'=>$nomePlan,
					   'description'=>$description,
					   'coin'=>$coin,	
					   'bill'=>$bill,
					   'bill2'=>$bill2,	
				 	   'address'=>$address,
					   //'hashtxt'=>$hashtxt, 	
					   'status'=>0,
			);
			
			$insert = $this->db->insert('faturas', $dataIns);
			
			if($insert){
				
				
				$mensaje ="<h1>Envio de Comprobante de pago</h1>
						   <h3>Para Aprobar ingresa a tu panel</h3>
						   <p><strong>Datos del Envio:</strong></p>
						   <br>
						   <p><strong>Nombre:</strong> $nombre</p>
						   <p><strong>Nombre de Usuario:</strong> $login</p>
						   <p><strong>Email de Usuario:</strong> $email_user</p>
						   <p><strong>Plan Comprado:</strong> $nomePlan</p>
						   <p><strong>Comprobante:</strong></p>
						   
						   <img src='$baseUrl/$bill'><br>
						   <img src='$baseUrl/$bill2'>
				";
				
				$this->sendmail->EnviarEmail($email, 'Envio de Comprobante', $mensaje);

                return  '<div class="alert alert-success text-center">Comprobante enviado correctamente!</div>';

            }else{

                return  "<div class='alert alert-danger text-center'>Lo sentimos mucho, algo sucedió, por favor inténtalo de nuevo.</div>";
            }
			
			/*arreglo edward*/

			/* funcion original mlm => oculto
            $this->db->where('id_usuario', $this->userid);
            $this->db->where('status', 0);
            $faturas = $this->db->get('faturas');

            if($faturas->num_rows() > 0){

                $row = $faturas->row();

                $this->db->where('id', $row->id);
                $this->db->update('faturas', array('comprovante'=>$data['file_name']));

                return  '<div class="alert alert-success text-center">Voucher successfully attached!</div>';

            }else{

                return  "<div class='alert alert-danger text-center'>Sorry, but we couldn't find any open invoices to attach a receipt. Please verify.</div>";
            }*/

        }else{

            return  '<div class="alert alert-danger text-center">Error: '.$this->upload->display_errors().'</div>';
        }
    }
}
?>