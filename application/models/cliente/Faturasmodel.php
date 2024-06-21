<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Faturasmodel extends CI_Model{

    protected $userid;
    protected $rede_total = array();
    protected $todos_niveis = array();

    public function __construct(){
        parent::__construct();

        $this->userid = InformacoesUsuario('id');
    }

    public function ProcuraPatrocinador($id_usuario, $id_patrocinador, $chave_binaria){
        
        $this->db->where('id_patrocinador', $id_patrocinador);
        $this->db->where('chave_binaria', $chave_binaria);
        $this->db->where('id_usuario != ', $id_usuario);
        $this->db->where('plano_ativo', 1);
        $this->db->order_by('id', 'ASC');
        $rede = $this->db->get('rede');
        
        if($rede->num_rows() > 0){
            
            $row = $rede->row();
            
            return $this->ProcuraPatrocinador($id_usuario, $row->id_usuario, $chave_binaria);
            
        }
        
        return $id_patrocinador;
    }
    
    public function AtualizaPatrocinador($id_usuario){
        
        $this->db->where('id_usuario', $id_usuario);
        $rede = $this->db->get('rede');
        
        if($rede->num_rows() > 0){
            
            $row = $rede->row();
            
            $id_patrocinador_atual = $row->id_patrocinador;
            $posicao_atual = $row->chave_binaria;
            
            return $this->ProcuraPatrocinador($id_usuario, $id_patrocinador_atual, $posicao_atual);
        }
    }

    public function VerificaBinarioAtivo($id_fatura){

        $this->db->select('f.*, p.binario');
        $this->db->from('faturas AS f');
        $this->db->join('planos AS p', 'p.id = f.id_plano', 'inner');
        $this->db->where('f.id', $id_fatura);
        $fatura = $this->db->get();
    
        if($fatura->num_rows() > 0){
    
            $row = $fatura->row();
    
            $this->rede_total = array();
            $this->LinhaIndicacao($row->id_usuario, 1000000);
    
            if(!empty($this->rede_total)){
    
                foreach($this->rede_total as $patrocinadores){
    
                    $this->db->where('id_usuario', $patrocinadores);
                    $this->db->where('plano_ativo', 1);
                    $rede = $this->db->get('rede');
    
                    if($rede->num_rows() > 0){
                        
                        if(InformacoesUsuario('binario', $patrocinadores) == 0){
    
                            $this->db->where('id_patrocinador_direto', $patrocinadores);
                            $this->db->where('chave_binaria', 1);
                            $this->db->where('plano_ativo', 1);
                            $LadoEsquerdo = $this->db->get('rede');
    
                            $this->db->where('id_patrocinador_direto', $patrocinadores);
                            $this->db->where('chave_binaria', 2);
                            $this->db->where('plano_ativo', 1);
                            $LadoDireito = $this->db->get('rede');
    
                            if($LadoEsquerdo->num_rows() > 0 && $LadoDireito->num_rows() > 0){
    
                                $this->db->where('id', $patrocinadores);
                                $this->db->update('usuarios', array('binario'=>1));
                            }
                        }
                    }
                }
            }
        }
    }

    public function CriaTodosNiveis(){

        $this->db->order_by('nivel', 'ASC');
        $niveis = $this->db->get('configuracao_nivel_indicacoes');

        if($niveis->num_rows() > 0){

            foreach($niveis->result() as $nivel){

                $this->todos_niveis[$nivel->nivel] = $nivel->porcentagem;
            }
        }
    }

    public function LinhaIndicacao($id, $niveis, $bonus = false){

        if($niveis > 0){

            $this->db->where('id_usuario', $id);
            $patrocinadores = $this->db->get('rede');

            if($patrocinadores->num_rows() > 0){

                $row = $patrocinadores->row();

                if(!$bonus){
                    $id = $row->id_patrocinador;
                }else{
                    $id = $row->id_patrocinador_direto;
                }

                $this->rede_total[] = $id;

                $this->LinhaIndicacao($id, $niveis-1, $bonus);
            }
        }
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

    public function CheckChaveBinariaVazia($id_usuario, $id_patrocinador, $chave_binaria){

            $this->db->where('id_patrocinador', $id_patrocinador);
            $this->db->where('chave_binaria', $chave_binaria);
            $this->db->where('plano_ativo', 1);
            $patrocinadores = $this->db->get('rede');

            if($patrocinadores->num_rows() > 0){

                $row = $patrocinadores->row();

                if($row->id_usuario != $id_usuario){

                    return array('id_patrocinador'=>$this->EncontraLadoVazio($id_patrocinador, $chave_binaria));

                }else{
                    return array('id_patrocinador'=>$id_patrocinador);
                }
                
            }else{

                return array('id_patrocinador'=>$id_patrocinador);
            }
        
    }

    public function MinhasFaturas(){

        $this->db->select('p.*, f.id AS id_fatura,  f.comprovante, f.status');
        $this->db->from('faturas AS f');
        $this->db->join('planos AS p', 'p.id = f.id_plano', 'inner');
        $this->db->where('f.id_usuario', $this->userid);
        $faturas = $this->db->get();

        if($faturas->num_rows() > 0){

            return $faturas->result();
        }

        return false;
    }

    public function FormasPagamento(){

        $pagamento = $this->db->get('contas_pagamento');

        if($pagamento->num_rows() > 0){

            return $pagamento->result();
        }

        return false;
    }

    public function ValorFatura($id_fatura){

        $this->db->select('p.valor, f.status');
        $this->db->from('faturas AS f');
        $this->db->join('planos AS p', 'p.id = f.id_plano', 'inner');
        $this->db->where('f.id', $id_fatura);
        $fatura = $this->db->get();

        if($fatura->num_rows() > 0){

            $row = $fatura->row();

            if($row->status == 0){

                return json_encode(array('status'=>1, 'valor_fatura'=>$row->valor));

            }

            return json_encode(array('status'=>2));
        }

        return json_encode(array('status'=>0));
    }

    public function PagarFatura($id_fatura, $pagamento){

        $fatura = json_decode($this->ValorFatura($id_fatura));

        if($fatura->status == 1){

            if($pagamento == 1){

                $saldo = InformacoesUsuario('saldo_rendimentos');

                if($saldo < $fatura->valor_fatura){
                    return json_encode(array('status'=>4));
                }

                //$novo_saldo = $saldo-$fatura->valor_fatura;
				$novo_saldo = $saldo;
				
				/*evitar saldo negativo | Edward*/
				if($novo_saldo<0){
					$novo_saldo = 0;
				}
				/*evitar saldo negativo | Edward*/

                $this->db->where('id', $this->userid);
                $updateCash = $this->db->update('usuarios', array('saldo_rendimentos'=>$novo_saldo));

            }else{

                $saldo = InformacoesUsuario('saldo_indicacoes');

                if($saldo < $fatura->valor_fatura){
                    return json_encode(array('status'=>4));
                }

                //$novo_saldo = $saldo-$fatura->valor_fatura;
				$novo_saldo = $saldo;
				
				/*evitar saldo negativo | Edward*/
				if($novo_saldo<0){
					$novo_saldo = 0;
				}
				/*evitar saldo negativo | Edward*/

                $this->db->where('id', $this->userid);
                $updateCash = $this->db->update('usuarios', array('saldo_indicacoes'=>$novo_saldo));
            }

            $this->db->select('p.plano_carreira, p.valor, p.binario, f.id_usuario');
            $this->db->from('faturas AS f');
            $this->db->join('planos AS p', 'p.id = f.id_plano', 'inner');
            $this->db->where('f.id', $id_fatura);
            $faturaQuery = $this->db->get();

            if($faturaQuery->num_rows() > 0){

                $rowFatura = $faturaQuery->row();

                $this->db->where('id_usuario', $rowFatura->id_usuario);
                $redeAfiliado = $this->db->get('rede');

                if($redeAfiliado->num_rows() > 0){

                    $rowAfiliado = $redeAfiliado->row();

                    $conta_niveis = $this->db->get('configuracao_nivel_indicacoes');

                    if($conta_niveis->num_rows() > 0){

                        $this->rede_total = array();
                        $this->LinhaIndicacao($rowFatura->id_usuario, $conta_niveis->num_rows(), true);
                        $this->CriaTodosNiveis();

                        if(!empty($this->rede_total)){

                            foreach($this->rede_total as $nivel=>$patrocinador){

                                if(isset($this->todos_niveis[$nivel+1])){

                                    $bonusIndicacao = ($this->todos_niveis[$nivel+1]/100) * $rowFatura->valor;

                                    $novoSaldoIndicacao = InformacoesUsuario('saldo_indicacoes', $patrocinador) + $bonusIndicacao;
									
									
									/*LOGICA | limitar ganancias saldo_indicacoes | Edward */
									$maxGananciaSI_OLD = consultaPlanGanancias($patrocinador);
									
									/*nuevo maximo 300% de 3 paquetes*/
									$plansThree =  usersLastThree($ponto->id_usuario);

									$maxGananciaThree = 0;
									if($plansThree){

										foreach($plansThree as $plansAll){
											//echo "<br>nombre: ".$plansAll->nome." valor: ".$plansAll->valor." max".$plansAll->ganhos_maximo;
											$maxGananciaThree += $plansAll->ganhos_maximo;
										}

									}


									$maxGananciaSI = $maxGananciaThree;
									/*nuevo maximo 300% de 3 paquetes*/
			
									$rendimientosSI = InformacoesUsuario('saldo_rendimentos', $patrocinador);
									$referidosGananciaSI = InformacoesUsuario('saldo_indicacoes', $patrocinador);
									
									$sumaRendimientos = $rendimientosSI + $referidosGananciaSI + $novoSaldoIndicacao; 
									
									if($sumaRendimientos>$maxGananciaSI){
										//do nothing
										
									}elseif($sumaRendimientos==$maxGananciaSI){
										
										$this->db->where('id', $patrocinador);
                                    	$this->db->update('usuarios', array('saldo_indicacoes'=>$novoSaldoIndicacao));
										
                                          
										
										
									}else{
										
										/*LOGICA | filtrando menor con los decimales*/
										$novoSaldoIndicacao_ = round($novoSaldoIndicacao);
										
										$rendimientosSI_ = round($rendimientosSI);
										$referidosGananciaSI_ = round($referidosGananciaSI);

										$maxGananciaSI_ = round($maxGananciaSI);
										$sumaRendimientos_ = $rendimientosSI_ + $referidosGananciaSI_ + $novoSaldoIndicacao_; 
										
										if($sumaRendimientos_<$maxGananciaSI_){
											
											//correcto inserta
											$this->db->where('id', $patrocinador);
                                    		$this->db->update('usuarios', array('saldo_indicacoes'=>$novoSaldoIndicacao));
											
											GravaExtrato($patrocinador, $bonusIndicacao, 'User Referral Bonus '.InformacoesUsuario('login',$rowFatura->id_usuario), 1);
											
										}else{
											
											
											
											//setea e inserta
											$sumaRendimientos_1 = $rendimientosSI_ + $referidosGananciaSI_; 
											$novoSaldoIndicacaoMax = $sumaRendimientos_1 - $maxGananciaSI_;
											
											$this->db->where('id', $patrocinador);
                                    		$this->db->update('usuarios', array('saldo_indicacoes'=>$novoSaldoIndicacaoMax));
											
											GravaExtrato($patrocinador, $bonusIndicacao, 'User Referral Bonus '.InformacoesUsuario('login',$rowFatura->id_usuario), 1);
											
										}
										
										/*LOGICA | filtrando menor con los decimales*/
										
										
									}
									
									
									/*LOGICA | limitar ganancias saldo_indicacoes | Edward */


									 

                                }
                            }
                        }
                    }

                    
                    $this->db->where('id_usuario', $rowFatura->id_usuario);
                    $this->db->where('plano_ativo', 1);
                    $redeCheck = $this->db->get('rede');
                    
                    if($redeCheck->num_rows() <= 0){
                        
                        $id_patrocinador = $this->AtualizaPatrocinador($rowFatura->id_usuario);
    
                        $this->db->where('id_usuario', $rowFatura->id_usuario);
                        $this->db->update('rede', array('id_patrocinador'=>$id_patrocinador, 'plano_ativo'=>1));
                    
                    }
                }

                $this->rede_total = array();
                $this->LinhaIndicacao($rowFatura->id_usuario, 1000000);

                if(!empty($this->rede_total)){

                    if(isset($rowAfiliado)){
                        $LadoChaveBinaria = $rowAfiliado->chave_binaria;
                    }else{
                        $LadoChaveBinaria = 1;
                    }

                    foreach($this->rede_total as $patrocinadores){

                        $this->db->where('id_usuario', $patrocinadores);
                        $rede = $this->db->get('rede');

                        if($rede->num_rows() > 0){

                            $rowRede = $rede->row();
                            

                            $dadosBinario = array(
                                                  'id_usuario'=>$patrocinadores,
                                                  'pontos'=>$rowFatura->plano_carreira,
                                                  'chave_binaria'=>$LadoChaveBinaria,
                                                  'pago'=>0,
                                                  'data'=>date('Y-m-d H:i:s')
                                                );

                            $this->db->insert('rede_pontos_binario', $dadosBinario);

                            $LadoChaveBinaria = $rowRede->chave_binaria;

                        }else{

                            /* Caso o patrocinador não estiver na rede de ninguém, coloca os pontos no lado esquerdo */

                            $dadosBinario = array(
                                                  'id_usuario'=>$patrocinadores,
                                                  'pontos'=>$rowFatura->plano_carreira,
                                                  'chave_binaria'=>1,
                                                  'pago'=>0,
                                                  'data'=>date('Y-m-d H:i:s')
                                                );

                            $this->db->insert('rede_pontos_binario', $dadosBinario);
                        }
                    }
                }
            }

            if($updateCash){

                $this->db->where('id', $id_fatura);
                $this->db->update('faturas', array('status'=>1, 'comprovante'=> 'fpagsaldo.jpg', 'data_pagamento'=>date('Y-m-d')));

                $this->db->where('id', $rowFatura->id_usuario);
                $usuarioQuery = $this->db->get('usuarios');

                if($usuarioQuery->num_rows() > 0){

                    $rowUser = $usuarioQuery->row();

                    if($rowUser->quantidade_binario < $rowFatura->binario){

                        $this->db->where('id', $rowFatura->id_usuario);
                        $this->db->update('usuarios', array('quantidade_binario'=>$rowFatura->binario));
                    }
                }
                
                $this->db->select('u.login');
                $this->db->from('faturas AS f');
                $this->db->join('usuarios AS u', 'u.id = f.id_usuario', 'inner');
                $this->db->where('f.id', $id_fatura);
                $userInvoice = $this->db->get();

                if($userInvoice->num_rows() > 0){
                    $InvoiceOwner = $userInvoice->row()->login;
                }else{
                    $InvoiceOwner = '(não identificado)';
                }

                GravaExtrato($this->userid, $fatura->valor_fatura, 'User invoice payment <b>'.$InvoiceOwner.'</b> with balance', 2);
				
				
                EnviaNotificacao($rowFatura->id_usuario, 'Invoice released successfully!');

                $this->VerificaBinarioAtivo($id_fatura);

                return json_encode(array('status'=>1)); 
            }

        }elseif($fatura->status == 2){

            return json_encode(array('status'=>2));

        }else{

            return json_encode(array('status'=>3));
        }
    }
}
?>