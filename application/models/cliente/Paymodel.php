<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Paymodel extends CI_Model{

    protected $table      = 'faturas';


    public function __construct(){
        parent::__construct();
        $this->userid = InformacoesUsuario('id');
    }

public function payRegister($hash){
    
    $this->db->where('id_usuario', $this->userid);
    $this->db->where('status', 0);
    $faturas = $this->db->get('faturas');

    if($faturas->num_rows() > 0){

        $row = $faturas->row();

        $this->db->where('id', $row->id);
        $this->db->update('faturas', array('comprovante'=>$hash));

        echo  '1';

    }else{

        return  '<div>Sorry, but we couldnt find any open invoices to attach a receipt. Please verify.</div>';
    }

}


}
?>