<?php
function ConfiguracoesSistema($coluna){

    $_this =& get_instance();

    $configuracoes = $_this->db->get('configuracao');

    if($configuracoes->num_rows() > 0){

        return $configuracoes->row()->$coluna;
    }

    return false;
}
?>