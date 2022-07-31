<?php 

require 'serverside.php';

$table_data->getObtenerListadoUsario('view_listar_usuario','usu_id',
    array('usu_id','usu_nombre','usu_contrasena','rol_id','rol_nombre','usu_status','usu_email','usu_foto'));




 ?>