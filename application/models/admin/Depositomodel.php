<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Depositomodel extends CI_Model{

    public function __construct(){
        parent::__construct();
    }

    public function TodasContas(){

        $contas = $this->db->get('contas_pagamento');

        if($contas->num_rows() > 0){

            return $contas->result();
        }

        return false;
    }

    public function NovaConta(){

        $dados = array();

        $categoria_conta = $this->input->post('tipo');
        $banco = $this->input->post('banco');
        $agencia = $this->input->post('agencia');
        $conta = $this->input->post('conta');
        $operacao = $this->input->post('operacao');
        $tipo_conta = $this->input->post('tipo_conta');
        $titular = $this->input->post('titular');
        $documento = $this->input->post('documento');
        $carteira = $this->input->post('carteira');

        if($categoria_conta == 1){

          $dados['banco'] = $banco;
          $dados['agencia'] = $agencia;
          $dados['conta'] = $conta;
          $dados['operacao'] = $operacao;
          $dados['tipo'] = $tipo_conta;
          $dados['titular'] = $titular;
          $dados['documento'] = $documento;
          $dados['categoria_conta'] = $categoria_conta;

        }else{

          $dados['carteira_bitcoin'] = $carteira;
          $dados['categoria_conta'] = $categoria_conta;
        }

        $insert = $this->db->insert('contas_pagamento', $dados);

        if($insert){

            return '<div class="alert alert-success text-center">Account for payment successfully added!</div>';
        }

        return '<div class="alert alert-danger text-center">Error adding account for payment. Try again.</div>';
    }

    public function InformacoesConta($id){

        $this->db->where('id', $id);
        $contas = $this->db->get('contas_pagamento');

        if($contas->num_rows() > 0){

            return $contas->row();
        }

        return false;
    }

    public function EditarConta($id){

        $dados = array();

        $categoria_conta = $this->input->post('tipo');
        $banco = $this->input->post('banco');
        $agencia = $this->input->post('agencia');
        $conta = $this->input->post('conta');
        $operacao = $this->input->post('operacao');
        $tipo_conta = $this->input->post('tipo_conta');
        $titular = $this->input->post('titular');
        $documento = $this->input->post('documento');
        $carteira = $this->input->post('carteira');

        if($categoria_conta == 1){

          $dados['banco'] = $banco;
          $dados['agencia'] = $agencia;
          $dados['conta'] = $conta;
          $dados['operacao'] = $operacao;
          $dados['tipo'] = $tipo_conta;
          $dados['titular'] = $titular;
          $dados['documento'] = $documento;
          $dados['categoria_conta'] = $categoria_conta;

        }else{

          $dados['carteira_bitcoin'] = $carteira;
          $dados['categoria_conta'] = $categoria_conta;
        }

        $this->db->where('id', $id);
        $update = $this->db->insert('contas_pagamento', $dados);

        if($update){

            return '<div class="alert alert-success text-center">Account for payment edited successfully!</div>';
        }

        return '<div class="alert alert-danger text-center">Error editing bill for payment. Try again.</div>';
    }

    public function ExcluirConta($id){

        $this->db->where('id', $id);
        $this->db->delete('contas_pagamento');

        redirect('admin/deposito');
    }
}
?>