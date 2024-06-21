<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Niveismodel extends CI_Model{

    public function __construct(){
        parent::__construct();
    }

    public function TodosNiveis(){

        $this->db->order_by('nivel', 'ASC');
        $niveis = $this->db->get('configuracao_nivel_indicacoes');

        if($niveis->num_rows() > 0){

            return $niveis->result();
        }

        return false;
    }

    public function NovoNivel(){

        $nivel = $this->input->post('nivel');
        $porcentagem = $this->input->post('porcentagem');

        $dados = array(
                       'nivel'=>$nivel,
                       'porcentagem'=>$porcentagem
                    );

        $insert = $this->db->insert('configuracao_nivel_indicacoes', $dados);

        if($insert){

            return '<div class="alert alert-success text-center">Level added successfully!</div>';
        }

        return '<div class="alert alert-danger text-center">Error adding level. Try again.</div>';
    }

    public function InformacoesNiveis($id){

        $this->db->where('id', $id);
        $nivel = $this->db->get('configuracao_nivel_indicacoes');

        if($nivel->num_rows() > 0){

            return $nivel->row();
        }

        return false;
    }

    public function EditarNivel($id){

        $nivel = $this->input->post('nivel');
        $porcentagem = $this->input->post('porcentagem');

        $dados = array(
                       'nivel'=>$nivel,
                       'porcentagem'=>$porcentagem
                    );

        $this->db->where('id', $id);
        $update = $this->db->update('configuracao_nivel_indicacoes', $dados);

        if($update){

            return '<div class="alert alert-success text-center">Level updated successfully!</div>';
        }

        return '<div class="alert alert-danger text-center">Error updating level. Try again.</div>';
    }

    public function ExcluirNivel($id){

        $this->db->where('id', $id);
        $this->db->delete('configuracao_nivel_indicacoes');

        redirect('admin/niveis');
    }
}
?>