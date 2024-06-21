<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Saquesmodel extends CI_Model{

    public function __construct(){
        parent::__construct();
    }

    public function TotalSaquesPendentes(){

        $this->db->where('status', 0);
        $saques = $this->db->get('saques');

        return $saques->num_rows();
    }    

    public function TodosSaques(){

        $this->db->order_by('data_pedido', 'DESC');
        $this->db->order_by('status', 'DESC');
        $saques = $this->db->get('saques');

        if($saques->num_rows() > 0){

            return $saques->result();
        }

        return false;
    }

    public function ContaBancaria($id_conta){

        $this->db->where('id', $id_conta);
        $conta = $this->db->get('usuarios_contas');

        if($conta->num_rows() > 0){

            return $conta->row();
        }

        return false;
    }

    public function Visualizar($id){

        $this->db->where('id', $id);
        $saque = $this->db->get('saques');

        if($saque->num_rows() > 0){

            return $saque->row();
        }

        return false;
    }
}
?>