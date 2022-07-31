<?php 
require '../../model/modelo_especialidad.php';

$MR = new Modelo_Especialidad();
$especialidad = htmlspecialchars($_POST['especialidad'],ENT_QUOTES,'UTF-8');

$consulta =$MR->Registrar_Especialidad($especialidad);
echo $consulta;





 ?>