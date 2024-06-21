<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ticket extends CI_Controller {

    public function __construct(){
        parent::__construct();
        is_logged();

        $this->load->model('cliente/ticketmodel', 'TicketModel');
    }

    public function index(){

        $data['active'] = 'suporte';

        $data['jsLoader'] = array(
                                //'assets/bower_components/datatables.net/js/jquery.dataTables.min.js',
                                //'assets/bower_components/datatables-tabletools/js/dataTables.tableTools.js',
                                //'assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js',
                                //'assets/bower_components/datatables-colvis/js/dataTables.colVis.js',
                                //'assets/bower_components/datatables-responsive/js/dataTables.responsive.js',
                                //'assets/bower_components/datatables-scroller/js/dataTables.scroller.js',
                                'assets/pages/cliente/ticket.js'
                              );


        $data['tickets'] = $this->TicketModel->MeusTickets();

        $this->template->load('cliente/templates/template', 'cliente/ticket/tickets', $data);
    }

    public function abrir(){

        $data['active'] = 'suporte';

        $data = array();

        if($this->input->post('submit')){

            $data['message'] = $this->TicketModel->AbrirTicket();
        }

        $this->template->load('cliente/templates/template', 'cliente/ticket/novo', $data);

    }

    public function visualizar($id_ticket){

        $data['active'] = 'suporte';

        if($this->input->post('submit')){
            $data['message'] = $this->TicketModel->ResponderTicket($id_ticket);
        }

        $data['ticket'] = $this->TicketModel->DadosTicket($id_ticket);
        $data['mensagens'] = $this->TicketModel->MensagensTicket($id_ticket);

        $this->template->load('cliente/templates/template', 'cliente/ticket/visualizar', $data);
    }

    public function fechar($id_ticket){

        $this->TicketModel->FecharTicket($id_ticket);
    }
}