<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contamodel extends CI_Model{

    public function __construct(){
        parent::__construct();

        $this->load->helper('email');
    }

    public function EncontraLadoVazio($id_usuario, $chave_binaria){

        $this->db->order_by('id', 'ASC');
        $this->db->where('id_patrocinador', $id_usuario);
        $this->db->where('chave_binaria', $chave_binaria);
        $this->db->where('plano_ativo', 1);
        $patrocinadoresSearch = $this->db->get('rede');

        foreach($patrocinadoresSearch->result() as $resultPatrocinadores){

            $this->db->where('id_patrocinador', $resultPatrocinadores->id_usuario);
            $this->db->where('chave_binaria', $chave_binaria);
            $this->db->where('plano_ativo', 1);
            $patrocinadorEncontrado = $this->db->get('rede');

            if($patrocinadorEncontrado->num_rows() > 0){

                 return $this->EncontraLadoVazio($resultPatrocinadores->id_usuario, $chave_binaria);

            }else{

                return $resultPatrocinadores->id_usuario;
            }
        }
    }
    
    public function BuscaLadoVazio($id_usuario, $chave_binaria){

        $this->db->where('id_patrocinador', $id_usuario);
        $this->db->where('chave_binaria', $chave_binaria);
        $this->db->where('plano_ativo', 1);
        $rede = $this->db->get('rede');
    
        if($rede->num_rows() > 0){
    
            $row = $rede->row();
    
            return $this->BuscaLadoVazio($row->id_usuario, $chave_binaria);
        }
    
        return $id_usuario;
    }

    public function walletCuentas($data){

        $this->db->where('cpf', $data);
        $usuarios = $this->db->get('usuarios');
    
    
        foreach ($usuarios->result() as $row)
        {
            echo ','.$row->login ;
            
        }
    }

	
	public function calcularProfit($data){
        

        $this->db->select('f.*,p.*, u.*');
        $this->db->from('faturas AS f');
        $this->db->join('planos AS p ', 'p.id = f.id_plano');
        $this->db->join('usuarios AS u ', 'u.id = f.id_usuario');
        $this->db->where('f.id_usuario ', $data);
        $this->db->order_by('f.data_pagamento','desc'); 
    
        $aResult = $this->db->get();
    
        if(!$aResult->num_rows() == 1)
        {
            return false;
        }
    
        return $aResult->result_array();

    }//beto

	
	
	


    public function CheckChaveBinariaVazia($id_patrocinador){

        $this->db->where('id', $id_patrocinador);
        $user = $this->db->get('usuarios');

        if($user->num_rows() > 0){

            $rowUser = $user->row();

            $chaveBinariaAtual = $rowUser->chave_binaria;

            $this->db->where('id_patrocinador', $id_patrocinador);
            $this->db->where('chave_binaria', $chaveBinariaAtual);
            $this->db->where('plano_ativo', 1);
            $patrocinadores = $this->db->get('rede');

            if($patrocinadores->num_rows() > 0){

                return array('id_patrocinador_direto'=>$id_patrocinador, 'id_patrocinador'=>$this->EncontraLadoVazio($id_patrocinador, $chaveBinariaAtual));

            }else{

                return array('id_patrocinador_direto'=>$id_patrocinador, 'id_patrocinador'=>$id_patrocinador);
            }
        }
    }

    public function Deslogar(){

        $this->session->unset_userdata('uid');
        redirect('login');
        exit;
    }

    public function FazerLogin() {
        $login = strtolower($this->input->post('login'));
        $senha = md5($this->input->post('senha'));
        $recaptchaResponse = trim($this->input->post('g-recaptcha-response'));
        $userIp = $this->input->ip_address();
        $secret = $this->config->item('google_secret');
        $url = "https://www.google.com/recaptcha/api/siteverify?secret=" . $secret . "&response=" . $recaptchaResponse . "&remoteip=" . $userIp;
    
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        curl_close($ch);
    
        $status = json_decode($output, true);
    
        if ($status['success']) {
            $this->db->where('login', $login);
            $this->db->where('senha', $senha);
            $usuario = $this->db->get('usuarios');
    
            if ($usuario->num_rows() > 0) {
                $row = $usuario->row();
    
                if ($row->block == 1) {
                    return '<script>
                        Swal.fire({
                            text: "Please activate your account with the activation link or contact support.",
                            icon: "error",
                            buttonsStyling: false,
                            confirmButtonText: "Ok, got it!",
                            customClass: { confirmButton: "btn btn-primary" }
                        }).then(() => {
                            Swal.close();
                        });
                    </script>';
                     
                }
    
                $this->session->set_userdata('uid', $row->id);
    
                if ($row->active_twofactor == 1) {
                    return '<script>
                        Swal.fire({
                            text: "You need to verify your identity with two-factor authentication.",
                            icon: "info",
                            buttonsStyling: false,
                            confirmButtonText: "Ok, got it!",
                            customClass: { confirmButton: "btn btn-primary" }
                        }).then(() => {
                            window.location.href = "' . base_url('two-factor-authentication') . '";
                        });
                    </script>';
                    
                }
    
                return '<script>
                    Swal.fire({
                        text: "You have successfully logged in!",
                        icon: "success",
                        buttonsStyling: false,
                        confirmButtonText: "Ok, got it!",
                        customClass: { confirmButton: "btn btn-primary" }
                    }).then(() => {
                        window.location.href = "' . base_url('dashboard') . '";
                    });
                </script>';
                
            }
    
            return '<script>
                Swal.fire({
                    text: "Username or password is invalid!",
                    icon: "error",
                    buttonsStyling: false,
                    confirmButtonText: "Ok, got it!",
                    customClass: { confirmButton: "btn btn-primary" }
                }).then(() => {
                    Swal.close();
                });
            </script>';
            
        } else {
            return '<script>
                Swal.fire({
                    text: "Captcha invalid!",
                    icon: "error",
                    buttonsStyling: false,
                    confirmButtonText: "Ok, got it!",
                    customClass: { confirmButton: "btn btn-primary" }
                }).then(() => {
                    Swal.close();
                });
            </script>';
            
        }
    }
    

    public function Cadastrar(){

        $patrocinador = $this->input->post('patrocinador');
        $nome = $this->input->post('nome');
        $email = $this->input->post('email');
        $country = $this->input->post('country');
        $celular = $this->input->post('celular');
        $login = strtolower(trim($this->input->post('login')));
        $senha = $this->input->post('senha');


        $recaptchaResponse = trim($this->input->post('g-recaptcha-response'));
        $userIp = $this->input->ip_address();
        $secret = $this->config->item('google_secret');
        $url = "https://www.google.com/recaptcha/api/siteverify?secret=" . $secret . "&response=" . $recaptchaResponse . "&remoteip=" . $userIp;
    
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        curl_close($ch);
    
        $status = json_decode($output, true);
    
        if ($status['success']) {
            ///good do nothing
        }else{
            return '<script>
                Swal.fire({
                    text: "Captcha invalid!",
                    icon: "error",
                    buttonsStyling: false,
                    confirmButtonText: "Ok, got it!",
                    customClass: { confirmButton: "btn btn-primary" }
                }).then(() => {
                    Swal.close();
                });
            </script>';
        }

        if(valid_email($login) === TRUE){

            return '<script>
                    Swal.fire({
                        text: "Do not use your email in your login. Please try again.",
                        icon: "error",
                        buttonsStyling: false,
                        confirmButtonText: "Ok, got it!",
                        customClass: { confirmButton: "btn btn-primary" }
                    }).then(() => {
                        Swal.close(); // Cierra el Swal
                    });
                </script>';

            //return '<div class="alert alert-danger text-center">Do not use your email in your login. Please try again.</div>';
        }
		
		/*verificar email* 
        $this->db->where('email', $email);
        $usuarios = $this->db->get('usuarios');

        if($usuarios->num_rows() > 0){

            return '<div class="alert alert-danger text-center">E-mail already registered. Please use another one.</div>';
        }

        /*verificar email*/
		
		
		/*
        $this->db->where('cpf', $cpf);
        $usuarios = $this->db->get('usuarios');

        if($usuarios->num_rows() >= ConfiguracoesSistema('maximo_cpfs')){

            return '<div class="alert alert-danger text-center">Metamask wallet has already reached the maximum number of registrations. Please use another.</div>';
        }*/

        $this->db->where('login', $login);
        $usuarios = $this->db->get('usuarios');

        if($usuarios->num_rows() > 0){

            return '<script>
                    Swal.fire({
                        text: "Login already registered. Please choose another.",
                        icon: "error",
                        buttonsStyling: false,
                        confirmButtonText: "Ok, got it!",
                        customClass: { confirmButton: "btn btn-primary" }
                    }).then(() => {
                        Swal.close(); // Cierra el Swal
                    });
                </script>';

            //return '<div class="alert alert-danger text-center">Login already registered. Please choose another.</div>';
        }

        $dadosUsuario = array(
                              'nome'=>$nome,
                              'email'=>$email,
                              'country'=> $country,
                              'celular'=>$celular,
                              'login'=>$login,
                              'senha'=>md5($senha),
                              'saldo_rendimentos'=>0,
                              'saldo_indicacoes'=>0,
                              'plano_carreira'=>1,
                              'binario'=>1,
                              'chave_binaria'=>1,
							  'quantidade_binario' => 20,	
                              'block'=>1,
                              'data_cadastro'=>date('Y-m-d H:i:s')
                            );

        $cadastraUsuario = $this->db->insert('usuarios', $dadosUsuario);

        if($cadastraUsuario){

            $id_novo_usuario = $this->db->insert_id();

            $dadosPlanoCarreira = array(
                                    'id_usuario'=>$id_novo_usuario,
                                    'id_plano_carreira'=>1,
                                    'data'=>date('Y-m-d H:i:s')
                                   );

            $cadastraPlanoCarreira = $this->db->insert('usuarios_plano_carreira', $dadosPlanoCarreira);
			
			
			
			/*agregar plan gratis | edward*/
			$fecha_actualRegalo = date('Y-m-d H:i:s');
			$fechaRegalo = date("Y-m-d H:i:s",strtotime($fecha_actualRegalo."- 1 days")); 
			$planGratuito = array(
                                    'id_usuario'=>$id_novo_usuario,
                                    'id_plano' => 89327542,
									'comprovante' => "Registered User",
									'status' => 1,
                                    'data_pagamento'=>$fechaRegalo
                                   );
			
			$planGratis = $this->db->insert('faturas', $planGratuito);
			
			/*agregar plan gratis | edward */
			
			 

            $this->db->where('login', $patrocinador);
            $usuarios = $this->db->get('usuarios');

            if($usuarios->num_rows() > 0){

                $row = $usuarios->row(); 

                $id_patrocinador_direto = $row->id;

                $id_patrocinador = $this->BuscaLadoVazio($id_patrocinador_direto, $row->chave_binaria);
				
				/*cambio de plano_ativo a 1 para aparecer en el arbol | Edward*/
				
				
				
                $array_patrocinador = array(
                                            'id_usuario'=>$id_novo_usuario,
                                            'id_patrocinador'=>$id_patrocinador,
                                            'chave_binaria'=>$row->chave_binaria,
                                            'id_patrocinador_direto'=>$id_patrocinador_direto,
                                            'plano_ativo'=>1
                                            );
				
				/*cambio de plano_ativo a 1 para aparecer en el arbol | Edward*/

                $this->db->insert('rede', $array_patrocinador);
            }
			
			
			
			

  			$mensagem  = 'Hello <b>' . $nome . '</b>, Welcome to ' . ConfiguracoesSistema('nome_site') . ' you are now part of our affiliate group.<br />';
            $mensagem .= 'Below is the access data to your account on our website: <br /><br />';
            $mensagem .= '<b>Login:</b> ' . $login . ' <br />';
            $mensagem .= '<b>Senha:</b> ***************** <br /><br />';
            $mensagem .= 'All your information is confidential, so do not share your login and password with anyone.<br />';
            $mensagem .= 'If you need support, go to your backoffice and click on "Support" and open a ticket, we will respond as soon as possible.';


           ######################### SEND ACTIVATION CODE #######################
			  $fh = date("Y-m-d H:i");

			  $codigo = $id_novo_usuario . "|" . $email . "|" . $senha . "|" . $fh;
			  $codigo = base64_encode($codigo);
			  $codigo = base64_encode($codigo);

			  /*$codigoactiva = md5($this->input->post('clave'));
			  $contenido = '<img src="' . base_url() . 'uploads/364fe484c644e6d6269f397796088ffa.png" alt="METABIZ" width="100px"><h1>ACTIVACIÓN DE CUENTA</h1><hr><p>Por favor haga clic en el enlace siguiente para activar su cuenta</p><a href="' . base_url() . 'activacion/?cod=' . $codigo . '">Activar Cuenta</a><br><p>En caso de tener problemas con el enlace, copiar la siguiente linea en su navegador</p><br>' . base_url() . 'activation?cod=' . $codigo . '<br>El enlace siguiente solo tiene validez de una 60 minutos, despues de este tiempo, el mismo sera invalido';*/
			 

			  ######################### SEND ACTIVATION CODE #######################
			
			$mensaje = '<h3>ACCOUNT ACTIVATION</h3><hr><p>Por favor haga click en el link que esta abajo</p>
			<span>' . base_url() . 'activation?cod=' . $codigo . '</span><br><br>El siguiente link tiene una validez de 60 minutos, sino tendra que pedir Ayuda a Soporte</p><p>PD.: Si tiene problemas el copie y peque el link</p>';




            //funcion enviar email
            $this->sendmail->EnviarEmail($email, 'Successfully registered!', $mensaje);

			/*cuando se arregle el problema del mail*/
		
            //return '<div class="alert alert-success text-center">Pre Registration successful!<br><strong>Verify your email to activate your account</strong></div>';

            return '<script>
                    Swal.fire({
                        text: "Successfully registered!<br>Activate: ' . base_url() . 'activation?cod=' . $codigo . '",
                        icon: "success",
                        buttonsStyling: false,
                        confirmButtonText: "Ok, got it!",
                        customClass: { confirmButton: "btn btn-primary" }
                    }).then(() => {
                        Swal.close(); // Cierra el Swal
                    });
                </script>';

                    
			
			//return '<div class="alert alert-success text-center"><strong>Successfully registered!</strong><br>Activate: ' . base_url() . 'activation?cod=' . $codigo . '</div>';
        }

        return '<script>
                    Swal.fire({
                        text: "Error registering your account. Try again.",
                        icon: "error",
                        buttonsStyling: false,
                        confirmButtonText: "Ok, got it!",
                        customClass: { confirmButton: "btn btn-primary" }
                    }).then(() => {
                        Swal.close(); // Cierra el Swal
                    });
                </script>';

        //return '<div class="alert alert-danger text-center">Error registering your account. Try again.</div>';
    }

    public function EnviarEmailRecuperacao($email){

        if(!empty($email)){

            $codigo = md5(time().rand(400, 9999));

            $this->db->where('login', $email);
            $usuarios = $this->db->get('usuarios');

            if($usuarios->num_rows() > 0){

                $row = $usuarios->row();

                $dadosRecuperacao = array(
                                          'id_usuario'=>$row->id,
                                          'codigo'=>$codigo,
                                          'usado'=>0,
                                          'data'=>date('Y-m-d H:i:s')
                                        );
				
				
				$mailEnviar = $row->email;

                $this->db->insert('codigos_verificacao', $dadosRecuperacao);

                $mensagem  = 'Hello, we received the password change request. Below is the recovery code: <br />';
                $mensagem .= '<b>Code:</b> '.$codigo.'<br /><br />';
                $mensagem .= 'If you prefer, click the following link and generate the new password: <br />';
                $mensagem .= '<b>Recovery link:</b> <a href="'.base_url('recover/'.$codigo).'" target="_blank">'.base_url('recover/'.$codigo).'</a><br /><br />';
                
                $this->sendmail->EnviarEmail($mailEnviar, 'Password recovery link', $mensagem);

                return array(
                    'mensagem'=>'<div class="alert alert-success text-center">Link sent successfully, check your email.</div>', 'status'=>1
                ); 

                // return '<script>
                //         Swal.fire({
                //             text: "Link sent successfully, check your email.",
                //             icon: "success",
                //             buttonsStyling: false,
                //             confirmButtonText: "Ok, got it!",
                //             customClass: { confirmButton: "btn btn-primary" }
                //         }).then(() => {
                //             window.location.href = "' . base_url('recover') . '";
                //         });
                //     </script>';
                
                
            }

            // return array(
            //     'mensagem'=>'<div class="alert alert-danger text-center">Login/Username not found. Please send Login/Username again.</div>', 
            //     'status'=>0
            // );

            return '<script>
                    Swal.fire({
                        text: "Login/Username not found. Please send Login/Username again.",
                        icon: "error",
                        buttonsStyling: false,
                        confirmButtonText: "Ok, got it!",
                        customClass: { confirmButton: "btn btn-primary" }
                    }).then(() => {
                        window.location.href = "' . base_url('recover') . '";
                    });
                </script>';

        }

        // return array(
        //     'mensagem'=>'<div class="alert alert-danger text-center">Enter your Login/Username with which you registered.</div>', 
        //     'status'=>0
        // );

        return '<script>
                    Swal.fire({
                        text: "Enter your Login/Username with which you registered.",
                        icon: "error",
                        buttonsStyling: false,
                        confirmButtonText: "Ok, got it!",
                        customClass: { confirmButton: "btn btn-primary" }
                    }).then(() => {
                        window.location.href = "' . base_url('recover') . '";
                    });
                </script>';
    }

    public function RedirecionaLink($codigo = false){

        if($codigo !== false && !empty($codigo)){

            redirect('recover/'.$codigo);
            return;
        }

        //return array('mensagem'=>'<div class="alert alert-danger text-center">Enter the verification code.</div>', 'status'=>3);

        return '<script>
                    Swal.fire({
                        text: "Enter the verification code.",
                        icon: "error",
                        buttonsStyling: false,
                        confirmButtonText: "Ok, got it!",
                        customClass: { confirmButton: "btn btn-primary" }
                    }).then(() => {
                        window.location.href = "' . base_url('recover') . '";
                    });
                </script>';
    }

    public function ResetarSenha($codigo){

        $this->db->where('codigo', $codigo);
        $this->db->where('usado', 0);
        $codigos_verificacao = $this->db->get('codigos_verificacao');

        if($codigos_verificacao->num_rows() > 0){

            $row = $codigos_verificacao->row();

            $longitud = 12; 
            $caracteres = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@#$%^&*()';
            $longitud_caracteres = strlen($caracteres);
            $contraseña = '';

            for ($i = 0; $i < $longitud; $i++) {
                $contraseña .= $caracteres[rand(0, $longitud_caracteres - 1)];
            }

            //$nova_senha = mt_rand(9843743, 735248123);
            $nova_senha = $contraseña;

            $mensagem  = 'Hello, your password has been reset successfully, as follows: <br /><br />';
            $mensagem .= '<b>New Password:</b> '.$nova_senha.'<br /><br />';
            $mensagem .= 'Please keep this password with you and do not share it with anyone for your own safety. You can change your password in your profile.';

            $this->db->where('id', $row->id_usuario);
            $atualiza = $this->db->update('usuarios', array('senha'=>md5($nova_senha)));

            if($atualiza){

                $this->sendmail->EnviarEmail(InformacoesUsuario('email', $row->id_usuario), 'Password changed successfully!', $mensagem);

                $this->db->where('codigo', $codigo);
                $this->db->update('codigos_verificacao', array('usado'=>1));

                return '<div class="alert alert-success text-center passOk">Password changed successfully. You will receive a new email with the new password!</div>';

                // return '<script>
                //     Swal.fire({
                //         text: "Password changed successfully. You will receive a new email with the new password!",
                //         icon: "success",
                //         buttonsStyling: false,
                //         confirmButtonText: "Ok, got it!",
                //         customClass: { confirmButton: "btn btn-primary" }
                //     }).then(() => {
                //         window.location.href = "' . base_url('login') . '";
                //     });
                // </script>';
            }

            return '<div class="alert alert-danger text-center noChange">We are sorry, but your password could not be changed. Try again.</div>';


            // return '<script>
            //         Swal.fire({
            //             text: "We are sorry, but your password could not be changed. Try again.",
            //             icon: "error",
            //             buttonsStyling: false,
            //             confirmButtonText: "Ok, got it!",
            //             customClass: { confirmButton: "btn btn-primary" }
            //         }).then(() => {
            //             window.location.href = "' . base_url('recover') . '";
            //         });
            //     </script>';
        }

        return '<div class="alert alert-danger text-center noCode">The code does not exist or has expired.</div>';

        

        // return '<script>
        //             Swal.fire({
        //                 text: "The code does not exist or has expired.",
        //                 icon: "error",
        //                 buttonsStyling: false,
        //                 confirmButtonText: "Ok, got it!",
        //                 customClass: { confirmButton: "btn btn-primary" }
        //             }).then(() => {
        //                 window.location.href = "' . base_url('recover') . '";
        //             });
        //         </script>';
    }
}
?>