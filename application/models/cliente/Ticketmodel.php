<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ticketmodel extends CI_Model{

    protected $userid;

    public function __construct(){
        parent::__construct();

        $this->userid = InformacoesUsuario('id');
    }

    public function MeusTickets(){

        $this->db->order_by('id', 'DESC');
        $this->db->where('id_usuario', $this->userid);
        $tickets = $this->db->get('tickets');

        if($tickets->num_rows() > 0){

            return $tickets->result();
        }

        return false;
    }

    public function AbrirTicket(){

        $assunto = $this->input->post('assunto');
        $mensagem = $this->input->post('mensagem');

        $dadosTicket = array(
                             'id_usuario'=>$this->userid,
                             'assunto'=>$assunto,
                             'ultima_atualizacao'=>date('Y-m-d H:i:s'),
                             'data_criado'=>date('Y-m-d H:i:s'),
                             'status'=>1
                            );

        $criaTicket = $this->db->insert('tickets', $dadosTicket);

        if($criaTicket){

            $id_ticket = $this->db->insert_id();

            $dadosMensagemTicket = array(
                                         'id_ticket'=>$id_ticket,
                                         'respondido_por'=>1,
                                         'mensagem'=>$mensagem,
                                         'data'=>date('Y-m-d H:i:s')
                                        );

            $this->db->insert('tickets_mensagem', $dadosMensagemTicket);

            $this->session->set_userdata('message_ticket', '<div class="alert alert-success text-center">Ticket created successfully!</div>');

            redirect('ticket/visualizar/'.$id_ticket);
        }
    }

    public function DadosTicket($id_ticket){

        $this->db->where('id', $id_ticket);
        $this->db->where('id_usuario', $this->userid);
        $ticket = $this->db->get('tickets');

        if($ticket->num_rows() > 0){

            return $ticket->row();

        }else{

            $this->session->set_userdata('message_show_tickets', '<div class="alert alert-danger text-center">Action not allowed!</div>');
            redirect('ticket');
        }

        return false;
    }

    public function MensagensTicket($id_ticket){

        $this->db->where('id_ticket', $id_ticket);
        $mensagens = $this->db->get('tickets_mensagem');

        if($mensagens->num_rows() > 0){

            return $mensagens->result();
        }

        return false;
    }

    public function ResponderTicket($id_ticket){

        $mensagem = $this->input->post('resposta');

        $dadosMensagemTicket = array(
                                     'id_ticket'=>$id_ticket,
                                     'respondido_por'=>1,
                                     'mensagem'=>$mensagem,
                                     'data'=>date('Y-m-d H:i:s')
                                    );

        $this->db->where('id', $id_ticket);
        $this->db->where('status', 3);
        $ticket = $this->db->get('tickets');

        if($ticket->num_rows() > 0){

            return '<div class="alert alert-danger text-center">Sorry, but the ticket has been closed and for that reason, you cannot respond.</div>';
        }

        $this->db->where('id', $id_ticket);
        $update = $this->db->update('tickets', array('ultima_atualizacao'=>date('Y-m-d H:i:s'), 'status'=>1));

        if($update){

            $insert = $this->db->insert('tickets_mensagem', $dadosMensagemTicket);

            if($insert){

                return '<div class="alert alert-success text-center">Ticket successfully answered!</div>';
            }
        }

        return '<div class="alert alert-danger text-center">Error responding to your ticket. Please try again.</div>';
    }

    public function FecharTicket($id_ticket){

        $this->db->where('id', $id_ticket);
        $this->db->where('id_usuario', $this->userid);
        $ticket = $this->db->get('tickets');

        if($ticket->num_rows() > 0){

            $this->db->where('id', $id_ticket);
            $this->db->update('tickets', array('status'=>3));
        
        }else{

            $this->session->set_userdata('message_show_tickets', '<div class="alert alert-danger text-center">Action not allowed!</div>');
        }

        redirect('ticket');
    }
}
?>