<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        is_logged();

        $this->load->model('cliente/redemodel', 'RedeModel');
        $this->load->model('cliente/pontosmodel', 'PontosModel'); //edward
        $this->load->model('cliente/dashboardmodel', 'DashboardModel');
        $this->load->model('cliente/contamodel', 'ContaModel'); //beto
        $this->load->model('cliente/planosmodel', 'PlanosModel'); //beto
        $this->load->model('admin/usuariosmodel', 'UsuariosModel'); // DIEGO
    }

    public function index()
    {

        $data['active'] = 'dashboard';

        $data['jsLoader'] = array(
            'vendor/needim/noty/lib/noty.min.js',
            'assets/plugins/clipboard-js/js/clipboard.min.js',
            'assets/plugins/countdown/jquery.countdown.js',
            'assets/pages/cliente/dashboard.js',
            'vendor/needim/noty/lib/noty.min.js', //edward
            'assets/pages/cliente/chave.js' //edward	
        );
        $idUsuario = $this->session->userdata('uid');   //diego        
        $data['rede'] = $this->RedeModel->QuantidadeTodaRede();
        $data['pontos'] = $this->PontosModel->PontosBinario(); //edward
        $data['directuser'] = $this->DashboardModel->directReferrals(); //edward
        $data['userPlain'] = $this->ContaModel->calcularProfit(InformacoesUsuario('id')); //beto	
        $data['plain'] = $this->PlanosModel->TodosPlanos(); //beto
        $data['usuario'] = $this->UsuariosModel->getUsuarios($idUsuario);//diego
        $data['ladoinscripcion'] = $this->UsuariosModel->getLadoInscripcionId($idUsuario);//diego
		
		
		$data['cortepuntos'] = $this->DashboardModel->cortePuntos($idUsuario);//edward


        $this->template->load('cliente/templates/template', 'cliente/backoffice/backoffice', $data);
    }

    public function configuracoes()
    {

        $data['jsLoader'] = array();

        if ($this->input->post('submit')) {

            $data['message'] = $this->DashboardModel->AlterarDadosCadastrais();
        }



        $this->template->load('cliente/templates/template', 'cliente/backoffice/configuracoes', $data);
    }
	
	 
	
}
