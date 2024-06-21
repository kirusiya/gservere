<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Extrato extends CI_Controller {

    public function __construct(){
        parent::__construct();
        is_logged();

        $this->load->model('cliente/extratomodel', 'ExtratoModel');
    }

    public function index(){

        $data['active'] = 'financeiro';

        $data['jsLoader'] = array(
                                    //'assets/bower_components/datatables.net/js/jquery.dataTables.min.js',
                                    //'assets/bower_components/datatables-tabletools/js/dataTables.tableTools.js',
                                    //'assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js',
                                    //'assets/bower_components/datatables-colvis/js/dataTables.colVis.js',
                                    //'assets/bower_components/datatables-responsive/js/dataTables.responsive.js',
                                    //'assets/bower_components/datatables-scroller/js/dataTables.scroller.js',
                                    'assets/pages/cliente/extrato.js'
                                  );

        $data['extratos'] = $this->ExtratoModel->TodosExtratos();

        $this->template->load('cliente/templates/template', 'cliente/financeiro/extrato', $data);
    }
}