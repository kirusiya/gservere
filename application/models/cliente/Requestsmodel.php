<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Requestsmodel extends CI_Model{

    protected $userid;

    public function __construct(){
        parent::__construct();

        $this->userid = InformacoesUsuario('id');
    }

    public function AtualizaNotificacoes($admin){

        $this->db->where('for_admin', $admin);

        if($admin == 0){
            $this->db->where('id_usuario', $this->userid);
        }else{
            $this->db->where('id_usuario', $this->session->userdata('uid_admin'));
        }
        $atualiza = $this->db->update('notificacoes', array('visualizada'=>1));

        if($atualiza){

            return json_encode(array('status'=>1));
        }

        return json_encode(array('status'=>0));
    }

    public function EnviarContato(){

        $nome = $this->input->post('nome');
        $email = $this->input->post('email');
        $mensagem = $this->input->post('mensagem');

        $html  = 'Hello, you have received a new contact form from the website. Below are the details of the completed form: <br /><br />';
        $html .= '<b>Name:</b> '.$nome.'<br />';
        $html .= '<b>Email:</b> '.$email.'<br />';
        $html .= '<b>message:</b> '.$mensagem;

        $this->sendmail->EnviarEmail(ConfiguracoesSistema('email_remetente'), 'New contact form', $html);

    }
}
?>