<?php
function is_logged()
{

  $_this = &get_instance();

  if (!$_this->session->has_userdata('uid')) {

    redirect('login');
    exit;
  }
  //Christopher Flores
  if(InformacoesUsuario('active_twofactor') == 1 && $_this->session->userdata('tfa') == 0){
    redirect('two-factor-authentication');
  }//Christopher Flores	
	
}

function InformacoesUsuario($coluna, $id_user = false)
{

  $_this = &get_instance();

  if ($id_user === false) {

    $id_user = $_this->session->userdata('uid');
  }

  $_this->db->where('id', $id_user);
  $usuario = $_this->db->get('usuarios'); 

  if ($usuario->num_rows() > 0) {

    return $usuario->row()->$coluna;
  }

  return false;
}


function facturas($id)
{
  $_this = &get_instance();
  $_this->db->where('id', $id);
  $plano = $_this->db->get('faturas');

  if ($plano->num_rows() > 0) {

    return $plano->result();
  }

  return false;
}

function userPlan($id)
{
  $_this = &get_instance();

  $_this->db->where('id', $id);
  $plano = $_this->db->get('planos');

  if ($plano->num_rows() > 0) {

    return $plano->result();
  }

  return false;
} //beto



function partnerRecomendacion($id_usuario)
{
  $_this = &get_instance();

  $_this->db->where('id_usuario', $id_usuario);
  // $_this->db->where('id_patrocinador_direto', $partner);
  $plano = $_this->db->get('redes');

  if ($plano->num_rows() > 0) {

    return $plano->result();
  }

  return false;
} //beto




function CheckUserIsAdmin()
{

  $_this = &get_instance();

  if (!$_this->session->has_userdata('uid_admin')) {

    redirect('admin/login');
    exit;
  }

  $user_is_admin = InformacoesUsuario('is_admin', $_this->session->userdata('uid_admin'));

  if (!$user_is_admin >= 1) {

    redirect('admin/login');
    exit;
  }
}

function PlanoCarreira($id, $coluna)
{

  $_this = &get_instance();

  $_this->db->where('id', $id);
  $plano_carreira = $_this->db->get('plano_carreira');

  if ($plano_carreira->num_rows() > 0) {

    return $plano_carreira->row()->$coluna;
  }

  return false;
}

/*edward*/
function usersPlanActive($id_usuario = false){
    
    $_this =& get_instance();

    if($id_usuario === false){
      $id_usuario = $_this->session->userdata('uid');
    }
    
    
    $_this->db->select('p.nome');
    $_this->db->from('faturas AS f');
    $_this->db->join('planos AS p', 'p.id = f.id_plano', 'inner');
    $_this->db->where('f.id_usuario', $id_usuario);
    $_this->db->order_by('f.data_pagamento', 'desc');
    $_this->db->limit(1);
        $planuser = $_this->db->get();

    if($planuser->num_rows() > 0){
		$plan =  $planuser->result();
        return $plan[0]->nome;
		//return $planuser->row();
      
	}

    return false;
	
}
/*edward*/

/*edward*/
function verDirectosID($id_usuario = false){
    
    $_this =& get_instance();

    if($id_usuario === false){
      $id_usuario = $_this->session->userdata('uid');
    }
	
    $_this->db->from('rede');
    $_this->db->where("id_patrocinador = $id_usuario  and plano_ativo = 1 and (chave_binaria=1 or chave_binaria = 2)" );
	$directoID = $_this->db->get();

    if($directoID->num_rows() > 0){
		$directoIDok =  $directoID->result();
        //return true;
		return $directoIDok;
	}

    return false;
	
}

/*edward*/

function consultaPlanGanancias($id_usuario)
{
  $_this = &get_instance();
  $_this->db->from('faturas AS f');
  $_this->db->join('planos AS p', 'p.id = f.id_plano', 'inner');
  $_this->db->where('f.id_usuario', $id_usuario);
  $_this->db->where('p.valor >=', 0); 	
  $_this->db->order_by('f.data_pagamento', 'desc');
  $_this->db->limit(1);

  $planuser = $_this->db->get();
  $plan =  $planuser->result();
  return $plan[0]->ganhos_maximo;
}//beto => edward corregido


/*ver Plan actual usuario Withdraw*/
function verPlanActualUsuario($id_usuario = false){
	
 	$_this =& get_instance();

    if($id_usuario === false){
      $id_usuario = $_this->session->userdata('uid');
    }
	
    $_this->db->from('faturas AS f');
  	$_this->db->join('planos AS p', 'p.id = f.id_plano', 'inner');
  	$_this->db->where('f.id_usuario', $id_usuario);	
  	$_this->db->order_by('f.data_pagamento', 'desc');
  	$_this->db->limit(1);
	$planUsuarioActual = $_this->db->get();

    if($planUsuarioActual->num_rows() > 0){
		$planUsuarioActualResult =  $planUsuarioActual->result();
        //return true;
		return $planUsuarioActualResult;
	}

    return false;	
	
}//edward

/*ver Plan actual usuario Withdraw*/





function verificarLadosBinarios($id_usuario)
{

  $_this = &get_instance();



  $_this->db->where('id_patrocinador_direto', $id_usuario);
  $_this->db->where('chave_binaria', '1');

  $izq = $_this->db->get('rede');




  if ($izq->num_rows() > 0) {
    $_this->db->where('id_patrocinador_direto', $id_usuario);
    $_this->db->where('chave_binaria', '2');
    $der = $_this->db->get('rede');


    if ($der->num_rows() > 0) {
      return 'true';
    } else {
      return 'false';
    }
  } else {
    return 'false';
  }
} //beto





function GravaExtrato($id_usuario, $valor, $mensagem, $tipo, $data = false)
{

  $_this = &get_instance();

  if (!$data) {
    $data = date('Y-m-d H:i:s');
  }

  $dados = array(
    'id_usuario' => $id_usuario,
    'mensagem' => $mensagem,
    'valor' => $valor,
    'tipo' => $tipo,
    'data' => $data
  );

  $_this->db->insert('extrato', $dados);
	
 
		
	
}







function consultaPatrocinador($id_usuario)
{
  $_this = &get_instance();
  $_this->db->from('rede AS r');
  $_this->db->join('usuarios AS u', 'u.id = r.id_usuario', 'inner');
  $_this->db->where('r.id_usuario', $id_usuario);

  $planuser = $_this->db->get();
  $plan =  $planuser->result();
  $id_patrocinador = $plan['0']->id_patrocinador_direto;
  return InformacoesUsuario('nome', $id_patrocinador);
}//beto







function EnviaNotificacao($id_usuario, $mensagem, $admin = 0)
{

  $_this = &get_instance();

  $dadosNotificacao = array(
    'for_admin' => $admin,
    'id_usuario' => $id_usuario,
    'icone' => 1,
    'mensagem' => $mensagem,
    'data' => date('Y-m-d H:i:s'),
    'visualizada' => 0
  );

  $_this->db->insert('notificacoes', $dadosNotificacao); 
}

/*
function redesUsuariosRecursividad($userid, $chave_binaria){

        if($chave_binaria !== false){
            $_this->db->where('chave_binaria', $chave_binaria);
        }

        $_this->db->where('chave_binaria', $chave_binaria);
        $_this->db->where('id_patrocinador', $userid);
        $rede = $_this->db->get('rede');

        if($rede->num_rows() > 0){

            foreach($rede->result() as $row){

                $_this->contador++;

                $_this->redesUsuariosRecursividad($row->id_usuario, false);

            }
        }

        return $_this->contador;
}
*/




function countryDetected($id, $ip){
  $_this = &get_instance();



  $_this->db->where('id_usuario', $id);
  $country = $_this->db->get('country');

  if($country->num_rows() > 0){

  }else{

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_URL, 'https://ipinfo.io/'.$ip.'?token=b9893266e01723');
    $res = curl_exec($curl);
    curl_close($curl);
    $jo = json_decode($res);



    
    $data = array(
      'id_usuario' => $id,
      'country' => $jo->country,
      'city' => $jo->city,
      'region' => $jo->region,
      'ip' => $jo->ip,
      'timezone' => $jo->timezone,
      'loc' => $jo->loc,
      'org' => $jo->org,
    );

    $_this->db->insert('country', $data);

  } 

}



 
function EnviarEmail($para, $assunto, $mensagem){

    $_this =& get_instance();

    if(ConfiguracoesSistema('smtp_enabled') == 1){

      $config['protocol']  = 'smtp';
      $config['smtp_host'] = 'in-v3.mailjet.com';
      $config['smtp_user'] = '002d07015dd9b8010422544a7a95bbbc';
      $config['smtp_pass'] = '398894a5928f1de318733958c648bcd1';
      $config['smtp_port'] = 587; // Usar 587 para TLS, 25 es una opción pero 587 es más seguro
      $config['smtp_crypto'] = 'tls';

      /*if(ConfiguracoesSistema('smtp_encrypt') != ''){
        $config['smtp_crypto'] = ConfiguracoesSistema('smtp_encrypt');
      }else{
        $config['smtp_crypto'] = 'ssl';
      }*/
 
      $_this->email->initialize($config);
    }

    $_this->email->to($para);
    $_this->email->from(ConfiguracoesSistema('email_remetente'), ConfiguracoesSistema('nome_site'));
    $_this->email->set_mailtype('html');
    $_this->email->subject($assunto);
    $_this->email->message($mensagem);
    $_this->email->send();
}


/*========= edward nuevas funciones =========*/

/*funcion para ver en que lado me inscribi*/
function verLadoPatroDirecto($id_usuario = false){
    
    $_this =& get_instance();

    if($id_usuario === false){
      $id_usuario = $_this->session->userdata('uid');
    }
	
    $_this->db->from('rede');
    $_this->db->where("id_usuario = $id_usuario" );
	$ladoInsPatDir = $_this->db->get();

    if($ladoInsPatDir->num_rows() > 0){
		$ladoInsPatDirResult =  $ladoInsPatDir->result();
        //return true;
		return $ladoInsPatDirResult;
	}

    return false;
	
}
/*funcion para ver en que ladof me inscribi*/

/*funcion para ver mis referidos directos*/

function misReferidosDirectosCalificadores($id_usuario = false){
    
    $_this =& get_instance();

    if($id_usuario === false){
      $id_usuario = $_this->session->userdata('uid');
    }
	
    $_this->db->from("rede as r

					INNER JOIN faturas as f
					ON r.id_usuario = f.id_usuario 

					INNER JOIN planos as p 
					ON f.id_plano = p.id
					
					WHERE r.id_patrocinador_direto  = $id_usuario AND f.status = 1 AND f.comprovante!='' AND f.data_pagamento!='' AND p.valor>0
					GROUP BY (r.chave_binaria)
					ORDER BY f.data_pagamento  DESC 
	
					");
	$refDirectos = $_this->db->get();
	
	
    if($refDirectos->num_rows() > 0){
		$refDirectosResult =  $refDirectos->result();
        //return true;
		return $refDirectosResult;
	}

    return false;
	
}

/*funcion para ver mis referidos directos*/





/*funcion ver si tengo corte*/
function verCorteUser($id_usuario = false){
    
    $_this =& get_instance();

    if($id_usuario === false){
      $id_usuario = $_this->session->userdata('uid');
    }
	
    $_this->db->from('cortes');
    $_this->db->where("id_usuario = $id_usuario and estado = 0");
	$ladoInsPatDir = $_this->db->get();

    if($ladoInsPatDir->num_rows() > 0){
		$ladoInsPatDirResult =  $ladoInsPatDir->result();
        //return true;
		return $ladoInsPatDirResult;
	}

    return false;
	
}
/*funcion ver si tengo corte*/



/*funcion para quitar puntos del corte de la otra pierna*/
function puntosParaCortar($id_usuario = false, $chave_binaria, $data){
    
    $_this =& get_instance();

    if($id_usuario === false){
      $id_usuario = $_this->session->userdata('uid');
    }
	
    $_this->db->from('rede_pontos_binario');
    $_this->db->where("id_usuario = $id_usuario 
						and chave_binaria = $chave_binaria 
						and pago = 0 
					  	 and data <= '$data'"
					 
					 );
	$puntosCortar = $_this->db->get();

    if($puntosCortar->num_rows() > 0){
		$puntosCortarResult =  $puntosCortar->result();
        //return true;
		return $puntosCortarResult;
	}

    return false;
	
}
/*funcion para quitar puntos del corte de la otra pierna*/




/*sacar datos qualifier*/ 

function getQualifiedUser($id_usuario = false){
    
    $_this =& get_instance();

    if($id_usuario === false){
      $id_usuario = $_this->session->userdata('uid');
    }
	
	/*$_this->db->distinct();
	$_this->db->select('id_user_giver');
    $_this->db->from("qualified AS q GROUP BY (id_user_giver)");*/
	
    $_this->db->from("qualified AS q GROUP BY (id_usuario)");
	
	  $qualifiedUser = $_this->db->get();
	
	
    if($qualifiedUser->num_rows() > 0){
      $qualifiedUserResult =  $qualifiedUser->result();
          //return true;
      return $qualifiedUserResult;
    }

    return false;
	
}


function redeMaxSepNivel($user = false, $niveis = 8, $binario = 2){
		
		
        if($niveis > 0){

            $this->db->where('id_patrocinador', $user);
            $this->db->where('chave_binaria', 2);
            $this->db->where('plano_ativo', 1);// for view right side without plan | Edward
            $BinarioDireito = $this->db->get('rede');


            $this->db->where('id_patrocinador', $user);
            $this->db->where('chave_binaria', 1);
            $this->db->where('plano_ativo', 1);// for view left side without plan | Edward
            $BinarioEsquerdo = $this->db->get('rede');



            $recursivo .= '<ul>';
		 
            for($i = 1; $i<= $binario; $i++){

                $lado = ($i == 1) ? 'Esquerdo' : 'Direito';
					
                if($i == 1){
					 	
                    if($BinarioEsquerdo->num_rows() > 0){

                        $rowEsquerdo = $BinarioEsquerdo->row();


                        $patro = InformacoesUsuario('login', $rowEsquerdo->id_patrocinador_direto);
						
						 
						

                        $recursivo .= '<li>';

                        $recursivo .= '<font class="color-red">'.InformacoesUsuario('login', $rowEsquerdo->id_usuario).'</font><br />';

                        redeMaxSepNivel($rowEsquerdo->id_usuario, $niveis-1);

                        $recursivo .= '</li>';
                    }else{

                        $recursivo .= '<li>';

                        $recursivo .= 'vacio';

                        redeMaxSepNivel(false, $niveis-1);

                        $recursivo .= '</li>';
                    }
                }

                if($i == 2){
					 	
                    if($BinarioDireito->num_rows() > 0){

                        $rowDireito = $BinarioDireito->row();


                        $patro = InformacoesUsuario('login', $rowDireito->id_patrocinador_direto);
						
						 
                        $recursivo .= '<li>';

                        $recursivo .= '<font class="color-red">'.InformacoesUsuario('login', $rowDireito->id_usuario).'</font>';

                        redeMaxSepNivel($rowDireito->id_usuario, $niveis-1);

                        $recursivo .= '</li>';
                    }else{

                        $recursivo .= '<li>';

                        $recursivo .= 'vacio';

                        redeMaxSepNivel(false, $niveis-1);

                        $recursivo .= '</li>';
                    }
                }
            }

            $recursivo .= '</ul>';
        }
}



/*
function viewQualifiedUser($id){
    
    $_this =& get_instance();

    if($id_usuario === false){
      $id_usuario = $_this->session->userdata('uid');
    }
	
    $_this->db->from("
						qualified 
						WHERE id_usuario = $id 
						ORDER BY date DESC
	
					");
	$viewqualifiedUser = $_this->db->get();
	
	
    if($viewqualifiedUser->num_rows() > 0){
		$viewqualifiedUserResult =  $viewqualifiedUser->result();
        //return true;
		return $viewqualifiedUserResult;
	}

    return false;
	
}*/

/*sacar datos qualifier*/


/*ver ultimos 3 planes usuario*/
function usersLastThree($id_usuario = false){
    
    $_this =& get_instance();

    if($id_usuario === false){
      $id_usuario = $_this->session->userdata('uid');
    }
    
    
    $_this->db->select('p.nome, p.valor, p.ganhos_maximo, f.data_pagamento, f.id, p.teto_binario');
    $_this->db->from('faturas AS f');
    $_this->db->join('planos AS p', 'p.id = f.id_plano', 'inner');
    $_this->db->where('f.id_usuario', $id_usuario);
	$_this->db->where('p.id != 89327542');
    $_this->db->order_by('f.data_pagamento', 'desc');
    $_this->db->limit(3);
        $planuser = $_this->db->get();

    if($planuser->num_rows() > 0){
		$planResult =  $planuser->result();
        return $planResult;
		//return $planuser->row();
      
	}

    return false;
	
}
/*ver ultimos 3 planes usuario*/


/*========= edward nuevas funciones =========*/


