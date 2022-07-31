<?php 

require 'serverside.php';

$table_data->getObtenerListadoPaciente('view_listar_paciente','paciente_id',
    array('paciente_id','paciente_nombres','paciente_apepaterno','paciente_apematerno','paciente_dni','paciente_celular','paciente_edad','paciente_edadtipo','paciente_sexo','paciente_estatus','paciente_fregistro','paciente','edadcon'));




 ?>