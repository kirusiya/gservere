<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Comprovante extends CI_Controller {

    public function __construct(){
        parent::__construct();
        is_logged();
        $this->userid = InformacoesUsuario('id');

        $this->load->model('cliente/comprovantemodel', 'ComprovanteModel');
    }

    public function index(){

        $data['active'] = 'financeiro';

        if($this->input->post('submit')){
            $data['message'] = $this->ComprovanteModel->EnviarComprovante();
        }

        $this->template->load('cliente/templates/template', 'cliente/financeiro/comprovante', $data);
    }

    public function checkout() {
        $this->load->library('Coinbase');
        $fecha = date('Y-m-d H:i:s');
        $id_product = $this->uri->segment(2);
        $code = sha1($fecha);
        $datoPlan = userPlan($id_product);
        $nomePlan = $datoPlan[0]->nome;

        $description = "Purchased by user";
        $address = InformacoesUsuario('cpf', $this->userid);
        $dataIns = array(
            'id_usuario' => $this->userid,
            'id_plano' => $id_product,
            'comprovante' => $nomePlan,
            'description' => $description,
            'address' => $address,
            'status' => 0,
        );

        $this->db->trans_start();
        $id = $this->ComprovanteModel->ComprovantePrevio($dataIns);
        if ($id > 0) {
            $this->db->trans_complete();
            $resp = $this->coinbase->createCharge($datoPlan[0]->valor, $code, $nomePlan, $id);
            $redirect_url = $resp->data->hosted_url;
            header("Location: " . $redirect_url);
            die();
        } else {
            $this->db->trans_rollback();
            return "<div class='alert alert-danger text-center'>We are very sorry, something happened, please try again.</div>";
        }
    }

    public function payment() {
        $headers = getallheaders();
        $headerName = 'X-Cc-Webhook-Signature';
        $signraturHeader = isset($headers[$headerName]) ? $headers[$headerName] : null;
        $payload = trim(file_get_contents('php://input'));

        $event = $this->coinbase->webHook($payload, $signraturHeader);
        //const userFabId = await getUserFabId(event.data.metadata.customer_id);
        //const amount = event.data.payments[0].net.local.amount;
        if ($event) {
            $this->load->library(['Sms','SendMailjet']);
            $id_user_name = $event->data->metadata->customer_name;
            $id_user_id = $event->data->metadata->customer_id;
            $id_factura = $event->data->metadata->customer_factId;
            $crypto = $event->data->payments[0]->net->cryto->currency;
            $hash = $event->data->payments[0]->transaction_id;

            $data = [
                'coin' => $crypto,
                'hashtxt' => $hash
            ];

            $html = '<h1>Confirmacion de Pago</h1>
                <ul>
                    <li>Nombre: '.$id_user_name.'</li>
                    <li>Id Usuario: '.$id_user_id.'</li>
                    <li>ID Factura: '.$id_factura.'</li>
                    <li>Crypto: '.$crypto.'</li>
                    <li>Hash: '.$hash.'</li>
                </ul>
                ';
            $sms = 'Confirmacion de Pago: Nombre: '.$id_user_name.', Id Usuario: '.$id_user_id.', ID Factura: '.$id_factura.', Crypto: '.$crypto.', Hash: '.$hash;
            $this->ComprovanteModel->updateComprovantePrevio($id_factura, $data);
            $this->sendmailjet->sendMail($html);
            $this->sms->send($sms);
        }
    }
}