<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuariomodel extends CI_Model{

    protected $userid;

    public function __construct(){
        parent::__construct();

        $this->userid = InformacoesUsuario('id');
    }

    public function QuantidadeNotificacoes(){

        $this->db->where('visualizada', 0);
        $this->db->where('for_admin', 0);
        $this->db->where('id_usuario', $this->userid);
        $notificacoes = $this->db->get('notificacoes');

        return $notificacoes->num_rows();
    }
 
    public function MinhasNotificacoes(){

        $this->db->order_by('data', 'DESC');
        $this->db->where('for_admin', 0);
        $this->db->where('id_usuario', $this->userid);
        $notificacoes = $this->db->get('notificacoes');

        if($notificacoes->num_rows() > 0){

            return $notificacoes->result();
        }

        return false;
    }

    public function QuantidadeNotificacoesAdmin(){

        $this->db->where('visualizada', 0);
        $this->db->where('for_admin', 1);
        $this->db->where('id_usuario', $this->session->userdata('uid_admin'));
        $notificacoes = $this->db->get('notificacoes');

        return $notificacoes->num_rows();
    }

    public function MinhasNotificacoesAdmin(){

        $this->db->order_by('data', 'DESC');
        $this->db->where('for_admin', 1);
        $this->db->where('id_usuario', $this->session->userdata('uid_admin'));
        $notificacoes = $this->db->get('notificacoes');

        if($notificacoes->num_rows() > 0){

            return $notificacoes->result();
        }

        return false;
    }

    public function AlterarChaveBinaria($key = false){

        if($key !== false && !empty($key)){

            $this->db->where('id', $this->userid);
            $update = $this->db->update('usuarios', array('chave_binaria'=>$key));

            if($update){

                return json_encode(array('status'=>1));
            }

            return json_encode(array('status'=>0));
        }

        return json_encode(array('status'=>0));
    }
}
?>