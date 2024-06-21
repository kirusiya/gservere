<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rangomodel extends CI_Model{

    public function __construct(){
        parent::__construct();
    }

    function usuarioPatrocinador($idusuario)
    {

        $query = $this->db->query("select *
                                     from rede
                                    where id_patrocinador =".$idusuario ); 
        return $query->result();
    }

    function puntosUsuario($idusuario)
    {

        $query = $this->db->query("select sum(pontos)as puntos
                                     from rede_pontos_binario
                                    where id_usuario =".$idusuario ); 
        return $query->result();
    }

    function comprasPaqueteFacturaUsuario($idusuario)
    {
        $query = $this->db->query("select *
                                     from faturas
                                    where id_usuario = ".$idusuario."
                                      and status > 0
                                     order by data_pagamento desc
                                     limit 1"); 
        return $query->result();
    }

    function datosPaqueteUsuario($paquete)
    {
        $query = $this->db->query("select *
                                     from planos
                                    where id =".$paquete ); 
        return $query->result();
    }

    function checkGananciasRangos($idusuario,$idpatrocinador,$idfactura,$idplan,$fechaCalculo)
    {
        $fechaCalculo = "'".$fechaCalculo."'";
        $query = $this->db->query("select id
                                     from ganancias_rangos
                                    where id_usuario = ".$idusuario." 
                                      and id_patrocinador = ".$idpatrocinador."
                                      and id_factura = ".$idfactura."
                                      and id_plan = ".$idplan."
                                      and fecha_calculo = ".$fechaCalculo); 
        return $query->result();
    }
    function checkGananciasRangosDirecto($idusuario,$fechaCalculo,$tipo_ganancia)
    {
        $fechaCalculo = "'".$fechaCalculo."'";
        $query = $this->db->query("select id
                                     from ganancias_rangos
                                    where id_usuario = ".$idusuario."                                       
                                      and tipo_ganancia = ".$tipo_ganancia."
                                      and fecha_calculo = ".$fechaCalculo); 
        return $query->result();
    }

    function guardarGananciaRango($data)
    {
        $this->db->insert('ganancias_rangos',$data);
        return $this->db->insert_id();
    }

    function editarGananciaRango($id_registro,$data)
    {
        $this->db->where('estado_ganancia',1);
        $this->db->where('id',$id_registro);
        return $this->db->update('ganancias_rangos',$data);
    }

    function correlativoMaximoGanancias()
    {
        $query = $this->db->query("select case when max(correlativo) != null then max(correlativo) else 0 end as correlativo
                                     from ganancias_rangos"); 
        return $query->result();
    }

    function puntosRangosUsuario()
    {        
        $query = $this->db->query("select *
                                     from plano_carreira
                                    order by pontos asc"); 
        return $query->result();
    }

    function calculosFecha($fechaCalculo) 
    {
        $fechaCalculo = "'".$fechaCalculo."'";
        $query = $this->db->query("select case when estado_ganancia = 1 then 'PENDING PAYMENT' else 'PAYMENT MADE' end as                            estado, g.*, u.nome
                                     from usuarios u,
                                          ganancias_rangos g
                                    where u.id = g.id_usuario
                                      and tipo_ganancia > 1
                                      and fecha_calculo = ".$fechaCalculo."                                      
                                    order by id_usuario, nivel_ganancia asc"); 
        return $query->result();
    }

    function getUsuario()
    {
        $query = $this->db->query("select *
                                     from usuarios
                                     order by id asc"); 
        return $query->result();
    }
    function getUsuarioId($id)
    {
        $query = $this->db->query("select *
                                     from usuarios
                                    where id = ".$id); 
        return $query->result();
    }
    function editarGananciaUsuarios($id_registro,$data)
    {
        $this->db->where('id',$id_registro);
        return $this->db->update('usuarios',$data);
    }
    function guardarExtractosCarrera($data)
    {
        $this->db->insert('extrato',$data);
        return $this->db->insert_id();
    }
    function getConfiguraciones()
    {
        $query = $this->db->query("select *
                                     from configuracao
                                    where nome_site = 'Smart Global Investments'"); 
        return $query->result();
    }
    function getExtratoIdGanancia($id)
    {
        $query = $this->db->query("select *
                                     from extrato 
                                    where id_ganancia_rango = ".$id);
        return $query->result();
    }

    function updateExtrato($id_registro, $data)
    {
        $this->db->where('id_ganancia_rango',$id_registro);
        return $this->db->update('extrato',$data);
    }
}
?>