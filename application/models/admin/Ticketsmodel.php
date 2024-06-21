<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ticketsmodel extends CI_Model{

    public function __construct(){
        parent::__construct();
    }

    public function TodosTickets(){

        $this->db->order_by('data_criado',  'DESC');
        $tickets = $this->db->get('tickets');

        return $tickets->result();
    }

    public function VisualizarTicket($id){

        $this->db->select('tm.*, t.assunto, t.status, t.id_usuario');
        $this->db->from('tickets AS t');
        $this->db->join('tickets_mensagem AS tm', 'tm.id_ticket = t.id', 'inner');
        $this->db->where('t.id', $id);
        $tickets = $this->db->get();

        if($tickets->num_rows() > 0){

            return $tickets->result();
        }

        return false;
    }

    public function ResponderTicket($id){

        $resposta = $this->input->post('resposta');

        $insere = $this->db->insert('tickets_mensagem', array('id_ticket'=>$id, 'respondido_por'=>2, 'mensagem'=>$resposta, 'data'=>date('Y-m-d H:i:s')));

        if($insere){

            $this->db->where('id', $id);
            $this->db->update('tickets', array('status'=>2));

            $this->db->where('id', $id);
            $ticketInfo = $this->db->get('tickets');

            if($ticketInfo->num_rows() > 0){

                $row = $ticketInfo->row();

                EnviaNotificacao($row->id_usuario, 'Your ticket <b>#'.$id.'</b> was answered by support');

            }

            return '<div class="alert alert-success text-center">Ticket successfully answered!</div>';
        }

        return '<div class="alert alert-danger text-center">Error responding to ticket. Try again.</div>';
    }

    public function FecharTicket($id){

        $this->db->where('id', $id);
        $this->db->update('tickets', array('status'=>3));

        $this->db->where('id', $id);
        $ticketInfo = $this->db->get('tickets');

        if($ticketInfo->num_rows() > 0){

            $row = $ticketInfo->row();

            EnviaNotificacao($row->id_usuario, 'Your ticket <b>#'.$id.'</b> has been marked as closed');

        }

        redirect('admin/tickets/visualizar/'.$id);
    }
}
?>