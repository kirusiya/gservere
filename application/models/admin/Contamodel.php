<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contamodel extends CI_Model{

    public function __construct(){
        parent::__construct();
    }

    public function Deslogar(){

        $this->session->unset_userdata('uid_admin');
        redirect('admin/login');
        exit;
    }

    public function FazerLogin(){

        $login = $this->input->post('login');
        $senha = md5($this->input->post('senha'));
        $admis = array(1,2);
        $this->db->where('login', $login);
        $this->db->where('senha', $senha);
        $this->db->where('is_admin >=', 1);
        
        $usuario = $this->db->get('usuarios');

        if($usuario->num_rows() > 0){

            $row = $usuario->row();
            $rolescero = $this->obtenerRolesCero($row->id);
            $roles = $this->obtenerRoles($row->id);
            $data = array(
                        'is_logued_in'  => TRUE,
                        'uid_admin' => $row->id,
                        'is_admin' => $row->is_admin,   //DIEGO
                        'rolescero' => $rolescero,
                        'roles' => $roles,
                    );

            $this->session->set_userdata($data);

            redirect('admin/dashboard');

            exit;
        }

        return '<div class="alert alert-danger text-center">Username or password is invalid!</div>';
    }
    function obtenerRolesCero($idUsuario)
    {
        $query = $this->db->query(" select o.id,
                                           o.codigo_opciones,
                                           o.opcion,
                                           o.link,
                                           o.icono,
                                           o.nivel,
                                           o.orden,
                                           o.rama
                                     from usuarios_opciones u, 
                                          opciones o 
                                    where u.id_opcion = o.id 
                                      and u.id_usuario = ".$idUsuario."
                                      and o.nivel in (0,1)
                                      and u.estado = 'AC' 
                                      and o.estado = 'AC' 
                                    order by o.orden asc;" );   
        return $query->result();
    }

    function obtenerRoles($idUsuario)
    {
        $query = $this->db->query(" 
                                    select o.id,
                                           o.codigo_opciones,
                                           o.opcion,
                                           o.link,
                                           o.icono,
                                           o.nivel,
                                           o.orden,
                                           o.rama
                                     from usuarios_opciones u, 
                                          opciones o 
                                    where u.id_opcion = o.id 
                                      and u.id_usuario = ".$idUsuario."
                                      and o.nivel in (2,3)
                                      and u.estado = 'AC' 
                                      and o.estado = 'AC' 
                                    order by o.orden asc;" ); 
        return $query->result();
    }
	
	
	
    function verificarRolUsuario($idUsuario,$idOpcion)
    {
        $query = $this->db->query(" select 1
                                      from usuarios_opciones u
                                     where u.id_opcion = ".$idOpcion."
                                       and u.id_usuario = ".$idUsuario."        
                                       and u.estado = 'AC'" ); 
        return $query->result();
    }

}
?>