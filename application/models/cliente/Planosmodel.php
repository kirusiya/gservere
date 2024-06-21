<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Planosmodel extends CI_Model{

    protected $userid;

    public function __construct(){
        parent::__construct();
        $this->userid = InformacoesUsuario('id');
    }

    public function TodosPlanos(){

        $this->db->order_by('valor', 'ASC');
        $planos = $this->db->get('planos');

        if($planos->num_rows() > 0){

            return $planos->result();
        }

        return false;
    }

    public function GerarFatura($id_plano){

        $this->db->where('id', $id_plano);
        $planos = $this->db->get('planos');

        if($planos->num_rows() > 0){

            $rowPlano = $planos->row();

            

                $data = array(
                        'id_usuario'=>$this->userid,
                        'id_plano'=>$id_plano,
                        'status'=>0
                    );

                $this->db->where('id_usuario', $this->userid);
                $this->db->where('status', 0);
                $faturas = $this->db->get('faturas');

                if($faturas->num_rows() > 0){

                    $row = $faturas->row();

                    $this->db->where('id', $row->id);
                    $this->db->delete('faturas');
                }

                $this->db->insert('faturas', $data);
            
        }
    }

}
?>