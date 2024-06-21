<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rangos extends CI_Controller {

    public function __construct(){
        parent::__construct();
        CheckUserIsAdmin();
        $this->load->model('admin/Rangomodel', 'Rangomodel');
        $this->load->helper('usuarios_helper');
        //$this->load->helper('rangos_helper');
        $this->load->helper('permisos_helper');
    }

    function rangos()
    {
        $idUsuario = $this->session->userdata('uid_admin');
        $idUsuario = 46;
        $datoganancia = 5;
        $tipo = 'REN';
        $valor = $this->obtenerRangos($idUsuario);
        //$valor = verificarLimiteGanancias($idUsuario, $datoganancia,$tipo);
        echo "<br><br><br>".$valor;
    }

    
    function calcular()
    {
        $idUsuario = $this->session->userdata('uid_admin');
        $valorOpcionBD = 23;
        $valorPermisoBD = 1;
        $permiso = verificarPermisosUsuario($idUsuario,$valorOpcionBD,$valorPermisoBD);
        if($permiso)
        {
             $data['jsLoader'] = array(
                                        'assets/bower_components/datatables.net/js/jquery.dataTables.min.js',
                                        'assets/bower_components/datatables-tabletools/js/dataTables.tableTools.js',
                                        'assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js',
                                        'assets/bower_components/datatables-colvis/js/dataTables.colVis.js',
                                        'assets/bower_components/datatables-responsive/js/dataTables.responsive.js',
                                        'assets/bower_components/datatables-scroller/js/dataTables.scroller.js'                                        
                                      );
            //$data['usuarios'] = $this->Addplanmodel->TodosUsuarios();
            //recuperar roles desde la variable de session DIEGO
            $data['rolescero'] = $this->session->userdata('rolescero');
            $data['roles']     = $this->session->userdata('roles');

            $fechaCalculo = date('Y-m-d');
            $data['calculos'] = $this->Rangomodel->calculosFecha($fechaCalculo);
            $this->template->load('admin/templates/template', 'admin/rangos/calcular', $data);
        }
        else
        {
            redirect('admin/dashboard');
        }
    }

    function calcularRangos()
    {
        $resul = 1;
        $mensaje = "Se realizo el calculo correctamente!!!!";

        $datos = $this->Rangomodel->getUsuario();
        foreach ($datos as $fila)
        {
            $respuesta = $this->obtenerRangos($fila->id);
        }
        
        $resultado ='[{                 
                    "resultado":"'.$resul.'",
                    "mensaje":"'.$mensaje.'"
                    }]';
        echo $resultado;
    }


    function obtenerRangos($idUsuario,$nivel = 0,$nivelLimite = 0,$idUsarioPrincipal=0,$bonoUsarioPrincipal=0)
    {
      $fechaCalculo = date('Y-m-d');
      $puntos = $this->Rangomodel->puntosUsuario($idUsuario);
      $totalPuntos = $puntos[0]->puntos;
      $bono = $this->valorPuntosRangosUsuario($totalPuntos);
      //echo "nivel ".$nivel." - ".$idUsuario." - ".$nivelLimite." - ".$idUsarioPrincipal."<br>";
      if ($nivelLimite == 0) ///ENTRA POR PRIMERA VEZ PARA OBTENER LOS VALORES DEL USUARIO INICIAL
      {
        //echo "PUNTO ".$totalPuntos."<br>";
        $nivel = 1;
        $nivelLimite = $bono;
        $idUsarioPrincipal = $idUsuario;
        $bonoUsarioPrincipal = $bono;
      }
      else
      {
        $nivel++;
      }
      //echo "BONO ".$bono." - nivel - ".$nivel." - nivel limite ".$nivelLimite." - idusuario ".$idUsuario." - usuario principal ".$idUsarioPrincipal."<br>";
      if($bono > 0)
      {
        $datos = $this->Rangomodel->usuarioPatrocinador($idUsuario); 
        if($datos)
        {
          //echo "nivel **** ".$nivel." - ".$nivelLimite."<br>";
          if($nivel <= $nivelLimite)
          { 
            //echo $nivel." - ".$idUsuario." ---  ".json_encode($datos)."<br><br>";    
            $calculoPorcentajes = $this->calcularPorcentajesGanancias($idUsuario,$bono,$datos,$idUsarioPrincipal,$bonoUsarioPrincipal,$nivel,$fechaCalculo);  
          }
              
          foreach($datos as $fila)
          {  
            $this->obtenerRangos($fila->id_usuario,$nivel,$nivelLimite,$idUsarioPrincipal,$bonoUsarioPrincipal);    
          }
        }    
      } 
    }

    function valorPuntosRangosUsuario($totalPuntos)
    {
      $valorBonos = $this->Rangomodel->puntosRangosUsuario();
      $tamanho = count($valorBonos);
      $bono = 0;

      for($i = 0; $i < $tamanho; $i++)
      {         
        if($valorBonos[$i]->pontos <= $totalPuntos)
        {        
            $bono = $valorBonos[$i]->bono;   

        }
      }
      return $bono;
    }
    function calcularPorcentajesGanancias($idUsuario,$bono,$datos,$idUsarioPrincipal,$bonoUsarioPrincipal,$nivel,$fechaCalculo)
    {
      $sumaGanancias = 0;
      $gananciaBono  = 0;
      //$fechaCalculo = date('Y-m-d');
      $fechaRegistro = date('Y-m-d H:i:s');
      $datoscorrelativo = $this->Rangomodel->correlativoMaximoGanancias();
      $correlativo      = $datoscorrelativo[0]->correlativo + 1;
      $id_rango_guardados = "";
      $id_rango_usuarios = "";
      $tipo_ganancia = 1;
      //REGISTRO DE GANANCIAS POR PAQUETES
      $porcen = $this->Rangomodel->getConfiguraciones();
      $porcentajeDiario = $porcen[0]->porcentagem_dia;
      foreach ($datos as $patrocinados)  
      {
        $valorpuntos = $this->Rangomodel->comprasPaqueteFacturaUsuario($patrocinados->id_usuario);    
        foreach($valorpuntos as $puntos)
        {         
          $idPaquete       = $puntos->id_plano;
          $idFactura       = $puntos->id;
          $datosPaquete    = $this->Rangomodel->datosPaqueteUsuario($idPaquete);
          $valorPaquete    = $datosPaquete[0]->valor;          
          $porcentaje      = $porcentajeDiario;//$datosPaquete[0]->ganhos_diarios;
          $gananciaDiaria  = ($valorPaquete * $porcentajeDiario ) / 100;
          $sumaGanancias   = $sumaGanancias + $gananciaDiaria;          
          if($gananciaDiaria > 0)
          {
            $verificar = $this->Rangomodel->checkGananciasRangos($patrocinados->id_usuario,$idUsuario,$idFactura,$idPaquete,$fechaCalculo);
            if(!$verificar)
            {
              $data = array(
                  'id_usuario'      => $patrocinados->id_usuario,
                  'id_patrocinador' => $idUsuario,
                  'id_factura'      => $idFactura,
                  'id_plan'         => $idPaquete,
                  'valor_plan'      => $valorPaquete,
                  'porcentaje'      => $porcentaje,
                  'ganancia_diaria' => $gananciaDiaria,
                  'correlativo'     => $correlativo,
                  'tipo_ganancia'   => $tipo_ganancia,
                  'fecha_calculo'   => $fechaCalculo,
                  'fecha_registro'  => $fechaRegistro
              );
              $guardarGanancia = $this->Rangomodel->guardarGananciaRango($data);
              if($guardarGanancia)
              {
                $id_rango_guardados = $id_rango_guardados.$guardarGanancia."|";
                $id_rango_usuarios  = $id_rango_usuarios.$patrocinados->id_usuario."|";
              }          
            }
            else
            {
                
                $idRegistro = $verificar[0]->id;
                
                $data = array(
                  'id_usuario'      => $patrocinados->id_usuario,
                  'id_patrocinador' => $idUsuario,
                  'id_factura'      => $idFactura,
                  'id_plan'         => $idPaquete,
                  'valor_plan'      => $valorPaquete,
                  'porcentaje'      => $porcentaje,
                  'ganancia_diaria' => $gananciaDiaria,
                  'correlativo'     => $correlativo,
                  'tipo_ganancia'   => $tipo_ganancia,
                  'fecha_calculo'   => $fechaCalculo,
                  'fecha_recalculo'  => $fechaRegistro
                );
                //echo json_encode($data)." - ". $idRegistro."<br>";
                $editarGanancia = $this->Rangomodel->editarGananciaRango($idRegistro,$data);
                $id_rango_guardados = $id_rango_guardados.$idRegistro."|";
                $id_rango_usuarios  = $id_rango_usuarios.$patrocinados->id_usuario."|";
            }
          }
        }
      }
      //REGISTRO DE GANANCIAS POR BONOS
      if($sumaGanancias > 0)
      {
        $porcentaje = 2;
        $gananciaBonoDato = ($sumaGanancias * $porcentaje ) / 100;
        $tipo_ganancia = 2;
        //echo $gananciaBono." - ".$idUsuario." - <br>";
                   
        $verificar = $this->Rangomodel->checkGananciasRangosDirecto($idUsuario,$fechaCalculo,$tipo_ganancia);
        if(!$verificar)
        {
            $gananciaBonoDatoVer = $this->verificarLimiteGananciasPrevio($idUsuario, $gananciaBonoDato,'REN');
            if($gananciaBonoDatoVer > 0)
            {
                $gananciaBono = $this->verificarLimiteGanancias($idUsuario, $gananciaBonoDato,'REN');
                if($gananciaBono > 0)
                {
                    $data = array(
                        'id_usuario'            => $idUsuario,              
                        'porcentaje'            => $porcentaje,
                        'valor_plan'            => $sumaGanancias,
                        'ganancia_diaria'       => $gananciaBono,
                        'tipo_ganancia'         => $tipo_ganancia,
                        'correlativo_ganancia'  => $correlativo,
                        'id_rangos'             => $id_rango_guardados,
                        'fecha_calculo'         => $fechaCalculo,
                        'fecha_registro'        => $fechaRegistro,
                        'nivel_ganancia'        => 1
                    );
                    $guardarGanancia = $this->Rangomodel->guardarGananciaRango($data);                
                    if($guardarGanancia)
                    {
                        $guardarExtracto = $this->guardarExtratosGanancias($idUsuario, $gananciaBono,$id_rango_usuarios,$fechaRegistro,$guardarGanancia);  
                    }
                }    
            }
               
        }
        else
        {
            $idRegistro     = $verificar[0]->id;
           
            $gananciaBono   = $this->obteneGananciaBono($idUsuario,$idRegistro,$gananciaBonoDato);            
            
            $data = array(
                'id_usuario'            => $idUsuario,              
                'porcentaje'            => $porcentaje,
                'valor_plan'            => $sumaGanancias,
                'ganancia_diaria'       => $gananciaBono,
                'tipo_ganancia'         => $tipo_ganancia,
                'correlativo_ganancia'  => $correlativo,
                'id_rangos'             => $id_rango_guardados,
                'fecha_calculo'         => $fechaCalculo,
                'fecha_recalculo'       => $fechaRegistro,
                'nivel_ganancia'        => 1
            );
            $editarGanancia = $this->Rangomodel->editarGananciaRango($idRegistro,$data);
        }
        if($idUsuario != $idUsarioPrincipal)
        {      
            $tipo_ganancia = 3;
            //echo $idUsarioPrincipal." entra".$gananciaBono." <br>";
            $verificar = $this->Rangomodel->checkGananciasRangosDirecto($idUsarioPrincipal,$fechaCalculo,$tipo_ganancia);
            if(!$verificar)
            {                 
                //echo $idUsarioPrincipal." entra".$gananciaBono." <br>";   
                $gananciaBono    = $this->verificarLimiteGanancias($idUsarioPrincipal, $gananciaBonoDato,'REN');
                if($gananciaBono > 0)
                {
                    $data = array(
                      'id_usuario'            => $idUsarioPrincipal,              
                      'porcentaje'            => $porcentaje,
                      'valor_plan'            => $sumaGanancias,
                      'ganancia_diaria'       => $gananciaBono,
                      'tipo_ganancia'         => $tipo_ganancia,
                      'correlativo_ganancia'  => $correlativo,
                      'id_rangos'             => $id_rango_guardados,
                      'fecha_calculo'         => $fechaCalculo,
                      'fecha_registro'        => $fechaRegistro,
                      'nivel_ganancia'        => $nivel
                    );
                    $guardarGanancia = $this->Rangomodel->guardarGananciaRango($data);                     
                    if($guardarGanancia)
                    {
                        $guardarExtracto = $this->guardarExtratosGanancias($idUsarioPrincipal, $gananciaBono,$id_rango_usuarios,$fechaRegistro,$guardarGanancia);  
                    }
                }              
            }
            else
            {
              $idRegistro = $verificar[0]->id;
              $gananciaBono   = $this->obteneGananciaBono($idUsarioPrincipal,$idRegistro,$gananciaBonoDato);
              $data = array(
                  'id_usuario'            => $idUsarioPrincipal,              
                  'porcentaje'            => $porcentaje,
                  'valor_plan'            => $sumaGanancias,
                  'ganancia_diaria'       => $gananciaBono,
                  'tipo_ganancia'         => $tipo_ganancia,
                  'correlativo_ganancia'  => $correlativo,
                  'id_rangos'             => $id_rango_guardados,
                  'fecha_calculo'         => $fechaCalculo,
                  'fecha_recalculo'       => $fechaRegistro,
                  'nivel_ganancia'        => $nivel
              );
              $editarGanancia = $this->Rangomodel->editarGananciaRango($idRegistro,$data);
            }                
        }          
        
      }  
      return 1;
    }
    //Career plan bonus
    //GravaExtrato($id_usuario, $monto, 'Career plan bonus'.InformacoesUsuario('login', $row->id_usuario), 1);

    //GravaExtrato($id_usuario, $monto, 'Career plan bonus'.InformacoesUsuario('login', $id_usuario), 1);

    //GravaExtrato($id_padre, $bonusIndicacao, 'Career plan bonus'.InformacoesUsuario('login', $id_hijo), 1);
    
    function verificarLimiteGananciasPrevio($id_usuario, $datoganancia,$tipo)
    {        
        $valorpuntos     = $this->Rangomodel->comprasPaqueteFacturaUsuario($id_usuario); 
        $idPaquete       = $valorpuntos[0]->id_plano;
        $datosPaquete    = $this->Rangomodel->datosPaqueteUsuario($idPaquete);    
        $valorPaquete    = $datosPaquete[0]->valor;
        $valorMaximoGanancia     = $valorPaquete * 2.75;

        $datosUsuarios      = $this->Rangomodel->getUsuarioId($id_usuario);
        $saldo_rendimentos  = $datosUsuarios[0]->saldo_rendimentos;
        $saldo_indicacoes   = $datosUsuarios[0]->saldo_indicacoes;
        $ganancias          = $saldo_rendimentos + $saldo_indicacoes; //$datosUsuarios[0]->ganancias;

        $totalGanancias     = $ganancias + $datoganancia;

        if($totalGanancias <= $valorMaximoGanancia)
        {
          if ($tipo == 'REN' )
          {
              $saldo_rendimentos = $saldo_rendimentos + $datoganancia;
          }
          else
          {
              $saldo_indicacoes = $saldo_indicacoes + $datoganancia;
          }
          $ganancias = $ganancias + $datoganancia;
        }
        else
        {
          $datoganancia = $valorMaximoGanancia - $ganancias;

          if ($tipo == 'REN' )
          {
              $saldo_rendimentos = $saldo_rendimentos + $datoganancia;
          }
          else
          {
              $saldo_indicacoes = $saldo_indicacoes + $datoganancia;
          }
          $ganancias = $ganancias + $datoganancia;     
        }    
        return  $datoganancia;
    }

    function verificarLimiteGanancias($id_usuario, $datoganancia,$tipo)
    {
        $valorpuntos     = $this->Rangomodel->comprasPaqueteFacturaUsuario($id_usuario); 
        $idPaquete       = $valorpuntos[0]->id_plano;
        $datosPaquete    = $this->Rangomodel->datosPaqueteUsuario($idPaquete);    
        $valorPaquete    = $datosPaquete[0]->valor;
        $valorMaximoGanancia     = $valorPaquete * 2.75;

        $datosUsuarios      = $this->Rangomodel->getUsuarioId($id_usuario);
        $saldo_rendimentos  = $datosUsuarios[0]->saldo_rendimentos;
        $saldo_indicacoes   = $datosUsuarios[0]->saldo_indicacoes;
        $ganancias          = $saldo_rendimentos + $saldo_indicacoes; //$datosUsuarios[0]->ganancias;

        $totalGanancias     = $ganancias + $datoganancia;

        if($totalGanancias <= $valorMaximoGanancia)
        {
          if ($tipo == 'REN' )
          {
              $saldo_rendimentos = $saldo_rendimentos + $datoganancia;
          }else{
              $saldo_indicacoes = $saldo_indicacoes + $datoganancia;
          }
          $ganancias = $ganancias + $datoganancia;

        }else{
          if($valorMaximoGanancia < $ganancias)
          {
            $datoganancia = 0;  
          }else{
            $datoganancia = $valorMaximoGanancia - $ganancias;
          }

          if ($tipo == 'REN' )
          {
              $saldo_rendimentos = $saldo_rendimentos + $datoganancia;
          }else{
              $saldo_indicacoes = $saldo_indicacoes + $datoganancia;
          }
          $ganancias = $ganancias + $datoganancia;     
        }
        $data = array(
          'saldo_rendimentos' => $saldo_rendimentos,
          'saldo_indicacoes'  => $saldo_indicacoes,
          'ganancias'         => $ganancias
        );
        $editarGananciaUsuarios = $this->Rangomodel->editarGananciaUsuarios($id_usuario,$data);    
        return  $datoganancia;
    }

    //Career plan bonus
    //GravaExtrato($id_usuario, $monto, 'Career plan bonus'.InformacoesUsuario('login', $row->id_usuario), 1);

    //GravaExtrato($id_usuario, $monto, 'Career plan bonus'.InformacoesUsuario('login', $id_usuario), 1);

    //GravaExtrato($id_padre, $bonusIndicacao, 'Career plan bonus'.InformacoesUsuario('login', $id_hijo), 1);
    function guardarExtratosGanancias($idUsuario, $bono, $rango_user,$fecha,$idregistro)    
    {
        $referencia = 'Career plan bonus - ';
        //$rango_user = '3|21|';
        $tam = strlen($rango_user) - 1;
        $listado = substr($rango_user, 0, $tam);
        $listadoArray = explode("|", $listado);        
        foreach ($listadoArray as $id_user)
        {
            $usuario = $this->Rangomodel->getUsuarioId($id_user);
            $nome    = $usuario[0]->nome;
            $referencia = $referencia.$nome." |";            
        }
        $tam = strlen($referencia) - 1;
        $referencia = substr($referencia, 0, $tam);
        
        $data = array(
            'id_usuario'        => $idUsuario,
            'mensagem'          => $referencia,
            'valor'             => $bono,
            'tipo'              => 1,
            'data'              => $fecha,
            'id_ganancia_rango' => $idregistro
          );
        //echo json_encode($data)."<br>";
        $guardarExtratos = $this->Rangomodel->guardarExtractosCarrera($data);        
        return $guardarExtratos;        
    }

    function obteneGananciaBono($id_usuario,$idRegistro,$gananciaBono)
    //function obteneGananciaBono()
    {
        /*$id_usuario = 46;
        $idRegistro = 9;
        $gananciaBono = 10;*/   

        $datosExtrato = $this->Rangomodel->getExtratoIdGanancia($idRegistro);
        $valor = $datosExtrato[0]->valor;

        $datosUsuarios      = $this->Rangomodel->getUsuarioId($id_usuario);
        $saldo_rendimentos  = $datosUsuarios[0]->saldo_rendimentos - $valor;
        $saldo_indicacoes   = $datosUsuarios[0]->saldo_indicacoes;        
        $ganancias          = $saldo_rendimentos + $saldo_indicacoes;
        $data = array(
          'saldo_rendimentos' => $saldo_rendimentos,          
          'ganancias'         => $ganancias
        );
        $editarGananciaUsuarios = $this->Rangomodel->editarGananciaUsuarios($id_usuario,$data);
        
        $valorBono = $this->verificarLimiteGanancias($id_usuario, $gananciaBono,'REN');
        
        $dataExtrato = array(
          'valor' => $valorBono          
        );
        $valorDato = $this->Rangomodel->updateExtrato($idRegistro, $dataExtrato);
        return $valorBono;
    }
}