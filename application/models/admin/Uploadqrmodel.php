<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Uploadqrmodel extends CI_Model{

    public function __construct(){
        parent::__construct();
    }

    
    function getQrSistema()
    {
        $query = $this->db->query(" select cod_qr, text_qr,img_qr, case when estado_qr = 1 then 'ACTIVE' else 'INACTIVE' end as  estado_qr
                                      from qr_sistema
                                     order by cod_qr  asc" ); 
        return $query->result();
    }


    function getQrSistemaId($id){

       $query = $this->db->query(" select *
                                      from qr_sistema
                                    where cod_qr = ".$id); 
        return $query->result();
    }


    function guardarQR()
    {
        $descripcion = $this->input->post('descripcion');      
        $estado = $this->input->post('estado');
        $img_qr = $this->input->post('img_qr');

        $data = array(
                       
                       'text_qr'=>$descripcion,
                       'img_qr'=>$img_qr,                      
                       'estado_qr'=>$estado,
                    );

        $insert = $this->db->insert('qr_sistema', $data);

        if($insert){

            return '<div class="alert alert-success text-center">Wallet Payments created correctly</div>';
        }

        return '<div class="alert alert-danger text-center">Error when creating the Wallet Payments</div>'; 
    }


    function EditarQR($id)
    {
        $descripcion = $this->input->post('descripcion');      
        $estado = $this->input->post('estado');
        $img_qr = $this->input->post('img_qr');
        
        $data = array(
                       
                       'text_qr'=>$descripcion,
                       'img_qr' =>$img_qr,                      
                       'estado_qr'=>$estado,
                    );

        $this->db->where('cod_qr', $id);
        $update = $this->db->update('qr_sistema', $data);

        if($update){

            return '<div class="alert alert-success text-center">Wallet Payments updated correctly</div>';        
        }

        return '<div class="alert alert-danger text-center">Error when updated the Wallet Payments</div>'; 
    }

    function ExcluirQr($id)
    {
        $this->db->where('cod_qr', $id);
        $this->db->delete('qr_sistema');
        redirect('admin/uploadqr');
    }    
}
?>