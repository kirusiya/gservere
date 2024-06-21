<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
defined('BASEPATH') OR exit('No direct script access allowed');

class Faturasmodel extends CI_Model{

    protected $rede_total = array();
    protected $todos_niveis = array();
    protected $Rangomodel;

    public function __construct(){
        parent::__construct();
        $this->load->model('admin/Rangomodel', 'Rangomodel');  //DIEGO
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

    public function PlanosAtivos(){

        $this->db->where('status', !0);
        $planos = $this->db->get('faturas');

        return $planos->num_rows();
    } 
	
	
	/*edward planes admin*/
	
	public function PlanesPagados(){

        $this->db->where('description="All Features" or description ="Purchased by user"');
        $planos = $this->db->get('faturas');

        return $planos->num_rows();
    } 
	
	public function PlanesGratis(){

        $this->db->where('description="Free"');
        $planos = $this->db->get('faturas');

        return $planos->num_rows();
    } 
	/*edward planes admin*/

    public function TodasFaturas($status = false){

        $this->db->select('f.comprovante, f.id, f.id_usuario, p.nome, p.valor, f.address, f.data_pagamento, f.description, f.coin, f.*'); //DIEGO
        $this->db->from('faturas AS f');
        $this->db->join('planos AS p', 'p.id = f.id_plano', 'inner');
        $this->db->order_by('f.id  ', 'DESC'); 
        if($status === false){
            $this->db->where('f.comprovante IS NOT NULL', null, false);
            $this->db->where('f.data_pagamento IS NULL', null, false);
            $this->db->where('f.status', 0);
        }else{
            $this->db->where('f.status', $status);

            if($status === 0){
                $this->db->where('f.comprovante IS NULL', null, false);
                $this->db->where('f.data_pagamento IS NULL', null, false);
            }
        }
        
        $query = $this->db->get();

        if($query->num_rows() > 0){

            return $query->result();
        }

        return false;
    }

    public function LiberarFatura($id){

        $this->db->select('f.id_usuario, p.valor, p.plano_carreira, p.binario');
        $this->db->from('faturas AS f');
        $this->db->join('planos AS p', 'p.id = f.id_plano', 'inner');
        $this->db->where('f.id', $id);
        $this->db->where('f.status', 0);
        $fatura = $this->db->get();

        if($fatura->num_rows() > 0){

            $row = $fatura->row();

            $this->db->where('id_usuario', $row->id_usuario);
            $this->db->where('status', 0);
            

            $this->db->where('id', $id);
            $update = $this->db->update('faturas', array('status'=>1, 'data_pagamento'=>date('Y-m-d H:i:s')));//edward

            if($update){
				
				echo "<br>entra update";

                $this->db->where('id_usuario', $row->id_usuario);
                $redeAfiliado = $this->db->get('rede');

                if($redeAfiliado->num_rows() > 0){

                    $rowAfiliado = $redeAfiliado->row();

                    $conta_niveis = $this->db->get('configuracao_nivel_indicacoes');

                    if($conta_niveis->num_rows() > 0){

                        $this->rede_total = array();
                        $this->LinhaIndicacao($row->id_usuario, $conta_niveis->num_rows(), true);
                        $this->CriaTodosNiveis();

                        if(!empty($this->rede_total)){
								
                            foreach($this->rede_total as $nivel=>$patrocinador){
									
                                if(isset($this->todos_niveis[$nivel+1])){
									echo "<br>entra bonusIndicacao";	
                                    $bonusIndicacao = ($this->todos_niveis[$nivel+1]/100) * $row->valor;
									
									
									$novoSaldoIndicacao = InformacoesUsuario('saldo_indicacoes', $patrocinador) + $bonusIndicacao;
									
                                    /*LOGICA | limitar ganancias saldo_indicacoes | Edward */
									$maxGananciaSI_OLD = consultaPlanGanancias($patrocinador);
									
									
									
									/*nuevo maximo 300% de 3 paquetes*/
									$plansThree =  usersLastThree($patrocinador);

									$maxGananciaThree = 0;
									if($plansThree){

										foreach($plansThree as $plansAll){
											//echo "<br>nombre: ".$plansAll->nome." valor: ".$plansAll->valor." max".$plansAll->ganhos_maximo;
											$maxGananciaThree += $plansAll->ganhos_maximo;
										}

									}


									$maxGananciaSI = $maxGananciaThree;
									/*nuevo maximo 300% de 3 paquetes*/
									/*chris se agrega saldo_rendimentos*/
									$saldo_rendimentosSI = InformacoesUsuario('saldo_rendimentos', $patrocinador);
									$rendimientosSI = InformacoesUsuario('binarios_dia', $patrocinador);
									$referidosGananciaSI = InformacoesUsuario('saldo_indicacoes', $patrocinador);
									
									$sumaRendimientos = $rendimientosSI + $referidosGananciaSI + $novoSaldoIndicacao + $saldo_rendimentosSI; 
									
									if($sumaRendimientos>$maxGananciaSI){
										//do nothing
										
									}elseif($sumaRendimientos==$maxGananciaSI){
										
										$this->db->where('id', $patrocinador);
                                    	$this->db->update('usuarios', array('saldo_indicacoes'=>$novoSaldoIndicacao));
										
										
										GravaExtrato($patrocinador, $bonusIndicacao, 'Referral Bonus '.InformacoesUsuario('login', $row->id_usuario), 1); 
										
										
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
											GravaExtrato($patrocinador, $bonusIndicacao, 'Referral Bonus '.InformacoesUsuario('login', $row->id_usuario), 1); 
											
										}else{
											
											
											
											//setea e inserta
											$sumaRendimientos_1 = $rendimientosSI_ + $referidosGananciaSI_; 
											$novoSaldoIndicacaoMax = $sumaRendimientos_1 - $maxGananciaSI_;
											
											$this->db->where('id', $patrocinador);
                                    		$this->db->update('usuarios', array('saldo_indicacoes'=>$novoSaldoIndicacaoMax)); 
											
											GravaExtrato($patrocinador, $bonusIndicacao, 'Referral Bonus '.InformacoesUsuario('login', $row->id_usuario), 1); 
											
										}
										
										/*LOGICA | filtrando menor con los decimales*/
										
										
									}
									
									
									/*LOGICA | limitar ganancias saldo_indicacoes | Edward */
									
									
                                    
                                      
                                    
                                }
                            }
                        }
					
						
                    }

                    $this->db->where('id_usuario', $row->id_usuario);
                    $this->db->where('plano_ativo', 1);
                    $redeCheck = $this->db->get('rede');
                    
                    if($redeCheck->num_rows() <= 0){
                    
                        $id_patrocinador = $this->AtualizaPatrocinador($row->id_usuario);
    
                        $this->db->where('id_usuario', $row->id_usuario);
                        $this->db->update('rede', array('id_patrocinador'=>$id_patrocinador, 'plano_ativo'=>1)); 
                    
                    }
                }

                $this->rede_total = array();
                $this->LinhaIndicacao($row->id_usuario, 1000000);
				
				
				if(isset($_GET['pagar']) and $_GET['pagar']==1){//empieza condicional si da p untos o no
				
				
				/*consulta donde esta el usuario en la red*/
				

                if(!empty($this->rede_total)){

                    if(isset($rowAfiliado)){
                        $LadoChaveBinaria = $rowAfiliado->chave_binaria;
                    }else{
                        $LadoChaveBinaria = 1;
                    }
					 
					/*== mi pierna derrame recibe puntos ==*/
					$ladoNetIns =  verLadoPatroDirecto($row->id_usuario);
					$ladoNetworkIns = $ladoNetIns[0]->chave_binaria;
					
					
					$ladoClaveB = $ladoNetIns[0]->chave_binaria;
					$ladoIdUsuarioB = $ladoNetIns[0]->id_usuario;
					echo "<br>Patro Dire ".$ladoPDirectoB = $ladoNetIns[0]->id_patrocinador_direto;
						
					echo "<br>**//".$row->id_usuario;
					echo "<hr>";
						
					/*== mi pierna derrame recibe puntos ==*/
					
					
                    foreach($this->rede_total as $patrocinadores){

                        $this->db->where('id_usuario', $patrocinadores);
                        $rede = $this->db->get('rede');
						
					 		$pagar = 1;
							$id_user_cal = $patrocinadores;
							$calificadores =  misReferidosDirectosCalificadores($id_user_cal);
							//print_r($calificadores);
							$contBinarios = 0;
							$calificadorDirectoIzq = 0;
							$calificadorDirectoDer = 0;
						
							if($calificadores){

								foreach ($calificadores as $calificador){
									$binary = $calificador->chave_binaria;
									
									 if($ladoIdUsuarioB === $calificador->id_usuario and $ladoPDirectoB===$patrocinadores){
										 
										 
										 echo "<br>==**usuario: ".$calificador->id_usuario ." -bin: ".$binary."  - calificador: ".$patrocinadores;
										 
										 $pagar = 0;
										 
										 
									 }
									
									
																		
									if($binary==1){
										$contBinarios++;
										$calificadorDirectoIzq++;
									}
									if($binary==2){
										$contBinarios++;
										$calificadorDirectoDer  ++;
									} 
								}
							}
							echo "<br>--------";
							
							$contBinarios;
						
							if($contBinarios>=2){
								//do code example of use
							}

							/*== edward nueva tabla control puntos eliminar | punto 2 ==*/
				
				
							$contBinarios;
							$calificadorAll = 0;
							if($contBinarios>=2){
								$calificadorAll = 1;
							}
						
							 
							/**/
							
							$qualifiedData = array(
                                                  'id_user_giver'=>$row->id_usuario,
												  'id_usuario'=>$patrocinadores,	
                                                  'puntos'=>$row->plano_carreira,
								
                                                  'clave_binaria'=>$LadoChaveBinaria,
												  'calificador'=>$calificadorAll,
												  'date'=>date('Y-m-d H:i:s'),		
                                                ); 

							$this->db->insert('qualified', $qualifiedData); 

							/*== edward nueva tabla control puntos eliminar | punto 2 ==*/
						
						
						
						
						/*== mi pierna derrame recibe puntos ==*/
						$ladoNetIns =  verLadoPatroDirecto($row->id_usuario);
						$ladoNetworkIns = $ladoNetIns[0]->chave_binaria;
						
						
						$ladoNetInsPatro =  verLadoPatroDirecto($patrocinadores);
						
						if($ladoNetInsPatro){
							$ladoNetworkInsPatro = $ladoNetInsPatro[0]->chave_binaria;
						}
						
						
						/*== mi pierna derrame recibe puntos ==*/
						
						/*no da puntos si su valor es 0 | punto 1*/
						$valorPaquete = $row->valor;
						
						if($valorPaquete>0){
							
							/*patrocinadores no tienen calificadores directos no reciben puntos*/
							if ($contBinarios>=2) {
								
								/*mis patrocinadores directos no reciben puntos*/
								
								if($pagar===1){								
								 
									if ($rede->num_rows() > 0) {

											$rowRede = $rede->row();
											echo "<br>1) **pagar full = ".$pagar." Patro: ".$patrocinadores;
											 $dadosBinario = array(
															  'id_usuario'=>$patrocinadores,
															  'pontos'=>$row->plano_carreira,
															  'chave_binaria'=>$LadoChaveBinaria,
															  'pago'=>0,
															  'data'=>date('Y-m-d H:i:s')
															);

											$this->db->insert('rede_pontos_binario', $dadosBinario);

											$LadoChaveBinaria = $rowRede->chave_binaria; 

									}else{
										
										
										if($ladoNetworkInsPatro===1){
											
											//no insertamos en la pierna derrame
											echo "<br>1) NO PAGAR sin red -- clave binario:  -1-  Patro: ".$patrocinadores;
											
										}else{
											
											echo "<br>1) **pagar full SIN RED = ".$pagar." Patro: ".$patrocinadores;
										
											 $dadosBinario = array(
																  'id_usuario'=>$patrocinadores,
																  'pontos'=>$row->plano_carreira,
																  'chave_binaria'=>1,
																  'pago'=>0,
																  'data'=>date('Y-m-d H:i:s')
																);

											$this->db->insert('rede_pontos_binario', $dadosBinario); 
											
										}
										
										
									}
								}
								/*mis patrocinadores directos no reciben puntos*/								
							}else{
								
								/*mis patrocinadores directos no reciben puntos*/
								if($pagar===1){
									
									if ($rede->num_rows() > 0) {
								
										/*no dejamos insertar a la pierna derrame*/

										if($ladoNetworkInsPatro===$LadoChaveBinaria){
											// no se inserta a su pierna derrame

											echo "<br>NO PAGAR con red -- clave binario: ".$ladoNetworkInsPatro." Patro: ".$patrocinadores;

										}else{
											//insertamos a su pierna produccion

												$rowRede = $rede->row();
												echo "<br>**pagar solo Pierna Produccion RED = ".$pagar." Patro: ".$patrocinadores;
												 $dadosBinario = array(
																  'id_usuario'=>$patrocinadores,
																  'pontos'=>$row->plano_carreira,
																  'chave_binaria'=>$LadoChaveBinaria,
																  'pago'=>0,
																  'data'=>date('Y-m-d H:i:s')
																);

												$this->db->insert('rede_pontos_binario', $dadosBinario);

												$LadoChaveBinaria = $rowRede->chave_binaria; 


										}

										/*no dejamos insertar a la pierna derrame*/
										
										
									}else{
										
										if($ladoNetworkInsPatro===1){
											//no insertamos en la pierna derrame
											echo "<br>NO PAGAR sin red -- clave binario: ".$ladoNetworkInsPatro." Patro: ".$patrocinadores;
										}else{
											
											echo "<br>**pagar solo Pierna Produccion SIN RED = -1- Patro: ".$patrocinadores;
											//insertamos en la pierna produccion
											 $dadosBinario = array(
																  'id_usuario'=>$patrocinadores,
																  'pontos'=>$row->plano_carreira,
																  'chave_binaria'=>1,
																  'pago'=>0,
																  'data'=>date('Y-m-d H:i:s')
																);

											$this->db->insert('rede_pontos_binario', $dadosBinario); 	
											
										}
										
										
										
										
									}
									
									
								}
								/*mis patrocinadores directos no reciben puntos*/
								
								
								
							}
							/*patrocinadores no tienen calificadores directos no reciben puntos*/
						
						}
						/*no da puntos si su valor es 0*/
						
						
						
                    }
					
                }
				
				
				/*consulta donde esta el usuario en la red*/
				
					
				

                $this->db->where('id', $row->id_usuario);
                $usuario = $this->db->get('usuarios');

                if($usuario->num_rows() > 0){

                    $rowUser = $usuario->row();

                    if($rowUser->quantidade_binario < $row->binario){

                        $this->db->where('id', $row->id_usuario);
                        $this->db->update('usuarios', array('quantidade_binario'=>$row->binario)); 
                    }
                }
				
				
					
				}//fin condicional si dara puntos	

                EnviaNotificacao($row->id_usuario, 'Plan activated successfully!');

                $this->VerificaBinarioAtivo($id);
				
				//exit;
				
				redirect('admin/faturas/liberar');
                return '<div class="alert alert-success text-center">Invoice released successfully!</div>';
            }else{

                return '<div class="alert alert-danger text-center">Sorry, but there was an error releasing the invoice. Try again.</div>';
            }
        }

        return '<div class="alert alert-danger text-center">Sorry, but the invoice has already been released or does not exist. Try again.</div>';
    }

    //DIEGO BEGIN
    function verificarLimiteGanancias($id_usuario, $datoganancia, $tipo) {        
        $valorpuntos = $this->Rangomodel->comprasPaqueteFacturaUsuario($id_usuario);
        $idPaquete = $valorpuntos[0]->id_plano;        
        $datosPaquete = $this->Rangomodel->datosPaqueteUsuario($idPaquete);        
        if ($datosPaquete) {            
            $valorPaquete = $datosPaquete[0]->valor;
            $valorMaximoGanancia = $valorPaquete * 2.75;
            $datosUsuarios = $this->Rangomodel->getUsuarioId($id_usuario);
            $saldo_rendimentos = $datosUsuarios[0]->saldo_rendimentos;
            $saldo_indicacoes = $datosUsuarios[0]->saldo_indicacoes;
            $ganancias = $saldo_rendimentos + $saldo_indicacoes; //$datosUsuarios[0]->ganancias;
            $datoganancia = $this->obtenerPagosDiarios($id_usuario,$valorPaquete,$datoganancia);
            if($datoganancia > 0)
            {
                $totalGanancias = $ganancias + $datoganancia;            
                if ($totalGanancias <= $valorMaximoGanancia) {
                    if ($tipo == 'REN') {
                        $saldo_rendimentos = $saldo_rendimentos + $datoganancia;
                    } else {
                        $saldo_indicacoes = $saldo_indicacoes + $datoganancia;
                    }
                    $ganancias = $ganancias + $datoganancia;
                } else {
                    if ($valorMaximoGanancia < $ganancias) {
                        $datoganancia = 0;
                    } else {
                        $datoganancia = $valorMaximoGanancia - $ganancias;
                    }

                    if ($tipo == 'REN') {
                        $saldo_rendimentos = $saldo_rendimentos + $datoganancia;
                    } else {
                        $saldo_indicacoes = $saldo_indicacoes + $datoganancia;
                    }
                    $ganancias = $ganancias + $datoganancia;
                }            
                $data = array(
                    'saldo_rendimentos' => $saldo_rendimentos,
                    'saldo_indicacoes' => $saldo_indicacoes,
                    'ganancias' => $ganancias
                );

                $this->db->where('id', $id_usuario);
                $this->db->update('usuarios', $data);
            }
            else
            {
                $datoganancia = 0;    
            }

        } else {
            $datoganancia = 0;
        }

        return $datoganancia;
    }
    //DIEGO END   
	
	
    function getPatrocinadorDir($id_usuario, $id_patrocinador) {
       
		$query = $this->db->query("SELECT * FROM rede 
									WHERE id_usuario= $id_usuario
									and id_patrocinador_direto = $id_patrocinador ");
		
		
        return $query->result();
    }
	
	
    function obtenerPagosDiarios($id_usuario,$valorPlan,$ganancias)
    {        
        $query = $this->db->query("select sum(valor)as valorTotal
                                     from extrato 
                                    where id_usuario = ".$id_usuario."
                                     AND data between '".date('Y-m-d')." 00:00:00' AND '".date('Y-m-d')." 23:59:59'" ); 
        $resultado =  $query->result();
        if($resultado)
        {
            $acumulado = $resultado[0]->valorTotal;
            $total     = $acumulado + $ganancias;
            if($total > $valorPlan)
            {
                $ganancias = $valorPlan - $acumulado;
            }             
            return  $ganancias;
        }
        else
        {            
            return $ganancias;
        }
    }

}
?>