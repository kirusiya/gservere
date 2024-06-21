<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Qualifiedmodel extends CI_Model{

    public function __construct(){
        parent::__construct();
    }

    public function TotalUsuarios(){

        $usuarios = $this->db->get('usuarios');

        if($usuarios->num_rows() > 0){

            return $usuarios->result();
        }
        return false;
    }
	
	
	public function TotalUsuariosQua($id){

        $query = $this->db->query("SELECT * FROM qualified WHERE id_user_giver = $id ORDER BY id_usuario ASC");

        return $query->result();
    }
	
	
	
    function getQualifiedId($id){
        $query = $this->db->query("select * from qualified 
							WHERE id_usuario =$id ORDER BY calificador desc");
		
        return $query->result();
    }
	
	
	
    
	
	function verLadoPatroDirectoAdmin($id){
		
		$query = $this->db->query("select * from rede 
							WHERE id_usuario = $id");
		
		return $query->result();

	}
	

   
}
?>