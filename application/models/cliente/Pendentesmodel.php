<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pendentesmodel extends CI_Model{

    protected $userid;

    public function __construct(){
        parent::__construct();

        $this->userid = InformacoesUsuario('id');
    }

    public function UsuariosPendentes(){

        $this->db->select('u.*');
        $this->db->from('rede AS r');
        $this->db->join('usuarios AS u', 'u.id = r.id_usuario', 'inner');
        $this->db->where('r.plano_ativo', 0);
        $this->db->where('r.id_patrocinador_direto', $this->userid);
        $usuarios = $this->db->get();

        if($usuarios->num_rows() > 0){

            return $usuarios->result();
        }

        return false;
    }
}
?>