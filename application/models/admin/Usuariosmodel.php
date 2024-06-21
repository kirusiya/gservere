<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuariosmodel extends CI_Model{

    public function __construct(){
        parent::__construct();
    }

    public function TotalUsuarios(){

        $usuarios = $this->db->get('usuarios');

        return $usuarios->num_rows();
    }

    public function TodosUsuarios(){

        $usuarios = $this->db->get('usuarios');

        if($usuarios->num_rows() > 0){

            return $usuarios->result();
        }

        return false;
    }

    public function DadosUsuario($id){

        $dados = array();

        $this->db->where('id', $id);
        $usuario = $this->db->get('usuarios');

        if($usuario->num_rows() > 0){

            $rowUsuario = $usuario->row();

            $dados['usuario'] = $rowUsuario;

            $this->db->where('id_usuario', $id);
            $contasBancarias = $this->db->get('usuarios_contas');

            if($contasBancarias->num_rows() > 0){

                $dados['contas'] = $contasBancarias->result();
            }

            $this->db->select('upc.data, pc.nome');
            $this->db->from('usuarios_plano_carreira AS upc');
            $this->db->join('plano_carreira AS pc', 'pc.id = upc.id_plano_carreira', 'inner');
            $this->db->where('upc.id_usuario', $id);
            $this->db->order_by('upc.id', 'DESC');

            $planoCarreira = $this->db->get();

            if($planoCarreira->num_rows() > 0){

                $dados['plano_carreira'] = $planoCarreira->result();
            }

            $this->db->select_sum('pontos');
            $this->db->from('rede_pontos_binario');
            $this->db->where('id_usuario', $id);
            $this->db->where('chave_binaria', 1);
            $this->db->where('pago', 0);
            $queryBinarioEsquerdo = $this->db->get();

            $this->db->select_sum('pontos');
            $this->db->from('rede_pontos_binario');
            $this->db->where('id_usuario', $id);
            $this->db->where('chave_binaria', 2);
            $this->db->where('pago', 0);
            $queryBinarioDireito = $this->db->get();

            if($queryBinarioEsquerdo->num_rows() > 0){

                $pontosEsquerdo = $queryBinarioEsquerdo->row()->pontos;

                $dados['binario']['esquerdo'] = (!empty($pontosEsquerdo)) ? $pontosEsquerdo : 0;
            }else{
                $dados['binario']['esquerdo'] = 0;
            }

            if($queryBinarioDireito->num_rows() > 0){

                $pontosDireito = $queryBinarioDireito->row()->pontos;

                $dados['binario']['direito'] = (!empty($pontosDireito)) ? $pontosDireito : 0;
            }else{
                $dados['binario']['direito'] = 0;
            }

            
            $this->db->select('p.nome, f.data_pagamento');
            $this->db->from('faturas AS f');
            $this->db->join('planos AS p', 'p.id = f.id_plano', 'inner');
            $this->db->where('f.status', 1);
            $this->db->where('f.id_usuario', $id);
            $this->db->order_by('f.id', 'DESC');
            $this->db->limit(1);
            $queryPlanoAtual = $this->db->get();

            if($queryPlanoAtual->num_rows() > 0){

                $dados['plano'] = $queryPlanoAtual->row();
            }

            $this->db->where('id_usuario', $id);
            $extratos = $this->db->get('extrato');

            if($extratos->num_rows() > 0){

                $dados['extrato'] = $extratos->result();
            }
            $dados['patrocinador'] = $this->datosPatrocinador($id);

            return $dados;
        }

        redirect('admin/usuarios');
    }

	public function getRede($id_user){
		$this->db->select('r.*, up.login as patrocinador_name, upd.login as patrocinador_directo_name');
		$this->db->from('rede r');
		$this->db->join('usuarios up','r.id_patrocinador = up.id');
		$this->db->join('usuarios upd','r.id_patrocinador_direto = upd.id');
		$this->db->where('r.id_usuario',$id_user);
		$query = $this->db->get();
		return $query->row();
	}

    public function AtualizarUsuario($id){

        $nome = $this->input->post('nome');
        $email = $this->input->post('email');
        $cpf = $this->input->post('cpf');
        $celular = $this->input->post('celular');
        $login = $this->input->post('login');
        $senha = $this->input->post('senha');
        $block = $this->input->post('block');
        $is_admin = $this->input->post('is_admin');
        $binarios_dia = $this->input->post('binarios_dia');
		$saldo_rendimentos = $this->input->post('saldo_rendimentos');
        $saldo_indicacoes = $this->input->post('saldo_indicacoes');
        $quantidade_binario = $this->input->post('quantidade_binario');
		$tf=0;//Christopher Flores
        if($this->input->post('twofactor') == 1){
            $tf=1;
        }

		
		/* => para que actualize y no haya problemas con doble email | Edward
        $this->db->where('email', $email);
        $userEmail = $this->db->get('usuarios');
        if($userEmail->num_rows() > 0){
            $userEmailRow = $userEmail->row();
            if($id != $userEmailRow->id){
                return '<div class="alert alert-danger text-center">The email provided is already in use. Choose another.</div>';
            }
        }
		*/
		

        $this->db->where('login', $login);
        $userLogin = $this->db->get('usuarios');

        if($userLogin->num_rows() > 0){

            $userLoginRow = $userLogin->row();

            if($id != $userLoginRow->id){

                return '<div class="alert alert-danger text-center">The login provided is already in use. Choose another.</div>';
            }
        }

        $dados = array(
                       'nome'=>$nome,
                       'email'=>$email,
                      // 'cpf'=>$cpf,
                       'celular'=>$celular,
                       'login'=>$login,
                       'block'=>$block,
                       'is_admin'=>$is_admin,
                       'binarios_dia'=>$binarios_dia,
					   'saldo_rendimentos'=>$saldo_rendimentos,	
                       'saldo_indicacoes'=>$saldo_indicacoes,
                       'quantidade_binario'=>$quantidade_binario,
					   'active_twofactor' => $tf	
                       );

        if(!empty($senha)){
            $dados['senha'] = md5($senha);
        }

        $this->db->where('id', $id);
        $update = $this->db->update('usuarios', $dados);
		
		
		/*actualizar lado binario*/
		$chave_binaria = $this->input->post('chave_binaria');
		$datosBin = array(
                       'chave_binaria'=>$chave_binaria,	
                       );
		
		$this->db->where('id_usuario', $id);
        $this->db->update('rede', $datosBin);
		
		/*actualizar lado binario*/
		

        if($update){

            return '<div class="alert alert-success text-center">User successfully updated!</div>';
        }

        return '<div class="alert alert-danger text-center">Error updating user. Try again.</div>';
    }

    // INICIO CAMBIOS DIEGO
    function GananciasNiveles($idUsuario)
    {
        $query = $this->db->query("select case when estado_ganancia = 1 then 'PENDING PAYMENT' else 'PAYMENT MADE' end as estado, g.*
                                     from ganancias_rangos g
                                    where id_usuario = ".$idUsuario."
                                      and tipo_ganancia > 1
                                      and estado_ganancia = 1
                                    order by fecha_calculo asc"); 
        return $query->result();
    }

    function getUsuarios($idUsuario)
    {
        $query = $this->db->query("select *
                                     from usuarios
                                    where id = ".$idUsuario);
        return $query->result();
    }
    // FIN CAMBIOS DIEGO

    // INICIO CAMBIOS DIEGO

    function actualizarRetiro($idUsuario, $valor)
    {
        $dados = array(
                       'retira'=>$valor,                       
                       );

        $this->db->where('id', $idUsuario);
        $update = $this->db->update('usuarios', $dados);

        redirect('admin/usuarios');
    }
    function getVerificaPlan($idUsuario)
    {
        $query = $this->db->query("select p.valor
                                     from faturas f, planos p
                                    where f.id_plano = p.id 
                                      and f.id_usuario = ".$idUsuario."
                                    order by f.data_pagamento desc
                                    limit 1");
        return $query->result();
    }
    function getPuntosUsuarioId($idUsuario,$lado)
    {
        $query = $this->db->query("select *
                                     from rede_pontos_binario p
                                    where p.id_usuario = ".$idUsuario."
                                      and p.chave_binaria = ".$lado."
                                      and p.pago = 0
                                    order by p.id asc");
        return $query->result();
    }
    function updatePuntosUser($id,$data)
    {
        $this->db->where('id', $id);
        return $this->db->update('rede_pontos_binario', $data);
    }
    function datosPatrocinador($id)
    {
       $query = $this->db->query("select r.id_usuario, 
                                         r.id_patrocinador, 
                                         u.id, 
                                         u.nome, 
                                         u.login
                                    from rede r, usuarios u
                                   where r.id_patrocinador = u.id
                                     and id_usuario = ".$id);
        $result =  $query->result();
        if($result)
        {
            return $result[0]->nome;
        }
        else
        {
            return "";
        }
    }
    function patrocinadosDirectos($idUsuario, $lado)
    {
        $query = $this->db->query(" select u.id, u.nome,
                                           (select data_pagamento 
                                              from faturas 
                                             where id_usuario = r.id_usuario
                                             order by data_pagamento asc
                                             limit 1)as fecha_factura 
                                      from rede r, usuarios u 
                                     where r.id_usuario = u.id
                                       and r.id_patrocinador_direto = ".$idUsuario."
                                       and r.chave_binaria = ".$lado."
                                       and exists (select 1 
                                                     from faturas 
                                                    where id_usuario = r.id_usuario)");
        return $query->result();
    }
    function getLadoInscripcionId($idUsuario)
    {
        $query = $this->db->query("select u.id, u.nome, u.login,u.ver_puntos,case when r.chave_binaria = 1 then 'LEFT' else 'RIGHT' end as lado_inscripcion
                                     from rede r, usuarios u 
                                    where r.id_usuario = u.id
                                      and r.id_usuario = ".$idUsuario);
        return $query->result();
    }
    function updateVerPuntosUser($id,$data)
    {
        $this->db->where('id', $id);
        return $this->db->update('usuarios', $data);
    }
    // FIN CAMBIOS DIEGO
}
?>