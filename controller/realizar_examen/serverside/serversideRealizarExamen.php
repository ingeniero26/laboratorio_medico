<?php 

require 'serverside.php';

$table_data->getObtenerListadoExamenesRealizados('listar_examenes_realizados','realizarexamen_id',
    array('realizarexamen_id','paciente_dni','paciente','usu_nombre','medico','realizarexamen_estatus','realizarexamen_fregistro'));




 ?>