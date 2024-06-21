<?php
defined('BASEPATH') OR exit('No direct script access allowed');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class Cronmodel extends CI_Model{

    public function __construct(){
        parent::__construct();
    }

    public function getPrevKey($key, $hash = array()) {
		$keys = array_keys($hash);
		$found_index = array_search($key, $keys);
		if ($found_index === false || $found_index === 0) {
			// Devuelve null en lugar de false para manejarlo mejor en la función principal
			return null;
		}
		return $keys[$found_index - 1];
	}

    public function VerificaQualificadorRede($id_usuario, $qualificador_quantidade, $qualificador_plano){

        $quantidade = 0;

        $this->db->where('id_patrocinador', $id_usuario);
        $this->db->where('plano_ativo', 1);
        $rede = $this->db->get('rede');

        if($rede->num_rows() > 0){

            foreach($rede->result() as $resultRede){

                $this->db->where('id_usuario', $resultRede->id_usuario);
                $this->db->where('id_plano_carreira', $qualificador_plano);
                $planos_carreira_ganhos = $this->db->get('usuarios_plano_carreira');

                if($planos_carreira_ganhos->num_rows() > 0){

                    $quantidade++;
                }
            }

            if($quantidade >= $qualificador_quantidade){

                return true;

            }else{

                foreach($rede->result() as $resultRede){

                    $retorno = $this->VerificaQualificadorRede($resultRede->id_usuario, $qualificador_quantidade, $qualificador_plano);
                    
                    if($retorno){

                        return true;
                    }
                }
            }
        }

        return false;
    }

    public function PagaBinarioDia(){

        $fp = fopen('cron_execute.txt', 'a+');
        $fw = fwrite($fp, 'PagaBinarioDia - '.date('d/m/Y H:i:s').'\r\n');
        fclose($fp);

        $UsuariosLadoMenor = array();
		
		/*TESTO MANUAL*/
        $pontos = $this->db->query("SELECT COALESCE(SUM(pontos), 0) as pontos, id_usuario, chave_binaria FROM rede_pontos_binario WHERE  pago = '0' GROUP BY chave_binaria,id_usuario");
		
		/*CON CRON*/
		//$pontos = $this->db->query("SELECT COALESCE(SUM(pontos), 0) as pontos, id_usuario, chave_binaria FROM rede_pontos_binario WHERE  data <= '".date('Y-m-d')."' pago = '0' GROUP BY chave_binaria,id_usuario");
		
		echo "SELECT COALESCE(SUM(pontos), 0) as pontos, id_usuario, chave_binaria FROM rede_pontos_binario WHERE  
		data <= '".date('Y-m-d')."' and pago = '0' GROUP BY chave_binaria,id_usuario";
		
		echo "<br>";
		
		print_r($pontos);

        if($pontos->num_rows() > 0){
			echo "<br>".$pontos->num_rows();
			
            foreach($pontos->result() as $ponto){

                if(InformacoesUsuario('binario', $ponto->id_usuario) == 1){
                    
                    /* Pega o lado menor e grava em um array */
                    if(!isset($UsuariosLadoMenor[$ponto->id_usuario])){
						
						echo "<br>id user: puntos ".$ponto->id_usuario;
						
                        //$LadoEsquerdo = $this->db->query("SELECT COALESCE(SUM(pontos), 0) as pontos FROM rede_pontos_binario WHERE id_usuario = '".$ponto->id_usuario."' AND chave_binaria = '1' AND pago = '0'");
						
						$LadoEsquerdo = $this->db->query("SELECT COALESCE(SUM(pontos), 0) as pontos FROM (SELECT pontos from rede_pontos_binario WHERE id_usuario = '".$ponto->id_usuario."' AND chave_binaria = '1' AND pago = '0' order by data DESC LIMIT 7) as pontos");
						
						//echo "<br>SELECT COALESCE(SUM(pontos), 0) as pontos FROM rede_pontos_binario WHERE id_usuario = '".$ponto->id_usuario."' AND chave_binaria = '1' AND pago = '1'";
						
                        //$LadoDireito = $this->db->query("SELECT COALESCE(SUM(pontos), 0) as pontos FROM rede_pontos_binario WHERE id_usuario = '".$ponto->id_usuario."' AND chave_binaria = '2' AND pago = '0'");
						
						$LadoDireito = $this->db->query("SELECT COALESCE(SUM(pontos), 0) as pontos FROM (SELECT pontos from rede_pontos_binario WHERE id_usuario = '".$ponto->id_usuario."' AND chave_binaria = '2' AND pago = '0' order by data DESC LIMIT 7) as pontos");
						
						//echo "<br>SELECT COALESCE(SUM(pontos), 0) as pontos FROM rede_pontos_binario WHERE id_usuario = '".$ponto->id_usuario."' AND chave_binaria = '2' AND pago = '1'";
						
						echo "<br>--- puntos derechos Pag. ".$LadoEsquerdo->row()->pontos;
						
						echo "<br>--- puntos izquierdos Pag. ".$LadoDireito->row()->pontos;
						
						echo "<br>//***-- Pagar por Der --** ".$puntosDerechoPagar = $LadoEsquerdo->row()->pontos;
						echo "<br>//***-- Pagar por Izq --** ".$puntosIzquierdaPagar = $LadoDireito->row()->pontos;

                        if($LadoEsquerdo->row()->pontos > $LadoDireito->row()->pontos){
                            $lado_menorBueno = 2;
                        }elseif($LadoDireito->row()->pontos > $LadoEsquerdo->row()->pontos){
                            $lado_menorBueno = 1;
                        }else{
							
							/*
							solucion ultimos 7 pagos
							
							SELECT COALESCE(SUM(pontos), 0) as pontos FROM (SELECT pontos from rede_pontos_binario WHERE id_usuario = 4768 AND chave_binaria = '2' AND pago = '0' order by data DESC LIMIT 7) as pontos;
							
							
							*/

                            //$LadoEsquerdoZerado = $this->db->query("SELECT COALESCE(SUM(pontos), 0) as pontos FROM rede_pontos_binario WHERE id_usuario = '".$ponto->id_usuario."' AND chave_binaria = '1' AND pago = '0'");
							
							$LadoEsquerdoZerado = $this->db->query("SELECT COALESCE(SUM(pontos), 0) as pontos FROM (SELECT pontos from rede_pontos_binario WHERE id_usuario = '".$ponto->id_usuario."' AND chave_binaria = '1' AND pago = '0' order by data DESC LIMIT 7) as pontos");
							
							
							//echo "<br>SELECT COALESCE(SUM(pontos), 0) as pontos FROM rede_pontos_binario WHERE id_usuario = '".$ponto->id_usuario."' AND chave_binaria = '1' AND pago = '0'";
							
							
							
                            //$LadoDireitoZerado = $this->db->query("SELECT COALESCE(SUM(pontos), 0) as pontos FROM rede_pontos_binario WHERE id_usuario = '".$ponto->id_usuario."' AND chave_binaria = '2' AND pago = '0'");
							
							
							$LadoDireitoZerado = $this->db->query("SELECT COALESCE(SUM(pontos), 0) as pontos FROM (SELECT pontos from rede_pontos_binario WHERE id_usuario = '".$ponto->id_usuario."' AND chave_binaria = '2' AND pago = '0' order by data DESC LIMIT 7) as pontos");
							
							//echo "<br>SELECT COALESCE(SUM(pontos), 0) as pontos FROM rede_pontos_binario WHERE id_usuario = '".$ponto->id_usuario."' AND chave_binaria = '2' AND pago = '0'";
							
							echo "<br>***-- Pagar por Der --** ".$puntosDerechoPagar = $LadoDireitoZerado->row()->pontos;
							echo "<br>***-- Pagar por Izq --** ".$puntosIzquierdaPagar = $LadoEsquerdoZerado->row()->pontos;
							
                            if($LadoEsquerdoZerado->row()->pontos < $LadoDireitoZerado->row()->pontos){

                                echo "<br>Pagar por Izq".$lado_menorBueno = 1; 

                            }elseif($LadoDireitoZerado->row()->pontos < $LadoEsquerdoZerado->row()->pontos){

                                echo "<br>Pagar por Der".$lado_menorBueno = 2; 

                            }else{

                                echo "<br>Pagar por Cualquiera".$lado_menorBueno = 2; 
                            }
                        }

                        echo "<br> pagar por lado menor ".$pagar_por = $UsuariosLadoMenor[$ponto->id_usuario] = $lado_menorBueno;
                    }else{
                        echo "<br> pagar por defecto".$pagar_por = $UsuariosLadoMenor[$ponto->id_usuario];
                    }
					
					
					/*restringimos el pago sino tiene piernas*/
					
					if($puntosDerechoPagar>1 and $puntosIzquierdaPagar>1 ){
					
						//inicio funcion pagar

						if(isset($pagar_por)){

							//var_dump($pagar_por);

							$this->db->select('p.valor, p.teto_binario');
							$this->db->from('faturas AS f');
							$this->db->join('planos AS p', 'p.id = f.id_plano', 'inner');
							$this->db->where('f.id_usuario', $ponto->id_usuario);
							$this->db->where('f.status', 1);
							$this->db->where('p.id != 89327542');
							$this->db->order_by('f.data_pagamento', 'DESC');
							$this->db->limit(1);
							$plano = $this->db->get();
							echo "<pre>"; 

							//print_r($plano);

							echo "</pre>";
							if($plano->num_rows() > 0){



								echo "<br>";


								echo "<br>";
								echo "p X ".$pagar_por;

								if(isset($pagar_por)){

									$row = $plano->row();
									/*
									$ponto->pontos == 100%
									      ???         == InformacoesUsuario('quantidade_binario', $ponto->id_usuario) 
									
									*/
									$puntosDerechoPagar;
									$puntosIzquierdaPagar;
									
									
									/*conditional less*/
									
									if($puntosDerechoPagar<$puntosIzquierdaPagar){
										$puntosParaPagar =$puntosDerechoPagar;
									}elseif($puntosDerechoPagar>$puntosIzquierdaPagar){
										$puntosParaPagar =$puntosIzquierdaPagar;
									}else{
										$puntosParaPagar =$puntosIzquierdaPagar;
									}
									
									
									echo "<br>puntos para pagar ".$puntosParaPagar;
									/*conditional less*/
									
									
									echo "<br>informacion ".InformacoesUsuario('quantidade_binario', $ponto->id_usuario);
									echo "<br> id_usuario ".$ponto->id_usuario;
									echo "<br> pontos ".$ponto->pontos;
									
									
									echo "<br>Pago total ".$totalPagamento = (InformacoesUsuario('quantidade_binario', $ponto->id_usuario)*$puntosParaPagar) / 100 ; 

									echo "<br>Pago totalPagamento ".$totalPagamento;
									echo "<br>Pago maximo Binario ".$row->teto_binario;
									
									
									/*sumatoria de los techos binarios de los 3 ultimos paquetes*/
									
									$techoBinario =  usersLastThree($ponto->id_usuario);

									$techoBinarioMax = 0;
									if($techoBinario){

										foreach($techoBinario as $techo){
											//echo "<br>nombre: ".$plansAll->nome." valor: ".$plansAll->valor." max".$plansAll->ganhos_maximo;
											$techoBinarioMax += $techo->teto_binario;
										}

									}
									
									/*sumatoria de los techos binarios de los 3 ultimos paquetes*/

									if($totalPagamento > $techoBinarioMax){

										echo "<br>Se Paga el maximo Binario ".$totalPagamento = $techoBinarioMax;
									}
									echo "<br>ID usuario: ".$ponto->id_usuario;	
									
									
									/* Binary Wallet | Edward*/
									echo "<br>****** novoRendimento ".$novoRendimento = InformacoesUsuario('binarios_dia', $ponto->id_usuario) + $totalPagamento;
									
									
									
									/*LOGICA | limitar ganancias binarios_dia | Edward */
									//$insertarBinDia = 0;
									
									$maxGananciaSI_OLD = consultaPlanGanancias($ponto->id_usuario);
									
									
									
									/*nuevo maximo 300% de 3 paquetes*/
									$plansThree =  usersLastThree($ponto->id_usuario);

									$maxGananciaThree = 0;
									$valorTresPaquetes = 0;
									if($plansThree){

										foreach($plansThree as $plansAll){
											//echo "<br>nombre: ".$plansAll->nome." valor: ".$plansAll->valor." max".$plansAll->ganhos_maximo;
											$maxGananciaThree += $plansAll->ganhos_maximo;
											$valorTresPaquetes += $plansAll->valor;
										}

									}


									$maxGananciaSI = $maxGananciaThree;
									
									
									/*nuevo maximo 300% de 3 paquetes*/
			
									$rendimientosSI = InformacoesUsuario('binarios_dia', $ponto->id_usuario);
									$referidosGananciaSI = InformacoesUsuario('saldo_indicacoes', $ponto->id_usuario);
									
									$sumaRendimientos = $rendimientosSI + $referidosGananciaSI + $novoRendimento; 
									
									if($sumaRendimientos>$maxGananciaSI){
										//do nothing
										//$insertarBinDia = 0;
										
									}elseif($sumaRendimientos==$maxGananciaSI){
										
										$this->db->where('id', $ponto->id_usuario);
										$updateSaldo = $this->db->update('usuarios', array('binarios_dia'=>$novoRendimento));
										
										//$insertarBinDia = 1;
										
										
									}else{
										
										/*LOGICA | filtrando menor con los decimales*/
										$novoSaldoIndicacao_ = round($novoRendimento);
										
										$rendimientosSI_ = round($rendimientosSI);
										$referidosGananciaSI_ = round($referidosGananciaSI);

										$maxGananciaSI_ = round($maxGananciaSI);
										$sumaRendimientos_ = $rendimientosSI_ + $referidosGananciaSI_ + $novoSaldoIndicacao_; 
										
										if($sumaRendimientos_<$maxGananciaSI_){
											
											//correcto inserta
											$this->db->where('id', $ponto->id_usuario);
											$updateSaldo = $this->db->update('usuarios', array('binarios_dia'=>$novoRendimento));
											
											//$insertarBinDia = 1;
											
										}else{
											
											//setea e inserta
											$sumaRendimientos_1 = $rendimientosSI_ + $referidosGananciaSI_; 
											$novoSaldoIndicacaoMax = $sumaRendimientos_1 - $maxGananciaSI_;
											
											
											$this->db->where('id', $ponto->id_usuario);
											$updateSaldo = $this->db->update('usuarios', array('binarios_dia'=>$novoSaldoIndicacaoMax));
											
											//$insertarBinDia = 1;
											
										}
										
										/*LOGICA | filtrando menor con los decimales*/
										
										
									}
									
									
									/*LOGICA | limitar ganancias binarios_dia | Edward */
									
																		
									
									/* Binary Wallet | Edward*/
									$insertarBinDia = 1;	
									//if($updateSaldo and $insertarBinDia == 1){
									if($insertarBinDia == 1){	

										echo "<br> Pago";
										/*
										
										falta la condicional 
										
										*/
										
										if($pagar_por == 1){
											$corteIzquierda= $puntosParaPagar;
											$corteDerecha= 0;
										}
										
										if($pagar_por == 2){
											$corteDerecha= $puntosParaPagar;
											$corteIzquierda= 0;
										}
										
										
										
										/*no dar puntos si no tengo calificador Derecha e izquierda*/						
										$id_user_cal = $ponto->id_usuario;
										$calificadores =  misReferidosDirectosCalificadores($id_user_cal);
										//print_r($calificadores);
										$contBinarios = 0;
										if($calificadores){

											foreach ($calificadores as $calificador){
												$binary = $calificador->chave_binaria;
												echo "<br>calificador".$calificador->id_usuario ." b ".$binary;
												if($binary==1){
													$contBinarios++;
												}
												if($binary==2){
													$contBinarios++;
												} 
											}
										}
										/*no dar puntos si no tengo calificador Derecha e izquierda*/
										
										
										

										/*no da puntos si su paquete es 0*/
										
										echo "<br>Contador Binarios: ".$contBinarios;
										
										//$valorPaquete = $row->valor;
										$valorPaquete = $valorTresPaquetes;
											
										if($valorPaquete>=0){
											
											if($contBinarios>=2){
												
												echo "<br> tiene calificadores";
												
												/*logica Corte + algoritmo insert/update*/
												$verCortePatro =  verCorteUser($ponto->id_usuario);
						
												if($verCortePatro){
													echo "<br> ID corte ".$idCortePatro = $verCortePatro[0]->id;
													echo "<br> ID usuario corte ".$idCortePatroUsuario = $verCortePatro[0]->id_usuario;
													
													echo "<br>Actualizar corteIzquierda ".$corteIzquierda;
													echo "<br>Actualizar corteDerecha ".$corteDerecha;
													
													
													/*actualizar corte*/
													$corte = array(                           
													   'id_usuario'=>$ponto->id_usuario,
													   'corteIzquierda'=>$corteIzquierda,
													   'corteDerecha'=>$corteDerecha,
													   'estado'=>0,	
													   'fecha'=>date('Y-m-d H:i:s'),
													   

													);

													$this->db->where('id', $idCortePatro);
    												$this->db->update('cortes', $corte);
													/*actualizar corte*/
													
													
												}else{
													
													echo "<br>No tiene Corte insertado";
													
													echo "<br> corteIzquierda ".$corteIzquierda;
													echo "<br> corteDerecha ".$corteDerecha;
													
													/*insertando corte*/
													$corte = array(                           
													   'id_usuario'=>$ponto->id_usuario,
													   'corteIzquierda'=>$corteIzquierda,
													   'corteDerecha'=>$corteDerecha,
													   'estado'=>0, 	
													   'fecha'=>date('Y-m-d H:i:s'),
													   	

													);

													$this->db->insert('cortes', $corte);
													/*insertando corte*/
													
												}
												/*logica Corte + algoritmo insert/update*/
												

												$this->db->where('pago', 0);
												$this->db->where('id_usuario', $ponto->id_usuario);
												$this->db->where('chave_binaria', $pagar_por);
												$this->db->update('rede_pontos_binario', array('pago'=>1));

												GravaExtrato($ponto->id_usuario, $totalPagamento, 'Binary payout of the day', 1);

												echo "<hr>";
												
											}else{
												
												echo "<br>no tiene calificadores";
												echo "<hr>";
											}	
											
										}
										
										/*no da puntos si su paquete es 0*/
									}
								}
							}

						}//fin funcion pagar
						
						
					}else{
						
						
						echo "<br>No tiene una de las piernas";
						echo "<hr>";
					}	
					
					
					/*restringimos el pago sino tiene piernas*/
                }
            }
        }
    }
	
	/*daily bonus => Eduardo pago diarios*/
    public function PagaBonificacao(){

        $fp = fopen('cron_execute.txt', 'a+');
        $fw = fwrite($fp, 'PagaBonificação - '.date('d/m/Y H:i:s').'\r\n');
        fclose($fp);

        /*if((ConfiguracoesSistema('paga_final_semana')) == 0 && (date('w') == 0 || date('w') == 6)){
            
            return false;
        }*/
        
        $this->db->select('f.id, f.id_usuario, f.data_pagamento, p.valor');
        $this->db->from('faturas AS f');
        $this->db->join('planos AS p', 'p.id = f.id_plano', 'inner');
        $this->db->where('f.status', 1);
		$this->db->where('p.valor >', 0);
		$this->db->group_by('f.id_usuario');
		$this->db->order_by('f.data_pagamento', 'DESC');
        $faturas1 = $this->db->get();
		

        $porcentagem_dia = ConfiguracoesSistema('porcentagem_dia');

        if($faturas1->num_rows() > 0){

            foreach($faturas1->result() as $fatura1){
				
				
				/*filtrar la ultima factura*/
				
				
				/*
				//consulta para limitar
				SELECT f.id, f.id_usuario, f.data_pagamento, p.valor, p.nome 
				FROM faturas AS f 
				INNER JOIN planos AS p 
				ON p.id = f.id_plano
				WHERE p.valor > 0 and f.status = 1 and f.id_usuario = 4713 
				ORDER BY f.data_pagamento  
				DESC LIMIT 1;
				
				*/
				
				$this->db->select('f.id, f.id_usuario, f.data_pagamento, p.valor, p.nome');
				$this->db->from('faturas AS f');
				$this->db->join('planos AS p', 'p.id = f.id_plano', 'inner');
				$this->db->where('f.status', 1);
				$this->db->where('p.valor >', 0);
				$this->db->where('p.id != 89327542');
				$this->db->where('f.id_usuario', $fatura1->id_usuario);
				$this->db->order_by('f.data_pagamento', 'DESC');
				$this->db->limit(3);
				$faturas = $this->db->get();
				
				
			 	if($faturas->num_rows() > 0){

            		foreach($faturas->result() as $fatura){
				

						$expira = date('Y-m-d', strtotime($fatura->data_pagamento) + (60*60*24*ConfiguracoesSistema('quantidade_dias')));

						if(ConfiguracoesSistema('paga_final_semana') == 0){
							$expira = date('Y-m-d', (strtotime($expira) + (60*60*24*(FinalDeSemana($fatura->data_pagamento, $expira)))));
						}

						echo "<br>fecha expira ".$expira;	

						if(date('Y-m-d') <= $expira){

							$pagamento = ($porcentagem_dia/100) * $fatura->valor;
							
							$nombrePlan =  $fatura->nome;


							$novoSaldoIndicacao = InformacoesUsuario('saldo_rendimentos', $fatura->id_usuario) + $pagamento;
							
							/*Daily bonus (saldo_rendimentos) no tiene filtro al 300%*/
							$this->db->where('id', $fatura->id_usuario);
							$this->db->update('usuarios', array('saldo_rendimentos'=>$novoSaldoIndicacao));
							/*Daily bonus (saldo_rendimentos) no tiene filtro al 300%*/
							
							GravaExtrato($fatura->id_usuario, $pagamento, 'Payment of plan Profit: '.$nombrePlan.' - #'.$fatura->id , 1);
							
							

						}else{
							$nombrePlan =  $fatura->nome;
							
							$this->db->where('id', $fatura->id);
							$this->db->update('faturas', array('status'=>0));

							EnviaNotificacao($fatura->id_usuario, 'Your plan; '.$nombrePlan.' has expired, to keep winning, buy another one now.');


						}
				
					}
					
				}
				
            }
			
			
			echo "<hr>";
        }
    }

    public function GanhoPlanoCarreira(){

        $fp = fopen('cron_execute.txt', 'a+');
        $fw = fwrite($fp, 'GanhoPlanoCarreira - '.date('d/m/Y H:i:s').'\r\n');
        fclose($fp);

        $quantidadePontos = array();
        $administradores = array();
        $UsuariosLados = array();

        $this->db->order_by('pontos', 'ASC');
        $planos = $this->db->get('plano_carreira');

        if($planos->num_rows() > 0){

            foreach($planos->result() as $plano){

                $quantidadePontos[$plano->id] = array('pontos'=>$plano->pontos, 'plano'=>$plano->nome, 'premio'=>$plano->premio);
            }
        }

        $this->db->where('is_admin', 1);
        $usuariosAdministradores = $this->db->get('usuarios');

        if($usuariosAdministradores->num_rows() > 0){

            foreach($usuariosAdministradores->result() as $resultAdministradores){

                $administradores[] = $resultAdministradores->id;
            }
        }

        $pontos = $this->db->query("SELECT SUM(pontos) as pontos, id_usuario FROM rede_pontos_binario GROUP BY id_usuario");

        if($pontos->num_rows() > 0){

            foreach($pontos->result() as $ponto){

                $anterior = 0;

                if(!isset($UsuariosLados[$ponto->id_usuario])){

                    $PontosLadoEsquerdo = $this->db->query("SELECT COALESCE(SUM(pontos), 0) as pontos FROM rede_pontos_binario WHERE id_usuario = '".$ponto->id_usuario."' AND chave_binaria = '1' AND pago = '1'");
                    $PontosLadoDireito = $this->db->query("SELECT COALESCE(SUM(pontos), 0) as pontos FROM rede_pontos_binario WHERE id_usuario = '".$ponto->id_usuario."' AND chave_binaria = '2' AND pago = '1'");
                    $UsuariosLados[$ponto->id_usuario] = array('esquerdo'=>$PontosLadoEsquerdo->row()->pontos, 'direito'=>$PontosLadoDireito->row()->pontos);
                }
				
				echo "<br>**quantidadePontos";
				var_dump($quantidadePontos);
				echo "<br>**quantidadePontos<br><br>";

                foreach($quantidadePontos as $id=>$pontosCadastrado){
					
					echo "<br>-- id: ".$id." -- ";
					
					echo "<br>**-- pontosCadastro array<br>";
					var_dump($pontosCadastrado);
					echo "<br>**-- pontosCadastro array<br>";
					
					
                    if($pontosCadastrado['pontos'] > 0){

                        echo "<br>esquerdo ".$LadoEsquerdo = $UsuariosLados[$ponto->id_usuario]['esquerdo'];
                        echo "<br>direito ".$LadoDireito = $UsuariosLados[$ponto->id_usuario]['direito'];

                        //$QuantidadePlanoAnterior = $quantidadePontos[$this->getPrevKey($id, $quantidadePontos)];
						
						/*fix*/
						$prevKey = $this->getPrevKey($id, $quantidadePontos);
						if ($prevKey === null) {
							continue;
						}

						$QuantidadePlanoAnterior = $quantidadePontos[$prevKey];

						echo "<br>";
						var_dump($QuantidadePlanoAnterior);
						echo "<br>";
						
						echo "<br>//puntos plano anterior: ".$QuantidadePlanoAnterior['pontos'];
						echo "<br>//puntos plano cadastrado: ".$pontosCadastrado['pontos'];
						
						$puntosTotales = $LadoEsquerdo + $LadoDireito;
                        
                        if(
							/*($LadoEsquerdo >= $QuantidadePlanoAnterior['pontos'] && ($pontosCadastrado['pontos']-1) <= $LadoEsquerdo) 
							
							&& ($LadoDireito >= $QuantidadePlanoAnterior['pontos'] && ($pontosCadastrado['pontos']-1) <= $LadoDireito)*/
							
							
							($puntosTotales >= $QuantidadePlanoAnterior['pontos'] && ($pontosCadastrado['pontos']-1) <= $puntosTotales)
						){
								
							echo "<br>entra primer if";

                            if($pontosCadastrado['pontos'] > $quantidadePontos[InformacoesUsuario('plano_carreira', $ponto->id_usuario)]['pontos']){

								
								echo "<br>entra segundo if";
								
                                if(InformacoesUsuario('plano_carreira', $ponto->id_usuario) != $id){
									
									
									echo "<br>entra tercers if";
									
                                    /* Não remova o comentário abaixo */

                                    $check = $this->VerificaQualificadorRede($ponto->id_usuario, $pontosCadastrado['qualificador_quantidade'], $pontosCadastrado['qualificador_plano']);
                                    
                                    if($check){
                                        echo "<br>** - entra a actualizar - **";
                                        $this->db->where('id_plano_carreira', $id);
                                        $this->db->where('id_usuario', $ponto->id_usuario);
                                        $registros = $this->db->get('usuarios_plano_carreira');

                                        if($registros->num_rows() <= 0){

                                            $dadosPlanoCarreira = array(
                                                                        'id_usuario'=>$ponto->id_usuario,
                                                                        'id_plano_carreira'=>$id,
                                                                        'data'=>date('Y-m-d H:i:s')
                                                                    );

                                            $this->db->where('id', $ponto->id_usuario);
                                            $this->db->update('usuarios', array('plano_carreira'=>$id));

                                            $this->db->insert('usuarios_plano_carreira', $dadosPlanoCarreira);


                                            if(!empty($administradores)){

                                                foreach($administradores as $administrador){

                                                    EnviaNotificacao($administrador, 'El usuario:  '.InformacoesUsuario('login', $ponto->id_usuario).' ingreso al plan de Carrera: '.$quantidadePontos[$id]['plano']." | Puntos:".$puntosTotales. " | Premio: ".$quantidadePontos[$id]['premio'], 1);
													
                                                    EnviaNotificacao($ponto->id_usuario, 'Felicidades!!! Lograste llegar al Plan de Carrera: '.$quantidadePontos[$id]['plano']);
                                                }
                                            }
                                        }
                                    }

                                    break;
                                }
                            }
                        }

                        // (5545 >= 0 && 499 <= 5545) && (750 >= 0 && 499 <= 750)
                        // (5545 >= 500 && 2499 <= 5545) && (750 >= 500 && 2499 <= 750)
                        // (5545 >= 2500 && 4999 <= 5545) && (5000 >= 2500 && 4999 <= 5000)
                        

                         if($ponto->pontos-1 <= $pontosCadastrado['pontos']){

                             $plano_id = $this->getPrevKey($id, $quantidadePontos); 

                             break;
                         }

                         echo '<br>Previus: '.$pontosCadastrado['plano'].'<br />';

                         echo '<br>'.$id.' => '.$pontosCadastrado['pontos'].' id usuario:'.$ponto->id_usuario.' puntos del usuario: '.$ponto->pontos.' <br />';

                    }
					
					echo "<br>-- Segundo bucle --";

                }

                echo '<br>ID do Plano: '.$plano_id.'<br><hr>';

                
            }
        }
    }
	
	
 
}
?>