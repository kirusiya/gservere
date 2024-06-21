<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Planosmodel extends CI_Model{

    public function __construct(){
        parent::__construct();
    }

    public function TodosPlanos(){

        $this->db->order_by('valor', 'ASC');
        $planos = $this->db->get('planos');

        if($planos->num_rows() > 0){

            return $planos->result();
        }

        return false;
    }

    public function NovoPlano(){

        $nome = $this->input->post('nome');
        $valor = $this->input->post('valor');
        $binario = $this->input->post('binario');
        $pontos = $this->input->post('pontos');
        $rede = $this->input->post('rede');
        $teto_binario = $this->input->post('teto_binario');
        $ganhos_diarios = $this->input->post('ganhos_diarios');
        $recomendado = $this->input->post('recomendado');
		$img_plan = $this->input->post('img_plan');
		$ganhos_maximo = $this->input->post('ganhos_maximo');

        $dados = array(
                       'nome'=>$nome,
                       'valor'=>$valor,
                       'binario'=>$binario,
                       'plano_carreira'=>$pontos,
                       'rede_afiliados'=>$rede,
                       'teto_binario'=>$teto_binario,
                       'ganhos_diarios'=>$ganhos_diarios,
                       'recomendado'=>$recomendado,
					   'img_plan'=>$img_plan,
					   'ganhos_maximo'=>$ganhos_maximo 	
                    );

        $insert = $this->db->insert('planos', $dados);

        if($insert){

            return '<div class="alert alert-success text-center">Plan added with </div>';
        }

        return '<div class="alert alert-danger text-center">Error adding plan. Try again.</div>';
    }

    public function InformacoesPlano($id){

        $this->db->where('id', $id);
        $plano = $this->db->get('planos');

        if($plano->num_rows() > 0){

            return $plano->row();
        }

        return false;
    }

    public function EditarPlano($id){

        $nome = $this->input->post('nome');
        $valor = $this->input->post('valor');
        $binario = $this->input->post('binario');
        $pontos = $this->input->post('pontos');
        $rede = $this->input->post('rede');
        $teto_binario = $this->input->post('teto_binario');
        $ganhos_diarios = $this->input->post('ganhos_diarios');
        $recomendado = $this->input->post('recomendado');
		$img_plan = $this->input->post('img_plan');
		$ganhos_maximo = $this->input->post('ganhos_maximo');

        $dados = array(
                       'nome'=>$nome,
                       'valor'=>$valor,
                       'binario'=>$binario,
                       'plano_carreira'=>$pontos,
                       'rede_afiliados'=>$rede,
                       'teto_binario'=>$teto_binario,
                       'ganhos_diarios'=>$ganhos_diarios,
                       'img_plan'=>$img_plan,
					   'ganhos_maximo'=>$ganhos_maximo	
                    );

        $this->db->where('id', $id);
        $update = $this->db->update('planos', $dados);

        if($update){

            return '<div class="alert alert-success text-center">Plan successfully updated!</div>';
        }

        return '<div class="alert alert-danger text-center">Error updating plan. Try again.</div>';
    }

    public function ExcluirPlano($id){

        $this->db->where('id', $id);
        $this->db->delete('planos');

        redirect('admin/planos');
    }
}
?>