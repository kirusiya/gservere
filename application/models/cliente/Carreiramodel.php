<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Carreiramodel extends CI_Model{

    protected $userid;

    public function __construct(){
        parent::__construct();

        $this->userid = InformacoesUsuario('id');
    }

    public function PlanoCarreira(){

        $this->db->order_by('pontos', 'ASC');
        $plano_carreira = $this->db->get('plano_carreira');

        if($plano_carreira->num_rows() > 0){

          return $plano_carreira->result();
        }

        return false;
    }

    public function InfoPlanoCarreira($id){

        $this->db->where('id', $id);
        $plano = $this->db->get('plano_carreira');

        if($plano->num_rows() > 0){

            return $plano->row();
        }
    }
}
?>