<?php
function verificarPermisosUsuario($idUsuario,$idOpcion,$valorPermisoBD)
{
  $fila_m =& get_instance();
  $fila_m->load->model('admin/Permisosmodel');

  $datos = $fila_m->Permisosmodel->verificarRolUsuario($idUsuario,$idOpcion,$valorPermisoBD);
  if($datos)
  {
    return $datos;
  }
  else
  {
    return false;
  }  
}

function verificarUsuarioPermiso($idUsuario,$idOpcion)
{
  $fila_m =& get_instance();
  $fila_m->load->model('admin/Permisosmodel');

  $datos = $fila_m->Permisosmodel->verificarPermisoUsuario($idUsuario,$idOpcion);
  if($datos)
  {
    return "checked";
  }
  else
  {
    return "";
  }  
}

function opcionesRoles($idRol,$roles)
{
  $datos = array();
  $con = 0;
  foreach ($roles as $rol)
  {    
    if($rol->codigo_opciones == $idRol)
    {
      $datos[$con] = $rol;
      $con++;
    }
  }

  return $datos;
}
?>