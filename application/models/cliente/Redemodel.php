<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Redemodel extends CI_Model{

    protected $userid;
    protected $matrizHTML;
    protected $contagem = 0;
    protected $todos_rede = array();

    public function __construct(){
        parent::__construct();

        $this->userid = InformacoesUsuario('id');
    }

    public function TodosRede($id_patrocinador){

        $this->db->where('id_patrocinador', $id_patrocinador);
        $this->db->where('plano_ativo', 1);
        $rede = $this->db->get('rede'); 

        if($rede->num_rows() > 0){

            foreach($rede->result() as $row){

                $this->todos_rede[] = $row->id_usuario;

                $this->TodosRede($row->id_usuario);

            }
        }
    }

    public function ExisteNaRede($id_usuario){

        $this->todos_rede = array();

        $id_visualizador = $this->userid;

        $this->TodosRede($id_visualizador);

        if(in_array($id_usuario, $this->todos_rede)){

            return true;
        }else{
            return false;
        }
    }

    public function QuantidadeTodaRede(){

        $this->TodosRede($this->userid);

        return count($this->todos_rede);
    }

    public function QuantidadeRede($userid, $chave_binaria = 1){

        if($chave_binaria !== false){
            $this->db->where('chave_binaria', $chave_binaria);
        }

        $this->db->where('plano_ativo', 1);
        $this->db->where('id_patrocinador', $userid);
        $rede = $this->db->get('rede');

        if($rede->num_rows() > 0){

            foreach($rede->result() as $row){

                $this->contagem++;

                $this->QuantidadeRede($row->id_usuario, false);

            }
        }

        return $this->contagem;
    }

    public function PlanoActualUsuario($userid){

        $this->db->select('P.nome');
        $this->db->from('faturas AS F');
        $this->db->join('planos AS P', 'F.id_plano = P.id', 'inner');
        $this->db->where('F.id_usuario', $userid);
        $this->db->where('F.status', 1);
        $this->db->order_by('F.id', 'DESC');
        $this->db->limit(1);
        $planos = $this->db->get();

        // $planos = $this->db->query("SELECT P.nome 
        //                             FROM faturas F 
        //                             INNER JOIN planos P 
        //                             ON F.id_plano = P.id 
        //                             WHERE id_usuario = " . $userid . " ORDER BY F.id DESC LIMIT 0,1;");

        if($planos->num_rows() > 0){
            $plano = $planos->row();
            $plano_nom = $plano->nome;
            return $plano_nom;
        }else{
            return '--';
        }
    
    }

    public function CriaDesenhaMatriz($user = false, $niveis = 1000, $binario = 2){

        if($niveis > 0){

            $this->db->where('id_patrocinador', $user);
            $this->db->where('chave_binaria', 2);
            $this->db->where('plano_ativo', 1);// for view right side without plan | Edward
            $BinarioDireito = $this->db->get('rede');


            $this->db->where('id_patrocinador', $user);
            $this->db->where('chave_binaria', 1);
            $this->db->where('plano_ativo', 1);// for view left side without plan | Edward
            $BinarioEsquerdo = $this->db->get('rede');



            $this->matrizHTML .= '<ul>';
		 
            for($i = 1; $i<= $binario; $i++){

                $lado = ($i == 1) ? 'Esquerdo' : 'Direito';
					
                if($i == 1){
					 	
                    if($BinarioEsquerdo->num_rows() > 0){

                        $rowEsquerdo = $BinarioEsquerdo->row();

                        $plano_user = $this->PlanoActualUsuario($rowEsquerdo->id_usuario);

                        $patro = InformacoesUsuario('login', $rowEsquerdo->id_patrocinador_direto);
						
						/*edward*/
						$this->contagem = 0;
						$LadoEsquerdo = $this->QuantidadeRede($rowEsquerdo->id_usuario, 1);
							
						$this->contagem = 0;		
						$LadoDireito = $this->QuantidadeRede($rowEsquerdo->id_usuario, 2);

						$ladosTodo = '<br>Left side: '.$LadoEsquerdo.'<br />Right side: '.$LadoDireito;

 
						 	
						/*edward*/
						

                        $this->matrizHTML .= '<li>';

                        $this->matrizHTML .= '<a href="?network_id='.$rowEsquerdo->id_usuario.'"><img src="'.base_url().'assets/imgs/redesIcon-new.png" border="0" class="tooltipster" title="User: '.InformacoesUsuario('login', $rowEsquerdo->id_usuario).'  <br /> Sponsor: '. $patro .' <br /> Plans: '. $plano_user .' '.$ladosTodo.'" width="50" style="opacity: 1"/>
                        </a> <br /> <font class="color-red">'.InformacoesUsuario('login', $rowEsquerdo->id_usuario).'</font><br />';

                        $this->CriaDesenhaMatriz($rowEsquerdo->id_usuario, $niveis-1);

                        $this->matrizHTML .= '</li>';
                    }else{

                        $this->matrizHTML .= '<li>';

                        $this->matrizHTML .= '<img src="'.base_url().'assets/imgs/redesIcon-new.png" width="50" style="opacity: 0.4"/> <br /><font class="color-red">&nbsp;</font>';

                        $this->CriaDesenhaMatriz(false, $niveis-1);

                        $this->matrizHTML .= '</li>';
                    }
                }

                if($i == 2){
					 	
                    if($BinarioDireito->num_rows() > 0){

                        $rowDireito = $BinarioDireito->row();

                        $plano_user = $this->PlanoActualUsuario($rowDireito->id_usuario);

                        $patro = InformacoesUsuario('login', $rowDireito->id_patrocinador_direto);
						
						/*edward*/
						$this->contagem = 0;
						$LadoEsquerdo_ = $this->QuantidadeRede($rowDireito->id_usuario, 1);
							
						$this->contagem = 0;	
						$LadoDireito_ = $this->QuantidadeRede($rowDireito->id_usuario, 2);

						$ladosTodo_ = '<br>Left side: '.$LadoEsquerdo_.'<br />Right side: '.$LadoDireito_;
						/*edward*/
						

                        $this->matrizHTML .= '<li>';

                        $this->matrizHTML .= '<a href="?network_id='.$rowDireito->id_usuario.'"><img src="'.base_url().'assets/imgs/redesIcon-new.png" border="0" class="tooltipster" title="User: '.InformacoesUsuario('login', $rowDireito->id_usuario).' <br /> Sponsor: '. $patro .' <br /> Plans: '. $plano_user .''.$ladosTodo_.'" width="50" style="opacity: 1"/></a> <br /><font class="color-red">'.InformacoesUsuario('login', $rowDireito->id_usuario).'</font>';

                        $this->CriaDesenhaMatriz($rowDireito->id_usuario, $niveis-1);

                        $this->matrizHTML .= '</li>';
                    }else{

                        $this->matrizHTML .= '<li>';

                        $this->matrizHTML .= '<img src="'.base_url().'assets/imgs/redesIcon-new.png" width="50" style="opacity: 0.4"/> <br /><font class="color-red">&nbsp;</font>';

                        $this->CriaDesenhaMatriz(false, $niveis-1);

                        $this->matrizHTML .= '</li>';
                    }
                }
            }

            $this->matrizHTML .= '</ul>';
        }
    }

    public function Matriz($id = false){

        if(!$id || empty($id)){
            $id = $this->userid;
        }

        if($this->ExisteNaRede($id) || $id == $this->userid){

            $this->db->where('id', $id);
            $usuarios = $this->db->get('usuarios');

            if($usuarios->num_rows() > 0){

                $LadoEsquerdo = $this->QuantidadeRede($id, 1);

                $this->contagem = 0;

                $LadoDireito = $this->QuantidadeRede($id, 2);
				
				/*patrocinador directo*/
				$this->db->where('id_usuario', $id);
            	$patrocinardorDirectoC = $this->db->get('rede');
				
				$patroD = $patrocinardorDirectoC->row();
				$nom_patro = InformacoesUsuario('login', $patroD->id_patrocinador);
				/*patrocinador directo*/
				
				/*plan*/
				$planUserTop = $this->PlanoActualUsuario($id);
				/*plan*/

                $this->matrizHTML .= '<li>';
                $this->matrizHTML .= '<a href="#"><img src="'.base_url().'assets/imgs/redesIcon-new.png" class="tooltipster" title="User: '.InformacoesUsuario('login', $id).' <br />Sponsor: '.$nom_patro.' <br />Plan: '.$planUserTop.'<br/> Left side: '.$LadoEsquerdo.'<br />Right side: '.$LadoDireito.'" border="0" width="50" /></a> <br /> <font class="color-red">'.InformacoesUsuario('login', $id).'</font>';
                $this->matrizHTML .= $this->CriaDesenhaMatriz($id, 4);
                $this->matrizHTML .= '</li>';

                return $this->matrizHTML;

            }
        }
    }
	
    public function VoltaNivelAcima($id_usuario){

        if($id_usuario != $this->userid){

            $this->db->where('id_usuario', $id_usuario);
            $rede = $this->db->get('rede');

            if($rede->num_rows() > 0){

                $row = $rede->row();

                return $row->id_patrocinador;
            }

            return false;  
        }

        return false;
    }
}
?>