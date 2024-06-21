<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tickets extends CI_Controller {

    public function __construct(){
        parent::__construct();
        CheckUserIsAdmin();

        $this->load->model('admin/ticketsmodel', 'TicketsModel');        
        $this->load->helper('permisos_helper');
    }

    public function index(){

        $idUsuario = $this->session->userdata('uid_admin');
        $valorOpcionBD = 4;
        $valorPermisoBD = 1;
        $permiso = verificarPermisosUsuario($idUsuario,$valorOpcionBD,$valorPermisoBD);
        if($permiso)
        {
            $data['jsLoader'] = array(
                                        'assets/bower_components/datatables.net/js/jquery.dataTables.min.js',
                                        'assets/bower_components/datatables-tabletools/js/dataTables.tableTools.js',
                                        'assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js',
                                        'assets/bower_components/datatables-colvis/js/dataTables.colVis.js',
                                        'assets/bower_components/datatables-responsive/js/dataTables.responsive.js',
                                        'assets/bower_components/datatables-scroller/js/dataTables.scroller.js',
                                        'assets/pages/admin/tickets.js'
                                      );

            $data['tickets'] = $this->TicketsModel->TodosTickets();
            //recuperar roles desde la variable de session DIEGO
            $data['rolescero'] = $this->session->userdata('rolescero');
            $data['roles']     = $this->session->userdata('roles');
            $this->template->load('admin/templates/template', 'admin/tickets/tickets', $data);
        }
        else
        {
            redirect('admin/dashboard');
        }
    }

    public function visualizar($id)
    {
        $idUsuario = $this->session->userdata('uid_admin');
        $valorOpcionBD = 4;
        $valorPermisoBD = 4;
        $permiso = verificarPermisosUsuario($idUsuario,$valorOpcionBD,$valorPermisoBD);
        if($permiso)
        {
            if($this->input->post('submit'))
            {
                $data['message'] = $this->TicketsModel->ResponderTicket($id);
            }
            $data['tickets'] = $this->TicketsModel->VisualizarTicket($id);
            //recuperar roles desde la variable de session DIEGO
            $data['rolescero'] = $this->session->userdata('rolescero');
            $data['roles']     = $this->session->userdata('roles');
            $this->template->load('admin/templates/template', 'admin/tickets/visualizar', $data);
        }
        else
        {
            redirect('admin/tickets');
        }
    }

    public function fechar($id)
    {
        $idUsuario = $this->session->userdata('uid_admin');
        $valorOpcionBD = 4;
        $valorPermisoBD = 3;
        $permiso = verificarPermisosUsuario($idUsuario,$valorOpcionBD,$valorPermisoBD);
        if($permiso)
        {
            $this->TicketsModel->FecharTicket($id);
        }
        else
        {
            redirect('admin/tickets');
        }
    }
}