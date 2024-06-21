<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Carreiramodel extends CI_Model{

    public function __construct(){
        parent::__construct();
    }

    public function TodosPlanos(){

        $this->db->order_by('pontos', 'ASC');
        $planos = $this->db->get('plano_carreira');

        if($planos->num_rows() > 0){

            return $planos->result();
        }

        return false;
    }

    public function NovoPlano(){

        $nome = $this->input->post('nome');
        $pontos = $this->input->post('pontos');
        $premio = $this->input->post('premio');

        $dados = array(
                       'nome'=>$nome,
                       'pontos'=>$pontos,
                       'premio'=>$premio
                    );

        $insert = $this->db->insert('plano_carreira', $dados);

        if($insert){

            return '<div class="alert alert-success text-center">Career path successfully added!</div>';
        }

        return '<div class="alert alert-danger text-center">Error adding career plan. Try again.</div>';
    }

    public function InformacoesPlano($id){

        $this->db->where('id', $id);
        $plano = $this->db->get('plano_carreira');

        if($plano->num_rows() > 0){

            return $plano->row();
        }

        return false;
    }

    public function EditarPlano($id){

        $nome = $this->input->post('nome');
        $pontos = $this->input->post('pontos');
        $premio = $this->input->post('premio');

        $dados = array(
                       'nome'=>$nome,
                       'pontos'=>$pontos,
                       'premio'=>$premio
                    );

        $this->db->where('id', $id);
        $update = $this->db->update('plano_carreira', $dados);

        if($update){

            return '<div class="alert alert-success text-center">Plan successfully updated!</div>';
        }

        return '<div class="alert alert-danger text-center">Error updating plan. Try again.</div>';
    }

    public function ExcluirPlano($id){

        $this->db->where('id', $id);
        $this->db->delete('plano_carreira');

        redirect('admin/carreira');
    }
}
?>