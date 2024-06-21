<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Extratomodel extends CI_Model{

    protected $userid;

    public function __construct(){
        parent::__construct();

        $this->userid = InformacoesUsuario('id');
    }

    public function TodosExtratos(){

        $this->db->order_by('data', 'DESC');
        $this->db->where('id_usuario', $this->userid);
        $extratos = $this->db->get('extrato');

        if($extratos->num_rows() > 0){

            return $extratos->result();
        }

        return false;
    }
}
?>