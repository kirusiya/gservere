<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Configuracoesmodel extends CI_Model{

    public function __construct(){
        parent::__construct();
    }

    public function DiasSaques(){

        $this->db->order_by('dia_pagamento', 'ASC');
        $pagamentos = $this->db->get('configuracao_pagamento_saque');

        if($pagamentos->num_rows() > 0){

            return $pagamentos->result();
        }

        return false;
    }

    public function AtualizarConfiguracoesSite(){

        $dados = array();

        $config['upload_path'] = 'uploads';
        $config['allowed_types'] = 'png|jpg|jpeg|gif';
        $config['encrypt_name'] = true;

        $nome_site = $this->input->post('nome_site');
        $maximo_cpfs = $this->input->post('maximo_cpfs');
        $login_patrocinador = $this->input->post('login_patrocinador');

        if(!empty($_FILES['logo']['tmp_name'])){

            $this->upload->initialize($config);

            if($this->upload->do_upload('logo')){

                $retorno = $this->upload->data();

                $dados['logo'] = $retorno['file_name'];

            }else{

                return '<div class="alert alert-danger text-center">Error uploading Logo: '.$this->upload->display_errors().'</div>';
            }
        }

        if(!empty($_FILES['favicon']['tmp_name'])){

            if($this->upload->do_upload('favicon')){

                $retorno = $this->upload->data();

                $dados['favicon'] = $retorno['file_name'];

            }else{

                return '<div class="alert alert-danger text-center">Error uploading Favicon: '.$this->upload->display_errors().'</div>';
            }
        }

        $dados['nome_site'] = $nome_site;
        $dados['maximo_cpfs'] = $maximo_cpfs;
        $dados['login_patrocinador'] = $login_patrocinador;

        $update = $this->db->update('configuracao', $dados);

        if($update){

            return '<div class="alert alert-success text-center">Site settings successfully changed!</div>';
        }

        return '<div class="alert alert-danger text-center">Error changing site settings. Try again.</div>';
    }

    public function AtualizarConfiguracoesEmail(){

        $email = $this->input->post('email_remetente');
        $smtp = $this->input->post('smtp');
        $smtp_host = $this->input->post('smtp_host');
        $smtp_user = $this->input->post('smtp_user');
        $smtp_pass = $this->input->post('smtp_pass');
        $smtp_port = $this->input->post('smtp_port');
        $smtp_encrypt = $this->input->post('smtp_encrypt');

        $dados = array(
                       'email_remetente'=>$email,
                       'smtp_enabled'=>$smtp,
                       'smtp_host'=>$smtp_host,
                       'smtp_user'=>$smtp_user,
                       'smtp_pass'=>$smtp_pass,
                       'smtp_port'=>$smtp_port,
                       'smtp_encrypt'=>$smtp_encrypt
                       );

        $update = $this->db->update('configuracao', $dados);

        if($update){

            return '<div class="alert alert-success text-center">Email settings updated successfully.</div>';
        }

        return '<div class="alert alert-danger text-center">Error updating email settings.</div>';
    }

    public function AtualizarConfiguracoesFinanceiras(){

        $valor_minimo_saque_rendimentos = $this->input->post('valor_minimo_saque_rendimentos');
        $valor_minimo_saque_indicacoes = $this->input->post('valor_minimo_saque_indicacoes');
        // $indicacao_direta = $this->input->post('indicacao_direta');
        $porcentagem_dia = $this->input->post('porcentagem_dia');
        $quantidade_dias = $this->input->post('quantidade_dias');
        $paga_final_semana = $this->input->post('paga_final_semana');
        $taxa_saque = $this->input->post('taxa_saque');
		$btc = $this->input->post('btc');

        $dias = $this->input->post('dias');
        $inicio = $this->input->post('inicio');
        $termino = $this->input->post('termino');

        if(!empty($dias)){
            foreach($dias as $key=>$dia){

                if(empty($inicio[$key]) || empty($termino[$key])){
                  
                  return '<div class="alert alert-danger text-center">Please fill in all times to continue.</div>';  
                }
            }
        }

        $dadosConfiguracoes = array(
                                    'valor_minimo_saque_rendimentos'=>$valor_minimo_saque_rendimentos,
                                    'valor_minimo_saque_indicacoes'=>$valor_minimo_saque_indicacoes,
                                    'porcentagem_dia'=>$porcentagem_dia,
                                    'quantidade_dias'=>$quantidade_dias,
                                    'paga_final_semana'=>$paga_final_semana,
									'taxa_saque'=>$taxa_saque,	
                                    'btc'=>$btc
                                    );

        $updateConfig = $this->db->update('configuracao', $dadosConfiguracoes);

        if($updateConfig){

            $this->db->where('id != ', 0);
            $this->db->delete('configuracao_pagamento_saque');

            if(!empty($dias)){
                foreach($dias as $key=>$dia){

                    $dados = array(
                                   'dia_pagamento'=>$dia,
                                   'horario_inicio'=>$inicio[$key],
                                   'horario_termino'=>$termino[$key]
                                   );

                    $this->db->insert('configuracao_pagamento_saque', $dados);
                }
            }

            return '<div class="alert alert-success text-center">Data successfully updated!</div>';
        }

        return '<div class="alert alert-danger text-center">Error updating data. Please try again.</div>';
    }
}
?>